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

			$message = $this->defaultTemplete("Dear User, </br>Welcome to Castiko, Click the button below to confirm your account.", $link, "Confirm Email");


			/*$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
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
				</div>';*/
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

			$msg = "Dear User </br>Please enter the given Code to change Password.
					<p><b>".$passCode."</b></p>";
			$msg .= "<p style='color:#999'><i>Do not share this Code with anyone. If haven't asked for forgot password, contact: <b>contact@castiko.com</b> </i></p>";
			$message = $this->defaultTemplete($msg);

			/*$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
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
				</div>';*/
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
			$message = $this->defaultTemplete("Dear Actor, </br>" . $message);
			/*$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					<div class="logo" style="position:absolute;right:200px;top:10px;" >
					<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="'.$this->img.'" height="50px" width="50px">
					</div>
					<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
						Dear Actor,<br>
						<span id="message">
							'.$message.'
						</span>
						<br><br>
						Regards,
						<br>
						<span id="sender">Team Castiko</span>
					</font>
					<a href="http://castiko.com/"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Castiko</button></a>
				</div>';*/
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

			$message = $this->defaultTemplete("Dear Actor, </br>".$msg, $link, "Accept Invitation", $name);

			/*$message = '<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
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
				</div>';*/
			$this->email->message($message);

			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				// show_error($this->email->print_debugger());
				return false;
			}
		}

		public function defaultTemplete($msg = '', $link = '', $linkname = '', $sender = 'Team Castiko'){


			$mail = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
				<html xmlns=\"http://www.w3.org/1999/xhtml\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				<head style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				    <meta name=\"viewport\" content=\"width=device-width\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" />
				    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" />
				    <title style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >CASTIKO</title>
				</head>

				<body style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100% !important;height:100%;line-height:1.6;background-color:#f6f6f6;\" >

				<table class=\"body-wrap\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;background-color:#f6f6f6;width:100%;\" >
				    <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				        <td style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;\" ></td>
				        <td class=\"container\" width=\"600\" style=\"padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;display:block !important;max-width:600px !important;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;clear:both !important;\" >
				            <div class=\"content\" style=\"font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;display:block;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;\" >
				                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;background-color:#fff;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-width:1px;border-style:solid;border-color:#e9e9e9;border-radius:3px;\" >
				                    <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                        <td class=\"content-wrap\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;\" >
				                            <table  cellpadding=\"0\" cellspacing=\"0\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >



				                                <tr class=\"content-img\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;text-align:center;float:none;\" >
				                                    <td style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;\" >


				                                        <img class=\"img-responsive\" src='".$this->img."' style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;max-width:100%;\" />


				                                        <h2 style=\"padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;box-sizing:border-box;font-family:'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;color:#000;margin-top:20px;margin-bottom:0;margin-right:0;margin-left:0;line-height:1.2;font-weight:400;font-size:24px;\" >C A S T I K O</h2>

				                                    </td>
				                                </tr>



				                                <tr class=\"content-img\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;text-align:center;float:none;\" >
				                                    <td style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;\" >
				                                        <hr id=\"hair-line\" style=\"margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;margin-top:10px;border-color:#c9c9c9;opacity:0.5;\" >
				                                    </td>
				                                </tr>


				                                <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                                    <td class=\"content-block\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;\" >
				                                        ".$msg."
				                                    </td>
				                                </tr>


				                                <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                                    <td class=\"content-block\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;\" >
				                                        Regards,
				                                        </br>
				                                        ".$sender."
				                                    </td>
				                                </tr>";

				                            if($link != ''){
				                            	$mail .= "<tr class=\"content-img\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;text-align:center;float:none;\" >
				                                    <td style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;\" >
				                                        <hr id=\"hair-line\" style=\"margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;margin-top:10px;border-color:#c9c9c9;opacity:0.5;\" >
				                                    </td>
				                                </tr>


				                                <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                                    <td class=\"content-block aligncenter\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;text-align:center;\" >


				                                        <a href='".$link."' class=\"btn-primary bottom-tr\" style=\"margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;text-decoration:none;color:#FFF;background-color:#FBB515;border-style:solid;border-color:#FBB515;border-width:5px 10px;line-height:2;font-weight:bold;text-align:center;cursor:pointer;display:inline-block;border-radius:5px;text-transform:capitalize;margin-top:15px;\" >

				                                        ".$linkname."

				                                        </a>


				                                    </td>
				                                </tr>";
				                            }


				                                


				                        $mail .= "</table>
				                        </td>
				                    </tr>
				                </table>
				                <div class=\"footer\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;width:100%;clear:both;color:#999;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;\" >
				                    <table width=\"100%\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                        <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                            <td class=\"aligncenter content-block\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;text-align:center;font-size:12px;\" >
				                                If you are not suppose to get this email. Please ignore it.
				                            </td>
				                        </tr>
				                    </table>
				                </div></div>
				        </td>
				        <td style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;\" ></td>
				    </tr>
				</table>

				</body>
				</html>";

			return $mail;
		}

	}

?>