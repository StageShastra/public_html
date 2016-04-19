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

	session_start();
	session_regenerate_id();

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

					case "EditMobile":
						$this->editMobileNumber($data);
						break;

					case "EditWhatsApp":
						$this->editWhatsAppNumber($data);
						break;

					case "EditMinMaxAge":
						$this->editMinMaxAge($data);
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

					case "ActorSignUp":
						$this->actorSignUp($data);
						break;

					case "ActorLogin":
						$this->actorLogin($data);
						break;

					default:
						$this->response(false, "Invalid Request");
						break;
				}

			}else{
				$this->response(false, "No Request Token Found!!!");
			}

		}

		public function actorLogin($data = []){
			$db = $this->includeDB();

			if($db->isActorExist($data['email'])){
				$data['password'] = md5($data['password']);
				if($db->verifyActorLogin($data['email'], $data['password'])){
					$db->setSession($data['email']);
					$this->response(true, "Login Success", $_SESSION);
				}else{
					$this->response(false, "Some Error Occured!!!");
				}
			}else{
				$this->response(false, "This user already do not exist.");
			}
		}

		public function actorSignUp($data = []){
			$db = $this->includeDB();

			if(!$db->isActorExist($data['email'])){
				$data['password'] = md5($data['password']);
				$data['time'] = time();
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				if($db->insertNewActor($data)){

					$db->sendConfirmationLink($data['fullname'], $data['email']);
					$this->response(true, "You are Successfully signed up, please check your email for  confirmation link.");
				}else{
					$this->response(false, "Some Error Occured!!!");
				}
			}else{
				$this->response(false, "This user already exist. Please login.");
			}
		}

		public function editActorTraining($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['table_ref'];
			$key = (int)$data['key'];

			$data['title'] = trim($data['tr_title_'.$key]);
			$data['course'] = trim($data['tr_course_'.$key]);
			$data['blurb'] = trim($data['tr_blurb_'.$key]);
			$data['start'] = trim($data['tr_start_'.$key]);
			$data['end'] = trim($data['tr_end_'.$key]);

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
			$ref = $this->actor_id;
			$data['time'] = time();

			if($db->insertActorTraining($ref, $data)){
				$this->response(true, "Actor Training Added");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function addActorExperience($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$ref = $this->actor_id;
			$db = $this->includeDB(); // including Database Connection.
			$data['time'] = time();
			
			if($db->insertActorExperience($ref, $data)){
				$this->response(true, "Actor Experience Added");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

		public function editActorExperience($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['table_ref'];
			$key = (int)$data['key'];
			$data['title'] = $data['ex_title_'.$key];
			$data['blurb'] = $data['ex_blurb_'.$key];
			$data['role'] = $data['ex_role_'.$key];
			if($db->updateActorExperience($ref, $data)){
				$this->response(true, "Actor Experience Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

		public function editActorWeight($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$weight = $data['weight'];
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
			$height = $data['height'];
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
			$language = $data['language'];
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
			$skills = $data['skills'];
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
			$dob = strtotime(str_replace("/", "-", $data['dob']));
			if($db->updateActorProfileData($ref, $dob, "dob")){
				$this->response(true, "Actor Date Of Birth Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}

		}

		public function editMinMaxAge($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$min = trim($data['min_age']);
			$max = trim($data['max_age']);
			if($db->updateMinMaxAge($ref, $min, $max)){
				$this->response(true, "Actor WhatsApp Number Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

		public function editWhatsAppNumber($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$val = trim($data['whatsapp']);
			if($db->updateActorProfileData($ref, $val, "whatsapp")){
				$this->response(true, "Actor WhatsApp Number Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

		public function editMobileNumber($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$val = trim($data['phone']);
			if($db->updateActorProfileData($ref, $val, "mobile")){
				$this->response(true, "Actor Mobile Number Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

		public function editActorName($data = []){
			if(!$this->actor_login)
				$this->response(false, "You are not loggedIn.");

			$db = $this->includeDB(); // including Database Connection.
			$ref = (int)$data['actor_ref'];
			$name = $data['name'];
			$gender = (strtolower($data['sex']) == 'm') ? 1 : 0;
			if($db->updateActorNameSex($ref, $name, $gender)){
				$this->response(true, "Actor Name Updated");
			}else{
				$this->response(false, "Some Error Occured.");
			}
		}

	}


	// Creating Object of Ajax

	$ajax = new Ajax;

?>