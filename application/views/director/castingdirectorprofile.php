<?php
  include 'includes/head.php';
  error_reporting(0);
  $e_works=addslashes($works);

 ?>
<link rel="stylesheet" href="<?=CSS?>/castingdirectorprofile.css">
<link href="<?= CSS ?>/landingpage.css" rel="stylesheet">




    <body>
        <style>
          body{
            padding-top: 30px;
            padding-bottom: 0px;
            font-weight: 300;
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
    .team-card{
      min-height: 275px;
    }
    .fa-facebook-official{
      color:#3b5998;
      font-size: 14px;
    }
    .fa-external-link-square{
      color:#e9c332;
      font-size: 14px;
    }
    /* Removes the default 20px margin and creates some padding space for the indicators and controls */


nav {
  height: 40px;
  width: 100%;
  font-size: 1.3rem;
  font-weight: bold;
  position: relative;
  color: #777;
}
nav ul {
  padding-left: 0;
  margin: 0 auto;
  width: 600px;
  height: 40px;
}

nav li {
  display: inline;
  float: left;
  vertical-align: middle;
}

.clearfix:before,
.clearfix:after {
    content: " ";
    display: table;
}
.clearfix:after {
    clear: both;
}
.clearfix {
    *zoom: 1;
}

nav a {
  display: inline-block;
  width: 150px;
  text-align: center;
  text-decoration: none;
  line-height: 40px;
  font-size:1.8rem;
}



nav a:hover, nav a:active {
  color: #b9160a;
}

nav a#pull {
  display: none;
} 

@media screen and (max-width: 600px) {
  nav { 
      height: auto;
    }
    nav ul {
      width: 100%;
      display: block;
      height: auto;
    }
    nav li {
      width: 50%;
      float: left;
      position: relative;
    }
    nav li a {
    
  }
    nav a {
      text-align: left;
      width: 100%;
      text-indent: 25px;
    }
}

@media only screen and (max-width : 480px) {
  nav {
    border-bottom: 0;
  }
  nav ul {
    display: none;
    height: auto;
  }
  nav a#pull {
    display: block;
    width: 100%;
    position: relative;
    text-align: center;
    border-radius: 5px;
    -webkit-box-shadow: 0px 0px 43px -5px rgba(219,219,219,1);
-moz-box-shadow: 0px 0px 43px -5px rgba(219,219,219,1);
box-shadow: 0px 0px 43px -5px rgba(219,219,219,1);
  }
  nav a#pull:after {
    content:"";
    background: url('nav-icon.png') no-repeat;
    width: 30px;
    height: 30px;
    display: inline-block;
    position: absolute;
    right: 15px;
    top: 10px;
    
  }
}

@media only screen and (max-width : 320px) {
  nav li {
    display: block;
    float: none;
    width: 100%;
  }
  nav li a {
    
  }
}

              </style>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
          
        <!-- Ths section is post selection !-->
<div class="container-fluid" id="home">
           
       

        <!-- Casting Director Header-->
        <div name="CDheader" class="center CDsection"> 
          <img  class="companylogo img-responsive center" src="<?= IMG . "/pages/" . $basic['DirectorPage_logo'] ?>" alt='<?= $basic['DirectorPage_pagename'] ?>'><span></span>
          </div>
         <div class="CDsection">
           <nav class="clearfix">
            <ul class="clearfix">
              <li><a href="#aboutus">About Us</a></li>
              <li><a href="#team">Team</a></li>
              <li><a href="#ourwork">Our Work</a></li>
              <li><a href="#contactus">Contact Us</a></li>  
            </ul>
            <a href="#" id="pull">Menu</a>
          </nav>
        </div>

        <!--  <div class="col-xs-12">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>
          </div>
          <nav class="navbar CDnavbar CDsection collapse navbar-collapse">
                    <div class="container-fluid center"  id="bs-example-navbar-collapse-2">
                      <ul class="nav navbar-nav CDnavbar ul_list">
                        <li><a href="#aboutus" href="#aboutus">About Us</a></li>
                        <li><a href="#team">Team</a></li>
                        <li><a href="#ourwork">Our Work</a></li>
                        <li><a href="#contactus">Contact Us</a></li>
                      </ul>
                    </div>
                  </nav>
        -->
        
        <!--About Us SECTION -->
        <div id="aboutus" class="container col-lg-12 col-md-12 col-sm-12 CDsection">
          <h2 class="center"> About Us </h2>
          <div class=" col-lg-10 center">
          <p class="sectioncontent"> 
          <?= htmlentities($basic['DirectorPage_about']) ?>
          </p>

          </div>
        </div>
        
        <!--TEAM SECTION -->
        <div id="team" class="container col-lg-12 col-md-12 col-sm-12 CDsection">
          <h2 class="center" id="team"> Team </h2>
                <div class="container">
                  <div class="row">
                  <?php

                    foreach ($teams as $key => $team) {
                  ?>
                    <div class="col-lg-3 col-sm-6 team-card">
                      <div class="card hovercard">
                          <div class="avatar">
                              <img alt="<?= $team['DirectorTeam_name'] ?>" src="<?= IMG ?>/teams/<?= $team['DirectorTeam_image'] ?>" height="150" width="150">
                          </div>
                          <div class="info">
                              <div class="title">
                                  <?= $team['DirectorTeam_name'] ?>
                              </div>
                              <div class="desc"><?= $team['DirectorTeam_title'] ."<br>". $team['DirectorTeam_desc'] ?></div>
                      
                          </div>
                          <div class="bottom">
                              <a class="socialbtn" rel="publisher"
                                 href="<?= $team['DirectorTeam_fb'] ?>" title='Facebook'>
                                  <i class="fa fa-facebook-official"></i>
                              </a>
                              &nbsp;
                              <?  if($team['DirectorTeam_imdb']!='')
                              {
                              ?>
                            
                              <a class="socialbtn" rel="publisher"
                                 href="<?=$team['DirectorTeam_imdb']?>" title='IMDB'>
                                  <i class="fa fa-external-link-square"></i>
                              </a>
                              <? } ?>
                          </div>
                      </div> <!-- first card -->
                    </div>
                  <?php
                    }

                  ?>

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
            <?php
              $regex = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
              $ytube = preg_match($regex, $works[0]['DirectorWork_youtube_link'], $matches);
              if(isset($matches[2]) && trim($matches[2]) != ''){
                $ytube = trim($matches[2]);
              }else{
                $ytube = '';
              }
              $embed = 'https://www.youtube.com/embed/' . $ytube;

            ?>
            <div class="container-fluid col-xs-12 col-sm-12 col-md-12 col-lg-8 center videoprojectcard">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 videoprojectmedia">
                <!-- <img src="http://placehold.it/320x180" style="width:100%;"> -->
                <iframe width="320" height="180" src="<?= $embed ?>" frameborder="0" allowfullscreen></iframe>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                
                  <table class="videoprojecttable">
                    <tr> <td> Title </td> <td> <?= $works[0]['DirectorWork_title'] ?> </td></tr>
                    <tr> <td> Producer </td><td> <?= $works[0]['DirectorWork_producer'] ?> </td></tr>
                    <tr> <td> Date </td> <td> <?= $works[0]['DirectorWork_date'] ?> </td> </tr>
                    <tr> <td> Remarks </td><td> <?= $works[0]['DirectorWork_remark'] ?> </td></tr>
                   <!--  <tr> <td> Team </td> <td> <a href="#"> Abhishek</a>, <a href="#"> Anmol </a></td></tr> -->
                    <tr> <td> Status </td> <td> <a href="#"><?= ($works[0]['DirectorWork_accept_application']) ? "Accepting application !" : "Application Closed!" ?></a></td> </tr>
                  </table>
                
              </div>

            </div>

            <div class="container-fluid">
              <div class="row-fluid">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 center">
                      <div class="well"> 
                            <div id="myCarousel" class="carousel slide">
                             
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            
                            <!-- Carousel items -->
                            <div class="carousel-inner">

                            <?php

                              $open = false;
                              $active = 'active';
                              
                              foreach ($works as $key => $work) {
                                    
                                if(($key)%4 == 0 || $key==0){
                                  if($open){
                                    echo '</div></div>';
                                  }
                                  echo '<div class="item '.$active.'"><div class="row-fluid">';
                                  $active = '';
                                  $open = true;
                                }

                                $ytube = preg_match($regex, $work['DirectorWork_youtube_link'], $matches);
                                if(isset($matches[2]) && trim($matches[2]) != ''){
                                  $ytube = trim($matches[2]);
                                }else{
                                  $ytube = '';
                                }

                                //$embed = 'https://www.youtube.com/embed/' . $ytube;
                                $embed = "http://img.youtube.com/vi/{$ytube}/default.jpg";
                                $title = $work['DirectorWork_title'];
                                $ref = $work['DirectorWork_id'];

                                echo '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">'
                                    . '<a href="#" class="thumbnail displayFullWorkDetail" data-ytube="'.$ytube.'" data-work-ref="'.$key.'" title="'.$title.'" >' 
                                    . '<img src="'.$embed.'" alt="Image" style="width:100%;" width="140" height="100" />'
                                    /*. '<iframe width="140" height="100" src="'.$embed.'" frameborder="0" allowfullscreen></iframe>'*/
                                    . '</a>'
                                    . '</div>';

                                

                              }

                            ?>                            
                             
                             <!-- <div class="item">
                              <div class="row-fluid">
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                                <div class="col-lg-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/140x100" alt="Image"/></a></div>
                              </div>
                            </div> -->
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
                <?= $basic['DirectorPage_contact'] ?> 
                </p>
              </div>
        </div>
</div>
    
</body>

<script type="text/javascript">
  var WorkJSON =  <?php echo "'".addslashes(json_encode($works))."'"; ?> ;
  //console.log(WorkJSON);
</script>

        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/scripts.php';
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;

    $(document).ready(function() {
    $('#myCarousel').carousel({
      interval: 5000
  });
});

$(function() {
  var pull    = $('#pull');
    menu    = $('nav ul');
    menuHeight  = menu.height();
 
  $(pull).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle();
  });
});

$(window).resize(function(){
  var w = $(window).width();
  if(w > 320 && menu.is(':hidden')) {
    menu.removeAttr('style');
  }
}); 

</script>
