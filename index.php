<?php
    require_once '_header.php';

    if(isset($_SESSION['id'])) {
        header('Location: dashboard.php');
    }

    if(isset($_GET['refer']) && $_GET['refer'] != "")
    {
        $reference_user_id = (int)$_GET['refer'];
        if(is_int($reference_user_id)){$_SESSION['reference_id'] = $reference_user_id;}
    }

    if(isset($_POST['username'])) {

        if(isset($_POST['reference_user_id']) && $_POST['reference_user_id'] !="")
        {
            $reference_user_id = $_POST['reference_user_id'];
        }
        else
        {
            $reference_user_id = 0; 
        }

        $username = trim(strip_tags($_POST['username']));
        $res = getUser($username);
        if($res) {
            $_SESSION = $res;
        } else {
            $user_ip_addr = getRealIpAddr();
            addUser($username, $reference_user_id, $user_ip_addr);
            $res = getUser($username);
            $_SESSION = $res;
        }
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />';
    }

    $allplans = getAllPlans();
    $totalUsers = totalUsers();
    $totalDeposits = totalDeposits();
    $totalPaid = totalPaid();
?>
    <div id="header-home-content">
        <div class="container">
            <div class="row" id="header-home-content-txt">
                <h3>Welcome to <?php echo CURNAME;?> (<?php echo CURCOD;?>) Mining Pool service in the cloud</h3>
                <span>Set up your account, start earning coins from our <?php echo CURNAME;?> (<?php echo CURCOD;?>) mining pool service in the cloud!</span>
                <div class="text-center" style="margin-bottom: 10px">
                    <?php include_once '_social.php'; ?>
                </div>
            </div><!-- header-home-content-txt -->
            <!-- header-home-content-form input -->
            <div class="row" id="header-home-content-form">
                <span>Set up a new account</span>
                <form action="#" method="post" onsubmit="sign(2);return(false)">
					<input type="hidden" name="reference_user_id"  value="<?php echo (isset($reference_user_id))?$reference_user_id:""; ?>">
                    <input type="text" minlength="<?php echo WALLET_MINCH;?>" maxlength="<?php echo WALLET_MAXCH;?>" pattern="[a-zA-Z0-9_-]+" name="username" id="username" placeholder="Enter your <?php echo CURNAME;?> address">
                    <button onclick="return validateFormLogin()">Start Mining</button>
                </form>
                <div id="result"></div>
            </div>
            <!-- header-home-content-form input -->
        </div><!-- container -->
        <div id="div-error"><span class="div-error"></span></div>
        <div id="header-bar">
            <div class="container">
                <?php foreach($allplans as $plan): if($plan['is_default']==1): ?>
                    <div class="row">
                        <div class="col-md-5" id="header-bar-1">
                            <strong>Version <?php echo $plan['version'];?></strong>
                        </div>
                        <div class="col-md-7" id="header-bar-2">
                            <div id="header-bar-2-left">
                                <span>EARNING RATE</span>
                                <strong><?php echo $plan['earning_rate'];?> <?php echo CURCOD;?>/MIN</strong>
                            </div>
                            <div id="header-bar-2-right">
                                <span>PROFIT PER DAY</span>
                                <strong><?php echo $plan['point_per_day'];?> <?php echo CURCOD;?></strong>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div><!-- container -->
        </div><!-- header-bar -->

    </div><!-- header-home-content -->
    </div><!-- header-home -->
    <div class="clear"></div>


    <div id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="home-content-text">
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
                            <button class="premium"><?php echo currencyFormat($plan['price']);?> <?php echo CURSYM;?></button>
                        </div><!-- box-price-content -->
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div><!-- container -->
    </div><!-- page -->
<?php include '_footer.php' ?>