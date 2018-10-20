<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
require_once '_header.php';
$_table = 'contact';
$_url = 'contact.php';
if(isset($_GET['page'])){$pag = $_GET['page']-1;}else{$pag = 0;}
$messages = getPagination($_table,$pag*PAGINATION,PAGINATION);
?>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Support Messages</li>
            </ul>
        </div>
    </div>
    <!-- /. ROW  -->
    <section>
        <div class="container-fluid">
            <header>
                <h1 class="h3 display">Messages List</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="contacts">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($messages): ?>
                                        <tr>
                                        <?php foreach ($messages as $msg): ?>
                                            <td><?php echo $msg['id']; ?></td>
                                            <td><?php echo $msg['name']; ?></td>
                                            <td><?php echo $msg['subject']; ?></td>
                                            <td>
                                                <?php
                                                $status = $msg['status'];
                                                if($status=='unread'){
                                                    echo '<span class="badge badge-danger">Unread</span>';
                                                }
                                                elseif($status=='read'){
                                                    echo '<span class="badge badge-warning">Read</span>';
                                                }else{
                                                    echo '<span class="badge badge-success">Replied</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $msg['created_at']; ?></td>
                                            <td><a class="btn btn-xs btn-info" href="contact_view.php?id=<?php echo $msg['id']; ?>"><i class="fa fa-eye"></i> View</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No results</td>
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