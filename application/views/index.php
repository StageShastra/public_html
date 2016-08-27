<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Castiko is a platform to connect Actors and Casting Directors. Actors – create your own acting profiles with photos & videos. Get auditions. Casting directors – manage all your data, run auditions and find new actors">
    <meta name="keywords" content="Acting, Audition, Actor, Casting, Film, Castiko's Official Website, Casting Directors in Mumbai, Search Actors">
    <meta name="filename" content="Castiko-Acting-Audition-Casting-Tool-Home">
    <meta property="og:title" content="Castiko |  Making casting easier!"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.castiko.com/"/>
    <meta property="og:image" content="http://www.castiko.com/assets/img/logo.png"/>
    <meta property="og:description" content="Castiko is a platform to connect Actors and Casting Directors. Actors – create your own acting profiles with photos & videos. Get auditions. Casting directors – manage all your data, run auditions and find new actors"/>
    <title>Castiko | Acting auditions and casting for film production</title>
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
                            <img src="<?= IMG ?>/logo.png" alt="Castiko's Official Logo" class="brands img-responsive "/>
                            <div class="vertical-middle brandname title ">
                                <?= M_Title ?>
                                <br>
                                <span id="tag-line" class="firstcolor info-small hidden-xs">
                                Making casting easier.                     
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
                        <a href="http://castiko.com/blog/this-is-castiko/" target="_blank">Why Castiko?</a>
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
                    -->
                    <li class="page-scroll">
                        <a href="#FAQ">FAQ</a>
                    </li>
                    
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
                        <h3 class="name">Making casting easier.</h3>
                        <h1 class="skills">Castiko makes it easier for actors and casting directors <br>  to work together.</h1>
                        <div><a href="#forActor" class="btn btn-custom">I'm an Actor</a>
                        <a href="#forDirector" class="btn btn-custom">I'm a Casting Director</a>
                        <a data-target="#loginModal" data-toggle="modal" class="btn btn-custom">Login</a>
                        </div>
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
                        <a href="<?=base_url() ?>home/register/actor?plan=basic" class="btn btn-custom-outlined"  onmouseover='show_time_taken("a")' onmouseout='hide_time_taken("a")' target="_blank">Sign up now</a>
                        <a href="<?=base_url() ?>home/pricing#forActors" class="btn btn-custom-outlined" target="_blank">See Pricing</a>
                    </div>
                    <div id="time_taken_a" class="time_taken hidden">Just takes 2 mins</div>
                </div>
                <div class="col-md-6 col-xs-6 col-sm-6 deviceholder" >
                    <img src="<?= IMG ?>/macbook.png" alt="Castiko's Sample Actor Profile on Macbook" class="animation-element slide-left img-responsive laptoponly" >
                    <img src="<?= IMG ?>/iphone.png" alt="Castiko's Sample Actor Profile on Iphone" class="animation-element slide-left  img-responsive mobileonly" >
                </div>
            </div>
        </div>
    </section>

    <!-- For Casting Director Grid Section -->
    <br>
    <a class="anchor" id="forDirector"></a>
    <section id="forDirector">
        <div class="container">
            <div class="row">
              <center>
                <h3>For Casting Directors</h3>
              </center>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="<?= IMG ?>/macbook_cd.png" alt="Castiko's Sample Casting Director Dashboard on Macbook" class="animation-element slide-left  img-responsive laptoponly" >
                    <img src="<?= IMG ?>/ipadcd.png" alt=" Castiko's Sample Casting Director Dashboard on Ipad" class="animation-element slide-left  img-responsive mobileonly" >

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
                        <span  onmouseover='show_time_taken("cd")' onmouseout='hide_time_taken("cd")'><a href="<?=base_url() ?>home/demo" class="btn btn-custom-outlined" >Get Demo</a></span>
                        <a href="<?=base_url() ?>home/pricing#forDirectors" class="btn btn-custom-outlined" target="_blank">See Pricing</a>
                        <div id="time_taken_cd" class="time_taken hidden"></div>
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
	<!-- FAQ Section -->
	<br>
	<a class="anchor" id="FAQ"></a>
    <section id="FAQ">
        <div class="container">
            <div class="row">
              <center>
                <h3>FAQs</h3>
              </center>


<head>
<style>

button.accordion {
    cursor: pointer;
    padding: 12px;
    width: 100%;
    border-radius: 5px;
    font-size: 20px;
    text-transform: uppercase;
    background-color: white;
    border: 2px solid #f3525b;
    outline:none;
    text-align: left;
    transition: 0.5s;
}

button.accordion.active, button.accordion:hover {  
    border: 2px solid #f3525b;
    background-color: #f3525b;
    color: white;

}

button.accordion.active{
    border-radius: 10px 10px 0px 0px;
}



button.accordion2 {
    cursor: pointer;
    padding: 12px;
    width: 100%;
    transition: 0.5s;
    border-style:solid;
    border-width:0px 0px 2px 0px;
    border-color: #fcb33e;
    font-size: 16px;
    background-color: white;
    outline:none;
    text-align: left;
}


button.accordion2.active, button.accordion2:hover {
    background-color: #fcb33e;
}

button.accordion2.active{
border-radius: 0px 0px 0px 0px;
}


div.panel {
    padding: 0 5px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.5s;
    opacity: 0;
    width: 100%;
}

div.panel.show {
    opacity: 1;
    max-height: 1000px;
    border:none;
    outline:none;
}

div.panel2 {
    padding: 10px 20px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.5s;
    opacity: 0;
    width: 100%; 
}

div.panel2.show {
    opacity: 1;
    max-height: 500px;
    border-radius: 0px 0px 0px 0px;
    border:2px solid #fcb33e;
    outline: none;

}

.col-centered{
    float: none;
    margin: 0 auto;
}

</style>
</head>

<div class="row"> 
<div class="col-lg-8 col-centered">
	
	<button class="accordion">Actors</button>
		<div class="panel">
			<button class="accordion2">I'm an actor. How will Castiko help me?</button>
				<div class="panel2">
					Castiko allows you to make a profile that will directly be added to casting directors databases. This helps them remember you, and makes it easy for them to contact you for auditions.
				</div>
			<button class="accordion2">What are the benefits of a free (Basic) account?</button>
				<div class="panel2">
					If a casting director already knows you and adds you to their database, you do not need to pay a penny. Just create a free account and your profile will show up on their laptops.

					You also no longer need to keep sending emails to casting directors. Your profile has a public shareable link so you can share it with whoever you want!

				</div>
			<button class="accordion2">What are the benefits of a paid (Pro) account?</button>
				<div class="panel2">
					There might be casting directors on Castiko who do not know you yet. If you would like us to make your profile visible to them and get open audition notices, then you should get the Pro account.
				</div>
			<button class="accordion2">What information can I include in my profile?
</button>
				<div class="panel2">
					You can add your basic information, including height, weight and screen age. You can add up to 10 photos, and as many YouTube videos as you want. You can also add your training, languages and special skills you want casting directors to know about. See our sample actor profile <a href="castiko.com/johndoe">here</a>.

				</div>
			<button class="accordion2">Will everyone be able to see my contact details? 
</button>
				<div class="panel2">
					No, your contact details are private, and will only be visible to casting directors you choose to share them with.
				</div>
			<button class="accordion2">Is my profile visible on Google?</button>
				<div class="panel2">
				Yes, but not on page 1. Unless you link it on your social media pages and other websites, it's unlikely to show up on page 1. You will have a lot of control over who gets to see your profile.
				</div>
			<button class="accordion2">What if I face problems? 
</button>
				<div class="panel2">
					You can call or email us any time and we will do our best to help you solve the issue. Our numbers are at the bottom of this page.
				</div>

		</div>
	<button class="accordion">Casting Directors</button>
		<div class="panel">
			<button class="accordion2">I'm a casting director. How will Castiko help me?</button>
				<div class="panel2">
					Castiko is a comprehensive solution for you. <br>
						<ul>
						<li>You can bring all your actor data in one place, thus eliminating Excel sheets and pen and paper.</li>
						<li>You can message actors to come and audition in just one click, thus saving hours and hours of time you spend SMSing and calling them individually.</li></ul>
				</div>
			<button class="accordion2">So how does it work?</button>
				<div class="panel2">
					Easy as 1-2-3. You sign up for an account. We help you upload all your data to Castiko. And you're ready to go! You can instantly start SMS-ing, emailing, and running auditions right from your dashboard.

				</div>
			<button class="accordion2">Will I have to keep updating it again and again?</button>
				<div class="panel2">
				No. We've built powerful features to help you manage it all in no time. For example, during an audition you can use Castiko's Casting Sheet feature so that all the audition data is already there at the end of the audition at zero extra effort.
				</div>
			<button class="accordion2">What if I want extra features?
</button>
				<div class="panel2">
				We are building Castiko step-by-step in deep consultation with experienced and new casting directors. We can't promise you new features immediately, but if it will help your workflow better, we are open to discussing it with you. Your convenience is our top priority.				</div>
		</div>
		<button class="accordion">Other Questions</button>
		<div class="panel">
			<button class="accordion2">I'm not a casting director, but I'm still looking for talent. Is  Castiko still useful to me?</button>
				<div class="panel2">
					Yes. We have a lot of actors who sign up independent of casting directors. They are hoping to be contacted by people like you.
				</div>
			<button class="accordion2">My question isn't here.</button>
				<div class="panel2">
					No problem - just send us a message using the form below and we'll get right back to you.
				</div>
		</div>



</div>
</div>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}

var acc2 = document.getElementsByClassName("accordion2");
var j;

for (j = 0; j < acc2.length; j++) {
    acc2[j].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}


</script>

</body>
</html>












    <!-- Contact Section -->
     <a class="anchor" id="contact"></a>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Say hello!</h2>
                    <div style="text-align:center;">
                        It's good to see you here.<br> 
                        Leave us a message and we will get back to you shortly.
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
              <li class="tabs-left "><a role="tab" data-toggle="tab" href="#actor">Directors</a></li>
              <li class="tabs-right active"><a role="tab" data-toggle="tab" href="#cd">Actors</a></li>
            </ul>

            <div class="tab-content">
              <div id="actor" class="tab-pane fade ">
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
              <div id="cd" class="tab-pane fade in active">
                <p class="login_form">
                <font class="info dark-gray  center"> Log In | <a href="<?=base_url() ?>home/register/actor"><font class="info firstcolor center"> Sign Up! </a></font></font>
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
