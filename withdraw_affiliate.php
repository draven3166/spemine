<?php
	require_once '_header.php';
    if (empty($_SESSION['id'])) { echo '<meta http-equiv="refresh" content="0; url=index.php" />'; }

	// GET the total Earning Balance
    $balance = getUserComissions($_SESSION);
    $arr_withdrawals = get_withdrawals('affiliate','pending');
    $total_withdrawal =  0;

    foreach ($arr_withdrawals as $key => $value)
    {
        $total_withdrawal +=  $value['amount'];
    }

    // GET the total Earning Balance
    $total_balance =  number_format($balance - $total_withdrawal,8,'.','');
	$withdraw_limit = MAXWTHD;

	if(isset($_POST['withdraw_amount']) && $_POST['withdraw_amount']!="") 
	{
		$withdraw_amount = number_format($_POST['withdraw_amount'],8,'.','');
		if($total_balance >= $withdraw_amount)
		{
			if($withdraw_amount < MINAFWTHD)
            {
                $ErrorMessage = "Min Withdraw is: ".MINAFWTHD." ".CURCOD;
            }
			elseif($withdraw_amount <= $withdraw_limit)
			{
				$status = request_withdrawal($withdraw_amount,'affiliate');
				$SuccessMessage = "Withdraw requested successfully!!";
				header('Location:account.php#withdraws');
			}
			else
			{
                $ErrorMessage = "Unable to withdraw. Please enter the amount less than the withdrawal limit.";
			}
		}
		else
		{
            $ErrorMessage = "You don't have enough earning blance to withdraw the given amount!!";
		}
	}
?>
    <div id="header-content">
        <span>Request Affiliate Withdraw</span>
        <p>Request withdraw of your affiliate earnings to your <?php echo CURNAME;?> Wallet.</p>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

    </div><!-- header-page -->
    <div class="clear"></div>

    <div id="pages">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Your earning balance: <?php echo $total_balance;?></h2>
                    <br>
                    <?php if($ErrorMessage): ?>
                        <div class="alert alert-danger">
                            <?php echo $ErrorMessage; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($SuccessMessage): ?>
                        <div class="alert alert-success">
                            <?php echo $SuccessMessage; ?>
                        </div>
                    <?php endif; ?>
                    <br>
                    <div class="col-md-6">
                        <div class="alert alert-success"><b>Min:</b> <?php echo MINAFWTHD; ?> <?php echo CURCOD;?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-danger"><b>Max:</b> <?php echo $withdraw_limit; ?> <?php echo CURCOD;?></div>
                    </div>
                    <form id="data-form" id="frm_withdraw" action="withdraw_affiliate.php" method="POST">
                        <div class="form-group">
                            <label>Amount to Withdraw</label>
                            <input type="number" step="any" name="withdraw_amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Wallet Address</label>
                            <input value="<?php echo $_SESSION['username'];?>" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Confirm Withdraw</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once '_footer.php'; ?>