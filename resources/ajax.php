<?php

/**

	Request Format:
		JSON Object:

		{
			"request":"EditName",
			"data":{
					"actor_ref":1,
					"field_name":"name",
					"field_data":"Dilip Kumar"
				}
		}

*/

	class Ajax {

		protected $actor_id = null,
				  $actor_email = null,
				  $actor_login = false;

		function __construct(){
			
			if(isset($_SESSION['STASH_ACTOR_LOGIN'])){
				$this->actor_login = true;
				$this->actor_id = $_SESSION['STASH_ACTOR_ID'];
				$this->actor_email = $_SESSION['STASH_ACTOR_EMAIL'];
			}

			$this->request();

		}

		public function includeDB($filename = 'DB_Access'){
			if(!file_exists( $filename . ".php" ))
				$filename = "DB_Access";
			require_once $filename .'.php';
			return new $filename();
		}

		public function response($status = false, $msg = null, $data = []){
			header("Content-Type: application/json");
			echo json_encode(array(
							"status" => $status,
							"message" => $msg,
							"data" => $data
						));
			exit();
		}

		public function request($value=''){
			//var_dump($_POST);
			if(isset($_REQUEST['request'])){

				$req = trim($_REQUEST['request']);
				$data = json_decode($_REQUEST['data'], true);


				switch ($req) {
					case "EditName":
						$this->editActorName($data);
						break;

					case "EditDOB":
						$this->editDateOfBirth($data);
						break;

					case "EditSkills":
						$this->editActorSkills($data);
						break;

					case "EditLanguage":
						$this->editActorLanguage($data);
						break;

					case "EditHeight":
						$this->editActorHeight($data);
						break;

					case "EditWeight":
						$this->editActorWeight($data);
						break;

					case "AddExperience":
						$this->addActorExperience($data);
						break;

					case "EditExperience":
						$this->editActorExperience($data);
						break;

					case "AddTraining":
						$this->addActorTraining($data);
						break;

					case "EditTraining":
						$this->editActorTraining($data);
						break;

					default:
						# code...
						break;
				}

			}else{
				$this->response(false, "No Request Token Found!!!");
			}

		}

		public function editActorTraining($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['experience_ref'];

			$data['start'] = strtotime(str_replace("/", "-", $data['start']));
			$data['end'] = strtotime(str_replace("/", "-", $data['end']));
			//$data['time'] = time();

			if($db->updateActorTraining($ref, $data)){
				$this->response(true, "Actor Training Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function addActorTraining($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];

			$data['start'] = strtotime(str_replace("/", "-", $data['start']));
			$data['end'] = strtotime(str_replace("/", "-", $data['end']));
			$data['time'] = time();

			if($db->insertActorTraining($ref, $data)){
				$this->response(true, "Actor Training Added");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editActorWeight($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$weight = $data['field_data'];
			if($db->updateActorProfileData($ref, $weight, "weight")){
				$this->response(true, "Actor weight Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editActorHeight($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$height = $data['field_data'];
			if($db->updateActorProfileData($ref, $height, "height")){
				$this->response(true, "Actor height Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editActorLanguage($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$language = $data['field_data'];
			if($db->updateActorProfileData($ref, $language, "language")){
				$this->response(true, "Actor Language Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editActorSkills($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$skills = $data['field_data'];
			if($db->updateActorProfileData($ref, $skills, "skills")){
				$this->response(true, "Actor Skills Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editDateOfBirth($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$dob = strtotime(str_replace("/", "-", $data['field_data']));
			if($db->updateActorProfileData($ref, $dob, "dob")){
				$this->response(true, "Actor Date Of Birth Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editActorName($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$name = $data['field_data'];
			if($db->updateActorProfileData($ref, $name, "name")){
				$this->response(true, "Actor Name Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

	}


	// Creating Object of Ajax

	$ajax = new Ajax;

?>