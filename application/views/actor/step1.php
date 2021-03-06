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

            <?php
                    echo '<script>var first_time='.$user["StashUsers_status"].';</script>';
                    echo '<script>var step='.$actorProfile['StashActor_profile_completion_stage'] .';</script>';

            ?>
     <div class="modal-content-four col-lg-5 col-md-5 center">
          <div class="modal-header hr_pc">
                  <h4 class="modal-title center" id="myModalLabel">
                    <span class="step_name">Getting Started</span><br>
                    <span class="step_count">Step 1 of 4: Basic Details</span> <br> 
                    <span class="step_brief">Easily the most important part of your profile.</span></h4><br>
                </div>

                        
                        <form name="step1" id="contactForm" class="profileCompletion1"
                        data-input-names="pc_sex,pc_dob,pc_min_age,pc_max_age,pc_weight,pc_height"
                        data-request="EditBasics"
                        data-step-id="step-1-error"
                        data-hide-id="#actor_basics_edit" 
                        data-unhide-id="#actor_basics"
                        validate>
                        
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Sex</label>
                                <select type="text" class="form-control" name="pc_sex" value="<?= ($actorProfile['StashActor_gender']) ? "M" : "F" ?>" id="sex" placeholder="Sex" required data-validation-required-message="Please enter your sex.">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Date of Birth</label>
                                <input type="date" name="pc_dob" class="form-control"  id="dob" required/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        
                        <div class="row control-group">
                            <div class="form-group col-xs-12 col-md-12 col-lg-12 floating-label-form-group controls">
                                <label class="label_pc">Natural Screen Age<span class="yellow_text">&nbsp;in yrs </span></label>
                            
                                <div class="row">
                                        <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6" >
                                         <input type="text" name='pc_min_age' class="form-control"   placeholder="Minimum onscreen age"  required data-validation-required-message="Please enter your min age range" id="agemin"/>
                                        </div>
                                        
                                        <div class="col-sm-6 col-xs-6" >
                                         <input type="text" name='pc_max_age' class="form-control"  placeholder="Maximum onscreen age"  required data-validation-required-message="Please enter your max age range. The maximum age which you can play onscreen" id="agemax"/>
                                        </div>
                                        
                                    </div>
                                
                                <p class="help-block text-danger"> </p>
                            </div>
                        </div>

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Weight<span class="yellow_text">&nbsp;in kgs</span></label>
                               <input type="text" class="form-control" name='pc_weight'  placeholder="Weight"  id="weight" required/> 
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label class="label_pc">Height<span class="yellow_text">&nbsp;in cms</span></label>
                                <input type="text" class="form-control" name='pc_height'  onfocus='$("#feetToCmConverterModal").modal("show")' placeholder="Height in cms"  id="pc_height" required />  
                            </div>
                        </div>
                        <p id="step-1-error" class="help-block text-danger"></p>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                
                                <font class="sortbuttons">
                                        <button type="submit" class="btn submit-btn firstcolor tick center pc_button">
                                            <span > Save and Go</span>
                                        </button>
                                </font>

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
            <div id="feetToCmConverterModal" style="z-index:999999999999;" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content col-sm-6 col-lg-5 col-md-5 center">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title firstcolor info"> Feet to Centimeter Converter </h4><span class="info-small gray"></span>
                    </div>
                    <div class="modal-body" style="background-color:#f2f2f2;">
                      <div class="container" style="max-width:100%; ">
                        <form action='#' id="feetToCMConverter" method="post">
                            <div class="row">
                              <div class="col-sm-6 form-group no-paddinglr">
                                  <span class="info-small gray">Feet</span>
                                  <select class="form-control add" id="feet" name="feet" >
                                    <?php
                                        for($i = 0; $i < 11; $i++)
                                            echo "<option value='{$i}'>{$i}</option>";
                                    ?>
                                  </select>
                                  

                              </div>
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small gray">Inches</span>
                                <select class="form-control add" id="inches" name="inches" >
                                    <?php
                                        for($i = 0; $i < 12; $i++)
                                            echo "<option value='{$i}'>{$i}</option>";
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group no-paddinglr" style="text-align:center;">
                                    <button type="button" class="btn submit-btn firstcolor"  onclick="feet_to_cm()" style="margin-top: 20px; margin-left:10px;" id="btn-search" >
                                        <span class="glyphicon glyphicon-filter"></span> &nbsp; Convert</button>
                                </div>
                            </div>
                            <div class="row" id="convertedBox " style="text-align:center;">
                                <div class="col-sm-12 form-group no-paddinglr">
                                    <h3><span id="converted">0</span> cm</h3>
                                    <p class="gray"><small>Rounding up.</small></p>
                                </div>
                            </div>
                            
                        </form>
                      </div>
                      
                    </div>
                    
                  </div>

                </div>
<script> var isnotsteppage=false</script>
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
    include 'includes/scripts.php';
?>
