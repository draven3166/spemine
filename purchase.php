<?php
include_once '_header.php';
require_once 'includes/coinpayments.inc.php';
if (empty($_SESSION['id'])) { echo '<meta http-equiv="refresh" content="0; url=index.php" />'; }

// Check if plan exists
$planId = (int)$_GET['plan'];
$planData = getPlanById($planId);

// Redirect if plan not found
if(count($planData)==0){ echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />'; }

$secureUrl = ($_SERVER['HTTPS'] == "on" ? 'https://' : 'http://');
$ipnURL = $secureUrl.$_SERVER['SERVER_NAME'].'/ipnCoinpayments.php';

// Start Create a new Payment
$cps = new CoinPaymentsAPI();
$cps->Setup(COINPRIVATE, COINPUPLIC);

$hash = md5(COINHASH.time());
$req = array(
    'amount' => $planData->price,
    'currency1' => COINCUR,
    'currency2' => COINCUR2,
    'item_name' => 'Purchase of Mining Plan '.$planData->version.' on '.SITENAME,
    'item_number' => $planData->id,
    'custom' => $hash,
    'ipn_url' => $ipnURL,
);

$result = $cps->CreateTransaction($req);
if ($result['error'] == 'ok') {
    $totalAmount = sprintf('%.08f', $result['result']['amount']);
    $Address = $result['result']['address'];
    $Confirmations = $result['result']['confirms_needed'];
    $TimeOut = $result['result']['timeout'];
    $QRIMG = $result['result']['qrcode_url'];
    $StatusUrl = $result['result']['status_url'];
} else {
    echo $result['error']."\n";
}
// End Payment Creation

// Create new transaction
createTransaction($_SESSION['uid'],$planData->id,$totalAmount,$hash);
?>
    <div id="header-content">
        <span>Purchase Plan</span>
        <p>Congratulations on your decision to invest in our project and get more profit with a paid mining plan!</p>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

    </div><!-- header-page -->
    <div class="clear"></div>

    <div id="pages">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2>Complete Your Purchase</h2>
                        </div>
                        <div class="panel-body">
                            <p class="list-group-item"><b>Purchase Item:</b> Mining <?php echo $planData->version; ?></p>
                            <p class="list-group-item"><b>Purchase Price:</b> <?php echo $planData->price; ?> <?php echo CURCOD;?></p>
                            <p class="list-group-item"><b>Payment Address:</b>
                                <input class="form-control" onclick="this.select();" value="<?php echo $Address;?>" readonly>
                                <span class="help-block">* Click to select all</span>
                            </p>
                            <p class="list-group-item">
								<b>Instructions:</b><br>
								Send exactly <b><?php echo $totalAmount; ?></b> <?php echo CURNAME;?> to above address.<br><br>
                                <b>Confirmations:</b><br>
                                <?php echo $Confirmations;?> confirmations required to accept your payment.<br><br>
                                <b>Timeout:</b><br>
                                You have <b><?php echo gmdate ('H:i:s',$TimeOut);?></b> minutes to pay your purchase.<br><br>
                                <b>QRCODE:</b><br>
                                You can scan this QR code with your mobile wallet app to make a payment.<br><br>
                                <b>Status:</b><br>
                                You can track the status of your payment at the link below.<br>
                                <a href="<?php echo $StatusUrl; ?>" target="_blank" class="btn btn-info"><i class="fa fa-clock-o"></i> Payment Status</a>
                            </p>
                            <p>
                            <div class="text-center">
                                <br>
                                <img src="<?php echo $QRIMG; ?>" alt="QrCode" style="width: 300px; height: 300px" class="img-thumbnail" />
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once '_footer.php'; ?>