<?php
session_start();
require_once 'db.php';
require_once 'functions.php';
plansCron($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo SITENAME; ?> - Invest like rich</title>
    <meta name="description" content="<?php echo SITEDESC; ?>">
    <meta name="keywords" content="<?php echo SITEKEYWORDS; ?>">
    <meta name="author" content="Script by SmartyScripts.com">
    <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="site">
    <?php if(filename()=='index.php' or filename()==''): ?>
        <div id="header-home">
    <?php else: ?>
        <div id="header-page">
    <?php endif; ?>

        <div id="menu">
            <div class="container">
                <nav class="navbar navbar-default"><div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-primary" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1><a class="navbar-brand" href="/">Home</a></h1>
                        </div>
                        <div class="collapse navbar-collapse" id="menu-primary">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="affiliate.php">Affiliate Program</a></li>
                                <li><a href="payouts.php">Payouts</a></li>
                                <li><a href="faq.php">Faq</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div><!-- container -->
        </div><!-- menu -->