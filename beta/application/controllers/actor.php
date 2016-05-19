<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Actor extends CI_Controller {

		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'actor')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelActor");
			$this->load->model("Auth");
			$pageInfo['actor'] = $this->Auth->getUserData('StashUsers_status', 1);
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($this->session->userdata("StaSh_User_id"));
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($this->session->userdata("StaSh_User_id"));
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($this->session->userdata("StaSh_User_id"));
			$this->load->view("actor/home", $pageInfo);
		}

		public function response($status = false, $msg = null, $data = []){
			header("Content-Type: application/json");
			echo json_encode(array(
							"status" => $status,
							"message" => $msg,
							"data" => $data
						));
			exit();
		}

		public function ajax($value=''){
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

					default:
						$this->response(false, "Invalid Request");
						break;
				}
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
				$this->response(false, "Failed");
			}
		}

		public function addTraining($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->insertTraining($data)){
				$this->response(true, "Training Added");
			}else{
				$this->response(false, "Failed");
			}
		}

		public function editExperience($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->updateExperience($data)){
				$this->response(true, "Experience Updated");
			}else{
				$this->response(false, "Failed");
			}
		}

		public function addExperience($data = []){
			$this->load->model("ModelActor");
			if($this->ModelActor->insertExperience($data)){
				$this->response(true, "Experience Added");
			}else{
				$this->response(false, "Failed");
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
					$this->response(true, "Skill Updated");
				}else{
					$this->response(false, "Udpate Failed");
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
					$this->response(true, "Language Updated");
				}else{
					$this->response(false, "Udpate Failed");
				}
			}else{
				$this->response(false, "Nothing to Updated");
			}
		}

		public function editWeight($data = []){
			$this->load->model("ModelActor");
			$data = array('StashActor_weight' => (int)trim($data['weight']));
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, "Weight Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editHeight($data = []){
			$this->load->model("ModelActor");
			$data = array('StashActor_height' => (int)trim($data['height']));
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, "Height Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editMinMaxAge($data = []){
			$this->load->model("ModelActor");
			$data = array(
					'StashActor_min_role_age' => (int)trim($data['min_age']), 
					'StashActor_max_role_age' => (int)trim($data['max_age'])
				);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, "Age Range Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editDOB($data = []){
			$this->load->model("ModelActor");
			$dob = strtotime(trim($data['dob']));
			$data = array('StashActor_dob' => $dob);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, "Date of Birth Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editWhatsApp($data = []){
			$this->load->model("ModelActor");
			$mobile = trim($data['whatsapp']);
			$data = array('StashActor_whatsapp' => $mobile);
			if($this->ModelActor->updateActorProfile($data)){
				$this->response(true, "Phone Number Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editActorMobile($data = []){
			$this->load->model("ModelActor");
			$mobile = trim($data['phone']);
			$data = array('StashActor_mobile' => $mobile);
			if($this->ModelActor->updateActorProfile($data)){
				$this->ModelActor->updateUserProfile(array("StashUsers_mobile" => $mobile));
				$this->response(true, "Phone Number Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

		public function editActorName($data = []){
			$this->load->model("ModelActor");
			$name = trim($data['name']);
			$sex = (strtolower($data['sex']) == 'm') ? 1 : 0;
			$update = array('StashActor_name' => $name, "StashActor_gender" => $sex);
			if($this->ModelActor->updateActorProfile($update)){
				$this->ModelActor->updateUserProfile(array("StashUsers_name" => $name));
				$this->response(true, "Name Updated");
			}else{
				$this->response(false, "Update Failed");
			}
		}

	}

?>