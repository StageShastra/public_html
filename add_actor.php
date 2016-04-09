<?php
session_start();
if(empty($_SESSION['login_user']))
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
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/tagsinput.css" />
        <link href="css/dropzone.css" type="text/css" rel="stylesheet" />
        <script src="js/dropzone.js"></script>
    </head>
    <style>
    .inactive{
      background-color : #f2f2f2;
    }

    </style>
    <body>
        <style>body{padding-top: 90px;} </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
       
        <!-- Ths section is post selection !-->
        <div class="container-fluid " id="add-actor">
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
                            <img src="img/logo.png" class="brands"/><span class="vertical-middle brandname">STAGE<b>SHASTRA</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                        <li >
                            <a href="#" class="disabled">Discover<span class="info-small"><i>(Coming Soon)</i></span></a>
                        </li>
                        <li >
                            <a href="home.php"><span class="firstcolor"> Advanced<sup class="info-small">New!</sup></span>
                            </a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down firstcolor" aria-hidden="true"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">Add</a></li>
                            <li><a href="#">Import</a></li>
                            <li><a href="#">Export</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="resources/logout.php">Sign-Out</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
            <div class="container-fluid padded" id="addactorcanvas">
                <div class="col-sm-10 center" >
                   <div class="row">
                    <div class="col-sm-3">
                        
                    </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="aname" name="name" title="Do not add any titles, like Mr. or Ms., etc" placeholder= "Name :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="alanguage" data-role="tagsinput" name="language" placeholder= "Language :" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" data-role="tagsinput" id="askills" name="skills" placeholder= "Skills :"/>
                        </div> 
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="date" class="form-control add" id="adob" name="dob" title= "Date of Birth. Be careful to use the right format!" placeholder= "DOB :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="email" class="form-control add" id="aemail" name="email" placeholder= "Email :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <select class="form-control add" id="afacattr" name="facattr" placeholder= "Fac. Attr. :" />
                            <option value="" disabled selected>Fac. Attr. :</option>
                                <option>Funky</option>
                                <option>Cool</option>
                                <option>Character</option>
                                <option>Superstar</option>
                            </select>
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4">
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control add" id="aweight" name="weight" placeholder= "W(in kgs) :" required />
                            </div>
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control add" id="aheight" name="height" placeholder= "H(in cms) :" required />
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="aphone" name="phone" placeholder= "Phone :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <select class="form-control add" id="aphyattr" name="phyattr" placeholder= ""  >
                                <option value="" disabled selected>Phy. Attr. :</option>
                                <option>Lean</option>
                                <option>Muscular</option>
                                <option>Fat</option>
                                <option>Average</option>
                            </select>
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4">
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control add" id="aage" name="age" placeholder= "Age :" required />
                            </div>
                            <div class="col-sm-6 form-group no-paddinglr">
                                <input type="text" class="form-control add" id="asex" name="sex" placeholder= "Sex (M/F) :" required />
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add"  id="aexperience" title="Leave blank  if don't have any." name="experience" placeholder= "Experience :" required />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" data-role="tagsinput" id="aproject"  name="projects" placeholder= "Projects :" required />
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="arange" name="range" placeholder= "Acting Age Range(e.g. 18-24) :" >
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="atraining" name="training" placeholder= "Training :" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control add" id="aauditions" name="auditions" placeholder= "Auditions :" disabled />
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-12">
                           <form action="upload.php" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;"></form>
                        </div>
                    </div>
                    <div class="row vertical-padded">
                        <div class="col-sm-12" >
                           <button type="submit" class="btn submit-btn firstcolor"  id="upload-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Add Actor</button>
                        </div>
                        <div class="alert alert-success" id="successful" role="alert">Actor has been saved in the database. Click <a href="add_actor.php"> here to add more</a> or <a href="home.php">to go back to home</a></div>
                        <div class="alert alert-danger"  id="unsuccessful" role="alert">Error! Please try again.</div>
                    </div>
                </div>
                </div>
            </div>
           </div> 
        <!--================================== Navigation Ends Here =======================================-!-->
            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src='js/tagsinput.js'></script>
        <script src="js/add_actor.js"></script>
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

