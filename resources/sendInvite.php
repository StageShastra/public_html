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

		$director_ref  = urlencode(trim($_POST['director']));
		//$string = base64_encode("Director_" . $director_ref);

		$link = "http://www.stageshastra.com/join.php?ref={$director_ref}";

		$message = trim($_POST['message']);
		include_once('../templetes/email_templetes.php');

		/*
			TODO: 
			variable $email_templete has message and templete,
			send this to PHPMailer.
			Make a loop of mails...
			
		*/

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

?>