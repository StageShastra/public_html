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
				$this->preview( $link, 'sms' );
			}else{
				$link = $this->parseInvitaionLink( $link );
				$this->preview( $link, 'email' );
			}
		}

		public function fromSMS($link = ''){
			$linkData = $this->ModelProject->getSMSLinkData( $link, $this->session->userdata("StaSh_User_id") );
			if( count($linkData) ){
				$this->ModelProject->updateSMSLinkOpened( $linkData['StashSMSMsg_id'] );
				$pageInfo['project'] = $this->ModelProject->getProject( $linkData['StashSMSMsg_project_id_ref'] );
				$pageInfo['message'] = $this->ModelProject->getThisMessage($linkData['StashSMSMsg_msg_id_ref']);
				$pageInfo['for'] = "sms";
				$pageInfo['forRef'] = $linkData['StashSMSMsg_id'];
				$pageInfo['time'] = $linkData['StashSMSMsg_time'];
				$pageInfo['response'] = $linkData['StashSMSMsg_response'];
				return $pageInfo;
			}

			return [];
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
					$pageInfo['project'] = $this->ModelProject->getProject( $linkData['StashSMSMsg_project_id_ref'] );
					$pageInfo['message'] = $this->ModelProject->getThisMessage($linkData['StashSMSMsg_msg_id_ref']);
					$pageInfo['for'] = "sms";
					$pageInfo['forRef'] = $linkData['StashSMSMsg_id'];
					$pageInfo['time'] = $linkData['StashSMSMsg_time'];
					$pageInfo['response'] = $linkData['StashSMSMsg_response'];
					return $pageInfo;
				}
			}
		}

		public function preview($link = '', $for = ''){
			$pageInfo = [];
			if( $for == 'sms' )
				$pageInfo = $this->fromSMS( $link );
			

			if(count($pageInfo))
				$this->load->view("director/project", $pageInfo);
			else
				$this->displayPageNotFound();
		}


		public function response($status = false, $msg = null, $data = []){
			header("Content-Type: application/json");
			echo json_encode(array(
							"status" => $status,
							"message" => $msg,
							"data" => $data
						));
			exit();
		}

		public function Ajax($value=''){
			if(count($this->input->post())){
				$req = trim($this->input->post("request"));
				$data = json_decode($this->input->post("data"), true);

				switch ($req) {
					case 'ResponseAudition':
						$this->respondAudition($data);
						break;
					
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, Aj_Req_NoData);
			}
		}

		public function respondAudition($data = []){
			
			if( $data['for'] == 'sms' ){
				$res = $this->ModelProject->respondToSMSMsg( $data['forId'], $data['res'] );
			}else{
				$res = $this->ModelProject->respondToEmailMsg( $data['forId'], $data['res'] );
			}

			if($res)
				$this->response(true, "Success");
			else
				$this->response(false, "Failed");

		}
	}