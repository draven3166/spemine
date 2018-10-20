<?php
ini_set('display_errors','on');
require_once '_constants.php';
require_once 'db.php';
global $conn;

/*
https://www.coinpayments.net/merchant-tools-ipn
*/
// Fill these in with the information from your CoinPayments.net account.
$cp_merchant_id = COINMID;
$cp_ipn_secret = COINMSEC;

//These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
$order_currency = COINCUR;

function errorAndDie($error_msg,$params=null) {
    global $conn;
    $report = 'Error Type: '.$error_msg."\n\n";
    if($params){
        $report .= "-------Start Params--------\n";
        $report .= "\n{$params}\n";
        $report .= "-------End Params--------\n\n";
    }
    $report .= "POST Data\n\n";
    foreach ($_POST as $k => $v) {
        $report .= "|$k| = |$v|\n";
    }
    //Insert ipn error
    $log = $conn->prepare("INSERT into inp_errors (message,content,status) VALUES (:message, :contents,:status)");
    $log->bindParam(':message', strip_tags($error_msg));
    $log->bindParam(':contents', json_encode($report));
    $log->bindParam(':status', $_POST['status']);
    $log->execute();
    die('IPN Error: '.$error_msg);
}

//GET transaction from db
$stmt = $conn->prepare("SELECT * FROM transactions_history WHERE hash = :hash AND status != 'paid' LIMIT 1");
$stmt->bindParam(':hash', $_POST['custom']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_OBJ);
$transaction = $stmt->fetch();

if($transaction){
    $order_total = $transaction->amount;
}else{
    errorAndDie('Transaction not found on transactions history in DB!', $_POST['custom']);
}

if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
    errorAndDie('IPN Mode is not HMAC');
}

if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
    errorAndDie('No HMAC signature sent.');
}

$request = file_get_contents('php://input');
if ($request === FALSE || empty($request)) {
    errorAndDie('Error reading POST data');
}

if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
    errorAndDie('No or incorrect Merchant ID passed');
}

$hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
    errorAndDie('HMAC signature does not match');
}

// HMAC Signature verified at this point, load some variables.

$txn_id = $_POST['txn_id'];
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$amount1 = floatval($_POST['amount1']);
$amount2 = floatval($_POST['amount2']);
$currency1 = $_POST['currency1'];
$currency2 = $_POST['currency2'];
$status = intval($_POST['status']);
$status_text = $_POST['status_text'];

//depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

// Check the original currency to make sure the buyer didn't change it.
if ($currency1 != $order_currency) {
    errorAndDie('Original currency mismatch!','CR1: '.$currency1.' - ORC: '.$order_currency);
}

// Check amount against order total
if ($amount1 < $order_total) {
    errorAndDie('Amount is less than order total!','AM1: '.$amount1.' - TOTAL: '.$order_total);
}

if ($status >= 100 || $status === 2) {
    $format = 'Y-m-d H:i:s';

    // Update transaction
    $stmt = $conn->prepare("UPDATE transactions_history SET txid = :txid, paid_amount = :paid, status='paid' WHERE id = :id LIMIT 1");
    $stmt->bindParam(':txid', $txn_id);
    $stmt->bindParam(':paid', $amount1);
    $stmt->bindParam(':id', $transaction->id);
    $stmt->execute();

    if($stmt->rowCount()===0){ errorAndDie( 'Error trying to update transaction','TID: '.$transaction->id);}

    //Insert user deposit
    $stmt = $conn->prepare("INSERT into user_deposits (user_id, amount, tx, status, date_paid) VALUES (:id, :amo, :tx, 'SUCCESS', :date)");
    $stmt->bindParam(':id', $transaction->user_id);
    $stmt->bindParam(':amo', $amount1);
    $stmt->bindParam(':tx', $txn_id);
    $stmt->bindValue(':date', date($format));
    $stmt->execute();

    if($stmt->rowCount()===0){ errorAndDie( 'Error trying to insert deposit');}

    //Check upline data
    $stmt = $conn->prepare("SELECT reference_user_id FROM users WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $transaction->user_id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $refIddata = $stmt->fetchColumn();

    //if(count($refIddata)===0){ errorAndDie( 'Error fetching upline data','UID: '.$transaction->user_id);}

    if($refIddata!=0){
        //Get referral data
        $stmt = $conn->prepare("SELECT affiliate_earns FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $refIddata);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $refdata = $stmt->fetchColumn();

        //if(count($refIddata)==0){ errorAndDie( 'Error fetching upline balance','UID: '.$refIddata);}

        $comission = number_format($amount1 * AFFEARN/100,8,'.','');
        $newbalance = number_format($comission + $refdata,8,'.','');

        //Update upline affiliate earns
        $stmt = $conn->prepare("UPDATE users SET affiliate_earns = :amount WHERE id = :id LIMIT 1");
        $stmt->bindParam(':amount', $newbalance);
        $stmt->bindParam(':id', $refIddata);
        $stmt->execute();

        if($stmt->rowCount()===0){ errorAndDie( 'Error trying to update user balance','UID: '.$refIddata);}

        //Insert affiliate history
        $stmt = $conn->prepare("INSERT into affiliate_history (user_id, amount, date) VALUES (:id, :amo, :date)");
        $stmt->bindParam(':id', $refIddata);
        $stmt->bindParam(':amo', $comission);
        $stmt->bindValue(':date', date($format));
        $stmt->execute();

        if($stmt->rowCount()===0){ errorAndDie( 'Error while trying to enter affiliate history');}
    }

    //Get plan
    $stmt = $conn->prepare("SELECT * FROM plans WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $item_number);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $plandata = $stmt->fetch();

    if($stmt->rowCount()===0){ errorAndDie( 'Error while trying to get plan data','PID: '.$item_number);}

    //Activate user plan
    $expirationDate = date_format(date_add(date_create(),date_interval_create_from_date_string($plandata->duration." days")),$format);

    if(empty($expirationDate)) { errorAndDie( 'Error trying to create expiration date!','DATE: '.$expirationDate); }

    $stmt = $conn->prepare("INSERT into user_plan_history (user_id, plan_id, status, expire_date) VALUES (:user, :plan, 'active', :expiration)");
    $stmt->bindParam(':user', $transaction->user_id);
    $stmt->bindParam(':plan', $transaction->plan_id);
    $stmt->bindParam(':expiration', $expirationDate);
    $stmt->execute();

    if($stmt->rowCount()===0){ errorAndDie( 'Error while trying to enter plan history');}
    die('IPN OK');
}
elseif($status === 1){
	// Update transaction
	$stmt = $conn->prepare("UPDATE transactions_history SET status='waiting' WHERE id = :id LIMIT 1");    
	$stmt->bindParam(':id', $transaction->id);    
	$stmt->execute();
}