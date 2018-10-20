<?php require_once '_header.php'; ?>
    <div id="header-content">
        <span>Contact Us</span>
        <p>Have problem that cannot resolve by yourself or have a question you do not have an answer to? Send us a message!</p>
        <div class="text-center" style="margin-bottom: 10px">
            <?php include_once '_social.php'; ?>
        </div>
    </div>

    </div><!-- header-page -->
    <div class="clear"></div>

    <div id="pages"><div class="container">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div id="sendmessage" class="alert alert-success" style="display: none">Message sent with success!</div>
                    <div id="errorMessage" class="alert alert-danger" style="display: none"></div>
                    <form action="" method="post" id="contactForm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required />
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required />
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Your Message here" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-send"></i> Send</button>
                    </form>
                </div>
            </div>

        </div><!-- container -->
    </div><!-- page -->

<?php require_once '_footer.php';?>