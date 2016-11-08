<?php

	class ModelActor extends CI_Model {

		public function getActorProfileById($ref = 0){
			$this->db->where("StashActor_actor_id_ref", $ref);
			$query = $this->db->get("stash-actor", 1);
			$result = $query->first_row('array');
			$result['StashActor_language'] = $this->getActorLanguage($ref);
			$result['StashActor_skills'] = $this->getActorSkills($ref);
			$result['StashActor_projects'] = $this->getActorProjects($ref);
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

		public function getActorExperienceById($ref = 0){
			$this->db->where("StashActorExperience_actor_id_ref", $ref);
			$this->db->where("StashActorExperience_status", 1);
			$query = $this->db->get("stash-actor-experience");
			return $query->result("array");
		}

		public function getActorTrainingById($ref = 0){
			$this->db->where("StashActorTraining_actor_id_ref", $ref);
			$this->db->where("StashActorTraining_status", 1);
			$query = $this->db->get("stash-actor-training");
			return $query->result("array");
		}

		public function calculateAge($dob = 0){
			$diff = abs(time() - $dob);
			$years = floor($diff / (365*60*60*24));
			return $years;
		}

		public function getDirectors($ref = 0){
			$this->db->where("StashDirectorActorLink_actor_id_ref", $ref);
			$this->db->where("StashDirectorActorLink_status", 1);
			$query = $this->db->get("stash-director-actor-link");
			$fetch = $query->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$result[] = array('id' => $f['StashDirectorActorLink_director_id_ref'], 
							'name' => $this->getUserName($f['StashDirectorActorLink_director_id_ref']));
			}

			return $result;
		}

		public function getUserName($ref = 0){
			$this->db->where("StashDirector_director_id_ref", $ref);
			$query = $this->db->get("stash-director");
			return $query->first_row('array')['StashDirector_name'];
		}

		public function updateUserProfile($data = []){
			$this->db->where("StashUsers_id", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-users", $data);
		}

		public function updateActorProfile($data = []){
			$this->db->where("StashActor_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-actor", $data);
		}

		public function getLanguageId($data = ''){
			$data = explode(",", $data);
			$ids = [];
			foreach ($data as $key => $lang) {
				if($id = $this->ifInLanguage(trim($lang))){
					$ids[] = $id;
				}else{
					$ids[] = $this->insertLanguage(trim($lang));
				}
			}

			return $ids;
		}

		public function ifInLanguage($value=''){
			$this->db->where("StashLanguages_title", $value);
			$query = $this->db->get("stash-languages");
			$result = $query->result("array");
			if(count($result))
				return $result[0]['StashLanguages_id'];
			else
				return 0;
		}

		public function insertLanguage($value=''){
			$data = array("StashLanguages_id" => null, "StashLanguages_title" => $value, "StashLanguages_status" => 1);
			$this->db->insert("stash-languages", $data);
			return $this->db->insert_id();
		}

		public function deleteOldLanguage($data = []){
			$this->db->where_not_in("StashActorLanguage_language_id_ref", $data);
			$this->db->where("StashActorLanguage_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->delete("stash-actor-language");
		}

		public function getActorLanguageIds($value=''){
			$this->db->where("StashActorLanguage_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get("stash-actor-language");
			$langs = $query->result("array");
			$result = [];
			foreach ($langs as $key => $value) {
				$result[] = $value['StashActorLanguage_language_id_ref'];
			}
			return $result;
		}

		public function updateActorLanguage($data = []){
			$d = array();
			foreach ($data as $key => $value) {
				$d[] = array(
						"StashActorLanguage_language_id_ref" => $value, 
						"StashActorLanguage_actor_id_ref" => $this->session->userdata("StaSh_User_id"),
						"StashActorLanguage_time" => time(),
						"StashActorLanguage_id" => null
					);
			}

			return $this->db->insert_batch("stash-actor-language", $d);
		}


		public function getSkillId($data = ''){
			$data = explode(",", $data);
			$ids = [];
			foreach ($data as $key => $lang) {
				if($id = $this->ifInSkill(trim($lang))){
					$ids[] = $id;
				}else{
					$ids[] = $this->insertSkill(trim($lang));
				}
			}

			return $ids;
		}

		public function ifInSkill($value=''){
			$this->db->where("StashSkills_title", $value);
			$query = $this->db->get("stash-skills");
			$result = $query->result("array");
			if(count($result))
				return $result[0]['StashSkills_id'];
			else
				return 0;
		}

		public function insertSkill($value=''){
			$data = array("StashSkills_id" => null, "StashSkills_title" => $value, "StashSkills_status" => 1);
			$this->db->insert("stash-skills", $data);
			return $this->db->insert_id();
		}

		public function deleteOldSkill($data = []){
			$this->db->where_not_in("StashActorSkill_Skill_id_ref", $data);
			$this->db->where("StashActorSkill_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->delete("stash-actor-skill");
		}

		public function getActorSkillIds($value=''){
			$this->db->where("StashActorSkill_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get("stash-actor-skill");
			$langs = $query->result("array");
			$result = [];
			foreach ($langs as $key => $value) {
				$result[] = $value['StashActorSkill_skill_id_ref'];
			}
			return $result;
		}

		public function updateActorSkill($data = []){
			$d = array();
			foreach ($data as $key => $value) {
				$d[] = array(
						"StashActorSkill_skill_id_ref" => $value, 
						"StashActorSkill_actor_id_ref" => $this->session->userdata("StaSh_User_id"),
						"StashActorSkill_time" => time(),
						"StashActorSkill_id" => null
					);
			}

			return $this->db->insert_batch("stash-actor-skill", $d);
		}

		public function insertExperience($data = []){
			$data = array(
						'StashActorExperience_id' => null,
						'StashActorExperience_actor_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashActorExperience_title' => $data['title'],
						'StashActorExperience_blurb' => $data['blurb'],
						'StashActorExperience_role' => $data['role'],
						'StashActorExperience_link' => $data['link'],
						'StashActorExperience_time' => time(),
						'StashActorExperience_verify' => 0,
						'StashActorExperience_status' => 1
					);
			return $this->db->insert("stash-actor-experience", $data);
		}

		public function updateExperience($data = []){
			$key = $data['key'];
			$ref = $data['table_ref'];
			$data = array(
						'StashActorExperience_title' => $data['ex_title_'.$key],
						'StashActorExperience_blurb' => $data['ex_blurb_'.$key],
						'StashActorExperience_role' => $data['ex_role_'.$key],
						'StashActorExperience_link' => $data['ex_link_'.$key]
					);
			$this->db->where("StashActorExperience_id", $ref);
			return $this->db->update("stash-actor-experience", $data);
		}

		public function insertTraining($data = []){
			$data = array(
						'StashActorTraining_id' => null,
						'StashActorTraining_actor_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashActorTraining_title' => $data['title'],
						'StashActorTraining_course' => $data['course'],
						'StashActorTraining_intitute_id_ref' => null,
						'StashActorTraining_trainer' => null,
						'StashActorTraining_blurb' => $data['blurb'],
						'StashActorTraining_start_time' => $data['start'],
						'StashActorTraining_end_time' => $data['end'],
						'StashActorTraining_time' => time(),
						'StashActorTraining_verify' => 0,
						'StashActorTraining_status' => 1
					);
					
			return $this->db->insert("stash-actor-training", $data);
		}

		public function updateTraining($data = []){
			$key = $data['key'];
			$ref = $data['table_ref'];
			$data = array(
						'StashActorTraining_title' => $data['tr_title_'. $key],
						'StashActorTraining_course' => $data['tr_course_'. $key],
						'StashActorTraining_blurb' => $data['tr_blurb_'. $key],
						'StashActorTraining_start_time' => $data['tr_start_'. $key],
						'StashActorTraining_end_time' => $data['tr_end_'. $key]
					);
			$this->db->where("StashActorTraining_id", $ref);
			return $this->db->update("stash-actor-training", $data);
		}

		public function updateActorImages($images = []){
			$this->db->where("StashActor_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-actor", array("StashActor_images" => json_encode($images)));
		}
		public function updateActorProfileStage($data){
			$this->db->where("StashActor_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-actor", array("StashActor_profile_completion_stage" => $data));
		}
		

		public function getActorImages($ref = 0){
			$this->db->select("StashActor_images");
			$this->db->where("StashActor_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get("stash-actor");
			$fetch = $query->first_row('array');
			return $fetch['StashActor_images'];
		}

		public function deleteExperience($exp = 0){
			$this->db->where("StashActorExperience_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->where("StashActorExperience_id", $exp);
			return $this->db->update("stash-actor-experience", array("StashActorExperience_status" => 0));
		}

		public function deleteTraining($trn = 0){
			$this->db->where("StashActorTraining_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->where("StashActorTraining_id", $trn);
			return $this->db->update("stash-actor-training", array("StashActorTraining_status" => 0));
		}
		
		public function isUsernameExist($username = ''){
			$this->db->where("StashUsers_username", $username);
			$query = $this->db->get("stash-users");
			return $query->num_rows();
		}
		
		public function updateUsername($username, $ref){
			$this->db->where("StashUsers_id", $ref);
			return $this->db->update("stash-users", array("StashUsers_username" => $username));
		}

		public function getSkillName($name = ''){
			$this->db->like("StashSkills_title", $name, "after");
			$this->db->where("StashSkills_status", 1);
			$query = $this->db->get("stash-skills");
			$fetch = $query->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$v['label'] = $f['StashSkills_title'];
				$v['value'] = $f['StashSkills_title'];
				$result[] = $v;
			}

			return $result;
		}

		public function getLanguageName($name = ''){
			$this->db->like("StashLanguages_title", $name, "after");
			$this->db->where("StashLanguages_status", 1);
			$query = $this->db->get("stash-languages");
			$fetch = $query->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$v['label'] = $f['StashLanguages_title'];
				$v['value'] = $f['StashLanguages_title'];
				$result[] = $v;
			}

			return $result;
		}

		public function getActorPlan($value= 1){
			$this->db->where("StashActorPlan_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			if($value)
				$this->db->where("StashActorPlan_status", 1);
			$this->db->ordeR_by("StashActorPlan_id", "DESC");
			return $this->db->get("stash-actor-plan", 1)->first_row('array');
		}

		public function actorProfile($value=''){
			$this->db->where("StashUsers_id", $this->session->userdata("StaSh_User_id"));
			$query = $this->db->get("stash-users");
			return $query->first_row('array');
		}

	}

?>
