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

		public function getAllPromos($value=''){
			$result = [];
			$fetch = $this->db->get("stash-promo")->result("array");
			foreach ($fetch as $key => $f) {
				$f['opened'] = $this->countPromoOpened($f['StashPromo_id']);
				$f['used'] = $this->countPromoUsed($f['StashPromo_id']);
				$a = $this->getAdminName( $f['StashPromo_admin_id_ref'] );
				$f['AddedByName'] = $a['CstkoAdmins_name'];
				$f['AddedBy'] = $a['CstkoAdmins_username'];
				$result[] = $f;
			}
			return $result;
		}

		public function countPromoOpened($ref = 0){
			$this->db->where("StashPromoOpen_promo_id_ref", $ref);
			return $this->db->get("stash-promo-opened")->num_rows();
		}

		public function countPromoUsed($ref = 0){
			$this->db->where("StashPromoUsed_promo_id_ref", $ref);
			return $this->db->get("stash-promo-used")->num_rows();
		}

		public function promoExist($l = ''){
			$this->db->where("StashPromo_code", $l);
			//$this->db->where("StashPromo_status", 1);
			return $this->db->get("stash-promo", 1)->num_rows();
		}

		public function getDirectorForAutoC($t = ''){
			$this->db->like("StashDirector_name", $t, "both");
			$this->db->or_like("StashDirector_email", $t, "both");
			$this->db->or_like("StashDirector_mobile", $t, "both");
			$fetch = $this->db->get("stash-director")->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$r['id'] = $f['StashDirector_director_id_ref'];
				$r['label'] = $r['value'] = $f['StashDirector_name'];
				$result[] = $r;
			}
			return $result;
		}

		public function getProjectsForAutoC($t = '', $in = []){
			$this->db->like("StashProject_name", $t, "both");
			if( count($in) )
				$this->db->where_in('StashProject_director_id_ref', $in);
			$fetch = $this->db->get("stash-project")->result("array");
			$result = [];
			foreach ($fetch as $key => $f) {
				$r['id'] = $f['StashProject_id'];
				$r['label'] = $r['value'] = $f['StashProject_name'] . " (" . date("d/M/Y", $f['StashProject_date']) . ")";
				$result[] = $r;
			}
			return $result;
		}

		public function addReferalCode($value=''){
			$d = array(
						'StashPromo_id' => null,
						'StashPromo_code' => $this->input->post("code"),
						'StashPromo_directors' => $this->input->post("director_ids"),
						'StashPromo_projects' => $this->input->post("project_ids"),
						'StashPromo_admin_id_ref' => $this->session->userdata("CSTKO_Admin_id"),
						'StashPromo_time' => time(),
						'StashPromo_status' => $this->input->post("live"),
					);
			return $this->db->insert("stash-promo", $d);
		}

		public function getThisPromo($ref = 0){
			$this->db->where("StashPromo_id", $ref);
			$query = $this->db->get("stash-promo", 1);
			return $query->first_row('array');
		}

		public function getPromoOpenedData($ref = 0){
			$this->db->where("StashPromoOpen_promo_id_ref", $ref);
			return $this->db->get("stash-promo-opened")->result("array");
		}

		public function getPromoUsedData($ref = 0){
			$this->db->select("*");
			$this->db->from("stash-promo-used as Used");
			$this->db->join("stash-users as Users", "Users.StashUsers_id = Used.StashPromoUsed_user_id_ref");
			$this->db->where("Used.StashPromoUsed_promo_id_ref", $ref);
			return $this->db->get()->result("array");
		}

		public function getDirectorInList($d = []){
			if(count($d)){
				$this->db->select("StashDirector_name, StashDirector_director_id_ref");
				$this->db->from("stash-director");
				$this->db->where_in("StashDirector_director_id_ref", $d);
				return $this->db->get()->result("array");
			}
			return array();
		}

		public function getProjectInList($d = []){
			if(count($d)){
				$this->db->where_in("StashProject_id", $d);
				return $this->db->get("stash-project")->result("array");
			}
			return array();
		}

		public function getContactMessages($value=''){
			$this->db->order_by("StashContactMessage_id", "DESC");
			return $this->db->get("stash-contact-message")->result("array");
		}

		public function emailInvitationData($value=''){
			$fetch = $this->db->get("stash-email-invites")->result('array');

			$sent = $seen = $reg = $paid = $pend = $confirm = $useen = $basic = 0;
			foreach ($fetch as $key => $f) {
				$sent++;
				if($f['StashEmailInvite_opened']){
					$seen++;
					$user = $this->thisUserData('StashUsers_email', $f['StashEmailInvite_email']);
					if(count($user)){
						$reg++;
						if($user['StashUsers_status'])
							$confirm++;

						$plan = $this->getActorPlan($user['StashUsers_id']);
						if(count($plan))
							$paid++;
						else
							$basic++;
					}else{
						$pend++;
					}
				}else{
					$useen++;
				}
			}

			return array( [0, $sent], [1, $seen], [2, $useen], [3, $pend], [4, $reg], [5, $paid], [6, $basic], [7, $confirm] );
		}

		public function smsInvitationData($value=''){
			$fetch = $this->db->get("stash-sms-invites")->result('array');

			$sent = $seen = $reg = $paid = $pend = $confirm = $useen = $basic = 0;
			foreach ($fetch as $key => $f) {
				$sent++;
				if($f['StashSMSInvites_opened']){
					$seen++;
					$user = $this->thisUserData('StashUsers_mobile', $f['StashSMSInvites_mobile']);
					if(count($user)){
						$reg++;
						if($user['StashUsers_status'])
							$confirm++;

						$plan = $this->getActorPlan($user['StashUsers_id']);
						if(count($plan))
							$paid++;
						else
							$basic++;
					}else{
						$pend++;
					}
				}else{
					$useen++;
				}
			}

			return array( [0, $sent], [1, $seen], [2, $useen], [3, $pend], [4, $reg], [5, $paid], [6, $basic], [7, $confirm] );
		}

		public function thisUserData($field = '', $value = ''){
			$this->db->where($field, $value);
			return $this->db->get("stash-users", 1)->first_row('array');
		}

		public function getActorPlan($ref = 0){
			$this->db->where("StashActorPlan_actor_id_ref", $ref);
			$this->db->where("StashActorPlan_status", 1);
			$this->db->where("StashActorPlan_end <= ", time());
			$this->db->ordeR_by("StashActorPlan_id", "DESC");
			return $this->db->get("stash-actor-plan", 1)->first_row('array');
		}
	}

?>