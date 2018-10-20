<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$_table = 'urlchains';
$_url = 'urlchains.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}

if($_GET['action']=='delete' && isset($_GET['id'])){
    $ID = (int)$_GET['id'];
    $check = getChainById($ID);
    if($check==1){
        deleteChain($ID);
        $success = 'Blockchain url deleted with success!';
        echo '<meta http-equiv="refresh" content="0.5; url=urlchains.php" />';
    }
}
$chains = getPagination($_table,$pag*PAGINATION,PAGINATION,'ASC');
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Blockchain Explorer URL's</li>
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
                <h1 class="h3 display">URL's List</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-success btn-sm" href="urlchains_add.php"><i class="fa fa-plus"></i> Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($chains): ?>
                                        <?php foreach ($chains as $chain): ?>
                                            <tr>
                                                <td><?php echo $chain['id']; ?></td>
                                                <td><?php echo $chain['name']; ?></td>
                                                <td><?php echo $chain['url']; ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-xs"
                                                       href="urlchains_edit.php?id=<?php echo $chain['id']; ?>"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    <a class="btn btn-danger btn-xs"
                                                       href="urlchains.php?action=delete&id=<?php echo $chain['id']; ?>"><i
                                                                class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No results</td>
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