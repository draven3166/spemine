<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$ID = (int)$_GET['id'];
$chainRow = getChainById($ID);

if(!$chainRow){ echo '<meta http-equiv="refresh" content="0; url=urlchains.php" />';}

if($_POST['action']=='update'){
    updateChain($_POST,$ID);
    $success = 'Blockchain url updated with success!';
    $chainRow = getChainById($ID);
}
?>

    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="urlchains.php">Blockchain Explorer URL's</a></li>
                <li class="breadcrumb-item active">Edit Tracking URL</li>
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
                <h1 class="h3 display">Edit Tracking URL</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php BASE_PATH; ?>urlchains_edit.php?id=<?php echo $_GET['id'];?>" method="POST">
                                <input type="hidden" name="action" value="update">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Site Name" value="<?php echo $chainRow->name;?>" required>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="url" id="url" class="form-control" name="url" placeholder="Tracking URL" value="<?php echo $chainRow->url;?>"  required>
                                    <small class="help-block">Eg: https://dogechain.info/tx/. In your site will be: https://dogechain.info/tx/YourPaymentTansactionId</small>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>