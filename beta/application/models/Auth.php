<?php

	class Auth extends CI_Model {

		public function insertUser($type = ''){
			$this->load->library('user_agent');
			$pass = hash_hmac('sha512', $this->input->post('password'), $this->config->item("encryption_key"));
			$data = array(
						'StashUsers_id' => null,
						'StashUsers_username' => trim(explode("@", $this->input->post('email'))[0]),
						'StashUsers_name' => $this->input->post('name'),
						'StashUsers_email' => $this->input->post("email"),
						'StashUsers_mobile' => $this->input->post("mobile"),
						'StashUsers_password' => $pass,
						'StashUsers_type' => trim($type),
						'StashUsers_time' => time(),
						'StashUsers_status' => 0,
						'StashUsers_ip' => $this->input->ip_address(),
						'StashUsers_header' => $this->agent->agent_string()
					);
			$response = $this->db->insert("StaSh-Users", $data);
			return $this->db->insert_id();
		}

		public function setupActorProfile($ref = 0){
			$data = array(
						'StashActor_id' => null,
						'StashActor_actor_id_ref' => $ref,
						'StashActor_name' => $this->input->post("name"),
						'StashActor_email' => $this->input->post("email"),
						'StashActor_mobile' => $this->input->post('mobile'),
						'StashActor_whatsapp' => $this->input->post('mobile'),
						'StashActor_dob' => 0,
						'StashActor_gender' => 0,
						'StashActor_height' => 0,
						'StashActor_weight' => 0,
						'StashActor_avatar' => 'default.png',
						'StashActor_images' => '{}',
						'StashActor_min_role_age' => 0,
						'StashActor_max_role_age' => 0,
						'StashActor_address' => '',
						'StashActor_city' => '',
						'StashActor_state' => '',
						'StashActor_country' => '',
						'StashActor_zip' => '',
						'StashActor_actor_card' => 0,
						'StashActor_passport' => 0,
						'StashActor_last_update' => time(),
						'StashActor_last_ip' => $this->input->ip_address()
					);
			$response = $this->db->insert("StaSh-actor", $data);
			return $response;
		}

		public function setupDirectorProfile($ref = 0){
			$data = array(
						'StashDirector_id' => null,
						'StashDirector_director_id_ref' => $ref,
						'StashDirector_name' => $this->input->post("name"),
						'StashDirector_email' => $this->input->post('email'),
						'StashDirector_mobile' => $this->input->post("mobile"),
						'StashDirector_avatar' => "default.png",
						'StashDirector_last_update' => time(),
						'StashDirector_last_ip' => $this->input->ip_address()
					);
			$response = $this->db->insert("StaSh-director", $data);
			return $response;
		}

		public function ifUserExist($email = ''){
			$this->db->where("StashUsers_email", $email);
			$query = $this->db->get("StaSh-Users");
			return $query->num_rows();
		}

		public function verifyLoginCredentials($data = []){
			$pass = hash_hmac('sha512', $data['password'], $this->config->item("encryption_key"));
			$this->db->where("StashUsers_email", trim($data['email']));
			$this->db->where("StashUsers_password", $pass);
			$this->db->where("StashUsers_type", $data['type']);
			$query = $this->db->get("StaSh-Users");
			return $query->first_row('array');
		}

		public function startLoginSession($profile = []){

			$session_data = array(
								'StaSh_User_Logged_In' => true,
								'StaSh_User_id' => $profile['StashUsers_id'],
								'StaSh_User_name' => $profile['StashUsers_name'],
								'StaSh_User_type' => $profile['StashUsers_type'],
							);
	    	$this->session->set_userdata($session_data);
		}

		public function updateUserLogin($ref = 0){
			$data = array(
						'StashLogins_id' => null,
						'StashLogins_user_id_ref' => $ref,
						'StashLogins_time' => time(),
						'StashLogins_ip' => $this->input->ip_address()
					);
			$response = $this->db->insert("StaSh-Logins", $data);
			return $response;
		}

		public function getUserData($key = '', $value = ''){
			$this->db->where($key, trim($value));
			$query = $this->db->get("StaSh-Users");
			return $query->first_row('array');
		}

		public function insertPassCode($ref = 0, $passCode = 0){
			$data = array(
						'StashForgotPassword_id' => null,
						'StashForgotPassword_user_id_ref' => $ref,
						'StashForgotPassword_code' => $passCode,
						'StashForgotPassword_req_time' => time(),
						'StashForgotPassword_used_time' => 0,
						'StashForgotPassword_status' => 0,
						'StashForgotPassword_ip' => $this->input->ip_address()
					);
			$response = $this->db->insert("Stash-Forgot-Password", $data);
			return $response;
		}

		public function getPassCodeData($ref = 0, $code = 0){
			$this->db->where("StashForgotPassword_user_id_ref", $ref);
			$this->db->where("StashForgotPassword_code", $code);
			$this->db->ordeR_by("StashForgotPassword_id", "DESC");
			$query = $this->db->get("Stash-Forgot-Password", 1);
			return $query->first_row('array');
		}

		public function updatePassCodeUses($id = 0){
			$data = array(
						'StashForgotPassword_used_time' => time(),
						'StashForgotPassword_status' => 1
					);
			$this->db->where('StashForgotPassword_id', $id);
			return $this->db->update('Stash-Forgot-Password', $data);
		}

		public function updatePassword($ref = 0, $pass = ''){
			$pass = hash_hmac('sha512', $pass, $this->config->item("encryption_key"));
			$data = array(
						'StashUsers_password' => $pass
					);
			$this->db->where('StashUsers_id', $ref);
			return $this->db->update('StaSh-Users', $data);
		}

	}

?>