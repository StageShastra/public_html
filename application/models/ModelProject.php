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

		public function getEmailLinkData($d = []){
			$this->db->where("StashEmailMsg_director_id_ref", $d[0]);
			$this->db->where("StashEmailMsg_actor_id_ref", $d[1]);
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

	}