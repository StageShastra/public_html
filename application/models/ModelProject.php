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

	}