<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {

		protected $adminPages = '[]';

		function __construct(){
			parent::__construct();
			$this->load->model("ModelAdmin");

			$adminPages = '[{"name":"Dashboard","identifier":"dashboard","pages":[]},{"name":"Users","identifier":"users","pages":[{"name":"Directors","method":"directors","view":1},{"name":"Actors","method":"actors","view":1},{"name":"Director Profile","method":"director","view":0},{"name":"Actor Profile","method":"actor","view":0}]},{"name":"Projects","identifier":"projects","pages":[{"name":"All Projects","method":"allProject","view":1},{"name":"Active Projects","method":"liveProject","view":1},{"name":"Old Projects","method":"oldProject","view":0},{"name":"Project Page","method":"project","view":0}]},{"name":"Admin","identifier":"admin","pages":[{"name":"Profile","method":"profile","view":1},{"name":"Admin Profile","method":"adminProfile","view":0}]}]';
			$this->adminPages = $adminPages;
		}

		public function index($value=''){
			$this->dashboard();
		}

		public function dashboard($value=''){
			if( !$this->session->userdata("CSTKO_Admin_login") )
				redirect( base_url() . "admin/login" );

			$pageInfo['nav_h'] = "dashboard";
			$pageInfo['nav_sh'] = "dashboard";

			$this->load->view("admin/dashboard", $pageInfo);
		}

		public function login($value=''){
			$pageInfo = array('error_msg' => null);
			if(count($this->input->post())){

				$adminData = $this->ModelAdmin->getAdminDetail( "CstkoAdmins_username", $this->input->post("username") );
				//print_r($adminData);
				
				if( count($adminData) ){
					if($adminData['CstkoAdmins_status'] != 0){
						if( $adminData['CstkoAdmins_status'] != 2){
							$pass = hash_hmac('sha512', $this->input->post('password'), $this->config->item("encryption_key"));
							if( $adminData['CstkoAdmins_password'] == $pass ){

								$this->ModelAdmin->adminLoggined($adminData['CstkoAdmins_id']);
								$this->ModelAdmin->setAdminLastLogin($adminData['CstkoAdmins_id']);

								$data = array(
											'CSTKO_Admin_login' => true,
											'CSTKO_Admin_id' => $adminData['CstkoAdmins_id'],
											'CstkoAdmins_name' => $adminData['CstkoAdmins_name'],
											'CstkoAdmins_auth' => $adminData['CstkoAdmins_auth']
										);
								$this->session->set_userdata($data);

								redirect( base_url() . "admin/" );

							}else{
								$pageInfo['error_msg'] = "Username and password did not matched.";
							}
						}else{
							$pageInfo['error_msg'] = "Account Blocked by Super Admin.";
						}
					}else{
						$pageInfo['error_msg'] = "This admin account not yet activated.";
					}
				}else{
					$pageInfo['error_msg'] = "Admin username do not exist.";
				}

			}

			$this->load->view("admin/login", $pageInfo);
		}

		public function directors($value=''){
			$cds = $this->ModelAdmin->getUserDetails( "director" );
			$pageInfo['directors'] = $cds;

			$pageInfo['nav_h'] = "users";
			$pageInfo['nav_sh'] = "directors";
			$this->load->view("admin/directors", $pageInfo);
		}

		public function actors($value=''){
			$ac = $this->ModelAdmin->getUserDetails( "actor" );
			$pageInfo['actors'] = $ac;

			$pageInfo['nav_h'] = "users";
			$pageInfo['nav_sh'] = "actors";
			$this->load->view("admin/actors", $pageInfo);
		}

		public function director($ref = 0){
			$profile = $this->ModelAdmin->getDirectorProfile( $ref );

			$pageInfo['profile'] = $profile;
			$pageInfo['lastLogin'] = $this->ModelAdmin->lastLogin( $ref );

			// Actor in List
			$actors = $this->ModelAdmin->getActorInList($ref);
			$pageInfo['actors']['profiles'] = $actors;
			$pageInfo['actors']['count'] = count($actors);

			// Projects of Director
			$projects = $this->ModelAdmin->getProfectsOfCD( $ref );
			$pageInfo['projects']['lists'] = $projects;
			$pageInfo['projects']['count'] = count($projects);

			$pageInfo['invitation']['email'] = $this->ModelAdmin->countInvitationEmail( $ref );
			$pageInfo['invitation']['sms'] = $this->ModelAdmin->countInvitationSMS( $ref );

			$pageInfo['messages']['email'] = $this->ModelAdmin->countComposedEmail( $ref );
			$pageInfo['messages']['sms'] = $this->ModelAdmin->countComposedSMS( $ref );

			/*echo "<pre>";
			print_r($pageInfo);
			exit();*/

			$pageInfo['nav_h'] = "users";
			$pageInfo['nav_sh'] = "directors";
			$this->load->view("admin/director", $pageInfo);
		}

		public function actor($ref = 0){
			
			$profile = $this->ModelAdmin->getActorProfile( $ref );

			$pageInfo['profile'] = $profile;
			$pageInfo['lastLogin'] = $this->ModelAdmin->lastLogin( $ref );

			$pageInfo['experiences'] = $this->ModelAdmin->getActorExperience( $ref );

			$pageInfo['trainings'] = $this->ModelAdmin->getActorTraining($ref);

			$pageInfo['directors'] = $this->ModelAdmin->getDirectorsOfActor( $ref );

			/*echo "<pre>";
			print_r($pageInfo);
			exit();*/

			$pageInfo['nav_h'] = "users";
			$pageInfo['nav_sh'] = "actors";
			$this->load->view("admin/actor", $pageInfo);

		}

		/* Admin Block Start */

		public function admins($value=''){
			$pageInfo['nav_h'] = "admin";
			$pageInfo['nav_sh'] = "alladmin";

			$pageInfo['admins'] = $this->ModelAdmin->getAllAdmins();
			$this->load->view("admin/admins", $pageInfo);
		}

		public function profile($username = ''){
			$profile = $this->ModelAdmin->getThisAdminProfile($username);
			if( count($profile) ){
				$pageInfo['profile'] = $profile;
				$pageInfo['lastLogin'] = $this->ModelAdmin->getAdminLastLogins($profile['CstkoAdmins_id']);
				$pageInfo['nav_h'] = "admin";
				$pageInfo['nav_sh'] = "profile";

				$this->load->view("admin/profile", $pageInfo);
			}else{
				$this->load->view("admin/404");
			}
		}

		public function addAdmin($value=''){
			$pageInfo = array("error" => false, 'error_msg' => null, 'success' => "text-danger");

			if( count($this->input->post()) ){
				$config = array(
		                array(
		                    'field' =>'email',
		                    'label' =>'email',
		                    'rules' => 'required|is_unique[cstko_admins.CstkoAdmins_email]|valid_email'
		                ),
		                array(
		                    'field' =>'username',
		                    'label' =>'Username',
		                    'rules' => 'required|is_unique[cstko_admins.CstkoAdmins_username]'
		                )
					);

				$this->load->library('form_validation');
		    	$this->form_validation->set_rules($config);
		    	if($this->form_validation->run()){
		    		$pageInfo['error'] = true;
					$filename = ($this->input->post("gender") == 1) ? "male.png" : "female.png";
					if( $_FILES['profilePic']['size'] ){
						$config = array(
									'upload_path' => './assets/admin/img/avatars/',
									'allowed_types' => 'png|jpg|jpeg',
									'overwrite' => TRUE,
									'max_size' => 5120, // 1024 * 5 in Kb
									'encrypt_name' => TRUE,
									'max_width' => 1024,
									'max_height' => 768
								);

						$this->load->library('upload', $config);

						if($this->upload->do_upload('profilePic')){
							$upload = $this->upload->data();
							$filename = $upload['file_name'];
						}else{
							$pageInfo['error_msg'] = $this->upload->display_errors('<p>', '</p>');
						}
					}

					if( $this->ModelAdmin->insertAdmin( $filename ) ){
						$pageInfo['error_msg'] .= "Admin Added. <i> Default Password : Castiko@123 </i>. ";
						$pageInfo['success'] = "text-success";
					}else{
						$pageInfo['error_msg'] .= "Failed to add Admin. Database Error.";
					}
		    	}
			}

			$pageInfo['nav_h'] = "admin";
			$pageInfo['nav_sh'] = "addAdmin";
			$pageInfo['adminPages'] = $this->adminPages;
			$this->load->view("admin/addAdmin", $pageInfo);
		}


		/* Admin Block End */

		public function sendMail($email = 'connect@castiko.com'){
			$pageInfo = array("error" => false, 'error_msg' => null, 'success' => "text-danger");
			$pageInfo['nav_h'] = "dashboard";
			$pageInfo['nav_sh'] = "dashboard";
			$pageInfo['email'] = urldecode($email);
			if( count($this->input->post()) ){
				$pageInfo['error'] = true;

				$config = array(
		                array(
		                    'field' =>'to',
		                    'label' =>'Receiver Email',
		                    'rules' => 'required'
		                ),
		                array(
		                    'field' =>'subject',
		                    'label' =>'Subject',
		                    'rules' => 'required'
		                ),
		                array(
		                    'field' =>'message',
		                    'label' =>'Message',
		                    'rules' => 'required'
		                ),
					);

				$this->load->library('form_validation');
		    	$this->form_validation->set_rules($config);

		    	if($this->form_validation->run()){
		    		$this->load->model("Email");//sendAdminPanelMail
					$data = [];
					if(trim($this->input->post('to')) != ''){
						$to = explode(",", $this->input->post('to'));
						if( count($to) > 1 ){
							foreach ($to as $key => $mail) {
								$data['to'][] = trim($mail);
							}
						}else{
							$data['to'] = trim($this->input->post('to'));
						}

						$pageInfo['email'] = $this->input->post('to');
					}

					$cc = explode(",", $this->input->post('cc'));
					if( count($cc) > 1 ){
						foreach ($cc as $key => $mail) {
							$data['cc'][] = trim($mail);
						}
					}else{
						$data['cc'] = trim($this->input->post('cc'));
					}

					$bcc = explode(",", $this->input->post('bcc'));
					if( count($bcc) > 1 ){
						foreach ($bcc as $key => $mail) {
							$data['bcc'][] = trim($mail);
						}
					}else{
						$data['bcc'] = trim($this->input->post('bcc'));
					}

					$data['subject'] = $this->input->post('subject');
					$data['message'] = $this->input->post('message');

					if( $this->Email->sendAdminPanelMail( $data ) ){
						$pageInfo['error_msg'] = "Email Sent!";
						$pageInfo['success'] = "text-success";
					}else{
						$pageInfo['error_msg'] = "Email Failed!!!";
					}
		    	}

			}
			$this->load->view("admin/sendMail", $pageInfo);
		}

		public function invitation($page = 'email', $ref = 0){
			if( $page == '' || $ref == 0)
				$this->load->view("admin/404", $pageInfo);

			if($page == 'email')
				$invites = $this->ModelAdmin->allEmailInvitations( $ref );
			else
				$invites = $this->ModelAdmin->allSMSInvitations( $ref );

			$pageInfo['invites'] = $invites;
			$this->load->view("admin/invitation", $pageInfo);
		}
















		/*
			Ajax Call: 
				{
					request: "TheRequest",
					data: { key: "Value" }
				}

			Response:
				{
					status: true/false,
					message: "message related to request process",
					data: {key: "Value"}
				}
		*/

		public function response($s = false, $m = null, $d = []){
			header("Content-Type: application/json");
			echo json_encode(array(
							'status' => $s,
							'message' => $m,
							'data' => $d
						));
			exit();
		}

		public function ajax($value=''){
			
			if( !$this->session->userdata("CSTKO_Admin_login") )
				$this->response(false, "You are not logged in.");

			if(count($this->input->post())){
				$req = trim($this->input->post("request"));
				$data = json_decode($this->input->post("data"), true);

				switch ($req) {
					case 'ChangePassword':
						$this->changePassword($data);
						break;
					
					default:
						# code...
						break;
				}

			}else{
				$this->response(false, "Form is empty.");
			}

		}

		public function changePassword($data = []){
			$adminData = $this->ModelAdmin->getAdminDetail( "CstkoAdmins_id", $this->session->userdata("CSTKO_Admin_id") );
			if( count($adminData) ){
				$pass = hash_hmac('sha512', $data['old_pass'], $this->config->item("encryption_key"));
				if( $adminData['CstkoAdmins_password'] == $pass ){
					if( $data['new_pass'] == $data['cnf_pass'] ){
						$pass = hash_hmac('sha512', $data['cnf_pass'], $this->config->item("encryption_key"));
						if($this->ModelAdmin->updateAdminPassword( $this->session->userdata("CSTKO_Admin_id"), $pass )){
							$this->response(true, "Password update success.");
						}else{
							$this->response(false, "Failed to update password.");
						}
					}else{
						$this->response(false, "New and Confirm password didn't matched.");
					}
				}else{
					$this->response(false, "Old Password is incorrect");
				}
			}else{
				$this->response(false, "Authorization Failed");
			}
		}

	}

?>