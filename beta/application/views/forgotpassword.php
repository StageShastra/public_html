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
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/><span class="title big">C A S T I K O</span></a>
            </div>
            <hr class="thick">
            </hr>
            <div class="row">
              <div id="getcodediv">
              <div class="col-sm-6 center">
                <div class="mycontent-right center light-padded">
                    <font class="info firstcolor center"> Forgot Password </font>
                    <form role="form" class="vertical-padded "id="forgot-form" method="post" >
                    <p class="text-warning" id='error-forgot-password'>  </p>
                    <div class="form-group">
                      <input type="email" class="form-control login" id="username" name="email" placeholder="Email" required />
                      <input type="hidden" id="option" name="option" value='1' />
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor" id="btn-getcode" ><span class="glyphicon glyphicon-log-in"></span> &nbsp;Get Code</button>
                    <button type="submit" class="btn submit-btn firstcolor" id="btn-gotcode"  ><span class="glyphicon glyphicon-log-in"></span> &nbsp; Already got code?</button>
                  </form>
                </div>
              </div>
            </div>
            <div id="gotcodediv">
               <div class="col-sm-6 center">
                <div class="mycontent-right center light-padded">
                    <font class="info firstcolor center"> Forgot Password </font>
                    <form role="form" class="vertical-padded "id="change-password" method="post" >
                    <p class="text-warning" id="error-change-password"></p>
                    <div class="form-group">
                      <input type="email" class="form-control login" id="username" name="email" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control login" id="code" name="code" placeholder="Code" required />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control login" id="newpwd" name="password" placeholder="New Password" required />
                      <!-- <input type="hidden" id="option" name="option" value=2/> -->
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor" id="btn-getcode" ><span class="glyphicon glyphicon-log-in"></span> &nbsp;Change Password</button>
                  </form>
                                      <div class="alert alert-danger margin-top" id="error-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>Error! </strong>
                       Please enter a valid Code
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
  include 'includes/scripts.php';
?>
