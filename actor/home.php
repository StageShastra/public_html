<?php
session_start();
if(empty($_SESSION['login_actor']))
{
    //header("Location:index.php");
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
                    <div class="col-sm-8 mycontent-left marginTop">
                      <div class="col-sm-6 mycontent-left ">
                        <div class=" col-sm-7 center" id="actorprofile">
                            <div id="profile_photo">
                                <span class="info-small gray center" style="vertical-align:middle;"> Upload Picture </span>
                            </div>
                            <div class="col-sm-12 left marginTop">
                                <span id="actor_name" class="info dark-gray ">Shubham Prakash</span><span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <br>
                                <span id="actor_age" class="info-small black ">11</span><span id="actor_sex" class="info-small black">,M</span>
                            </div>
                            <div class="col-sm-12 left marginTop hidden " id="name_edit">
                                <input type="text" class="editinput" id="name"/>
                                <input type="text" class="editinput" id="age"/>
                                <input type="text" class="editinput" id="sex"/>
                            </div>
                        </div>   
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Phone No. : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_phone" class="info dark-gray">7742558868</span>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Email Id. : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_email" class="info dark-gray">prasht63@gmail.com</span>
                            <hr>
                        </div>
                         <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Date of Birth. : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_dob" class="info dark-gray">28/09/1993</span>
                        </div>
                        
                      </div>
                      <div class="col-sm-6 marginTop">
                        <div class="col-sm-10 center left ">
                            <span class="actorlabel" >
                                Height. : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_height" class="info dark-gray">178 cms</span>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Weight : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_weight" class="info dark-gray">78 kgs</span>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Languages : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_language" class="info dark-gray">
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">English</font>
                                    </button>
                                </div>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">Hindi</font>
                                    </button>
                                </div>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">German</font>
                                    </button>
                                </div>
                            </span>
                            <hr class="taghr">
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Skills : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_skills" class="info dark-gray">
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">Dancing</font>
                                    </button>
                                </div>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">Swimming</font>
                                    </button>
                                </div>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" aria-label="Left Align" >
                                        <font class="taga-text">Boxing</font>
                                    </button>
                                </div>
                            </span>
                        
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="col-sm-11 center">
                            <hr>
                            <span class="actorlabel pull-left" >
                                    Photos and Videos : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                    <hr align="left" width="15px" class="tenth">
                            </span>
                            <div id="photos_videos">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Experience : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_experience" class="info dark-gray">
                                <span class="info black" id="title">Taj Mahal ki Neelami</span><hr>
                                <span class="info-small dark-gray" id="description">
                                    Its a satirical play about how people try to blow things out of proportion.Its a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportion
                                </span>
                            </span>
                            <br><br>
                            <span id="actor_experience" class="info dark-gray">
                                <span class="info black" id="title">Taj Mahal ki Neelami</span><hr>
                                <span class="info-small dark-gray" id="description">
                                    Its a satirical play about how people try to blow things out of proportion.Its a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportion
                                </span>
                            </span>
                        <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Training : <span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_training" class="info dark-gray">
                                <span class="info black" id="school">Barry John's Acting Academy</span>
                                <br>
                                <span class="info-small dark-gray" id="course">Method Acting</span>
                                <br>
                                <span class="info-small dark-gray" id="duration">2012-2015</span>
                                <br>
                                <span class="info-small dark-gray" id="training_description">
                                    Its a satirical play about how people try to blow things out of proportion.Its a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportionIts a satirical play about how people try to blow things out of proportion
                                </span>
                                <hr>
                            </span>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
   
        </div>
           

          <!-- Modal -->
   
        <!--================================== Navigation Ends Here =======================================-!-->
            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src='../js/tagsinput.js'></script>
        <!-- <script src="../js/actor_profile.js"></script> -->
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
        <footer class="footer">
          <foodiv class="container center">
            <p class="dark-gray info-small center ">© 2016 StageShastra | connect@stageshastra.com</p>
        </footer>
    </body>
</html>