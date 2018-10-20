<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
session_start();
if($_SESSION['admin'] != 1)
header('Location: '. BASE_PATH . 'index.php');

function getAllPlans() {
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM plans");
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$res = $stmt->fetchAll();
	return $res;
}

function addNewPlan($data) {
	global $conn;
	if($data['is_default'] == 1) {
		//update other plans with default 0
		$stmt = $conn->prepare("UPDATE plans set is_default = 0");
		$stmt->execute();
	}
	$keys = implode(", ", array_keys($data));
	$stmt = $conn->prepare("INSERT into plans (".$keys.") VALUES (:pn, :def, :ppd, :ver, :er, :img, :price, :duration, :profit, :speed)");
    $ppDay = number_format($data['point_per_day'],8,'.','');
    $erRating = number_format($data['earning_rate'],8,'.','');
	$stmt->bindParam(':pn', $data['plan_name']);
	$stmt->bindParam(':def', $data['is_default']);
	$stmt->bindParam(':ppd', $ppDay);
	$stmt->bindParam(':ver', $data['version']);
	$stmt->bindParam(':er', $erRating);
	$stmt->bindParam(':img', $data['image']);
	$stmt->bindParam(':price', $data['price']);
	$stmt->bindParam(':duration', $data['duration']);
	$stmt->bindParam(':profit', $data['profit']);
	$stmt->bindParam(':speed', $data['speed']);
	$stmt->execute();
}

function getPlanById($plan) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plans WHERE id= :planId LIMIT 1");
    $stmt->bindParam(':planId',$plan);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    return $stmt->fetch();
}

function deletePlan($plan) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM plans WHERE id= :id LIMIT 1");
    $stmt->bindParam(':id', $plan);
    $stmt->execute();
}

function updatePlan($data,$ID){
    global $conn;
    if($data['is_default'] == 1) {
        //update other plans with default 0
        $stmt = $conn->prepare("UPDATE plans SET is_default = 0 WHERE is_default = 1");
        $stmt->execute();
    }
    $stmt = $conn->prepare("UPDATE plans SET plan_name= :pn, is_default= :def, point_per_day= :ppd, version= :ver, earning_rate= :er, image = :img, price= :price, duration= :duration, profit= :profit, speed= :speed WHERE id= :ID ");
    $stmt->bindParam(':pn', $data['plan_name']);
    $stmt->bindParam(':def', $data['is_default']);
    $stmt->bindParam(':ppd', number_format($data['point_per_day'],8,'.',''));
    $stmt->bindParam(':ver', $_POST['version']);
    $stmt->bindParam(':er', number_format($data['earning_rate'],8,'.',''));
    $stmt->bindParam(':img', $data['imagename']);
    $stmt->bindParam(':price', $data['plan_price']);
    $stmt->bindParam(':duration', $data['duration']);
    $stmt->bindParam(':profit', $data['profit']);
    $stmt->bindParam(':speed', $data['speed']);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();
}

function getUserById($user){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id= :userId LIMIT 1");
    $stmt->bindParam(':userId',$user);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $userRow = $stmt->fetch();
    if($userRow) return $userRow;
}

function get_withdrawals($user_id)
{
	$res_arr = [];
	if(isset($user_id) && $user_id != "")
	{
		global $conn;
		$stmt = $conn->prepare("SELECT * FROM user_withdrawal p where user_id = ".$user_id." AND type='payment'");
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

function get_deposits($user_id)
{
    $res_arr = [];
    if(isset($user_id) && $user_id != "")
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_deposits where 
										user_id = ".$user_id);
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

function get_comissions($user_id)
{
    $res_arr = [];
    if(isset($user_id) && $user_id != "")
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM affiliate_history where 
										user_id = ".$user_id);
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

function get_activeplans($user_id)
{
    $res_arr = [];
    if(isset($user_id) && $user_id != "")
    {
        global $conn;
        $stmt = $conn->prepare("SELECT H.*, P.plan_name as name FROM user_plan_history H INNER JOIN plans P ON P.id=H.plan_id WHERE H.user_id = ".$user_id);
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

function get_ipnLogbyId($logId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM inp_errors WHERE id= :Id LIMIT 1");
    $stmt->bindParam(':Id',$logId);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $log = $stmt->fetch();
    if($log){
        return $log;
    }
}

function get_reference_user($usr_id)
{
	global $conn;
	$stmt = $conn->prepare("SELECT u.*, p.plan_name, p.version FROM users u inner join plans p on u.plan_id = p.id  where u.reference_user_id = ".$usr_id);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$res = $stmt->fetchAll();
	return $res;
}

function updateWithdrawStatus($status)
{
	// Update withdrwal status
	global $conn;
	$stmt = $conn->prepare("UPDATE user_withdrawal set status = :status, tx= :txId WHERE id= :id LIMIT 1");
	$stmt->bindParam(':status', $status['status']);
	$stmt->bindParam(':txId', $status['tx']);
	$stmt->bindParam(':id', $status['id']);
	$stmt->execute();

	if($status['status']=='SUCCESS'){
		//Set paid date
		$stmt = $conn->prepare("UPDATE user_withdrawal set date_paid = :date WHERE id= :id LIMIT 1");
		$stmt->bindParam(':date', date('Y-m-d H:i:s'));
		$stmt->bindParam(':id', $status['id']);
		$stmt->execute();
	
        //Actions for affiliate withdraws
        $stmt = $conn->prepare("SELECT * FROM user_withdrawal WHERE id= :id LIMIT 1");
        $stmt->bindParam(':id',$status['id']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $wRow = $stmt->fetch();

        $stmt = $conn->prepare("SELECT affiliate_earns, affiliate_paid, id FROM users WHERE id= :id LIMIT 1");
        $stmt->bindParam(':id',$wRow->user_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $user = $stmt->fetch();

        if($wRow->type=='affiliate'){
            $stmt = $conn->prepare("UPDATE users set affiliate_earns = :earns, affiliate_paid= :paid WHERE id= :id LIMIT 1");
            $stmt->bindParam(':earns', number_format($user->affiliate_earns - $wRow->amount,8,'.',''));
            $stmt->bindParam(':paid', number_format($user->affiliate_paid + $wRow->amount,8,'.',''));
            $stmt->bindParam(':id', $user->id);
            $stmt->execute();
        }
    }
}

function updateSettings($data)
{
	// Update withdrwal limit for all users
	global $conn;

    $min_with = number_format($data['min_withdraw'],$data['currency_decimals'],'.','');
    $min_affwith = number_format($data['min_aff_withdraw'],$data['currency_decimals'],'.','');
    $max_with = number_format($data['max_withdraw'],$data['currency_decimals'],'.','');

	$stmt = $conn->prepare("UPDATE settings set sitename = :sitename, keywords = :keywords, description = :description, pagination = :pagination, min_withdraw = :min_withdraw, min_aff_withdraw = :min_aff_withdraw, max_withdraw = :max_withdraw, aff_comission = :aff_comission, currency_name = :currency_name, currency_symbol = :currency_symbol, currency_code = :currency_code, currency_decimals = :currency_decimals, coin_pv = :coin_pv, coin_pb = :coin_pb, coin_mid = :coin_mid, coin_sec = :coin_sec, coin_cur1 = :coin_cur1, coin_cur2 = :coin_cur2, coin_hash = :coin_hash, username = :username, smtp_host = :smtp_host, smtp_user = :smtp_user, smtp_port = :smtp_port, smtp_secure = :smtp_secure, smtp_sender = :smtp_sender, facebook = :facebook, telegram = :telegram, twitter = :twitter, vk = :vk, wallet_min = :wallet_min, wallet_max = :wallet_max, blockchain = :blockchain WHERE id=1 LIMIT 1");
	$stmt->bindParam(':sitename',$data['sitename'] );
	$stmt->bindParam(':keywords',$data['keywords'] );
	$stmt->bindParam(':description',$data['description'] );
	$stmt->bindParam(':pagination',$data['pagination'] );
	$stmt->bindParam(':min_withdraw',$min_with );
	$stmt->bindParam(':min_aff_withdraw',$min_affwith );
	$stmt->bindParam(':max_withdraw',$max_with );
	$stmt->bindParam(':aff_comission',$data['aff_comission'] );
	$stmt->bindParam(':currency_name',$data['currency_name'] );
	$stmt->bindParam(':currency_symbol',$data['currency_symbol'] );
	$stmt->bindParam(':currency_code',$data['currency_code'] );
	$stmt->bindParam(':currency_decimals',$data['currency_decimals'] );
	$stmt->bindParam(':coin_pv',$data['coin_pv'] );
	$stmt->bindParam(':coin_pb',$data['coin_pb'] );
	$stmt->bindParam(':coin_mid',$data['coin_mid'] );
	$stmt->bindParam(':coin_sec',$data['coin_sec'] );
	$stmt->bindParam(':coin_cur1',$data['coin_cur1'] );
	$stmt->bindParam(':coin_cur2',$data['coin_cur2'] );
	$stmt->bindParam(':coin_hash',$data['coin_hash'] );
	$stmt->bindParam(':username',$data['username'] );
	$stmt->bindParam(':smtp_host',$data['smtp_host'] );
	$stmt->bindParam(':smtp_user',$data['smtp_user'] );
	$stmt->bindParam(':smtp_port',$data['smtp_port'] );
	$stmt->bindParam(':smtp_secure',$data['smtp_secure'] );
	$stmt->bindParam(':smtp_sender',$data['smtp_sender'] );
	$stmt->bindParam(':facebook',$data['facebook'] );
	$stmt->bindParam(':telegram',$data['telegram'] );
	$stmt->bindParam(':twitter',$data['twitter'] );
	$stmt->bindParam(':vk',$data['vk'] );
	$stmt->bindParam(':wallet_min',$data['wallet_minch'] );
	$stmt->bindParam(':wallet_max',$data['wallet_maxch'] );
	$stmt->bindParam(':blockchain',$data['blockchain'] );
	$stmt->execute();
    if($data['smtp_pass']!=''){
        $stmt = $conn->prepare("UPDATE settings set smtp_pass = :smtp_pass WHERE id=1 LIMIT 1");
        $stmt->bindParam(':smtp_pass',$data['smtp_pass']);
        $stmt->execute();
    }
	if(!empty($data['password'])){
        $stmt = $conn->prepare("UPDATE settings set password = :password WHERE id=1 LIMIT 1");
        $stmt->bindParam(':password',md5($data['password']) );
        $stmt->execute();
    }
}

//Count Unread Messages
function unreadMessages()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM contact WHERE status = 'unread'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

//Count Pending Withdraws
function pendingWithdraws()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user_withdrawal WHERE status = 'PENDING'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

//Count Users
function countTotalUsers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

//Count Users today
function countTodayUsers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE DATE(created_at) = CURDATE()");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

//Count Plans
function countTotalPlans()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM plans");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
}

//Sum deposits
function sumAllDeposits()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) as amount FROM user_deposits");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumDeposits = $stmt->fetch();
    return ($sumDeposits['amount']!=NULL? $sumDeposits['amount']: '0.00');
}

//Sum today deposits
function todayDeposits()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) FROM user_deposits WHERE status='SUCCESS' AND DATE(date_paid) = CURDATE()");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumDeposits = $stmt->fetchColumn();
    return ($sumDeposits!=NULL? $sumDeposits: '0.00');
}

//Sum today payments
function todayPayments()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) FROM user_withdrawal WHERE status='SUCCESS' AND DATE(date_paid) = CURDATE()");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumWithdrawal = $stmt->fetchColumn();
    return ($sumWithdrawal!=NULL? $sumWithdrawal: '0.00');
}

//Sum payments
function sumAllPayments()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(amount) as amount FROM user_withdrawal WHERE status='SUCCESS'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sumWithdrawal = $stmt->fetch();
    return ($sumWithdrawal['amount']!=NULL? $sumWithdrawal['amount']: '0.00');
}

//List withdraws requests
function getWithdrawRequests($start_from, $results_per_page)
{
    global $conn;
    $stmt = $conn->prepare("SELECT W.id as id,W.amount as amount,U.username as username, W.created_at as date, P.plan_name as plan, W.type as type, W.status as status FROM user_withdrawal as W INNER JOIN users AS U ON U.id=W.user_id INNER JOIN plans AS P ON P.id=U.plan_id WHERE W.status!='SUCCESS' ORDER BY W.id ASC LIMIT $start_from,".$results_per_page);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

//Get withdraw request
function getWithdrawRequest($withdraw)
{
    global $conn;
    $stmt = $conn->prepare("SELECT W.id as id, W.amount as amount, U.username as username, W.type as type, W.tx as tx, W.status as status FROM user_withdrawal as W INNER JOIN users as U ON U.id=W.user_id WHERE W.id= :wId LIMIT 1");
    $stmt->bindParam(':wId',$withdraw);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $wRow = $stmt->fetch();
    if($wRow) return $wRow;
}

//Paginate results
function getPagination($table,$start_from, $results_per_page,$order='DESC')
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $table ORDER BY id $order LIMIT $start_from,".$results_per_page);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    return $res;
}

//Generate pagination links
function getPaginationLinks($datatable='contact', $results_per_page = '10',$page=0,$url)
{
    $pagination_links="<ul class='pagination'>";
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(id) AS total FROM ".$datatable);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetch();

    $total_pages = ceil($res["total"] / $results_per_page); // calculate total pages with results

    for ($i=1; $i<=$total_pages; $i++)
    {
        // print links for all pages
        $pagination_links.="<li class='page-item";
        if ($i==$page)
        {
            $pagination_links.=" active";
        }

        $pagination_links.="'><a class='page-link' href='".$url."?page=".$i."'>".$i."</a></li> ";
    };
    $pagination_links.="</ul>";

    return $pagination_links;
}

//Get contact info
function getContactById($message){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM contact WHERE id= :Id LIMIT 1");
    $stmt->bindParam(':Id',$message);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $messageRow = $stmt->fetch();
    if($messageRow) return $messageRow;
}

//Update contact message
function updateContact($msgId,$status)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE contact set status = :status WHERE id= :msgId LIMIT 1");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':msgId', $msgId);
    $stmt->execute();
}

//Plans images
function getPlansImages(){
    $directory = scandir(PLANSDIR);
    $t = array();
    foreach($directory as $value) {
        if($value === '.' || $value === '..') {continue;}
        $t[] =  $value ;
    }
    return $t;
}

//Blockchain urls
function getBlockchainUrls(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM urlchains");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $res = $stmt->fetchAll();
    return $res;
}

function addNewChain($data) {
    global $conn;
    $keys = implode(", ", array_keys($data));
    $stmt = $conn->prepare("INSERT into urlchains (".$keys.") VALUES (:name, :url)");
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':url', $data['url']);
    $stmt->execute();
}

function getChainById($chain) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM urlchains WHERE id= :chainId LIMIT 1");
    $stmt->bindParam(':chainId',$chain);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    return $stmt->fetch();
}

function deleteChain($chain) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM urlchains WHERE id= :id LIMIT 1");
    $stmt->bindParam(':id', $chain);
    $stmt->execute();
}

function updateChain($data,$ID){
    global $conn;
    $stmt = $conn->prepare("UPDATE urlchains SET name= :name, url= :url WHERE id= :ID ");
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':url', $data['url']);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();
}