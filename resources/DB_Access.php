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
					  `StashActorExperience_role`= '".$data['role']."',
					  `StashActorExperience_start_time`= '".$data['start']."',
					  `StashActorExperience_end_time`= '".$data['end']."',
					  `StashActorExperience_link`= '".$data['link']."'
					  WHERE StashActorExperience_id = {$ref} LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

		public function insertActorExperience($ref = 0, $data = []){
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
					  `StashActorTraining_trainer`= '".$data['trainer']."',
					  `StashActorTraining_start_time`= '".$data['start']."',
					  `StashActorTraining_end_time`= '".$data['end']."',
					  `StashActorTraining_blurb` = '".$data['blurb']."'
					  WHERE StashActorTraining_id = {$ref} LIMIT 1";
			$runSql = $this->connection->query($query);
			return ($this->connection->affected_rows) ? true : false;
		}

	}


?>