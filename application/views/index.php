<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Castiko is a platform to connect Actors and Casting Directors. Actors – create your own acting profiles with photos & videos. Get auditions. Casting directors – manage all your data, run auditions and find new actors">
    <meta name="keywords" content="Acting, Audition, Actor, Casting, Film, Casting Directors in Mumbai, Search Actors">
    <meta name="filename" content="Castiko-Acting-Audition-Casting-Tool-Home">
    <meta property="og:title" content="Castiko Home - Acting auditions and casting for film production"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.castiko.com/"/>
    <meta property="og:image" content="http://www.castiko.com/assets/img/logo.png"/>
    <meta property="og:description" content="Castiko is a platform to connect Actors and Casting Directors. Actors – create your own acting profiles with photos & videos. Get auditions. Casting directors – manage all your data, run auditions and find new actors"/>
    <title>Castiko Home | Acting auditions and casting for film production</title>
    <link rel="shortcut icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?= CSS ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?= CSS ?>/landingpage.css" rel="stylesheet">
    <link href="<?= CSS ?>/animate.css" rel="stylesheet">
    <link href="<?= CSS ?>/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?= CSS ?>/navbar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:800,400,200,100,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
    window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var r=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(r?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n);for(var o=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["addEventProperties","addUserProperties","clearEventProperties","identify","removeEventProperty","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=o(p[c])};
    heap.load("408837571");
    </script>

</head>

<body id="page-top" class="index">
<style>
@media screen and (max-width: 767px) {
    body{
        overflow-x:hidden; 
    }
    a.anchor {
    display: block;
    position: relative;
    top: -70px;
    visibility: hidden;
}
  }
</style>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= IMG ?>/logo.png" class="brands img-responsive "/>
                            <div class="vertical-middle brandname title ">
                                <?= M_Title ?>
                                <br>
                                <span id="tag-line" class="firstcolor info-small hidden-xs">
                                Making Casting easier!                      
                                </span>
                            </div>
                            
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right ul_list">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#forActor">For Actors</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#forDirector">For Casting Directors</a>
                    </li>
                   <!-- <li class="page-scroll">
                        <a href="#about">Video</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">FAQ</a>
                    </li>
                    -->
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                    <li class="page-scroll">
                        <?php
                            if($this->session->userdata("StaSh_User_Logged_In")){
                                $a = $this->session->userdata("StaSh_User_type");
                                echo '<a href="'.base_url(). $a.'/">Dashboard</a>';
                            }else{
                                echo '<a data-target="#loginModal" data-toggle="modal">Login</a>';
                            }
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="intro-text">
                        <span class="name">Making casting easier.</span>
                        <span class="skills">Castiko makes it easier for actors and<br> casting directors to work together.</span>
                        <div><a href="#forActor" class="btn btn-custom">I'm an Actor</a>
                        <a href="#forDirector" class="btn btn-custom">I'm a Casting Director</a></div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12" style="text-align:center;">
                    <div class="col-sm-3 col-xs-4">
                        <img src="<?= IMG ?>/camera.png" class="header_icons">
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <img src="<?= IMG ?>/roll.png" class="header_icons">
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <img src="<?= IMG ?>/film.png" class="header_icons">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- For Actor Grid Section -->
    <a class="anchor" id="forActor"></a>
    <section id="forActor">
        <div class="container">
          <center><h3>For Actors</h3></center>
            <div class="row">
                <div class="col-md-6 col-xs-6 col-sm-6">
                    <div class="info-item">
                        <span class="info-item-title">ShowCase</span>
                        <span class="info-item-desc">Make a profile within minutes, with pictures and videos.</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-title">Be Seen</span>
                        <span class="info-item-desc">Share your profile with Casting Directors already on Castiko.</span>
                    </div>
                    <div class="info-item expandonmobile">
                        <span class="info-item-title">Stay in Touch</span>
                        <span class="info-item-desc " >Casting Directors are updated instantly when you add new work.</span>
                    </div>
                    <div>
                        <a href="<?=base_url() ?>home/choose_plan#forActors" class="btn btn-custom-outlined"  onmouseover='show_time_taken("a")' onmouseout='hide_time_taken("a")' target="_blank">Sign up now</a>
                        <a href="<?=base_url() ?>home/pricing#forActors" class="btn btn-custom-outlined" target="_blank">See Pricing</a>
                    </div>
                    <div id="time_taken_a" class="time_taken hidden">Just takes 2 mins</div>
                </div>
                <div class="col-md-6 col-xs-6 col-sm-6 deviceholder" >
                    <img src="<?= IMG ?>/macbook.png" class="animation-element slide-left img-responsive laptoponly" >
                    <img src="<?= IMG ?>/iphone.png" class="animation-element slide-left  img-responsive mobileonly" >
                </div>
            </div>
        </div>
    </section>

    <!-- For Casting Director Grid Section -->
     <a class="anchor" id="forDirector"></a>
    <section id="forDirector">
        <div class="container">
            <div class="row">
              <center>
                <h3>For Casting Directors</h3>
              </center>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="<?= IMG ?>/macbook_cd.png" class="animation-element slide-left  img-responsive laptoponly" >
                    <img src="<?= IMG ?>/ipadcd.png" class="animation-element slide-left  img-responsive mobileonly" >

                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-item">
                        <span class="info-item-title">Organize</span>
                        <span class="info-item-desc">All your actors in one searchable database.</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-title">Contact in Bulk</span>
                        <span class="info-item-desc">Email/SMS hundreds of actors in just one click.</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-title">Run audition</span>
                        <span class="info-item-desc">Track responses, attendance and shortlists with ease.</span>
                    </div>
                    <div>
                        <span  onmouseover='show_time_taken("cd")' onmouseout='hide_time_taken("cd")'><a href="<?=base_url() ?>home/choose_plan#forDirectors" class="btn btn-custom-outlined" >Sign up now</a></span>
                        <a href="<?=base_url() ?>home/pricing#forDirectors" class="btn btn-custom-outlined" target="_blank">See Pricing</a>
                        <div id="time_taken_cd" class="time_taken hidden">Just takes 2 mins</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <!--<section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Meet the Product</h2>
                    <hr style="width:25%;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mk48xRzuNvA" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-custom">Learn More</a>
                </div>
            </div>
        </div>
    </section>
-->

    <!-- Contact Section -->
     <a class="anchor" id="contact"></a>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Say Hola!</h2>
                    <div style="text-align:center;">
                                Its good to see you here!<br>
                            Want to say Hi ? Have some feedback?<br>
                        Leave a message and We promise to get back to you!
                    </div>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 center">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" validate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name_sender" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email_sender" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone_sender" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="3" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success" class="hidden">
                            <span class="firstcolor title"> Thank You! </span>
                            <br>
                            <span> We will get back to you soon! </span>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="click" id="submit_contact_message" class="btn btn-custom-outlined">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
     <?php include 'includes/footer.php'; ?>
    <!-- Modal -->
    <div id="loginModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content col-lg-8 center"  style="padding:0px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="tabs-left active"><a role="tab" data-toggle="tab" href="#actor">Directors</a></li>
              <li class="tabs-right"><a role="tab" data-toggle="tab" href="#cd">Actors</a></li>
            </ul>

            <div class="tab-content">
              <div id="actor" class="tab-pane fade in active">
                <p class="login_form">
                  <font class="info dark-gray center"> Log In | </font><a href="<?=base_url() ?>home/pricing#forDirectors"><font class="info firstcolor center"> Sign Up! </a></font>
                      <form role="form" id="login-form" class="login-forms" method="post">
                        <b><p class="text-danger" id="login-error-director"></p></b>
                      <div class="form-group col-lg-8 col-md-6 col-xs-12 center">
                        <input type="email" class="form-control login " id="username" name="email" placeholder= "Email" required oninvalid="this.setCustomValidity('You appear to have entered an invalid email. Please try again.')" />
                      </div>
                      <div class="form-group col-lg-8 col-md-6 col-xs-12 center">
                        <input type="password" class="form-control login " id="password" name="password" placeholder= "Password" required />
                        <input type="hidden" name="type" value="director">
                      </div>
                      <div class="checkbox-circle">
                        <a href="<?= base_url() ?>home/forgotpassword/" class="pull-right" style="color:blue;font-weight: 800;"><small>Forgot Password?</small></a>
                      </div><br>
                      <center><button type="submit" class="btn submit-btn firstcolor center" id="btn-login" ><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button></center>
                      <div class="alert alert-danger margin-top hidden" id="error-alert">
                       <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Error! </strong>
                         Please enter a valid Username and Password
                      </div>
                    </form>
                </p>
              </div>
              <div id="cd" class="tab-pane fade">
                <p class="login_form">
                <font class="info dark-gray  center"> Log In | <a href="<?=base_url() ?>home/pricing#forActors"><font class="info firstcolor center"> Sign Up! </a></font></font>
                    <form role="form" id="actor_login-form" class="login-forms" method="post" >
                    <b><p class="text-danger" id="login-error-actor"></p></b>
                    <div class="form-group col-lg-8 col-md-6 col-xs-12 center">
                      <input type="email" class="form-control login" id="email" name="email" placeholder= "Email" required oninvalid="this.setCustomValidity('You appear to have entered an invalid email. Please try again.')" />
                    </div>
                    <div class="form-group col-lg-8 col-md-6 col-xs-12 center">
                      <input type="password" class="form-control login" id="actor_password" name="password" placeholder= "Password" required />
                      <input type="hidden" name="type" value="actor">
                    </div>
                    <div class="checkbox-circle">
                        <a href="<?= base_url() ?>home/forgotpassword/" class="pull-right" style="color:blue;font-weight: 800;"><small>Forgot Password?</small></a>
                    </div><br>
                    <center>
                        <button type="submit" class="btn submit-btn firstcolor center" id="btn-login" ><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button>
                    </center>
                    <div class="alert alert-danger margin-top hidden" id="error-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>Error! </strong>
                       Please enter a valid Username and Password
                    </div>
                  </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->

    <script type="text/javascript">
        var redirect_url = '<?= isset($_GET['redirect']) ? trim($_GET['redirect']) : '' ?>';
    </script>
   

    <script src="<?= JS ?>/vendor/jquery-1.11.2.min.js"></script>
    <script src="<?= JS ?>/vendor/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?= JS ?>/vendor/classie.js"></script>
    <script src="<?= JS ?>/vendor/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= JS ?>/constants.js"></script>
    <script src="<?= JS ?>/landingpage.js"></script>
    <script src="<?= JS ?>/main.js"></script>
</body>

</html>
