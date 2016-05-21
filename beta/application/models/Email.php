<?php

	class Email extends CI_Model {
		
		public $img = "http://beta.castiko.com/assets/img/logo.png";

		public function sendActivationMail($name = '', $email = '', $ref = ''){

			// Generate Confirmation Links....
			$cipher_text = $this->getEncryptedText($email . '_' . $ref);

			$link = base_url() . "secure/confirm/" . urlencode($cipher_text);

			$config = array(
						'mailtype' => 'html'
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);

			$this->email->subject("Thank You for Signing Up | Confirmation Link | Castiko");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="'.$this->img.'" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							Welcome to Castiko, Click the button below to confirm your account.
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team Castiko</span>
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
						'mailtype' => 'html'
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);

			$this->email->subject("Password Code | Forgot Password | Castiko");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="'.$this->img.'" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear User,<br>
						<span id="message">
							Please enter the given Code to change Password.

							<p style="color: #666; border: 1px solid #999; padding: 3px 5px;">'.$passCode.'</p>

							<p style="color:#999"><i>Do not share this Code with anyone. If haven\'t asked for forgot password, contact: <b>contact@castiko.com</b> </i></p>
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team Castiko</span>
					</font>
					<a href="#"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Code: '.$passCode.'</button></a>
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
						'mailtype' => 'html'
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($emails);

			$this->email->subject("{$subject} | Castiko");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="'.$this->img.'" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							{$message}
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team Castiko</span>
					</font>
					<a href="http://castiko.com/"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Castiko</button></a>
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

		public function sendInvitaionMail($msg = '', $emails = '', $project = 0){
			$plainText = $this->session->userdata("StaSh_User_id") . "_" . $project . "_" . time();
			$encryptedText = $this->getEncryptedText($plainText);

			$link = base_url() . "home/join/" . urlencode($encryptedText);

			$config = array(
						'mailtype' => 'html'
					);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$to = [];
			$emails = explode(",", $emails);
			foreach ($emails as $key => $mail) {
				$to[] = trim($mail);
			}
			$this->email->to($to);
			$name = $this->session->userdata("StaSh_User_name");
			$this->email->subject("Invitaion | Castiko");
			$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="'.$this->img.'" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							'.$msg.'
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">'.$name.'</span>
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

	}

?>