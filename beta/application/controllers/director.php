<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Director extends CI_Controller {

		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->view("director/home", $pageInfo);
		}

		public function actor($ref = 0, $name = ''){
			$name = str_replace("-", " ", $name);
			$pageInfo = [];
			$this->load->model("ModelActor");
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($ref);
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($ref);
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($ref);
			$this->load->view("actor/actor_profile", $pageInfo);
		}

	}
?>