<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Project extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->model("ModelProject");
		}

		public function index($value=''){
			$this->displayPageNotFound();
		}

		protected function displayPageNotFound() {
			$this->output->set_status_header('404');
			show_404();
		}

		public function parseInvitaionLink($link = ''){
			$encryptedText = str_replace(" ", "+", urldecode($link));
			$encryptedText = str_replace("_", "/", $encryptedText);
			$this->load->library('encrypt');
			$info = $this->encrypt->decode(trim($encryptedText));
			return trim($info);
		}

		public function notification($link = ''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'actor')
				redirect(base_url());
			$link = trim($link);
			if( strlen($link) == 6 ){
				$this->fromSMS( $link );
			}else{
				$link = $this->parseInvitaionLink( $link );
				$this->fromEmail( $link );
			}
		}

		public function fromSMS($link = ''){
			$linkData = $this->ModelProject->getSMSLinkData( $link, $this->session->userdata("StaSh_User_id") );
			print_r($linkData);
			if( count($linkData) ){
				$this->ModelProject->updateSMSLinkOpened( $linkData['StashSMSMsg_id'] );
				echo "hello";
			}
		}

		public function fromEmail($link = ''){
			$data = json_decode($link, true);
			/*
				$data = array( 
								0 => 'director_id',
								1 => 'actor_id',
								2 => 'time',
								3 => 'msg_id'	
							);
			*/

			if(count($data)){
				$linkData = $this->ModelProject->getEmailLinkData( $data );
				if(count($linkData)){
					$this->ModelProject->updateEmailLinkOpened( $linkData['StashEmailMsg_id'] );
				}
			}
		}
	}