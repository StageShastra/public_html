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
				$result[] = $actor;
			}

			return $result;
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
		}

		public function getSkillIDs($skills = ''){
			$skills = explode(",", $skills);
			$this->db->where_in("StashActorSkills_title", $skills);
			$this->db->select("StashActorSkills_id");
			$query = $this->db->get("stash-skills");
			$fetched = $query->result('array');
			$skillIds = [];
			foreach ($fetched as $key => $value) 
				$skillIds[] = $value['StashActorSkills_id'];
			return $skillIds;
		}

		public function filteredBySKill($actors = [], $skills = []){
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
			$data = array(
						'StashActor_dob <= ' => $filter['minAge'],
						'StashActor_dob >= ' => $filter['maxAge'],
						'StashActor_height >= ' => $filter['minHeight'],
						'StashActor_height <= ' => $filter['maxHeight']
					);
			$this->db->where($data);
			$this->db->like("StashActor_gender", $filter['sex'], 'both');
			$this->db->where_in('StashActor_actor_id_ref', $filter['skills']);
			//return $query = $this->db->get_compiled_select("stash-actor");
			$query = $this->db->get("stash-actor");
			$result = [];
			$actors = $query->result('array');
			foreach ($actors as $key => $actor) {
				$actor['StashActor_sex'] = ($actor['StashActor_gender']) ? "M" : "F";
				$actor['StashActor_age'] = $this->calculateAge($actor['StashActor_dob']);
				$actor['StashActor_range'] = $actor['StashActor_min_role_age'] . " - " . $actor['StashActor_max_role_age'];
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

		public function sendInvitaionMail($data = []){
			$data = array(
						'StashEmailInvite_id' => null,
						'StashEmailInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashEmailInvite_emails' => $data['emails'],
						'StashEmailInvite_message' => $data['msg'],
						'StashEmailInvite_project_id_ref' => $data['project_id'],
						'StashEmailInvite_time' => time()
					);
			return $this->db->insert("stash-email-invitation", $data);
		}

		public function getProject($name = '', $data = ''){
			$this->db->where("StashProject_name", trim($name));
			$this->db->where("StashProject_date", strtotime(trim($data)));
			$query = $this->db->get("stash-project");
			return $query->first_row('array');
		}
	}

?>