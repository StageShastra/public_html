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
      font-family: "Open Sans";
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
    }
    .navbar-nav > li > a{
        font-size: 14px !important;
    }
    .navbar-nav > li > a:hover {
        color: #fff !important;
        background: #F7A9A9 !important;
    }
    ul{
        list-style: none;    
        padding-left: 10px;
        font-size: 12px;
        color: #4a4a4a;
    }
    li{
      list-style: none;
    }
    .date{
      font-size: 10px;
      color:#777;
      margin-right: 10px;
    }
              </style>
        <!--[if lt IE 8]> -->
         <div class="container-fluid" id="home">
           
           
            <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= IMG ?>/logo.png" class="brands "/>
                            <div class="vertical-middle brandname title">
                                <?= M_Title ?>
                                <br>
                                <span id="tag-line" class="firstcolor info-small">
                                Making Casting easier!                      
                                </span>
                            </div>
                            
                </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right ul_list">
                        <li >
                            <a href="<?= base_url()?>actor/"  > Dashboard
                            </a>
                        </li>
                        <li >
                            <a href="<?= base_url()?>actor/account"  > Account
                            </a>
                        </li>
                        <?php if(strtolower($plan['StashActorPlan_plan'])=="basic") { ?>
                        <li>
                            <a href="<?= base_url() ?>/payment?plan=1"> Go Pro!
                            </a>
                        </li>
                         <?php } ?>
                        <li >
                            <a href="<?= base_url() ?>home/logout/"> Sign Out
                            </a>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
          </div>
           <!-- contact modal toggle -->
            <div class="container-fluid">
              <div class="col-lg-12 col-sm-12 col-xs-12 account_box">
                <div class="heading center"><i class="fa fa-bell-o"></i> Notifications</div>
                <hr>
                <div class="row">
                  <ul>
                  <?php
                      $last = '';
                      foreach ($notifications as $key => $notice) {
                        $close = false;
                        $d = date("d-m-Y", $notice['StashNotification_time']);
                        if($last != $d){
                          echo ($last != '') ? "</ul><hr>" : "";
                          echo "<li><i class='fa fa-calendar'></i> ".date("d M", $notice['StashNotification_time'])." </li><hr><ul>";
                          $last = $d;
                        }

                          
                          $fa = $this->Notifications->type2fa($notice['StashNotification_type']);
                          //echo $notice['StashNotification_type'];
                          $delay = $this->Notifications->timeElapsedString($notice['StashNotification_time']);

                          if($notice['StashNotification_type'] == 'audition' || $notice['StashNotification_type'] == 'message'){
                              $link = base_url() . "project/notification/" . $this->Notifications->getEncryptedText($notice['StashNotification_data']);
                          }elseif($notice['StashNotification_type'] == 'connect'){
                              $link = base_url() . "home/connect/" . $this->Notifications->getEncryptedText($notice['StashNotification_data']);
                          }else{
                              $link = '#';
                          }

                  ?>
                   <?php if($link!="#"){echo '<a href="'. $link.'">';}?>
                    <li><i class='fa <?= $fa ?>'></i> <?= $notice['StashNotification_message'] ?> <span class="date pull-right"><i><?= $delay ?></i></span></li><hr>
                    </a>
                  <?php 

                    }  

                  ?>
                  </ul>
                </div>  
              </div>
             
              
            </div>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
  include 'includes/scripts.php';
?>
