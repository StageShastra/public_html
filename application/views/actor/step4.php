<?php
    include 'includes/head.php';

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    $user = $actor;
    $actorProfile = $profile;
    $actorExperiences = $experience;
    $actorTrainings = $training;
    $actor_ref = $this->session->userdata("StaSh_User_id");
    function calculateAge($dob = 0){
        $diff = abs(time() - $dob);
        $years = floor($diff / (365*60*60*24));
        return $years;
    }




    // to check plan expired
    if($plan['StashActorPlan_status'] == 0){
        // Plan Expired 
    }
  ?>
    <link rel="stylesheet" href="<?=CSS?>/steps.css">
    <body>
        
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Modal Section : Contact Form -->
        <!-- Ths section is pre selection !-->
        <!--===========================================================================================!-->

        <!-- Ths section is post selection !-->
        <div class="container-fluid" id="home">
           
           
            <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                <button type="button" class="notificaton_btn hidden-lg hidden-sm hidden-md" data-toggle="collapse" data-target="#notification_bar" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell-o firstcolor" aria-hidden="true"></span></a>
                
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
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle hidden-xs seenNotice" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell-o firstcolor seenNoticeSpan" aria-hidden="true"></span>
                          <?php
                            if($newNotice){
                                echo "<i class='label label-danger noticeCount'>{$newNotice}</i>";
                            }
                          ?>
                          </a>
                          <ul class="dropdown-menu hidden-xs mainNoticeCont">
                        <li>
                            <a href="<?= base_url()?>actor/notifications">
                                <span class='notification_message'><i class='fa fa-info'></i>Show all notifications</span><br>
                            </a>
                        </li>
                        <hr>
                          <?php

                                foreach ($notices as $key => $notice) {
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
                            
                                    <li>
                                        <a href="<?= $link ?>">
                                            <span class='notification_message'><i class='fa <?= $fa ?>'></i><?= $notice['StashNotification_message'] ?></span><br>
                                            <span class ="time_notification gray"><i><?= $delay ?></i><span>
                                        </a>
                                    </li>

                            <?php
                                }

                          ?>
                            <!-- <li>
                                <a href="<?= base_url() ?>/payment?plan=1">
                                    <span class="notification_message"><i class="fa fa-comment-o"></i>Pritesh has sent you a private message.</span><br><span class ="time_notification gray"><i>2 days ago</i><span>
                                </a>
                            </li> -->
                          </ul>
                        </li>   
                        <li >
                            <a href="<?= base_url()?>actor/"  class="navbarlist" > Dashboard
                            </a>
                        </li>
                        <li >
                            <a href="<?= base_url()?>actor/account" class="navbarlist" > Account
                            </a>
                        </li>
                        <?php if(strtolower($plan['StashActorPlan_plan'])=="basic") { ?>
                        <li>
                            <a href="<?= base_url() ?>/payment?plan=1" class="navbarlist"> Go Pro!
                            </a>
                        </li>
                         <?php } ?>
                        <li >
                            <a href="<?= base_url() ?>home/logout/" class="navbarlist"> Sign Out
                            </a>
                        </li>
                        <?php if ($user["StashUsers_ticket_status"]==0 || $user["StashUsers_ticket_status"]=="") {
                            echo '<li >
                            <span class="label label-danger needhelp" id="need_help" onclick="need_help()">I need help!</span>
                        </li>';
                        }
                        else {
                            echo '<li >
                            <span class="label label-danger needhelp raised" id="need_help">Help request submitted</span>
                        </li>';
                        }
                        ?>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                    
                </div>


                <!-- ========================================================= -->
                <!-- Notification Bar -->
                <div class="collapse navbar-collapse hidden-lg hidden-sm hidden-md" style="height:auto!important;" id="notification_bar">  
                    <ul class="nav navbar-nav navbar-right ul_list subNoticeCont">
                        <li>
                            <a href="<?= base_url()?>actor/notifications">
                                <i class="fa fa-bell-o"></i><span>View all notifications</span>
                            </a>
                        </li>
                        <hr>
                        <?php 

                            foreach ($notices as $key => $notice) {
                                $fa = $this->Notifications->type2fa($notice['StashNotification_type']);
                                $delay = $this->Notifications->timeElapsedString($notice['StashNotification_time']);
                                
                                if($notice['StashNotification_type'] == 'audition' || $notice['StashNotification_type'] == 'message'){
                                    $link = base_url() . "project/notification/" . $this->Notifications->getEncryptedText($notice['StashNotification_data']);
                                }elseif($notice['StashNotification_type'] == 'connect'){
                                    $link = base_url() . "home/connect/" . $this->Notifications->getEncryptedText($notice['StashNotification_data']);
                                }else{
                                    $link = '#';
                                }
                        ?>
                        <li>
                            <a href="<?= $link ?>">
                                <i class="fa <?= $fa ?>"></i><span><?= $notice['StashNotification_message'] ?></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>    
                </div><!-- /notification_bar-->
                <!-- ====================================================== -->



                </div>
            </nav>

            
     <div class="modal-content-four col-lg-5 col-md-5 center">
          <div class="modal-header hr_pc">
                  <h4 class="modal-title center" id="myModalLabel">
                    <span class="step_name">Getting Started</span><br>
                    <span class="step_count">Step 4 of 4: Acting Experience </span> <br> 
                    <span class="step_brief">Describe what you've done before, and add YouTube links. </span></h4><br>
                </div>
                        
                        <form name="step4" validate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Title<sup>*</sup> </label>
                                <input type="text" class="form-control" name='cp_exp_title' id="addtitle" Placeholder="ex: TVC for Mercedes" required/>
                                
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Role<sup>*</sup></label>
                                <input type="text" class="form-control " name='cp_exp_role' id="addrole" Placeholder="ex: Raj Malhotra" required/>
                               
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                
                                <label class="label_pc">Video Link<span class="yellow_text">&nbsp;optional, but highly recommended </span></label>
                                 <input type="text" class="form-control" name='cp_exp_link' id="addlink" onpaste="setTimeout(function(){embed_video_show()},4)"Placeholder="Paste a YouTube link here."/>
                                <p class="help-block text-danger"></p>
                                <div class="embed-responsive embed-responsive-4by3 hidden" id="embed_video">
                                    <iframe class="embed-responsive-item" id="iframe_video" src="">

                                    </iframe>
                                </div>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Description<span class="yellow_text">&nbsp;optional </span></label>
                               <textarea class="form-control" name='cp_exp_blurb' id="adddescription" placeholder="ex: It was a very big project in which I played a central role." style="height:80px;"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <p id="step-1-error" class="help-block text-danger"></p>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center cp_addExperience toggleEdit tick pc_button" id="add_exp_btn" data-hide-id="#add_exp_btn" data-unhide-id="#add_exp_btn_load" >Finish</button>
                                    <button type="button" class="btn submit-btn tick pc_button" id="add_exp_btn_load" onclick="set_profile_stage(5); location.reload();" >Skip</button></font>
                            </div>
                        </div>
                    </form>
                    
                
                </div>
          
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          <!-- /.modal -->
            <div id="resendConfirmationModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title firstcolor info"> Notification </h4><span class="info-small gray"></span>
                  </div>
                  <div class="modal-body" style="background-color:#f2f2f2;">
                    <div class="container" style="max-width:100%; ">
                        <div class="jumbotron">
                            <p id="resendCnfLnk-msg">
                                <?= AC_ConfLinkSent ?>
                            </p>
                        </div>
                    </div>
                    
                    </div>

                  </div>

                </div>
            </div>
                    
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
    include 'includes/scripts.php';
?>
