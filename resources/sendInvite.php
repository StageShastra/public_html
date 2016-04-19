<?php
	include_once('db_config.php');
	require_once('mailer.php');
	require_once('sendsms.php');

	if(isset($_POST['submit'])){
		// if form submitted

		// Catching CSEmails and filtering,
		$emails = explode(",", trim($_POST['emails']));
		$filteredEmails = [];
		foreach ($emails as $key => $email) {
			if(filter_var(trim($email), FILTER_VALIDATE_EMAIL)){
				$filteredEmails[] = trim($email);
			}
		}

		// Catching CSMobile Numbers and filtering,

		$mobiles = explode(",", trim($_POST['mobiles']));
		$filteredMobiles = [];
		foreach ($mobiles as $key => $mobile) {
			$filteredMobiles[] = trim($mobile);
		}

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
			$mail->addAddress("connect@stageshastra.com");     // Add a recipient

			foreach ($filteredEmails as $key => $email) {
				$email->AddCC($email);
			}

			$mail->addReplyTo('no-reply@stageshastra.com', 'No Reply');
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Invitation for Audition | StageShastra';

			$mail = '
			<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
				<div class="logo" style="position:absolute;right:200px;top:10px;" >
				<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="http://stageshastra.com/img/logo.png" height="50px" width="50px">
				</div>
				<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
					Dear Actor,<br><br>

					<span id="message">
						{$message}
						<br>
						We are glad to infor you that you ahve been selected for out audition.We will send out email on this channel please join us
					</span>
					<br><br>
					Regards,
					<br>
					<span id="sender">Team StageShastra</span>
				</font>
				<a href="{$link}"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Click Here</button></a>
			</div>';


			$mail->Body = $mail;

			$mail->send();

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


	header("Location: index.php");

?>