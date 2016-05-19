<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($value=''){
		//$pageInfo = array("error" => true, "error_msg" => null);
		//print_r($this->session->userdata());exit();
		if($this->session->userdata("StaSh_User_Logged_In"))
			if($this->session->userdata("StaSh_User_type") == 'actor')
				redirect(base_url() . "actor/");
			else
				redirect(base_url() . "director/");
		$this->load->view("index");
	}

	public function register($type = 'director'){
		//print_r($this->session->userdata("Stash_New_User"));
		$pageInfo = array("error" => true, "error_msg" => null);
		if($this->session->userdata("StaSh_User_Logged_In"))
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
		                    'rules' => 'required|is_unique[stash-users.StashUsers_email]|valid_email'
		                ),
		                array(
		                    'field' =>'mobile',
		                    'label' =>'Mobile',
		                    'rules' => 'required|is_unique[stash-users.StashUsers_mobile]'
		                ),
		                array(
		                    'field' =>'name',
		                    'label' =>'Name',
		                    'rules' => 'required'
		                ),
						array(
		                    'field' =>'cfn_password',
		                    'label' =>'Confirm Password',
		                    'rules' => 'required|min_length[5]|matches[password]'
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
	    				if(count($this->session->userdata("Stash_New_User"))){
	    					$this->Auth->insertActorInProject($response);
	    					$this->Auth->insertActorInDirectorList($response);
							$this->session->set_userdata(array("Stash_New_User" => array()));
	    				}
	    			}else{
	    				$this->Auth->setupDirectorProfile($response);
						$this->Auth->setupDirectorConfirmation($response);
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

	public function join($link = ''){
		$encryptedText = str_replace(" ", "+", urldecode($link));

		$this->load->library('encrypt');
		$info = $this->encrypt->decode(trim($encryptedText));
		$info = explode("_", $info);
		$data = array(	
						'project_ref' => $info[1],
						'director_ref' => $info[0],
						'time' => $info[2]
					);
		$this->session->set_userdata(array("Stash_New_User" => $data));
		//print_r($this->session->userdata());
		redirect(base_url() . "home/register/actor/");
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
