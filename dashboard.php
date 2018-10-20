<?php
require_once '_header.php';

if (isset($_SESSION['id'])) {

    //calculate balance
    $balance = getBalance($_SESSION);
    $arr_withdrawals = get_withdrawals();
    $total_withdrawal =  0;

    foreach ($arr_withdrawals as $key => $value)
    {
        $total_withdrawal +=  $value['amount'];
    }
	
	updateBalances($balance,$total_withdrawal);

    $balanceAvailable = getUserBalance();

    // GET the total Earning Balance
    $total_balance =  number_format($balanceAvailable,8,'.','');

    //List all Paid Plans
    $allplans = getPaidPlans();

    //Active Plan
    $user = getUserAcPlans($_SESSION['uid']);

    //Calculate user earning rate
    $userEarningRate = 0;
    foreach($user as $key => $value){
        $userEarningRate += $value->earning_rate;
    }
?>
    <div id="header-content">
        <p>Welcome to Litecoin (LTC) Mining Pool service in the cloud!</p>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

    </div><!-- header-page -->
    <div class="clear"></div>
    <div id="header-bar" style="margin-top: -20px;" class="relative orange2"><div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-1" id="header-bar-4">
                    <span id="display-balance">BALANCE - <?php echo CURCOD;?></span>
                    <input type="hidden" id="getBalance" value="<?php echo $total_balance; ?>" />
                    <span id="divamount"><strong id="divamountValue"><font id="bal"><?php echo $total_balance; ?></font></strong> </span>
                </div>
                <div class="col-md-8 margin-top-btn" id="header-bar-2">
                    <div id="header-bar-3-btn" class="button-withdraw">
                        <button id="go-withdraw"  class="btn-stadart btn-white">WITHDRAW</button>
                    </div>
                    <div id="header-bar-3-btn" class="button-withdraw">
                        <button id="go-withdrawAff"  class="btn-stadart btn-blue2">WITHDRAW COMISSIONS</button>
                    </div>
                    <div id="header-bar-3-btn" class="button-account">
                        <button id="go-account" class="btn-stadart btn-purple">ACCOUNT</button>
                    </div>
                    <div id="logout">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- header-bar -->

    <div class="fix-boxes">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Your Active Plans</h2>
                    <div class="text-center">
                        Here are all your active miners, each deposit is a separate miner.
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>Name</th>
                                    <th>Speed</th>
                                    <th>Earning Rate</th>
                                    <th>Start</th>
                                    <th>Life days</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                            $sumCD = 0; $sumER = 0; $sumSP = 0;
                            foreach($user as $key => $plans):
                                $sumER += $plans->earning_rate; $sumSP += $plans->speed; $sumCD += $plans->point_per_day;
                                $duration = $plans->duration;
                                if($duration == 0) {
                                    $leftDays = 'Unlimited';
                                }else{
                                    $now = date_create('now');
                                    $end = date_add(date_create($plans->created_at),date_interval_create_from_date_string($duration.' days'));
                                    $left = date_diff($now,$end);
									$leftDays = $left->days.'d '.$left->h.'h '.$left->i. 'min';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $plans->version; ?></td>
                                    <td><?php echo $plans->speed; ?> H/s</td>
                                    <td><?php echo $plans->earning_rate; ?> <?php echo CURSYM;?></td>
                                    <td><?php echo $plans->created_at; ?></td>
                                    <td ><?php echo $leftDays; ?></td>
                                    <td>
                                        <?php
                                        $sclass = $plans->status == 'active'?'success':'danger';
                                        echo "<span class='label label-{$sclass}'>".ucfirst($plans->status)."</span>";
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="text-center">
                            <tr>
                                <td><b>Totals</b></td>
                                <td><?php echo $sumSP;?> H/s</td>
                                <td colspan="4"><?php echo currencyFormat($sumER);?> <?php echo CURSYM;?> min / <?php echo currencyFormat($sumCD);?> <?php echo CURSYM;?> day</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row text-center default-margin">
                <div class="col-md-12" id="home-content-text-inter">
                    <h4>Upgrade to version Premium</h4>
                    <p>Update your <?php echo SITENAME;?> with these plan and earn more <?php echo CURNAME;?> (<?php echo CURCOD;?>)</p>
                </div>
            </div>
            <div class="row">
                <?php foreach($allplans as $plan): if($plan['is_default']==0): ?>
                    <div class="box-price col-md-3">
                        <div class="box-price-content">
                            <strong>x<?php echo $plan['speed'];?></strong>
                            <span><?php echo $plan['version'];?></span>
                            <p>Speed <strong><?php echo $plan['speed'];?> H/s</strong></p>
                            <p><?php echo $plan['earning_rate'];?> <?php echo CURSYM;?> per minute</p>
                            <p><strong><?php echo $plan['point_per_day'];?> <?php echo CURSYM;?></strong> per day</p>
                            <button onclick="location.href='purchase.php?plan=<?php echo $plan['id'];?>';"><?php echo currencyFormat($plan['price']);?> <?php echo CURSYM;?></button>
                        </div><!-- box-price-content -->
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div><!-- page -->
    </div>
<?php
    include '_footer.php';
} else { echo '<meta http-equiv="refresh" content="0; url=index.php" />'; }
?>