<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
$_table = 'users';
$_url = 'users.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}
$users = getPagination($_table,$pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Users Management</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Users List</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Users List
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Wallet</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($users): ?>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?php echo $user['id']; ?></td>
                                                <td><?php echo $user['username']; ?></td>
                                                <td>
                                                    <a class="btn btn-xs btn-info" href="<?php echo "userview.php?id=" . $user['id']; ?>"><i class="fa fa-eye"></i> View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No results</td>
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