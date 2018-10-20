<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';

$ID = (int)$_GET['id'];
$wRow = getContactById($ID);

if(count($wRow)==0) { header('Location: contact.php'); }

if ($_POST['id']) {
    updateContact($_POST['id'],$_POST['status']);
    header('Location: contact.php');
}

?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="contact.php">Support Messages</a></li>
                <li class="breadcrumb-item active">View Message</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">View Message</h1>
            </header>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                    <form action="contact_view.php" method="POST">
                                        <input type="hidden" id="id" name="id" value="<?php echo $wRow->id; ?>">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" value="<?php echo $wRow->name;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input class="form-control" value="<?php echo $wRow->subject;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" value="<?php echo $wRow->email;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">-- SELECT A OPTION --</option>
                                                <option value="unread" <?php if($wRow->status=='unread') {echo 'selected';} ?> >Unread</option>
                                                <option value="read" <?php if($wRow->status=='read') {echo 'selected';} ?> >Read</option>
                                                <option value="replied" <?php if($wRow->status=='replied') {echo 'selected';} ?> >Replied</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Message</label>
                                            <blockquote><?php echo htmlentities($wRow->message);?></blockquote>
                                        </div>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-envelope-open"></i> Update Status</button>
                                        <a href="contact_reply.php?id=<?php echo $wRow->id; ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Reply Message</a>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once '_footer.php'; ?>