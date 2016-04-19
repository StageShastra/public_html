<?php

    session_start();
    session_regenerate_id();

    include_once '../resources/db_config.php';
    include_once '../resources/functions.php';


    if(!isset($_SESSION['STASH_ACTOR_LOGIN']))
        header("Location: index.php");

    $actor_ref = $_SESSION['STASH_ACTOR_ID'];
    $actorProfile = getActorProfile($actor_ref);
    $_SESSION['STASH_ACTOR_NAME']=$actorProfile['StashActor_name'];
    $actorExperiences = getActorExperience($actor_ref);
    $actorTrainings = getActorTraining($actor_ref);

    /*echo "<pre>";
    print_r($actorProfile);
    print_r($actorExperiences);
    print_r($actorTrainings);
    echo "</pre>";*/


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Stage Shastra | Makes Casting easier.</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/lightbox.css">
        <link rel="stylesheet" href="../css/datatable.css">
        <link href="../css/dropzone.css" type="text/css" rel="stylesheet" />
        <link href="../css/animate.css" type="text/css" rel="stylesheet" />
        <script src="../js/dropzone.js"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/tagsinput.css" />
        <script type="text/javascript">
          window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var n=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(n?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(a,o);for(var r=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["clearEventProperties","identify","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=r(p[c])};
          heap.load("267160806");
        </script>
    </head>
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
                        <a class="navbar-brand" href="index.php">
                            <img src="../img/logo.png" class="brands"/><span class="vertical-middle brandname">STAGE<b>SHASTRA</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                       
                        <li >
                            <a href="../resources/logout_actor.php"><button type="button" class="btn submit-btn firstcolor" id="btn-logout"  ><span class="glyphicon glyphicon-log-out"></span> &nbsp; Sign Out</button></a>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>

           <!-- contact modal toggle -->
            <div class="container-fluid padded">
                <div class="alert alert-warning alert-dismissible" id="warningmsg" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> Your profile looks empty, we suggest you to complete your profile. It helps you get more auditions.
                </div>

                <div class="container col-sm-12 center" id="browse-table">
                    <div class="col-sm-8 mycontent-left marginTop">
                        <input type="hidden" name="actor_ref" value="<?= $actor_ref ?>">
                      <div class="col-sm-6 mycontent-left ">
                        <div class=" container col-sm-7 center" id="actorprofile">
                            <div id="profile_photo_upload" class="hidden" onclick="upload_picture()">
                                <span class="info-small gray center " style="vertical-align:middle;" > Upload Picture </span>
                            </div>
                            <div class="img-div center " id="profile_image">
                                <img src="<?= $actorProfile['StashActor_avatar'] ?>">
                                <input type="hidden" id="image_count" value="<?= $actorProfile['StashActor_images'] ?>">
                                <input type="hidden" id="profile_pic" value="<?= $actorProfile['StashActor_avatar'] ?>">
                            </div>
                            <div class="col-sm-12 left marginTop " id="name_container">
                                <span id="actor_name" class="info dark-gray "><?= $actorProfile['StashActor_name'] ?></span>
                                <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#name_edit" data-hide-id="#name_container" aria-hidden="true"></span>
                                <br>
                                <span id="actor_age" class="info-small black "><?= calculateAge($actorProfile['StashActor_dob']) ?></span>,<span id="actor_sex" class="info-small black"><?= ($actorProfile['StashActor_gender']) ? "Male" : "Female" ?></span>
                            </div>
                            <div class="col-sm-12 left marginTop hidden" id="name_edit">
                                <input type="text" class="editinput" id="name" name="name" value="<?= $actorProfile['StashActor_name'] ?>" placeholder="Name"/>
                                <select type="text" class="editinput" name="sex" value="<?= ($actorProfile['StashActor_gender']) ? "M" : "F" ?>" id="sex" placeholder="Sex">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                                <br>
                                <center>
                                    <font class="sortbuttons">
                                        <button type="button" class="btn submit-btn firstcolor center  updateDataField"  
                                            data-input-names="name, sex"
                                            data-request="EditName"
                                            data-hide-id="#name_edit" 
                                            data-unhide-id="#name_container">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                    </font>
                                </center>
                            </div>
                        </div>   
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Phone No. : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#phone_edit" data-hide-id="#actor_phone" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_phone" class="info dark-gray "><?= $actorProfile['StashActor_mobile'] ?></span>
                            <span id="phone_edit" class="left hidden">
                                <input type="text" class="editwhite " name="phone" value="<?= $actorProfile['StashActor_mobile'] ?>" id="phone"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center tick updateDataField" 
                                            data-input-names="phone"
                                            data-request="EditMobile"
                                            data-hide-id="#phone_edit" 
                                            data-unhide-id="#actor_phone">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                            <br>
                            <span class="actorlabel" >
                                Whatsapp No. : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#whatsapp_edit" data-hide-id="#actor_whatsapp" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_whatsapp" class="info dark-gray "><?= $actorProfile['StashActor_whatsapp'] ?></span>
                            <span id="whatsapp_edit" class="left hidden  ">
                                <input type="text" class="editwhite " name="whatsapp" value="<?= $actorProfile['StashActor_whatsapp'] ?>" id="whatsapp"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center tick updateDataField" 
                                            data-input-names="whatsapp"
                                            data-request="EditWhatsApp"
                                            data-hide-id="#whatsapp_edit" 
                                            data-unhide-id="#actor_whatsapp">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                            </span>
                            <br>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Email Id. : <!-- <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#email_edit" data-hide-id="#actor_email" aria-hidden="true"></span> -->
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_email" class="info dark-gray "><?= $actorProfile['StashActor_email'] ?></span>
                            <!-- <span id="email_edit" class="left  hidden ">
                                <input type="text" class="editwhite" value="<?= $actorProfile['StashActor_email'] ?>" id="email"/>
                                <font class="sortbuttons"><button onclick="update_email()"  class="btn submit-btn firstcolor center tick"  ><span class="glyphicon glyphicon-ok"></span></button></font>
                            </span> -->
                        </div>
                        
                      </div>
                      <div class="col-sm-6 marginTop">
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Date of Birth. : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#dob_edit" data-hide-id="#actor_dob" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_dob" class="info dark-gray"><?= date("m/d/Y", $actorProfile['StashActor_dob']) ?></span>
                            <span id="dob_edit" class="left  hidden ">
                                <input type="date" name="dob" class="editwhite" value="<?= date("Y-m-d", $actorProfile['StashActor_dob']) ?>" id="dob"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center tick updateDataField"
                                            data-input-names="dob"
                                            data-request="EditDOB"
                                            data-hide-id="#dob_edit" 
                                            data-unhide-id="#actor_dob">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                            <br>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Age Range : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#agerange_edit" data-hide-id="#actor_agerange" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_agerange" class="info dark-gray">
                                <span id="actor_min_age"><?= $actorProfile['StashActor_min_role_age'] ?></span> - 
                                <span id="actor_max_age"><?= $actorProfile['StashActor_max_role_age'] ?></span> years.
                            </span>
                            <span id="agerange_edit" class="left hidden">
                                <input type="text" name='min_age' class="editwhite short" value="<?= $actorProfile['StashActor_min_role_age'] ?>" title="What  minimum age would you naturally be able to play on screen/stage?" id="agemin"/>
                                <input type="text" name='max_age' class="editwhite short" value="<?= $actorProfile['StashActor_max_role_age'] ?>" title="What  maximum age would you naturally be able to play on screen/stage?" id="agemax"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center updateDataField"
                                            data-input-names="min_age, max_age"
                                            data-request="EditMinMaxAge"
                                            data-hide-id="#agerange_edit" 
                                            data-unhide-id="#actor_agerange">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                            <br>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left ">
                            <span class="actorlabel" >
                                Height. : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#height_edit" data-hide-id="#actor_height" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_height" class="info dark-gray "><?= $actorProfile['StashActor_height'] ?> cms.</span>
                            <span id="height_edit" class="left hidden">
                                <input type="text" class="editwhite" name='height' placeholder="Height in cms" value="<?= $actorProfile['StashActor_height'] ?>" id="height"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center tick updateDataField"
                                            data-input-names="height"
                                            data-request="EditHeight"
                                            data-hide-id="#height_edit" 
                                            data-unhide-id="#actor_height">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                            <br>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Weight : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#weight_edit" data-hide-id="#actor_weight" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_weight" class="info dark-gray"><?= $actorProfile['StashActor_weight'] ?> kgs.</span>
                            <span id="weight_edit" class="left hidden">
                                <input type="text" class="editwhite" name='weight' placeholder="weight in kgs" value="<?= $actorProfile['StashActor_weight'] ?>" id="weight"/>
                                <font class="sortbuttons">
                                    <button type="button" class="btn submit-btn firstcolor center tick updateDataField"
                                            data-input-names="weight"
                                            data-request="EditWeight"
                                            data-hide-id="#weight_edit" 
                                            data-unhide-id="#actor_weight">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </font>
                            </span>
                            <br>
                            <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Languages : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#language_edit" data-hide-id="#actor_language" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_language" class="info dark-gray ">
                                <?php

                                    $languages = explode(",", $actorProfile['StashActor_language']);

                                    foreach ($languages as $key => $language) {
                                ?>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" style="max-width:200%;" aria-label="Left Align" >
                                        <font class="taga-text"><?= ucfirst(trim($language)) ?></font>
                                    </button>
                                </div>  
                                <?php
                                    }

                                ?>
                            </span>
                            <span id="language_edit" class="left hidden ">
                                 <input type="text" class="form-control login" value="<?= $actorProfile['StashActor_language'] ?>" id="language" data-role="tagsinput" name="language" placeholder= "Language :" />
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
                            <hr class="taghr">
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Skills : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#skills_edit" data-hide-id="#actor_skills" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_skills" class="info dark-gray">
                                <?php

                                    $skills = explode(",", $actorProfile['StashActor_skills']);

                                    foreach ($skills as $key => $skill) {
                                ?>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn tagp" style="max-width:200%;" aria-label="Left Align" >
                                        <font class="taga-text"><?= ucfirst(trim($skill)) ?></font>
                                    </button>
                                </div>  
                                <?php
                                    }

                                ?>

                            </span>
                            <span id="skills_edit" class="left hidden ">
                                 <input type="text" class="form-control login" value="<?= $actorProfile['StashActor_skills'] ?>" id="skills" data-role="tagsinput" name="skills" placeholder= "Skills :" />
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
                      <div class="col-sm-12">
                        <div class="col-sm-11 center">
                            <hr>
                            <span class="actorlabel pull-left" >
                                    Photos and Videos : <span class="glyphicon glyphicon-plus edit-button" data-toggle="modal" data-target="#photosupload" aria-hidden="true"></span>
                                    <hr align="left" width="15px" class="tenth">
                            </span>
                            <div id="photos_videos">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Experience : 
                                <span id="openexperienceicon" class="glyphicon glyphicon-plus edit-button pull-right firstcolor toggleEdit" data-unhide-id="#experience_add, #closeexperienceicon" data-hide-id="#openexperienceicon" aria-hidden="true"></span>
                                <span id="closeexperienceicon" class="glyphicon glyphicon-minus edit-button pull-right hidden toggleEdit" data-hide-id="#experience_add, #closeexperienceicon" data-unhide-id="#openexperienceicon" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <div id="actor_experience">

                                <span id="experience_add" class="hidden">
                                    <input type="text" class="editwhite long" name='exp_title' id="addtitle" Placeholder="Title of the play, ad, film etc." />
                                    <input type="text" class="editwhite long" name='exp_role' id="addrole" Placeholder="Role e.g. Dad, Mom, Character Name"/>
                                    <input type="text" class="editwhite long" name='exp_link' id="addlink" Placeholder="Youtube Video Link"/>
                                    <textarea class="editwhite long" name='exp_blurb' id="adddescription" placeholder="A little description about the role and the project." style="height:80px;"></textarea>
                                    <br><font class="sortbuttons"><button class="btn submit-btn firstcolor center addExperience"  ><span class="glyphicon glyphicon-ok"></span></button></font>
                                <hr>
                                </span>
                                <div id="experiencelist" style="max-height:400px; overflow:scroll;">
                                <?php

                                    foreach ($actorExperiences as $key => $experience) {
                                ?>

                                    <span id="experience-<?= $key ?>" class="info dark-gray">
                                        <span class="info black" id="actor_ex_title_<?= $key ?>"><b><?= $experience['StashActorExperience_title'] ?></b></span>
                                        <span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" data-unhide-id="#experience-<?= $key ?>_edit" data-hide-id="#experience-<?= $key ?>" aria-hidden="true"></span>
                                        <br>
                                        <span class="info black" id="actor_ex_role_<?= $key ?>">
                                            <i>as</i> <?= $experience['StashActorExperience_role'] ?>
                                        </span>
                                        <hr>
                                        <span class="info-small dark-gray" id="actor_ex_blurb_<?= $key ?>">
                                            <?= $experience['StashActorExperience_blurb'] ?>
                                        </span>
                                        <span >
                                            <?
                                            if($experience['StashActorExperience_link']!="") 
                                            {
                                                echo '<br><a class="info-small" href="'.$experience['StashActorExperience_link'].'" target="_blank">Watch Video</a>';
                                            
                                            }
                                            ?>
                                        </span>
                                        <br><br>
                                    </span>
                                    <span id="experience-<?= $key ?>_edit" class="hidden">
                                        <input type="text" name="ex_title_<?= $key ?>" class="editwhite long" id="edittitlei" value="<?= $experience['StashActorExperience_title'] ?>" Placeholder="Title of the play, ad, film etc." />
                                        <input type="text" name="ex_role_<?= $key ?>" class="editwhite long" id="editrolei" value="<?= $experience['StashActorExperience_role'] ?>" Placeholder="Role e.g. Dad, Mom, Character Name"/>
                                        <input type="text" name="ex_link_<?= $key ?>" class="editwhite long" id="editlinki" value="<?= $experience['StashActorExperience_link'] ?>" Placeholder="Youtube"/>
                                        <textarea class="editwhite long" name="ex_blurb_<?= $key ?>" id="editdescriptioni" style="height:80px;overflow:scroll;"><?= $experience['StashActorExperience_blurb'] ?></textarea>
                                        <br>
                                        <font class="sortbuttons">
                                            <button type="button" class="btn submit-btn firstcolor center btnExpAndTraining"
                                                    data-input-names="ex_title_<?= $key ?>, ex_role_<?= $key ?>,ex_link_<?= $key ?>,ex_blurb_<?= $key ?>"
                                                    data-key="<?= $key ?>"
                                                    data-table-id="<?= $experience['StashActorExperience_id'] ?>"
                                                    data-request="EditExperience"
                                                    data-hide-id="#experience-<?= $key ?>_edit" 
                                                    data-unhide-id="#experience-<?= $key ?>">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                        </font>
                                        <hr>
                                    </span>
                                    <br>

                                <?php
                                    }

                                ?>
                                </div>
                            </div>
                        <hr>
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Training : <span id="opentrainingicon" class="glyphicon glyphicon-plus edit-button pull-right firstcolor toggleEdit" data-unhide-id="#training_add, #closetrainingicon" data-hide-id="#opentrainingicon" aria-hidden="true"></span>

                                <span id="closetrainingicon" class="glyphicon glyphicon-minus edit-button  hidden toggleEdit" data-hide-id="#training_add, #closetrainingicon" data-unhide-id="#opentrainingicon" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <div id="actor_training">
                                <span id="training_add" class="hidden">
                                    <input type="text" class="editwhite long" name='trn_title' id="addschool" Placeholder="School / Teacher" />
                                    <input type="text" class="editwhite long" name='trn_course' id="addcourse" Placeholder="Course" />
                                    <div class="row" style="margin-left:0px;">
                                        <input type="text" class="editwhite short" name='trn_start_time' id="addstart" Placeholder="Starting Year"/>
                                        <input type="text" class="editwhite short" name='trn_end_time' id="addend" Placeholder="Ending Year"/>
                                    </div>
                                    <textarea class="editwhite long" name='trn_blrub' id="addtrainingdescription" placeholder="A little description about the course." style="height:80px;"></textarea>
                                    <br><font class="sortbuttons"><button class="btn submit-btn firstcolor center addTraining"  ><span class="glyphicon glyphicon-ok"></span></button></font>
                                <hr>
                                </span>
                                <div id="traininglist" style="max-height:400px; overflow:scroll;">
                                    <?php
                                        foreach ($actorTrainings as $key => $training) {
                                    ?>

                                    <span id="training-<?= $key ?>" class="info dark-gray">
                                        <span class="info black" id="actor_tr_title_<?= $key ?>"><?= $training['StashActorTraining_title'] ?></span>
                                        <span class="glyphicon glyphicon-pencil edit-button pull-right firstcolor toggleEdit" data-unhide-id="#training-<?= $key ?>_edit" data-hide-id="#training-<?= $key ?>" aria-hidden="true"></span>
                                        <br>
                                        <span class="info-small dark-gray" id="actor_tr_course_<?= $key ?>"><?= $training['StashActorTraining_course'] ?></span>
                                        <br>
                                        <span class="info-small dark-gray">
                                        <span id="actor_tr_start_<?= $key ?>"><?= $training['StashActorTraining_start_time'] ?></span> - 
                                        <span id="actor_tr_end_<?= $key ?>"><?= $training['StashActorTraining_end_time'] ?></span>
                                        </span>
                                        <br>
                                        <span class="info-small dark-gray" id="actor_tr_blurb_<?= $key ?>">
                                            <?= $training['StashActorTraining_blurb'] ?>
                                        </span>
                                        <hr>
                                    </span>

                                    <span id="training-<?= $key ?>_edit" class="hidden">
                                        <input type="text" class="editwhite long" id="editschooli" name="tr_title_<?= $key ?>" value="<?= $training['StashActorTraining_title'] ?>" Placeholder="School / Teacher" />
                                        <input type="text" class="editwhite long" name="tr_course_<?= $key ?>" id="editcoursei" value="<?= $training['StashActorTraining_course'] ?>" Placeholder="Course" />
                                        <div class="row" style="margin-left:0px;">
                                            <input type="text" class="editwhite short" id="editstarti" name="tr_start_<?= $key ?>" value="" Placeholder="Starting Year"/>
                                            <input type="text" class="editwhite short" id="editendi" name="tr_end_<?= $key ?>" value="" Placeholder="Ending Year"/>
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
           

          <!-- Modal -->
          <div id="photosupload" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title firstcolor info">Upload Photos</h4><span class="info-small gray">You can upload multiple pictures at a time.Just dran n drop below.</span>
                </div>
                <div class="modal-body" style="background-color:#f2f2f2;">
                  <div class="container" style="max-width:100%; ">
                   
                    <div class="form-group" style="margin-top: -100px;">
                           <form action="../resources/actor_upload.php" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;margin-top:120px;"></form>
                    </div>
                    <button type="submit" class="btn submit-btn firstcolor" id="upload-btn"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Upload</button>
                
                  </div>
                  </div>
                </div>
                
              </div>

            </div>
                    
        <!--================================== Navigation Ends Here =======================================-!-->
            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src='../js/tagsinput.js'></script>
        <script src="../js/act.js"></script>
        <script src="../js/lightbox.js"></script>
        <script src="../js/stupidtable.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <footer class="footer">
          <foodiv class="container center">
            <p class="dark-gray info-small center ">© 2016 StageShastra | connect@stageshastra.com</p>
        </footer>
    </body>
</html>

