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
					case "LastMessages":
						$this->lastMessages($data);
						break;
					case "ContactList":
						$this->contactLits($data);
						break;
					case "save_contact_message":
						$this->save_contact_message($data);
						break;
					case "BulkRemove":
						$this->bulkRemove($data);
						break;
					case "ContactData":
						$this->contactData($data);
						break;
					case "BulkProjectTag":
						$this->bulkProjectTag($data);
						break;

					case "ChangePasswordIn":
						$this->changePasswordIn($data);
						break;
					case "GoBasic":
						$this->goBasicPlan($data);
						break;
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, Aj_Req_NoData);
			}
		}
		public function goBasicPlan($data = []){
			$this->load->model("Auth");
			if( $this->Auth->insertActorPlan( $data['plan'] ) ){
				$this->response(true, "You are activated with Basic Plan.");
			}else{
				$this->response(false, "Connection error occured. Try again.");
			}
		}
		public function changePasswordIn($data = []){
			$this->load->model("Auth");
			$profile = $this->Auth->verifyCredentials( $data['current'] );			
			if(count($profile)){
				if($data['password'] == $data['confirm']){
					if($this->Auth->updatePassword($profile['StashUsers_id'], $data['password'])){
						$this->destroyUserSession();
						$this->response(true, "Password Changed successfully. You will be logged out in few seconds for security reasons.");
					}else{
						$this->response(false, Aj_ChangePass_Fail);
					}
				}else{
					$this->response(false, "New password and confirm password did not match.");
				}
			}else{
				$this->response(false, "Invalid password.");
			}
		}

		public function destroyUserSession($value=''){
			$this->session->set_userdata(array());
			$this->session->sess_destroy();
			$this->load->helper('cookie');
			delete_cookie('categories');
			delete_cookie('isCat');
		}

		public function bulkProjectTag($data = []){
			$this->load->model("ModelDirector");
			$list = $data['list'];
			$listid = $data['listid'];
			$pid = $data['project'];
			$c = 0;$r = [];
			foreach ($list as $key => $value) {
				if( $this->ModelDirector->insertActorProject( $value, $pid ) ){
					$c++;
					$r[] = $listid[$key];
				}
			}

			if($c)
				$this->response(true, "selected actor added to project.");
			else
				$this->response(false, "something went wrong. try again later.");
		}

		public function contactData($data = []){
			$this->load->model("ModelDirector");
			$res = [];
			if( $data['for'] == 'iEmail'){
				$res = $this->ModelDirector->fetchInviteEmailData( $this->session->userdata("StaSh_User_id"), $data['id'] );
			}elseif( $data['for'] == 'iSMS' ){
				$res = $this->ModelDirector->fetchInviteSMSData( $this->session->userdata("StaSh_User_id"), $data['id'] );
			}elseif( $data['for'] == 'cEmail' ){
				$res = $this->ModelDirector->fetchContactEmailData( $this->session->userdata("StaSh_User_id"), $data['id'] );	
			}elseif( $data['for'] == 'cSMS' ){
				$res = $this->ModelDirector->fetchContactSMSData( $this->session->userdata("StaSh_User_id"), $data['id'] );
			}
			$this->response(true, "Data", $res);
		}


		public function bulkRemove($data = []){
			$this->load->model("ModelDirector");
			$list = $data['list'];
			$listid = $data['listid'];
			$c = 0;$r = [];
			foreach ($list as $key => $value) {
				if( $this->ModelDirector->deleteActorFromDirector( $value ) ){
					$c++;
					$r[] = $listid[$key];
				}
			}

			if($c)
				$this->response(true, "{$c} selected actor removed from your list.", ["removed" => $r]);
			else
				$this->response(false, "something went wrong. try again later.");
		}
		
		public function testAttachment($data){
			print_r($data);
		}

		public function contactLits($data = []){
			$this->load->model("ModelDirector");
			$d = [];
			if( $data['for'] == 'iEmail' ){
				$res = $this->ModelDirector->inviteEmailList( $this->session->userdata("StaSh_User_id") );
			}elseif( $data['for'] == 'iSMS' ){
				$res = $this->ModelDirector->inviteSMSList( $this->session->userdata("StaSh_User_id") );
			}elseif( $data['for'] == 'cEmail' ){
				$res = $this->ModelDirector->contactEmailList( $this->session->userdata("StaSh_User_id") );
			}elseif($data['for'] == 'cSMS'){
				$res = $this->ModelDirector->contactSMSList( $this->session->userdata("StaSh_User_id") );
			}
			$this->response( true, "Messages", $res );
		}

		public function lastMessages($data = []){
			$this->load->model("ModelDirector");
			$msgData = $this->ModelDirector->getLastMessage( $data['from'], $this->session->userdata("StaSh_User_id"), $data['offset'] );
			if($msgData){
				$o = (int)$data['offset'] + 1;
				$this->response(true, $msgData['date'], array("msg" => $msgData['msg'], 'offset' => $o));
			}else{
				if($data['offset'] != 0){
					$msgData = $this->ModelDirector->getLastMessage( $data['from'], $this->session->userdata("StaSh_User_id"), 0 );
					$this->response(true, $msgData['date'], array("msg" => $msgData['msg'], 'offset' => 1));
				}else{
					$this->response(false, "No last message found.");
				}
			}

		}
		
		public function SMSInvitation($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("SMS");

			$filterNumbers = $this->filterMobile( $data['mobiles'] );

			$totNum = count($filterNumbers);
			$msgLen = strlen($data['msg']);
			$totSMS = ($msgLen / 160) * $totNum;
			
			$plan = $this->ModelDirector->getDirectorPlan();
			$leftSMS = $plan['StashDirectorPlan_free_sms'] - $plan['StashDirectorPlan_used_sms'];
			$usedSMS = $plan['StashDirectorPlan_used_sms'];
			$planId = $plan['StashDirectorPlan_id'];
			if($leftSMS < $totSMS){
				$this->response(false, "You don't have enough SMS Credits. Plan recharge for SMS Credits.");
			}

			$project = $this->ModelDirector->getProject($data['project_name'], $data['project_date']);
			if(count($project)){
				$projectID = $project['StashProject_id'];
			}else{
				$projectID = $this->ModelDirector->insertNewPorject($data['project_name'], $data['project_date']);
			}
			$data['project_id'] = $projectID;
			// Generating Link.

			
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

			$totSMSUsed = $usedSMS + count($mobileNotInDB);
			$this->ModelDirector->updateSMSCreditUsed( $planId, $totSMSUsed );
			
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
			$data['project_id'] = $projectID;
			$data['msg'] = str_replace("\n", "<br>", $data['msg']);
			

			$msgId = $this->ModelDirector->insertSMSMsg($data['msg'], 'email', $data['subject']);

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

			$totNum = count($data['contact']['mobile']);
			$msgLen = strlen($data['sms']);
			$totSMS = ($msgLen / 160) * $totNum;
			
			$plan = $this->ModelDirector->getDirectorPlan();
			$usedSMS = $plan['StashDirectorPlan_used_sms'];
			$planId = $plan['StashDirectorPlan_id'];
			$leftSMS = $plan['StashDirectorPlan_free_sms'] - $plan['StashDirectorPlan_used_sms'];
			if($leftSMS < $totSMS){
				$this->response(false, "You don't have enough SMS Credits. Plan recharge for SMS Credits.");
			}



			$projectID = 0;
			if(trim($data['project_name']) != ''){
				$project = $this->ModelDirector->getProject($data['project_name'], $data['project_date']);
				if(count($project)){
					$projectID = $project['StashProject_id'];
				}else{
					$projectID = $this->ModelDirector->insertNewPorject($data['project_name'], $data['project_date']);
				}
			}
			$data['project_id'] = $projectID;
			$msgId = $this->ModelDirector->insertSMSMsg($data['sms'], 'sms');
			$isQues = $data['isAud'];
			$project = $projectID;
			$str = base64_encode(md5(microtime() . $msgId . microtime()));
			$rand = substr($str, 0, 6);
			$start = 0;
			$time = time();
			while ( $this->ModelDirector->checkUniqueLink( $rand ) || !preg_match("/^[a-zA-Z0-9]+$/i", $rand) ){
				if( strlen($str) !== $start ){
					$start++;
				}
				else{
					$str = base64_encode(md5(microtime() . mt_rand() . microtime()));
					$start = 0;
				}
				$rand = substr($str, $start, 6);
			}

			$url = "http://castiko.com/info/{$rand}";
			$response = $this->SMS->sendAuditionSMS($data['contact']['mobile'], $data['sms'], $url);
			$response = json_decode($response, true);
			$sent = $response['cost'];
			foreach ($data['contact']['ref'] as $key => $ref) {
				$this->ModelDirector->insertSendSMS( $ref, $msgId, $project, $isQues, $time, $rand );
			}

			$totSMSUsed = $usedSMS + $sent;
			$this->ModelDirector->updateSMSCreditUsed( $planId, $totSMSUsed );

			$this->response(true, "{$sent} SMS Sent.");
		}
		public function contactActorByEmail($data = []){
			$this->load->model("ModelDirector");
			$this->load->model("Email");
			$projectID = 0;
			if(trim($data['project_name']) != ''){
				$project = $this->ModelDirector->getProject($data['project_name'], $data['project_date']);
				if(count($project)){
					$projectID = $project['StashProject_id'];
				}else{
					$projectID = $this->ModelDirector->insertNewPorject($data['project_name'], $data['project_date']);
				}
			}
			$data['project_id'] = $projectID;
			$data['mail'] = str_replace("\n", "<br>", $data['mail']);
			$msgId = $this->ModelDirector->insertSMSMsg($data['mail'], 'email', $data['subject']);
			$emails = $data['contact']['email'];
			$actors = $data['contact']['ref'];

			$isQues = $data['isAud'];
			$project = $projectID;
			$time = time();
			$sent = $failed = 0;
			$failedMails = [];

			foreach ($emails as $key => $email) {
				if( $this->Email->sendAuditionMailUpdated( $email, $time, $msgId ) ){
					$this->ModelDirector->insertSendMail( $actors[$key], $project, $msgId, $time );
					$sent++;
				}else{
					$failedMails[] = $email;
					$failed++;
				}
			}

			if($failed)
				$this->ModelDirector->insertFailedInvitations($failedMails, $msgId, $project, "message", $time);
			//$this->ModelDirector->updateCountAudSMS($sent, 0, "contact", "email");
			$arr = array( 'sent' => $sent, 'fail' => $failed );
			$this->response(true, "{$sent} Emails successfully sent.", $arr);
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
						$paymentData = $this->Auth->getDirectPayments();
					}else{
						$paymentData = $this->Auth->getActorPayments();
					}

					$redirect = (bool) $paymentData;

					$this->response(true, Aj_Login_Succ . " {$data['email']}", ['redirect' => $redirect]);
				}else{
					$this->response(false, Aj_Login_Failed);
				}
			}else{
				$this->response(false, Aj_Login_Invalid);
			}
		}
		public function save_contact_message($data){
			$this->load->model("Auth");
			$this->Auth->insert_contact_message($data);
			$this->response(true, "200");

		}
	}
?>
