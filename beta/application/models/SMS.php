<?php

	class SMS extends CI_Model {

		protected $username = "shiv@stageshastra.com",
				  $password = "Stash123",
				  $sender = urlencode("STGSHS"),
				  $suffix = "\nPowered By. StageShastra",
				  $url = "http://api.textlocal.in/send/";

		public function sendAuditionSMS($numbers = [], $msg = ''){
			$numbers = $this->numImpode($numbers);
			$msg = rawurlencode($msg);
			$msg .= $this->suffix;

			$data = array(
						'username' => $this->username, 
						'password' => $this->password, 
						'numbers' => $numbers, 
						"sender" => $this->sender, 
						"message" => $msg
					);
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			
			// Process your response here
			return $response;
		}

		public function numImpode($arr = []){
			$num = '';
			foreach ($arr as $key => $value)
				$num .= trim($value) . ",";
			return rtrim($num, ",");
		}

	}

?>