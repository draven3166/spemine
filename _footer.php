    <div class="clear"></div>
    <div id="footer">
        <footer>
            <div class="container">
                <div id="footer-content">
                    <img src="img/footer-icons.jpg" alt="">
                    <p>© <?php echo SITENAME; ?> <?php echo date('Y');?>. All rights reserved.</p>
                </div><!-- footer-content-->
            </div><!-- container -->
        </footer>
    </div><!-- footer -->

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.fancybox.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/main.js"></script>
    <script type="text/javascript">
        function validateFormLogin()
        {
            var min_length = <?php echo WALLET_MINCH;?>;
            var max_length = <?php echo WALLET_MAXCH;?>;
            var error_message = "";

            var val_length = $("#username").val().length;
            if(val_length > 0)
            {
                if(val_length <  min_length )
                {
                    error_message = "Wallet address is invalid! Enter correct wallet address or <b><a href='https://coinpayments.net' target='_blank'>Create New Wallet Address</a></b>. ";
                    $("#result").html(error_message);
                    return false;
                }
                if(val_length  > max_length)
                {
                    error_message = "Wallet address is invalid! Enter correct wallet address or <b><a href='https://coinpayments.net' target='_blank'>Create New Wallet Address</a></b>. ";
                    $("#result").html(error_message);
                    return false;
                }
                success_message = "Please wait...";
                $("#result").text(success_message);
                return true;
            }
            else
            {
                error_message = "This field is required ";
                $("#result").text(error_message);
                return false;
            }
        }
        <?php if(filename()=='dashboard.php'): ?>
        //Counter
        $(document).ready(function() {
            var speed = (parseFloat(<?php echo $userEarningRate;?>)/60).toFixed(8);
            setInterval(function() {
                var oldvalue =  parseFloat($('#bal').html()).toFixed(8);
                var result = parseFloat(parseFloat(oldvalue) + parseFloat(speed)).toFixed(8);
                $("#bal").html(result);
            }, 1000);
        });
        //Wallet show
        function go_show_address() {
            $('#show_address').html('<?php echo $_SESSION['username'];?>');
        }
        <?php endif; ?>
        <?php if(filename()=='contact.php'): ?>
        //Ajax contact
        $("#contactForm").submit(function(event){
            // cancels the form submission
            event.preventDefault();
            $(this).fadeOut('slow');
            submitForm();
        });
        function submitForm(){
            // Initiate Variables With Form Content
            var name = $("#name").val();
            var email = $("#email").val();
            var subject = $("#subject").val();
            var message = $("#message").val();

            $.ajax({
                type: "POST",
                url: "contact_send.php",
                data: "name=" + name + "&email=" + email + "&subject=" + subject + "&message=" + message,
                success : function(text){
                    if (text == "success"){
                        formSuccess();
                        $("#name").val('');
                        $("#email").val('');
                        $("#subject").val('');
                        $("#message").val('');
                        $("#errorMessage").attr("style","display:none;").fadeOut();
                        $("#contactForm").fadeIn('slow');
                    }else{
                        formError(text);
                        $("#contactForm").fadeIn('slow');
                    }
                }
            });
        }
        function formSuccess(){
            $( "#sendmessage" ).attr('style','display:block;').fadeIn("slow" ).delay(3000).fadeOut();
        }
        function formError(text){
            $( "#errorMessage" ).attr("style","display:block;").html(text).fadeIn("slow" );
        }
        <?php endif;?>
    </script>
</body>
</html>