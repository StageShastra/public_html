<?php

	class ModelDirector extends CI_Model {

		public function arr2csv($data = []){
			$csv = '';
			foreach ($data as $key => $value)
				$csv .= trim($value) . ', ';
			return rtrim($csv, ", ");
		}

		public function calculateAge($dob = 0){
			$diff = abs(time() - $dob);
			$years = floor($diff / (365*60*60*24));
			return $years;
		}

		public function deleteActorFromDirector($ref = ''){
			$data = array('StashDirectorActorLink_status' => 0);
			$this->db->where("StashDirectorActorLink_actor_id_ref", $ref);
			return $this->db->update("stash-director-actor-link", $data);
		}

		public function getActorsIdWithDirectors($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-actor as act"); //StashDirectorActorLink_actor_id_ref
			$this->db->join("stash-director-actor-link as DALink", "DALink.StashDirectorActorLink_actor_id_ref = act.StashActor_actor_id_ref");
			$this->db->where("DALink.StashDirectorActorLink_director_id_ref", $ref);
			$this->db->where("DALink.StashDirectorActorLink_status", 1);
			$query = $this->db->get();
			$result = [];
			$actors = $query->result('array');
			foreach ($actors as $key => $actor) {
				$result[] = $actor['StashActor_actor_id_ref'];
			}

			return $result;
		}

		public function getActorsInDirectorList($ref = ''){
			$this->db->select("*");
			$this->db->from("stash-actor as act"); //StashDirectorActorLink_actor_id_ref
			$this->db->join("stash-director-actor-link as DALink", "DALink.StashDirectorActorLink_actor_id_ref = act.StashActor_actor_id_ref");
			$this->db->where("DALink.StashDirectorActorLink_director_id_ref", $ref);
			$this->db->where("DALink.StashDirectorActorLink_status", 1);
			$query = $this->db->get();
			$result = [];
			$actors = $query->result('array');
			foreach ($actors as $key => $actor) {
				$actor['StashActor_sex'] = ($actor['StashActor_gender']) ? "M" : "F";
				$actor['StashActor_age'] = $this->calculateAge($actor['StashActor_dob']);
				$actor['StashActor_range'] = $actor['StashActor_min_role_age'] . " - " . $actor['StashActor_max_role_age'];
				$actor['StashActor_language'] = $this->getActorLanguage($actor['StashActor_actor_id_ref']);
				$actor['StashActor_skills'] = $this->getActorSkills($actor['StashActor_actor_id_ref']);
				$actor['StashActor_projects'] = $this->getActorProjects($actor['StashActor_actor_id_ref']);
				$actor['StashActor_username'] = $this->getActorUsername($actor['StashActor_actor_id_ref']);
				$result[] = $actor;
			}

			return $result;
		}

		public function getActorUsername($ref = 0){
			$this->db->where("StashUsers_id", $ref);
			$query = $this->db->get("stash-users");
			$result = $query->first_row("array");
			return trim($result['StashUsers_username']);
		}

		public function getActorLanguage($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-languages as lang");
			$this->db->join("stash-actor-language as actLang", "actLang.StashActorLanguage_language_id_ref = lang.StashLanguages_id");
			$this->db->where("actLang.StashActorLanguage_actor_id_ref", $ref);
			$query = $this->db->get();
			$result = [];
			$langs = $query->result('array');
			foreach ($langs as $key => $lng) {
				$result[] = $lng['StashLanguages_title'];
			}

			return $result;
		}

		public function getActorSkills($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-skills as skill");
			$this->db->join("stash-actor-skill as actSkill", "actSkill.StashActorSkill_skill_id_ref = skill.StashSkills_id");
			$this->db->where("actSkill.StashActorSkill_actor_id_ref", $ref);
			$query = $this->db->get();
			$result = [];
			$langs = $query->result('array');
			foreach ($langs as $key => $lng) {
				$result[] = $lng['StashSkills_title'];
			}

			return $result;
		}
		
		public function getActorProjects($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-project as project");
			$this->db->join("stash-actor-project as actProject", "actProject.StashActorProject_project_id_ref = project.StashProject_id");
			$this->db->where("actProject.StashActorProject_actor_id_ref", $ref);
			$query = $this->db->get();
			$result = [];
			$langs = $query->result('array');
			foreach ($langs as $key => $lng) {
				$result[] = $lng['StashProject_name'] . " (". date("d/M/Y", $lng['StashProject_date']) . ")" ;
			}

			return $result;
		}

		/*public function insertSendMail($refs = [], $msg = '', $sub = ''){
			$data = array(
						'StashEMail_id' => null,
						'StashEMail_send_by' => $this->session->userdata("StaSh_User_id"),
						'StashEMail_to' => json_encode($refs),
						'StashEMail_subject' =>	$sub,
						'StashEMail_message' => $msg, 
						'StashEMail_time' => time(),
						'StashEMail_status' => 1
					);
			$this->db->insert("stash-email", $data);
			return $this->db->insert_id();
		}*/

		public function insertSendMail($a = 0, $p = 0, $m = 0, $t = 0, $q = 0){
			$d = array(
						'StashEmailMsg_id' => null,
						'StashEmailMsg_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashEmailMsg_actor_id_ref' => $a,
						'StashEmailMsg_project_id_ref' => $p,
						'StashEmailMsg_msg_id_ref' => $m,
						'StashEmailMsg_has_ques' => $q,
						'StashEmailMsg_time' => $t,
						'StashEmailMsg_opened' => 0,
						'StashEmailMsg_response' => 0,
						'StashEmailMsg_status' => 1
					);
			$this->db->insert("stash-email-message", $d);
		}

		/*public function insertSendSMS($refs = [], $msg = ''){
			$data = array(
						'StashSMS_id' => null,
						'StashSMS_send_by' => $this->session->userdata("StaSh_User_id"),
						'StashSMS_send_to' => json_encode($refs),
						'StashSMS_message' => $msg, 
						'StashSMS_time' => time(),
						'StashSMS_status' => 1
					);
			$this->db->insert("stash-sms", $data);
			return $this->db->insert_id();
		}*/

		public function insertSendSMS($a = 0, $m = 0, $p = 0, $q = 0, $t = 0, $l = ''){
			$d = array(
						'StashSMSMsg_id' => null,
						'StashSMSMsg_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashSMSMsg_actor_id_ref' => $a,
						'StashSMSMsg_msg_id_ref' => $m,
						'StashSMSMsg_project_id_ref' => $p,
						'StashSMSMsg_has_ques' => $q,
						'StashSMSMsg_link' => $l,
						'StashSMSMsg_time' => $t,
						'StashSMSMsg_opened' => 0,
						'StashSMSMsg_response' => 0,
						'StashSMSMsg_status' => 1
					);
			$this->db->insert("stash-sms-message", $d);
		}

		public function checkUniqueLink($l = ''){
			$this->db->where("StashSMSMsg_link", $l);
			return $this->db->get("stash-sms-message", 1)->num_rows();
		}
		
		public function updateCountAudSMS($count = 0, $type = 'invite', $mode = 'email'){
			$data = array(
						'StashSMSEmailCounts_id' => null,
						'StashSMSEmailCounts_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashSMSEmailCounts_contact_type' => $type,
						'StashSMSEmailCounts_contact_mode' => $mode,
						'StashSMSEmailCounts_count' => $count,
						'StashSMSEmailCounts_timestamp' => time(),
						'StashSMSEmailCounts_ip' => $this->input->ip_address()
					);
			$this->db->insert("stash-sms-email-counts", $data);
		}

		public function getSkillIDs($skills = ''){
			$skills = explode(",", $skills);
			$this->db->where_in("StashSkills_title", $skills);
			$this->db->select("StashSkills_id");
			$query = $this->db->get("stash-skills");
			$fetched = $query->result('array');
			$skillIds = [];
			foreach ($fetched as $key => $value) 
				$skillIds[] = $value['StashSkills_id'];
			return $skillIds;
		}

		public function filteredBySKill($actors = [], $skills = []){
			$skills = (count($skills)) ? $skills : [''];
			$this->db->where_in("StashActorSkill_skill_id_ref", $skills);
			$this->db->where_in("StashActorSkill_actor_id_ref", $actors);
			$query = $this->db->get("stash-actor-skill");
			$fetched = $query->result('array');
			$filtered = [];
			foreach ($fetched as $key => $value) 
				$filtered[] = $value['StashActorSkill_actor_id_ref'];
			return $filtered;
		}

		public function finalFilter($filter = []){
			$data = array();

			if($filter['minAge'] != ''){
				$data['StashActor_dob <= '] = $filter['minAge'];
			}

			if($filter['maxAge'] != ''){
				$data['StashActor_dob >= '] = $filter['maxAge'];
			}

			if($filter['minHeight'] != ''){
				$data['StashActor_height >= '] = $filter['minHeight'];
			}

			if($filter['maxHeight'] != ''){
				$data['StashActor_height <= '] = $filter['maxHeight'];
			}

			$this->db->where($data);
			$this->db->like("StashActor_gender", $filter['sex'], 'both');
			$this->db->where_in('StashActor_actor_id_ref', $filter['in']);
			$names = explode(',', $filter['names']);
			foreach($names as $name){
				$this->db->like("StashActor_name", $name, "both");
			}
			
			//return $query = $this->db->get_compiled_select("stash-actor");
			

			$query = $this->db->get("stash-actor");
			$result = [];
			$actors = $query->result('array');
			foreach ($actors as $key => $actor) {
				$actor['StashActor_sex'] = ($actor['StashActor_gender']) ? "M" : "F";
				$actor['StashActor_age'] = $this->calculateAge($actor['StashActor_dob']);
				$actor['StashActor_range'] = $actor['StashActor_min_role_age'] . " - " . $actor['StashActor_max_role_age'];
				$actor['StashActor_language'] = $this->getActorLanguage($actor['StashActor_actor_id_ref']);
				$actor['StashActor_skills'] = $this->getActorSkills($actor['StashActor_actor_id_ref']);
				$actor['StashActor_projects'] = $this->getActorProjects($actor['StashActor_actor_id_ref']);
				$result[] = $actor;
			}

			return $result;
		}

		public function insertNewPorject($name = '', $date = ''){
			$data = array(
						"StashProject_id" => null,
						"StashProject_director_id_ref" => $this->session->userdata("StaSh_User_id"),
						"StashProject_name" => $name,
						"StashProject_date" => strtotime($date),
						"StashProject_tag" => $name . '_' . $date,
						"StashProject_time" => time(),
						"StashProject_status" => 1
					);
			$this->db->insert("stash-project", $data);
			return $this->db->insert_id();
		}

		/*public function insertInvitationMail($data = []){
			$data = array(
						'StashEmailInvite_id' => null,
						'StashEmailInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashEmailInvite_emails' => $data['emails'],
						'StashEmailInvite_message' => $data['msg'],
						'StashEmailInvite_project_id_ref' => $data['project_id'],
						'StashEmailInvite_time' => time()
					);
			$this->db->insert("stash-email-invitation", $data);
			return $this->db->insert_id();
		}*/

		public function insertInvitationMail( $e = '', $m = 0, $p = 0, $t = 'invite', $l = '' ){
			$d = array(
						'StashEmailInvite_id' => null,
						'StashEmailInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashEmailInvite_email' => $e,
						'StashEmailInvite_msg_id_ref' => $m,
						'StashEmailInvite_project_id_ref' => $p,
						'StashEmailInvite_time' => time(),
						'StashEmailInvite_link' => $l,
						'StashEmailInvite_type' => $t,
						'StashEmailInvite_status' => 0,
						'StashEmailInvite_opened' => 0
					);
			$this->db->insert("stash-email-invites", $d);
		}

		public function insertFailedInvitations($e = [], $m = 0, $p = 0, $t = 'invite', $ti = 0){
			$time = ($ti) ? $ti : time();
			$data = array(
						'StashFailedInvite_id' => null,
						'StashFailedInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashFailedInvite_msg' => $m,
						'StashFailedInvite_project' => $p,
						'StashFailedInvite_emails' => json_encode($e),
						'StashFailedInvite_type' => $t,
						'StashFailedInvite_time' => $time
					);
			$this->db->insert("stash-failed-invitation", $data);
		}

		public function getProject($name = '', $data = ''){
			$this->db->where("StashProject_name", trim($name));
			$this->db->where("StashProject_date", strtotime(trim($data)));
			$query = $this->db->get("stash-project");
			return $query->first_row('array');
		}
		
		/*public function insertInvitationSMS($data = []){
			$data = array(
						'StashSMSInvite_id' => null,
						'StashSMSInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashSMSInvite_mobiles' => $data['mobiles'],
						'StashSMSInvite_message' => $data['msg'],
						'StashSMSInvite_project_id_ref' => $data['project_id'],
						'StashSMSInvite_time' => time()
					);
			$this->db->insert("stash-sms-invitation", $data);
			return $this->db->insert_id();
		}*/

		public function insertInvitationSMS($m = '', $l = '', $p = 0, $mob = ''){
			$d = array(
						'StashSMSInvites_id' => null,
						'StashSMSInvites_mobile' => $mob,
						'StashSMSInvites_msg_id' => $m,
						'StashSMSInvites_actor_id_ref' => 0,
						'StashSMSInvites_link' => $l,
						'StashSMSInvites_project_id_ref' => $p,
						'StashSMSInvites_time' => time(),
						'StashSMSInvites_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashSMSInvites_status' => 0,
						'StashSMSInvites_opened' => 0
					);
			$this->db->insert("stash-sms-invites", $d);
		}

		public function insertSMSMsg($msg = '', $type = 'sms', $sub = "SMS Invitation."){
			$d = array(
						'StashInviteMsg_id' => null,
						'StashInviteMsg_subject' => $sub,
						'StashInviteMsg_message' => $msg,
						'StashInviteMsg_type' => $type,
						'StashInviteMsg_status' => 1
					);
			$this->db->insert("stash-invite-msg", $d);
			return $this->db->insert_id();
		}
		
		public function filterByProject($project = ''){
			$project = explode(",", $project);
			foreach($project as $proj){
				$this->db->like("StashProject_name", trim($proj), "both");
			}
			$this->db->where("StashProject_director_id_ref", $this->session->userdata("StaSh_User_id"));
			//return $query = $this->db->get_compiled_select("stash-project");
			$query = $this->db->get("stash-project");
			$result = [];
			$fetch = $query->result("array");
			foreach($fetch as $f){
				$result[] = $f['StashProject_id'];
			}
			
			return $this->getActorWithPorjectTag($result);
		}
		
		public function getActorWithPorjectTag($projects = []){
			$this->db->where_in("StashActorProject_project_id_ref", $projects);
			$fetch = $this->db->get("stash-actor-project")->result("array");
			$result = [];
			foreach($fetch as $f){
				$result[] = $f['StashActorProject_actor_id_ref'];
			}
			return $result;
		}
		
		public function getAdminConfirmation(){
			$this->db->where("StashDirectorAllowed_director_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->where("StashDirectorAllowed_status", 1);
			$query = $this->db->get("stash-direction-allowed");
			return ($query->num_rows() > 0) ? true : false;
		}
		
		public function getInvitationEmailCount($ref = 0){
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			$query = $this->db->get("stash-email-invitation");
			$result = [];
			$fetch = $query->result("array");
			$count = 0;
			foreach($fetch as $f){
				$email = count(explode(",", $f['StashEmailInvite_emails']));
				$count += $email;
			}
			return $count;
		}
		
		public function getInvitationSMSCount($ref = 0){
			$this->db->where("StashSMSInvite_director_id_ref", $ref);
			$query = $this->db->get("stash-sms-invitation");
			$result = [];
			$fetch = $query->result("array");
			$count = 0;
			foreach($fetch as $f){
				$mob = count(explode(",", $f['StashSMSInvite_mobiles']));
				$count += $mob;
			}
			return $count;
		}
		
		public function insertSMSInviteLink($pid = 0, $link = ''){
			$data = array(
						"StashSMSInviteLink_id" => null,
						"StashSMSInviteLink_link" => $link,
						"StashSMSInviteLink_project" => $pid,
						"StashSMSInviteLink_status" => 0,
						"StashSMSInviteLink_director_id_ref" => $this->session->userdata("StaSh_User_id")
					);
			$this->db->insert("stash-sms-invite-link", $data);
		}
		
		public function checkRandLink($link = ''){
			$this->db->where("StashSMSInvites_link", $link);
			$query = $this->db->get("stash-sms-invites");
			return $query->num_rows();
		}

		public function checkEmailRandLink($link = ''){
			$this->db->where("StashEmailInvite_link", $link);
			$query = $this->db->get("stash-email-invites");
			return $query->num_rows();
		}

		public function checkRegsiteredEmails($emails = []){
			$this->db->where_in("StashUsers_email", $emails);
			$query = $this->db->get("stash-users");
			$fetch = $query->result('array');
			$result = [];
			foreach ($fetch as $key => $f) {
				$result[] = $f['StashUsers_email'];
			}
			return $result;
		}

		public function getEmailFromDirectorDB(){
			$this->db->select("StashUsers_email");
			$this->db->from("stash-users as Users");
			$this->db->join("stash-director-actor-link as DALink", "DALink.StashDirectorActorLink_actor_id_ref = Users.StashUsers_id");
			$this->db->where("DALink.StashDirectorActorLink_director_id_ref", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			foreach ($fetch as $key => $f) {
				$result[] = $f['StashUsers_email'];
			}

			return $result;
		}

		public function getMobileFromDirectorDB(){
			$this->db->select("StashUsers_mobile");
			$this->db->from("stash-users as Users");
			$this->db->join("stash-director-actor-link as DALink", "DALink.StashDirectorActorLink_actor_id_ref = Users.StashUsers_id");
			$this->db->where("DALink.StashDirectorActorLink_director_id_ref", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get();
			$result = [];
			$fetch = $query->result('array');
			foreach ($fetch as $key => $f) {
				$result[] = $f['StashUsers_mobile'];
			}

			return $result;
		}

		public function getLastMessage($from = 'email', $ref = 0, $offset = 0){
			$result = [];
			if( $from == 'email' ){
				$data = $this->lastInviteEmails( $ref, $offset );
				if(count($data)){
					$msg = $this->getThisMessage($data['StashEmailInvite_msg_id_ref']);
					$result['msg'] = $msg['StashInviteMsg_message'];
					$result['date'] = "Sent on: " . date("d/m/Y", $data['StashEmailInvite_time']);
				}
			}else{
				$data = $this->lastInviteSMS( $ref, $offset );
				if(count($data)){
					$msg = $this->getThisMessage($data['StashSMSInvites_msg_id']);
					$result['msg'] = $msg['StashInviteMsg_message'];// . "__" . $msg['StashInviteMsg_id'];
					$result['date'] = "Sent on: " . date("d/m/Y", $data['StashSMSInvites_time']);
				}
			}
			return $result;
		}

		public function lastInviteSMS($ref = 0, $off = 0){
			$this->db->distinct();
			$this->db->select("StashSMSInvites_msg_id, StashSMSInvites_time");
			$this->db->from("stash-sms-invites");
			$this->db->where("StashSMSInvites_director_id_ref", $ref);
			$this->db->order_by("StashSMSInvites_id", "DESC");
			$this->db->limit(1, $off);
			return $fetch = $this->db->get()->first_row('array');
		}

		public function lastInviteEmails($ref = 0, $off = 0){
			$this->db->distinct();
			$this->db->select("StashEmailInvite_msg_id_ref, StashEmailInvite_time");
			$this->db->from("stash-email-invites");
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			$this->db->order_by("StashEmailInvite_id", "DESC");
			$this->db->limit(1, $off);
			return $fetch = $this->db->get()->first_row('array');
		}

		public function getThisMessage($ref = 0){
			$this->db->where("StashInviteMsg_id", $ref);
			return $this->db->get("stash-invite-msg", 1)->first_row("array");
		}

		public function getUserBascis($field = 'StashActor_email', $val, $select = "*"){
			$this->db->select( $select );
			$this->db->from("stash-actor");
			$this->db->where($field, $val);
			return $this->db->get()->first_row('array');
		}

		public function inviteEmailList($ref = 0){
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			$fetch = $this->db->get("stash-email-invites")->result("array");
			$count = count($fetch);
			$result = [];
			$found = $msg = false;
			$uniques = [];
			foreach ($fetch as $key => $f) {
				//print_r($f);
				if( !in_array($f['StashEmailInvite_msg_id_ref'], $uniques) ){
					$uniques[] = $f['StashEmailInvite_msg_id_ref'];
					$found = $msg = false;
				}
				$id = array_search( $f['StashEmailInvite_msg_id_ref'], $uniques );
				if( !isset($result[$id]['others']) ){
					$result[$id]['others'] = 0;
					$result[$id]['date'] = $this->timeElapsedString($f['StashEmailInvite_time']);
					$result[$id]['time'] = $f['StashEmailInvite_time'];
					$result[$id]['id'] = $f['StashEmailInvite_id'];
					$result[$id]['first'] = $f['StashEmailInvite_email'];
				}else{
					$result[$id]['others'] += 1;
				}
				if(!$found){
					$user = $this->getUserBascis("StashActor_email", $f['StashEmailInvite_email'], "StashActor_actor_id_ref, StashActor_name, StashActor_email, StashActor_avatar");
					if(count($user)){
						$u = array('name' => $user['StashActor_name'], 'contact' => $user['StashActor_email'], 'id' => $user['StashActor_actor_id_ref'], 'avatar' => $user['StashActor_avatar']);
						$result[$id]['firstUser'] = $u;
						$found = true;
					}
				}

				if(!$msg){
					$m = $this->getThisMessage( $f['StashEmailInvite_msg_id_ref'] );
					$result[$id]['subject'] = [$m['StashInviteMsg_id'], $m['StashInviteMsg_subject']];
					$msg = true;
				}
			}
			return $result;
		}

		public function inviteSMSList($ref = 0){
			$this->db->where("StashSMSInvites_director_id_ref", $ref);
			$fetch = $this->db->get("stash-sms-invites")->result("array");
			$result = $uniques = [];
			$found = $msg = false;
			foreach ($fetch as $key => $f) {
				if( !in_array($f['StashSMSInvites_msg_id'], $uniques) ){
					$uniques[] = $f['StashSMSInvites_msg_id'];
					$found = $msg = false;
				}
				$id = array_search( $f['StashSMSInvites_msg_id'], $uniques );
				if( !isset($result[$id]['others']) ){
					$result[$id]['others'] = 0;
					$result[$id]['date'] = $this->timeElapsedString($f['StashSMSInvites_time']);
					$result[$id]['time'] = $f['StashSMSInvites_time'];
					$result[$id]['id'] = $f['StashSMSInvites_id'];
					$result[$id]['first'] = $f['StashSMSInvites_mobile'];
				}else{
					$result[$id]['others'] += 1;
				}
				if(!$found){
					$user = $this->getUserBascis("StashActor_mobile", $f['StashSMSInvites_mobile'], "StashActor_actor_id_ref, StashActor_name, StashActor_mobile, StashActor_avatar");
					if(count($user)){
						$u = array('name' => $user['StashActor_name'], 'contact' => $user['StashActor_mobile'], 'id' => $user['StashActor_actor_id_ref'], 'avatar' => $user['StashActor_avatar']);
						$result[$id]['firstUser'] = $u;
						$found = true;
					}
				}

				if(!$msg){
					$m = $this->getThisMessage( $f['StashSMSInvites_msg_id'] );
					$result[$id]['subject'] = [$m['StashInviteMsg_id'], $m['StashInviteMsg_subject']];
					$msg = true;
				}
			}
			return $result;

		}

		public function contactEmailList($ref = 0){
			$this->db->where("StashEmailMsg_director_id_ref", $ref);
			$fetch = $this->db->get("stash-email-message")->result("array");
			$result = $uniques = [];
			$found = $msg = false;
			foreach ($fetch as $key => $f) {
				if( !in_array($f['StashEmailMsg_msg_id_ref'], $uniques) ){
					$uniques[] = $f['StashEmailMsg_msg_id_ref'];
					$found = $msg = false;
				}
				$id = array_search( $f['StashEmailMsg_msg_id_ref'], $uniques );
				if( !isset($result[$id]['others']) ){
					$result[$id]['others'] = 0;
					$result[$id]['date'] = $this->timeElapsedString($f['StashEmailMsg_time']);
					$result[$id]['time'] = $f['StashEmailMsg_time'];
					$result[$id]['id'] = $f['StashEmailMsg_id'];
					$result[$id]['first'] = "Actor";
				}else{
					$result[$id]['others'] += 1;
				}
				if(!$found){
					$user = $this->getUserBascis("StashActor_actor_id_ref", $f['StashEmailMsg_actor_id_ref'], "StashActor_actor_id_ref, StashActor_name, StashActor_email, StashActor_avatar");
					if(count($user)){
						$u = array('name' => $user['StashActor_name'], 'contact' => $user['StashActor_email'], 'id' => $user['StashActor_actor_id_ref'], 'avatar' => $user['StashActor_avatar']);
						$result[$id]['firstUser'] = $u;
						$found = true;
					}
				}

				if(!$msg){
					$m = $this->getThisMessage( $f['StashEmailMsg_msg_id_ref'] );
					$result[$id]['subject'] = [$m['StashInviteMsg_id'], $m['StashInviteMsg_subject']];
					$msg = true;
				}
			}
			return $result;
		}

		public function contactSMSList($ref = ''){
			$this->db->where("StashSMSMsg_director_id_ref", $ref);
			$fetch = $this->db->get("stash-sms-message")->result("array");
			$result = $uniques = [];
			$found = $msg = false;
			foreach ($fetch as $key => $f) {
				if( !in_array($f['StashSMSMsg_msg_id_ref'], $uniques) ){
					$uniques[] = $f['StashSMSMsg_msg_id_ref'];
					$found = $msg = false;
				}
				$id = array_search( $f['StashSMSMsg_msg_id_ref'], $uniques );
				if( !isset($result[$id]['others']) ){
					$result[$id]['others'] = 0;
					$result[$id]['date'] = $this->timeElapsedString($f['StashSMSMsg_time']);
					$result[$id]['time'] = $f['StashSMSMsg_time'];
					$result[$id]['id'] = $f['StashSMSMsg_id'];
					$result[$id]['first'] = "Actor";
				}else{
					$result[$id]['others'] += 1;
				}
				if(!$found){
					$user = $this->getUserBascis("StashActor_actor_id_ref", $f['StashSMSMsg_actor_id_ref'], "StashActor_actor_id_ref, StashActor_name, StashActor_mobile, StashActor_avatar");
					if(count($user)){
						$u = array('name' => $user['StashActor_name'], 'contact' => $user['StashActor_mobile'], 'id' => $user['StashActor_actor_id_ref'], 'avatar' => $user['StashActor_avatar']);
						$result[$id]['firstUser'] = $u;
						$found = true;
					}
				}

				if(!$msg){
					$m = $this->getThisMessage( $f['StashSMSMsg_msg_id_ref'] );
					$result[$id]['subject'] = [$m['StashInviteMsg_id'], $m['StashInviteMsg_subject']];
					$msg = true;
				}
			}
			return $result;
		}

		public function fetchInviteEmailData($ref = 0, $id = 0){
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			$this->db->where("StashEmailInvite_id", $id);
			$fetch = $this->db->get("stash-email-invites", 1)->first_row('array');
			return $this->fetchAndFilterIEmailData( $fetch );
		}

		public function fetchAndFilterIEmailData($data = []){
			$this->db->where("StashEmailInvite_director_id_ref", $data['StashEmailInvite_director_id_ref']);
			$this->db->where("StashEmailInvite_msg_id_ref", $data['StashEmailInvite_msg_id_ref']);
			$this->db->where("StashEmailInvite_project_id_ref", $data['StashEmailInvite_project_id_ref']);
			$fetch = $this->db->get("stash-email-invites")->result("array");
			$recipient = count($fetch);
			$result = [];
			$o = $s = 0;
			$msg = $this->getThisMessage( $data['StashEmailInvite_msg_id_ref'] );
			$msg = [$msg['StashInviteMsg_id'], $msg['StashInviteMsg_subject'], $msg['StashInviteMsg_message'] ];
			foreach ($fetch as $key => $f) {
				if( $f['StashEmailInvite_opened'])
					$o++;

				if($f['StashEmailInvite_status']){
					$d = $this->getUserBascis("StashActor_email", $f['StashEmailInvite_email'], "StashActor_actor_id_ref, StashActor_name, StashActor_email, StashActor_avatar");
					if( count($d) )
						$result['users'][] = [ 'name' => $d['StashActor_name'], 'contact' => $d['StashActor_email'], 'avatar' => $d['StashActor_avatar'], 'id' => $d['StashActor_actor_id_ref'], 'status' => 'joined', 'label' => 'success' ];
					else
						if($f['StashEmailInvite_opened'])
							$result['users'][] = [ 'name' => $f['StashEmailInvite_email'], 'contact' => $f['StashEmailInvite_email'], 'status' => 'seen', 'label' => 'warning' ];
						else
							$result['users'][] = [ 'name' => $f['StashEmailInvite_email'], 'contact' => $f['StashEmailInvite_email'], 'status' => 'pending', 'label' => 'danger' ];
					$s++;
				}else{
					$result['users'][] = [ 'name' => $f['StashEmailInvite_email'], 'contact' => $f['StashEmailInvite_email'], 'status' => 'pending', 'label' => 'danger' ];
				}

				if( $f['StashEmailInvite_opened'] && $f['StashEmailInvite_status'] )
					$o--;
			}
			$result['recipient'] = $recipient;
			$result['responded'] = $o + $s;
			$result['seen'] = $o;
			$result['used'] = $s;
			$result['msg'] = $msg;
			$result['pending'] = $recipient - $s;

			return $result;
		}

		public function fetchInviteSMSData($ref = 0, $id = 0){
			$this->db->where("StashSMSInvites_director_id_ref", $ref);
			$this->db->where("StashSMSInvites_id", $id);
			$fetch = $this->db->get("stash-sms-invites", 1)->first_row('array');
			return $this->fetchAndFilterISMSData( $fetch );
		}

		public function fetchAndFilterISMSData($data = []){
			$this->db->where("StashSMSInvites_director_id_ref", $data['StashSMSInvites_director_id_ref']);
			$this->db->where("StashSMSInvites_msg_id", $data['StashSMSInvites_msg_id']);
			$this->db->where("StashSMSInvites_project_id_ref", $data['StashSMSInvites_project_id_ref']);
			$fetch = $this->db->get("stash-sms-invites")->result("array");
			$recipient = count($fetch);
			$result = [];
			$o = $s = 0;
			$msg = $this->getThisMessage( $data['StashSMSInvites_msg_id'] );
			$msg = [$msg['StashInviteMsg_id'], $msg['StashInviteMsg_subject'], $msg['StashInviteMsg_message'] ];
			foreach ($fetch as $key => $f) {
				if( $f['StashSMSInvites_opened'])
					$o++;

				if($f['StashSMSInvites_status']){
					$d = $this->getUserBascis("StashActor_mobile", $f['StashSMSInvites_mobile'], "StashActor_actor_id_ref, StashActor_name, StashActor_mobile, StashActor_avatar");
					if( count($d) )
						$result['users'][] = [ 'name' => $d['StashActor_name'], 'contact' => $d['StashActor_mobile'], 'avatar' => $d['StashActor_avatar'], 'id' => $d['StashActor_actor_id_ref'], 'status' => 'joined', 'label' => 'success' ];
					else
						if($f['StashSMSInvites_opened'])
							$result['users'][] = [ 'name' => $f['StashSMSInvites_mobile'], 'contact' => $f['StashSMSInvites_mobile'], 'status' => 'seen', 'label' => 'warning' ];
						else
							$result['users'][] = [ 'name' => $f['StashSMSInvites_mobile'], 'contact' => $f['StashSMSInvites_mobile'], 'status' => 'pending', 'label' => 'danger' ];
					$s++;
				}else{
					$result['users'][] = [ 'name' => $f['StashSMSInvites_mobile'], 'contact' => $f['StashSMSInvites_mobile'], 'status' => 'pending', 'label' => 'danger' ];
				}

				if( $f['StashSMSInvites_opened'] && $f['StashSMSInvites_status'] )
					$o--;
			}
			$result['recipient'] = $recipient;
			$result['responded'] = $o + $s;
			$result['seen'] = $o;
			$result['used'] = $s;
			$result['msg'] = $msg;
			$result['pending'] = $recipient - $s;

			return $result;
		}

		public function fetchContactEmailData($ref = 0, $id = 0){
			$this->db->where("StashEmailMsg_director_id_ref", $ref);
			$this->db->where("StashEmailMsg_id", $id);
			$fetch = $this->db->get("stash-email-message", 1)->first_row('array');
			return $this->fetchAndFilterCEmailData( $fetch );
		}

		public function fetchAndFilterCEmailData($data = []){
			$this->db->where("StashEmailMsg_director_id_ref", $data['StashEmailMsg_director_id_ref']);
			$this->db->where("StashEmailMsg_msg_id_ref", $data['StashEmailMsg_msg_id_ref']);
			$this->db->where("StashEmailMsg_project_id_ref", $data['StashEmailMsg_project_id_ref']);
			$this->db->where("StashEmailMsg_time", $data['StashEmailMsg_time']);
			$fetch = $this->db->get("stash-email-message")->result("array");
			$recipient = count($fetch);
			$result = [];
			$o = $s = $y = $n = $mb = 0;
			$msg = $this->getThisMessage( $data['StashEmailMsg_msg_id_ref'] );
			$msg = [$msg['StashInviteMsg_id'], $msg['StashInviteMsg_subject'], $msg['StashInviteMsg_message'] ];
			foreach ($fetch as $key => $f) {
				$st = "not seen";
				$lb = "default";
				if( $f['StashEmailMsg_opened']){
					$st = "seen";
					$lb = "primary";
					$o++;
				}

				
				if( $f['StashEmailMsg_response'] == 1 ){
					$y++;
					$st = "Yes";
					$lb = "success";
					$s++;
				}elseif( $f['StashEmailMsg_response'] == 2 ){
					$n++;
					$st = "No";
					$lb = "danger";$s++;
				}elseif($f['StashEmailMsg_response'] == 3){
					$mb++;
					$st = "May be";
					$lb = "warning";$s++;
				}

				$d = $this->getUserBascis("StashActor_actor_id_ref", $f['StashEmailMsg_actor_id_ref'], "StashActor_actor_id_ref, StashActor_name, StashActor_email, StashActor_avatar");
				$result['users'][] = [ 
										'name' => $d['StashActor_name'], 
										'contact' => $d['StashActor_email'], 
										'avatar' => $d['StashActor_avatar'], 
										'id' => $d['StashActor_actor_id_ref'], 
										'status' => $st, 
										'label' => $lb 
									];

				if( $f['StashEmailMsg_opened'] && $f['StashEmailMsg_response'] )
					$o--;
			}
			$result['recipient'] = $recipient;
			$result['responded'] = $s;
			$result['seen'] = $o;
			$result['yes'] = $y;
			$result['no'] = $n;
			$result['maybe'] = $mb;
			$result['msg'] = $msg;
			$result['pending'] = $recipient - $s;

			return $result;
		}

		public function fetchContactSMSData($ref = 0, $id = 0){
			$this->db->where("StashSMSMsg_director_id_ref", $ref);
			$this->db->where("StashSMSMsg_id", $id);
			$fetch = $this->db->get("stash-sms-message", 1)->first_row('array');
			return $this->fetchAndFilterCSMSData( $fetch );
		}

		public function fetchAndFilterCSMSData($data = []){
			$this->db->where("StashSMSMsg_director_id_ref", $data['StashSMSMsg_director_id_ref']);
			$this->db->where("StashSMSMsg_msg_id_ref", $data['StashSMSMsg_msg_id_ref']);
			$this->db->where("StashSMSMsg_project_id_ref", $data['StashSMSMsg_project_id_ref']);
			$this->db->where("StashSMSMsg_time", $data['StashSMSMsg_time']);
			$fetch = $this->db->get("stash-sms-message")->result("array");
			$recipient = count($fetch);
			$result = [];
			$o = $s = $y = $n = $mb = 0;
			$msg = $this->getThisMessage( $data['StashSMSMsg_msg_id_ref'] );
			$msg = [$msg['StashInviteMsg_id'], $msg['StashInviteMsg_subject'], $msg['StashInviteMsg_message'] ];
			foreach ($fetch as $key => $f) {
				$st = "not seen";
				$lb = "default";
				if( $f['StashSMSMsg_opened']){
					$st = "seen";
					$lb = "primary";
					$o++;
				}

				
				if( $f['StashSMSMsg_response'] == 1 ){
					$y++;
					$st = "Yes";
					$lb = "success";
					$s++;
				}elseif( $f['StashSMSMsg_response'] == 2 ){
					$n++;
					$st = "No";
					$lb = "danger";$s++;
				}elseif($f['StashSMSMsg_response'] == 3){
					$mb++;
					$st = "May be";
					$lb = "warning";$s++;
				}

				$d = $this->getUserBascis("StashActor_actor_id_ref", $f['StashSMSMsg_actor_id_ref'], "StashActor_actor_id_ref, StashActor_name, StashActor_mobile, StashActor_avatar");
				$result['users'][] = [ 
										'name' => $d['StashActor_name'], 
										'contact' => $d['StashActor_mobile'], 
										'avatar' => $d['StashActor_avatar'], 
										'id' => $d['StashActor_actor_id_ref'], 
										'status' => $st, 
										'label' => $lb 
									];

				if( $f['StashSMSMsg_opened'] && $f['StashSMSMsg_response'] )
					$o--;
			}
			$result['recipient'] = $recipient;
			$result['responded'] = $s;
			$result['seen'] = $o;
			$result['yes'] = $y;
			$result['no'] = $n;
			$result['maybe'] = $mb;
			$result['msg'] = $msg;
			$result['pending'] = $recipient - $s;

			return $result;
		}

		public function timeElapsedString($ptime){
		    $etime = time() - $ptime;

		    if ($etime < 1){
		        return '0 seconds';
		    }

		    $a = array( 365 * 24 * 60 * 60  =>  'year',
		                 30 * 24 * 60 * 60  =>  'month',
		                      24 * 60 * 60  =>  'day',
		                           60 * 60  =>  'hour',
		                                60  =>  'minute',
		                                 1  =>  'second'
		                );
		    $a_plural = array( 'year'   => 'years',
		                       'month'  => 'months',
		                       'day'    => 'days',
		                       'hour'   => 'hours',
		                       'minute' => 'minutes',
		                       'second' => 'seconds'
		                );

		    foreach ($a as $secs => $str){
		        $d = $etime / $secs;
		        if ($d >= 1){
		            $r = round($d);
		            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
		        }
		    }
		}
	}

?>
