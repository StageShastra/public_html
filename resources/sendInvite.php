<?php
	include_once('db_config.php');
	require_once('mailer.php');
	require_once('sendsms.php');

	if(isset($_POST['emails'])){
		// if form submitted
		// Catching CSEmails and filtering,
		$emails = explode(",", trim($_POST['emails']));

		// Catching CSMobile Numbers and filtering,
		session_start();
		$director_ref  = urlencode(trim($_SESSION['login_user']));
		//$string = base64_encode("Director_" . $director_ref);

		$link = "http://www.stageshastra.com/join.php?ref={$director_ref}";

		$message = trim($_POST['message']);
		include_once('../libraries/phpmailer/PHPMailerAutoload.php');

			$mail = new PHPMailer();
			$mail->SMTPDebug = 2;                               // Enable verbose debug output
			$mail->Debugoutput = 'html';
			//$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = '';                 // SMTP username
			$mail->Password = '';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('no-reply@stageshastra.com', 'StageShastra');
			$mailto = $_POST['emails'];
			$addr = explode(',',$mailto);
			foreach ($addr as $ad) {
		    	$mail->AddAddress( trim($ad) );       
			}     // Add a recipient

			$mail->addReplyTo('no-reply@stageshastra.com', 'No Reply');
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Invitation to create profile | StageShastra';
			$mailmsg = '
			<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
				<div class="logo" style="position:absolute;right:200px;top:10px;" >
				<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <b>STAGE</b> SHASTRA
				</div>
				<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					Dear Actor,<br><br>

					<span id="message">
						'.$message.'
						<br>
					</span>
					<br><br>
					Regards,
					<br>
					<span id="sender">Team StageShastra</span>
				</font>
				<a href="'.$link.'"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Click Here</button></a>
			</div>';


			$mail->Body = $mailmsg;
			$mail->send();
			$text = $_POST['message']."\nYour sign up link is $link";
			//sms sending code
			echo send_text($_POST['mobiles'],$text);

		$time = time();
		$query = "INSERT INTO `beta_invitation_send`(`id`, `director_ref`, `message`, `emails`, `emails_failed`, `mobiles`, `mobile_failed`, `timestamp`) 
			VALUES (
				null,
				'{$director_ref}',
				'{$message}',
				'".json_encode($filteredEmails)."',
				'',
				'".json_encode($filteredMobiles)."',
				'',
				'{$time}'
			)";
		$runSQL = mysqli_query($con, $query);

	}
	else
	{
		header("Location:../index.php");	
	}

	

?>