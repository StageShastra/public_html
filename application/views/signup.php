<?php
  include "includes/head.php";
?>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="container-fluid center col-sm-10 col-xs-12"> <!--container fluid starts -->
             <div class="center headname">
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/>
			  <span class="title big"><?= M_Title ?></span></a>
             <hr>
             </div>
            <div class="row center">
              <div class="col-sm-12 light-padded">
                <div class="col-lg-6 col-sm-8 col-xs-12 center" id="form-div">
                <?php if(!$error){ ?>
                  <font class="info-small text-primary"> <?= M_Register1 ?> </br> <?= ($page == 'director') ? M_Register2 : "" ?></font>
                  
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

					  <a href="<?= base_url() ?>" class="pull-right"><small><?= M_AlreadyRegistered ?></small></a>
                      <button type="submit" class="btn submit-btn firstcolor" name="submit" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign Up</button>

                    </form>
                <?php } ?>
					
					<?php echo validation_errors("<p class='text-danger'>"); ?>

					<?php echo ($error) ? "" : "<p class='text-danger'><b>{$error_msg}</b></p>" ?>
                
					<script> registerSuccess = <?= ($error) ? true : false; ?> </script>
				</div>
				
				
				<?php
					if($error){
				?>
                 <div class="container-fluid" id="success">
                  <div class="col-sm-12">

                    <!-- <img src="<?= IMG ?>/thanks.png"  style="float:left; height:50%;"/> -->
					<h1 style="margin-top:15%;" class="firstcolor"> Thank You!</b></h1><br>
					<span class="info"><?= $error_msg ?></span></br>
					<span class="info"><?= ($page == 'director') ? M_Register2 : "" ?></span></br>
					

                  </div>
                </div>  
				<?php } ?>
              </div>
              </div>
            </div>
          </div>
          </div>
        </div>
<?php
  include "includes/scripts.php";
?>
