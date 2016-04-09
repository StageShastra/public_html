<?php
session_start();
if(empty($_SESSION['login_actor']))
{
    header("Location:index.php");
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
        <link rel="stylesheet" href="../css/lightbox.css">
        <link rel="stylesheet" href="../css/datatable.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tagsinput.css" />
        <script type="text/javascript">
          window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var n=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(n?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(a,o);for(var r=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["clearEventProperties","identify","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=r(p[c])};
          heap.load("267160806");
        </script>
    </head>
    <body>
        <style>
          body{
            padding-top: 90px;
          }
          .rotate-img {
            -webkit-animation: rotation 2s infinite linear;
          }

          @-webkit-keyframes rotation {
              from {-webkit-transform: rotate(0deg);}
              to   {-webkit-transform: rotate(359deg);}
          }
          .bootstrap-tagsinput {
            background-color: #f2f2f2;
        }


        </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
        <!-- Ths section is pre selection !-->
        <!--===========================================================================================!-->

        <!-- Ths section is post selection !-->
        <div class="container-fluid" id="home">
           
           
            <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">
                            <img src="../img/logo.png" class="brands"/><span class="vertical-middle brandname">STAGE<b>SHASTRA</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                       
                        <li >
                            <a href="../resources/logout_actor.php"><button type="button" class="btn submit-btn firstcolor" id="btn-logout"  ><span class="glyphicon glyphicon-log-out"></span> &nbsp; Sign Out</button></a>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
           <!-- contact modal toggle -->
            <div class="container-fluid padded">
                <div class="container col-sm-12 center" id="browse-table">
                      
                </div>
            </div>
   
           </div>
           

          <!-- Modal -->
   <div id="editprofile" class="modal fade col-sm-10 center" role="dialog">
    <div class="modal-dialog" style="width:100%;">
        <div class="modal-content center" style="width:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title firstcolor info">Edit Profile</h4>
            </div>
            <div class="modal-body" id="actor_detail"  style="background-color:#fff;">
            <div class="container-fluid padded" id="editactor">
                <div class="col-sm-10 center" >
                   <div class="row">
                    <div class="col-sm-3">
                        
                    </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login" id="name" name="name" title="Do not add any titles, like Mr. or Ms., etc" placeholder= "Name :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login" id="language" data-role="tagsinput" name="language" placeholder= "Language :" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login" data-role="tagsinput" id="skills" name="skills" placeholder= "Skills :"/>
                        </div> 
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="date" class="form-control login" id="dob" name="dob" title= "Date of Birth. Be careful to use the right format!"  placeholder= "DOB :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="email" class="form-control login" id="email" name="email" title="Please note : Sign-Up email still to be used as Username in case email is changed." placeholder= "Email :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login" id="phone" name="phone" title="Do not add zero or +91 before it." placeholder= "Phone :" required />
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4">
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control login" id="weight" name="weight" title="Weight in kgs" placeholder= "W(in kgs) :" required />
                            </div>
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control login" id="height" name="height" title="Height in kgs" placeholder= "H(in cms) :" required />
                            </div>
                        </div>
                        
                        <div class="col-sm-4 form-group">
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control login" id="age" name="age" title="Age in years "onclick="calculateAge()"placeholder= "Age :" disabled />
                            </div>
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control login" id="sex" name="sex" title="Sex (M/F) "placeholder= "Sex (M/F) :" required />
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <input type="text" class="form-control login"  id="whatsapp"  name="whatsapp" title="Do not add zero or +91 before it." placeholder= "WhatsApp No. :" required />
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login" id="training" name="training" title="Training " placeholder= "Training" >
                        </div>
                        <div class="col-sm-4 form-group" style="text-align:left;">
                            <input type="checkbox" name="passport" id="passport" class="css-checkbox" unchecked /><label for="passport" class="css-label"><span class="info-small dark-gray "> I have a Passport</span></label>
                        </div>
                        <div class="col-sm-4 form-group" style="text-align:left;">
                            <input type="checkbox" name="actorcard" id="actorcard" class="css-checkbox" unchecked /><label for="actorcard" class="css-label"><span class="info-small dark-gray ">I have an Actor's Card</span></label>
                          </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control login"  id="experience" title="Leave blank  if you don't have any." name="experience" placeholder= "Experience :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <div class="col-sm-6 form-group no-paddinglr">
                              <input type="number" class="form-control login" id="agemin" name="agemin" title="What  minimum age would you naturally be able to play on screen/stage?" value="5" required />
                          </div>
                          <div class="col-sm-6 form-group no-paddinglr">
                              <input type="number" class="form-control login" id="agemax" name="agemax" title="What maximum age would you naturally be able to play on screen/stage?" value="45" required />
                          </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="password" class="form-control login" id="password" name="password" title="Change Password" placeholder= "Password" >
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-12" >
                           <button type="submit" class="btn submit-btn firstcolor" onclick="updateactor()" id="upload-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Update Profile</button>
                        </div>
                        <div class="alert alert-success hidden " id="successful" role="alert">Profile hase been updated in the database. Click <a href="home.php"> here to refresh</a></div>
                        <div class="alert alert-danger hidden"  id="unsuccessful" role="alert">Error! Please try again.</div>
                    </div>
                </div>
            </div>
                            
            </div>
        </div>
    </div>
    </div>
        <!--================================== Navigation Ends Here =======================================-!-->
            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>
         <script src='../js/tagsinput.js'></script>
        <script src="../js/actor_profile.js"></script>
        <script src="../js/lightbox.js"></script>
        <script src="../js/stupidtable.js"></script>
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

