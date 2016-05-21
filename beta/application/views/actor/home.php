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

                            <img src="<?= IMG ?>/logo.png" class="brands"/><span class="vertical-middle brandname title">C A S T I K O</span><p><span id="tag-line" class="firstcolor info-small">Makes casting easier!</span>

                        </a>
                    </div> 

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                      <ul class="nav navbar-nav navbar-right vertical-middle">
                       
                        <li >
                            <a href="<?= base_url() ?>home/logout/"><button type="button" class="btn submit-btn firstcolor" id="btn-logout"  ><span class="glyphicon glyphicon-log-out"></span> &nbsp; Sign Out</button></a>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
			
			<div id="feetToCMConverterModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title firstcolor info"> Feet to CM converter </h4><span class="info-small gray"></span>
					</div>
					<div class="modal-body" style="background-color:#f2f2f2;">
					  <div class="container" style="max-width:100%; ">
						<form id="feetToCMConverter" action="#" method="post">
							<div class="row">
							  <div class="col-sm-6 form-group no-paddinglr">
								  <span class="info-small">Feet</span>
									<select class="form-control add" name="feet">
										<?php
											for($i = 0; $i < 11; $i++)
												echo "<option value='{$i}'>{$i}</option>";
										?>
									</select>

							  </div>
							  <div class="col-sm-6 form-group no-paddinglr">
								  <span class="info-small gray">Inches </span> 
								  <select class="form-control add" name="inches">
										<?php
											for($i = 1; $i < 13; $i++)
												echo "<option value='{$i}'>{$i}</option>";
										?>
									</select>
							  </div>
							</div>
							<div class="row">
							  <div class="col-sm-6 form-group no-paddinglr">
								<button type="submit" class="btn submit-btn firstcolor" style="margin-top: 20px; margin-left:10px;" id="btn-search" >
									<span class="glyphicon glyphicon-filter"></span> &nbsp; Convert</button>
							  </div>
							  <div class="col-sm-6 form-group no-paddinglr">
								
							  </div>
							</div>
							<div class="jumbotron" id="convertedBox" style="display: none;">
								<p class="gray"> <span id="converted">120</span> cm</p>
								<small> Enter this value of height in box. </small>
							</div>
						</form>
					  </div>
					</div>
				  </div>
				</div>
			</div>

           <!-- contact modal toggle -->
            <div class="container-fluid padded">
                <div class="alert alert-warning alert-dismissible" id="warningmsg" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> Your profile looks empty, we suggest you to complete your profile. It helps you get more auditions.
                </div>
				
				<?php
					if($user['StashUsers_status'] == 0){
				?>
					<div class="alert alert-warning alert-dismissible" id="warningmsg" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Warning!</strong> Your Email is not verified, Please check your mail for verification link.
					</div>
				<?php
					}
				?>

                <div class="container col-sm-12 center" id="browse-table">
                    <div class="col-sm-8 mycontent-left marginTop">
                        <input type="hidden" name="actor_ref" value="<?= $actor_ref ?>">
                      <div class="col-sm-6 mycontent-left ">
                        <div class=" container col-sm-7 center" id="actorprofile">
                            <div id="profile_photo_upload" class="hidden" onclick="upload_picture()">
                                <span class="info-small gray center " style="vertical-align:middle;" > Upload Picture </span>
                            </div>
                            <div class="img-div center " id="profile_image">
                                <img src="<?= IMG .'/'.$actorProfile['StashActor_avatar'] ?>">
                                <input type="hidden" id="image_count" value='<?= $actorProfile['StashActor_images'] ?>'>
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
                                Phone No. <small>(10 digit only)</small> : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#phone_edit" data-hide-id="#actor_phone" aria-hidden="true"></span>
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
                                Whatsapp No. <small>(10 digit only)</small> : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#whatsapp_edit" data-hide-id="#actor_whatsapp" aria-hidden="true"></span>
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
                                Date of Birth.: <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#dob_edit" data-hide-id="#actor_dob" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
                            <span id="actor_dob" class="info dark-gray"><?php
								if($actorProfile['StashActor_dob'] == 0){
									echo '';
									$actorProfile['StashActor_dob'] = strtotime("-18 years");
								}else{
									echo date("m/d/Y", $actorProfile['StashActor_dob']);
								}
							?></span>
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
                                Height. : 
								<span class="glyphicon glyphicon-refresh edit-button" title="Convert Feets to CM" data-toggle="modal" data-target="#feetToCMConverterModal"></span>
								<span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#height_edit" data-hide-id="#actor_height" aria-hidden="true"></span>
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
                            <hr class="taghr">
                        </div>
                        <div class="col-sm-10 center left marginTop">
                            <span class="actorlabel" >
                                Skills : <span class="glyphicon glyphicon-pencil edit-button pull-right toggleEdit" data-unhide-id="#skills_edit" data-hide-id="#actor_skills" aria-hidden="true"></span>
                                <hr align="left" width="15px" class="tenth">
                            </span>
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
                      <div class="col-sm-12">
                        <div class="col-sm-11 center">
                            <hr>
                            <span class="actorlabel pull-left" >
                                    Photos and Videos : <span class="glyphicon glyphicon-plus edit-button" data-toggle="modal" data-target="#photosupload" aria-hidden="true"></span>
                                    <hr align="left" width="15px" class="tenth">
                            </span>
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
                                            <?php
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
                                    <textarea class="editwhite long" name='trn_blurb' id="addtrainingdescription" placeholder="A little description about the course." style="height:80px;"></textarea>
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
                           <form action="<?= base_url() ?>upload/" class="dropzone" id="photo-upload" style="border: 1px dashed #b2b2b2;border-radius: 5px;background: white;margin-top:120px;"></form>
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
