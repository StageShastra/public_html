<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($value=''){
		$this->login();
	}

	public function landingpage($value=''){
		$this->load->view("landingpage");
	}

	public function login($value=''){
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

		$this->load->model("Auth");
		$pageInfo['mobile'] = '';
		$pageInfo['email'] = '';
		$pageInfo['director'] = 0;
		$pageInfo['project'] = 0;
		$pageInfo['link_id'] = 0;

		$refer_id = 0;
		$refer = 'direct';

		$link = (isset($_SESSION['Cstko_link'])) ? trim($_SESSION['Cstko_link']) : trim($this->input->cookie("Cstko_link"));
		if( $link != '' ){
			if(strlen($link) == 6){
				$linkDetails = $this->Auth->getLinkDetails($link);
				$pageInfo['mobile'] = $linkDetails['StashSMSInvites_mobile'];
				$pageInfo['director'] = $linkDetails['StashSMSInvites_director_id_ref'];
				$pageInfo['project'] = $linkDetails['StashSMSInvites_project_id_ref'];
				$pageInfo['link_id'] = $linkDetails['StashSMSInvites_id'];

				$refer = 'sms';
				$refer_id = $linkDetails['StashSMSInvites_id'];
			}elseif(strlen($link) == 8){
				// email...
				$linkDetails = $this->Auth->getEmailLinkDetails($link);
				$pageInfo['email'] = $linkDetails['StashEmailInvite_email'];
				$pageInfo['director'] = $linkDetails['StashEmailInvite_director_id_ref'];
				$pageInfo['project'] = $linkDetails['StashEmailInvite_project_id_ref'];
				$pageInfo['link_id'] = $linkDetails['StashEmailInvite_id'];

				$refer = 'email';
				$refer_id = $linkDetails['StashEmailInvite_id'];
			}else{
				// Adv referal
			}
			
		}

		/*print_r($this->input->post());
		exit();*/

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
	    		$response = $this->Auth->insertUser($type, $refer, $refer_id);
	    		
	    		if($response > 0){
	    			if($type == 'actor'){
	    				$this->Auth->setupActorProfile($response);

	    				if( $this->input->post("director") != 0 && 
	    					$this->input->post("project") != 0 &&
	    					$this->input->post("link_id") != 0 ){
	    					$this->Auth->insertActorInProject($response, $this->input->post("project"));
	    					$this->Auth->insertActorInDirectorList($response, $this->input->post("director"));
	    					if( $refer == 'sms' )
	    						$this->Auth->updateSMSLinkUsed( $this->input->post("link_id") );
	    					elseif($refer == 'email')
	    						$this->Auth->updateEmailLinkUsed( $this->input->post("link_id") );
	    					else
	    						// referal link
	    					if(isset($_SESSION['Cstko_link']))
	    						unset($_SESSION['Cstko_link']);

	    					if(isset($_COOKIE['Cstko_link']))
	    						unset($_COOKIE['Cstko_link']);
	    					setcookie('Cstko_link', null, -1, '/');
	    				}
	    			}else{
	    				$this->Auth->setupDirectorProfile($response);
						$this->Auth->setupDirectorConfirmation($response);
	    			}
	    			
	    			// Sending Confirmation Mail
	    			$this->load->model("Email");
	    			$this->Email->sendActivationMail($this->input->post('name'), $this->input->post('email'), $response);

	    			( $type == 'actor' ) ? redirect( base_url() . "actor/" ) : redirect( base_url() . "director/" );
	    			/*$pageInfo['error'] = true;
	    			$pageInfo['error_msg'] = Ho_Reg_SuccMsg;*/
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

	public function parseInvitaionLink($link = ''){
		$encryptedText = str_replace(" ", "+", urldecode($link));
		$encryptedText = str_replace("_", "/", $encryptedText);
		$this->load->library('encrypt');
		$info = $this->encrypt->decode(trim($encryptedText));
		return trim($info);
	}


	public function join($link = ''){
		$parsedLink = $this->parseInvitaionLink( $link );
		$dataInUrl = json_decode($parsedLink);
		$this->load->model("Auth");
		$linkDetails = $this->Auth->getEmailLinkDetails($dataInUrl[4]);
		$this->Auth->updateSMSLinkOpened( $linkDetails['StashEmailInvite_id'] );
		$link = trim($linkDetails['StashEmailInvite_link']);
		setcookie("Cstko_link", $link, time() + 3600, "/");
		$_SESSION['Cstko_link'] = $link;
		redirect( base_url() . "home/register/actor" );
	}

	public function connect($link = ''){
		
		$parsedLink = $this->parseInvitaionLink( $link );
		$dataInUrl = json_decode($parsedLink);
		$this->load->model("Auth");
		$linkDetails = $this->Auth->getEmailLinkDetails($dataInUrl[4]);
		$this->Auth->updateSMSLinkOpened( $linkDetails['StashEmailInvite_id'] );	
		/*
		data in url::
			index | value
			---------------------
			0     | director_ref
			1     | project_ref
			2     | time
			3     | email
			4     | link
		*/

		$userdata = $this->Auth->getUserData( 'StashUsers_email', $dataInUrl[3] );
		if( count($userdata) ){
			if( !$this->Auth->checkActorInDirector( $userdata['StashUsers_id'], $dataInUrl[0] ) ){
				$this->Auth->insertActorInDirectorList( $userdata['StashUsers_id'], $dataInUrl[0] );
			}

			if( !$this->Auth->checkActorProject( $userdata['StashUsers_id'], $dataInUrl[1] ) )
				$this->Auth->insertActorInProject($userdata['StashUsers_id'], $dataInUrl[1]);
			$this->Auth->updateEmailLinkUsed( $linkDetails['StashEmailInvite_id'] );
			redirect(base_url() . "actor");
		}else{
			redirect(base_url());
		}

	}
	
	public function joinBySMS($value = ''){
		$this->load->model("Auth");
		$link = trim($value);
		$linkDetails = $this->Auth->getLinkDetails($link);
		if(count($linkDetails)){
			$this->Auth->updateSMSLinkOpened( $linkDetails['StashSMSInvites_id'] );		
			$userdata = $this->Auth->getUserData( 'StashUsers_mobile', $linkDetails['StashSMSInvites_mobile'] );
			if( count($userdata) ){
				// Registered Already
				if( !$this->Auth->checkActorInDirector( $userdata['StashUsers_id'], $linkDetails['StashSMSInvites_director_id_ref'] ) ){
					$this->Auth->insertActorInDirectorList( $userdata['StashUsers_id'], $linkDetails['StashSMSInvites_director_id_ref'] );
				}

				if( !$this->Auth->checkActorProject( $userdata['StashUsers_id'], $linkDetails['StashSMSInvites_project_id_ref'] ) )
					$this->Auth->insertActorInProject($userdata['StashUsers_id'], $linkDetails['StashSMSInvites_project_id_ref']);
				$this->Auth->updateSMSLinkUsed( $linkDetails['StashSMSInvites_id'] );	
				redirect(base_url() . "actor/");
			}else{
				// Not Registered yet.
				setcookie("Cstko_link", $link, time() + 3600, "/");
				$_SESSION['Cstko_link'] = $link;
				redirect( base_url() . "home/register/actor" );
			}
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
