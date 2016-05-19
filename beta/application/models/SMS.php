<?php

	class SMS extends CI_Model {

		protected $username = "shiv@castiko.com";
		protected $password = "caeb09b6e744ff77ac8eb03db658d4a73a1ee73a";
		protected $sender = 'STGSHS';
		protected $prefix = "Dear Actor, ";
		protected $suffix = "\nPowered By. StageShastra";
		protected $url = "http://api.textlocal.in/send/?";
		protected $test = 0;

		public function sendAuditionSMS($numbers = [], $msg = ''){
			$numbers = implode(",", $this->filterCode($numbers));
			
			$msg .= $this->suffix;
			$msg = rawurlencode($msg);

			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg,
						'test' => $this->test
					);

			print_r($data);
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			print_r($response);
			// Process your response here
			return $response;
		}

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

		public function sendInvitaionSMS($msg = '', $numbers = '', $project = ''){
			$msg = $this->prefix . $msg;
			$msg .= $this->session->userdata("StaSh_User_name");
			$msg .= $this->suffix;

			// Short Link is to be made...

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

			print_r($data);
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			print_r($response);
			return $response;
		}

	}

?>