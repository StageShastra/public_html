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
                  <font class="info gray"><span class="glyphicon glyphicon-user firstcolor" aria-hidden="true"></span>  Sign Up<hr></font>
                      <form role="form" action="#" method="post" class="col-sm-8 center marginTop" id="actor-signup-form">

                      <p class="text-danger" id="signup-error">  </p>

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
                             <input type="checkbox" name="useaswhatsapp" id="useaswhatsapp" class="css-checkbox" onclick="useasWhatsapp()" unchecked /><label for="useaswhatsapp" class="css-label"><span class="info-small dark-gray ">Use above as your WhatsApp No.</span></label>
                      </div>
                      <div class="form-group no-paddinglr" style="text-align:left;">
                             <input type="checkbox" name="whatsapp" id="whatsappcheck" class="css-checkbox" onclick="showwhatsapp()" unchecked /><label for="whatsappcheck" class="css-label"><span class="info-small dark-gray ">Add a new WhatsApp No.</span></label>
                      </div>

                      <div class="form-group">
                        <input type="hidden" class="form-control login" id="whatsapp" name="whatsappNo" title="Do not add zero or +91 before it." placeholder= "Whatsapp No. *"  >
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control login" id="password" name="password" title="Atleast 8 letters" placeholder= "Choose a password" required>
                      </div>
                      <button type="submit" class="btn submit-btn firstcolor" id="sign-upbtn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign Up</button>
                    </form>
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
