<?php
	class TestModel extends CI_Model {
		public function allInvitations($ref = 0){
			$this->db->where("StashSMSInvite_director_id_ref", $ref);
			return $this->db->get("stash-sms-invitation")->result("array");
		}
		public function getThisToken($ref = 0, $p = 0){
			$this->db->where("StashSMSInviteLink_project", $p);
			$this->db->where("StashSMSInviteLink_director_id_ref", $ref);
			return $this->db->get("stash-sms-invite-link", 1)->first_row("array");
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
		public function insertInvitationSMS($m = '', $l = '', $p = 0, $mob = '', $dir = 0){
			$d = array(
						'StashSMSInvites_id' => null,
						'StashSMSInvites_mobile' => $mob,
						'StashSMSInvites_msg_id' => $m,
						'StashSMSInvites_actor_id_ref' => 0,
						'StashSMSInvites_link' => $l,
						'StashSMSInvites_project_id_ref' => $p,
						'StashSMSInvites_time' => time(),
						'StashSMSInvites_director_id_ref' => $dir,
						'StashSMSInvites_status' => 0,
						'StashSMSInvites_opened' => 0
					);
			$this->db->insert("stash-sms-invites", $d);
		}
	}
	?>
