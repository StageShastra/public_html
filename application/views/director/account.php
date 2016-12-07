<?php
  include 'includes/head.php';
 ?>

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
        align:left;
        
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
          </div>
           <!-- contact modal toggle -->
            <div class="container-fluid">
              <div class="col-lg-4 col-sm-4 col-xs-12 account_box">
                <div class="heading"><i class="fa fa-dashboard"></i> Account Details</div>
                <hr>
                <div class="heading"><i class="fa fa-user"></i> <?= $profile['StashUsers_name'] ?></div>
                <div class="sub_heading"><i class="fa fa-envelope"></i> <i><?= $profile['StashUsers_email'] ?></i></div>
                <div class="sub_heading"><i class="fa fa-mobile"></i> <i><?= $profile['StashUsers_mobile'] ?></i></div>
                <hr>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-shopping-bag"></i>Subscription Plan </div>
                  <span class="data col-sm-4"> <?= ucfirst($plan['StashDirectorPlan_plan']) ?> </span>
                </div>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-hourglass-start"></i>Subscription Started </div>
                  <span class="data col-sm-4"> <?= date("d M, Y", $plan['StashDirectorPlan_start']) ?> </span>
                </div>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-hourglass-end"></i>Subscription Ends </div>
                  <span class="data col-sm-4"> <?= date("d M, Y", $plan['StashDirectorPlan_end']) ?> </span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-12 account_box">
                <div class="heading"><i class="fa fa-envelope"></i> SMS Credits</div>
                <hr>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-money"></i>SMS Credits  </div>
                  <span class="data col-sm-4"> <?= $plan['StashDirectorPlan_free_sms'] ?></span>
                </div>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-commenting"></i>SMS Credits Used </div>
                  <span class="data col-sm-4"> <?= $plan['StashDirectorPlan_used_sms'] ?></span>
                </div>
                <div class="row">
                  <div class="sub_heading col-sm-8"> <i class="fa fa-envelope-o"></i>SMS Credits Available </div>
                  <span class="data col-sm-4"> <?= $plan['StashDirectorPlan_free_sms'] - $plan['StashDirectorPlan_used_sms'] ?> </span>
                </div>
                <hr>
                <div class="heading hidden"><i class="fa fa-plus"></i>Top-Up SMS Credits</div>
                <div class="row hidden">
                  <div class="sub_heading col-sm-5"> <i class="fa fa-user-secret"></i>Amount </div>
                  <span class="data col-sm-7"> 
                    <select>
                      <option value="1000"> 1000 @ 16p/sms </option>
                      <option value="5000"> 5000 @ 16p/sms</option>
                      <option value="10000"> 10000 @ 15p/sms</option>
                      <option value="50000"> 50000 @ 14p/sms</option> 
                      <option value="100000"> 100000 @14p/sms </option>      
                    </select>
                  </span>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-12 account_box">
                <div class="heading"><i class="fa fa-pencil"></i> Change Password</div>
                <p class="text-warning" id="changepassword_err" style="display:none;"></p>
                <hr>
                <div class="row">
                  <div class="sub_heading col-sm-5"> <i class="fa fa-cog"></i>Current Password </div>
                  <span class="data col-sm-7"> <input type="password" name="current_passowrd" id="current_password"></input></span>
                </div>
                <hr>
                
                <div class="row">
                  <div class="sub_heading col-sm-5"> <i class="fa fa-user-secret"></i>New Password </div>
                  <span class="data col-sm-7"> <input type="password" name="new_passowrd" id="new_password"></input></span>
                </div>
                <br>
                <div class="row">
                  <div class="sub_heading col-sm-5"> <i class="fa fa-check-square-o"></i>Confirm Password </div>
                  <span class="data col-sm-7"> <input type="password" name="confirm_passowrd" id="confirm_password"></input></span>
                </div>
                <center><button type="button" class="btn submit-btn changePassword">Change Password</button></center>
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
