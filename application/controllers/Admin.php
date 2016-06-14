<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->model("ModelAdmin");
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
				
				if( count($adminData) ){
					if($adminData['CstkoAdmins_status'] != 0){
						if( $adminData['CstkoAdmins_status'] != 1){
							$pass = hash_hmac('sha512', $this->input->post('password'), $this->config->item("encryption_key"));
							if( $adminData['CstkoAdmins_password'] == $pass ){

								$this->ModelAdmin->adminLoggined($adminData['CstkoAdmins_id']);
								$this->ModelAdmin->setAdminLastLogin($adminData['CstkoAdmins_id']);

								$data = array(
											'CSTKO_Admin_login' => true,
											'CSTKO_Admin_id' => $adminData['CstkoAdmins_id'],
											'CstkoAdmins_name' => $adminData['CstkoAdmins_name']
										);
								$this->session->set_userdata($data);

								redirect( base_url() . "admin/" );

							}else{
								$pageInfo['error_msg'] = "Username and password did not matched.";
							}
						}else{
							$pageInfo['error_msg'] = "Account Block by Super Admin.";
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

	}

?>