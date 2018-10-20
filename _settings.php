<?php
require_once 'db.php';
$stmt = $conn->prepare("SELECT * FROM settings WHERE id= 1 LIMIT 1");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_OBJ);
$settings = $stmt->fetch();

define('SC_NAME','SCM - Simple Cloud Mining Script'); // Script Name
define('SC_VERSION','2.2'); // Script Version
define('PLANSDIR',__DIR__.'/img/plans/'); // Script Version

//Site Settings
define('SITENAME',$settings->sitename); // Site name
define('SITEDESC',$settings->description); // Site description
define('SITEKEYWORDS',$settings->keywords); // Site keywords
define('MINWTHD',$settings->min_withdraw); // Min withdraw value
define('MAXWTHD',$settings->max_withdraw); // Max withdraw value
define('MINAFWTHD',$settings->min_aff_withdraw); // Min withdraw value for affiliate earns
define('AFFEARN',$settings->aff_comission); // Affiliate percent. 2 = 2%
define('PAGINATION',$settings->pagination); // Paginate results

//Social
define('SOCIAL_FACEBOOK',$settings->facebook); // Facebook
define('SOCIAL_TELEGRAM',$settings->telegram); // Telegram
define('SOCIAL_TWITTER',$settings->twitter); // twitter
define('SOCIAL_VK',$settings->vk); // Vk

//Wallet validation
define('WALLET_MINCH',$settings->wallet_min); // Wallet min characters
define('WALLET_MAXCH',$settings->wallet_max); // Wallet max characters

define('BLOCKCHAIN_URL',$settings->blockchain); // Blockchain URL

//Admin Settings
define('ADMINU',$settings->username); // Admin Username
define('ADMINP',$settings->password); // Admin password

//Currency
define('DECIMALS',$settings->currency_decimals); // Number of decimals
define('CURSYM',$settings->currency_symbol); // Currency symbol
define('CURNAME',$settings->currency_name); // Currency name
define('CURCOD',$settings->currency_code); // Currency code

//Mail settings
define('SMTP_HOST',$settings->smtp_host); // SMTP host
define('SMTP_USER',$settings->smtp_user); // SMTP username
define('SMTP_PASS',$settings->smtp_pass); // SMTP password
define('SMTP_PORT',$settings->smtp_port); // SMTP port
define('SMTP_SECUR',$settings->smtp_secure); // SMTP secure mode (ssl/tls)
define('SMTP_SENDER',$settings->smtp_sender); // SMTP sender email

//Coinpayments
define('COINPRIVATE',$settings->coin_pv); // Private Key
define('COINPUPLIC',$settings->coin_pb); // Public Key
define('COINMID',$settings->coin_mid); // Merchant ID
define('COINMSEC',$settings->coin_sec); // Merchant Secret Key
define('COINCUR',$settings->coin_cur1); // Original currency (Default: DOGE)
define('COINCUR2',$settings->coin_cur2); // The currency the buyer will be sending (Default: DOGE)
define('COINHASH',$settings->coin_hash); // Security hash to confirm transactions. This field will be encripted with md5()

//Format currency
function currencyFormat($value){
    return number_format($value, DECIMALS, '.','');
}