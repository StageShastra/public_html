<?php
  include "includes/head.php";
?>
<style>
.submit-btn {
    background-color:#FBB515; ;
    border-color: #E19B1B;
    margin-top: 10px;
    padding: 5px 10px;
    color: white;
}
.submit-btn:hover, .submit-btn:focus, .submit-btn:active{
  background-color: white;
  color: #e19b1b;
}
.submit-btn{
  padding: 5px 10px;
  margin-bottom: 20px;
}
.signup_heading{
    font-family: Raleway;
    font-size: 24px;
    color: black;
}
@media(max-width:767px) {
.signup_box{
  background-image: linear-gradient(29deg, rgb(226, 162, 17) 3%, rgba(216, 115, 27, 0.86) 20%, rgba(195, 15, 76, 0.86) 100%, rgb(255, 0, 35) 10%);
  border-radius: 10px;
}
.signup_heading{
  font-family: Raleway;
  font-size: 21px;
  color: #fff;
}
.already{
  font-family: "Open Sans","Raleway";
  color: white;
}
.submit-btn {
    background-color:white ;
    border-color: #E19B1B;
    margin-top: 10px;
    padding: 5px 10px;
    color: #E19B1B;
}
.submit-btn:hover, .submit-btn:focus, .submit-btn:active{
  background-color: #FBB515;
  color: white;
  border-color: #E19B1B;
}
#success{
  color: white;
}
    
}

</style>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="container-fluid center col-lg-12 col-sm-10 col-xs-12"> <!--container fluid starts -->
             <div class="center headname">
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/>
			  <span class="title big"><?= M_Title ?></span></a>
             <hr>
             </div>
            <div class="row center signup_box">
              <div class="col-sm-12 light-padded">
                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="margin-top:45px;">
                  <img src="<?= IMG ?>/macbook_cd_register.png" class="animation-element slide-left img-responsive laptoponly" >
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12" id="form-div">
                <?php if(!$error){ ?>
                  <font class="info-small text-primary signup_heading"> Director Sign Up  - <? echo ucwords($_REQUEST['plan']); ?></font>
                  
                      <form role="form" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                      <div class="form-group">
                        <input type="text" class="form-control login" id="fullname" name="name" placeholder= "Full Name *" required>
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control login" id="email" name="email" placeholder= "Email *" value="<?= $email ?>" <?= ($email != '') ? "readonly" : "" ?> required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="contact" name="mobile" placeholder= "Mobile No. *" value="<?= $mobile ?>" <?= ($mobile != '') ? "readonly" : "" ?> required >
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
                      <center><a href="<?= base_url() ?>" class="already"><small><?= M_AlreadyRegistered ?></small></a></center>
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
                  <div class="col-sm-6 col-lg-6 col-xs-12 col-md-6">

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
