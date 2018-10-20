<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
session_start();
require_once 'db.php';
if($_SESSION['admin'] or $_SESSION['admin']===1){ header('Location: home.php');}
if(isset($_POST['username'])) {
    if($_POST['username'] === ADMINU && md5($_POST['password']) === ADMINP) {
        $_SESSION['admin'] = 1;
        header('Location: home.php');
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="author" content="Script by SmartyScripts.com">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.red.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>

<div class="page login-page">
    <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
            <div class="form-inner">
                <div class="logo text-uppercase"><span>Administration</span> <strong class="text-primary">Dashboard</strong></div>
                <form action="<?php BASE_PATH;?>index.php" class="text-left form-validate" method="post">
                    <div class="form-group">
                        <?php if($error): ?>
                            <div class="alert alert-danger"><?php echo $error;?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                        <?php endif;?>
                    </div>
                    <div class="form-group-material">
                        <input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                        <label for="login-username" class="label-material">Username</label>
                    </div>
                    <div class="form-group-material">
                        <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                        <label for="login-password" class="label-material">Password</label>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> Login</button>
                    </div>
                </form>
                <br>
                <div class="row">
                    <div class="offset-1 col-md-10">
                        <p class="pull-left">Design by <a href="https://bootstrapious.com" class="external" target="_blank">Bootstrapious</a></p>
                        <p class="pull-right">Script by <a href="https://www.smartyscripts.com" class="external text-bold" target="_blank">Smarty Scripts</a></p>
                        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript files-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Main File-->
<script src="js/front.js"></script>
</body>
</html>