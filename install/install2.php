<?php
require_once 'const.php';
include_once 'connection.php';
if($_POST['import']==1){
    // Name of the file
    $filename = 'database.sql';

    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file_get_contents($filename);
    try{
        // Perform the query
        $smt = $conn->exec($lines);
        $success = 'Success!';
    }
    catch (PDOException $e){
        $errors = "Error: " . $e->getMessage();
    }
}
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
                    	<form role="form" action="install2.php" method="post" class="f1">
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="33.66" data-number-of-steps="4" style="width: 33.66%;"></div>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-server"></i></div>
                    				<p>Connection</p>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-database"></i></div>
                    				<p>DB Import</p>
                    			</div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-cogs"></i></div>
                                    <p>Settings</p>
                                </div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-flag-checkered"></i></div>
                    				<p>Done</p>
                    			</div>
                    		</div>
                    		
                    		<fieldset>
                                <?php if(isset($success)): ?>
                                    <div class="alert alert-success">Database imported successfully! Click on Continue.</div>
                                <?php endif; ?>
                                <?php if(isset($errors)): ?>
                                    <div class="alert alert-danger"><?php echo $errors;?></div>
                                <?php endif; ?>
                                <input type="hidden" name="import" value="1">
                                <?php if(!isset($success)): ?>
                                <button type="submit" class="btn btn-next">Import DB</button>
                                <?php endif; ?>
                                <div class="f1-buttons">
                                    <a href="install.php" class="btn btn-default">Back</a>
                                    <a href="install3.php" class="btn btn-success">Continue</a>
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