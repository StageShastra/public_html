<?php
  include "includes/head.php";
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
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/></a> STAGE<b>SHASTRA</b>
            </div>
            <div class="row center">
              <div class="col-sm-12 light-padded">
                <div class="quarter" id="form-div">
                  <font class="info-small text-primary">Please fill out the form.We promise to get back to you within 24 hours!</font>
                  

                  <?php echo validation_errors("<p class='text-danger'>"); ?>

                  <?php echo ($error) ? "<p class='text-success'><b>{$error_msg}</></p>" : "<p class='text-danger'><b>{$error_msg}</b></p>" ?>


                      <form role="form" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                      <div class="form-group">
                        <input type="text" class="form-control login" id="fullname" name="name" placeholder= "Full Name *" required>
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control login" id="email" name="email" placeholder= "Email *" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="contact" name="mobile" placeholder= "Mobile No. *" required >
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="password" placeholder= "Password *" required >
                      </div>
					  <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="cfn_password" placeholder= "Re Type Password *" required >
                      </div>
                      <!-- <div class='form-group'>
                        I am <input type="radio" name="type" value="director" checked> Director
                              <input type="radio" name="type" value="actor"> Actor
                      </div> -->
                      <button type="submit" class="btn submit-btn firstcolor" name="submit" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign Up</button>
                    </form>
					
					<?php echo validation_errors("<p class='text-danger'>"); ?>

					<?php echo ($error) ? "<p class='text-success'><b>{$error_msg}</></p>" : "<p class='text-danger'><b>{$error_msg}</b></p>" ?>
                
					<script> registerSuccess = <?= ($error) ? true : false; ?> </script>
				</div>

                 <div class="container-fluid" id="success">
                  <div class="col-sm-12">
					<h1 style="margin-top:15%;" class="firstcolor"> Thank You!</b></h1><br><span class="info">You will hear from us within 24 hours.</span></br>
                  </div>
                </div>      
              </div>
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
<?php
  include "includes/scripts.php";
?>