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

		public function updateAdminPassword($ref = 0, $pass = ''){
			$this->db->where("CstkoAdmins_id", $ref);
			return $this->db->update("cstko_admins", array( 'CstkoAdmins_password' => $pass ));
		}

		public function getUserDetails($type = ''){
			$this->db->where("StashUsers_type", $type);
			$this->db->order_by("StashUsers_id", "DESC");
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

		public function getAllAdmins($value=''){
			$fetch = $this->db->get("cstko_admins")->result('array');
			$result = [];
			foreach ($fetch as $key => $f) {
				$a = $this->getAdminName( $f['CstkoAdmins_added_by'] );
				$f['AddedByName'] = $a['CstkoAdmins_name'];
				$f['AddedBy'] = $a['CstkoAdmins_username'];
				$result[] = $f;
			}
			return $result;
		}

		public function getAdminName($ref = 0){
			$this->db->select("CstkoAdmins_name, CstkoAdmins_username");
			$this->db->from("cstko_admins");
			$this->db->where("CstkoAdmins_id", $ref);
			$result = $this->db->get()->first_row("array");
			return $result;
		}

		public function getThisAdminProfile($username = ''){
			$this->db->where("CstkoAdmins_username", $username);
			return $this->db->get("cstko_admins", 1)->first_row("array");
		}

		public function getAdminLastLogins($ref = 0){
			$this->db->where("CstkoAdminLoggin_admin_id_ref", $ref);
			return $this->db->get("cstko_admin_loggins", 10)->result("array");
		}

		public function insertAdmin($filename = ''){
			$pass = hash_hmac('sha512', "Castiko@123", $this->config->item("encryption_key"));
			if($this->input->post("auth") == 1)
				$desg = "Super Admin";
			elseif($this->input->post("auth") == 2)
				$desg = "Admin";
			else
				$desg = "Sub Admin";
			$data = array(
						'CstkoAdmins_id' => null,
						'CstkoAdmins_username' => $this->input->post("username"),
						'CstkoAdmins_password' => $pass,
						'CstkoAdmins_name' => $this->input->post("name"),
						'CstkoAdmins_designation' => $desg,
						'CstkoAdmins_email' => $this->input->post("email"),
						'CstkoAdmins_mobile' => $this->input->post("mobile"),
						'CstkoAdmins_avatar' => $filename,
						'CstkoAdmins_gender' => $this->input->post("gender"),
						'CstkoAdmins_added_by' => $this->session->userdata("CSTKO_Admin_id"),
						'CstkoAdmins_added_on' => time(),
						'CstkoAdmins_pages' => $this->input->post("allowedpages"),
						'CstkoAdmins_status' => 1,
						'CstkoAdmins_auth' => $this->input->post("auth"),
						'CstkoAdmins_last_login' => time()
					);
			return $this->db->insert( "cstko_admins", $data );
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

		public function countInvitationEmail($ref = 0){
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			$fetch = $this->db->get("stash-email-invitation")->result("array");
			$count = 0;
			foreach ($fetch as $key => $f) {
				$count += count(explode(",", $f['StashEmailInvite_emails']));
			}
			return $count;
		}

		public function countInvitationSMS($ref = 0){
			$this->db->where("StashSMSInvite_director_id_ref", $ref);
			$fetch = $this->db->get("stash-sms-invitation")->result("array");
			$count = 0;
			foreach ($fetch as $key => $f) {
				$count += count(explode(",", $f['StashSMSInvite_mobiles']));
			}
			return $count;
		}

		public function countComposedEmail($ref = 0){
			$this->db->where("StashEMail_send_by", $ref);
			$fetch = $this->db->get("stash-email")->result("array");
			$count = 0;
			foreach ($fetch as $key => $f) {
				$count += count(json_decode($f['StashEMail_to'], 1));
			}
			return $count;
		}

		public function countComposedSMS($ref = 0){
			$this->db->where("StashSMS_send_by", $ref);
			$fetch = $this->db->get("stash-sms")->result("array");
			$count = 0;
			foreach ($fetch as $key => $f) {
				$count += count(json_decode($f['StashSMS_send_to'], 1));
			}
			return $count;
		}

		public function allEmailInvitations($ref = 0){
			$this->db->where("StashEmailInvite_director_id_ref", $ref);
			return $this->db->get("stash-email-invitation")->result("array");
		}

		public function allSMSInvitations($ref = 0){
			$this->db->where("StashSMSInvite_director_id_ref", $ref);
			return $this->db->get("stash-sms-invitation")->result("array");
		}
	}

?>