<?php

	class Email extends CI_Model {

		public function sendActivationMail($name = '', $email = '', $ref = ''){

			// Generate Confirmation Links....
			$cipher_text = $this->getEncryptedText($email . '_' . $ref);

			$link = base_url() . "secure/confirm/" . urlencode($cipher_text);

			$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'tls://smtp.gmail.com',
						'smtp_port' => 587,
						'smtp_user' => '',
						'smtp_pass' => ''
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@stageshastra.com", 'StageShastra');
			$this->email->reply_to("no-reply@stageshastra.com", 'StageShastra');
			$this->email->to($email);

			$this->email->subject("Thank You for Signing Up | Confirmation Link | StageShastra");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="http://stageshastra.com/img/logo.png" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							Welcome to StageShastra, Click the button below to confirm your account.
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team StageShastra</span>
					</font>
					<a href="'.$link.'"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Click Here</button></a>
				</div>';
			$this->email->message($message);

			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				// show_error($this->email->print_debugger());
				return false;
			}
		}

		public function getEncryptedText($text = ''){
			$this->load->library('encrypt');
			return $this->encrypt->encode($text);
		}

		public function sendPassCode($email = '', $passCode = 0){
			

			$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'tls://smtp.gmail.com',
						'smtp_port' => 587,
						'smtp_user' => '',
						'smtp_pass' => ''
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@stageshastra.com", 'StageShastra');
			$this->email->reply_to("no-reply@stageshastra.com", 'StageShastra');
			$this->email->to($email);

			$this->email->subject("Password Code | Forgot Password | StageShastra");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="http://stageshastra.com/img/logo.png" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear User,<br>
						<span id="message">
							Please enter the given Code to change Password.

							<p style="color: #666; border: 1px solid #999; padding: 3px 5px;">{$passCode}</p>

							<p style="color:#999"><i>Do not share this Code with anyone. If haven\'t asked for forgot password, contact: <b>contact@stageshastra.com</b> </i></p>
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team StageShastra</span>
					</font>
					<a href="#"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Code: {$passCode}</button></a>
				</div>';
			$this->email->message($message);

			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				// show_error($this->email->print_debugger());
				return false;
			}
		}

		public function sendAuditionMail($emails = [], $subject = '', $message = ''){
			$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'tls://smtp.gmail.com',
						'smtp_port' => 587,
						'smtp_user' => '',
						'smtp_pass' => ''
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@stageshastra.com", 'StageShastra');
			$this->email->reply_to("no-reply@stageshastra.com", 'StageShastra');
			$this->email->to($emails);

			$this->email->subject("{$subject} | StageShastra");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="http://stageshastra.com/img/logo.png" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							{$message}
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team StageShastra</span>
					</font>
					<a href="http://stageshastra.com/"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >StageShastra</button></a>
				</div>';
			$this->email->message($message);

			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				// show_error($this->email->print_debugger());
				return false;
			}
		}

	}

?>