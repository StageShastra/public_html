<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Actor extends CI_Controller {
		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'actor')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelActor");
			$this->load->model("Auth");
			$pageInfo['actor'] = $this->Auth->getUserData('StashUsers_id', $this->session->userdata("StaSh_User_id"));
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($this->session->userdata("StaSh_User_id"));
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($this->session->userdata("StaSh_User_id"));
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($this->session->userdata("StaSh_User_id"));
			$pageInfo['directors'] = $this->ModelActor->getDirectors($this->session->userdata("StaSh_User_id"));
			$this->load->view("actor/home", $pageInfo);
		}
		
		public function profile($username = ''){
			$username = explode("/", rtrim($_SERVER['REQUEST_URI'], "/"));
			$username = trim($username[count($username) - 1]);
			$pageInfo = [];
			$this->load->model("ModelActor");
			$this->load->model("Auth");
			$userdata = $this->Auth->getUserData('StashUsers_username', $username);
			
			if(count($userdata) == 0){
				$this->displayPageNotFound();
			}
			
			
			
			$ref = $userdata['StashUsers_id'];
			$pageInfo['actor'] = $userdata;
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($ref);
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($ref);
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($ref);
			$pageInfo['directors'] = $this->ModelActor->getDirectors($ref);
			
			$this->load->view("actor/actor_profile", $pageInfo);
		}
		
		protected function displayPageNotFound() {
			$this->output->set_status_header('404');
			show_404();
		}

		public function mobileverify($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'actor')
				redirect(base_url());
			$pageInfo = array('error' => false, "error_msg" => null, 'form' => true);
			$this->load->model("Auth");
			$userdata = $this->Auth->getUserData('StashUsers_id', $this->session->userdata("StaSh_User_id"));
			if($userdata['StashUsers_mobile_status']){
				$pageInfo = array("error" => true, "error_msg" => Ac_MobVer_AlreadyVerified, "form" => false);
			}else{
				$this->load->model("SMS");
				$otp = mt_rand(100000, 999999);
				$res = $this->SMS->sendOTP($otp, $userdata['StashUsers_mobile']);
				$res = json_decode($res, true);
				if($res['status'] == "success"){
					$this->Auth->addOTP($otp, $this->session->userdata("StaSh_User_id"));
					$m = substr($userdata['StashUsers_mobile'], 0, 2) . "*****" . substr($userdata['StashUsers_mobile'], 7, 3);
					$pageInfo = array("error" => true, "error_msg" => Ac_MobVer_EnterCode ." {$m}", 'form' => true);

					$pageInfo = array("error" => true, "error_msg" => "Enter the Code you got on your number {$m}", 'form' => true);

				}else{
					$pageInfo = array("error" => true, "error_msg" => Ac_MobVer_SendFailed, 'form' => true);
				}

			}

			$this->load->view("mobileVerification", $pageInfo);
		}

		public function skillSuggestions($value=''){
			$t = trim($_REQUEST['term']);
			$this->load->model("ModelActor");
			if($value == 'language'){
				$data = $this->ModelActor->getLanguageName($t);
			}else{
				$data = $this->ModelActor->getSkillName($t);
			}
			header("Content-Type: application/json");
			echo json_encode($data);
			exit();
		}
		
		public function response($status = false, $msg = null, $data = []){
			header("Content-Type: application/json");
			echo json_encode(array(
							'status' => $status,
							'message' => $msg,
							'data' => $data
						));
			exit();
		}
		public function ajax($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'actor')
				$this->response(false, Ac_Ajx_AuthFail);


			if(count($this->input->post())){
				$req = trim($this->input->post("request"));
				$data = json_decode($this->input->post("data"), true);
				switch ($req) {
					case 'EditName':
						$this->editActorName($data);
						break;
					case "EditMobile":
						$this->editActorMobile($data);
						break;
					case "EditWhatsApp":
						$this->editWhatsApp($data);
						break;
					case "EditDOB":
						$this->editDOB($data);
						break;
					case 'EditMinMaxAge':
						$this->editMinMaxAge($data);
						break;
					
					case "EditHeight":
						$this->editHeight($data);
						break;
					case "EditWeight":
						$this->editWeight($data);
						break;
					case "EditLanguage":
						$this->editLanguage($data);
						break;
					case "EditSkills":
						$this->editSkill($data);
						break;
					case "AddExperience":
						$this->addExperience($data);
						break;
					case "EditExperience":
						$this->editExperience($data);
						break;
					case "AddTraining":
						$this->addTraining($data);
						break;
					case "EditTraining":
						$this->editTraining($data);
						break;
					case "RemoveImage":
						$this->removeImage($data);
						break;
					case "EditBasics":
						$this->editBasicDetails($data);
						break;
					case "EditContacts":
						$this->editContactsDetails($data);
						break;
					case "RemoveExperience":
						$this->removeExperience($data);
						break;
					case "RemoveTraining":
						$this->removeTraining($data);
						break;
					case "UpdateProfileImage":
						$this->updateProfileImage($data);
						break;
					case "ResendConfirmationLink":
						$this->resendConfirmationLink($data);
						break;
					case "EditUsername":
						$this->editUsername($data);
						break;

					case "VerifyOTP":
						$this->verifyOTP($data);
						break;

					case "RemoveProfilePic":
						$this->removeProfilePic($data);
						break;

					case "ImageToEncode":
						$this->imageToEncode($data);
						break;

					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}
		}

		public function imageToEncode($data = []){
			$img = $data['img'];
			$ext = pathinfo($img, PATHINFO_EXTENSION);
			$data = file_get_contents($img);
			$dataUrl = 'data:image/' . $ext . ';base64,' . base64_encode($data);
			$this->response(true, "Image Converted", ['dataURL' => $dataUrl]);
		}

		public function removeProfilePic($data = []){
			$this->load->model("ModelActor");
			$d = array("StashActor_avatar" => "default.png");
			if($this->ModelActor->updateActorProfile($d)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}

		public function verifyOTP($data = []){
			$this->load->model("Auth");
			$userdata = $this->Auth->getUserData('StashUsers_id', $this->session->userdata("StaSh_User_id"));
			if(!$userdata["StashUsers_mobile_status"]){
				$otpData = $this->Auth->validateOTP($data['otp'], $this->session->userdata("StaSh_User_id"));
				if(count($otpData)){
					if($otpData['StashMobileOTP_status'] == 0){
						$this->Auth->updateMobileVerificationStatus($this->session->userdata("StaSh_User_id"));
						$this->Auth->updateOTPStatus($this->session->userdata("StaSh_User_id"), $data['otp']);
						$this->response(true, Ac_VerOTP_Success);
					}else{
						$this->response(true, Ac_VerOTP_OldOTP);
					}
				}else{
					$this->response(false, Ac_VerOTP_Invalid);
				}
			}else{
				$this->response(false, Ac_MobVer_AlreadyVerified);
			}
		}
		
		public function editUsername($data = []){
			$this->load->model("ModelActor");
			$username = trim($data['username']);
			if(preg_match("/[a-zA-Z0-9-_\.]$/i", $username)){
				$users = $this->ModelActor->isUsernameExist($username);
				if($users == 0){
					if($this->ModelActor->updateUsername($username, $this->session->userdata("StaSh_User_id"))){
						$this->response(true, "Username Updated");
					}else{
						$this->response(false, Ac_Ajx_GenFailed);
					}
				}elseif($users == 1){
					$this->load->model("Auth");
					$userdata = $this->Auth->getUserData('StashUsers_username', $username);
					if($userdata["StashUsers_id"] == $this->session->userdata("StaSh_User_id")){
						$this->response(false, Ac_eUsrName_Nochange);
					}else{
						$this->response(false, Ac_eUsrName_Taken);
					}
				}else{
					$this->response(false, Ac_eUsrName_Taken);
				}
			}else{
				$this->response(false, Ac_eUsrName_Invalid);
			}
		}
		
		public function resendConfirmationLink($data = []){
			$this->load->model("Email");
			$this->load->model("Auth");
			$user = $this->Auth->getUserData("StashUsers_id", $this->session->userdata("StaSh_User_id"));
			$email = $user['StashUsers_email'];
			$name = $user['StashUsers_name'];
			$id = $this->session->userdata("StaSh_User_id");
			if($this->Email->sendActivationMail($name, $email, $id)){
				$this->response(true, Ac_ReConf_Sent);
			}else{
				$this->response(false, Ac_ReConf_Fail);
			}
		}
		
		public function updateProfileImage($data = []){
			$this->load->model("ModelActor");
			$folder = __DIR__ . "/../../assets/img/actors/";
			
			$img = $data['imageName'];
			$imagefile = explode("/", $img);
			$imagefile = trim($imagefile[count($imagefile) - 1]);
			$imagefile = __DIR__ . "/../../assets/img/actors/" . $imagefile;
			//echo $imagefile;
			if(file_exists( $imagefile )){

				$imageSize = getimagesize($imagefile);
				//print_r($imageSize);
				$x = $data['imageX'];
				$y = $data['imageY'];

				if($x < 0 || $y < 0){
					$this->response(false, "Image is not cropped properly.");
				}

				$width = $data['imageWidth'] / 0.3;
				$height = $data['imageHeight'] / 0.3;

				$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
				$imageData = file_get_contents($imagefile);
				$virtualImage = imagecreatefromstring($imageData);
				$distImage = imagecreatetruecolor(200, 200);
				imagecopyresampled($distImage, $virtualImage, 0, 0, $x, $y, $imageSize[0], $imageSize[1], $width, $height);
				//print_r($data);
				$image = md5(microtime() . $this->session->userdata("StaSh_User_id") . microtime()) . '.' . $ext;
				$imageName = $folder . $image;

				if($ext == "jpg" || $ext == "jpeg"){
					if(imagejpeg($distImage, $imageName)){
						imagedestroy($distImage);
						//$this->response(true, Ac_Ajx_GenSucc);
					}else{
						$this->response(false, "Failed to crop Image.");
					}
				}elseif($ext == "png"){
					if(imagepng($distImage, $imageName)){
						imagedestroy($distImage);
						//$this->response(true, Ac_Ajx_GenSucc);
					}else{
						$this->response(false, "Failed to crop Image.");
					}
				}else{
					$this->response(false, "Unsupported Image Format!");
				}

			}else{
				$this->response(false, "Image does found!");
			}

			$d = array("StashActor_avatar" => $image);
			if($this->ModelActor->updateActorProfile($d)){
				$this->response(true, Ac_Ajx_GenSucc, ['image' => $image]);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function removeTraining($data = []){
			//print_r($data);
			$this->load->model("ModelActor");
			if($this->ModelActor->deleteTraining($data['training_ref'])){
				$this->response(true, "Training Removed");
			}else{
				$this->response(false, Ac_Ajx_ActFailed);
			}
		}
		public function removeExperience($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->deleteExperience($data['experience_ref'])){
				$this->response(true, "Experience Removed");
			}else{
				$this->response(false, Ac_Ajx_ActFailed);
			}
		}
		public function editContactsDetails($data = []){
			$this->load->model("ModelActor");
			$this->load->model("Auth");
			$ref = $this->session->userdata("StaSh_User_id");
			$userdata = $this->Auth->getUserData('StashUsers_id', $ref);
			if(strlen($data['phone']) != 10)
				$this->response(false, "Mobile is invalid.");

			if(strlen($data['whatsapp']) != 10)
				$this->response(false, "Whatsapp number is invalid.");


			$dob = strtotime(trim($data['dob']));
			$d = array(
						"StashActor_dob" => $dob,
						"StashActor_mobile" => $data['phone'],
						"StashActor_whatsapp" => $data['whatsapp']
					);

			if($userdata['StashUsers_mobile'] != $data['phone']){
				$this->Auth->updateUserMobile($ref, $data['phone']);
				$msg = Ac_Ajx_GenSucc . Ac_eContDet_Mobchanged;
			}else{
				$msg = Ac_Ajx_GenSucc;
			}

			if($this->ModelActor->updateActorProfile($d)){
				$this->response(true, $msg);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editBasicDetails($data = []){
			$this->load->model("ModelActor");
			$data['gender'] = (strtolower($data['sex']) == 'm') ? 1 : 0;
			$d = array(
						"StashActor_gender" => $data['gender'],
						"StashActor_height" => $data['height'],
						"StashActor_weight" => $data['weight'],
						"StashActor_min_role_age" => $data['min_age'],
						"StashActor_max_role_age" => $data['max_age']
					);
			if($this->ModelActor->updateActorProfile($d)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function removeImage($data = []){
			$this->load->model("ModelActor");
			$images = $this->ModelActor->getActorImages($this->session->userdata("StaSh_User_id"));
			$images = json_decode($images, true);
			$filter = array();
			if(in_array($data['image'], $images)){
				foreach ($images as $key => $img) {
					if($data['image'] != $img)
						$filter[] = $img;
				}
				$images = $filter;
				if($this->ModelActor->updateActorImages($images)){
					$this->response(true, "Images Removed");
				}else{
					$this->response(false, "Failed to remove Image");
				}
			}else{
				$this->response(false, "Invalid Images Selected");
			}
		}
		public function editTraining($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->updateTraining($data)){
				$this->response(true, "Training Updated");
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		
		public function parseTraining(){
			$this->load->model("ModelActor");
			$trainings = $this->ModelActor->getActorTrainingById($this->session->userdata("StaSh_User_id"));
			$html = "";
			foreach($trainings as $key => $training){
				$html .= '<span id="training-'.$key.'" class="info dark-gray">
							<div class="row">
								
								<span class="training_title col-sm-4" id="actor_tr_title_'.$key.'">
									<span class="training-plus toggleEdit" id="actor_tr_plus_'.$key.'" data-hide-id="#actor_tr_plus_'.$key.'" data-unhide-id="#actor_tr_minus_'.$key.',#actor_tr_detail_'.$key.'">+</span>
									<span  id="actor_tr_minus_'.$key.'" class="toggleEdit training-minus hidden" data-hide-id="#actor_tr_minus_'.$key.', #actor_tr_detail_'.$key.'"  data-unhide-id="#actor_tr_plus_'.$key.'" >-</span>
									'.$training['StashActorTraining_title'].'
								</span>
								<span class="info-small dark-gray col-sm-4" id="actor_tr_course_'.$key.'">
									'.$training['StashActorTraining_course'].'
								</span>
								<span class="glyphicon glyphicon-pencil edit-button firstcolor toggleEdit" data-hide-id="" data-unhide-id="#training-'.$key.'_edit" data-hide-id="#training-'.$key.'" aria-hidden="true"></span>
								<span class="glyphicon glyphicon-remove edit-button  firstcolor removeSpanBtn" data-key="'.$key.'" data-id="'.$training['StashActorTraining_id'].'" data-type="training"></span>

								

							</div>
							<div id="actor_tr_detail_'.$key.'" class="hidden toggleEdit training_details">
								<span class="info-small dark-gray" id="actor_tr_start_'.$key.'">'.$training['StashActorTraining_start_time'].'</span> - 
								<span class="info-small dark-gray" id="actor_tr_end_'.$key.'">'.$training['StashActorTraining_end_time'].'</span>
								<br>
								<span class="info-small dark-gray" id="actor_tr_blurb_'.$key.'">
									'.$training['StashActorTraining_blurb'].'
								</span>
							</div>
							<hr>
						</span>

						<span id="training-'.$key.'_edit" class="hidden">
							<input type="text" class="editwhite long" id="editschooli" name="tr_title_'.$key.'" value="'.$training['StashActorTraining_title'].'" Placeholder="School / Teacher" />
							<input type="text" class="editwhite long" name="tr_course_'.$key.'" id="editcoursei" value="'.$training['StashActorTraining_course'].'" Placeholder="Course" />
							<div class="row" style="margin-left:0px;">
								<input type="text" class="editwhite short" id="editstarti" name="tr_start_'.$key.'" value="'.$training['StashActorTraining_start_time'].'" Placeholder="Starting Year"/>
								<input type="text" class="editwhite short" id="editendi" name="tr_end_'.$key.'" value="'.$training['StashActorTraining_end_time'].'" Placeholder="Ending Year"/>
							</div>
							<textarea class="editwhite long" name="tr_blurb_'.$key.'" id="edittrainingdescriptioni" style="height:100px;">'.$training['StashActorTraining_blurb'].'</textarea>
							<br>
							<font class="sortbuttons">
								<button class="btn submit-btn firstcolor center btnExpAndTraining"
										data-input-names="tr_title_'.$key.', tr_course_'.$key.', tr_start_'.$key.', tr_end_'.$key.', tr_blurb_'.$key.'"
										data-key="'.$key.'"
										data-table-id="'.$training['StashActorTraining_id'].'"
										data-request="EditTraining"
										data-hide-id="#training-'.$key.'_edit" 
										data-unhide-id="#training-'.$key.'">
									<span class="glyphicon glyphicon-ok"></span>
								</button>
							</font>
							<hr>
						</span>';
			}
			
			$html = str_replace('"', "'", $html);
			$html = str_replace("\n", "", $html);
			$html = str_replace("\t", "", $html);
			return array('html' => trim($html));
		}
		
		public function addTraining($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->insertTraining($data)){
				$this->response(true, "Training Added", $this->parseTraining());
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editExperience($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->updateExperience($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		
		public function parseExperience(){
			$this->load->model("ModelActor");
			$experiences = $this->ModelActor->getActorExperienceById($this->session->userdata("StaSh_User_id"));
			
			$index = 0;
			$totalExp = count($experiences);
			$next = $prev = $onlyone = 0;
			$html = '';
			foreach($experiences as $key => $exp){
				$index++;
				if($index != 1 && $index == $totalExp){
					$prev = $next - 1;
					$next = 0;
				}elseif($index == 1 && $index == $totalExp){
					$onlyone = 1;
				}elseif($totalExp > 1 && $index == 1){
					$next++;
					$prev = $totalExp - 1;
				}else{
					$prev = $next - 1;
					$next++;
				}
				
				$utube = false;
				$utube_link = '';
				if(strpos($exp['StashActorExperience_link'], 'yout') !== false){
					$utube = true;
					$utube_link = explode("/", $exp['StashActorExperience_link']);
					$utube_link = $utube_link[count($utube_link)-1];
					if(strpos($utube_link, "?v=") !== false)
						$utube_link = trim(str_replace("watch?v=", "", $utube_link));
					$utube_link = "https://www.youtube.com/embed/" . $utube_link;
				}
				
				if($index == $totalExp)
					$html .= '<span id="experience-'.$key.'" class="info dark-gray actExp">';
				else
					$html .= '<span id="experience-'.$key.'" class="info dark-gray hidden actExp">';
				
				if($utube){
					$html .= '<div class="col-sm-7" style="padding-left:0px;"><iframe style="width:100%;" height="189px" src="'.$utube_link.'" frameborder="0" allowfullscreen></iframe></div>';
					$html .= '<div class="col-sm-5" style="padding-left:0px; max-height:220px; height:220px;">
								<span class="info black" id="actor_ex_title_'.$key.'"><b>'.$exp['StashActorExperience_title'].'</b></span>
								<span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-'.$key.'" aria-hidden="true"></span>
								<span class="glyphicon glyphicon-remove edit-button  firstcolor removeSpanBtn" data-key="'.$key.'" data-id="'.$exp['StashActorExperience_id'].'" data-type="experience"></span>
								<br>
								<span class="info black" id="actor_ex_role_'.$key.'">
									<i>as </i>'.$exp['StashActorExperience_role'].'
								</span>
								<br>
									<div style="height:100%;overflow:hidden;">
									<div class="info-small dark-gray hidden_scroll" id="actor_ex_blurb_'.$key.'" style=" height:140px;">
									'.$exp['StashActorExperience_blurb'].'
									</div>
									</div>
							  </div>';
				}else{
					$html .= '<span class="info black" style="margin-left:15px;" id="actor_ex_title_'.$key.'"><b>'.$exp['StashActorExperience_title'].'</b></span>
							<span class="glyphicon glyphicon-pencil edit-button  firstcolor toggleEdit" style="margin-left:15px;"  data-unhide-id="#experience-'.$key.'_edit" data-hide-id="#experience-'.$key.'" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-remove edit-button  firstcolor removeSpanBtn" data-key="'.$key.'" data-id="'.$exp['StashActorExperience_id'].'" data-type="experience"></span>
							<br>
							<span class="info black" id="actor_ex_role_'.$key.'" style="margin-left:15px;" >
								<i>as </i>'.$exp['StashActorExperience_role'].'
							</span>
						<br>
							<span class="info-small dark-gray" id="actor_ex_blurb_'.$key.'" style="margin-left:15px;" >
								'.$exp['StashActorExperience_blurb'].'
							</span>';
				}
				
				if($onlyone != 1){
					$html .= '<div class="nav_icons">
							<span class="leftnav center toggleEdit glyphicon glyphicon-chevron-left gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$prev.'>
							</span>
							<span class="righttnav toggleEdit center glyphicon glyphicon-chevron-right gray" data-hide-id="#experience-'.$key.'" data-unhide-id=#experience-'.$next.' >
							</span></div>';
				}
				
				$html .= '</span><span id="experience-'.$key.'_edit" class="hidden">
							<input type="text" name="ex_title_'.$key.'" class="editwhite long" id="edittitlei" value="'.$exp['StashActorExperience_title'].'" Placeholder="Title of the play, ad, film etc." required/>
							<input type="text" name="ex_role_'.$key.'" class="editwhite long" id="editrolei" value="'.$exp['StashActorExperience_role'].'" Placeholder="Role e.g. Dad, Mom, Character Name" required/>
							<input type="text" name="ex_link_'.$key.'" class="editwhite long" id="editlinki" value="'.$exp['StashActorExperience_link'].'" Placeholder="Youtube"/>
							<textarea class="editwhite long" name="ex_blurb_'.$key.'" id="editdescriptioni" style="height:80px;overflow:auto;">'.$exp['StashActorExperience_blurb'].'</textarea>
							<br>
							<font class="sortbuttons">
								<button type="button" class="btn submit-btn firstcolor center btnExpAndTraining"
										data-input-names="ex_title_'.$key.', ex_role_'.$key.',ex_link_'.$key.',ex_blurb_'.$key.'"
										data-key="'.$key.'"
										data-table-id="'.$exp['StashActorExperience_id'].'"
										data-request="EditExperience"
										data-hide-id="#experience-'.$key.'_edit" 
										data-unhide-id="#experience-'.$key.'">
									<span class="glyphicon glyphicon-ok"></span>
								</button>
							</font>
							<hr>
						</span>';
			}
			$html = str_replace('"', "'", $html);
			$html = str_replace("\n", "", $html);
			$html = str_replace("\t", "", $html);
			return array('html' => trim($html));
		}
		
		public function addExperience($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->insertExperience($data)){
				$this->response(true, "Experience Added", $this->parseExperience());
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		
		public function editSkill($data = []){
			$this->load->model("ModelActor");
			$langs = $this->ModelActor->getSkillId($data['skills']);
			$this->ModelActor->deleteOldSkill($langs);
			$actorLang = $this->ModelActor->getActorSkillIds();
			$newLang = array_diff($langs, $actorLang);
			if(count($newLang)){
				if($this->ModelActor->updateActorSkill($newLang)){
					$this->response(true, Ac_Ajx_GenSucc);
				}else{
					$this->response(false, Ac_Ajx_GenFailed);
				}
			}else{
				$this->response(false, "Nothing to Updated");
			}
		}
		public function editLanguage($data = []){
			$this->load->model("ModelActor");
			$langs = $this->ModelActor->getLanguageId($data['language']);
			$this->ModelActor->deleteOldLanguage($langs);
			$actorLang = $this->ModelActor->getActorLanguageIds();
			$newLang = array_diff($langs, $actorLang);
			if(count($newLang)){
				if($this->ModelActor->updateActorLanguage($newLang)){
					$this->response(true, Ac_Ajx_GenSucc);
				}else{
					$this->response(false, Ac_Ajx_GenFailed);
				}
			}else{
				$this->response(false, "Nothing to Updated");
			}
		}
		public function editWeight($data = []){
			$this->load->model("ModelActor");
			$data = array('StashActor_weight' => (int)trim($data['weight']));
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editHeight($data = []){
			$this->load->model("ModelActor");
			$data = array('StashActor_height' => (int)trim($data['height']));
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editMinMaxAge($data = []){
			$this->load->model("ModelActor");
			$data = array(
					'StashActor_min_role_age' => (int)trim($data['min_age']), 
					'StashActor_max_role_age' => (int)trim($data['max_age'])
				);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editDOB($data = []){
			$this->load->model("ModelActor");
			$dob = strtotime(trim($data['dob']));
			$data = array('StashActor_dob' => $dob);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editWhatsApp($data = []){
			$this->load->model("ModelActor");
			$mobile = trim($data['whatsapp']);
			$data = array('StashActor_whatsapp' => $mobile);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editActorMobile($data = []){
			$this->load->model("ModelActor");
			$mobile = trim($data['phone']);
			$data = array('StashActor_mobile' => $mobile);
			if($this->ModelActor->updateActorProfile($data)){
				$this->ModelActor->updateUserProfile(array("StashUsers_mobile" => $mobile));
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
		public function editActorName($data = []){
			$this->load->model("ModelActor");
			$name = trim($data['name']);
			$sex = (strtolower($data['sex']) == 'm') ? 1 : 0;
			$update = array('StashActor_name' => $name, "StashActor_gender" => $sex);
			if($this->ModelActor->updateActorProfile($update)){
				$this->ModelActor->updateUserProfile(array("StashUsers_name" => $name));
				$this->response(true, Ac_Ajx_GenSucc);
			}else{
				$this->response(false, Ac_Ajx_GenFailed);
			}
		}
	}
?>