<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Secure extends CI_Controller {
		
		public function confirm($link = ''){
			$encryptedText = str_replace(" ", "+", urldecode($link));

			$this->load->library('encrypt');
			$info = $this->encrypt->decode(trim($encryptedText));
			$info = explode("=", $info);
			$data = array(
						"email" => trim($info[0]),
						"ref" => (int)trim($info[1])
					);
			$this->load->model("Auth");
			$pageInfo = array();
			//print_r($this->Auth->ifUserExist($data['email']));exit();
			if($this->Auth->ifUserExist($data['email'])){
				if(!$this->Auth->isConfirmedUser("StashUsers_email", $data['email'])){
					if($this->Auth->confirmEMail($data['email'])){
						$pageInfo['title'] = "Account Activated";
						$pageInfo['body'] = "Your email {$data['email']} is confirmed now. You will be redirected to the login page in 10 seconds.";
						$pageInfo['body'] .= Se_Cnf_RedirectLink;
						$pageInfo['redirect'] = true;
					}else{
						$pageInfo['title'] = "Already Confirmed";
						$pageInfo['body'] = Se_Cnf_AlreadyConfirmed;
						$pageInfo['body'] .= Se_Cnf_RedirectLink;
						$pageInfo['redirect'] = true;
					}
				}else{
					$pageInfo['title'] = "Already Confirmed";
					$pageInfo['body'] = Se_Cnf_AlreadyConfirmed;
					$pageInfo['body'] .= Se_Cnf_RedirectLink;
					$pageInfo['redirect'] = true;
				}
			}else{
				$pageInfo['title'] = "Warning";
				$pageInfo['body'] = "Invalid or Broken Token";
				$pageInfo['redirect'] = false;
			}
			
			$this->load->view("confirm", $pageInfo);
		}

		public function deliveryReport($value=''){
			$number = $_REQUEST['number'];
			$status = $_REQUEST['status'];
			$customID = $_REQUEST['customID'];

			$this->load->model("Auth");
			$this->Auth->addDeliveryReport($number, $status, $customID);
		}
		
	}

	
?>