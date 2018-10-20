<?php
require_once '_header.php';
global $conn;

//Get latest payouts
$payments = getPayoutsList();

//Get latest deposits
$deposits = getDepositsList();

$totalpayments = sumWithdraws();
?>
    <div id="header-content">
        <span>Payouts</span>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

    </div><!-- header-page -->
    <div class="clear"></div>

    <div id="pages"><div class="container">

            <div class="row">
                <div class="col-md-12 text-center">
                    <p>We are experts in the field of trading and investment of <?php echo CURNAME;?>, and we're want to share our best practice with EVERYONE! <?php echo CURNAME;?> market capitalization growing everyday. Don't miss your chance to earn on this wave. Join our team now!</p>
                    <div class="alert alert-info text-center">Estimated total payouts of <b><?php echo $totalpayments;?> <?php echo CURCOD;?></b> since launch date!</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">10 Last Payouts</h2>
                    <div class="table-responsive" id="payouts">
                        <table class="table pages-table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Address</th>
                                <th>TXID</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($payments): ?>
                                <?php foreach($payments as $pmt): ?>
                                    <tr>
                                        <td><?php echo $pmt['date_paid'];?></td>
                                        <td style="color:#00cc00;"><?php echo $pmt['amount'];?> <?php echo CURSYM;?></td>
                                        <td><?php echo substr($pmt['wallet'],0,20);?><b>XXXX</b></td>
                                        <td><a href="<?php echo blockchainUrl($pmt['tx']);?>" target="_blank"><?php echo substr($pmt['tx'],0,20);?><b>XXXX</b></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr align="center">
                                    <td colspan="4" class="text-center">No results!</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">10 Last Deposits</h2>
                        <div class="table-responsive">
                            <table class="table pages-table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Address</th>
                                    <th>TXID</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($deposits): ?>
                                    <?php foreach($deposits as $dps): ?>
                                        <tr>
                                            <td><?php echo $dps['date_paid'];?></td>
                                            <td style="color:#00cc00;"><?php echo $dps['amount'];?> <?php echo CURSYM;?></td>
                                            <td><?php echo substr($dps['wallet'],0,20);?><b>XXXX</b></td>
                                            <td><?php echo substr($dps['tx'],0,20);?><b>XXXX</b></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr align="center">
                                        <td colspan="4" class="text-center">No results!</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- container -->
    </div><!-- page -->
<?php require_once '_footer.php'; ?>