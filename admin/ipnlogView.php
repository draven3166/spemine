<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$ID = (int)$_GET['id'];
$logRow = get_ipnLogbyId($ID);

if(count($logRow)==0) { echo '<meta http-equiv="refresh" content="0; url=ipnlogs.php" />';}
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="ipnlogs.php">IPN Logs</a></li>
                <li class="breadcrumb-item active">IPN Log Details</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">IPN Log Details</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Basic Details</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <td><?php echo $logRow->created_at;?></td>
                                    </tr>
                                    <tr>
                                        <th>Error Message</th>
                                        <td><?php echo $logRow->message;?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Log Details</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><textarea class="form-control" rows="15"><?php echo json_decode($logRow->content);?></textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>