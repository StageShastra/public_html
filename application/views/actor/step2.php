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
                                $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            $number_of_images=sizeof($images);

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
                    <span class="step_count">Step 2 of 4: Photos</span> <br> 
                    <span class="step_brief">Photos are crucial for casting.</span></h4><br>
                </div>

                        <div class="modal-body">
                    <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 center">
                    <div class="form-group" >
                           <form action="<?= base_url() ?>upload/" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;">
                               <div class="info-small hidden" id="message_after_upload"><span class="info gray"><b> Click here to add more images</b>.<span class="info-small gray"><li>Ideally, keep the image size less than 1.5MB</li></span></span></div></form>
                    </div>
                     <button type="submit" class="btn submit-btn firstcolor pc_button" onclick="$( '#photo-upload' ).click ();" id="choose-btn-cp" data-click-src="cpmodal"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Choose Photos</button>
                    <button type="submit" class="btn submit-btn firstcolor pc_button disabled" id="upload-btn-cp" data-click-src="cpmodal"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Upload and Go</button>
                   
                    
                    <?php
                                            if($number_of_images>=2)
                                            {
                                                echo '<button type="button" class="btn submit-btn pc_button  " id="add_exp_btn_load" onclick="set_profile_stage(3); location.reload();" >Skip</button></font>';
                                            }
                    ?>
                  </div>
                </div>
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
        <script> var isnotsteppage=false;</script>            
        <!--================================== Navigation Ends Here =======================================-!-->
<?php
    include 'includes/scripts.php';
?>
