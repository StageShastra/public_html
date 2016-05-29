<?php
    include 'includes/head.php';
    
    $user = $actor;
    $actorProfile = $profile;
    $actorExperiences = $experience;
    $actorTrainings = $training;
    //$actor_ref = ;
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
            max-width: 100%; 
            padding-left:0px;
             width:100%;
            overflow-x:hidden;
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
            overflow-x:hidden;
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
    width: 105px;
    height: 105px;
    overflow: hidden;
    margin-top:20px;
    margin-right: 5px;
    position: relative;
    border-radius: 10px;
}
.hidden_scroll{
overflow-y:hidden;
}
.hidden_scroll:hover{
overflow-y:scroll;
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
                            <img src="<?= IMG ?>/logo.png" class="brands"/><span class="vertical-middle brandname">C A S T I K O</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                       
                        
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>

           <!-- contact modal toggle -->
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
                            <img src="<?= IMG ?>/logo.png" class="brands"/><span class="vertical-middle brandname">C A S T I K O</b></span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>
                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>

           <!-- contact modal toggle -->
             <div class="container-fluid padded">

                <div class="container col-sm-12 center" id="browse-table">
                    <div class="col-sm-3 light-padded mycontent-left left">
                        <span class="a_name"><?= $actorProfile['StashActor_name'] ?></span>
                        <div class = "row" id="actor_basics">
                            <div class=" col-sm-4 a_pic" id="actor_pro_pic">
                                
                                <img src="<?= IMG .'/actors/'.$actorProfile['StashActor_avatar'] ?>" id="actorAvatar" class="pro-pic"></img> 
                            </div>
                            <div class="basics col-sm-6" style="padding-left:0px;padding-right:0px;">
                                <div class="category_heading ">BASICS</div>
                                <div class="elements">
                                    <span class="elements_label">Sex: </span><span id="actor_sex"><?= ($actorProfile['StashActor_gender']) ? "Male" : "Female" ?></span>
                                    <br>
                                    <span class="elements_label">Age Range: </span><span id="actor_min_age"><?= $actorProfile['StashActor_min_role_age'] ?></span>-<span id="actor_max_age"><?= $actorProfile['StashActor_max_role_age'] ?></span> <span style="font-size:9px;"></span><br>
                                   <span class="elements_label">Weight: </span><span id="actor_weight"><?= $actorProfile['StashActor_weight'] ?></span> kgs<br>
                                    <span class="elements_label">Height</span><span id="actor_height"><?= $actorProfile['StashActor_height'] ?></span> cms<br>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">DETAILS
                            </div>
                            <div id="actor_details">
                                <span class="elements_label">Date of Birth: </span><span class="elements" id="actor_dob"><?php
                                if($actorProfile['StashActor_dob'] == 0){
                                    echo '';
                                    $actorProfile['StashActor_dob'] = strtotime("-18 years");
                                }else{
                                    echo date("m/d/Y", $actorProfile['StashActor_dob']);
                                }
                            ?></span><br>
                                
                            </div>
						</div>
                        <div class="row">
                            <br>
                             <div class="category_heading">LANGUAGES</div>
                             <span id="actor_language" class="info dark-gray ">
                                <?php
                                    $languages = $actorProfile['StashActor_language'];
                                    foreach ($languages as $key => $language) {
                                ?>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn language_tag" aria-label="Left Align" >
                                        <font class="taga-text"><?php $lan=ucfirst(trim($language)); if(strlen($lan)>7) {echo substr($lan, 0, 7).'...';} else{echo $lan;}?></font>
                                    </button>
                                </div>  
                                <?php
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">SKILLS</div>
                                 <span id="actor_skills" class="info dark-gray">
                                <?php
                                    $skills = $actorProfile['StashActor_skills'];
                                    foreach ($skills as $key => $skill) {
                                ?>
                                <div class="col-sm-4 vertical-padded">
                                    <button type="button" class="btn skills_tag" aria-label="Left Align" >
                                        <font class="taga-text"><?php $skill_=ucfirst(trim($skill)); if(strlen($skill_)>7) {echo substr($skill_, 0, 7).'...';} else{echo $skill_;}?></font>
                                    </button>
                                </div>  
                                <?php
                                    }
                                ?>

                            </span>
                                
                        </div>

                    </div>
                    <div class="col-sm-6 left" id="second_column_actor">
                         <div class="row col-sm-12 mycontent-left" >
                            <br>
                            <div class="category_heading">EXPERIENCE</div>
                            <div >
                                <div id="experiencelist" style="max-height:220px;">
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
                                            echo '<span id="experience-'.$key.'" class="info dark-gray">';
                                        }
                                        else
                                        {
                                            echo '<span id="experience-'.$key.'" class="info dark-gray hidden">';  
                                        }
                                           
                                            if($youtube_flag==1) 
                                            {    
                                                
                                               echo '<div class="col-sm-7" style="padding-left:0px;"><iframe style="width:100%;" height="189px" src="'.$youtube.'" frameborder="0" allowfullscreen></iframe></div>';
                                               echo '<div class="col-sm-5" style="padding-left:0px; max-height:220px; height:220px;">
                                                        <span class="info black" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'">
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                        <br>
                                                            <div style="height:100%;overflow:hidden;">
                                                            <div class="info-small dark-gray hidden_scroll" id="actor_ex_blurb_'.$key.'" style="height:130px;">
                                                            '.$experience['StashActorExperience_blurb'].'
                                                            </div>
                                                            </div>
                                                      </div>';
                                               
                                            }
                                            else
                                            {   
                                                echo'<span class="info black" style="margin-left:15px;" id="actor_ex_title_'.$key.'"><b>'.$experience['StashActorExperience_title'].'</b></span>
                                                        
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'" style="margin-left:15px;" >
                                                            <i>as </i>'.$experience['StashActorExperience_role'].'
                                                        </span>
                                                    <br>
                                                        <span class="info-small dark-gray" id="actor_ex_blurb_'.$key.'" style="margin-left:15px;" >
                                                            '.$experience['StashActorExperience_blurb'].'
                                                        </span>';
                                                
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
                                    

                                <?php
                                    }
                                ?>
                                </div>
                                <hr>
                            </div>
                            <div class="category_heading">GALLERY
                                <div id="photos_videos">
                                <div class="row" style="padding-right:15px;">
                                    <div class="DocumentList" style="height:auto; overflow-x:hidden;">
                                        <ul class="list-inline">
                                            
                                        <?php
                                            $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            $counter=0;
                                            foreach ($images as $key => $image) {
                                                echo "<li class='DocumentItem'>"
                                                    . "<a href='".IMG."/actors/".$image."' data-lightbox='".$actorProfile['StashActor_name']."'>"
                                                    .   "<img src='".IMG."/actors/".$image."' height='100%' width='auto' class=' img-rounded'>"
                                                    . "</a>"
                                                    . "</li>";
                                                    $counter++;
                                                        if($counter%4==0)
                                                        {
                                                            echo '<br>';
                                                        }
                                            }
                                        ?>     

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="category_heading">TRAINING</div>
                               
                            </span>
                            <div id="actor_training">
                                <div id="traininglist" >
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

                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            </div>
                            </div>
                           <div class="col-sm-2 left">
                                <div class="row">
                                    <br>
                                     <div class="category_heading" style="padding-top:15px;">PROJECTS</div>
                                     <span id="actor_language" class="info dark-gray ">
                                        <?php
                                            $projects = $actorProfile['StashActor_projects'];
                                            foreach ($projects as $key => $project) {
                                        ?>
                                        <div class="col-sm-12 vertical-padded">
                                            <button type="button" class="btn project_tag" style="max-width:200%;" aria-label="Left Align" >
                                                <font class="taga-text"><?php $proj=ucfirst(trim($project)); if(strlen($proj)>20) {echo substr($proj, 0, 20).'...';} else{echo $proj;}?></font>
                                            </button>
                                        </div>  
                                        <?php
                                            }
                                        ?>
                                     
                                    </span>
                                </div>
                            <hr>
                            </div>
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