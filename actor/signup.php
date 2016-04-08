<?php 
$invite_flag=0;
if(isset($_REQUEST['director_id']))
{
  $director_id = $_REQUEST['director_id'];  
  $invite_flag = 1;
}
else
{
  $director_id = "0";
}


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Stage Shastra | Makes Casting easier.</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/tagsinput.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <link href="../css/dropzone.css" type="text/css" rel="stylesheet" />
        <link href="../css/animate.css" type="text/css" rel="stylesheet" />
        <script src="../js/dropzone.js"></script>
    </head>
    <style type="text/css">
    .bootstrap-tagsinput {
      background-color: #f2f2f2;
    }
    </style>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="col-sm-1">
          </div>
          <div class="container-fluid col-sm-10"> <!--container fluid starts -->
            <div class="center headname">
              <a href="index.php"><img src="../img/logo.png" class="logo img-fluid"/></a> STAGE<b>SHASTRA</b>
            </div>
            <div class="row center">
              <div class="col-sm-12 light-padded">
                <div class="col-sm-8 center thinbordered" id="form-div-personal">
                  <font class="info gray"><span class="glyphicon glyphicon-user firstcolor" aria-hidden="true"></span>  Personal Details<hr></font>
                      <form role="form" class="col-sm-8 center marginTop" id="signup-form">
                      <div class="form-group">
                        <input type="text" class="form-control login" id="fullname" name="fullname" placeholder= "Full Name *" required>
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control login" id="email" name="email" placeholder= "Email *" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="contact" name="contact" placeholder= "Phone No.(will be used to send audition SMS) *" required >
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="password" placeholder= "Choose a password" required>
                      </div>
                      <button type="button" class="btn submit-btn firstcolor" onclick="showbio()" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Continue</button>
                    </form>
                </div>
                <div>
                  <div class="col-sm-8 center thinbordered hidden" id="form-div-bio">
                  <font class="info gray"><span class="glyphicon glyphicon-pencil firstcolor" aria-hidden="true"></span> Bio<hr></font>
                      <form role="form" class="col-sm-8 center marginTop" id="signup-form">
                      <div class="form-group">
                        <input type="date" class="form-control login" style="color:#99999B;" id="dob" name="dob" placeholder= "Date of Birth *" required >
                      </div>
                      <div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="text" class="form-control login" id="age" name="age" placeholder= "Age(in years) :" required />
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="text" class="form-control login" id="sex" name="sex" placeholder= "Sex (M/F) :" required />
                          </div>
                      </div>
                      <div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="text" class="form-control login" id="weight" name="weight" placeholder= "W(in kgs) :" required />
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="text" class="form-control login" id="height" name="height" placeholder= "H(in cms) :" required />
                          </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" class="form-control login"  id="director" name="director" value=<? echo $director_id ?> >
                      </div>
                      <button type="button" class="btn submit-btn firstcolor" onclick="showwork()" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Continue</button>
                    </form>
                </div>
                </div>
                <div>
                  <div class="col-sm-8 center thinbordered hidden" id="form-div-work">
                  <font class="info gray"><span class="glyphicon glyphicon-th-list firstcolor" aria-hidden="true"></span> Work<hr></font>
                      <form role="form" class="col-sm-8 center marginTop" id="signup-form"  style="margin-bottom:50px;">
                      <div class="form-group">
                        <input type="text" class="form-control login" data-role="tagsinput" id="language" name="language" placeholder= "Languages you speak" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login"  id="experience" name="experience" placeholder= "Work Experience(ads, films etc.)" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" data-role="tagsinput" id="skills" name="skills" placeholder= "Skills(Swimming, Dancing)" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="age-range" name="age-range" placeholder= "Age Range(15-25) in years" required >
                      </div>
                      <div>
                          <div class="col-sm-6 form-group no-paddinglr" style="text-align:left;">
                             <input type="checkbox" name="passport" id="passport" class="css-checkbox" unchecked /><label for="passport" class="css-label"><span class="info dark-gray formtext">Passport</span></label>
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="checkbox" name="actorcard" id="actorcard" class="css-checkbox" unchecked /><label for="actorcard" class="css-label"><span class="info dark-gray formtext">Actor' Card</span></label>
                          </div>
                      </div>
                    </form>
                    <div class="form-group">
                           <form action="../resources/actor_upload.php" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;"></form>
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor" id="save-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Save</button>
                </div>
                </div>
                 <div class="container-fluid hidden" id="success">
                  <div class="col-sm-12">
                    <img src="../img/thanks.png"  style="float:left; height:50%;"/><h1 style="margin-top:15%;" class="firstcolor"> Thank You!</b></h1><br><span class="info">We love to have you onboard! Click <a href="home.php">here</a> to see your profile.</span></br>
                  </div>
                </div>      
              </div>
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
   
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>
         <script src="../js/tagsinput.js"></script>
        <script src="../js/actor_signup.js"></script>
        <script src="../js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
