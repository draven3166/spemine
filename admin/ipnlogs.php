<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
$_table = 'inp_errors';
$_url = 'ipnlogs.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}
$listerrors = getPagination($_table,$pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">IPN Logs</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">IPN Log Errors</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($listerrors): ?>
                                        <tr>
                                        <?php foreach ($listerrors as $trs): ?>
                                            <td><?php echo $trs['id']; ?></td>
                                            <td><?php echo $trs['message']; ?></td>
                                            <td>
                                                <?php
                                                    $status = $trs['status'];
                                                    if($status=='0'){
                                                        echo '<span class="badge badge-danger">Unpaid</span>';
                                                    }
                                                    elseif($status=='2' OR $status=='100'){
                                                        echo '<span class="badge badge-success">Paid</span>';
                                                    }else{
                                                        echo '<span class="badge badge-warning">'.$status.'</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $trs['created_at']; ?></td>
                                            <td><a class="btn btn-xs btn-info" href="ipnlogView.php?id=<?php echo $trs['id']; ?>"><i class="fa fa-eye"></i> View</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No results</td>
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