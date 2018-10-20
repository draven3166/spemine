<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

if (isset($_POST['plan_name'])) {
    if ($_POST['plan_name'] && isset($_POST['is_default']) && $_POST['point_per_day'] && $_POST['version'] && $_POST['earning_rate']) {
        addNewPlan($_POST);
        $success = 'New plan created with success!';
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
                <li class="breadcrumb-item"><a href="plans.php">Plans Management</a></li>
                <li class="breadcrumb-item active">Add Plan</li>
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
                <h1 class="h3 display">Add Plan</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php BASE_PATH; ?>plans_add.php" method="POST">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" class="form-control" name="plan_name" placeholder="Plan name" required>
                                </div>
                                <div class="form-control-label">
                                    <label>Is default(Free)</label>
                                </div>
                                <div class="custom-control-inline">
                                    <div class="i-checks">
                                        <input id="is_default1" type="radio" value="1" name="is_default" class="form-control-custom radio-custom">
                                        <label for="is_default1">Yes</label>
                                    </div>
                                    <div class="i-checks">
                                        <input id="is_default0" type="radio" value="0" name="is_default" class="form-control-custom radio-custom" checked>
                                        <label for="is_default0">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Coin per day</label>
                                    <input type="text" id="point_per_day" class="form-control" name="point_per_day" placeholder="Coins per day" required>
                                </div>
                                <div class="form-group">
                                    <label>Version</label>
                                    <input type="text" id="version" class="form-control" name="version" placeholder="Version name" required>
                                </div>
                                <div class="form-group">
                                    <label>Earning Rate (min)</label>
                                    <input type="text" id="earning_rate" class="form-control" name="earning_rate" placeholder="Coins per minute" required>
                                </div>
                                <div class="form-group">
                                    <label>Image File Name</label>
                                    <select class="form-control" name="image">
                                        <option value="">-- SELECT A OPTION --</option>
                                        <?php
                                        $imgsArray = getPlansImages();
                                        foreach($imgsArray as $pimg){
                                            echo '<option value="'.$pimg.'">'.$pimg.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="help-block">You need upload the image in your hosting account or via FTP on <b>img/plans</b> folder</span>
                                </div>
                                <div class="form-group">
                                    <label>Plan Price</label>
                                    <input type="text" id="plan_price" class="form-control" name="price" placeholder="Plan Price" required>
                                </div>
                                <div class="form-group">
                                    <label>Plan Duration (days)</label>
                                    <input type="number" min="1" id="duration" class="form-control" name="duration" placeholder="Plan duration (days)" required>
                                </div>
                                <div class="form-group">
                                    <label>Plan Profit (%)</label>
                                    <input type="number" step="any" id="profit" class="form-control" name="profit" placeholder="Examples: 2 | 5.25" required>
                                </div>
                                <div class="form-group">
                                    <label>Mining Speed</label>
                                    <input type="number" step="any" id="speed" class="form-control" name="speed" placeholder="Mining Speed" required>
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