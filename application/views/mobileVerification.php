<?php
  include 'includes/head.php';
?>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="col-sm-1">
          </div>
          <div class="container-fluid col-sm-10"> <!--container fluid starts -->
            <div class="center headname">
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/>
			        <span class="title big"><?= M_Title ?></span></a>
            </div>
            <hr class="thick">
            </hr>
            <div class="row">
            <div id="getcodediv">
               <div class="col-sm-6 center">
                <img src="<?= IMG ?>/mobile.png" width=125px/>
                <div class="mycontent-right center light-padded">
                    <img src="<?= IMG ?>/mobile_logo.png" class="logo img-fluid center" width=100px/>
                    <br>
                    <font class="info firstcolor center"> Mobile Number Verification </font>
                    <br>
                    <font class="info-small" id="error-notice" style="display:<?= ($form) ? "none" : "block" ?>;">
                      <?= ($form) ? "" : $error_msg ?>
                    </font>

                <?php
                    if($form){
                ?>

                    <form role="form" class="vertical-padded" id="mobileVerfication" method="post" >
                    <font class="info-small text-primary">
                      <?= $error_msg  ?>
                    </font>
                    <p class="text-warning" id="error-change-password"></p>
                    <div class="form-group">
                      <input type="text" class="form-control login" id="otp" name="otp" placeholder="OTP" maxlength="6" required />
                    </div>
                    <div class="form-group">
                      <p><small>Lost OTP ? Resend <a href="">here</a></small></p>
                    </div>
                    
                    <button type="submit" class="btn submit-btn firstcolor" id="btn-getcode" ><span class="glyphicon glyphicon-log-in"></span> &nbsp;Verify</button>


                  </form>

                  <div class="alert alert-danger margin-top" id="error-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>Error! </strong>
                       Please enter a valid Code
                    </div>

                  <?php } ?>
                </div>
              </div>

            </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
<?php
  include 'includes/scripts.php';
?>
