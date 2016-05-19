<?php

  include "includes/head.php";

?>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="container-fluid col-sm-10 center"> <!--container fluid starts -->
            <div class="center headname">
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/></a><span class="title big">C A S T I K O</span>
            </div>
            <hr class="thick">
            </hr>
            <div id="selector">
              <div class="row">
                <div class="col-sm-6 mycontent-left" style="text-align:center; ">
                  <button  class="btn submit-btn firstcolor select-btn" id="cd_icon" data-show="#castingdirector" data-hide="#actor" ></button><br><font class="info gray marginTop">I am a Casting Director</font>
                </div>
                <div class="col-sm-6" style="text-align:center;">
                  <button  class="btn submit-btn firstcolor select-btn" id="actor_icon" data-show="#actor" data-hide="#castingdirector" ></button><br><font class="info gray marginTop">I am an Actor</font>
                </div>
              </div>
            </div>
            <div id="castingdirector" class="hidden">
              <div class="row">
                <div class="col-sm-6 light-padded mycontent-left" style="text-align:left;">
                  <font class="info gray left padded"><br>Casting Directors use Castiko to:<br>
                    <ul>
                      <li>Organize their data</li>
                      <li>Seamlessly contact hundreds of actors</li>
                      <li>Instantly find new faces</li>
                    </ul>
                  </font>
                </div>
                <div class="col-sm-6">
                  <div class="mycontent-right center light-padded">
                      <font class="info dark-gray center"> Log In | </font><a href="<?= base_url() ?>home/register/director"><font class="info firstcolor center"> Sign Up! </a></font>
                      <form role="form" id="login-form" class="login-forms" method="post" >
						<b><p class="text-danger" id="login-error-director"></p></b>
                      <div class="form-group">
                        <input type="email" class="form-control login" id="username" name="email" placeholder= "Email" required />
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="password" placeholder= "Password" required />
                        <input type="hidden" name="type" value="director">
                      </div>
                      <div class="checkbox-circle">
                        <a href="<?= base_url() ?>home/forgotpassword/" class="pull-right"><small>Forgot Password?</small></a>
                      </div>
                      <button type="submit" class="btn submit-btn firstcolor" id="btn-login" ><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button>
                      <div class="alert alert-danger margin-top hidden" id="error-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Error! </strong>
                         Please enter a valid Username and Password
                      </div>
                    </form>
                  </div> <!---ends here mycontent-right -->
                </div>
              </div>
            </div>
            <div id="actor" class="hidden">
               <div class="col-sm-6 light-padded mycontent-left" style="text-align:left;">
                <font class="info gray left padded"><br>Actors use Castiko to:<br>
                  <ul>
                    <li>Connect directly with casting directors</li>
                    <li>Create detailed profiles</li>
                    <li>Get audition notifications</li>
                  </ul>
                </font>
              </div>
              <div class="col-sm-6">
                <div class="mycontent-right center light-padded">
                    <font class="info dark-gray center"> Log In | <a href="<?= base_url() ?>home/register/actor"><font class="info firstcolor center"> Sign Up! </a></font></font>
                    <form role="form" id="actor_login-form" class="login-forms" method="post" >
                    <b><p class="text-danger" id="login-error-actor"></p></b>
                    <div class="form-group">
                      <input type="email" class="form-control login" id="email" name="email" placeholder= "Email" required />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control login" id="actor_password" name="password" placeholder= "Password" required />
                      <input type="hidden" name="type" value="actor">
                    </div>
                    <div class="checkbox-circle">
                      <a href="<?= base_url() ?>home/forgotpassword/" class="pull-right"><small>Forgot Password?</small></a>
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor" id="btn-login" ><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button>
                    <div class="alert alert-danger margin-top hidden" id="error-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>Error! </strong>
                       Please enter a valid Username and Password
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>       
   
<?php
  include 'includes/scripts.php';
?>
