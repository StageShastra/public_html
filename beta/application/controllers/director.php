<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Director extends CI_Controller {

		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In"))
				redirect(base_url());
			$pageInfo = [];
			$this->load->view("director/home", $pageInfo);
		}

	}
?>