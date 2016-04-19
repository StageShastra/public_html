<?php

	include_once 'constants.php';

	class DB_Access {

		private $connection;

		function __construct() {
			$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($connection->connect_errno){
				die("Sorry, Some Database Error Occured ".$connection->error);
			}

			$this->connection = $connection;
		}

		public function updateActorNameSex($ref = 0, $name = '', $sex = 1){
			$query = "UPDATE beta_actor_profile
					  SET StashActor_name = '{$name}', StashActor_gender = '{$sex}' 
					  WHERE StashActor_actor_ref = {$ref}
					  LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function updateMinMaxAge($ref = 0, $min = 0, $max = 0){
			$query = "UPDATE beta_actor_profile
					  SET StashActor_min_role_age = '{$min}', StashActor_max_role_age = '{$max}'
					  WHERE StashActor_actor_ref = {$ref}
					  LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function updateActorProfileData($ref = 0, $value = '', $field = ''){
			$query = "UPDATE beta_actor_profile 
						SET StashActor_{$field} = '{$value}'
						WHERE StashActor_actor_ref = {$ref}
						LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function insertActorExperience($ref = 0, $data = []){
			$query = "INSERT INTO `beta_actor_experience`(`StashActorExperience_id`, `StashActorExperience_actor_ref`, `StashActorExperience_title`, `StashActorExperience_blurb`, `StashActorExperience_role`, `StashActorExperience_start_time`, `StashActorExperience_end_time`, `StashActorExperience_link`, `StashActorExperience_time`, `StashActorExperience_verify`, `StashActorExperience_status`) 
				VALUES (
					null,
					'{$ref}',
					'".$data['title']."',
					'".$data['blurb']."',
					'".$data['role']."',
					'',
					'',
					'',
					'".$data['time']."',
					'0',
					'1'
				)";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function updateActorExperience($ref = 0, $data = []){
			$query = "UPDATE `beta_actor_experience` 
					  SET `StashActorExperience_title`= '".$data['title']."',
					  `StashActorExperience_blurb`= '".$data['blurb']."',
					  `StashActorExperience_role`= '".$data['role']."'
					  WHERE StashActorExperience_id = {$ref} LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function insertActorTraining($ref = 0, $data = []){
			$query = "INSERT INTO `beta_actor_training`(`StashActorTraining_id`, `StashActorTraining_actor_ref`, `StashActorTraining_title`, `StashActorTraining_course`, `StashActorTraining_blurb`, `StashActorTraining_intitute_ref`, `StashActorTraining_trainer`, `StashActorTraining_start_time`, `StashActorTraining_end_time`, `StashActorTraining_time`, `StashActorTraining_verify`, `StashActorTraining_status`) 
				VALUES (
					null,
					'{$ref}',
					'".$data['title']."',
					'".$data['course']."',
					'".$data['blurb']."',
					'0',
					'',
					'".$data['start']."',
					'".$data['end']."',
					'".$data['time']."',
					'0',
					'1'
				)";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function updateActorTraining($ref = 0, $data = []){
			$query = "UPDATE `beta_actor_training` 
					  SET `StashActorTraining_title`= '".$data['title']."',
					  `StashActorTraining_course`= '".$data['course']."',
					  `StashActorTraining_start_time`= '".$data['start']."',
					  `StashActorTraining_end_time`= '".$data['end']."',
					  `StashActorTraining_blurb` = '".$data['blurb']."'
					  WHERE StashActorTraining_id = {$ref} LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function isActorExist($email = ''){
			$query = "SELECT * FROM beta_actor WHERE email = '{$email}' LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function insertNewActor($data = []){
			$query = "INSERT INTO `beta_actor`(`id`, `name`, `email`, `mobile`, `password`, `timetamp`, `status`, `ip`) 
					VALUES (
						null,
						'".$data['fullname']."',
						'".$data['email']."',
						'".$data['contact']."',
						'".$data['password']."',
						'".$data['time']."',
						'1',
						'".$data['ip']."'
					)";
			$runSql = $this->connection->query($query);
			$runSQL = $this->connection->query("SELECT LAST_INSERT_ID()");
            $ref = (int)$runSQL->fetch_assoc()['LAST_INSERT_ID()'];

            $whatsapp = ($data['whatsappNo'] == '') ? $data['contact'] : $data['whatsappNo'];

            //Setting up Profile
            $query = "INSERT INTO `beta_actor_profile`(`StashActor_id`, `StashActor_actor_ref`, `StashActor_name`, `StashActor_email`, `StashActor_mobile`, `StashActor_whatsapp`, `StashActor_dob`, `StashActor_gender`, `StashActor_height`, `StashActor_weight`, `StashActor_avatar`, `StashActor_images`, `StashActor_min_role_age`, `StashActor_max_role_age`, `StashActor_address`, `StashActor_city`, `StashActor_state`, `StashActor_country`, `StashActor_zip`, `StashActor_actor_card`, `StashActor_passport`, `StashActor_last_update`, `StashActor_last_ip`, `StashActor_skills`, `StashActor_language`) 
            	VALUES (
            		null,
            		'{$ref}',
            		'".$data['fullname']."',
            		'".$data['email']."',
					'".$data['contact']."',
					'{$whatsapp}',
					'0',
					'1',
					'',
					'',
					'default.png',
					'',
					'',
					'',
					'',
					'',
					'',
					'India',
					'',
					'0',
					'0',
					'".$data['time']."',
					'".$data['ip']."',
					'',
					''
            	)";

            $runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function verifyActorLogin($email = '', $pass=  ''){
			$query = "SELECT * FROM beta_actor WHERE email = '{$email}' AND password = '{$pass}' LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function setSession($email = ''){
			$query = "SELECT * FROM beta_actor WHERE email = '{$email}' LIMIT 1";
			$runSql = $this->connection->query($query);
			$fetch = $runSql->fetch_assoc();

			$_SESSION['STASH_ACTOR_LOGIN'] = true;
			$_SESSION['STASH_ACTOR_ID'] = $fetch['id'];
			$_SESSION['STASH_ACTOR_EMAIL'] = $fetch['email'];
			$_SESSION['STASH_ACTOR_NAME'] = $fetch['name'];
		}

		public function sendConfirmationLink($name = '', $email = ''){

			$plainText = $email . '_' . time();
			$cipherText = base64_encode(base64_encode($plainText));

			$link = "http://stageshastra.com/actor/confirm.php?_token={$cipherText}";
			
			include_once('../libraries/phpmailer/PHPMailerAutoload.php');

			$mail = new PHPMailer();
			$mail->SMTPDebug = 2;                               // Enable verbose debug output
			$mail->Debugoutput = 'html';
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'prasht63@gmail.com';                 // SMTP username
			$mail->Password = 'dontkeepitsimplesilly';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('no-reply@stageshastra.com', 'StageShastra');
			$mail->addAddress($email);     // Add a recipient
			$mail->addReplyTo('no-reply@stageshastra.com', 'No Reply');
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Thank you for Signing Up | StageShastra';

			$mail = '
<div class="center" style="float:none;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
	<div class="logo" style="position:absolute;right:200px;top:10px;" >
	<font class="info gray" style="color:#252323;font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" ><span class="pwdby" style="top:-15px;position:relative;" >Powered By :</span> <img src="http://stageshastra.com/img/logo.png" height="50px" width="50px">
	</div>
	<font class="info dark-gray" style="font-size:18px;font-weight:10;font-family:\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif;" >
		Dear Actor,<br><br>
		<span id="message">
			Welcome to StageShastra, Click buttun below to confirm account.
		</span>
		<br><br>
		Regards,
		<br>
		<span id="sender">Team StageShastra</span>
	</font>
	<a href="{$link}"><button class="bigbutton" style="background-color:#de114b;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:30px;color:white;width:100%;border-width:0px;height:75px;" >Click Here</button></a>
</div>';


			$mail->Body = $mail;

			if($mail->send())
				return true;
			else
				return false;

		}

	}


?>