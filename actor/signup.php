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
              <div id="pro-bar" class="container col-sm-8 center">
                      
                      <div class="progress">
                        <div class="progress-bar progress-bar-success" id="pro-personal"role="progressbar" style="width:33.33%; background:#FF003A; ">
                          Personal 
                        </div>
                        <div class="progress-bar progress-bar-success hidden" id="pro-bio" role="progressbar" style="width:33.33%;background:#FFAA3A;">
                          Bio
                        </div>
                        <div class="progress-bar progress-bar-danger hidden" id="pro-work" role="progressbar" style="width:33.33%;background:#FEE300; ">
                          Work
                        </div>
                      </div>
                    </div>
              <div class="col-sm-12 light-padded">
                    
                <div class="col-sm-8 center thinbordered" id="form-div-personal">
                  <font class="info gray"><span class="glyphicon glyphicon-user firstcolor" aria-hidden="true"></span>  Personal Details<hr></font>
                      <form role="form" class="col-sm-8 center marginTop" id="signup-form">
                      <div class="form-group">
                        <input type="text" class="form-control login" id="fullname" name="fullname" title="Do not add any titles, like Mr. or Ms., etc" placeholder= "Full Name *" required>
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control login" id="email" name="email" placeholder= "Email *" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="contact" name="contact" title="Do not add zero or +91 before it." placeholder= "Phone No. *" required >
                      </div>
                      <div class="form-group no-paddinglr" style="text-align:left;">
                             <input type="checkbox" name="whatsapp" id="whatsappcheck" class="css-checkbox" onclick="showwhatsapp()" unchecked /><label for="whatsappcheck" class="css-label"><span class="info-small dark-gray ">Add a WhatsApp No.</span></label>
                      </div>
                      <div class="form-group">
                        <input type="hidden" class="form-control login" id="whatsapp" name="whatsapp" title="Do not add zero or +91 before it." placeholder= "Whatsapp No. *" required >
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="password" title="Atleast 8 letters" placeholder= "Choose a password" required>
                      </div>
                      <button type="button" class="btn submit-btn firstcolor" onclick="showbio()" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Continue</button>
                    </form>
                </div>
                <div>
                  <div class="col-sm-8 center thinbordered hidden" id="form-div-bio">
                  <font class="info gray"><span class="glyphicon glyphicon-pencil info-small firstcolor" aria-hidden="true"></span> Bio<hr></font>
                      <form role="form" class="col-sm-8 center marginTop" id="signup-form">
                      <div class="form-group">
                        <input type="date" class="form-control login" style="color:#99999B;" id="dob" name="dob" title= "Date of Birth" required >
                      </div>
                      <div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="text" class="form-control login" onclick="calculateAge()" id="age" name="age" placeholder= "Age(in years) :" required />
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <select type="text" class="form-control login" id="sex" name="sex" placeholder= "Sex (M/F) :" required >
                                <option>M</option>
                                <option>F</option>
                              </select>
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
                      <div class="form-group" id="lan">
                        <input type="text" class="form-control login"  data-role="tagsinput" id="language" name="language" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" title="Add a language, then press enter." placeholder= "Languages you speak" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login"  id="experience" name="experience" title="Leave blank  if you don't have any." placeholder= "Work Experience(ads, films etc.)" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login"  data-role="tagsinput" id="skills" name="skills"  placeholder= "Skills(Swimming etc.)" required >
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control login" id="age-range" name="age-range" data-toggle="tooltip" data-placement="right" title="What ages would you naturally be able to play on screen/stage?"placeholder= "Age Range in years" required >
                      </div>
                      <div>
                          <div class="col-sm-6 form-group no-paddinglr" style="text-align:left;">
                             <input type="checkbox" name="passport" id="passport" class="css-checkbox" unchecked /><label for="passport" class="css-label"><span class="info-small dark-gray "> I have a Passport</span></label>
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="checkbox" name="actorcard" id="actorcard" class="css-checkbox" unchecked /><label for="actorcard" class="css-label"><span class="info-small dark-gray ">I have a Actor's Card</span></label>
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
                    <img src="../img/thanks.png"  style="float:left; height:50%;"/><h1 style="margin-top:15%;" class="firstcolor"> Thank You!</b></h1><br><span class="info">Good to have you onboard!<br> Click <a href="home.php">here</a> to go to your profile.</span></br><h1 style="margin-top:5%;" class="firstcolor"> धन्यवाद!</b></h1><br><span class="info">आपके हुमारे साथ जुड़ने की हमे बेहद खुशी है!<br>अपने प्रोफाइल पर जाने के लिए <a href="home.php">यहाँ क्लिक</a> करें</span></br>
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
        <script src="../js/typeahead.js"></script>
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
