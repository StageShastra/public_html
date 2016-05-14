<?php

	class SMS extends CI_Model {

		protected $username = "shiv@stageshastra.com";
		protected $password = "Stash123";
		protected $sender = 'STGSHS';
		protected $suffix = "\nPowered By. StageShastra";
		protected $url = "http://api.textlocal.in/send/";

		public function sendAuditionSMS($numbers = [], $msg = ''){
			$numbers = implode(",", $this->filterCode($numbers));
			
			$msg .= $this->suffix;
			$msg = rawurlencode($msg);

			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg
					);

			print_r($data);
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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
				$num .= (int) ('91' . trim($value)) . ",";
			return rtrim($num, ",");
		}

		public function sendInvitaionSMS($numbers = '', $msg = '', $project = ''){
			$msg .= $this->session->userdata("StaSh_User_name");
			$msg .= $this->suffix;

			// Short Link is to be made...

			$msg = rawurlencode($msg);

			$data = array(
						'username' => $this->username, 
						'hash' => $this->password, 
						'numbers' => $numbers, 
						"sender" => urlencode($this->sender), 
						"message" => $msg
					);

			print_r($data);
			$ch = curl_init($this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			print_r($response);
			return $response;
		}

	}

?>