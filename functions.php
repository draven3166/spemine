<?php
$timezone = date_default_timezone_get();
//date_default_timezone_set($timezone);
//Get user balance
function getBalance($data) {
    global $conn;
    $stmt = $conn->prepare("SELECT uph.id as id, uph.plan_id as plan_id, uph.user_id as user_id, uph.last_sum as last_sum, uph.created_at as created_at, p.earning_rate as earning_rate FROM user_plan_history uph inner join plans p on uph.plan_id = p.id WHERE uph.user_id = :userid AND status='active'");
    $stmt->bindParam(':userid', $data['uid']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    $earning = 0;
    if($res) {
        //Single Active Plan
        /*if(count($res) == 1) {
            $created = $res[0]['created_at'];
            $createdDate  = strtotime($created);
            $now =  time();
            $sec = $now - $createdDate; // In Seconds

            $earning += ($sec * ($res[0]['earning_rate']/60));*/
        //}else{
            foreach($res as $key => $val):
                $date1 = time();
                if($res[$key]['last_sum']){
                    $date2 = $res[$key]['last_sum'];
                }else{
                    $date2 = strtotime($res[$key]['created_at']);
                }                
                $sec = $date1 - $date2;

                $earning += ($sec * ($res[$key]['earning_rate']/60));
                //var_dump($val);//die;
                //Update last sum
                $stmt = $conn->prepare("UPDATE user_plan_history SET last_sum = :last WHERE id = :id");
                $stmt->bindParam(':id', $val['id']);
                $stmt->bindValue(':last', time());
                $stmt->execute();
            endforeach;
        //}
    }
    return number_format($earning, 8, '.', '');
}
//Create user
function addUser($username, $reference_user_id, $user_ip_addr) {
	global $conn;

	$unique_id = mt_rand(10000,99999);

	$stmt = $conn->prepare("SELECT p.id FROM plans p where is_default = 1");
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$res = $stmt->fetch();
	$stmt = $conn->prepare("INSERT into users (username, plan_id, reference_user_id, ip_addr, unique_id) 
							VALUES (:un, :pid, :ref_id, :ip_addr, :unique_id)");
	$stmt->bindParam(':un', $username);
	$stmt->bindParam(':pid', $res['id']);
	$stmt->bindParam(':ref_id', $reference_user_id);
	$stmt->bindParam(':ip_addr', $user_ip_addr);
	$stmt->bindParam(':unique_id', $unique_id);

	$stmt->execute();
	$uid = $conn->lastInsertId();
	$stmt = $conn->prepare("INSERT into user_plan_history (user_id, plan_id,status,created_at) VALUES (:uid, :pid,'active',:date)");
	$stmt->bindParam(':date', date('Y-m-d H:i:s'));
	$stmt->bindParam(':uid', $uid);
	$stmt->bindParam(':pid', $res['id']);
	$stmt->execute();
}
//Get user data
function getUser($username) {
	global $conn;
	$stmt = $conn->prepare("SELECT u.*, p.*, u.id as uid FROM users u inner join plans p on u.plan_id = p.id where u.username = :username ");
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$res = $stmt->fetch();
	return $res;
}

//Update Withdraw history
function request_withdrawal($amount,$type='payment')
{
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != "")
	{
		$date_time = date('Y-m-d H:i:s');
		global $conn;

		$stmt = $conn->prepare("INSERT into user_withdrawal (user_id, type, amount, created_at) VALUES (:uid, :type, :amt, :date)");
		$stmt->bindParam(':uid', $_SESSION['uid']);
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':amt', $amount);
		$stmt->bindParam(':date', $date_time);
		$stmt->execute();
		return TRUE;
	}
	return FALSE;
}
//Get user withdraws
function get_withdrawals($type='payment',$status=null)
{
	$res_arr = [];
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != "")
	{
		global $conn;
		if($status){
            $stmt = $conn->prepare("SELECT * FROM user_withdrawal p WHERE user_id = :user AND type = :type AND status=:status");
        }else{
            $stmt = $conn->prepare("SELECT * FROM user_withdrawal p WHERE user_id = :user AND type = :type");
        }
        if($status){
            $stmt->bindParam(':status', $status);
        }
		$stmt->bindParam(':user', $_SESSION['uid']);
		$stmt->bindParam(':type', $type);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		// $res = $stmt->fetch();

		while ($res = $stmt->fetch()) 
		{
		    $res_arr[]= $res;
		}
		return $res_arr;
	}
}
//List user referrals
function getAllReferenceUsers($user_id) 
{
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM users WHERE reference_user_id = ".$user_id);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$res = $stmt->fetchAll();
	return $res;
}
//List referrals deposits
function getReferenceDeposits($user_id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user_deposits WHERE user_id = :user AND status = 'SUCCESS'");
    $stmt->bindParam(':user', $user_id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchColumn();
    return $res;
}
//List affiliate comissions
function getComissions($user_id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM affiliate_history WHERE user_id = :user ORDER BY id DESC");
    $stmt->bindParam(':user', $user_id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    return $res;
}
//Get real IP from user
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//List all plans
function getAllPlans() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plans");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    return $res;
}
//List only paid plans
function getPaidPlans() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plans WHERE is_default=0");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    return $res;
}
//Return url filename to use in conditionals functions
function filename(){
    $route = explode('/',$_SERVER['REQUEST_URI'])[1];
    return $route;
}
//List all user deposits
function get_deposits()
{
    $res_arr = [];
    if(isset($_SESSION['uid']) && $_SESSION['uid'] != "")
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_deposits d WHERE user_id = ".$_SESSION['uid']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while ($res = $stmt->fetch())
        {
            $res_arr[]= $res;
        }
        return $res_arr;
    }
}
// Disable expired plans
function plansCron($data) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user_plan_history WHERE user_id = :userid AND status='active' AND expire_date != 'NULL'");
    $stmt->bindParam(':userid', $data['uid']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();

    foreach ($res as $re) {
        $now = time();
        $expire_date = strtotime($re['expire_date']);
        if($now >= $expire_date){
            $stmt = $conn->prepare("UPDATE user_plan_history SET status = 'inactive' WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $re['id']);
            $stmt->execute();
        }
    }
}

//Get user affiliate earnings
function getUserComissions($data){
    global $conn;
    $stmt = $conn->prepare("SELECT affiliate_earns FROM users WHERE id = :userid LIMIT 1");
    $stmt->bindParam(':userid', $data['uid']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $affiliate = $stmt->fetchColumn();
    return $affiliate;
}

//Get user active plans
function getUserAcPlans($userId){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user_plan_history uh INNER JOIN plans p ON p.id=uh.plan_id  WHERE user_id= :userId AND status='active'");
    $stmt->bindParam('userId',$userId);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    return $stmt->fetchAll();
}

//Get latest payments
function getPayoutsList($limit = 10){
    if(!is_int($limit)){$limit = 10;}
    global $conn;
    $stmt = $conn->prepare("SELECT w.*,u.username as wallet FROM user_withdrawal w INNER JOIN users u ON w.user_id=u.id WHERE status = 'SUCCESS' ORDER BY date_paid DESC LIMIT {$limit}");
    //$stmt->bindParam(':limitList', $limit);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

//Get latest deposits
function getDepositsList($limit = 10){
    if(!is_int($limit)){$limit = 10;}
    global $conn;
    $stm = $conn->prepare("SELECT d.*,u.username as wallet FROM user_deposits d INNER JOIN users u ON d.user_id=u.id WHERE status = 'SUCCESS' ORDER BY date_paid DESC LIMIT {$limit}");
    $stm->execute();
    $stm->setFetchMode(PDO::FETCH_ASSOC);
    return $stm->fetchAll();
}

//Sum all payments
function sumWithdraws(){
    global $conn;
    $stm = $conn->prepare("SELECT SUM(amount) FROM user_withdrawal WHERE status = 'SUCCESS'");
    $stm->execute();
    $stm->setFetchMode(PDO::FETCH_OBJ);
    return $stm->fetchColumn();
}

//Get plan data
function getPlanById($id){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plans WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    return $stmt->fetchObject();
}

//Get user transaction history
function UserTransactions($user){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM transactions_history WHERE user_id = :id AND status!='paid' ORDER BY id DESC");
    $stmt->bindParam(':id', $user);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

//Update user pending transaction
function updateUserPendingTransaction($transaction,$amount,$newHash){
    global $conn;
    $stmt = $conn->prepare("UPDATE transactions_history SET hash = :hash, amount = :amount WHERE id = :id LIMIT 1");
    $stmt->bindParam(':hash', $newHash);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':id', $transaction);
    $stmt->execute();
}

//Create user transaction
function createTransaction($user,$plan,$amount,$hash){
    global $conn;
    $stmt = $conn->prepare("INSERT into transactions_history (user_id, plan_id,amount,hash) VALUES (:id, :plan,:amo,:hash)");
    $stmt->bindParam(':id', $user);
    $stmt->bindParam(':plan', $plan);
    $stmt->bindParam(':amo', $amount);
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();
}

function totalUsers(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

function totalDeposits(){
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) as amount FROM user_deposits");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumDeposits = $stmt->fetch();
    return ($sumDeposits['amount']!=NULL? $sumDeposits['amount']: '0.00');
}

function totalPaid()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) as amount FROM user_withdrawal WHERE status='SUCCESS'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumWithdrawal = $stmt->fetch();
    return ($sumWithdrawal['amount']!=NULL? $sumWithdrawal['amount']: '0.00');
}

function blockchainUrl($txid){
    if($txid){
        global $conn;
        $stmt = $conn->prepare("SELECT ch.url as url FROM settings as s INNER JOIN urlchains as ch ON ch.id=s.blockchain WHERE s.id= 1 LIMIT 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $url = $stmt->fetchColumn();
        return $url.$txid;
    }

}

function updateBalances($balance,$withdraws)
{
	global $conn;
	$stmt = $conn->prepare("UPDATE users SET balance = balance+:bal, cashouts = cashouts+:with WHERE id = :id LIMIT 1");
	$stmt->bindParam(':id', $_SESSION['uid']);
	$stmt->bindParam(':bal', $balance);
	$stmt->bindParam(':with', $withdraws);
	$stmt->execute();
}

function getUserBalance()
{
	global $conn;
	$stmt = $conn->prepare("SELECT balance FROM users WHERE id = :id LIMIT 1");
	$stmt->bindParam(':id', $_SESSION['uid']);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$bal = $stmt->fetchColumn();
	return $bal;
}

function debitUserBalance($amount)
{
    if(isset($amount)){
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET balance = balance-:amount, cashouts = cashouts+:withdraw WHERE id = :id LIMIT 1");
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':withdraw', $amount);
        $stmt->bindParam(':id', $_SESSION['uid']);
        $stmt->execute();
    }	
}