<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Test extends CI_Controller {
		
		public function testEmail($email = ""){
			$this->load->model("Email");
			if($this->Email->sendActivationMail("Developer Testing", urldecode($email), $ref = 1)){
				echo "Mail Sent";
			}else{
				echo "Failed";
			}
		}
		
		public function testSMS($num = '8979578267', $msg = "Hi, This is Test SMS."){
			$this->load->model("SMS");
			if($this->SMS->sendInvitaionSMS($msg, $num, 0)){
				echo "SMS Success";
			}else{
				echo "SMS Failed";
			}
		}
		
	}

?>