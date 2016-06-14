<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Test extends CI_Controller {
		
		public function testEmail($email = ""){
			$this->load->model("Email");
			//$this->Email->sendAuditionMail(['dilipkumar.iitr@gmail.com'], 'Developer Testing', "This is tested by<br> developer  </br>Dilip Kumar")
			//$this->Email->sendActivationMail("Developer Testing", urldecode($email), $ref = 1)
			if($this->Email->sendActivationMail("Developer Testing", urldecode($email), $ref = 1)){
				echo "Mail Sent";
			}else{
				echo "Failed";
			}
		}
		
		public function testSMS($num = '8979578267', $msg = "Hi, This is Test SMS."){
			//$msg = "We need to think through the second, third, fourth projects an actor will get involved in. If you're just sending a message from the bottom right button, the actor is NOT tagged in a project! Also, once they're in db, we have no way of adding project tags.";
			$this->load->model("SMS");
			if($res = $this->SMS->sendInvitaionSMS($msg, $num, 0)){
				echo "<pre>";
				print_r(json_decode($res, true));
			}else{
				echo "SMS Failed";
			}
		}
		
		public function myIP(){
			echo $this->input->ip_address();
		}

		public function password( $pass = '' ){
			echo $pass = hash_hmac('sha512', $pass, $this->config->item("encryption_key"));
		}
		
	}

?>