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
                <form role="form" action="install4.php" method="post" class="f1">
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="56.66" data-number-of-steps="4" style="width: 56.66%;"></div>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-server"></i></div>
                            <p>Connection</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-database"></i></div>
                            <p>DB Import</p>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-cogs"></i></div>
                            <p>Settings</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-flag-checkered"></i></div>
                            <p>Done</p>
                        </div>
                    </div>

                    <fieldset>
                        <h4><b>Admin Settings</b></h4>
                        <div class="form-group">
                            <label>Admin Username</label>
                            <input type="text" name="username" placeholder="Admin username" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Admin Password</label>
                            <input type="text" name="password" placeholder="Admin password" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Admin Pagination</label>
                            <input type="number" step="1" name="pagination" placeholder="Results per page" value="10" class="f1-first-name form-control" required />
                        </div>
                        <h4><b>Site Settings</b></h4>
                        <div class="form-group">
                            <label>Site Name</label>
                            <input type="text" name="sitename" placeholder="Site name" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Site Description</label>
                            <input type="text" name="description" placeholder="Site meta description" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Site Keywords</label>
                            <input type="text" name="keywords" placeholder="Site meta keywords" class="f1-first-name form-control" required />
                        </div>
                        <h4><b>Limits Settings</b></h4>
                        <div class="form-group">
                            <label>Min Withdraw</label>
                            <input type="text" name="min_with" placeholder="Min withdraw" value="50.00000000" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Min Affiliate Withdraw</label>
                            <input type="text" name="min_af_with" placeholder="Min affiliate withdraw" value="10.00000000" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Max Withdraw</label>
                            <input type="text" name="max_with" placeholder="Max withdraw" value="1000.00000000" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Affiliate Comission (%)</label>
                            <input type="number" step="1" name="comission" placeholder="Affiliate Comission percentage" value="2" class="f1-first-name form-control" required />
                        </div>
                        <h4><b>Currency Settings</b></h4>
                        <div class="form-group">
                            <label>Currency Name</label>
                            <input type="text" name="cur_name" placeholder="Currency name" value="Dogecoin" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Currency Symbol</label>
                            <input type="text" name="cur_sym" placeholder="Currency symbol" value="Đ" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Currency Code</label>
                            <input type="text" name="cur_code" placeholder="Currency code" value="DOGE" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Decimals Numbers</label>
                            <input type="number" step="1" name="decimals" placeholder="Number of decimals" value="8" class="f1-first-name form-control" required />
                        </div>
                        <h4><b>CoinPayments Settings</b></h4>
                        <div class="form-group">
                            <label>Private Key</label>
                            <input type="text" name="pvk" placeholder="API Private Key" class="f1-first-name form-control" required />
                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
                        </div>
                        <div class="form-group">
                            <label>Public Key</label>
                            <input type="text" name="pbk" placeholder="API Public Key" class="f1-first-name form-control" required />
                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
                        </div>
                        <div class="form-group">
                            <label>Merchant ID</label>
                            <input type="text" name="mid" placeholder="Merchant ID" class="f1-first-name form-control" required />
                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Can be found on 'Basic Settings' tab.</small>
                        </div>
                        <div class="form-group">
                            <label>IPN Secret</label>
                            <input type="text" name="ipnsec" placeholder="IPN Secret" class="f1-first-name form-control" required />
                            <small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Set this on 'Merchant Settings' tab, IPN Secret Key.</small>
                        </div>
                        <div class="form-group">
                            <label>Site Currency</label>
                            <input type="text" name="currency1" placeholder="Site Currency" value="DOGE" class="f1-first-name form-control" required />
                            <small class="help-block">See more about <b>currency1</b> field <a href="https://www.coinpayments.net/apidoc-create-transaction" target="_blank">here</a>.</small>
                        </div>
                        <div class="form-group">
                            <label>Receiver Currency</label>
                            <input type="text" name="currency2" placeholder="Receiver Currency" value="DOGE" class="f1-first-name form-control" required />
                            <small class="help-block">See more about <b>currency2</b> field <a href="https://www.coinpayments.net/apidoc-create-transaction" target="_blank">here</a>.</small>
                        </div>
                        <div class="form-group">
                            <label>Transactions Security Hash</label>
                            <input type="text" name="hash" placeholder="Security Hash" value="3ncrypt3dh4ash@" class="f1-first-name form-control" required />
                            <small class="help-block">Your security hash to encrypt transactions.</small>
                        </div>
                        <h4><b>Mail Settings</b></h4>
                        <div class="form-group">
                            <label>SMTP Hostname</label>
                            <input type="text" name="smtp_host" placeholder="SMTP Hostname" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>SMTP Username</label>
                            <input type="text" name="smtp_user" placeholder="SMTP Username" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>SMTP Password</label>
                            <input type="text" name="smtp_pass" placeholder="SMTP Password" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>SMTP Port Number</label>
                            <input type="number" step="any" name="smtp_port" placeholder="SMTP Port Number" class="f1-first-name form-control" required />
                        </div>
                        <div class="form-group">
                            <label>SMTP Security</label>
                            <select name="smtp_secur" class="f1-first-name form-control" required>
                                <option value="ssl">SSL</option>
                                <option value="tsl">TSL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>SMTP Sender Mail</label>
                            <input type="text" name="smtp_sender" placeholder="SMTP Sender mail address" class="f1-first-name form-control" required />
                        </div>
                        <div class="f1-buttons">
                            <a href="install2.php" class="btn btn-default">Back</a>
                            <button type="submit" class="btn btn-next">Continue</button>
                        </div>
                    </fieldset>
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