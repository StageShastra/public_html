<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($value=''){
		if($this->session->userdata("StaSh_User_Logged_In"))
			if($this->session->userdata("StaSh_User_type") == 'actor')
				redirect(base_url() . "actor/");
			else
				redirect(base_url() . "director/");
		$this->load->view("index");
	}

	public function register($type = 'director'){
		$pageInfo = array("error" => false, "error_msg" => null);
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
		                    'label' =>'email',
		                    'rules' => 'required|is_unique[stash-users.StashUsers_email]|valid_email'
		                ),
		                array(
		                    'field' =>'mobile',
		                    'label' =>'mobile',
		                    'rules' => 'required|is_unique[stash-users.StashUsers_mobile]|min_length[10]'
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
	    				if($this->input->cookie("newInvite")){
	    					$this->Auth->insertActorInProject($response);
	    					$this->Auth->insertActorInDirectorList($response);
							$this->session->set_userdata(array("Stash_New_User" => array()));
							
							// Remove All Cookies
							unset($_COOKIE['newInvite']);
							unset($_COOKIE['project_ref']);
							unset($_COOKIE['director_ref']);
							
							setcookie('newInvite', null, -1, '/');
							setcookie('project_ref', null, -1, '/');
							setcookie('director_ref', null, -1, '/');
	    				}
	    			}else{
	    				$this->Auth->setupDirectorProfile($response);
						$this->Auth->setupDirectorConfirmation($response);
	    			}
	    			
	    			// Sending Confirmation Mail
	    			$this->load->model("Email");
	    			$this->Email->sendActivationMail($this->input->post('name'), $this->input->post('email'), $response);

	    			$pageInfo['error'] = true;
	    			$pageInfo['error_msg'] = Ho_Reg_SuccMsg;
	    		}else{
	    			$pageInfo['error_msg'] = Ho_Reg_ErrMsg;
	    		}
	    	}
		}
		
		$pageInfo['page'] = $type;

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
		$encryptedText = str_replace("_", "/", $encryptedText);
		$this->session->set_userdata(array());
		$this->session->sess_destroy();
		$this->load->helper('cookie');
		delete_cookie('categories');
		delete_cookie('isCat');

		$this->load->library('encrypt');
		$info = $this->encrypt->decode(trim($encryptedText));
		$info = explode("_", $info);
		$data = array(	
						'project_ref' => trim($info[1]),
						'director_ref' => trim($info[0]),
						'time' => trim($info[2])
					);
					
		setcookie("project_ref", trim($info[1]), time() + 3600, "/");
		setcookie("director_ref", trim($info[0]), time() + 3600, "/");
		setcookie("newInvite", true, time() + 3600, "/");
		redirect(base_url() . "home/register/actor/");
	}
	
	public function joinBySMS($value = ''){
		$this->load->model("Auth");
		$link = trim($value);
		$linkDetails = $this->Auth->getLinkDetails($link);
		if(count($linkDetails)){
			$this->session->set_userdata(array());
			$this->session->sess_destroy();
			$this->load->helper('cookie');
			delete_cookie('categories');
			delete_cookie('isCat');
			
			$data = array(
						'project_ref' => $linkDetails['StashSMSInviteLink_project'],
						'director_ref' => $linkDetails['StashSMSInviteLink_director_id_ref'],
						'time' => time()
					);
			setcookie("project_ref", trim($linkDetails['StashSMSInviteLink_project']), time() + 3600, "/");
			setcookie("director_ref", trim($linkDetails['StashSMSInviteLink_director_id_ref']), time() + 3600, "/");
			setcookie("newInvite", true, time() + 3600, "/");
			
			redirect(base_url() . "home/register/actor/");
		}else{
			redirect(base_url());
		}
	}
	
	public function autoComplete(){
		$term = trim($_REQUEST['term']);
		$this->load->model("Auth");
		$data = $this->Auth->getProjectNameForAC($term);
		header("Content-Type: application/json");
		echo json_encode($data);
		exit();
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
