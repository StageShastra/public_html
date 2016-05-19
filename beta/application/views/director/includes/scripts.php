        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= JS ?>/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script type="text/javascript">
          
        $(document).ready(function(){

          $(document).on("submit", "form#invitationForm", function(){
            var that = this;
            var emails = $("textarea[name='emails']").val();
            var mobiles = $("textarea[name='mobiles']").val();
            var message = $("textarea[name='message']").val();

            var data = {emails: emails, mobiles: mobiles, message: message};

            // TODO: Generate a preview of email before sending.
            $.ajax({
              type: "POST",
              data: data,
              url: "resources/sendInvite.php",
              success: function(res){
               //console.log(res);
               $("#inviteActors").hide();
               $("#success_send").show(); 
               $("#success_send").fadeTo(2000, 500).slideUp(500, function(){
                  $("#success_send").alert('close');
                          });
               
             }
          });

            console.log(data);
            return false;
          });

        });

        </script>

        <script src="<?= JS ?>/vendor/bootstrap.min.js"></script>
        <script src="<?= JS ?>/vendor/js.cookies.js"></script>
        <script src='<?= JS ?>/tagsinput.js'></script>
        <script src="<?= JS ?>/home.js"></script>
        <script src="<?= JS ?>/lightbox.js"></script>
        <script src="<?= JS ?>/stupidtable.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        
        <footer class="footer">
          <foodiv class="container center">
            <p class="dark-gray info-small center ">© 2016 Castiko | connect@castiko.com</p>
        </footer>
    </body>
</html>
