<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$ID = (int)$_GET['id'];
$wRow = getWithdrawRequest($ID);

if(count($wRow)==0) { echo '<meta http-equiv="refresh" content="0; url=withdraws.php" />'; }

if ($_POST['id']) {
    updateWithdrawStatus($_POST);
    echo '<meta http-equiv="refresh" content="0; url=withdraws.php" />';
}

?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="withdraws.php">Withdraw Requests</a></li>
                <li class="breadcrumb-item active">Edit Withdraw Request</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Edit Withdraw Request</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                    <form action="withdrawEdit.php" method="POST">
                                        <input type="hidden" id="id" name="id" value="<?php echo $wRow->id; ?>">
                                        <div class="form-group">
                                            <label>User Wallet</label>
                                            <input class="form-control" value="<?php echo $wRow->username;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input class="form-control" value="<?php echo $wRow->amount;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input class="form-control" value="<?php echo ucfirst($wRow->type);?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Transaction ID</label>
                                            <input class="form-control" name="tx" value="<?php echo $wRow->tx;?>" placeholder="Transaction ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">-- SELECT A OPTION --</option>
                                                <option value="SUCCESS" <?php if($wRow->status=='SUCCESS') {echo 'selected';} ?> >Paid</option>
                                                <option value="PENDING" <?php if($wRow->status=='PENDING') {echo 'selected';} ?> >Pending</option>
                                                <option value="PROCESSING" <?php if($wRow->status=='PROCESSING') {echo 'selected';} ?> >Processing</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Request</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>