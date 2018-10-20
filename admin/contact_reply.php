<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
require_once 'contact_send.php';
$ID = (int)$_GET['id'];
$wRow = getContactById($ID);

if(!$wRow) { header('Location: contact.php'); }

if ($_POST['id'] && $_POST['reply']) {
    $sendTo = $wRow->email;
    $subject = $wRow->subject;
    $oldMsg = $wRow->message;
    $message = $_POST['reply'];
    $send = sendReply($sendTo,$subject,$oldMsg,$message);
    if($send=='success'){
        updateContact($wRow->id,'replied');
        $successMsg = 'Reply send with success!';
    }else{
        $errorMsg = $send;
    }
}

?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="contact.php">Support Messages</a></li>
                <li class="breadcrumb-item active">Reply Message</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <?php if(isset($successMsg)){ ?>
                <div class="alert alert-success"><?php echo $successMsg; ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                <?php } ?>
                <?php if(isset($errorMsg)){ ?>
                    <div class="alert alert-danger"><?php echo $errorMsg; ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                <?php } ?>
                <h1 class="h3 display">Reply Message</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="contact_reply.php?id=<?php echo $wRow->id; ?>" method="POST">
                                    <input type="hidden" id="id" name="id" value="<?php echo $wRow->id; ?>">
                                    <div class="form-group">
                                        <label>Reply Message</label>
                                        <textarea class="form-control" rows="10" name="reply" placeholder="Write your reply here"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-reply"></i> Send Reply</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>