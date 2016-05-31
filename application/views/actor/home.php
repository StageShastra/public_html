<?php
    include 'includes/head.php';
    
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

    $title_cd = "When you accept a casting director's invitation to join their database, their name will show up here. This means that they will see all the changes you make to your profile instantly.";
    $title_exp = "Showing your video work is the best way to showcase your talent. If you don't have any video work to show yet, just record yourself acting out a favorite scene and put that here.";
    $warning_cnf = "Please verify your email address so that casting directors can contact you easily. We've sent a link to your email.";
    $warning_cnf .= "<br> If you have not received it, click <a href='#' class='text-info' id='resendConfirmationLink'>here</a> to resend the verification email.";
    $title_verify = "Your mobile number is not verified. Please verify your mobile number to receive messages on your phone.";
?>
    <body>
        <style>
          body{
            padding-top: 90px;
          }
          .rotate-img {
            -webkit-animation: rotation 2s infinite linear;
          }
          @-webkit-keyframes rotation {
              from {-webkit-transform: rotate(0deg);}
              to   {-webkit-transform: rotate(359deg);}
          }
          .bootstrap-tagsinput {
            background-color: #f2f2f2;
        }
        /* AKASH SINGH: */
        .a_name{
            font-family: 'AvenirNext-Bold', sans-serif, AvenirNext-Regular;
            font-size: 20px;
            color: #4A4A4A;
            text-align: left;
            margin-bottom: 15px;
        }
        
        .a_pic{
            /* Rectangle 1: */
            border-radius: 10px;
            height: 130px;
            width: 130px;
            float: left;
            padding-left: 0px !important;
        }
        .pro-pic{
            border-radius: 10px;
            height: 100%;
            width: auto;
        }
        .left{
            text-align: left;
        }
        .basics{
            text-align: left;
        }
        .category_heading{
            font-family: Raleway;
            font-weight: 400;
            font-size: 15px;
            color: #FFB600;
            
        }
        .elements{
            font-family: AvenirNext-Regular;
            font-size: 14px;
            color: #4A4A4A;
            
        }
        .elements_label{
            font-family: AvenirNext-Bold;
            font-size: 14px;
            color: #9B9B9B;
            letter-spacing: 0px;
            text-shadow: 1px 1px 1px #FFFFFF;
            
        }
        .language_tag{
            border: 1px solid #FBB515;
            border-radius: 3px;
            background: transparent;
            font-family: AvenirNext-Regular;
            font-size: 14px;
            max-width: 100%; 
            padding-left:0px;
             width:100%;
            overflow-x:hidden;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
        }
        .project_tag{
            border: 1px solid #FBB515;
            border-radius: 3px;
            background: transparent;
            font-family: AvenirNext-Regular;
            font-size: 14px;
            max-width: 100%; 
            padding-left:0px;
            width:100%;
            overflow-x:hidden;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
        }
         .skills_tag{
            border: 1px solid #F05759;
            border-radius: 3px;
            background: transparent;
            font-family: AvenirNext-Regular;
            font-size: 14px;
            max-width: 100%;
            padding-left:0px;
             width:100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
        }
        .ellipsis{
             -webkit-transition: width 1s ease-in-out;
            -moz-transition: width 1s ease-in-out;
            -o-transition: width 1s ease-in-out;
            transition: width 1s ease-in-out;
        }
        .ellipsis:hover{
            width: auto;
        }
        .taga-text {
            padding-left: 3px !important;
            padding-right: 3px !important;
        }
        .video_frame{
            border: 0px;
        }
        .overlay_edit
        {
            position: absolute;
            top: 5px;
            right: 10px;
            background: rgba(0,0,0,0.5);
            padding: 3px;
            color: white;
            z-index:999;
            border-radius: 3px;
        }
        #second_column_actor{
            margin-left: 20px; 
        }
        .training-plus{
            font-family: AvenirNext-Regular;
            font-size: 18px;
            color: #FBB515;
        }
        .training-minus{
            font-family: AvenirNext-Regular;
            font-size: 18px;
            color: #F05759;
        }
        .training_title{
            font-family: AvenirNext-Bold;
            font-size: 18px;
            color: #9B9B9B;
            letter-spacing: 0px;
            text-shadow: 0px 1px 0px #FFFFFF;
        }
        .training_details{
            background: #EBEBEB;
            border-radius: 9px;
            font-size: 16px;
            color: black;
            padding-left: 15px;
            padding: 15px;
            width: 75%;
        }
        .edit_inputs_basics{
            margin-bottom: 10px;
        }
        .edit_basics_labels{
            vertical-align: middle;
            color: #FFB600;
            font-family: Raleway;
            font-size: 14px;
            margin-left: 4px;
        }
        .nav_icons{
            position: absolute;
            top: 15px;
            left: 50%;
            padding: 2px;
           
        }   
        .leftnav{
            margin-right: 5px;
            border-right: 1px;
        }
        .no_left_margin{
            margin-left: 0px;
        }
        .edit_inputs_basics{
            margin-bottom: 10px;
        }
        .edit_basics_labels{
            vertical-align: middle;
            color: #FFB600;
            font-family: Raleway;
            font-size: 14px;
            margin-left: 4px;
        }
        .nav_icons{
            position: absolute;
            top: 15px;
            left: 50%;
            padding: 2px;
           
        }   
        .leftnav{
            margin-right: 5px;
            border-right: 1px;
        }
        .col-sm-*{
            margin-left:0px;
        }
        .DocumentList{
            background: none;
        }
        .edit-button{
            right:0px;
        }
        .DocumentItem
        {
            max-width: 150px;
            height: 150px;
            overflow: hidden;
            position: relative;
            border-radius: 10px;
        }
        .crop {
            position:absolute;
            left: -100%;
            right: -100%;
            top: -100%;
            bottom: -100%;
            margin: auto;
            width: auto;
            height: auto;
        }
        #actor_pro_pic{
            width: 100px;
            height: 100px;
            overflow: hidden;
            margin-right: 5px;
            position: relative;
            border-radius: 10px
        }
        .hidden_scroll{
        overflow-y:hidden;
        }
        .hidden_scroll:hover{
        overflow-y:scroll;
        }

		.actor_link {
			padding: 0px;
			color: #9b9b9b;
			font-size: 12px;
			cursor: text;
            margin-left: -15px;
			
		}
		
		.actor_link a{
			text-decoration: none;
		}

        .notVerified {
            color: red;
        }
        /*mobileresponsiveness*/
        #home{
            padding-left:0px;
            padding-right: 0px;
        }
        .custom-navbar{
            padding-top: 0px;
            margin-bottom: 0px;

        }
        .tagline{
                position: relative;
                top: -10px;
            }
        .alertbox{
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            margin-top: 20px;
            background:#FFB600;
            color: white; 
        }
           
        /* xs */
        @media screen and (max-width: 767px) {
            body {
                font-size: 0.9em;
            }
            .container-fluid{
                padding:0px;
            }
            .navbar-fixed-top{
                margin-left: 0%;
                margin-right: 0%;
            }
            .navbar-header{
                height: 75px;
            }
            .headname{
                position: relative;
                top:15px;
                font-size: 20px;
            }
            .brands{
                width: 55px;
                height: auto;
            }
            .navbar-toggle{
                margin-right: 20px;
                position: relative;
                top:20px;
                margin-top: 0px;

            }
             .tagline{
                font-size: 9px;
            }
            .light-padded
            {
                padding: 0px 5px 0px 10px !important;
            }
            .no_padding_small{
            padding-left: 0px;
            padding-right: 0px;
            }
            #second_column_actor{
            margin-left: -15px; 
            margin-right: -15px;
            }
            .DocumentItem{
                width:60px;
                height: 60px;
            }
            .nav_icons{
                position: absolute;
                top:10px;
            }
            

            
        }
        /* sm */
        @media screen and (min-width: 768px) {
            body {
                font-size: 1em;
            }
            .container-fluid{
                padding:0px;
            }
            .navbar-fixed-top{
                margin-left: 0%;
                margin-right: 0%;
            }
            .headname{
                position: relative;
                top:15px;
                font-size: 22px;
            }
            .brands{
                width: 60px;
                height: auto;
            }
            .tagline{
                font-size: 9px;
            }
            .navbar-toggle{
                margin-right: 20px;

            }
            .no_padding_small{
            padding-left: 0px;
            padding-right: 0px;
        }
        .DocumentItem{
                width:75px;
                height: 75px;
            }
        }

        /* md */
        @media screen and (min-width: 992px) {
            body {
                font-size: 1.1em;
            }
            .navbar-fixed-top{
                margin-left: 3%;
                margin-right: 3%;
            }
            .headname{
                position: relative;
                top:18px;
                font-size: 22px;
            }
            .brands{
                width: 65px;
                height: auto;
            }
            .info-small{
                font-size: 12px;
            }
            .light-padded
            {
                padding-left: 10px;
            }
            #browse-table{
                margin-top: 20px;
            }
            .DocumentItem{
                width:120px;
                height: 120px;
            }
        }

        /* lg */
        @media screen and (min-width: 1200px) {
            body {
                font-size: 1.2em;
            }
            .padded{
                padding-left: 15px;
                padding-right: 15px;
            }
            #home{
            padding-left:15px;
            padding-right: 15px;
            }
            .navbar-fixed-top{
                margin-left: 3%;
                margin-right: 3%;
            }
            .headname{
                position: relative;
                top:20px;
                font-size: 24px;
            }
            .brands{
                width: 85px;
                height: auto;
            }
            .light-padded
            {
                padding-left: 10px;
            }
            .#browse-table{
                margin-top: 25px;
            }
            .DocumentItem{
                width:150px;
                height: 150px;
            }
        }
        .videoWrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        padding-top: 25px;
        height: 0;
    }
    .videoWrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
 .rotate-img {
            -webkit-animation: rotation 2s infinite linear;
          }
          @-webkit-keyframes rotation {
              from {-webkit-transform: rotate(0deg);}
              to   {-webkit-transform: rotate(359deg);}
          }
        #actor_basics{
           
        }
        #socialShare{
            padding: 0px;
            margin-top: -15px;
        }
        .collapse
        {
            height: 75px !important;
        }
        .custom-navbar{
            padding-bottom: 0px;
        }
        iframe{
            width: 100%;
            box-shadow: gray 5px 3px 10px 2px;
        }
        .light-padded{
            padding: 15px 5px 0px 15px;
        }
        #profile_link{
            font-size: 9px;
            position: relative;
            top:-10px;
            margin-left: 15px;
        }
        .tick{
                border-radius: 30px;
                font-size: 20px;
                padding: 5px 10px !important;
        }
        .tick:hover{
            background: red;
            color: white;
        }

        </style>
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
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= IMG ?>/logo.png" class="brands"/><span class="headname"><span >C A S T I K O</span><br><span class="firstcolor info-small tagline"><?= M_TagLine?></span></b></span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right" style="text-align:right;">
                       
                        <li>
                            <a href="<?= base_url() ?>home/logout/"><button type="button" class="btn submit-btn firstcolor" id="btn-logout"  ><span class="glyphicon glyphicon-log-out"></span> &nbsp; Sign Out</button></a>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>

           <!-- contact modal toggle -->

           <!-- contact modal toggle -->
             <div class="container-fluid">
                <?php
                    if($user["StashUsers_status"] == 0){
                ?>
                <div class="alert alert-warning alert-dismissible" id="warningmsg" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> <?= AC_ActivationWarning ?>
                </div>
                <?php } ?>
                
                <div class="alert alert-primary alert-dismissible alertbox" id="savedChnaged" style="display:none;" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <span id="savedChnagedMsg"></span>
                </div>

                <div class="container col-sm-12 center" id="browse-table">
                    <div class="col-sm-3 light-padded left">
                    <div class="row">
                        <span class="a_name"><?= $actorProfile['StashActor_name'] ?></span>
						 <span class="fa fa-share-alt edit-button  shareButton" data-open="false" style="cursor:pointer;" ></span>
                            <i>&emsp;</i>
                    <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#actor_username_edit" data-hide-id="#actor_username" aria-hidden="true" style="cursor:pointer;"></span>
						
						<br>
						<span class="actor_link" id="actor_username">
							<span id="profile_link" ><a href="<?= base_url() . $user['StashUsers_username'] ?>" id="actor_username_txt" target="_blank"><?= base_url() . $user['StashUsers_username'] ?></a></span>
							<i>&emsp;</i>
						</span>
						
						<div id="socialShare" ></div>
						
						<div id="actor_username_edit" class="hidden">
							<div class="category_heading no_left_margin"></div>
							
							<div class="row no_left_margin">
								<input type="text" class="editwhite edit_inputs_basics col-sm-6" style="padding:10px;" name="username" value="<?= $user["StashUsers_username"] ?>" id="username"/>
							</div>
							
							<font class="sortbuttons">
									<button type="button" class="btn submit-btn firstcolor center tick updateDataField"
											data-input-names="username"
											data-request="EditUsername"
											data-hide-id="#actor_username_edit" 
											data-unhide-id="#actor_username">
										<span class="glyphicon glyphicon-ok"></span>
									</button>
							</font>
						</div>
						</div>
                        <div class = "row" id="actor_basics">
                            <div class=" col-sm-3 col-lg-4 col-md-4  a_pic" id="actor_pro_pic">
                               <span class="glyphicon glyphicon-remove  toggleEdit overlay_edit removeDP" style="left:8px; right:0px; width:18px;" aria-hidden="true"></span> <span class="glyphicon glyphicon-camera  toggleEdit overlay_edit" data-toggle="modal" data-target="#set_profile_photo" aria-hidden="true"></span>
                                
                                <img src="<?= IMG .'/actors/'.$actorProfile['StashActor_avatar'] ?>" id="actorAvatar" class="pro-pic"></img> 
                                 <input type="hidden" id="image_count" value='<?= $actorProfile['StashActor_images'] ?>'>
                                <input type="hidden" id="profile_pic" value="<?= $actorProfile['StashActor_avatar'] ?>">
                            </div>
                            <div class="basics col-sm-12 col-lg-7 col-md-7" style="padding-left:0px;padding-right:0px;">
                                <div class="category_heading ">BASICS
                                    <span class="glyphicon glyphicon-pencil edit-button  toggleEdit" data-unhide-id="#actor_basics_edit" data-hide-id="#actor_basics" aria-hidden="true" ></span>
								</div>
                                <div class="elements">
                                    <span class="elements_label">Sex: </span><span id="actor_sex"><?= ($actorProfile['StashActor_gender']) ? "Male" : "Female" ?></span>
                                    <br>
                                    <span class="elements_label">Age Range:</span><span id="actor_min_age" ><?= $actorProfile['StashActor_min_role_age'] ?></span>-<span id="actor_max_age"><?= $actorProfile['StashActor_max_role_age'] ?></span><span style="font-size:9px;"> years</span><br>
                                   <span class="elements_label ">Weight:</span><span id="actor_weight" ><?= $actorProfile['StashActor_weight'] ?></span> kgs<br>
                                    <span class="elements_label ">Height: </span><span id="actor_height" ><?= $actorProfile['StashActor_height'] ?></span> cms<br>
                                </div>
                            </div>


                        </div>
							<div id="actor_basics_edit" class="hidden">
                                <div class="category_heading row" >BASICS</div>
                                
                                    <div class="row">
                                        <select type="text" class="editwhite edit_inputs_basics col-sm-2 col-xs-12" name="sex" value="<?= ($actorProfile['StashActor_gender']) ? "M" : "F" ?>" id="sex" placeholder="Sex">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-2" style="padding-left:0px;padding-right:0px;">
                                         <input type="text" name='min_age' class="editwhite edit_inputs_basics "  style="padding-left:5px; max-width:100%" value="<?= $actorProfile['StashActor_min_role_age'] ?>" title="What  minimum age would you naturally be able to play on screen/stage?" id="agemin"/>
                                        </div>
                                        <div class="col-sm-1 col-xs-1" style="padding-left:0px; padding-right:0px;text-align:center">
                                              --
                                        </div>
                                        <div class="col-sm-2 col-xs-2" style="padding-left:0px;padding-right:0px;">
                                         <input type="text" name='max_age' class="editwhite edit_inputs_basics "  style="padding-left:5px; max-width:100%" value="<?= $actorProfile['StashActor_max_role_age'] ?>" title="What  maximum age would you naturally be able to play on screen/stage?" id="agemax"/> 
                                        </div>
                                        <span class="edit_basics_labels"> years </span>
                                    </div>
                                    <div class="row">
                                        <input type="text" class="editwhite edit_inputs_basics col-sm-4 col-xs-12" name='weight'  placeholder="Weight in kgs" value="<?= $actorProfile['StashActor_weight'] ?>" id="weight"/>  <span class="edit_basics_labels">kgs</span>
                                    </div>
                                    <div class="row">
                                        <input type="text" class="editwhite edit_inputs_basics col-sm-2 col-xs-12" name='height'  placeholder="Height in cms" value="<?= $actorProfile['StashActor_height'] ?>" id="height"/>  <span class="edit_basics_labels">cms</span>
                                        <i class="glyphicon glyphicon-filter" data-toggle="modal" data-target="#feetToCmConverterModal"></i>
                                    </div>
                                
                                <font class="sortbuttons">
                                        <button type="button" class="btn submit-btn firstcolor tick updateDataField"
                                                data-input-names="sex,min_age,max_age,weight,height"
                                                data-request="EditBasics"
                                                data-hide-id="#actor_basics_edit" 
                                                data-unhide-id="#actor_basics" style="margin-left: -15px;">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                </font>
                            </div>
                        <div class="row">
                            <br>
                            <div class="category_heading">DETAILS
                                <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#actor_details_edit" 
                                            data-hide-id="#actor_details" aria-hidden="true"></span>
                            </div>
                            <div id="actor_details">
                                <span class="elements_label">Date of Birth:</span><span class="elements" id="actor_dob"><?php
                                if($actorProfile['StashActor_dob'] == 0){
                                    echo '';
                                    $actorProfile['StashActor_dob'] = strtotime("-18 years");
                                }else{
                                    echo date("m/d/Y", $actorProfile['StashActor_dob']);
                                }
                            ?></span><br>
                                <span class="elements_label">Email: </span><span class="elements"> <?= $actorProfile['StashActor_email'] ?></span><br>
                                <span class="elements_label">Phone:</span>
                                
                                <span class="text-danger elements" id="actor_phone"> <?= $actorProfile['StashActor_mobile'] ?> 
                                <?php if($user["StashUsers_mobile_status"] == 0){ ?>
                                <a href="<?= base_url() ?>actor/mobileverify" data-toggle="tooltip" data-placement="right" title="<?= AC_MobileVerifyTxt ?>" class="text-danger otpLink"><i class="fa fa-exclamation"></i></a>
                                <?php } ?>
                                </span>

                                <br>
                                <span class="elements_label">WhatsApp: </span><span class="elements" id="actor_whatsapp"><?= $actorProfile['StashActor_whatsapp'] ?></span><br>
                            </div>
                            <div id="actor_details_edit" class="hidden">
                                <span id="dob_edit" class="left paddingTop ">
                                <div class="row">
                                    <span class="elements_label col-sm-5 col-xs-4">Date of Birth: </span>
                                    <input type="date" name="dob" class="editwhite edit_inputs_basics col-sm-8"  value="<?= date("Y-m-d", $actorProfile['StashActor_dob']) ?>" id="dob"/>
                                <br>
                                <span class="elements_label col-sm-5 col-xs-4">Phone:</span><input type="text" class="editwhite edit_inputs_basics col-sm-8" name="phone" value="<?= $actorProfile['StashActor_mobile'] ?>" maxlength='10' id="phone"/>
                                </span>
                                <br>
                                <span class="elements_label col-sm-5 col-xs-4">WhatsApp:</span><input type="text" class="editwhite edit_inputs_basics col-sm-7 col-xs-8" name="whatsapp" value="<?= $actorProfile['StashActor_whatsapp'] ?>" id="whatsapp"/>
                                </span>
                                </div>
                                <font class="sortbuttons">
                                        <button type="button" class="btn submit-btn firstcolor center tick updateDataField"
                                                data-input-names="dob,phone,whatsapp"
                                                data-request="EditContacts"
                                                data-hide-id="#actor_details_edit" 
                                                data-unhide-id="#actor_details">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                </font>
                           
							</div>
						</div>
                         <div class="row">
                            <br>
                            <div class="category_heading">CASTING DIRECTORS 
                                <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= AC_CDHelpTxt ?>"></i>
                            </div>
                            <?php
                                    foreach ($directors as $key => $director) {
                                ?>
                                <span class="elements_label"> <?= $director['name'] ?></span><br>
                             <?php
                                    }
                            ?> 
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">LANGUAGES
                                <span class="glyphicon glyphicon-pencil  edit-button pull-right toggleEdit" data-unhide-id="#language_edit" data-hide-id="#actor_language" aria-hidden="true"></span>
                            </div>
                             <span id="actor_language" class="info dark-gray ">
                                <?php
                                    $languages = $actorProfile['StashActor_language'];
                                    foreach ($languages as $key => $language) {
                                ?>
                                <div class="col-sm-6 col-xs-4 col-lg-4 col-md-6 vertical-padded ellipsis">
                                    <button type="button" class="btn language_tag" aria-label="Left Align" >
                                        <font class="taga-text"><?php $lan=ucfirst(trim($language)); if(strlen($lan)>7) {echo $lan;} else{echo $lan;}?></font>
                                    </button>
                                </div>  
                                <?php
                                    }
                                ?>
                            </span>
                            <span id="language_edit" class="left hidden ">
                                 <input type="text" class="form-control login" value="<?= implode(",", $actorProfile['StashActor_language']) ?>" id="language" data-role="tagsinput" name="language" placeholder= "Language:" />
                                 <br><font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center updateDataField"
                                            data-input-names="language"
                                            data-request="EditLanguage"
                                            data-hide-id="#language_edit" 
                                            data-unhide-id="#actor_language">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">SKILLS
                               <span class="glyphicon glyphicon-pencil  edit-button pull-right toggleEdit" data-unhide-id="#skills_edit" data-hide-id="#actor_skills" aria-hidden="true"></span>
                            </div>
                                 <span id="actor_skills" class="info dark-gray">
                                <?php
                                    $skills = $actorProfile['StashActor_skills'];
                                    foreach ($skills as $key => $skill) {
                                ?>
                                <div class="col-sm-6 col-xs-4 col-lg-4 col-md-6 vertical-padded ellipsis">
                                    <button type="button" class="btn skills_tag"  aria-label="Left Align" >
                                        <font class="taga-text"><?php $skill_=ucfirst(trim($skill)); if(strlen($skill_)>7) {echo $skill_;} else{echo $skill_;}?></font>
                                    </button>
                                </div>  
                                <?php
                                    }
                                ?>

                            </span>
                            <span id="skills_edit" class="left hidden ">
                                 <input type="text" class="form-control login" value="<?= implode(",", $actorProfile['StashActor_skills']).", " ?>" data-role="tagsinput" id="skills" name="skills" placeholder= "Skills:" />
                                 <br><font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center updateDataField"
                                            data-input-names="skills"
                                            data-request="EditSkills"
                                            data-hide-id="#skills_edit" 
                                            data-unhide-id="#actor_skills">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                                
                        </div>

                    </div>
                    <div class="col-sm-8 left" id="second_column_actor">
                         <div class="col-sm-12 no_padding_small" >
                            <br>
                            <div class="category_heading">EXPERIENCE <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?= AC_ExpHelpTxt ?>"></i>
                                <span id="openexperienceicon" class="glyphicon glyphicon-plus edit-button pull-right firstcolor toggleEdit" data-unhide-id="#experience_add, #closeexperienceicon" data-hide-id="#openexperienceicon" aria-hidden="true"></span>
                                <span id="closeexperienceicon" class="glyphicon glyphicon-minus pull-right hidden toggleEdit" data-hide-id="#experience_add, #closeexperienceicon" data-unhide-id="#openexperienceicon" aria-hidden="true"></span>
                            </div>
                            <div >
                               <span id="experience_add" class="hidden">
                                    <input type="text" class="editwhite long" name='exp_title' id="addtitle" Placeholder="Title of the play, ad, film etc." required/>
                                    <input type="text" class="editwhite long" name='exp_role' id="addrole" Placeholder="Role e.g. Dad, Mom, Character Name" required/>
                                    <input type="text" class="editwhite long" name='exp_link' id="addlink" Placeholder="Youtube Video Link"/>
                                    <textarea class="editwhite long" name='exp_blurb' id="adddescription" placeholder="A little description about the role and the project." style="height:80px;"></textarea>
                                    <br><font class="sortbuttons">
                                    <button type="submit" class="btn submit-btn firstcolor center addExperience toggleEdit tick" id="add_exp_btn" data-hide-id="#add_exp_btn" data-unhide-id="#add_exp_btn_load" ><span class="glyphicon glyphicon-ok"></span></button>
                                    <button type="submit" class="btn submit-btn firstcolor center addExperience tick hidden rotate-img" id="add_exp_btn_load" ><span class="glyphicon glyphicon-refresh"></span></button></font>
                                
                                </span>
                                <div id="experiencelist" style="overflow:hidden;">
                                <?php
                                    $count_experience=sizeof($actorExperiences);
                                    $counter_exp=0;
                                    $next=0;
                                    $previous=0;
                                    $onlyone=0;
                                   
                                    foreach ($actorExperiences as $key => $experience) {
                                         $counter_exp++;
                                        if($counter_exp==$count_experience && $counter_exp!=1)
                                        {
                                            $previous=$next-1;
                                            $next=0;
                                            
                                        }
                                        else if($counter_exp==$count_experience && $counter_exp==1)
                                        {
                                            $onlyone=1;
                                            
                                        }
                                        else if($counter_exp==1 && $count_experience>1)
                                        {
                                            $next=$next+1;
                                            $previous=$count_experience-1;
                                        }
                                        else
                                        {
                                             $previous=$next-1;
                                             $next=$next+1;
                                        }
                                        $youtube_flag=0;
                                        
                                        $youtube="";
                                        if (strpos($experience['StashActorExperience_link'], 'yout') !== false) {
                                            $youtube_flag=1;
                                            $youtube = explode("/", $experience['StashActorExperience_link']);
                                            $youtube = $youtube[count($youtube)-1];
                                            if(strpos($youtube, "?v=") !== false)
                                                $youtube = trim(str_replace("watch?v=", "", $youtube));
                                            $youtube = "https://www.youtube.com/embed/" . $youtube;
                                        }
                                        if($counter_exp==1)
                                        {
                                            echo '<span id="experience-'.$key.'" class="info dark-gray actExp">';
                                        }
                                        else
                                        {
                                            echo '<span id="experience-'.$key.'" class="info dark-gray hidden actExp">';  
                                        }
                                           
                                            if($youtube_flag==1) 
                                            {    
                                                
                                                echo '<div class="col-sm-7" style="padding-left:0px;padding-right:0px"><div class="videoWrapper"><iframe width="482" height="300" src="'.$youtube.'" frameborder="0" allowfullscreen></iframe></div></div>';
                                                echo '<div class="col-sm-5"">
                                                        <span class="info black" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        <span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-'.$key.'" aria-hidden="true"></span>
                                                        <span class="glyphicon glyphicon-remove edit-button  firstcolor removeSpanBtn" data-id="'.$experience['StashActorExperience_id'].'" 
                                                            data-key="'.$key.'"
                                                            data-type="experience"></span>
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'">
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                        <br>
                                                            <div style="height:100%;overflow:hidden;">
                                                            <div class="info-small dark-gray hidden_scroll" id="actor_ex_blurb_'.$key.'">
                                                            '.$experience['StashActorExperience_blurb'].'
                                                            </div>
                                                            </div>
                                                      </div>';
                                               
                                            }
                                            else
                                            {   
                                                echo'<span class="info black" style="margin-left:15px;" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        <span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" style="margin-left:15px;"  data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-'.$key.'" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-remove edit-button  firstcolor removeSpanBtn" data-id="'.$experience['StashActorExperience_id'].'" 
                                                                data-key="'.$key.'"
                                                                data-type="experience"></span>
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'" style="margin-left:15px;" >
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                    <br>
                                                        <div class="info-small dark-gray" id="actor_ex_blurb_'.$key.'" style="margin-left:15px;" >
                                                            '.$experience['StashActorExperience_blurb'].'
                                                        </div>';
                                                
                                            }
                                            if($onlyone!=1)
                                            {
                                                echo '<div class="nav_icons">
                                                <span class="leftnav center toggleEdit glyphicon glyphicon-chevron-left gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$previous.'>
                                                </span>
                                                <span class="righttnav toggleEdit center glyphicon glyphicon-chevron-right gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$next.' >
                                                </span></div>';
                                            }
                                            
                                        ?>
                                      
                                        <br>
                                        
                                    </span>
                                    <span id="experience-<?= $key ?>_edit" class="hidden">
                                        <input type="text" name="ex_title_<?= $key ?>" class="editwhite long" id="edittitlei" value="<?= $experience['StashActorExperience_title'] ?>" Placeholder="Title of the play, ad, film etc." required/>
                                        <input type="text" name="ex_role_<?= $key ?>" class="editwhite long" id="editrolei" value="<?= $experience['StashActorExperience_role'] ?>" Placeholder="Role e.g. Dad, Mom, Character Name" required/>
                                        <input type="text" name="ex_link_<?= $key ?>" class="editwhite long" id="editlinki" value="<?= $experience['StashActorExperience_link'] ?>" Placeholder="Youtube"/>
                                        <textarea class="editwhite long" name="ex_blurb_<?= $key ?>" id="editdescriptioni" style="height:80px;overflow:auto;"><?= $experience['StashActorExperience_blurb'] ?></textarea>
                                        <br>
                                        <font class="sortbuttons">
                                            <button type="button" class="btn submit-btn firstcolor center btnExpAndTraining tick toggleEdit"
                                                    id="edit_exp_btn"
                                                    data-input-names="ex_title_<?= $key ?>, ex_role_<?= $key ?>,ex_link_<?= $key ?>,ex_blurb_<?= $key ?>"
                                                    data-key="<?= $key ?>"
                                                    data-table-id="<?= $experience['StashActorExperience_id'] ?>"
                                                    data-request="EditExperience"
                                                    data-hide-id="#experience-<?= $key ?>_edit,#edit_exp_btn " 
                                                    data-unhide-id="#experience-<?= $key ?>,#edit_exp_btn_load ">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                            <button type="button" class="btn submit-btn firstcolor center btnExpAndTraining tick hidden" id="edit_exp_btn_load"
                                                    data-input-names="ex_title_<?= $key ?>, ex_role_<?= $key ?>,ex_link_<?= $key ?>,ex_blurb_<?= $key ?>"
                                                    data-key="<?= $key ?>"
                                                    data-table-id="<?= $experience['StashActorExperience_id'] ?>"
                                                    data-request="EditExperience"
                                                    data-hide-id="#experience-<?= $key ?>_edit" 
                                                    data-unhide-id="#experience-<?= $key ?>">
                                                <span class="glyphicon glyphicon-refresh rotate-img "></span>
                                            </button>
                                        </font>
                                    </span>
                                    

                                <?php
                                    }
                                ?>
                                </div>
                                <hr>
                            </div>
                            <div class="category_heading">GALLERY
                                 <span class="glyphicon glyphicon-plus edit-button pull-right" data-toggle="modal" data-target="#photosupload" aria-hidden="true"></span>
                                <div id="photos_videos">
                                <div class="row" style="padding-right:15px;">
                                    <div class="DocumentList" style="height:auto;">
                                        <ul class="list-inline">
                                            
                                        <?php
                                            $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            $counter=0;
                                            foreach ($images as $key => $image) {
                                                echo "<li class='DocumentItem' id='DocumentItem_{$key}'><span class='glyphicon glyphicon-remove  removeImage overlay_edit' data-image='".$image."' data-key='".$key."' aria-hidden=true></span>"
                                                    . "<a href='".IMG."/actors/".$image."' data-lightbox='".$actorProfile['StashActor_name']."'>"
                                                    .   "<img src='".IMG."/actors/".$image."' height='100%' width='auto' class=' img-rounded'>"
                                                    . "</a>"
                                                    . "</li>";
                                                    $counter++;
                                                        if($counter%5==0){
                                                            echo '<br>';
                                                        }
                                            }
                                        ?>     

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="category_heading">TRAINING
                            <span id="opentrainingicon" class="glyphicon glyphicon-plus edit-button pull-right firstcolor toggleEdit" data-unhide-id="#training_add, #closetrainingicon" data-hide-id="#opentrainingicon" aria-hidden="true"></span>
                            <span id="closetrainingicon" class="glyphicon glyphicon-minus edit-button  hidden toggleEdit" data-hide-id="#training_add, #closetrainingicon" data-unhide-id="#opentrainingicon" aria-hidden="true"></span>
                        </div>
                               
                            </span>
                            <div id="actor_training">
                                <span id="training_add" class="hidden">
                                    <input type="text" class="editwhite long" name='trn_title' id="addschool" Placeholder="School / Teacher" />
                                    <input type="text" class="editwhite long" name='trn_course' id="addcourse" Placeholder="Course" />
                                    <div class="row" style="margin-left:0px;">
                                        <input type="text" class="editwhite short" name='trn_start_time' id="addstart" Placeholder="Starting Year"/>
                                        <input type="text" class="editwhite short" name='trn_end_time' id="addend" Placeholder="Ending Year"/>
                                    </div>
                                    <textarea class="editwhite long" name='trn_blurb' id="addtrainingdescription" placeholder="A little description about the course." style="height:80px;"></textarea>
                                    <br><font class="sortbuttons"><button class="btn submit-btn firstcolor center addTraining"  ><span class="glyphicon glyphicon-ok"></span></button></font>
                                <hr>
                                </span>
                                <div id="traininglist" style="max-height:300px;">
                                    <?php
                                        foreach ($actorTrainings as $key => $training) {
                                    ?>

                                    <span id="training-<?= $key ?>" class="info dark-gray">
                                        <div class="row">
                                            
                                            <span class="training_title col-sm-4 col-xs-4" id="actor_tr_title_<?= $key ?>">
                                                <span class="training-plus toggleEdit" id="actor_tr_plus_<?= $key ?>" data-hide-id="#actor_tr_plus_<?= $key ?>" data-unhide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>">+</span>
                                                <span  id="actor_tr_minus_<?= $key ?>" class="toggleEdit training-minus hidden" data-hide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>" data-unhide-id="#actor_tr_plus_<?= $key ?>" >-</span>
                                                <?= $training['StashActorTraining_title'] ?>
                                            </span>
                                            <span class="info-small dark-gray col-sm-4 col-xs-4" id="actor_tr_course_<?= $key ?>">
                                                <?= $training['StashActorTraining_course'] ?>
                                            </span>
                                            <span class="info-small dark-gray col-sm-4 col-xs-4" style="text-align:right;" >
                                                <span class="glyphicon glyphicon-pencil edit-button firstcolor edit-button toggleEdit" data-hide-id="" data-unhide-id="#training-<?= $key ?>_edit" data-hide-id="#training-<?= $key ?>" aria-hidden="true"></span>
                                                <span class="glyphicon glyphicon-remove edit-button  firstcolor edit-button removeSpanBtn" data-id="<?= $training['StashActorTraining_id'] ?>" data-key="<?= $key ?>" data-type="training"></span>
                                            </span>
                                            

                                        </div>
                                        <div id="actor_tr_detail_<?= $key ?>" class="hidden toggleEdit training_details">
                                            <span class="info-small dark-gray" id="actor_tr_start_<?= $key ?>"><?= $training['StashActorTraining_start_time'] ?></span> - 
                                            <span class="info-small dark-gray" id="actor_tr_end_<?= $key ?>"><?= $training['StashActorTraining_end_time'] ?></span>
                                            <br>
                                            <span class="info-small dark-gray" id="actor_tr_blurb_<?= $key ?>">
                                            <?= $training['StashActorTraining_blurb'] ?>
                                            </span>
                                        </div>
                                        <hr>
                                    </span>

                                    <span id="training-<?= $key ?>_edit" class="hidden">
                                        <input type="text" class="editwhite long" id="editschooli" name="tr_title_<?= $key ?>" value="<?= $training['StashActorTraining_title'] ?>" Placeholder="School / Teacher" />
                                        <input type="text" class="editwhite long" name="tr_course_<?= $key ?>" id="editcoursei" value="<?= $training['StashActorTraining_course'] ?>" Placeholder="Course" />
                                        <div class="row" style="margin-left:0px;">
                                            <input type="text" class="editwhite short" id="editstarti" name="tr_start_<?= $key ?>" value="<?= $training['StashActorTraining_start_time'] ?>" Placeholder="Starting Year"/>
                                            <input type="text" class="editwhite short" id="editendi" name="tr_end_<?= $key ?>" value="<?= $training['StashActorTraining_end_time'] ?>" Placeholder="Ending Year"/>
                                        </div>
                                        <textarea class="editwhite long" name="tr_blurb_<?= $key ?>" id="edittrainingdescriptioni" style="height:100px;"><?= $training['StashActorTraining_blurb'] ?></textarea>
                                        <br>
                                        <font class="sortbuttons">
                                            <button class="btn submit-btn firstcolor center btnExpAndTraining"
                                                    data-input-names="tr_title_<?= $key ?>, tr_course_<?= $key ?>, tr_start_<?= $key ?>, tr_end_<?= $key ?>, tr_blurb_<?= $key ?>"
                                                    data-key="<?= $key ?>"
                                                    data-table-id="<?= $training['StashActorTraining_id'] ?>"
                                                    data-request="EditTraining"
                                                    data-hide-id="#training-<?= $key ?>_edit" 
                                                    data-unhide-id="#training-<?= $key ?>">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                        </font>
                                        <hr>
                                    </span>

                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
   
        </div>
    </div>

          <!-- Modal -->
          <div id="photosupload" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title firstcolor info">Upload Photos</h4><span class="info-small gray"><?= AC_UploadHelpTxt ?></span>

                  <?php $images = json_decode($actorProfile['StashActor_images'], true);
                    $count_image=sizeof($images);
                    if($count_image>=10){
                    echo "<div class='alert alert-danger' role='alert'>
                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                              <span class='sr-only'>Warning:</span>
                              ".AC_MaxLimitWarn." 
                            </div>";
                  }?>
                </div>
                <div class="modal-body" style="background-color:#f2f2f2;">
                  <div class="container" style="max-width:100%; ">
                   
                    <div class="form-group" style="margin-top: -100px;">
                           <form action="<?= base_url() ?>upload/" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;margin-top:120px;"></form>
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor disabled" id="upload-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Upload</button>
                    <button type="submit" class="btn submit-btn firstcolor" onclick="location.reload()" id="upload-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Done</button>
                
                  </div>
                  </div>
                </div>
                
              </div>

            </div>
            <div id="set_profile_photo" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title firstcolor info">Choose Profile Photo</h4><span class="info-small gray"></span>
                </div>
                <div class="modal-body" style="background-color:#f2f2f2;">
                  <div class="container" style="max-width:100%; ">
                   
                   <div class="row" style="padding-right:15px;">
                                    <div class="DocumentList" style="text-align:center">
                                        <ul class="list-inline center" style="vertical-align:middle;">
                                            
                                        <?php
                                            $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            $number_of_images=sizeof($images);
                                            if($number_of_images==0)
                                            {
                                                echo '<div class="info gray">'.AC_NoImage.'<br><button type="submit" class="btn submit-btn firstcolor toggleEdit"  data-toggle="modal" data-target="#photosupload" data-hide-id="#set_profile_photo" id="btn-login" ><span class="glyphicon glyphicon-plus"></span> &nbsp;Upload Photos</button></div>';
                                            }
                                            else
                                            {
                                                $counter=0;
                                                foreach ($images as $key => $image) {
                                                    echo "<li class='DocumentItem setProfilePic'>"
                                                        . "<a href='".IMG."/actors/".$image."' >"
                                                        .   "<img src='".IMG."/actors/".$image."' height='100%' width='auto' style='border-radius:10px;'>"
                                                        . "</a>"
                                                        . "</li>";
                                                        $counter++;
                                                        if($counter%3==0)
                                                        {
                                                            echo '<br>';
                                                        }
                                                }
                                            }
                                        ?>     

                                        </ul>
                                    </div>
                                </div>
                  </div>
                  </div>
                </div>
                
              </div>

            </div>
            
            <div id="feetToCmConverterModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
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
                                  <select class="form-control add" name="feet" >
                                    <?php
                                        for($i = 0; $i < 11; $i++)
                                            echo "<option value='{$i}'>{$i}</option>";
                                    ?>
                                  </select>
                                  

                              </div>
                              <div class="col-sm-6 form-group no-paddinglr">
                                <span class="info-small gray">Inches</span>
                                <select class="form-control add" name="inches" >
                                    <?php
                                        for($i = 0; $i < 12; $i++)
                                            echo "<option value='{$i}'>{$i}</option>";
                                    ?>
                                  </select>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group no-paddinglr" style="text-align:center;">
                                    <button type="submit" class="btn submit-btn firstcolor" style="margin-top: 20px; margin-left:10px;" id="btn-search" >
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
            </div>
            
            
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
