<?php
  include 'includes/head.php';
 ?>

    <body>
        <style>
          body{
            padding-top: 90px;
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
    .navbar-nav > li > a:hover {
    color: #fff;
    background: #F7A9A9;
    }
    .footer-items a {
      color: rgba(255,255,255,0.7);
    }
    .footer-items a:hover {
      color: rgba(255,255,255,1);
      text-decoration: none;
    }

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
                            <a href="conversations" >Conversations</a>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#advancedSearch" ><span class="firstcolor"> Search</span>
                            </a>
                        </li>
                        <li >
                            <a href="#" data-toggle="modal" data-target="#<?= ($isAllowed) ? "inviteActors" : "notAllowedModal" ?>">
                              <span class="firstcolor" > Invite </span>
                            </a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down firstcolor" aria-hidden="true"></span></a>
                          <ul class="dropdown-menu">
                           <li><a href="#" class="changeCategory">Change Category</a></li>
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
           <!-- contact modal toggle -->
            <div class="container-fluid">
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <h3> Account Details </h3>
                <hr>
                <h4> Subscription Plan </h4> : Basic
                <h4> Subscription Started </h4> : 10 June, 2015
                <h4> Subscription Ends </h4> : 9 June, 2016
                <hr>
                <h4> SMS Credits </h4>
                SMS Credits used : 543
                SMS Credits remaining : 857;
                <a href="#"> Top Up </a>
              </div>
            </div>
      <script>
      var isAllowed = <?= ($isAllowed) ? 1 : 0; ?>;
      </script>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/footer.php';
  include 'includes/scripts.php';
?>
