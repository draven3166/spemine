<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

if (isset($_POST['name'])) {
    if ($_POST['name'] && isset($_POST['url'])) {
        addNewChain($_POST);
        $success = 'New blockchain url created with success!';
    } else {
        $error = "Please fill all required fields";
    }
}
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="urlchains.php">Blockchain Explorer URL's</a></li>
                <li class="breadcrumb-item active">Add Tracking URL</li>
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
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <?php endif; ?>
                <h1 class="h3 display">Add Tracking URL</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php BASE_PATH; ?>urlchains_add.php" method="POST">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Site Name" required>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="url" id="url" class="form-control" name="url" placeholder="Tracking URL" required>
                                    <small class="help-block">Eg: https://dogechain.info/tx/. In your site will be: https://dogechain.info/tx/YourPaymentTansactionId</small>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>