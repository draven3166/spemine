<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
$_table = 'transactions_history';
$_url = 'transactions.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}
$transactions = getPagination($_table,$pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Transactions History</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Transactions History</h1>
            </header>

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            Transactions List
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Plan ID</th>
                                        <th>Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Status</th>
                                        <th>TXID</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($transactions): ?>
                                        <tr>
                                        <?php foreach ($transactions as $trs): ?>
                                            <td><?php echo $trs['id']; ?></td>
                                            <td><?php echo $trs['user_id']; ?></td>
                                            <td><?php echo $trs['plan_id']; ?></td>
                                            <td><?php echo $trs['amount']; ?></td>
                                            <td><?php echo $trs['paid_amount']; ?></td>
                                            <td>
                                                <?php if($trs['status']=='pending'):?>
                                                    <span class="badge badge-danger">Pending</span>
                                                <?php elseif($trs['status']=='waiting'):?>
                                                    <span class="badge badge-info">Waiting</span>
                                                <?php elseif($trs['status']=='paid'):?>
                                                    <span class="badge badge-success">Paid</span>
                                                <?php endif;?>
                                            </td>
                                            <td><?php echo $trs['txid']; ?></td>
                                            <td><?php echo $trs['date']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No results</td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php echo getPaginationLinks($_table,PAGINATION,$pag+1,$_url); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once ('_footer.php');?>