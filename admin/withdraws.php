<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
$_table = 'user_withdrawal';
$_url = 'withdraws.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}
$reqs = getWithdrawRequests($pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Withdraw Requests</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Withdraw Requests</h1>
            </header>

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            Withdraws Request List (<?php echo count($reqs); ?>)
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Wallet</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($reqs): ?>
                                        <tr>
                                        <?php foreach ($reqs as $req): ?>
                                            <td><?php echo $req['id']; ?></td>
                                            <td><?php echo $req['username']; ?></td>
                                            <td><?php echo ucfirst($req['type']); ?></td>
                                            <td><?php echo $req['amount']; ?></td>
                                            <td><?php echo $req['date']; ?></td>
                                            <td>
                                                <?php
                                                $status = $req['status'];
                                                if($status=='PENDING'){
                                                    echo '<span class="label label-danger">Pending</span>';
                                                }
                                                elseif($status=='PROCESSING'){
                                                    echo '<span class="label label-warning">Processing</span>';
                                                }else{
                                                    echo '<span class="label label-success">Paid</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="<?php echo "withdrawEdit.php?id=" . $req['id'] . ""; ?>"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No results</td>
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
<?php require_once '_footer.php'; ?>