<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AJAX extends CI_Controller {

		public function index($value=''){
			$this->request();
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

		public function request($value=''){
			if(count($this->input->post())){
				$req = trim($this->input->post("request"));
				$data = json_decode($this->input->post("data"), true);

				switch ($req) {
					case 'UserLogin':
						$this->userLogin($data);
						break;

					case 'ForgotPassword':
						$this->forgotPassword($data);
						break;

					case "ChangePassword":
						$this->changePassword($data);
						break;

					case 'FetchActors':
						$this->fetchActors($data);
						break;

					case "RemoveActor":
						$this->removeActor($data);
						break;

					case "ContactActors":
						$this->contactActors($data);
						break;

					case "AdvanceSearch":
						$this->advanceSearch($data);
						break;

					case "EMailInvitation":
						$this->eMailInvitation($data);
						break;

					case "SMSInvitation":
						$this->SMSInvitation($data);
						break;
					
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, "Sorry! No form data received.");
			}

		}

		public function SMSInvitation($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("SMS");
			$project = $this->ModelDirector->getProject($data['project_name'], $data['project_date']);
			if(count($project)){
				$projectID = $project['StashProject_id'];
			}else{
				$projectID = $this->ModelDirector->insertNewPorject($data['project_name'], $data['project_date']);
			}
			$data['project_id'] = $projectID;
			if($this->SMS->sendInvitaionSMS($data['msg'], $data['emails'], $projectID)){
				$this->ModelDirector->insertInvitationSMS($data);
				$this->response(true, "Invitation Email sent");
			}else{
				$this->response(false, "Email Sending Failed");
			}
		}

		public function eMailInvitation($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("Email");
			$project = $this->ModelDirector->getProject($data['project_name'], $data['project_date']);
			if(count($project)){
				$projectID = $project['StashProject_id'];
			}else{
				$projectID = $this->ModelDirector->insertNewPorject($data['project_name'], $data['project_date']);
			}
			$data['project_id'] = $projectID;
			if($this->Email->sendInvitaionMail($data['msg'], $data['emails'], $projectID)){
				$this->ModelDirector->insertInvitationMail($data);
				$this->response(true, "Invitation Email sent");
			}else{
				$this->response(false, "Email Sending Failed");
			}
		}

		public function advanceSearch($data = []){
			$this->load->model("ModelDirector");
			// Santizing data
			$minAge = $maxAge = $minHeight = $maxHeight = $sex = $skills = '';
			if($data['agemin'] != ''){
				$minAge = strtotime("-{$data['agemin']} years");
			}

			if($data['agemax'] != ''){
				$maxAge = strtotime("-{$data['agemax']} years");
			}

			if($data['heightmin'] != ''){
				$minHeight = $data['heightmin'];
			}

			if($data['heightmax'] != ''){
				$maxHeight = $data['heightmax'];
			}

			if($data['sex'] != ''){
				$sex = (strtolower($data['sex']) == 'm') ? 1 : 0;
			}

			if($data['skills'] != ''){
				$skills = trim($data['skills']);
			}
			$actorsInDirectorList = $this->ModelDirector->getActorsIdWithDirectors($this->session->userdata("StaSh_User_id"));
			$skillIDs = $this->ModelDirector->getSkillIDs($skills);
			$filteredBySKills = $this->ModelDirector->filteredBySKill($actorsInDirectorList, $skillIDs);
			$searchData = array(
							'minHeight' => $minHeight,
							'minAge' => $minAge,
							'maxHeight' => $maxHeight,
							'maxAge' => $maxAge,
							'sex' => $sex,
							'skills' => $filteredBySKills
						);
			$finalFilteredActors = $this->ModelDirector->finalFilter($searchData);
			//print_r($finalFilteredActors);
			if(count($finalFilteredActors))
				$this->response(true, count($finalFilteredActors) . " actors found !", $finalFilteredActors);
			else
				$this->response(false, "0 actors found !");
		}

		public function contactActors($data = []){
			$this->load->model("ModelDirector");
			if($data['tag'] == 'both'){
				$this->load->model("Email");
				$this->load->model("SMS");

				$this->Email->sendAuditionMail($data['contact']['email'], $data['subject'], $data['mail']);
				$this->SMS->sendAuditionSMS($data['contact']['mobile'], $data['sms']);

				$this->ModelDirector->insertSendMail($data['contact']['ref'], $data['mail'], $data['subject']);
				$this->ModelDirector->insertSendSMS($data['contact']['ref'], $data['sms']);
			}elseif($data['tag'] == 'email'){
				$this->load->model("Email");
				$this->Email->sendAuditionMail($data['contact']['email'], $data['subject'], $data['mail']);
			}else{
				$this->load->model("SMS");
				$this->SMS->sendAuditionSMS($data['contact']['mobile'], $data['sms']);
			}

			$this->response(true, "Message sent to all selected actors.");
		}

		public function removeActor($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->deleteActorFromDirector($data['actor_ref'])){
				$this->response(true, "Actor removed successfully");
			}else{
				$this->response(false, "Actor is already removed");
			}
		}

		public function fetchActors($data = []){
			$this->load->model("ModelDirector");
			$actorsInDirectorList = $this->ModelDirector->getActorsInDirectorList($this->session->userdata("StaSh_User_id"));
			if(count($actorsInDirectorList)){
				$this->response(true, "Actor Found", $actorsInDirectorList);
			}else{
				$this->response(false, "You don't have any actor added in you List. Please Add actors.");
			}
		}

		public function changePassword($data = []){
			$this->load->model("Auth");
			$userData = $this->Auth->getUserData('StashUsers_email', $data['email']);
			$passCodeData = $this->Auth->getPassCodeData($userData['StashUsers_id'], (int)$data['code']);
			$timeExp = $passCodeData['StashForgotPassword_req_time'] + 86400;
			if(count($passCodeData)){
				if(!$passCodeData['StashForgotPassword_status']){
					if($timeExp > time()){
						if($this->Auth->updatePassword($userData['StashUsers_id'], $data['password'])){
							$this->Auth->updatePassCodeUses($passCodeData['StashForgotPassword_id']);
							$this->response(true, "Password Changed Successfully");
						}else{
							$this->response(false, "Failed to change password.");
						}
					}else{
						$this->response(false, "Pass Code Expired. Try to get new one.");
					}
				}else{
					$this->response(false, "This Pass Code is already used.");
				}
			}else{
				$this->response(false, "Invalid/Old Pass Code...");
			}
		}

		public function forgotPassword($data = []){
			$this->load->model("Auth");
			$this->load->model("Email");
			if($this->Auth->ifUserExist($data['email'])){
				
				$passCode = mt_rand(100000, 999999);
				$userData = $this->Auth->getUserData('StashUsers_email', $data['email']);
				$this->Auth->insertPassCode($userData['StashUsers_id'], $passCode);
				if($this->Email->sendPassCode($data['email'], $passCode)){
					$this->response(true, 'Check Your Email for Pass Code...');
				}else{
					$this->response(false, 'Failed to send Passcode. Try Again...');
				}

			}else{
				$this->response(false, "This Email/Username doesn't Exist. Please Register first.");
			}
		}

		public function userLogin($data = []){
			$this->load->model("Auth");
			if($this->Auth->ifUserExist($data['email'])){
				$profile = $this->Auth->verifyLoginCredentials($data);
				if(count($profile)){
					$this->Auth->startLoginSession($profile);
					$this->Auth->updateUserLogin($profile['StashUsers_id']);
					$this->response(true, "Login Success. Welcome {$data['email']}");
				}else{
					$this->response(false, "Email/Password doesn't matched.");
				}
			}else{
				$this->response(false, "This Email/Username doesn't Exist. Please Register first.");
			}
		}

	}
?>