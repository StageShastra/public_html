<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($value=''){
		$this->load->view("index");
	}

	public function register($type = 'director'){

		$pageInfo = array("error" => true, "error_msg" => null);
		if($this->session->userdata("StaSh_User_logged_in"))
			if($this->session->userdata("StaSh_User_type") == 'actor')
				redirect(base_url() . "actor/");
			else
				redirect(base_url() . "director/");

		if(count($this->input->post())){
			$config = array(
						array(
		                    'field' =>'password',
		                    'label' =>'Password',
		                    'rules' => 'required|min_length[5]'
		                ),
		                array(
		                    'field' =>'email',
		                    'label' =>'Email',
		                    'rules' => 'required|is_unique[Stash-Users.StashUsers_email]|valid_email'
		                ),
		                array(
		                    'field' =>'mobile',
		                    'label' =>'Mobile',
		                    'rules' => 'required|is_unique[Stash-Users.StashUsers_mobile]'
		                ),
		                array(
		                    'field' =>'name',
		                    'label' =>'Name',
		                    'rules' => 'required'
		                )
					);

			$this->load->library('form_validation');
	    	$this->form_validation->set_rules($config);

	    	if($this->form_validation->run()){
	    		$this->load->model("Auth");
	    		$response = $this->Auth->insertUser($type);
	    		
	    		if($response > 0){
	    			if($type == 'actor'){
	    				$this->Auth->setupActorProfile($response);
	    			}else{
	    				$this->Auth->setupDirectorProfile($response);
	    			}
	    			
	    			// Sending Confirmation Mail
	    			// $this->load->model("Email");
	    			// $this->Email->sendActivationMail($this->input->post('name'), $this->input->post('email'), $response);

	    			$pageInfo['error'] = true;
	    			$pageInfo['error_msg'] = "Registration Success! Please check email for confirmation Link.";
	    		}else{
	    			$pageInfo['error_msg'] = "Something went wronge! We are try to fix it.";
	    		}
	    	}
		}

		$this->load->view("signup", $pageInfo);
	}

	public function forgotpassword($value=''){
		$pageInfo = array('error' => true, 'error_msg' => null);

		if(count($this->input->post())){

		}

		$this->load->view("forgotpassword", $pageInfo);
	}

	public function logout($value=''){
		$this->session->set_userdata(array());
		$this->session->sess_destroy();
		$this->load->helper('cookie');
		delete_cookie('categories');
		delete_cookie('isCat');
		redirect(base_url());
	}

}
