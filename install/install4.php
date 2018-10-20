<?php
require_once 'const.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo SC_NAME; ?> - Install Wizard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"/>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="assets/css/form-elements.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png"/>
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png"/>

</head>

<body>

<!-- Top menu -->
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
</nav>

<!-- Top content -->
<div class="top-content">
    <div class="container">

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text">
                <h1><?php echo SC_NAME; ?> - <strong>Install Wizard</strong></h1>
                <div class="description">
                    <p>
                        This wizard will help you to install <strong><?php echo SC_NAME; ?></strong>.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                <form role="form" action="" method="post" class="f1">
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="100" data-number-of-steps="4" style="width: 100%;"></div>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-server"></i></div>
                            <p>Connection</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-database"></i></div>
                            <p>DB Import</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-cogs"></i></div>
                            <p>Settings</p>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-flag-checkered"></i></div>
                            <p>Done</p>
                        </div>
                    </div>
                    <?php
                    $admin = $_POST['username'];
                    $pass = $_POST['password'];
                    $pagination = $_POST['pagination'];
                    $sitename = $_POST['sitename'];
                    $description = $_POST['description'];
                    $keywords = $_POST['keywords'];
                    $min_with = $_POST['min_with'];
                    $min_af_with = $_POST['min_af_with'];
                    $max_with = $_POST['max_with'];
                    $comission = $_POST['comission'];
                    $cur_name = $_POST['cur_name'];
                    $cur_sym = $_POST['cur_sym'];
                    $cur_code = $_POST['cur_code'];
                    $decimals = $_POST['decimals'];
                    $pvk = $_POST['pvk'];
                    $pbk = $_POST['pbk'];
                    $mid = $_POST['mid'];
                    $ipnsec = $_POST['ipnsec'];
                    $currency1 = $_POST['currency1'];
                    $currency2 = $_POST['currency2'];
                    $hash = $_POST['hash'];
                    $smtp_host = $_POST['smtp_host'];
                    $smtp_user = $_POST['smtp_user'];
                    $smtp_pass = $_POST['smtp_pass'];
                    $smtp_port = $_POST['smtp_port'];
                    $smtp_secur = $_POST['smtp_secur'];
                    $smtp_sender = $_POST['smtp_sender'];
                    if(!empty($admin) && !empty($pass) && !empty($pagination) && !empty($sitename) && !empty($description) && !empty($keywords) && !empty($min_with) && !empty($min_af_with) && !empty($max_with) && !empty($comission) && !empty($cur_name) && !empty($cur_sym) && !empty($cur_code) && !empty($decimals) && !empty($pvk) && !empty($pbk) && !empty($mid) && !empty($ipnsec) && !empty($currency1) && !empty($currency2) && !empty($hash) && !empty($smtp_host) && !empty($smtp_user) && !empty($smtp_pass) && !empty($smtp_port) && !empty($smtp_secur) && !empty($smtp_sender)){

                        try{
                            $stmt = $conn->prepare("INSERT into settings 
(`sitename`, `keywords`, `description`, `pagination`, `min_withdraw`, `min_aff_withdraw`, `max_withdraw`, `aff_comission`, `currency_name`, `currency_symbol`, `currency_code`, `currency_decimals`, `coin_pv`, `coin_pb`, `coin_mid`, `coin_sec`, `coin_cur1`, `coin_cur2`, `coin_hash`, `username`, `password`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_secure`, `smtp_sender`) VALUES 
(:sitename, :keywords, :description, :pagination, :min_withdraw, :min_aff_withdraw, :max_withdraw, :aff_comission, :currency_name, :currency_symbol, :currency_code, :currency_decimals, :coin_pv, :coin_pb, :coin_mid, :coin_sec, :coin_cur1, :coin_cur2, :coin_hash, :username,  :password,  :smtp_host,  :smtp_user,  :smtp_pass,  :smtp_port,  :smtp_secure,  :smtp_sender)");

                            $min_with = number_format($min_with,$decimals,'.','');
                            $min_af_with = number_format($min_af_with,$decimals,'.','');
                            $max_with = number_format($max_with,$decimals,'.','');

                            $stmt->bindParam(':sitename',$sitename );
                            $stmt->bindParam(':keywords',$keywords );
                            $stmt->bindParam(':description',$description );
                            $stmt->bindParam(':pagination',$pagination );
                            $stmt->bindParam(':min_withdraw',$min_with );
                            $stmt->bindParam(':min_aff_withdraw',$min_af_with );
                            $stmt->bindParam(':max_withdraw',$max_with );
                            $stmt->bindParam(':aff_comission',$comission );
                            $stmt->bindParam(':currency_name',$cur_name );
                            $stmt->bindParam(':currency_symbol',$cur_sym );
                            $stmt->bindParam(':currency_code',$cur_code );
                            $stmt->bindParam(':currency_decimals',$decimals );
                            $stmt->bindParam(':coin_pv',$pvk );
                            $stmt->bindParam(':coin_pb',$pbk );
                            $stmt->bindParam(':coin_mid',$mid );
                            $stmt->bindParam(':coin_sec',$ipnsec );
                            $stmt->bindParam(':coin_cur1',$currency1 );
                            $stmt->bindParam(':coin_cur2',$currency2 );
                            $stmt->bindParam(':coin_hash',$hash );
                            $stmt->bindParam(':username',$admin );
                            $stmt->bindParam(':password',md5($pass) );
                            $stmt->bindParam(':smtp_host',$smtp_host );
                            $stmt->bindParam(':smtp_user',$smtp_user );
                            $stmt->bindParam(':smtp_pass',$smtp_pass );
                            $stmt->bindParam(':smtp_port',$smtp_port );
                            $stmt->bindParam(':smtp_secure',$smtp_secur );
                            $stmt->bindParam(':smtp_sender',$smtp_sender );
                            $stmt->execute();
                        }
                        catch (PDOException $e){
                            $errors = "Error: " . $e->getMessage();
                        }
                    ?>
                        <?php if(!$errors):?>
                        <fieldset>
                            <h4>Installation Complete!</h4>

                            <p>Now you can start using your new site.</p>
                            <p>You can access the administration at the link below.</p>
                            <p><a href="../admin/" class="btn btn-info">Go to Admin</a></p>
                            <p class="alert alert-warning"><strong>Tip:</strong> We strongly recommend renaming the folder <strong>admin</strong> to another name of your choice, to ensure greater security against hackers.</p>
                            <p class="alert alert-danger"><strong>Notice:</strong> Remember to delete the folder <strong>install</strong> to prevent you or anyone from trying to reinstall the system and compromise your site's data.</p>
                            <div class="f1-buttons">
                                <a href="../" class="btn btn-success">Go to Site</a>
                            </div>
                        </fieldset>
                        <?php else: ?>
                        <h4>OPS!</h4>
                        <p>It looks like something went wrong with the installation. Try again.</p>
                        <div class="alert alert-danger"><?php echo $errors;?></div>
                        <a href="install3.php" class="btn btn-success">Back</a>
                        <?php endif; ?>
                    <?php }else{ ?>
                    <fieldset>
                        <h4>OPS!</h4>
                        <p>It looks like something went wrong with the installation. Try again.</p>
                        <a href="install3.php" class="btn btn-success">Back</a>
                </div>
                </fieldset>
            <?php } ?>
            </form>
        </div>
    </div>

</div>
</div>


<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>