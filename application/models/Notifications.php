<?php
	class Notifications extends CI_Model {
		
		public function insertNotification($a = 0, $m = '', $t = '', $info = []){
			$d = array(
					'StashNotification_id' => null,
					'StashNotification_actor_id_ref' => $a,
					'StashNotification_message' => $m,
					'StashNotification_data' => json_encode($info),
					'StashNotification_time' => time(),
					'StashNotification_ip' => $this->input->ip_address(),
					'StashNotification_status' => 1,
					'StashNotification_type' => $t
				);
			$this->db->insert('stash-notification', $d);
		}

		public function updateNotificationSeen($id = 0){
			$this->db->where("StashNotification_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->update("stash-notification", array('StashNotification_status' => 0));
		}

		public function sentNotificationSeen($id = 0){
			$this->db->where("StashNotification_status", 1);
			$this->db->where("StashNotification_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->update("stash-notification", array('StashNotification_status' => 2));
		}

		public function newNotice(){
			$this->db->where("StashNotification_status <> ", 0);
			$this->db->where("StashNotification_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			return $this->db->get("stash-notification")->num_rows();
		}

		public function getNotice(){
			$this->db->where("StashNotification_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->order_by("StashNotification_id", "DESC");
			return $this->db->get("stash-notification", 30)->result('array');
		}

		public function getNewNotice(){
			$this->db->where("StashNotification_status", 1);
			$this->db->where("StashNotification_actor_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->order_by("StashNotification_id", "DESC");
			return $this->db->get("stash-notification")->result('array');
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

		public function type2fa($type = ''){
			$box = array(
					'view' => 'fa-eye',
					'viewx' => 'fa-user-secret',
					'audition' => 'fa-envelope',
					'connect' => 'fa-user-plus',
					'quick' => 'fa-bolt',
					'message' => 'fa-envelope-o'
				);
			return $box[trim($type)];
		}

		public function getEncryptedText($text = ''){
			$this->load->library('encrypt');
			$encryptedText = $this->encrypt->encode($text);
			$encryptedText = str_replace("/", "_", $encryptedText);
			return urldecode($encryptedText);
		}

	}
