<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$ID = (int)$_GET['id'];
$userRow = getUserById($ID);
if(count($userRow)==0) { header('Location: users.php');}

$withdraws = get_withdrawals($ID);
$deposits = get_deposits($ID);
$comissions = get_comissions($ID);
$plans = get_activeplans($ID);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="users.php">Users Management</a></li>
                <li class="breadcrumb-item active">User Details</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">User Details</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Basic Details</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Signup Date</th>
                                        <td><?php echo $userRow->created_at;?></td>
                                    </tr>
                                    <tr>
                                        <th>User Wallet</th>
                                        <td><?php echo $userRow->username;?></td>
                                    </tr>
                                    <tr>
                                        <th>Upline ID:</th>
                                        <td><?php echo $userRow->reference_user_id;?></td>
                                    </tr>
                                    <tr>
                                        <th>Affiliate Balance</th>
                                        <td><?php echo $userRow->affiliate_earns;?> <?php echo CURCOD;?></td>
                                    </tr>
                                    <tr>
                                        <th>Affiliate Earnings Paid</th>
                                        <td><?php echo $userRow->affiliate_paid;?> <?php echo CURCOD;?></td>
                                    </tr>
                                </table>
                            </div>

                            <h3>Active Plans</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Plan Name</th>
                                        <th>Status</th>
                                        <th>Active Date</th>
                                        <th>Expire Date</th>
                                    </tr>
                                    <?php if(count($plans) != 0): ?>
                                        <?php foreach($plans as $pl): ?>
                                            <tr>
                                                <td><?php echo $pl['id'];?></td>
                                                <td><?php echo $pl['name'];?></td>
                                                <td>
                                                    <?php
                                                        if($pl['status']=='active'){
                                                            echo "<span class='label label-success'>".ucfirst($pl['status'])."</span>";
                                                        }else{
                                                            echo "<span class='label label-danger'>".ucfirst($pl['status'])."</span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $pl['created_at'];?></td>
                                                <td><?php echo $pl['expire_date'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No results!</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>

                            <h3>Withdraws</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Request Date</th>
                                        <th>Payment Date</th>
                                    </tr>
                                    <?php if(count($withdraws) != 0): ?>
                                        <?php foreach($withdraws as $wt): ?>
                                            <tr>
                                                <td><?php echo $wt['id'];?></td>
                                                <td><?php echo ucfirst($wt['type']);?></td>
                                                <td><?php echo $wt['amount'];?></td>
                                                <td>
                                                    <?php
                                                    if($wt['status']=='SUCCESS'){
                                                        echo "<span class='label label-success'>".ucfirst($wt['status'])."</span>";
                                                    }else{
                                                        echo "<span class='label label-danger'>".ucfirst($wt['status'])."</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $wt['created_at'];?></td>
                                                <td><?php echo $wt['date_paid'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No results!</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>

                            <h3>Deposits</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Request Date</th>
                                        <th>Payment Date</th>
                                    </tr>
                                    <?php if(count($deposits) != 0): ?>
                                        <?php foreach($deposits as $dep): ?>
                                            <tr>
                                                <td><?php echo $dep['id'];?></td>
                                                <td><?php echo $dep['amount'];?></td>
                                                <td>
                                                    <?php
                                                    if($dep['status']=='SUCCESS'){
                                                        echo "<span class='label label-success'>".ucfirst($dep['status'])."</span>";
                                                    }else{
                                                        echo "<span class='label label-danger'>".ucfirst($dep['status'])."</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $dep['created_at'];?></td>
                                                <td><?php echo $dep['date_paid'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No results!</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>

                            <h3>Affiliate History</h3><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                    </tr>
                                    <?php if(count($comissions) != 0): ?>
                                        <?php foreach($comissions as $aff): ?>
                                            <tr>
                                                <td><?php echo $aff['id'];?></td>
                                                <td><?php echo $aff['amount'];?></td>
                                                <td>
                                                    <?php
                                                    if($aff['status']=='paid'){
                                                        echo "<span class='label label-success'>".ucfirst($aff['status'])."</span>";
                                                    }else{
                                                        echo "<span class='label label-danger'>".ucfirst($aff['status'])."</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $aff['date'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No results!</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>