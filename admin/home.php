<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$unreadMessages = unreadMessages();
$pendingWithdraws = pendingWithdraws();
$totalUsers = countTotalUsers();
$todayUsers = countTodayUsers();
$totalPlans = countTotalPlans();
$totalDeposits = sumAllDeposits();
$totalWithdrawal = sumAllPayments();
$todayWithdrawal = todayPayments();
$todayDeposits = todayDeposits();
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
    <br>
    <section class="statistics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-calendar"></i></div>
                        <div class="number"><?php echo $pendingWithdraws;?></div><strong class="text-primary">Pending Withdraws</strong>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-envelope"></i></div>
                        <div class="number"><?php echo $unreadMessages;?></div><strong class="text-primary">Unread Messages</strong>
                    </div>
                </div>
            </div>
            <br><div class="row">
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="number"><?php echo $totalUsers;?></div><strong class="text-primary">Total Users</strong>
                        <p><b><?php echo $todayUsers; ?></b> today</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-cubes"></i></div>
                        <div class="number"><?php echo $totalPlans;?></div><strong class="text-primary">Total Plans</strong>
                    </div>
                </div>
            </div>
            <br>
            <div class="row d-flex">
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-bank"></i></div>
                        <div class="number"><?php echo CURSYM;?> <?php echo currencyFormat($totalDeposits);?></div><strong class="text-primary">Total Deposits</strong>
                        <p><b><?php echo CURSYM;?> <?php echo currencyFormat($todayDeposits);?></b> today</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Users -->
                    <div class="card income text-center">
                        <div class="icon"><i class="fa fa-money"></i></div>
                        <div class="number"><?php echo CURSYM;?> <?php echo currencyFormat($totalWithdrawal);?></div><strong class="text-primary">Total Withdraw</strong>
                        <p><b><?php echo CURSYM;?> <?php echo currencyFormat($todayWithdrawal);?></b> today</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
<?php require_once '_footer.php'; ?>