<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Castiko | Makes Casting easier.</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?= CSS ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?= CSS ?>/landingpage.css" rel="stylesheet">
    <link href="<?= CSS ?>/navbar.css" rel="stylesheet">
    <link href="<?= CSS ?>/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

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
<style>
.pricing_banner{
    text-align: center;

}
.heading{
    font-size: 34px;
}
.category
{
    font-size: 18px;
}
.subtext{
    font-size: 12px;
}
.button_text{
    font-size: 14px;
}
.white{
    color: white;
}
.black{
    color: black;
}
.gray
{
    color: #4a4a4a;
}
.green
{
    color: #598725;
}
.sub_heading{
    background: rgba(255,255,255,0.6);
    border-radius: 15px;
    padding:10px;
    margin-top: 10px;
    margin-bottom: 20px;
}
.content-box{
    padding: 10px 15px 10px 15px;
    border-radius: 15px;
    background: #fff;
    margin-left: 5px;

}
.plus{
    color: #FBB61A;
    font-size: 18px;
}
.left_aligned{
    text-align: left;
}
hr{
    margin-bottom: 0px;
}
.btn{
    border-radius: 20px;
    border: 4px solid #FBB61A;
    position: relative;
    bottom: -30px;
    height: 40px;
    background: white;

}
.btn:hover{
    border: solid 2px #fbb515;
    color: #000;
    background: #fbb515;
}
.inner{
    background: #f2f2f2;
    padding: 10px 15px;
    font-size: 12px;
    font-family: "Open Sans";
    color: #4a4a4a;
    border-radius: 5px;
    width: 100%;
    text-shadow:none !important;
}
.expandButton{
    margin: 0px;
    padding: 0px;
}
.expandButton:hover{
    text-shadow: 0px 1px rgb(202, 202, 202);
}

a.anchor {
    display: block;
    position: relative;
    top: -120px;
    visibility: hidden;
}
.topmargin35
{
    margin-top: 35px;
}
.nohover{
    cursor: none;
}
.nolrpadding{
    padding-left: 0px;
    padding-right: 0px;
}

</style>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top">
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
                            <div class="vertical-middle brandname title">
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
                        <a href="#forActors">For Actors</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#forDirectors">For Casting Directors</a>
                    </li>
                   <!-- <li class="page-scroll">
                        <a href="#about">Video</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">FAQ</a>
                    </li>
                    -->
                    <li class="page-scroll">
                        <a data-target="#loginModal" data-toggle="modal">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <a class="anchor" id="forActors"></a>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="pricing_banner col-lg-8 col-xs-11 col-sm-11 center">
                <span class="heading white">Pricing</span><br>
                <div class="row">
                    <div class="sub_heading col-lg-12 col-md-12 col-sm-12 col-xs-12 heading gray center">
                            Actors
                            <div class="button_text gray">
                                Castiko is the easiet way for actors to showcase their work to Casting Directors
                            </div>
                    </div>
                </div>
                <div class="row center" style="text-align:center;">
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 topmargin35">
                        <div class="content-box">
                            <span class="category black"> <b>BASIC</b></span>
                            <br>
                            <span class="button_text green">Free</span>
                            <hr>
                            <div class="left_aligned">
                                <div class="expandButton">
                                    <span class="plus toggleEdit" id="plus1" data-hide-id="#plus1" data-unhide-id="#basic1,#minus1" >+</span><span id="minus1" data-hide-id="#minus1,#basic1" data-unhide-id="#plus1" class="plus toggleEdit hidden">o</span>
                                    <span class="subtext black"> Public profile with Photos and Videos. </span>
                                    <div id="basic1" class="inner hidden">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>The Castiko Profile is designed to showcase your talents. Add photos, videos, training and experience. Your unique link lets you share it with anyone - even outside Castiko.
                                    </div>
                                </div>
                                <div class="expandButton">
                                    <span class="plus toggleEdit" id="plus2" data-hide-id="#plus2" data-unhide-id="#basic2,#minus2" >+</span><span id="minus2" data-hide-id="#minus2,#basic2" data-unhide-id="#plus2" class="plus toggleEdit hidden">x</span>
                                    <span class="subtext black"> Unlimited Casting Director Invitations. </span>
                                    <div id="basic2" class="inner hidden">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Casting directors who already know you can add/invite you into their database.
                                    </div>
                                </div>
                            </div>
                            <button  class="btn"><a href="<?= base_url() . "home/register/actor?plan=basic" ?>" class="button_text black">GO BASIC</a></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-12 topmargin35">
                        <div class="content-box">
                            <span class="category black"> <b>PRO</b></span>
                            <br>
                            <span class="button_text green"><i class="fa fa-inr"></i>200/month.</span>
                            <hr>
                            <div class="left_aligned">
                                <div class="expandButton">
                                    <span class="plus toggleEdit" id="plus3" data-hide-id="#plus3" data-unhide-id="#pro1,#minus3" >+</span><span id="minus3" data-hide-id="#minus3,#pro1" data-unhide-id="#plus3" class="plus toggleEdit hidden">x</span>
                                    <span class="button_text black nohover"> <b>Searchable by all the Casting Directors.</b> </span>
                                    <div id="pro1" class="inner hidden">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Casting directors who don’t know you are often looking for new faces for projects. With Pro, we will make your profile searchable by all Casting Directors.
                                    </div>
                                </div>
                                <div class="expandButton">
                                    <span class="plus toggleEdit" id="plus4" data-hide-id="#plus4" data-unhide-id="#pro2,#minus4" >+</span><span id="minus4" data-hide-id="#minus4,#pro2" data-unhide-id="#plus4" class="plus toggleEdit hidden">x</span>
                                    <span class="button_text black"> <b>Access to targeted audition notices.</b> </span>
                                    <div id="pro2" class="inner hidden">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Audition Notices are an easy way to get audition information. Pro lets you see them right on your home page.
                                    </div>
                                </div>
                                <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>  <span class="button_text black"><b>Plus all the features in the basic </b></span>
                            </div>
                            <button type="button" class="btn"><a href="<?= base_url() . "home/register/actor?plan=pro" ?>" class="button_text black">GO PRO</a></button>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:180px;">
                    <a class="anchor" id="forDirectors"></a>
                    <div class="sub_heading col-lg-12 col-md-12 col-sm-12 col-xs-12 heading gray center">
                            Casting Directors
                            <div class="button_text gray">
                                Castiko makes your data easy to use - and lets you contact hundreds of actors in one go!
                            </div>
                    </div>
                    <div class="sub_heading col-lg-12 col-md-12 col-sm-12 col-xs-12 heading gray center">
                            <div class="button_text gray">
                                You can use all the Castiko's feature with any of the following plans.<br> For more information about the feature
                            </div>
                    </div>
                    
                </div>
                <div  class="row center" style="text-align:center;">
                    <div class="col-lg- col-md-4 col-xs-12 col-sm-12 topmargin35 ">
                        <div class="content-box">
                            <span class="category black"> <b>BASIC</b></span>
                            <br>
                            <span class="button_text black"><b> One off. Just looking to manage a project or two. </b></span>
                            <hr>
                            <span class="subtext black">1 Month</span>
                            <br>
                            <span class="button_text black"><b><i class="fa fa-inr"></i>5000/month</b></span>
                            <hr>
                            <span class="subtext black" style="text-align:center;"><i class="fa fa-inr"></i>5000/- </span>
                            <br>
                            <span class="subtext green">+ 100 SMS free</span>
                            <br>
                            <button type="button" class="btn"><a href="<?= base_url() . "home/register/director?plan=basic" ?>" class="button_text black">GO BASIC</a></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 topmargin35">
                        <div class="content-box">
                            <span class="category black"> <b>PRO</b></span>
                            <br>
                            <span class="button_text black"><b> Getting projects regularly,<br> buliding network. </b></span>
                            <hr>
                            <span class="subtext black">6 Months</span>
                            <br>
                            <span class="button_text black"><b><i class="fa fa-inr"></i>4500/month</b></span>
                            <hr>
                            <span class="subtext black" style="text-align:center;"><i class="fa fa-inr"></i>27000/- </span>
                            <br>
                            <span class="subtext green"><b> Save 10%!</span>
                            <br>
                            <span class="subtext green">+ 200 SMS free</span>
                            <br>
                            <button type="button" class="btn"><a href="<?= base_url() . "home/register/director?plan=pro" ?>" class="button_text black">GO PRO</a></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 topmargin35">
                        <div class="content-box">
                            <span class="category black"> <b>PRO<sup class="plus">+</sup></b></span>
                            <br>
                            <span class="button_text black"><b> Full scale casting setup,<br> big network of actors </b></span>
                            <hr>
                            <span class="subtext black">12 Months</span>
                            <br>
                            <span class="button_text black"><b><i class="fa fa-inr"></i>4000/month</b></span>
                            <hr>
                            <span class="subtext black" style="text-align:center;"><i class="fa fa-inr"></i>48000/- </span>
                            <br>
                            <span class="subtext green"><b> Save 20%!</span>
                            <br>
                            <span class="subtext green">+ 500 SMS free</span>
                            <br>
                            <button type="button" class="btn"><a href="<?= base_url() . "home/register/director?plan=pro-plus" ?>"class="button_text black">GO PRO-PLUS</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

   
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
   

    <script src="<?= JS ?>/vendor/jquery-1.11.2.min.js"></script>
    <script src="<?= JS ?>/vendor/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?= JS ?>/vendor/classie.js"></script>
    <script src="<?= JS ?>/vendor/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= JS ?>/main.js"></script>
    <script src="<?= JS ?>/landingpage.js"></script>
</body>

</html>
