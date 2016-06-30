<?php
	class Email extends CI_Model {
		
		public $img = "http://castiko.com/assets/img/logo.png";
		
		public function config(){
			$config = array();
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.zoho.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'no-reply@castiko.com';
			$config['smtp_pass']    = '1q2w3e4rA';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE; // bool whether to validate email or not
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			
			return $config;
		}
		
		
		
		public function sendActivationMail($name = '', $email = '', $ref = ''){
			// Generate Confirmation Links....
			$cipher_text = $this->getEncryptedText($email . '=' . $ref);
			$cipher_text = str_replace("/", "_", $cipher_text);
			$link = base_url() . "secure/confirm/" . urlencode($cipher_text);
			
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);
			$this->email->subject(Em_ActMail_subject);
			$msg = Em_ActMail_msg;
			$message = $this->defaultTemplete($msg, $link, "Confirm Email");
			
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				//echo $this->email->print_debugger();
				return false;
			}
		}
		
		
		public function getEncryptedText($text = ''){
			$this->load->library('encrypt');
			return $this->encrypt->encode($text);
		}
		
		
		public function sendPassCode($email = '', $passCode = 0){
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);
			$this->email->subject(Em_PassCode_subject);

			$msg = "Dear user, <br>please enter code below to change password.
					<center><b>".$passCode."</b></center>";
			$msg .= "<p>Do not share this Code with anyone. </p>";
			$msg .= "<p>If you have any questions, please email us at <b>connect@castiko.com</b></p>";


			$message = $this->defaultTemplete($msg);
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
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to("connect@castiko.com");
			$this->email->bcc($emails);
			
			$this->email->subject("{$subject} | Castiko");
                        $name = $this->session->userdata("StaSh_User_name");
                        
			$message = $this->defaultTemplete("Dear Actor, <br>" . $message,'','','');
                        $message = preg_replace('~\\\r\\\n~',"<br>", $message);
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				// show_error($this->email->print_debugger());
				return false;
			}
		}

		public function sendAuditionMailUpdated($to = '', $time = 0, $msg = 0){
			$this->load->library('email', $this->config());
			$failedEmails = [];
			$plainText = json_encode(array($this->session->userdata("StaSh_User_id"), $to, $time, $msg));
			$encryptedText = $this->getEncryptedText($plainText);
			$encryptedText = str_replace("/", "_", $encryptedText);
			$link = base_url() . "project/notification/" . urlencode($encryptedText);

			$msg = str_replace("__PUT_DIRECTOR_NAME_HERE__", $this->session->userdata("StaSh_User_name"), Em_AudiMail_message);
			$msg .= Em_AudiMail_ifQues;

			$message = $this->defaultTemplete("Dear Actor, <br>".$msg, $link, "View Message", "");
			$message = preg_replace('~\\\r\\\n~',"<br>", $message);
			$this->email->clear();
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->subject(Em_AudiMail_subject . " | Castiko");
			$this->email->to($to);
			$this->email->message($message);
			if(!$this->email->send()){
				return true;
			}
			return true;
		}

		public function sendInvitationToInDB($msg = '', $to = '', $project = 0, $rand = '', $sub = "Connect to Casting Director"){
			$this->load->library('email', $this->config());
			$failedEmails = [];
			$plainText = json_encode(array($this->session->userdata("StaSh_User_id"), $project, time(), $to, $rand));
			$encryptedText = $this->getEncryptedText($plainText);
			$encryptedText = str_replace("/", "_", $encryptedText);
			$link = base_url() . "home/connect/" . urlencode($encryptedText);
			$message = $this->defaultTemplete("Dear Actor, <br>".$msg, $link, "Connect", "");
			$message = preg_replace('~\\\r\\\n~',"<br>", $message);
			$this->email->clear();
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->subject("{$sub} | Castiko");
			$this->email->to($to);
			$this->email->message($message);
			if(!$this->email->send()){
				return $to;
			}
			return true;
		}
		public function sendInvitationToNotInDB($msg = '', $to = '', $project = 0, $rand = '', $sub = "Invitation "){
			$this->load->library('email', $this->config());
			$failedEmails = [];
			$plainText = json_encode(array($this->session->userdata("StaSh_User_id"), $project, time(), $to, $rand));
			$encryptedText = $this->getEncryptedText($plainText);
			$encryptedText = str_replace("/", "_", $encryptedText);
			$link = base_url() . "home/join/" . urlencode($encryptedText);
			$message = $this->defaultTemplete("Dear Actor, <br>".$msg, $link, "Accept Invitation", "");
			$message = preg_replace('~\\\r\\\n~',"<br>", $message);
			$this->email->clear();
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->subject("{$sub} | Castiko");
			$this->email->to($to);
			$this->email->message($message);
			if(!$this->email->send()){
				return $to;
			}
			return true;
		}		
		public function sendInvitaionMail($msg = '', $emails = [], $project = 0, $sub = 'Invitation'){
			$inDB = $this->sendInvitationToInDB($msg, $emails['inDB'], $project);
			$notInDB = $this->sendInvitationToNotInDB($msg, $emails['notInDB'], $project);
			$failInDB = count($inDB);
			$failnotInDB = count($notInDB);
			$totalFailed = $failnotInDB + $failInDB;
			$mergeFailed = array("inDB" => $failInDB, "notInDB" => $failnotInDB);
			$mailInDB = count($emails['inDB']);
			$mailnotInDB = count($emails['notInDB']);
			$totalEmails = $mailInDB + $mailnotInDB;
			if($totalEmails == $totalFailed){
				return false;
			}else{
				if($totalFailed){
					$this->insertFailedInvitations($mergeFailed, $msg, $project);
				}
				return true;
			}
		}
		public function insertFailedInvitations($emails = [], $msg = '', $project = 0){
			$data = array(
						'StashFailedInvite_id' => null,
						'StashFailedInvite_director_id_ref' => $this->session->userdata("StaSh_User_id"),
						'StashFailedInvite_msg' => $msg,
						'StashFailedInvite_project' => $project,
						'StashFailedInvite_emails' => json_encode($emails),
						'StashFailedInvite_type' => $type,
						'StashFailedInvite_time' => time()
					);
			$this->db->insert("stash-failed-invitation", $data);
		}


		public function sendPasswordResetMail($email = '', $ip = ''){
			
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);
			$this->email->subject(Em_ResetSucc_subject);

			$msg = Em_ResetSucc_msg . "This reset is done from IP: {$ip}.";
			$message = $this->defaultTemplete($msg);
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				//echo $this->email->print_debugger();
				return false;
			}

		}

		public function sendWelcomeMail($email = '', $name = '', $type = ''){
			
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to($email);
			$this->email->subject(Em_Welcome_subject);

			if($type == 'director'){
				$msg = "Hello {$name}, <br>" . Em_Welcome_msg_director;
			}else{
				$msg = completion_template();
			}
			
			$message = $this->defaultTemplete($msg);
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				//echo $this->email->print_debugger();
				return false;
			}

		}

		public function sendReminderMail($emails = []){
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to("connect@castiko.com");
			$this->email->bcc($emails);
			$this->email->subject(Em_Reminder_subject);

			$msg = Em_Reminder_msg;
			
			$message = $this->defaultTemplete($msg);
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				//echo $this->email->print_debugger();
				return false;
			}
		}

		public function sendAdminPanelMail($data = []){
			$this->load->library('email', $this->config());
			$this->email->set_newline("\n");
			$this->email->from("no-reply@castiko.com", 'Castiko');
			$this->email->reply_to("no-reply@castiko.com", 'Castiko');
			$this->email->to( $data['to'] );
			if(!empty($data['cc']))
				$this->email->cc($data['cc']);
			if(!empty($data['bcc']))
				$this->email->cc($data['bcc']);
			$this->email->subject($data['subject']);

			$message = $this->defaultTemplete($data['message']);
			
			$this->email->message($message);
			if($this->email->send()){
				return true;
			}else{
				// for Developer Only
				//echo $this->email->print_debugger();
				return false;
			}
		}
		public function completion_template(){
			$mail = '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body style="font-family: &quot;Lucida Sans Unicode&quot;,&quot;Lucida Grande&quot;;font-size: 15px;"><div class="outer" style="padding: 5%;background: #F05759;background-image: linear-gradient(29deg, rgb(226, 162, 17) 3%, rgba(216, 115, 27, 0.86) 20%, rgba(195, 15, 76, 0.86) 100%, rgb(255, 0, 35) 10%);"><div class="container" style="border-radius: 15px;padding: 10px 25px;background: white;"><center><img src="'.IMG.'/email_logo.png" style="display: block;max-width: 100%;height: auto;"></center><hr style="background: #ddd;"><span class="salutation" style="font-size: 22px;color: #777;">Congratulations!</span><br>Your Castiko profile is now visible to the casting directors who have you in their database.</b>.<br><b> But we noticed that your profile is still incomplete.</b><center><img src=""'.IMG.'/complete_profile_emailer.png" style="display: block;max-width: 100%;height: auto;"></center><br><b>For Casting Directors to call you for auditions, adding your videos, photographs and experiences is crucial!</b><br>A complete profile will let you fully experience the power of Castiko.<br><center><img src=""'.IMG.'/macbook_actor_register.png" style="display: block;max-width: 100%;height: auto;"><br></center><div class="row" style="display: table;float: none;"><div class="sm-4" style="width: 100%;float: left;"><center><img src=""'.IMG.'/crosshair.png" style="height: 100px;display: block;max-width: 100%;"></center><center> <span class="sub_heading"> GET NOTICED </span></center><div class="small_text" style="font-size: 16px;color: #4a4a4a;padding: 5px 10px;text-align: center;">When they are looking for talent, <b> the first thing a Casting Director wants to see is photos and videos of you</b></div></div><div class="sm-4" style="width: 100%;float: left;"><center><img src=""'.IMG.'/search.png" style="height: 100px;display: block;max-width: 100%;"></center><center> <span class="sub_heading"> BE SEARCHABLE </span></center><div class="small_text" style="font-size: 16px;color: #4a4a4a;padding: 5px 10px;text-align: center;">If anyone looks you up on Google, your Castiko profile will show up as one of the top results.</div></div><div class="sm-4" style="width: 100%;float: left;"><center><img src=""'.IMG.'/share.png" style="height: 100px;display: block;max-width: 100%;"></center><center> <span class="sub_heading"> SHARE UNIQUELY </span></center><div class="small_text" style="font-size: 16px;color: #4a4a4a;padding: 5px 10px;text-align: center;">Your profile has a unique shareable link which you can send to anyone you want to. All changes you make are live instantly.</div></div></div><br><br><center><a href="http://castiko.com/actor?referer=completion_mail"><button class="btn" style="position: relative;bottom: -30px;border: 3px solid #F05759;border-radius: 40px;font-size: 18px;color: #000;background-color: #fff;transition: all .3s ease-in-out;margin-right: 10px;padding: 1% 3%;text-transform: uppercase;">Complete Your Profile</button></a></center></div><div class="footer"><br><center><span class="footer_small" style="font-size: 12px;color: white;">Questions or comments? Write to us at connect@castiko.com<br>We usually reply within 24 hours<p class="footer_copyright" style="font-size: 10px;color: rgba(255,255,255,0.7);">Copyright © 2016 Castiko, All rights reserved.<br>C-411, Kailas Business Park, Vikhroli, Mumbai-79</p></span></center></div></div></body></html>';
			return $mail;

		}
		public function defaultTemplete($msg = '', $link = '', $linkname = '', $sender = ''){
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
				                            <table  cellpadding=\"0\" cellspacing=\"0\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;width:100%;\" >
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
				                                    <td class=\"content-block\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;\" >".$sender."
				                                       <br><span style='color:#9b9b9b;'>Powered By CASTIKO</span>
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
				                                
				                        $mail .= "
				                        </td>
				                    </tr>
				                </table>
				                <div class=\"footer\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;width:100%;clear:both;color:#999;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;\" >
				                    <table width=\"100%\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                        <tr style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;font-size:14px;\" >
				                            <td class=\"aligncenter content-block\" style=\"margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;box-sizing:border-box;vertical-align:top;padding-top:0;padding-bottom:20px;padding-right:0;padding-left:0;text-align:center;font-size:12px;\" >
				                                If you are not supposed to get this email, please ignore it.
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