<?php

	class ModelAdmin extends CI_Model {

		public function getAdminDetail($field = '', $value){
			$this->db->where($field, $value);
			$query = $this->db->get("cstko_admins", 1);
			return $query->first_row('array');
		}

		public function adminLoggined($ref = 0){
			$data = array(
						'CstkoAdminLoggin_id' => null,
						'CstkoAdminLoggin_admin_id_ref' => $ref,
						'CstkoAdminLoggin_time' => time(),
						'CstkoAdminLoggin_ip' => $this->input->ip_address(),
						'CstkoAdminLoggin_user_agent' => $this->agent->agent_string(),
						'CstkoAdminLoggin_logout' => 0
					);
			$this->db->insert("cstko_admin_loggins", $data);
		}

		public function setAdminLastLogin($ref = 0){
			$this->db->where("CstkoAdmins_id", $ref);
			return $this->db->update("cstko_admins", array( 'CstkoAdmins_last_login' => time() ));
		}

		public function getUserDetails($type = ''){
			$this->db->where("StashUsers_type", $type);
			$this->db->limit(20, 0);
			$query = $this->db->get("stash-users");
			return $query->result('array');
		}

		public function getDirectorProfile($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-users as Main");
			$this->db->join("stash-director as Profile", "Profile.StashDirector_director_id_ref = Main.StashUsers_id");
			$this->db->join("stash-direction-allowed Allowed", "Allowed.StashDirectorAllowed_director_id_ref = Main.StashUsers_id");
			$this->db->where("Main.StashUsers_id", $ref);
			$query = $this->db->get();
			return $query->first_row('array');
		}

		public function lastLogin($ref = 0){
			$this->db->where("StashLogins_user_id_ref", $ref);
			$this->db->order_by("StashLogins_id", "DESC");
			return $this->db->get("stash-logins", 10)->result("array");
		}

		public function getActorInList($ref = 0){
			$this->db->select("Act.StashActor_actor_id_ref, Act.StashActor_name, Act.StashActor_email, Act.StashActor_mobile, Act.StashActor_avatar, Link.StashDirectorActorLink_time, Link.StashDirectorActorLink_status");
			$this->db->from("stash-actor as Act");
			$this->db->join("stash-director-actor-link as Link", "Link.StashDirectorActorLink_actor_id_ref = Act.StashActor_actor_id_ref");
			$this->db->where("Link.StashDirectorActorLink_director_id_ref", $ref);
			return $this->db->get()->result('array');
		}

		public function getProfectsOfCD($ref = 0){
			$this->db->where( "StashProject_director_id_ref", $ref );
			$query = $this->db->get("stash-project");
			$fetch = $query->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$project = $f;
				$actors = $this->getActorIdInPorject( $f['StashProject_id'] );
				$result[] = [ 'project' => $project, 'actors' => $actors ];
			}
			return $result;
		}

		public function getActorIdInPorject($ref = 0){
			$this->db->where("StashActorProject_project_id_ref", $ref);
			return $this->db->get("stash-actor-project")->result("array");
		}

		public function getActorProfile($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-users as Main");
			$this->db->join("stash-actor as Profile", "Profile.StashActor_actor_id_ref = Main.StashUsers_id");
			$this->db->where("Main.StashUsers_id", $ref);
			$query = $this->db->get();
			return $query->first_row('array');
		}

		public function getActorExperience($ref = 0){
			$this->db->where( "StashActorExperience_actor_id_ref", $ref );
			return $this->db->get("stash-actor-experience")->result("array");
		}

		public function getActorTraining($ref = 0){
			$this->db->where( "StashActorTraining_actor_id_ref", $ref );
			return $this->db->get("stash-actor-training")->result("array");
		}

		public function getDirectorsOfActor($ref = 0){
			$this->db->select("Dir.StashDirector_director_id_ref, Dir.StashDirector_name, Dir.StashDirector_email, Dir.StashDirector_mobile,  Link.StashDirectorActorLink_time, Link.StashDirectorActorLink_status");
			$this->db->from("stash-director as Dir");
			$this->db->join("stash-director-actor-link as Link", "Link.StashDirectorActorLink_director_id_ref = Dir.StashDirector_director_id_ref");
			$this->db->where("Link.StashDirectorActorLink_actor_id_ref", $ref);
			return $this->db->get()->result('array');
		}

	}

?>