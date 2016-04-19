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
					'".$data['start']."',
					'".$data['end']."',
					'".$data['link']."',
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
					'".$data['trainer']."',
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

	}


?>