<?php
	require_once '_header.php';

    if (empty($_SESSION['id'])) { echo '<meta http-equiv="refresh" content="0; url=index.php" />';}
	$arr_withdrawals = get_withdrawals();
	$arr_affwithdrawals = get_withdrawals('affiliate');
	$alldeposits = get_deposits();

	$total_withdrawal =  0;
	foreach ($arr_withdrawals as $key => $value)
	{
		$total_withdrawal +=  $value['amount'];
	}

	$arr_reference_users = getAllReferenceUsers($_SESSION['uid']);
	$arr_comissions = getComissions($_SESSION['uid']);
    // Check if user has transactions pending
    $transactionsList = UserTransactions($_SESSION['uid']);
?>
    <div id="header-content">
        <span>Account</span>
        <p>All history of your account, deposits, withdraws, referrals and comissions.</p>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

</div><!-- header-page -->
    <div class="clear"></div>

    <div id="pages">
        <div class="container">
            <div style="margin-top: -60px;" class="row">
                <div class="col-md-12 text-center" id="content-text">
                    <h2 class="purple">Your wallet address:</h2>
                    <h3><strong class="orange"><?php echo $_SESSION['username'];?></strong></h3>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel with-nav-tabs">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#refs" data-toggle="tab">Referrals</a></li>
                                <li><a href="#comissions" data-toggle="tab">Affiliate Earns</a></li>
                                <li><a href="#deposits" data-toggle="tab">Deposits</a></li>
                                <li><a href="#withdraws" data-toggle="tab">Withdraws</a></li>
								<li><a href="#affwithdraws" data-toggle="tab">Affiliate Withdraws</a></li>
								<li><a href="#transactions" data-toggle="tab">Pending Purchases</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- START REFS -->
                                <div role="tabpanel" class="tab-pane active" id="refs">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Name</td>
                                                <th>Date of Joining</td>
                                                <th>Deposits</td>
                                                <th>IP Address</td>
                                            </tr>
                                            <?php
                                            if(count($arr_reference_users) > 0)
                                            {
                                                foreach ($arr_reference_users as $key => $value)
                                                {
                                                    ?>
                                                    <tr>
														<td><?php echo substr($value['username'],0,15); ?><b>xxxx</b></td>
                                                        <td><?php echo $value['created_at']; ?></td>
                                                        <td><?php echo getReferenceDeposits($value['id']); ?></td>
                                                        <td><?php echo $value['ip_addr']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END REFS -->
                                <!-- START COMISSIONS -->
                                <div role="tabpanel" class="tab-pane" id="comissions">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Date</td>
                                                <th>Amount</td>
                                                <th>Status</td>
                                            </tr>
                                            <?php
                                            if(count($arr_comissions) > 0)
                                            {
                                                foreach ($arr_comissions as $key => $value)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['date']; ?></td>
                                                        <td><?php echo $value['amount']; ?> <?php echo CURSYM;?></td>
                                                        <td>
                                                            <?php if($value['status']=='pending'): ?>
                                                                <span class="label label-danger"><?php echo ucfirst($value['status']); ?></span>
                                                            <?php elseif($value['status']=='paid'): ?>
                                                                <span class="label label-success"><?php echo ucfirst($value['status']); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END COMISSIONS -->
                                <!-- START DEPOSITS -->
                                <div role="tabpanel" class="tab-pane" id="deposits">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Date</td>
                                                <th>Deposit Amount</td>
                                                <th>TXID</td>
                                                <th>Status</td>
                                            </tr>
                                            <?php
                                            if(count($alldeposits) > 0)
                                            {
                                                foreach ($alldeposits as $key => $value)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['created_at']; ?></td>
                                                        <td><?php echo $value['amount']; ?> <?php echo CURSYM;?></td>
                                                        <td><?php echo $value['tx']; ?></td>
                                                        <td>
															<?php if($value['status']=='PENDING'): ?>
																<span class="label label-danger">Pending</span>
															<?php elseif($value['status']=='SUCCESS'): ?>
																<span class="label label-success">Paid</span>
															<?php else: ?>
																<span class="label label-warning"><?php echo ucfirst($value['status']); ?></span>
															<?php endif; ?>
														</td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END DEPOSITS -->
                                <!-- START WITHDRAWS -->
                                <div role="tabpanel" class="tab-pane" id="withdraws">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Date</td>
                                                <th>Withdrawal Amount</td>
                                                <th>TXID</td>
                                                <th>Status</td>
                                            </tr>
                                            <?php
                                            if(count($arr_withdrawals) > 0)
                                            {
                                                foreach ($arr_withdrawals as $key => $value)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['created_at']; ?></td>
                                                        <td><?php echo $value['amount']; ?> <?php echo CURSYM;?></td>
                                                        <td><a href="<?php echo blockchainUrl($value['tx']); ?>" target="_blank"><?php echo $value['tx']; ?></a></td>
                                                        <td>
															<?php if($value['status']=='PENDING'): ?>
																<span class="label label-danger">Pending</span>
															<?php elseif($value['status']=='SUCCESS'): ?>
																<span class="label label-success">Paid</span>
															<?php else: ?>
																<span class="label label-warning"><?php echo ucfirst($value['status']); ?></span>
															<?php endif; ?>
														</td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END WITHDRAWS -->
								<!-- START AFF WITHDRAWS -->
                                <div role="tabpanel" class="tab-pane" id="affwithdraws">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Date</td>
                                                <th>Withdrawal Amount</td>
                                                <th>TXID</td>
                                                <th>Status</td>
                                            </tr>
                                            <?php
                                            if(count($arr_affwithdrawals) > 0)
                                            {
                                                foreach ($arr_affwithdrawals as $key => $value)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['created_at']; ?></td>
                                                        <td><?php echo $value['amount']; ?> <?php echo CURSYM;?></td>
                                                        <td><a href="<?php echo blockchainUrl($value['tx']); ?>" target="_blank"><?php echo $value['tx']; ?></a></td>
                                                        <td>
															<?php if($value['status']=='PENDING'): ?>
																<span class="label label-danger">Pending</span>
															<?php elseif($value['status']=='SUCCESS'): ?>
																<span class="label label-success">Paid</span>
															<?php else: ?>
																<span class="label label-warning"><?php echo ucfirst($value['status']); ?></span>
															<?php endif; ?>
														</td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END AFF WITHDRAWS -->
								<!-- START TRANSACTIONS -->
                                <div role="tabpanel" class="tab-pane" id="transactions">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody class="text-center">
                                            <tr>
                                                <th>Date</td>
                                                <th>Amount</td>
                                                <th>Status</td>
                                            </tr>
                                            <?php
                                            if(count($transactionsList) > 0)
                                            {
                                                foreach ($transactionsList as $value)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value['date']; ?></td>
                                                        <td><?php echo $value['amount']; ?> <?php echo CURSYM;?></td>
                                                        <td>
															<?php if($value['status']=='pending'): ?>
																<span class="label label-danger">Pending</span>
															<?php elseif($value['status']=='waiting'): ?>
																<span class="label label-warning">Waiting Confirmations</span>
															<?php else: ?>
																<span class="label label-success"><?php echo ucfirst($value['status']); ?></span>
															<?php endif; ?>
														</td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No Records Found !!</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END TRANSACTIONS -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row text-center">
                <h2 class="purple">Your referral link</h2>
            </div>
            <div class="margin-topbottom">
                <div class="row orange-fullwidth text-center" id="url_field" onclick="var addy=$('body').find('#url_field');window.getSelection().selectAllChildren(addy.get(0));">
                    <h3 class="white"><?php echo ($_SERVER['HTTPS'] == "on" ? 'https://' : 'http://').$_SERVER['SERVER_NAME'].BASE_PATH. 'index.php?refer='.$_SESSION['uid']; ?></h3>
                </div>
            </div><!-- margin-topbottom -->

        </div><!-- container -->
    </div><!-- page -->
<?php require_once '_footer.php'; ?>