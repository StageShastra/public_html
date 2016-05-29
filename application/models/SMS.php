<?php
	class SMS extends CI_Model {
		protected $username = "shiv@castiko.com";
		protected $password = "d7cb41660e65f01d6fa6d632c5856f98b74966d5";
		protected $sender = 'CSTIKO';
		protected $prefix = "Dear Actor, ";
		protected $url = "http://api.textlocal.in/send/?";
		protected $test = 0;
		
		
		public function filterCode($arr = []){
			$nums = [];
			foreach ($arr as $key => $value) {
				$num = '91' . trim($value);
				$nums[] = $num;
			}
			return $nums;
		}
		public function numImpode($arr = []){
			$num = '';
			foreach ($arr as $key => $value)
				$num .= ('91' . trim($value)) . ",";
			return rtrim($num, ",");
		}
		
		public function sendCurlSMS($data = []){
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}
		
		public function sendAuditionSMS($numbers = [], $msg = ''){
			$len = strlen($msg);
			$postmessage = "\nPowered By. Castiko";
			$msg = $this->prefix.$msg;
			$msg .= $postmessage;
			$msg = rawurlencode($msg);
			
			$numbers = implode(",", $this->filterCode($numbers));
			
			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg,
						'test' => $this->test
					);
			
			return $this->sendCurlSMS($data);
		}
		
		public function sendInvitaionSMS($msg = '', $numbers = '', $link = ''){
			$len = strlen($msg);
			$postmessage = "\nPowered By. Castiko";
			
			$msg = $this->prefix.$msg;
			$msg .= "\n".$link;
			$msg .= $postmessage;
			
			$msg = rawurlencode($msg);
			$numbers = $this->numImpode(explode(",", $numbers));
			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg,
						"test" => $this->test
					);
					
			return $this->sendCurlSMS($data);
		}

		public function sendOTP($otp = '', $numbers = ''){
			//$len = strlen($msg);
			$postmessage = "\nPowered By. Castiko";
			
			$msg = $this->prefix;

			$msg .= " " . $otp . ": Enter this OTP to verify your mobile number.";

			$msg .= $postmessage;
			
			$msg = rawurlencode($msg);
			$numbers = $this->numImpode(explode(",", $numbers));
			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg,
						"test" => $this->test
					);
					
			return $this->sendCurlSMS($data);
		}
	}
?>