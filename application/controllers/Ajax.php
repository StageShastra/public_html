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
					case "ContactActorByEmail":
						$this->contactActorByEmail($data);
						break;
					case "ContactActorBySMS":
						$this->contactActorBySMS($data);
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
					case "testAttachment":
						$this->testAttachment($data);
						break;
					
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, Aj_Req_NoData);
			}
		}
		
		public function testAttachment($data){
			print_r($data);
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
			// Generating Link.

			$filterNumbers = $this->filterMobile( $data['mobiles'] );
			$mobiles = $filterNumbers['numbers'];
			$invalid = $filterNumbers['invalid'];
			$mobileIndirectorDB = $this->ModelDirector->getMobileFromDirectorDB();
			$mobileNotInDB = array_diff($mobiles, $mobileIndirectorDB);
			$duplicate = array_intersect($mobiles, $mobileIndirectorDB);

			$msgId = $this->ModelDirector->insertSMSMsg($data['msg'], 'sms');

			foreach ($mobileNotInDB as $key => $notInDB) {

				$rand = substr(base64_encode(md5(microtime() . $notInDB . microtime())), 0, 6);
				while($this->ModelDirector->checkRandLink($rand))
					$rand = substr(base64_encode(md5(microtime() . $notInDB . microtime())), 0, 6);
				
				$link = "http://castiko.com/invite/{$rand}";
				$this->SMS->sendInvitaionSMS( $data['msg'], $notInDB, $link );
				$this->ModelDirector->insertInvitationSMS($msgId, $rand, $projectID, $notInDB);

			}

			$r = array( 'sent' => count($mobileNotInDB), 'invalid' => count($invalid), 'invalidNums' => $invalid, 'duplicate' => count($duplicate), "duplicateNums" => $duplicate );
			$this->ModelDirector->updateCountAudSMS(count($mobileNotInDB), "invite", "sms");
			
			$this->response(true, "Invitation SMS Sent", $r);
		}

		public function filterMobile($mobiles = ''){
			$mobiles = explode(",", $mobiles);
			$numbers = []; $invalid = [];
			foreach ($mobiles as $key => $mobile) {
				$mobile = trim($mobile);
				if( strlen($mobile) >= 10 && is_numeric($mobile)){
					$numbers[] = $mobile;
				}else{
					if( strpos($mobile, "/") ){
						$mobile = explode("/", $mobile);
						foreach ($mobile as $k => $m) {
							$m = trim($m);
							if( strlen($m) >= 10 && is_numeric($m) )
								$numbers[] = $m;
							else
								$invalid[] = $m;
						}
					}else{
						$invalid[] = $mobile;
					}
				}
			}

			return ['numbers' => $numbers, 'invalid' => $invalid];
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
			$data['msg'] = str_replace("\n", "<br>", $data['msg']);
			$data['project_id'] = $projectID;

			$msgId = $this->ModelDirector->insertSMSMsg($data['msg'], 'email');

			$filterEmails = $this->filterEmail( $data['emails'] );
			$emails = $filterEmails[0];
			$invalid = $filterEmails[1];
			$emailInDB = $this->ModelDirector->checkRegsiteredEmails($emails); // Emails Registered with Castiko
			$emailInDirectorDB = $this->ModelDirector->getEmailFromDirectorDB(); // Email already added in CD Db
			$emailInMainDB = array_diff($emailInDB, $emailInDirectorDB); // Email to be send  Connect mail as they are in Castiko Db but not in CD Db.
			$emailFresh = array_diff($emails, $emailInDB); // Very Fresh Emails, not registered to Castiko
			$emailInCDdb = array_intersect($emails, $emailInDirectorDB); // Duplicate Email, Already in CD db.

			// Sending Invitation to fresh emails.
			$failedEmailFresh = $failedEmailConnect = [];
			$sent = $fail = 0;

			foreach ($emailFresh as $key => $fe) {
				$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);
				while($this->ModelDirector->checkEmailRandLink($rand))
					$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);

				$failed = $this->Email->sendInvitationToNotInDB( $data['msg'], $fe, $projectID, $rand );
				if( $failed !== true ){
					// Sending Mail Failed. do something here.
					$failedEmailFresh[] = $failed;
					$fail++;
				}else{
					$sent++;
					$this->ModelDirector->insertInvitationMail( $fe, $msgId, $projectID, 'invite', $rand );
				}
			}

			// Sending Connect Mail to already registered Email.
			foreach ($emailInMainDB as $key => $fe) {
				$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);
				while($this->ModelDirector->checkEmailRandLink($rand))
					$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);

				$failed = $this->Email->sendInvitationToInDB( $data['msg'], $fe, $projectID, $rand );
				if( $failed !== true ){
					// Sending Mail Failed. do something here.
					$failedEmailConnect[] = $failed;
					$fail++;
				}else{
					$this->ModelDirector->insertInvitationMail( $fe, $msgId, $projectID, 'connect', $rand );
					$sent++;
				}
			}

			$this->ModelDirector->insertFailedInvitations( $failedEmailFresh, $msgId, $projectID, 'invite' );
			$this->ModelDirector->insertFailedInvitations( $failedEmailConnect, $msgId, $projectID, 'connect' );

			$this->ModelDirector->updateCountAudSMS($sent, "invite", "email");
			$r = array( 'sent' => $sent, 'invalid' => count($invalid), 'failed' => $fail, 'invalidEmails' => $invalid, 'duplicate' => count($emailInCDdb), "duplicateEmail" => $emailInCDdb );
			$this->response(true, "{$sent} Invitation Emails sent", $r);
		}

		public function filterEmail($emails = ''){
			$emails = explode(",", $emails);
			$invalid = $valid = [];
			foreach ($emails as $key => $email) {
				if( strpos($email, "/") ){
					$email = explode("/", $email);
					foreach ($email as $key => $mail) {
						$m = $this->sanitizeEmail($mail);
						if( $m != '')
							$valid[] = $m;
						else
							$invalid[] = $mail;
					}
				}else{
					$m = $this->sanitizeEmail($email);
					if( $m != '')
						$valid[] = $m;
					else
						$invalid[] = $email;
				}
			}

			return [$valid, $invalid];
		}

		public function sanitizeEmail($email = ''){
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			return trim(filter_var($email, FILTER_VALIDATE_EMAIL));
		}


		public function csv2array($value = ''){
			$array = [];
			$values = explode(",", $value);
			foreach ($values as $key => $value) {
				if($value != '')
					$array[] = trim($value);
			}
			return $array;
		}


		public function getCSVList($values = []){
			$csv = '';
			//$values = explode(",", $values);
			foreach ($values as $key => $value) {
				if($value != '')
					$csv .= "'" . trim($value) . "',";
			}
			return rtrim($csv, ",");
		}
		public function advanceSearch($data = []){
			$this->load->model("ModelDirector");
			// Santizing data
			$minAge = $maxAge = $minHeight = $maxHeight = $sex = $skills = $projects = '';
			if($data['agemin'] != ''){
				$minAge = strtotime("-{$data['agemin']} years");
			}
			if($data['agemax'] != ''){
				$maxAge = (int)strtotime("-{$data['agemax']} years") - 31536000;
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
				$skillIDs = $this->ModelDirector->getSkillIDs($skills);
				$filteredBySKills = $this->ModelDirector->filteredBySKill($actorsInDirectorList, $skillIDs);
			}else{
				$skillIDs = [];
				$filteredBySKills = [];
			}
			
			if($data['projects'] != ''){
				$projects = trim($data['projects']);
				$filteredByProjects = $this->ModelDirector->filterByProject($projects);
			}else{
				$filteredByProjects = [];
			}
			
			if($data['actor_names'] != ''){
				$actor_names = trim($data['actor_names']);
			}
			
			$actorsInDirectorList = $this->ModelDirector->getActorsIdWithDirectors($this->session->userdata("StaSh_User_id"));
			$diff = array_merge($filteredBySKills, $filteredByProjects);
			//print_r($filteredByProjects);
			if(count($diff) == 0)
				$diff = $actorsInDirectorList;
			$searchData = array(
							'minHeight' => $minHeight,
							'minAge' => $minAge,
							'maxHeight' => $maxHeight,
							'maxAge' => $maxAge,
							'sex' => $sex,
							'in' => $diff,
							'names' => $data['actor_names']
						);
			//print_r($searchData);
			$finalFilteredActors = $this->ModelDirector->finalFilter($searchData);
			//print_r($finalFilteredActors);
			if(count($finalFilteredActors))
				$this->response(true, count($finalFilteredActors) . " actors found !", $finalFilteredActors);
			else
				$this->response(false, "0 actors found !");
		}
		public function contactActorBySMS($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("SMS");
			$response = $this->SMS->sendAuditionSMS($data['contact']['mobile'], $data['sms']);
			$response = json_decode($response, true);
			if($response['status'] == "success"){
				$id = $this->ModelDirector->insertSendSMS($data['contact']['ref'], $data['sms']);
				$this->ModelDirector->updateCountAudSMS($response['cost'], $id, "contact", "sms");
				$this->response(true, $response['cost'] . " SMS sent successfully.");
			}else{
				$this->response(false, "SMS ". Aj_Gen_Failed);
			}
			//$this->response(true, count($data['contact']['mobile']) . " SMS sent");
		}
		public function contactActorByEmail($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("Email");
			$data['mail'] = str_replace("\n", "<br>", $data['mail']);
			$sent = $this->Email->sendAuditionMail($data['contact']['email'], $data['subject'], $data['mail']);
			if($sent){
				$id = $this->ModelDirector->insertSendMail($data['contact']['ref'], $data['mail'], $data['subject']);
				$this->ModelDirector->updateCountAudSMS(count($data['contact']['ref']), $id, "contact", "email");
				$this->response(true, count($data['contact']['ref']) . " Emails sent successfully.");
			}else{
				$this->response(false, "Email " . Aj_Gen_Failed);
			}
			//$this->response(true, count($data['contact']['email']) . " Emails sent.");
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
				$this->response(false, Aj_FetAct_NoActor);
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
							// Sending a password reset Mail
							$this->load->model("Email");
							$this->Email->sendPasswordResetMail( $userData['StashUsers_email'], $this->input->ip_address() );

							$this->response(true, Aj_ChangePass_Succ);
						}else{
							$this->response(false, Aj_ChangePass_Fail);
						}
					}else{
						$this->response(false, Aj_ChangePass_CodeExp);
					}
				}else{
					$this->response(false, Aj_ChangePass_Used);
				}
			}else{
				$this->response(false, Aj_ChangePass_Invalid);
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
					$this->response(true, Aj_FrgtPass_Sent);
				}else{
					$this->response(false, Aj_FrgtPass_Failed);
				}
			}else{
				$this->response(false, Aj_FrgtPass_Invalid);
			}
		}

		
		public function userLogin($data = []){
			$this->load->model("Auth");
			if($this->Auth->ifUserExist($data['email'])){
				$profile = $this->Auth->verifyLoginCredentials($data);
				if(count($profile)){
					$this->Auth->startLoginSession($profile);
					$this->Auth->updateUserLogin($profile['StashUsers_id']);
					if($data['type'] == 'director'){
						$this->Auth->setDefaultCookies();
					}else{
						if($this->input->cookie("newInvite")){
							//$info = $this->session->userdata("Stash_New_User");
	    					if($this->Auth->checkActorProject($profile['StashUsers_id'], $this->input->cookie("project_ref")))
								$this->Auth->insertActorInProject($profile['StashUsers_id']);
	    					
							if($this->Auth->checkActorInDirector($profile['StashUsers_id'], $this->input->cookie("director_ref")))
								$this->Auth->insertActorInDirectorList($profile['StashUsers_id']);
							$this->session->set_userdata(array("Stash_New_User" => array()));
							
							unset($_COOKIE['newInvite']);
							unset($_COOKIE['project_ref']);
							unset($_COOKIE['director_ref']);
							
							setcookie('newInvite', null, -1, '/');
							setcookie('project_ref', null, -1, '/');
							setcookie('director_ref', null, -1, '/');
	    				}
					}
					$this->response(true, Aj_Login_Succ . " {$data['email']}");
				}else{
					$this->response(false, Aj_Login_Failed);
				}
			}else{
				$this->response(false, Aj_Login_Invalid);
			}
		}
	}
?>
