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
            font-family: AvenirNext-Bold;
            font-size: 30px;
            color: #4A4A4A;
            text-align: left;
            margin-bottom: 15px;

        }


        .a_pic{
            /* Rectangle 1: */
            margin-top: 15px;
            background: #EBEBEB;
            border: 1px solid #979797;
            border-radius: 10px;
            height: 130px;
            width: 130px;
            /* Path 2: */
            background: #C9C9C9;
            border: 1px solid #9B9B9B;
            float: left;
            padding-left: 0px !important;
        }
        .pro-pic{
            border-radius: 10px;
            height: 128px;
            width: 128px;
        }
        .left{
            text-align: left;
        }
        .basics{
            text-align: left;
            margin-top: 15px;
        }
        .category_heading{
            font-family: Raleway;
            font-weight: 400;
            font-size: 20px;
            color: #C9C9C9;
            
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
            text-shadow: 0px 1px 0px #FFFFFF;
        }
        .language_tag{
            border: 1px solid #FBB515;
            border-radius: 3px;
            background: transparent;
            font-family: AvenirNext-Regular;
            font-size: 14px;
            overflow: scroll;
            max-width: 100%; 
        }
         .skills_tag{
            border: 1px solid #F05759;
            border-radius: 3px;
            background: transparent;
            font-family: AvenirNext-Regular;
            font-size: 14px;
            overflow: scroll;
            max-width: 100%;
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
            border-radius: 3px;
        }
        #second_column_actor{
            margin-top:10px;
            margin-left: 30px; 
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
                            <img src="../img/logo.png" class="brands"/><span class="vertical-middle brandname">C A S T I K O</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                       
                        <li>
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
                    <div class="col-sm-3 light-padded mycontent-left left">
                        <span class="a_name"><?= $actorProfile['StashActor_name'] ?></span>
                        <div class = "row">
                            <div class=" col-sm-4 a_pic">
                                <span class="glyphicon glyphicon-camera  toggleEdit overlay_edit" data-unhide-id="#weight_edit" data-hide-id="#actor_weight" aria-hidden="true"></span>
                                <img src="<?= IMG .'/'.$actorProfile['StashActor_avatar'] ?>"class="pro-pic"></img> 
                                 <input type="hidden" id="image_count" value='<?= $actorProfile['StashActor_images'] ?>'>
                                <input type="hidden" id="profile_pic" value="<?= $actorProfile['StashActor_avatar'] ?>">
                            </div>
                            <div class="basics col-sm-6">
                                <div class="category_heading">BASICS<span class="glyphicon glyphicon-pencil  pull-right toggleEdit" data-unhide-id="#weight_edit" data-hide-id="#actor_weight" aria-hidden="true"></span></div>
                                <div class="elements"><?= ($actorProfile['StashActor_gender']) ? "Male" : "Female" ?><br><?= $actorProfile['StashActor_min_role_age'] ?>-<?= $actorProfile['StashActor_max_role_age'] ?><br><?= $actorProfile['StashActor_weight'] ?>kgs<br><?= $actorProfile['StashActor_height'] ?> cms<br></div>
                            </div>
                            <div class="basics col-sm-2">
                            </div>
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">DETAILS
                                <span class="glyphicon glyphicon-pencil  pull-right toggleEdit" data-unhide-id="#weight_edit" data-hide-id="#actor_weight" aria-hidden="true"></span>
                            </div>
                                <span class="elements_label">Date of Birth :</span><span class="elements"><?php
                                if($actorProfile['StashActor_dob'] == 0){
                                    echo '';
                                    $actorProfile['StashActor_dob'] = strtotime("-18 years");
                                }else{
                                    echo date("m/d/Y", $actorProfile['StashActor_dob']);
                                }
                            ?></span><br>
                                <span class="elements_label">Email :</span><span class="elements"> <?= $actorProfile['StashActor_email'] ?></span><br>
                                <span class="elements_label">Phone:</span><span class="elements"> <?= $actorProfile['StashActor_mobile'] ?></span><br>
                                <span class="elements_label">WhatsaApp :</span><span class="elements"><?= $actorProfile['StashActor_whatsapp'] ?></span><br>
                        </div>
                         <div class="row">
                            <br>
                            <div class="category_heading">CASTING DIRECTORS
                            </div>
                            <?php
                                    $casting_directors = $actorProfile['StashActor_casting_director'];
                                    foreach ($casting_directors as $key => $casting_director) {
                                ?>
                                <span class="elements_label"> $casting_director</span><br>
                             <?php
                                    }
                            ?>
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">LANGUAGES
                                <span class="glyphicon glyphicon-pencil  pull-right toggleEdit" data-unhide-id="#language_edit" data-hide-id="#actor_language" aria-hidden="true"></span>
                            </div>
                             <span id="actor_language" class="info dark-gray ">
                                <?php
                                    $languages = $actorProfile['StashActor_language'];
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
                                 <input type="text" class="form-control login" value="<?= implode(",", $actorProfile['StashActor_language']) ?>" id="language" data-role="tagsinput" name="language" placeholder= "Language :" />
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
                               <span class="glyphicon glyphicon-pencil pull-right toggleEdit" data-unhide-id="#skills_edit" data-hide-id="#actor_skills" aria-hidden="true"></span>
                            </div>
                                 <span id="actor_skills" class="info dark-gray">
                                <?php
                                    $skills = $actorProfile['StashActor_skills'];
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
                                 <input type="text" class="form-control login" value="<?= implode(",", $actorProfile['StashActor_skills']) ?>" id="skills" data-role="tagsinput" name="skills" placeholder= "Skills :" />
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
                         <div class="row col-sm-10" >
                            <br>
                            <div class="category_heading">EXPERIENCE
                                <span id="openexperienceicon" class="glyphicon glyphicon-plus edit-button pull-right firstcolor toggleEdit" data-unhide-id="#experience_add, #closeexperienceicon" data-hide-id="#openexperienceicon" aria-hidden="true"></span>
                                <span id="closeexperienceicon" class="glyphicon glyphicon-minus pull-right hidden toggleEdit" data-hide-id="#experience_add, #closeexperienceicon" data-unhide-id="#openexperienceicon" aria-hidden="true"></span>
                            </div>
                            <div >
                               <span id="experience_add" class="hidden">
                                    <input type="text" class="editwhite long" name='exp_title' id="addtitle" Placeholder="Title of the play, ad, film etc." />
                                    <input type="text" class="editwhite long" name='exp_role' id="addrole" Placeholder="Role e.g. Dad, Mom, Character Name"/>
                                    <input type="text" class="editwhite long" name='exp_link' id="addlink" Placeholder="Youtube Video Link"/>
                                    <textarea class="editwhite long" name='exp_blurb' id="adddescription" placeholder="A little description about the role and the project." style="height:80px;"></textarea>
                                    <br><font class="sortbuttons"><button class="btn submit-btn firstcolor center addExperience"  ><span class="glyphicon glyphicon-ok"></span></button></font>
                                <hr>
                                </span>
                                <div id="experiencelist" style="max-height:220px; overflow:scroll;">
                                <?php

                                    foreach ($actorExperiences as $key => $experience) {
                                        $youtube_flag=0;
                                        $youtube="";
                                        if (strpos($experience['StashActorExperience_link'], 'yout') !== false) {
                                            $youtube_flag=1;
                                            $youtube=str_replace("watch?v=","/embed/",$experience['StashActorExperience_link']);
                                        }
                                        

                                ?>

                                    <span id="experience-<?= $key ?>" class="info dark-gray">

                                        <?
                                            if($youtube_flag==1) 
                                            {
                                                echo '<div class="col-sm-7"><iframe style="width:100%;" height="189" src="'.$youtube.'" frameborder="0" allowfullscreen></iframe></div>';
                                                echo '<div class="col-sm-5" style="padding-left:0px; min-height:220px; ">
                                                        <span class="info black" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        <span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-'.$key.'" aria-hidden="true"></span>
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'">
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                        <br>
                                                        <span class="info-small dark-gray" id="actor_ex_blurb_'.$key.'">
                                                        '.$experience['StashActorExperience_blurb'].'
                                                        </span>

                                                    </div>
                                                    ';

                                            }
                                            else
                                            {
                                                echo'<span class="info black" style="margin-left:15px;" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        <span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" style="margin-left:15px;"  data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-<?= $key ?>" aria-hidden="true"></span>
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'" style="margin-left:15px;" >
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                    <br>
                                                        <span class="info-small dark-gray" id="actor_ex_blurb_'.$key.'" style="margin-left:15px;" >
                                                            '.$experience['StashActorExperience_blurb'].'
                                                        </span><hr>';
                                            }
                                        ?>
                                        <br>
                                        
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
                                    <div class="DocumentList">
                                        <ul class="list-inline">
                                            
                                        <?php
                                            $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            foreach ($images as $key => $image) {
                                                echo "<li class='DocumentItem'>"
                                                    . "<a href='".IMG."/actors/".$image."' data-lightbox='".$actorProfile['StashActor_name']."'>"
                                                    .   "<img src='".IMG."/actors/".$image."' height='100%' width='auto' class=' img-rounded'>"
                                                    . "</a>"
                                                    . "</li>";
                                            }
                                        ?>     

                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                <div id="traininglist" style="max-height:300px; overflow:scroll;">
                                    <?php
                                        foreach ($actorTrainings as $key => $training) {
                                    ?>

                                    <span id="training-<?= $key ?>" class="info dark-gray">
                                        <div class="row">
                                            
                                            <span class="training_title col-sm-4" id="actor_tr_title_<?= $key ?>">
                                                <span class="training-plus toggleEdit" id="actor_tr_plus_<?= $key ?>" data-hide-id="#actor_tr_plus_<?= $key ?>" data-unhide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>">+</span>
                                                <span  id="actor_tr_minus_<?= $key ?>" class="toggleEdit training-minus hidden" data-hide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>" data-unhide-id="#actor_tr_plus_<?= $key ?>" >-</span>
                                                <?= $training['StashActorTraining_title'] ?>
                                            </span>
                                            <span class="info-small dark-gray col-sm-4" id="actor_tr_course_<?= $key ?>">
                                                <?= $training['StashActorTraining_course'] ?>
                                            </span>
                                            <span class="glyphicon glyphicon-pencil edit-button firstcolor toggleEdit col-sm-2" data-hide-id="" data-unhide-id="#training-<?= $key ?>_edit" data-hide-id="#training-<?= $key ?>" aria-hidden="true">

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
<?php
    include 'includes/scripts.php';
?>
