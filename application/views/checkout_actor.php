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
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:800,200,100,300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= IMG ?>/favicon.ico" type="image/x-icon">
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
  <script type="text/javascript">
      var plan = <?= $plan ?>;
      var payee = '<?= $this->session->userdata("StaSh_User_type") ?>';
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
    padding: 6px;
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
.labels{
    font-size: 15px;
    color: #777;
    text-align: left;
    margin-bottom: 10px;
}
.checkout_box{
    border-radius: 10px;
    border: 1px solid #fff;
    padding: 10px;
    background: white;
}
.data{
    color: black;
    font-size: 15px;
}
.col-xs-12 {
    margin-top: 30px;
}
.im-powered-link{
    display: none !important;
}
.im-checkout-btn{
    margin-top: 5px !important;
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
                    <li><a href="<?= base_url() ?>home/logout/">Sign-Out</a></li>
                   <!-- <li class="page-scroll">
                        <a href="#about">Video</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">FAQ</a>
                    </li>
                    -->
                    <!-- <li class="page-scroll">
                        <?php
                            if($this->session->userdata("StaSh_User_Logged_In")){
                                $a = $this->session->userdata("StaSh_User_type");
                                echo '<a href="'.base_url(). $a.'/">Dashboard</a>';
                            }else{
                                echo '<a data-target="#loginModal" data-toggle="modal">Login</a>';
                            }
                        ?>
                    </li> -->
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
                <span class="heading white">CHECKOUT</span><br>
                <div class="row">
                    <div class="col-sm-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="checkout_box">
                            <div class="row">
                                <span class="labels col-xs-6">Name : </span>
                                <span class="col-xs-6 data"><? echo $this->session->userdata("StaSh_User_name"); ?></span>
                            </div>
                            <div class="row">
                                <span class="labels col-xs-6">Plan : </span>
                                <span class="col-xs-6 data">
                                    <select id="planselector">
                                        <option value="Actor-Basic" id="actor_basic" <? if($plan==0){echo 'selected="selected"';} ?> > Actor - Basic </option>
                                        <option value="Actor-Pro" id="actor_pro" <? if($plan==1){echo 'selected="selected"';} ?>> Actor - Pro </option>
                                    </select>
                                </span>
                            </div>
                            <div class="row">
                                <span class="labels col-xs-6">Pricing : </span>
                                <span class="col-xs-6 data"><i class="fa fa-inr"></i><span id="price_per_month"></span></span>
                            </div>
                            <div class="row" id="months_row">
                                <span class="labels col-xs-6">Months : </span>
                                <span class="col-xs-6 data">
                                    <select id="months">
                                        <option value="3" id="3_months"> 3 Months</option>
                                        <option value="6" id="6_months"> 6 Months</option>
                                        <option value="12" id="12_months"> 12 Months</option>
                                    </select>
                                </span>
                            </div>
                            <hr>
                            <br>
                            <div class="row">
                                <span class="label_big col-xs-6 black category">Amount : </span>
                                <span class="col-xs-6 data_big green category"><i class="fa fa-inr"></i><span id="net_amount"></span>.00/-</span>
                            </div>
                            <button type="button" id="checkout_btn_basic_actor" class="btn checkout_btn hidden ">
                                <a href="#">Go Basic</a>
                            </button>
                            <button type="button" id="checkout_btn_pro_3" class="btn checkout_btn hidden ">
                                    <a href="https://www.instamojo.com/paycastiko/castiko-actor-membership-pro-plan-3-months/" rel="im-checkout" data-behaviour="remote" data-style="light" data-text="Checkout With Instamojo" data-token="43c9fd9353701a50b5cceafef6e13b6f"></a>
                                    <script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>
                            </button>
                            <button type="button" id="checkout_btn_pro_6" class="btn hidden checkout_btn">
                                <a href="https://www.instamojo.com/paycastiko/castiko-actor-membership-pro-6-months/" class="btn" style="z-index:999999;" id="pay_link" rel="im-checkout" data-behaviour="remote" data-style="no-style" data-text="Checkout With Instamojo" data-token="43c9fd9353701a50b5cceafef6e13b6f"></a>
                               
                            </button>
                            <button type="button" id="checkout_btn_pro_12" class="btn hidden checkout_btn">
                                <a href="https://www.instamojo.com/paycastiko/castiko-actor-membership-pro-plan-12-months/" id="pay_link" class="btn" style="z-index:999999;" rel="im-checkout" data-behaviour="remote" data-style="no-style" data-text="Checkout With Instamojo" data-token="43c9fd9353701a50b5cceafef6e13b6f"></a>
                                
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="content-box hidden" id="basic_content"> 
                            <span class="category black "> <b>BASIC</b></span>
                            <br>
                            <span class="button_text green">Free</span>
                            <hr>
                            <div class="left_aligned">
                                <div class="expandButton">
                                    <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>
                                    <span class="subtext black"> Public profile with Photos and Videos. </span>
                                    <div id="basic1" class="inner">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>The Castiko Profile is designed to showcase your talents. Add photos, videos, training and experience. Your unique link lets you share it with anyone - even outside Castiko.
                                    </div>
                                </div>
                                <div class="expandButton">
                                    <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>
                                    <span class="subtext black"> Unlimited Casting Director Invitations. </span>
                                    <div id="basic2" class="inner">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Casting directors who already know you can add/invite you into their database.
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="content-box" id="pro_content">
                            <span class="category black"> <b>PRO</b></span>
                            <br>
                            <span class="button_text green"><i class="fa fa-inr"></i>200/month</span>
                            <hr>
                            <div class="left_aligned">
                                <div class="expandButton">
                                    <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>
                                    <span class="button_text black nohover"> <b>Searchable by all the Casting Directors.</b> </span>
                                    <div id="pro1" class="inner">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Casting directors who don’t know you are often looking for new faces for projects. With Pro, we will make your profile searchable by all Casting Directors.
                                    </div>
                                </div>
                                <div class="expandButton">
                                <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>
                                <span class="button_text black"> <b>Access to targeted audition notices.</b> </span>
                                    <div id="pro2" class="inner">
                                        <span class="glyphicon glyphicon-triangle-right green subtext"></span>Audition Notices are an easy way to get audition information. Pro lets you see them right on your home page.
                                    </div>
                                </div>
                                <span class="glyphicon glyphicon-ok plus" style="font-size:10px;"></span>  <span class="button_text black"><b>Plus all the features in the basic </b></span>
                            </div>
                            
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
    <script src="<?= JS ?>/checkout.js"></script>
</body>

</html>
