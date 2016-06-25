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
body{
    padding-top: 140px;
}
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
a:hover, a:focus {
    color: #23527c;
    text-decoration: none;
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
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <div class="checkout_box">
                <div class="row">
                    <span class="label col-xs-6">Name : </span>
                    <span class="col-xs-6 data">Prashant Kiran</span>
                </div>
                <div>
                    <span class="label col-xs-6">Plan : </span>
                    <span class="col-xs-6 data">
                        <select>
                            <option value="Actor-Basic" id="actor_basic"> Actor - Basic </option>
                            <option value="Actor-Pro" id="actor_pro"> Actor - Pro </option>
                        </select>
                    </span>
                </div>
                <div class="row">
                    <span class="label col-xs-6">Pricing : </span>
                    <span class="col-xs-6 data"><i class="fa fa-inr"></i>200/p.m</span>
                </div>
                <div>
                    <span class="label col-xs-6">Months : </span>
                    <span class="col-xs-6 data">
                        <select>
                            <option value="3" id="3_months"> 3 Months</option>
                            <option value="6" id="6_months"> 6 Months</option>
                            <option value="12" id="12_months"> 12 Months</option>
                        </select>
                    </span>
                </div>
                <hr>
                <div class="row">
                    <span class="label_big col-xs-6">Amount : </span>
                    <span class="col-xs-6 data_big"><i class="fa fa-inr"></i>600/p.m</span>
                </div>
                
            </div>
        </div>
        <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
            <div class="content-box hidden">
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
            </div> <!-- Pro Ends -->
            <!-- Basic starts -->
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
    </div>
    

   
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
