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
        .blurb{
            font-family: AvenirNext-Regular;
            color:#4A4A4A;
        }
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
            font-family: "Open Sans","Raleway","Helvetica";
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
        .skills_tag:
        {

        }
        .ellipsis{
             -webkit-transition: width 1s ease-in-out;
            -moz-transition: width 1s ease-in-out;
            -o-transition: width 1s ease-in-out;
            transition: width 1s ease-in-out;
        }
        .ellipsis:focus{
            width: auto;
        }
        .ellipsis:active{
            width: auto;
        }
        .ellipsis:visited{
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
            font-size: 15px;
            color: #9B9B9B;
            letter-spacing: 0px;
            text-shadow: 0px 1px 0px #FFFFFF;
        }
        .training_details{
            background: #EBEBEB;
            border-radius: 9px;
            font-size: 15px;
            color: black;
            padding-left: 15px;
            padding: 15px;
            width: 100%;
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
            float: left
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
        .navbar-fixed-top{
                margin-left: 0%;
                margin-right: 0%;
            }
           
        /* xs */
        @media screen and (max-width: 767px) {
            body {
                font-size: 0.9em;
            }
            .container-fluid{
                padding:0px;
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
                width:auto;
                height: 60px;
            }
            .nav_icons{
                position: absolute;
                top:10px;
            }
            .DocumentList{
                max-height:auto;
                height:auto;
                overflow-y:auto;
                overflow-x:hidden;
            }
            .blurb{
                font-size: 14px;
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
            .no_padding_small{
            padding-left: 0px;
            padding-right: 0px;
        }
        .DocumentItem{
                width:auto;
                height: 75px;
            }
            .blurb{
                font-size: 14px;
            }
        }
        /* md */
        @media screen and (min-width: 992px) {
            body {
                font-size: 1.1em;
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
                width:auto;
                height: 120px;
            }
            .blurb{
                font-size: 15px;
            }
            .ul_list{
                margin-right: 120px;
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
            .light-padded
            {
                padding-left: 10px;
            }
            .#browse-table{
                margin-top: 25px;
            }
            .DocumentItem{
                width:auto;
                height: 150px;
            }
            .blurb{
                font-size: 15px;
            }
            .ul_list{
                margin-right: 120px;
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
    box-shadow: 2px 2px 10px gray;
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
            padding: 2px;
            margin-top: -15px;
        }
        .collapse
        {
            height: auto;
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
        
.avatar-upload {
  overflow: hidden;
}

.avatar-upload label {
  display: block;
  float: left;
  clear: left;
  width: 100px;
}

.avatar-upload input {
  display: block;
  margin-left: 110px;
}

.avatar-alert {
  margin-top: 10px;
  margin-bottom: 10px;
}

.avatar-wrapper {
  height: 364px;
  width: 100%;
  margin-top: 15px;
  box-shadow: inset 0 0 5px rgba(0,0,0,.25);
  background-color: #fcfcfc;
  overflow: hidden;
}

.avatar-wrapper img {
  display: block;
  height: auto;
  max-width: 100%;
}

.avatar-preview {
  float: left;
  margin-top: 15px;
  margin-right: 15px;
  border: 1px solid #eee;
  border-radius: 4px;
  background-color: #fff;
  overflow: hidden;
}

.avatar-preview:hover {
  border-color: #ccf;
  box-shadow: 0 0 5px rgba(0,0,0,.15);
}

.avatar-preview img {
  width: 100%;
}

.preview-lg {
  height: 184px;
  width: 184px;
  margin-top: 15px;
}

.preview-md {
  height: 100px;
  width: 100px;
}

.preview-sm {
  height: 50px;
  width: 50px;
}

@media (min-width: 992px) {
  .avatar-preview {
    float: none;
  }
}

.avatar-btns {
  margin-top: 30px;
  margin-bottom: 15px;
}

.avatar-btns .btn-group {
  margin-right: 5px;
}

.loading {
  display: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: #fff url("../img/loading.gif") no-repeat center center;
  opacity: .75;
  filter: alpha(opacity=75);
  z-index: 20140628;
}
textarea{
    padding: 10px;
}
.long{
    margin-left: 2px;
    margin-right: 2px;
}
.introjs-helperNumberLayer{
    padding: 0px;
    line-height: normal;
}
.submit-btn{
    background: #FFC107;
    color: #fff;
    border-radius:4px;
    padding: 5px; 
    border: none;
    font-size: 14px;

}
.submit-btn:hover{
    background: #fff;
    color: #FFC107;
    border: 1px solid #FFC107;
}
.edit_inputs_basics{
    background: white;
    border-radius: 0px;
    border: 1px solid #ddd;
}
.alertbox{
    position: absolute;
    left: 0px;
    right: 0px;
    float: none;
    z-index: 99999999;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    margin-top: 20px;
    background: #607D8B !important;
    color: white;
    max-width: 400px;
    border: 3px solid;
    box-shadow: 2px 2px 10px gray;
}
.alert-dismissable .close, .alert-dismissible .close {
    position: relative;
    top: -2px;
    right: -5px;
    color: inherit;
}
.navbar-nav > li > a{
    font-size: 16px !important;
}
.navbar-nav > li > a:hover {
    color: #fff !important;
    background: #F7A9A9 !important;
}
.shareButton{
    font-size: 20px;
}
.counter_exp{
    font-size: 14px;
    color:#9b9b9b;
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
           
           <script>var first_time=1</script>
           <script> var step=5;</script>
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
                      <ul class="nav navbar-nav navbar-right" style="text-align:right;">
                       
                        
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>

           <!-- contact modal toggle -->

           <!-- contact modal toggle -->
             <div class="container-fluid">

                <div class="container col-sm-12 center" id="browse-table">
                    <div class="col-sm-3 light-padded left">
                        <div class="row">
                            <span class="a_name"><?= $actorProfile['StashActor_name'] ?></span>
                            <br>
                        </div>

                        <div class = "row" id="actor_basics">
                            <div class=" col-sm-3 col-lg-4 col-md-4  a_pic" id="actor_pro_pic">
                                <img src="<?= IMG .'/actors/'.$actorProfile['StashActor_avatar'] ?>" id="actorAvatar" class="pro-pic"></img> 
                                 <input type="hidden" id="image_count" value='<?= $actorProfile['StashActor_images'] ?>'>
                                <input type="hidden" id="profile_pic" value="<?= $actorProfile['StashActor_avatar'] ?>">
                            </div>
                            <div class="basics col-sm-12 col-lg-7 col-md-7" style="padding-left:0px;padding-right:0px;">
                                <div class="category_heading ">BASICS
                                </div>
                                <div class="elements">
                                    <span class="elements_label">Sex: </span><span id="actor_sex"><?= ($actorProfile['StashActor_gender']) ? "Male" : "Female" ?></span>
                                    <br>
                                    <span class="elements_label">Age Range: </span><span id="actor_min_age" ><?= $actorProfile['StashActor_min_role_age'] ?></span>-<span id="actor_max_age"><?= $actorProfile['StashActor_max_role_age'] ?></span><span> yrs</span><br>
                                   <span class="elements_label ">Weight: </span><span id="actor_weight" ><?= $actorProfile['StashActor_weight'] ?></span> kgs<br>
                                    <span class="elements_label ">Height: </span><span id="actor_height" ><?= $actorProfile['StashActor_height'] ?></span> cms<br>
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
                             <div class="category_heading">LANGUAGES
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
                        </div>
                        <div class="row">
                            <br>
                             <div class="category_heading">SKILLS
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
                                
                        </div>

                    </div>
                    <div class="col-sm-8 left" id="second_column_actor">
                         <div class="col-sm-12 no_padding_small" >
                            <br>
                            <div class="category_heading">EXPERIENCE 
                            </div>
                            <div >
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
                                                
                                                echo '<div class="col-sm-7" style="padding-left:0px;padding-right:0px;max-width:400px;"><div class="videoWrapper"><iframe width="482" height="300" src="'.$youtube.'" frameborder="0" allowfullscreen></iframe></div></div>';
                                                echo '<div class="col-sm-5"">

                                                        <span class="info black" id="actor_ex_title_'.$key.'"><b>'.ucfirst($experience['StashActorExperience_title']).'</b></span>

                                                        
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'">
                                                            <i>as </i>'.ucfirst($experience['StashActorExperience_role']).'
                                                        </span>
                                                        <br>
                                                            <div style="height:100%;overflow:hidden;">

                                                            <div class="info-small dark-gray hidden_scroll blurb" id="actor_ex_blurb_'.$key.'">
                                                            '.ucfirst($experience['StashActorExperience_blurb']).'
                                                            </div>
                                                            </div>
                                                      </div>';
                                               
                                            }
                                            else
                                            {   
                                                echo'<span class="info black" style="margin-left:15px;" id="actor_ex_title_'.$key.'"><b>'.ucfirst($experience['StashActorExperience_title']).'</b></span>
                                                        
                                                        <br>
                                                        <span class="info black" id="actor_ex_role_'.$key.'" style="margin-left:15px;" >
                                                            <i>as </i>'.ucfirst($experience['StashActorExperience_role']).'
                                                        </span>
                                                    <br>

                                                        <div class="info-small dark-gray blurb" id="actor_ex_blurb_'.$key.'" style="margin-left:15px;" >
                                                            '.ucfirst($experience['StashActorExperience_blurb']).'
                                                        </div>';
                                                
                                            }
                                            if($onlyone!=1)
                                            {
                                                $index=$key+1;
                                                echo '<div class="nav_icons">
                                                <span class="leftnav center edit-button toggleEdit glyphicon edit-button glyphicon-chevron-left gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$previous.'>
                                                </span><span class="counter_exp center">'.$index.' of '.$count_experience.'</span>
                                                <span class="righttnav edit-button toggleEdit center glyphicon glyphicon-chevron-right gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$next.' >
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
                                    <div class="DocumentList" style="height:auto;">
                                        <ul class="list-inline">
                                            
                                        <?php
                                            $images = json_decode($actorProfile['StashActor_images'], true);
                                            //print_r($images);
                                            $counter=0;
                                            foreach ($images as $key => $image) {

                                                echo "<li class='DocumentItem' id='DocumentItem_{$key}'>"
                                                    . "<a href='".IMG."/actors/".$image."' data-lightbox='".$actorProfile['StashActor_name']."'>"
                                                    .   "<img src='".IMG."/actors/".$image."' height='100%' width='auto' class=' img-rounded' title ='".$actorProfile['StashActor_name']." headshots and profile images' description='".$actorProfile['StashActor_name']." profile pictures and headshots from portfolio'>"
                                                    . "</a>"
                                                    . "</li>";
                                                    $counter++;
                                                        
                                            }
                                        ?>     

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="category_heading">TRAINING
                        </div>
                               
                            </span>
                            <div id="actor_training">
                                <div id="traininglist" style="max-height:300px;">
                                    <?php
                                        foreach ($actorTrainings as $key => $training) {
                                    ?>

                                    <span id="training-<?= $key ?>" class="info dark-gray">
                                        <div class="row">
                                            
                                            <span class="training_title col-sm-4 col-xs-4" id="actor_tr_title_<?= $key ?>">
                                                <span class="training-plus toggleEdit" id="actor_tr_plus_<?= $key ?>" data-hide-id="#actor_tr_plus_<?= $key ?>" data-unhide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>">+</span>
                                                <span  id="actor_tr_minus_<?= $key ?>" class="toggleEdit training-minus hidden" data-hide-id="#actor_tr_minus_<?= $key ?>,#actor_tr_detail_<?= $key ?>" data-unhide-id="#actor_tr_plus_<?= $key ?>" >-</span>
                                                <?= ucfirst($training['StashActorTraining_title']) ?>
                                            </span>

                                            <span class="info-small dark-gray col-sm-4 col-xs-8" id="actor_tr_course_<?= $key ?>">
                                                <?= ucfirst($training['StashActorTraining_course']) ?>
                                            </span>
                                            <span class="info-small dark-gray col-sm-4 col-xs-4" style="text-align:right;" >
                                                
                                            </span>

                                            

                                        </div>
                                        <div id="actor_tr_detail_<?= $key ?>" class="hidden toggleEdit training_details">
                                            <span class="info-small dark-gray" id="actor_tr_start_<?= $key ?>"><?= $training['StashActorTraining_start_time'] ?></span> - 
                                            <span class="info-small dark-gray" id="actor_tr_end_<?= $key ?>"><?= $training['StashActorTraining_end_time'] ?></span>
                                            <br>
                                            <span class="info-small dark-gray" id="actor_tr_blurb_<?= $key ?>">
                                            <?= ucfirst($training['StashActorTraining_blurb']) ?>
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
                        </div>
                    </div>
                </div>   
            </div>
   
        </div>
    </div>
                    
        <!--================================== Navigation Ends Here =======================================-!-->

<?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
?>