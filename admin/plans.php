<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$_table = 'plans';
$_url = 'plans.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}

if($_GET['action']=='delete' && isset($_GET['id'])){
    $ID = (int)$_GET['id'];
    $check = getPlanById($ID);
    if($check==1){
        deletePlan($ID);
        $success = 'Plan deleted with success!';
        echo '<meta http-equiv="refresh" content="0.5; url=plans.php" />';
    }
}
$plans = getPagination($_table,$pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Plans Management</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
    <div class="container-fluid">
            <header>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <?php endif; ?>
                <h1 class="h3 display">Plans Management</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-success btn-sm" href="plans_add.php"><i class="fa fa-plus"></i> Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Default Plan</th>
                                        <th>Coins Per Day</th>
                                        <th>Version</th>
                                        <th>Earning Rate(min)</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($plans): ?>
                                        <?php foreach ($plans as $plan): ?>
                                            <tr>
                                                <td><?php echo $plan['plan_name']; ?></td>
                                                <td><?php echo $plan['is_default'] ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>'; ?></td>
                                                <td><?php echo CURSYM;?> <?php echo $plan['point_per_day']; ?></td>
                                                <td><?php echo $plan['version']; ?></td>
                                                <td><?php echo CURSYM;?> <?php echo $plan['earning_rate']; ?></td>
                                                <td><?php echo CURSYM;?> <?php echo $plan['price']; ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-xs"
                                                       href="plans_edit.php?id=<?php echo $plan['id']; ?>"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                       href="plans.php?action=delete&id=<?php echo $plan['id']; ?>"><i
                                                                class="fa fa-trash"></i> Delete</a>
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
<?php
require_once('_footer.php');
?>