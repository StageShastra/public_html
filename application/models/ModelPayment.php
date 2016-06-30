<?php
	class ModelPayment extends CI_Model {

		public function insertPaymentSuccess($pay = '', $req = ''){
			$d = array(
						'StashPaymentSuccess_id' => null,
						'StashPaymentSuccess_user_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashPaymentSuccess_payment_id' => $pay,
						'StashPaymentSuccess_payment_req_id' => $req,
						'StashPaymentSuccess_time' => time()
					);
			$this->db->insert("stash-payment-success", $d);
		}

		public function insertPaymentData($posted = []){
			$d = array(
						'StashPayment_id' => null,
						'StashPayment_buyer_name' => $posted['buyer_name'],
						'StashPayment_buyer_email' => $posted['buyer'],
						'StashPayment_buyer_phone' => $posted['buyer_phone'],
						'StashPayment_amount' => $posted['amount'],
						'StashPayment_currency' => $posted['currency'],
						'StashPayment_fees' => $posted['fees'],
						'StashPayment_mac' => $posted['mac'],
						'StashPayment_payment_id' => $posted['payment_id'],
						'StashPayment_status' => $posted['status'],
						'StashPayment_time' => time(),
						'StashPayment_ip' => $this->input->ip_address()
					);
			$this->db->insert("stash-payments", $d);
		}

		public function insertDirectorPlan($plan = '', $id = 0, $end = 0, $sms = 0){
			$left = $this->smsCreditLeft(); 
			$left = $left[0] - $left[1];
			$sms = $sms + $left;
			$d = array(
						'StashDirectorPlan_id' => null,
						'StashDirectorPlan_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashDirectorPlan_plan' => $plan,
						'StashDirectorPlan_start' => time(),
						'StashDirectorPlan_end' => $end,
						'StashDirectorPlan_time' => time(),
						'StashDirectorPlan_free_sms' => $sms,
						'StashDirectorPlan_used_sms' => 0,
						'StashDirectorPlan_status' => 1,
						'StashDirectorPlan_ip' => $this->input->ip_address()
					);
			return $this->db->insert("stash-director-plans", $d);
		}

		public function smsCreditLeft(){
			$this->db->where("StashDirectorPlan_director_id_ref", $this->session->userdata("StaSh_User_id"));
			$this->db->where("StashDirectorPlan_status", 1);
			$this->db->ordeR_by("StashDirectorPlan_id", "DESC");
			$fetch = $this->db->get("stash-director-plans", 1)->first_row('array');
			return [ $fetch['StashDirectorPlan_free_sms'], $fetch['StashDirectorPlan_used_sms']];
		}

		public function insertActorPlan($plan = '', $end = 0){
			$d = array(
						'StashActorPlan_id' => null,
						'StashActorPlan_actor_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashActorPlan_plan' => $plan,
						'StashActorPlan_start' => time(),
						'StashActorPlan_end' => $end,
						'StashActorPlan_time' => time(),
						'StashActorPlan_status' => 1,
						'StashActorPlan_ip' => $this->input->ip_address()
					);
			return $this->db->insert("stash-actor-plan", $d);
		}

	}