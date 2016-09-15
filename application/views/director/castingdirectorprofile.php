<?php
  include 'includes/head.php';
 ?>
<link rel="stylesheet" href="<?=CSS?>/castingdirectorprofile.css">
<link href="<?= CSS ?>/landingpage.css" rel="stylesheet">
    <body>
        <style>
          body{
            padding-top: 120px;
            padding-bottom: 0px;
          }
          .rotate-img {
            -webkit-animation: rotation 2s infinite linear;
          }
          @-webkit-keyframes rotation {
              from {-webkit-transform: rotate(0deg);}
              to   {-webkit-transform: rotate(359deg);}
          }
          .email-templete {
            
          }
          .tab-content {
            padding: 10px 5px;
          }
      
        .ui-autocomplete.ui-widget-content{
        z-index: 1200;
        }
        #emailPreview, #previewSMS{
          z-index: 1200;
        }
        iframe#emailPreviewiFrame{
          border: none;
        }
        #emailtab, #smstab .active{
          border: 1px solid #FF3B49;
          padding: 0px;
          /* margin: 0px; */
          border-bottom: 0px;
          border-radius: 4px 4px 0px 0px;
        }
        .nav-tabs>li>a {
          margin-right: 0px;
        }
        .contact_inputs{
          height: 40px;
          border: 2px solid #EAEAEA;
          font-size: 14px;
          padding: 8px 8px 8px 8px;
          margin-bottom: 5px;
          border-radius: 0px;
              -webkit-box-shadow: none;
        }
        .contact_textarea{
          height: 340px;
        }
        .contact_inputs :focus{
          border: 1px solid #ff3b49;
        }
        .form-control:focus {
          border-color: #FF003A;
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 2px rgba(255, 0, 0, 0.6);
          border: 1px;
      }
      .form-group{
        margin-bottom: 0px;
      }
      .info{
        font-family: "Roboto","Open Sans";
        font-size: 15px;
      }
      .profile_image{
        height: 75px;
        width: 75px;
        border-radius: 50%;
        border: 2px solid white;
        transition: all .2s ease-in-out;

      }
      .profile_image:hover{
        transform: scale(1.1);
      }
      thead{
        font-family: "Open Sans";
        font-size: 16px;
        font-weight: 600;
        background: white;
        
      }
      th{
        color: #FF9800;
      }
      table{
        border: 1px solid #ddd;
      }
      .row_btn{
        color:#FF9800;
        margin-left: 5px;
      }
      .row_btn:hover{
        color: #F44336;
      }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    
        border-color: #ddd;
        box-shadow:none; 
    }
    .submit-btn {
      padding: 4px 8px;
    }
    .navbar-nav > li > a:hover{
      color: #fff;
      background:#F7A9A9;
      border-radius:30px; 
    }
    .footer-items a {
      color: rgba(255,255,255,0.7);
    }
    .footer-items a:hover {
      color: rgba(255,255,255,1);
      text-decoration: none;
    }
    .heading
    {
      font-size: 18px;
      color: #777788;
      font-family: Raleway;
      margin-top: 20px;
    }
    .sub_heading{
      
    }
    .data{
      font-size: 14px;
      font-family: Roboto;
    }
    .account_box .fa{
      color: #FFC107;
      margin-right: 5px;
      font-size: 10px;
      top: -2px;
      position: relative;
    }
    .account_box{
      margin-top: 20px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      min-height: 300px;
    }

    .ul_list a{
        color:#A4A6A9 !important;
        font-size: 14px !important;
    }
    .ul_list a:hover {
        background-color: #ffd6d9 !important;
        background-image: none;
        color : #fff !important;
    }

    /* Removes the default 20px margin and creates some padding space for the indicators and controls */


              </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
          
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
                       <li >
                            <a href="<?= base_url()?>director/"  > Dashboard
                            </a>
                        </li>
                        <li >
                            <a href="<?= base_url()?>director/account"  > Account
                            </a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down firstcolor" aria-hidden="true"></span></a>
                          <ul class="dropdown-menu">
                           <li><a href="#" class="changeCategory">Change Category</a></li>
                           <li><a href="<?= base_url() . "director/conversations" ?>" >Conversations</a></li>
                            <!--<li><a href="add_actor.php">Add</a></li>
                            <li><a class="not-active" href="#">Import</a></li>
                            <li><a class="not-active" href="#">Export</a></li>
                            <li role="separator" class="divider"></li>-->
                            <li><a href="<?= base_url() ?>home/logout/">Sign-Out</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
 


        <!-- Casting Director Header-->
        <div name="CDheader" class="center CDsection"> 
          <span> <img  class="companylogo" src="http://www.ijcprr.com/uploads/53b9377cec56b1404647292SP_Logo.png"></span><span><h1>Casting Bay</h1></span>
          </div>
          <nav class="navbar CDnavbar CDsection">
                    <div class="container-fluid center">
                      <ul class="nav navbar-nav CDnavbar">
                        <li><a href="#aboutus" href="#aboutus">About Us</a></li>
                        <li><a href="#team">Team</a></li>
                        <li><a href="#ourwork">Our Work</a></li>
                        <li><a href="#contactus">Contact Us</a></li>
                      </ul>
                    </div>
                  </nav>
        
        
        <!--About Us SECTION -->
        <div id="aboutus" class="container col-lg-12 col-md-12 col-sm-12 CDsection">
          <h2 class="center"> About Us </h2>
          <div class=" col-lg-10 center">
          <p class="sectioncontent"> Some the cursor property of cursor to be displayed when pointing on an elementThe cursor property specifies the type of cursor to be displayed when pointing on an elementThe cursor property specifies the type of cursor to be displayed when pointing on an elementThe cursor  type of cursor to be displayed when pointing on an elementThe cursor property specifies the type of cursor to be displayed when po elementThe cursor property specifies the type of cursor to be displayed when pointing on an elementThe cursor property specifies the type pointing on an element. </p>

          </div>
        </div>
        
        <!--TEAM SECTION -->
        <div id="team" class="container col-lg-12 col-md-12 col-sm-12 CDsection">
          <h2 class="center" id="team"> Team </h2>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <div class="card hovercard">
                          <div class="avatar">
                              <img alt="" src="<?=CSS?>/guyface.jpg">
                          </div>
                          <div class="info">
                              <div class="title">
                                  Abhishek Banerjee
                              </div>
                              <div class="desc">Co-Founder, Casting Director-in-Chief</div>
                      
                          </div>
                          <div class="bottom">
                              <a class="socialbtn btn-primary btn-sm" rel="publisher"
                                 href="https://plus.google.com/shahnuralam">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </div>
                      </div> <!-- first card -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <div class="card hovercard">
                          <div class="avatar">
                              <img alt="" src="<?=CSS?>/guyface.jpg">
                          </div>
                          <div class="info">
                              <div class="title">
                                  Abhishek Banerjee
                              </div>
                              <div class="desc">Co-Founder, Casting Director-in-Chief</div>
                      
                          </div>
                          <div class="bottom">
                              <a class="socialbtn btn-primary btn-sm" rel="publisher"
                                 href="https://plus.google.com/shahnuralam">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </div>
                      </div> <!-- first card --><!-- second card -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <div class="card hovercard">
                          <div class="avatar">
                              <img alt="" src="<?=CSS?>/guyface.jpg">
                          </div>
                          <div class="info">
                              <div class="title">
                                  Abhishek Banerjee
                              </div>
                              <div class="desc">Co-Founder, Casting Director-in-Chief</div>
                      
                          </div>
                          <div class="bottom">
                              <a class="socialbtn btn-primary btn-sm" rel="publisher"
                                 href="https://plus.google.com/shahnuralam">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </div>
                      </div> <!-- first card --><!-- third card -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <div class="card hovercard">
                          <div class="avatar">
                              <img alt="" src="<?=CSS?>/guyface.jpg">
                          </div>
                          <div class="info">
                              <div class="title">
                                  Abhishek Banerjee
                              </div>
                              <div class="desc">Co-Founder, Casting Director-in-Chief</div>
                      
                          </div>
                          <div class="bottom">
                              <a class="socialbtn btn-primary btn-sm" rel="publisher"
                                 href="https://plus.google.com/shahnuralam">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </div>
                      </div> <!-- first card --><!-- third card --><!-- fourth card -->
                    </div>

                  </div>
                </div>
          </div>

        <!--OUR WORK SECTION -->
        <div id="ourwork" class="CDsection">  
            <h2 class="center"> Our Work </h2><br>
            <div class="container-fluid center light-padded"> <!--TAGS-->      
                  <button id="button" class="btn submit-btn firstcolor center">Films</button>
                  <button class="btn submit-btn firstcolor center">Online</button>
                  <button class="btn submit-btn firstcolor center">Commercials</button>
                  <button class="btn submit-btn firstcolor center">Upcoming</button>
                  <button class="btn submit-btn firstcolor center">Ongoing</button>
                  <button class="btn submit-btn firstcolor center">Past Work</button>
            </div>

            <div class="container-fluid col-lg-8 center videoprojectcard">
              <div class="col-lg-6 videoprojectmedia">
                <img src="http://placehold.it/320x180" style="width:100%;">
              </div>
              <div class="col-lg-6">
                
                  <table class="videoprojecttable">
                    <tr> <td> Title </td> <td> Filmy Keeda </td></tr>
                    <tr> <td> Producer </td><td> Dharma Productions </td></tr>
                    <tr> <td> Date </td> <td> 22 October, 2012 </td> </tr>
                    <tr> <td> Remarks </td><td> One of our earliest films. We were responsible for casting 65 roles in the film. </td></tr>
                    <tr> <td> Team </td> <td> <a href="#"> Abhishek</a>, <a href="#"> Anmol </a></td></tr>
                    <tr> <td> Status </td> <td> <a href="#">Accepting Applications!</a></td> </tr>
                  </table>
                
              </div>

            </div>

            <div class="container-fluid">
              <div class="row-fluid">
                <div class="col-lg-8 center">
                      <div class="well"> 
                            <div id="myCarousel" class="carousel slide">
                             
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                
                            <div class="item active">
                              <div class="row-fluid">
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image" style="widt:=100%;"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"  style="widt:=100%;"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"  style="widt:=100%;"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"  style="widt:=100%;"/></a></div>
                              </div><!--/row-fluid-->
                            </div><!--/item-->
                            
                            <div class="item">
                              <div class="row-fluid">
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                              </div><!--/row-fluid-->
                            </div><!--/item--> 
                            
                             
                             <div class="item">
                              <div class="row-fluid">
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                              </div><!--/row-fluid-->
                            </div><!--/item-->

                            </div><!--/carousel-inner-->

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                            </div><!--/myCarousel-->
                             
                        </div><!--/well-->   
                </div>
              </div><!-- Thumbnails -->
            </div>
        </div> <!-- end of CDsection div -->

        <!--CONTACT US SECTION -->
        <div id="contactus" class="container col-lg-12 col-md-12 col-sm-12 CDsection">
            <h2 class="center"> Contact Us </h2><br>
              <div class="col-lg-8 center">
                <p class="sectioncontent" style="text-align:center;"> 
                You can get in touch with us at whatever@gmail.com. 
                </p>
              </div>
        </div>
</div>
    
</body>

        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/footer.php';
  include 'includes/scripts.php';
?>

<script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;

    $(document).ready(function() {
    $('#myCarousel').carousel({
      interval: 5000
  });
});


</script>
