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

		public function insertSendMail($refs = [], $msg = '', $sub = ''){
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
		}

		public function insertSendSMS($refs = [], $msg = ''){
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
		}
		
		public function updateCountAudSMS($count = 0, $ref = 0, $type = 'invite', $mode = 'email'){
			$data = array(
						'StashSMSEmailCounts_id' => null,
						'StashSMSEmailCounts_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashSMSEmailCounts_contact_id_ref' => $ref,
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

		public function insertInvitationMail($data = []){
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
		}

		public function getProject($name = '', $data = ''){
			$this->db->where("StashProject_name", trim($name));
			$this->db->where("StashProject_date", strtotime(trim($data)));
			$query = $this->db->get("stash-project");
			return $query->first_row('array');
		}
		
		public function insertInvitationSMS($data = []){
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
			$this->db->where("StashSMSInviteLink_link", $link);
			$query = $this->db->get("stash-sms-invite-link");
			$result = $query->result("array");
			if(count($result))
				return true;
			else
				return false;
		}
		public function checkRegsiteredEmails($emails = []){
			$this->db->where_in("StashUsers_email", $emails);
			$query = $this->get("stash-users");
			$fetch = $query->result('array');
			$result = [];
			foreach ($fetch as $key => $f) {
				$result[] = $f['StashUsers_email'];
			}
			return $result;
		}
	}

?>
