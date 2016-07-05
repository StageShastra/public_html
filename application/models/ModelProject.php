<?php
	
	class ModelProject extends CI_Model {

		public function getSMSLinkData($l = '', $ref = 0){
			$this->db->where("StashSMSMsg_link", $l);
			$this->db->where("StashSMSMsg_actor_id_ref", $ref);
			return $this->db->get("stash-sms-message", 1)->first_row("array");
		}

		public function updateSMSLinkOpened($id = 0){
			$this->db->where("StashSMSMsg_id", $id);
			$this->db->update("stash-sms-message", array( 'StashSMSMsg_opened' => time() ));
		}

		public function getUserId($email = ''){
			$this->db->where("StashUsers_email", $email);
			$fetch = $this->db->get("stash-users", 1)->first_row('array');
			return $fetch['StashUsers_id'];
		}

		public function getUserName($id = 0){
			$this->db->where("StashUsers_id", $id);
			$fetch = $this->db->get("stash-users", 1)->first_row('array');
			return $fetch['StashUsers_name'];
		}

		public function getEmailLinkData($d = []){
			$id = $this->getUserId($d[1]);
			$this->db->where("StashEmailMsg_director_id_ref", $d[0]);
			$this->db->where("StashEmailMsg_actor_id_ref", $id);
			$this->db->where("StashEmailMsg_msg_id_ref", $d[3]);
			$this->db->where("StashEmailMsg_time", $d[2]);
			return $this->db->get("stash-email-message", 1)->first_row("array");
		}

		public function updateEmailLinkOpened($ref = 0){
			$this->db->where("StashEmailMsg_id", $ref);
			$this->db->update("stash-email-message", array( 'StashEmailMsg_opened' => time() ));
		}

		public function getProject($id = 0){
			$this->db->where("StashProject_id", $id);
			return $this->db->get("stash-project", 1)->first_row('array');
		}

		public function getThisMessage($ref = 0){
			$this->db->where("StashInviteMsg_id", $ref);
			return $this->db->get("stash-invite-msg", 1)->first_row("array");
		}

		public function respondToSMSMsg($id = 0, $res = 0){
			$this->db->where("StashSMSMsg_id", $id);
			$this->db->where("StashSMSMsg_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-sms-message", array( 'StashSMSMsg_response' => $res ));
		}

		public function respondToEmailMsg($id = 0, $res = 0){
			$this->db->where("StashEmailMsg_id", $id);
			$this->db->where("StashEmailMsg_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->update("stash-email-message", array( 'StashEmailMsg_response' => $res ));
		}

		public function updateCheckoutClicked(){
			$refer = $this->input->cookie("Cstko_refer");
			if($refer == 'sms'){
				$by = $this->getUserData("StashUsers_mobile", $this->session->userdata("StaSh_User_id"));
				$this->db->where("StashSMSInvites_mobile", $by);
				$this->db->update("stash-sms-invites", array('StashSMSInvites_status' => 3));
			}else{
				$by = $this->getUserData("StashUsers_email", $this->session->userdata("StaSh_User_id"));
				$this->db->where("StashEmailInvite_email", $by);
				$this->db->update("stash-email-invites", array('StashEmailInvite_status' => 3));
			}
		}

		public function getUserData($field = '', $value = ''){
			$this->db->where($field, $value);
			$fetch = $this->db->get("stash-users", 1)->first_row('array');
			return $fetch[$field];
		}

	}