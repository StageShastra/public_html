<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Director extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model("ModelDirector");
			$plan=$this->ModelDirector->getDirectorPlan();
			if(!count($plan)){
				redirect(base_url()."payment");
			}
		}

		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['count_emails'] = $this->ModelDirector->getInvitationEmailCount($this->session->userdata("StaSh_User_id"));
			$pageInfo['count_sms'] = $this->ModelDirector->getInvitationSMSCount($this->session->userdata("StaSh_User_id"));
			$this->load->view("director/home", $pageInfo);
		}

		public function conversations($value=''){

			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$this->load->view("director/conversations", $pageInfo);
		}
		public function account($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();
			$this->load->view("director/account", $pageInfo);
		}

		public function actor($ref = 0, $name = ''){
			$name = str_replace("-", " ", $name);
			$pageInfo = [];
			$this->load->model("ModelActor");
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($ref);
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($ref);
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($ref);
			$pageInfo['directors'] = $this->ModelActor->getDirectors($ref);
			$this->load->view("actor/actor_profile", $pageInfo);
		}

		public function emailPreview($txt = ''){
			$msg = urldecode($_GET['msg']);
			$link = isset($_GET['link']) ? trim($_GET['link']) : "";
			$linkname = isset($_GET['linkname']) ? trim($_GET['linkname']) : "";
			$this->load->model("Email");
			$email = $this->Email->defaultTemplete($msg, $link, $linkname, $this->session->userdata("StaSh_User_name"));
			//print_r($_GET);
			header('Content-Type: text/html; charset=utf-8');
			echo $email;
			exit();
		}

	}
?>