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
					case "createNewPorject":
						$this->createNewPorject($data);
						break;
					case "createNewRole":
						$this->createNewRole($data);
						break;
					case "getRolesInProject":
						$this->getRolesInProject($data);
						break;
					case "getQuestionsByRoleId":
						$this->getQuestionsByRoleId($data);
						break;
					case "getActorDetailsByContact":
						$this->getActorDetailsByContact($data);
						break;
					case "insertNewQuestion":
						$this->insertNewQuestion($data);
						break;
					case "updateActorPastExperience":
						$this->updateActorPastExperience($data);
						break;
					case "linkActorQuestionAnswer":
						$this->linkActorQuestionAnswer($data);
						break;
					case "linkRoleActor":
						$this->linkRoleActor($data);
						break;
					case "insertActorProject":
						$this->insertActorProject($data);
						break;
					case "getActorsInAProject":
						$this->getActorsInAProject($data);
						break;
					case "getActorsInARole":
						$this->getActorsInARole($data);
						break;
					case "getActorsAnswers":
						$this->getActorsAnswers($data);
						break;
					case "getActorVideos":
						$this->getActorVideos($data);
						break;
					case "setActorVideo":
						$this->setActorVideo($data);
						break;
					case "setActorNotes":
						$this->setActorNotes($data);
						break;
					case "setActorShortlistStatus":
						$this->setActorShortlistStatus($data);
						break;
					case "changeProjectStatus":
						$this->changeProjectStatus($data);
						break;
					case "insertNewActor":
						$this->insertNewActor($data);
						break;
					case "insertRoleActorScenes":
						$this->insertRoleActorScenes($data);
						break;
					case "getProjectsInDirector":
						$this->getProjectsInDirector();
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
					case "BulkDupTag":
						$this->bulkDupTag($data);
						break;
					case "BulkDupReInvite":
						$this->bulkDupReInvite($data);
						break;
					case "CheckoutClicked":
						$this->checkoutClicked($data);
						break;
					case "QuickViewNotice":
						$this->quickViewNotice($data);
						break;
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, Aj_Req_NoData);
			}
		}
		public function quickViewNotice($data = []){
			$this->load->model("Notifications");
			$m = $this->session->userdata("StaSh_User_name") . " took a quick view of your profile";
			$this->Notifications->insertNotification( $data['actor'], $m, 'quick', ['director' => $this->session->userdata("StaSh_User_id")] );
			$this->response(true, "Quick View");
		}
		public function checkoutClicked($data = []){
			$this->load->model("ModelProject");
			$this->updateCheckoutClicked();
			$this->response(true);
		}
		public function bulkDupReInvite($data = []){
			$this->load->model("ModelDirector");
			$failed = [];
			if( $data['type'] == 'email' ){
				$userIdList = $this->ModelDirector->getUserIdListBy('StashUsers_email', $data['contacts']);
				$failed = $this->reSendEmails( $data['contacts'], $data['msgID'], $data['project'] );
				$e = " Email ";
			}else{
				$userIdList = $this->ModelDirector->getUserIdListBy('StashUsers_mobile', $data['contacts']);
				$this->reSendSMS( $data['contacts'], $data['msgID'], $data['project'] );
				$e = " SMS ";
			}
			$this->ModelDirector->addInProject($data['project'], $userIdList);
			$this->response(true, "{$e} re-sent successfully.", ['failed' => $failed]);
			
		}
		public function reSendSMS($numbers = [], $msgId = 0, $project = 0){
			$this->load->model("ModelDirector");
			$this->load->model("SMS");
			$msg = $this->ModelDirector->getThisMessage($msgId);
			$totNum = count($numbers);
			$msgLen = strlen($msg['StashInviteMsg_message']);
			$totSMS = ($msgLen / 160) * $totNum;
			
			$plan = $this->ModelDirector->getDirectorPlan();
			$leftSMS = $plan['StashDirectorPlan_free_sms'] - $plan['StashDirectorPlan_used_sms'];
			$usedSMS = $plan['StashDirectorPlan_used_sms'];
			$planId = $plan['StashDirectorPlan_id'];
			if($leftSMS < $totSMS){
				$this->response(false, "You don't have enough SMS Credits. Plan recharge for SMS Credits.");
			}
			foreach ($numbers as $key => $number) {
				$rand = substr(base64_encode(md5(microtime() . $number . microtime())), 0, 6);
				while($this->ModelDirector->checkRandLink($rand))
					$rand = substr(base64_encode(md5(microtime() . $number . microtime())), 0, 6);
				
				$link = "http://castiko.com/invite/{$rand}";
				$this->SMS->sendInvitaionSMS( $msg['StashInviteMsg_message'], $number, $link );
				$this->ModelDirector->insertInvitationSMS($msgId, $rand, $project, $number);
			}
			$this->ModelDirector->updateCountAudSMS(count($numbers), "invite", "sms");
			$totSMSUsed = $usedSMS + count($numbers);
			$this->ModelDirector->updateSMSCreditUsed( $planId, $totSMSUsed );
			
		}
		public function reSendEmails($emails = [], $msgId = 0, $project = 0){
			$this->load->model("ModelDirector");
			$this->load->model("Email");
			$msg = $this->ModelDirector->getThisMessage($msgId);
			$failedEmailConnect=[];
			foreach ($emails as $key => $fe) {
				$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);
				while($this->ModelDirector->checkEmailRandLink($rand))
					$rand = substr(base64_encode(md5(microtime() . $fe . microtime())), 0, 8);
				$failed = $this->Email->sendInvitationToInDB( $msg['StashInviteMsg_message'], $fe, $project, $rand, $msg['StashInviteMsg_subject'], 'Confirm' );
				if( $failed !== true ){
					// Sending Mail Failed. do something here.
					$failedEmailConnect[] = $failed;
				}else{
					$this->ModelDirector->insertInvitationMail( $fe, $msgId, $project, 'connect', $rand );
				}
			}
			$this->ModelDirector->insertFailedInvitations( $failedEmailConnect, $msgId, $project, 'invite' );
			return $failedEmailConnect;
		}
		public function bulkDupTag($data =[]){
			$this->load->model("ModelDirector");
			if( $data['type'] == 'email' )
				$userIdList = $this->ModelDirector->getUserIdListBy('StashUsers_email', $data['contacts']);
			else
				$userIdList = $this->ModelDirector->getUserIdListBy('StashUsers_mobile', $data['contacts']);
			if(count($userIdList)){
				if($this->ModelDirector->addInProject($data['project'], $userIdList)){
					$this->response(true, "Added to the Project.");
				}else{
					$this->response(false, "Failed to add in project.");
				}
			}else{
				$this->response(false, "Not in List");
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
			$duplicate = $this->remapArray($duplicate);
			$r = array( 'sent' => count($mobileNotInDB), 'invalid' => count($invalid), 'invalidNums' => $invalid, 'duplicate' => count($duplicate), "duplicateNums" => $duplicate, 'project_id' => $projectID, 'msg' => $msgId );
			$this->ModelDirector->updateCountAudSMS(count($mobileNotInDB), "invite", "sms");
			$totSMSUsed = $usedSMS + count($mobileNotInDB);
			$this->ModelDirector->updateSMSCreditUsed( $planId, $totSMSUsed );
			
			$this->response(true, "Invitation SMS Sent", $r);
		}
		public function getActorDetailsByContact($d=[]){
			$select = "*";
			$val=$d["contact"];
			$this->db->select( $select );
			$this->db->from("stash-actor");
			$this->db->where("StashActor_email", $val);
			$this->db->or_where('StashActor_mobile',$val); 
			$response=$this->db->get()->first_row('array');
			
			if($response!="")
			{
				$isLinked=$this->isLinkedWithDirector($response["StashActor_actor_id_ref"]);
				$response["isLinkedWithDirector"]=$isLinked;
				$result=json_encode($response);
				//$result=array("isLinkedWithDirector" => $isLinked);
				$this->response(true, "Actor details fetched",$result);	
			}
			else
			{
				$this->response(false, "Actor does not exist");	
			}
			
			
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
			$this->load->model("Notifications");
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
				$failed = $this->Email->sendInvitationToNotInDB( $data['msg'], $fe, $projectID, $rand , $data['subject']);
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
				$failed = $this->Email->sendInvitationToInDB( $data['msg'], $fe, $projectID, $rand ,  $data['subject']);
				if( $failed !== true ){
					// Sending Mail Failed. do something here.
					$failedEmailConnect[] = $failed;
					$fail++;
				}else{
					$this->ModelDirector->insertInvitationMail( $fe, $msgId, $projectID, 'connect', $rand );
					$actId = $this->ModelDirector->getActorIdByEmail($fe);
					$m = $this->session->userdata("StaSh_User_name") . ' wants to connect with you. Click to accept.';
					$notiD = array($this->session->userdata("StaSh_User_id"), $projectID, time(), $fe, $rand);
					$this->Notifications->insertNotification( $actId, $m, "connect", $notiD );
					$sent++;
				}
			}
			$this->ModelDirector->insertFailedInvitations( $failedEmailFresh, $msgId, $projectID, 'invite' );
			$this->ModelDirector->insertFailedInvitations( $failedEmailConnect, $msgId, $projectID, 'connect' );
			$this->ModelDirector->updateCountAudSMS($sent, "invite", "email");
			$emailInCDdb = $this->remapArray($emailInCDdb);
			$r = array( 'sent' => $sent, 'invalid' => count($invalid), 'failed' => $fail, 'invalidEmails' => $invalid, 'duplicate' => count($emailInCDdb), "duplicateEmail" => $emailInCDdb, 'project_id' => $projectID, 'msg' => $msgId );
			$this->response(true, "{$sent} Invitation Emails sent", $r);
		}
		public function remapArray($arr = []){
			$a = [];
			foreach ($arr as $key => $value) {
				$a[] = trim($value);
			}
			return $a;
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
			$actorsInDirectorList = $this->ModelDirector->getActorsIdWithDirectors($this->session->userdata("StaSh_User_id"));
			
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
							'names' => $data['actor_names'],
							'dp' => $data['dponly']
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
			$this->load->model("Notifications");
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
					$notiD = array($this->session->userdata("StaSh_User_id"), $email, $time, $msgId);
					$x = ($projectID == 0) ? 'a' : 'an audition';
					$tag = ($projectID == 0) ? 'message' : 'audition';
					$this->Notifications->insertNotification($actors[$key], $this->session->userdata("StaSh_User_name") . " has sent you  {$x} message.", $tag, $notiD);
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
		public function getEncryptedText($text = ''){
			$this->load->library('encrypt');
			return $this->encrypt->encode($text);
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
		public function createNewPorject($d=[]){
			$data = array(
						"StashProject_id" => null,
						"StashProject_director_id_ref" => $this->session->userdata("StaSh_User_id"),
						"StashProject_name" => $d["project_name"],
						"StashProject_date" => strtotime($d["project_date"]),
						"StashProject_tag" => $d["project_name"]. '_' . $d["project_date"],
						"StashProject_time" => time(),
						"StashProject_status" => 1,
						"StashProject_client" => $d["project_client"],
						"StashProject_shoot_begins" => strtotime($d["project_shoot_begins"]),
						"StashProject_shoot_ends" => strtotime($d["project_shoot_ends"])
					);
			$this->db->insert("stash-project", $data);
			echo $this->db->insert_id();
			return $this->db->insert_id();
		}
		public function createNewRole($d=[]){
			$data = array(
						"StashRoles_id" => null,
						"StashRoles_role" => $d["role_name"],
						"StashRoles_scenes" => $d["role_scenes"],
						"StashRoles_description" => $d["role_description"],
						"StashRoles_project_id_ref" => $d["role_project"],
						"StashRoles_status" => 1
					);
			$this->db->insert("stash-roles", $data);
			echo $this->db->insert_id();
			return $this->db->insert_id();
		}
		public function insertNewQuestion($d=[]){
			$data = array(
						"StashQuestions_id" => null,
						"StashQuestions_question" => $d["question"],
						"StashQuestions_type" => $d["question_type"],
						"StashQuestions_project_id_ref" => $d["project_id"],
						"StashQuestions_role_id_ref" => $d["question_addto"],
						"StashQuestions_status" => 1
					);
			$this->db->insert("stash-questions", $data);
			echo $this->db->insert_id();
			return $this->db->insert_id();
		}
		public function getRolesInProject($data=[]){
			$ref=$data["project_id"];
			$this->db->select("*");
			$this->db->from("stash-roles"); 
			$this->db->where("StashRoles_project_id_ref", $ref);
			$this->db->where("StashRoles_status", 1);
			$query = $this->db->get();
			$result = [];
			$roles = $query->result('array');
			$this->response(true, "Roles fetched",json_encode($roles));
			
		}
		public function getQuestionsByRoleId($data=[]){
			$ref=$data["role_id"];
			$this->db->select("*");
			$this->db->from("stash-questions"); 
			$this->db->where("StashQuestions_role_id_ref", $ref);
			$this->db->where("StashQuestions_status", 1);
			$query = $this->db->get();
			$result = [];
			$roles = $query->result('array');
			$this->response(true, "Questions fetched",json_encode($roles));
			
		}
		public function updateActorPastExperience($data = []){
			$ref = $data['actor_id'];
			$data = array(
						'StashActor_six_months_experience' => $data['actor_recent_exp'],
						'StashActor_three_years_experience' => $data['actor_past_exp'],
						'StashActor_dob' => strtotime($data['actor_dob']),
						'StashActor_height' => $data['actor_height'],
						'StashActor_gender' => $data['actor_sex']
					);
			$this->db->where("StashActor_actor_id_ref", $ref);
			$this->response(true, "Experience updated",$this->db->update("stash-actor", $data));
		}
		public function linkActorQuestionAnswer($d=[]){
			$data = array(
						"StashAnswers_id" => null,
						"StashAnswers_answer" => $d["question_answer"],
						"StashAnswers_questions_id_ref" => $d["question_id"],
						"StashAnswers_actor_id_ref" => $d["actor_id"]
					);
			
			$this->response(true, "Question and answers linked",$this->db->insert("stash-answers", $data));
		}
		public function linkRoleActor($d=[]){
			$data = array(
						"StashRoleActorLink_id" => null,
						"StashRoleActorLink_role_id_ref" => $d["role_id"],
						"StashRoleActorLink_actor_id_ref" => $d["actor_id"],
						"StashRoleActorLink_project_id_ref" => $d["project_id"],
						"StashRoleActorLink_shortlist_status" => 0,
						"StashRoleActorLink_status"=> 1
					);
			
			$this->response(true, "Role and actors linked",$this->db->insert("stash-role-actor-link", $data));
		}
		public function insertActorProject($d){
			$data = array(
						'StashActorProject_id' => null,
						'StashActorProject_actor_id_ref' => $d["actor_id"],
						'StashActorProject_project_id_ref' => $d["project_id"],
						'StashActorProject_time' => time(),
						'StashActorProject_status' => 1
					);
			//return $query = $this->db->get_compiled_insert("stash-actor-project", $data);
			if($this->isLinkedWithDirector($d["actor_id"])==0)
			{
				$this->insertActorInDirectorList($d["actor_id"],$this->session->userdata("StaSh_User_id"));
			}
			return $this->db->insert("stash-actor-project", $data);
		}
		public function getActorsInAProject($d){
			$this->db->select("*");
			$this->db->from("stash-actor-project as PA");
			$this->db->join("stash-actor as A", "PA.StashActorProject_actor_id_ref = A.StashActor_actor_id_ref");
			$this->db->where("PA.StashActorProject_project_id_ref", $d["project_id"]);
			$this->db->order_by("A.StashActor_name", "desc");
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			$result=json_encode($fetch);
			$this->response(true, "Actors in a project found",$result);
		}
		public function getActorsInARole($d){
			$this->db->select("*");
			$this->db->from("stash-role-actor-link as RA");
			$this->db->join("stash-actor as A", "RA.StashRoleActorLink_actor_id_ref = A.StashActor_actor_id_ref");
			$this->db->where("RA.StashRoleActorLink_project_id_ref", $d["project_id"]);
			$this->db->order_by("A.StashActor_name", "desc");
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			$result=json_encode($fetch);
			$this->response(true, "Actors in a project found",$result);
		}
		public function getActorsAnswers($d){
			$this->db->select("*");
			$this->db->from("stash-answers");
			$this->db->where("StashAnswers_actor_id_ref", $d["actor_id"]);
			$this->db->where("StashAnswers_questions_id_ref", $d["question_id"]);
			$query = $this->db->get();
			$result = [];
			$result=$query->first_row('array');
			$result=json_encode($result);
			$this->response(true, "Actors answers for a role found",$result);
		}
		public function getActorVideos($d){
			$this->db->select("*");
			$this->db->from("stash-scene-video");
			$this->db->where("StashSceneVideo_actor_id_ref", $d["actor_id"]);
			$this->db->where("StashSceneVideo_role_id_ref", $d["role_id"]);
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			$result=json_encode($fetch);
			$this->response(true, "Actors videos for a role found",$result);
		}
		public function setActorShortlistStatus($d = []){
			$data = array(
						'StashRoleActorLink_shortlist_status' => $d['status']
					);
			$this->db->where("StashRoleActorLink_actor_id_ref", $d["actor_id"]);
			$this->db->where("StashRoleActorLink_role_id_ref", $d["role_id"]);
			$this->response(true, "Shortlist status updated",$this->db->update("stash-role-actor-link", $data));
		}
		public function setActorVideo($d = []){
			$ref = $d['actor_id'];
			$data = array(
						'StashSceneVideo_video' => $d['video']
					);
			$this->db->where("StashSceneVideo_actor_id_ref", $d["actor_id"]);
			$this->db->where("StashSceneVideo_role_id_ref", $d["role_id"]);
			$this->db->where("StashSceneVideo_scene_index", $d["index"]);
			$this->response(true, "Video updated",$this->db->update("stash-scene-video", $data));
		}
		public function setActorNotes($d = []){
			$data = array(
						'StashRoleActorLink_notes' => $d['notes']
					);
			$this->db->where("StashRoleActorLink_actor_id_ref", $d["actor_id"]);
			$this->db->where("StashRoleActorLink_role_id_ref", $d["role_id"]);
			$this->response(true, "Video updated",$this->db->update("stash-role-actor-link", $data));
		}
		public function insertNewActor($d){
			$type = 'actor';
			$refer = 'castingsheet';
			$this->load->library('user_agent');
			$pass = hash_hmac('sha512', $d["actor_password"], $this->config->item("encryption_key"));
			// check username
			$username = trim(explode("@", $d["actor_email"])[0]);
			$checkUsername = $username;
			$dat = $this->getUserData("StashUsers_username", $checkUsername);
			while (count($dat)){
				$checkUsername = $username . "-" . mt_rand(100, 999);
				$dat= $this->getUserData("StashUsers_username", $checkUsername);
			}
			
			$data = array(
						'StashUsers_id' => null,
						'StashUsers_username' => $checkUsername,
						'StashUsers_name' => ucwords($d["actor_name"]),
						'StashUsers_email' =>  $d["actor_email"],
						'StashUsers_mobile' =>  $d["actor_phone"],
						'StashUsers_password' => $pass,
						'StashUsers_type' =>"actor",
						'StashUsers_time' => time(),
						'StashUsers_status' => 0,
						'StashUsers_mobile_status' => 0,
						'StashUsers_ip' => $this->input->ip_address(),
						'StashUsers_header' => $this->agent->agent_string(),
						'StashUsers_refer' => $refer,
						'StashUsers_refer_id' => $this->session->userdata("StaSh_User_id"),
						'StashUsers_ticket_status' => 0
					); 
			$this->db->insert("stash-users", $data);
			$response = $this->db->insert_id();
			$data = array(
						'StashActor_id' => null,
						'StashActor_actor_id_ref' => $response,
						'StashActor_name' => ucwords($d["actor_name"]),
						'StashActor_email' => $d["actor_email"],
						'StashActor_mobile' => $d["actor_phone"],
						'StashActor_whatsapp' => '',
						'StashActor_dob' => 0,
						'StashActor_gender' => 0,
						'StashActor_height' => 0,
						'StashActor_weight' => 0,
						'StashActor_avatar' => 'default.png',
						'StashActor_images' => '{}',
						'StashActor_min_role_age' => 0,
						'StashActor_max_role_age' => 0,
						'StashActor_address' => '',
						'StashActor_city' => '',
						'StashActor_state' => '',
						'StashActor_country' => '',
						'StashActor_zip' => '',
						'StashActor_ticket_status' => 0,
						'StashActor_profile_completion_stage' => 1,
						'StashActor_six_months_experience' =>'',
						'StashActor_three_years_experience' =>'',
						'StashActor_last_update' => time(),
						'StashActor_last_ip' => $this->input->ip_address()
					);
			$this->db->insert("stash-actor", $data);
			//response = $this->db->insert_id();
			$this->load->model("Email");
	    	$this->Email->sendActivationMail(ucwords($d["actor_name"]), $d["actor_email"], $response);
	    	$this->insertActorPlan("basic",$response);
	    	$this->insertActorInDirectorList($response,$this->session->userdata("StaSh_User_id"));
			$this->response(true, "Actor inserted",$response);
		
		}
		public function insertActorPlan($plan = 'basic',$ref=''){
			$d = array(
						'StashActorPlan_id' => null,
						'StashActorPlan_actor_id_ref' => $ref,
						'StashActorPlan_plan' => $plan,
						'StashActorPlan_start' => time(),
						'StashActorPlan_end' => strtotime("+1 year"),
						'StashActorPlan_time' => time(),
						'StashActorPlan_status' => 1,
						'StashActorPlan_ip' => $this->input->ip_address()
					);
			return $this->db->insert("stash-actor-plan", $d);
		}
		public function isLinkedWithDirector($actor_ref=''){
			$director_ref=$this->session->userdata("StaSh_User_id");
			$this->db->select("*");
			$this->db->from("stash-director-actor-link"); 
			$this->db->where("StashDirectorActorLink_director_id_ref", $director_ref);
			$this->db->where("StashDirectorActorLink_actor_id_ref", $actor_ref);
			$query = $this->db->get();
			return $query->num_rows();
		}
		public function insertActorInDirectorList($ref = 0, $dir = 0){
			
			$data = array(
						'StashDirectorActorLink_id' => null,
						'StashDirectorActorLink_director_id_ref' => $dir,
						'StashDirectorActorLink_actor_id_ref' => $ref,
						'StashDirectorActorLink_rate' => 5,
						'StashDirectorActorLink_time' => time(),
						'StashDirectorActorLink_status' => 1
					);
			$this->db->insert("stash-director-actor-link", $data);
			//return $query = $this->db->get_compiled_insert("stash-director-actor-link", $data);
		}
		public function insertRoleActorScenes($d){
			$data = array(
						'StashSceneVideo_id' => null,
						'StashSceneVideo_actor_id_ref' => $d["actor_id"],
						'StashSceneVideo_project_id_ref' => $d["project_id"],
						'StashSceneVideo_role_id_ref' =>$d["role_id"],
						'StashSceneVideo_scene_index' =>$d["scene_index"],
						'StashSceneVideo_video' => $d["scene"]
					);
			//return $query = $this->db->get_compiled_insert("stash-actor-project", $data);
			
			 $response=$this->db->insert("stash-scene-video", $data);
			 $this->response(true, "Role Video inserted",$response);
		}
		public function getProjectsInDirector(){
			$this->db->select("*");
			$this->db->from("stash-project");
			$director_ref=$this->session->userdata("StaSh_User_id");
			$this->db->where("StashProject_director_id_ref", $director_ref);
			$this->db->order_by("StashProject_id", "desc");
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			$result=json_encode($fetch);
			$this->response(true, "Projects in director found",$result);
		}
		public function changeProjectStatus($d = []){
			$data = array(
						'StashProject_status' => $d['status']
					);
			$director_ref=$this->session->userdata("StaSh_User_id");
			//$this->db->where("StashProject_director_id_ref", $director_ref);
			$this->db->where("StashProject_id", $d["project_id"]);
			$this->response(true, "Status updated",$this->db->update("stash-project", $data));
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
		public function getUserData($key = '', $value = ''){
			$this->db->where($key, trim($value));
			$query = $this->db->get("stash-users");
			return $query->first_row('array');
		}
		
	}
	
		
?>
