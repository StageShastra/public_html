<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Director extends CI_Controller {

		function __construct() {
			parent::__construct();
			if($this->session->userdata("StaSh_User_type") == 'director'){
				$this->load->model("ModelDirector");
				$plan=$this->ModelDirector->getDirectorPlan(0);
				if(!count($plan)){
					redirect(base_url()."payment");
				}
			}
		}

		public function index($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan(0);
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['count_emails'] = $this->ModelDirector->getInvitationEmailCount($this->session->userdata("StaSh_User_id"));
			$pageInfo['count_sms'] = $this->ModelDirector->getInvitationSMSCount($this->session->userdata("StaSh_User_id"));
			$this->load->view("director/home", $pageInfo);
		}

		/*public function profile($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan(0);
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['count_emails'] = $this->ModelDirector->getInvitationEmailCount($this->session->userdata("StaSh_User_id"));
			$pageInfo['count_sms'] = $this->ModelDirector->getInvitationSMSCount($this->session->userdata("StaSh_User_id"));
			$this->load->view("director/castingdirectorprofile", $pageInfo);
		}*/

		public function conversations($value=''){

			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$this->load->view("director/conversations", $pageInfo);
		}
		public function account($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();
			$this->load->view("director/account", $pageInfo);
		}


		public function castingsheet($value=''){
			$pr_details=$this->ModelDirector->getProjectDetails($value);
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director' || !($pr_details["StashProject_director_id_ref"]==$this->session->userdata("StaSh_User_id")))
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();
			$pageInfo['project'] = $this->ModelDirector->getProjectDetails($value);
			$this->load->view("director/castingsheet", $pageInfo);
		}
		public function newproject($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();
			$this->load->view("director/newproject", $pageInfo);
			//echo $value;
		}

		function get_tags(){
			//echo $_GET['term'];
		    $this->load->model('ModelDirector');

		    if (isset($_GET['term']))
		    {

		      $q = strtolower($_GET['term']);
		      $this->ModelDirector->getTags($q);
		    }
		  }
		public function project($value=''){
			$this->load->model("ModelDirector");
			$pr_details=$this->ModelDirector->getProjectDetails($value);
			if($pr_details["StashProject_status"]==2 && ( !$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director'))
			{
				$pageInfo = [];
				$this->load->model("ModelDirector");
				$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
				$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
				$pageInfo['profile'] = $this->ModelDirector->directorProfile();
				$pageInfo['project'] = $this->ModelDirector->getProjectDetails($value);
				$pageInfo['isPublic']=1;
				$this->load->view("director/viewproject", $pageInfo);
			}
			else if(!($pr_details["StashProject_director_id_ref"]==$this->session->userdata("StaSh_User_id")))
			{
				redirect(base_url());
			}
			else
			{
				if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director') 
				redirect(base_url());
				$pageInfo = [];
				$this->load->model("ModelDirector");
				$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
				$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
				$pageInfo['profile'] = $this->ModelDirector->directorProfile();
				$pageInfo['project'] = $this->ModelDirector->getProjectDetails($value);
				$pageInfo['isPublic']=0;
				$this->load->view("director/viewproject", $pageInfo);
			}
		}
		public function allprojects($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();

			$this->load->view("director/allprojects", $pageInfo);
			echo $value;

		}

		public function actor($ref = 0, $name = ''){
			$name = str_replace("-", " ", $name);
			$pageInfo = [];
			$this->load->model("ModelActor");
			$pageInfo['profile'] = $this->ModelActor->getActorProfileById($ref);
			$pageInfo['experience'] = $this->ModelActor->getActorExperienceById($ref);
			$pageInfo['training'] = $this->ModelActor->getActorTrainingById($ref);
			$pageInfo['directors'] = $this->ModelActor->getDirectors($ref);
			$this->load->view("actor/actor_profile", $pageInfo);
		}

		public function emailPreview($txt = ''){
			$msg = urldecode($_GET['msg']);
			$link = isset($_GET['link']) ? trim($_GET['link']) : "";
			$linkname = isset($_GET['linkname']) ? trim($_GET['linkname']) : "";
			$this->load->model("Email");
			$email = $this->Email->defaultTemplete("Hi,<br>".$msg, $link, $linkname);
			//print_r($_GET);
			header('Content-Type: text/html; charset=utf-8');
			echo $email;
			exit();
		}


		public function spreadsheet($value=''){
			$this->load->model("ModelDirector");
			if(count($this->input->post())){
				$this->parseSpreadSheet($_FILES['excelFile']);
			}
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$this->load->view("director/excelimport.php", $pageInfo);
		}

		public function parseSpreadSheet($file = []){

			$fields = trim($this->input->post("fields"));
			$fields = str_replace('"', '', $fields);
			$fields = explode(",", rtrim($fields, ","));

			require('./phpClasses/spreadsheet/php-excel-reader/excel_reader2.php');
			require('./phpClasses/spreadsheet/SpreadsheetReader.php');

			$Reader = new SpreadsheetReader($file['tmp_name'], $file['name']);
		    $Sheets = $Reader -> Sheets();
		   
		    // To make temp spreadsheet of csv format
		    $filename = md5($this->session->userdata("StaSh_User_id") . "_" . microtime()) . ".csv";
		    var_dump($filename);
		    $handle = fopen("tmpSheets/{$filename}", "a");
		    $line = implode(", ", $fields);
		    fwrite($handle, $line . "\r\n");
		    foreach ($Sheets as $Index => $Name){
		        $Reader -> ChangeSheet($Index);
		        foreach ($Reader as $Row){
		        	$line = '';
		        	$have = true;
		        	$hasemail = true;
		        	$hasphone = true;
		            foreach ($Row as $key => $col) {
		            	// check no col value can be null/empty
		            	
		            	if(trim($col) == '')
		            	{
		            		$have = false;

		            	}
		            		

		            	if($fields[$key] == 'phone'){
		            		if(strlen($col) == 10 && preg_match('/^[0-9]+$/i', $col)){
		            			$col = $col;
		            			$hasphone=true;
		            		}else{
		            			if(strlen($col) > 10){
		            				$col = substr($col, strlen($col) - 10, 10);
		            				if(strlen($col) == 10 && preg_match('/^[0-9]+$/i', $col)){
		            					$hasphone = true;
		            				}
		            				else{
		            					$hasphone = false; 
		            				}

		            			}else{
		            				$col = '';
		            				$hasphone = false;
		            			}
		            		}
		            	}
		            	if($fields[$key] == 'email'){
		            		if (!filter_var($col, FILTER_VALIDATE_EMAIL) === false) {
							    $hasemail = true;
							} else {
							    $hasemail = false;
							}
		            	}


		            	// if gender
		            	if($fields[$key] == 'sex'){
		            		if(strtolower($col) == 'm')
		            		{
		            			$col = 1;
		            		}
		            		if(strtolower($col) == 'f')
		            		{
		            			$col = 0;
		            		}
		            		if(strtolower($col) == 'o')
		            		{
		            			$col = 2;
		            		}
		            		
		            	}
		            	$line .= trim($col) . ", ";
		            }
		            if($hasemail || $hasphone){
		            	$line = rtrim($line, ", ") . "\r\n";
		            	fwrite($handle, $line);
		            }
		        }
		    }

		    $this->ModelDirector->insertExcelData($this->session->userdata("StaSh_User_id"), $filename);
		    $pageInfo['filename'] = $filename;
		    $pageInfo['name'] = $file['name'];
		    $pageInfo['fields'] = $fields;

			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$this->load->view("director/afterExcel.php", $pageInfo);
		}


		public function finishUpload(){
			$lastFile = $this->ModelDirector->getLastUploadedExcel($this->session->userdata("StaSh_User_id"));

			if(count($lastFile)){

				$handle = fopen("./tmpSheets/".$lastFile['StashDirectorExcel_filename'], 'r');
				$i = 1;
				$actors = [];
				$this->load->model("Auth");
				$projects = [];
				while (!feof($handle)) {
					$line = fgets($handle);
					if(trim($line) == '') continue;

					$peices = explode(",", $line);

					if($i){
						$fields = $peices;
						$i = 0;
						continue;
					}
					$a = [];
					$hasProject = false;
					foreach ($peices as $key => $p) {
						if(trim($fields[$key]) == 'project'){
							$hasProject = true;
							$p = trim($p);
							if(!in_array($p, $projects)){
								$proj = $this->ModelDirector->getProject($p, date("Y-m-d"), $this->session->userdata("StaSh_User_id"));
								if(count($proj)){
									$proj = $proj['StashProject_id'];
								}else{
									$proj = $this->ModelDirector->insertNewPorject($p, date("Y-m-d"));
								}
								
								array_push($projects, $p);
								array_push($projects, $proj);
								$p = $proj;
							}else{
								$p = array_search($p, $projects);
								$p = $projects[$p+1];
							}
						}
						$a[ trim($fields[$key]) ] = trim($p);

					}
					$pass = strtolower(substr(md5($a['email']), 5, 8));
					$a['password'] = $pass;


					$em = (isset($a['email'])) ? $a['email'] : '';
					$mob = (isset($a['phone'])) ? $a['phone'] : '';
					if(!$this->Auth->ifAccountExist($em, $mob)){
						$actor_ref = $this->Auth->addActorFromExcel($a, $this->session->userdata("StaSh_User_id"));
						
						if($hasProject){
							$this->ModelDirector->insertActorProject($actor_ref, $a['project']);
						}
					}
					

				}

				$this->ModelDirector->updateExcelUpload($this->session->userdata("StaSh_User_id"));

			}
			redirect(base_url() . "director/");
	}

		public function profile($value=''){
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$this->load->view("director/castingdirectorprofile", $pageInfo);
		}

		public function editProfile($value=''){
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['pagaBasic'] = $this->ModelDirector->getPageData( $this->session->userdata("StaSh_User_id") );
			$pageInfo['teams'] = $this->ModelDirector->getTemMember( $this->session->userdata("StaSh_User_id") );
			$pageInfo['works'] = $this->ModelDirector->getProjectWork( $this->session->userdata("StaSh_User_id") );
			$this->load->view("director/castingdirectoreditprofile", $pageInfo);
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

		public function directorpageupdate($value=''){
			if(count($this->input->post())){
				$cname = trim($this->input->post("companyname"));
				$clink = trim($this->input->post("companyurl"));
				$clogo = "";
				$cabout = trim($this->input->post("aboutus"));
				$this->load->model("ModelDirector");
				if(!$this->ModelDirector->isPageNameAvailable($clink, $this->session->userdata("StaSh_User_id")))
					$this->response(true, "Page URL already taken.");

				if($_FILES['companylogo']['size']){
					$config = array(
								'upload_path' => './assets/img/pages/',
								'allowed_types' => 'png|jpg|jpeg',
								'overwrite' => TRUE,
								'max_size' => 5120, // 1024 * 5 in Kb
								'encrypt_name' => TRUE,
								'max_width' => 1024,
								'max_height' => 768
							);

					$this->load->library('upload', $config);

					if($this->upload->do_upload('companylogo')){
						$upload = $this->upload->data();
						$clogo = $upload['file_name'];
					}else{
						$pageInfo['error_msg'] = $this->upload->display_errors('<p>', '</p>');
					}
				}

				if($cname == '' || $cabout == ''){
					$this->response(false, "Field cannot be empty.");
				}
				$flag = false;
				$pageData = $this->ModelDirector->getPageData($this->session->userdata("StaSh_User_id"));
				//echo "page data is ".$pageData;
				//var_dump($pageData);
				if(count($pageData)){
					if($clogo == '')
						$clogo = $pageData['DirectorPage_logo'];

					$d = array(
						'cname' => $cname,
						'cabout' => $cabout,
						'clogo' => $clogo,
						'clink' => $clink,
						'ref' => $this->session->userdata("StaSh_User_id")
					);
					$flag = $this->ModelDirector->updateDirectorPageBasic($d);


				}else{
					// Insert for the first Time
					if($clogo == '')
						$clogo = "http://placehold.it/150x150/?text=[LOGO]";

					$d = array(
						'cname' => $cname,
						'cabout' => $cabout,
						'clogo' => $clogo,
						'clink' => $clink,
						'ref' => $this->session->userdata("StaSh_User_id")
					);
					$flag = $this->ModelDirector->insertDirectorPage($d);
					//var_dump($flag);
				}

				if($flag)
					$this->response(true, "Name and basic info updated");
				else
					$this->response(false, "Some error occured");
			}else{
				$this->response(false, "Warning! Unauthorised Access.");
			}
		}


		public function teamUpload($value=''){
			if(count($this->input->post())){
				$post = $this->input->post();
				$data = [];
				foreach ($post as $key => $p) {
					foreach ($p as $k => $v) {
						$data[$k][$key] = trim($v);
					}
				}

				$config = array(
							'upload_path' => './assets/img/teams/',
							'allowed_types' => 'png|jpg|jpeg',
							'overwrite' => TRUE,
							'max_size' => 5120, // 1024 * 5 in Kb
						);

				$this->load->library('upload', $config);
				if(count($_FILES['image'])){
					$files = $_FILES['image'];
					foreach ($files['name'] as $key => $p) {
						$_FILES['images[]']['name']= $files['name'][$key];
			            $_FILES['images[]']['type']= $files['type'][$key];
			            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
			            $_FILES['images[]']['error']= $files['error'][$key];
			            $_FILES['images[]']['size']= $files['size'][$key];

			            $p = explode(".", $files['name'][$key]);
			            $ext = trim(strtolower(end($p)));
			            $f = md5(microtime() . $files['name'][$key] . microtime()) . "." . $ext;
			            $config['file_name'] = $f;
			            $data[$key]['image'] = $f;
	            		$this->upload->initialize($config);

			            if($this->upload->do_upload('images[]')){
			            	$upload = $this->upload->data();
			            }
					}
				}

				$this->load->model("ModelDirector");
				if($this->ModelDirector->insertTeamMembers($data)){
					$team = $this->ModelDirector->getTemMember( $this->session->userdata("StaSh_User_id") );
					$this->response(true, count($data) . " team members added.", ['team' => $team]);
				}else{
					$this->response(false, "Failed! some error occured.");
				}

			}
		}


		public function secure(){
			if(count($this->input->post())){
				$req = trim($this->input->post("request"));
				$data = json_decode($this->input->post("data"), true);

				switch ($req) {
					case 'TeamUpdate':
						$this->pageTeamUpdate($data);
						break;

					case 'AddProjectWork':
						$this->pageProjectWork($data);
						break;

					case 'UpdateContactText':
						$this->updatecontactText($data);
						break;

					case 'DeleteTeamMember':
						$this->deleteTeamMember($data);
						break;

					case 'DeleteDirectorWork':
						$this->deleteDirectorWork($data);
						break;

					case 'CheckPageName':
						$this->checkPageName($data);
						break;
					
					default:
						$this->response(false, "Invalid Request");
						break;
				}
			}else{
				$this->response(false, Aj_Req_NoData);
			}
		}

		public function checkPageName($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->isPageNameAvailable($data['pagename'], $this->session->userdata("StaSh_User_id")))
				$this->response(true, "<i class='fa fa-check-circle'></i> Available");
			else
				$this->response(false, "<i class='fa fa-times'></i>  not available");
		}

		public function deleteDirectorWork($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->removeDirectorWork($data['work_ref'])){
				$this->response(true, "Work removed from list.");
			}else{
				$this->response(false, "Failed! some error occured.");
			}
		}

		public function deleteTeamMember($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->removeTeamMember($data['member_ref'])){
				$this->response(true, "Team member removed from list.");
			}else{
				$this->response(false, "Failed! some error occured.");
			}
		}

		public function updatecontactText($data = []){
			$this->load->model("ModelDirector");
			$pageData = $this->ModelDirector->getPageData( $this->session->userdata("StaSh_User_id") );
			if(count($pageData)){
				if($this->ModelDirector->updateContactTxt($data['text'], $pageData['DirectorPage_id'])){
					$this->response(true, "Contact text updated");
				}else{
					$this->response(false, "Failed! some error occured.");
				}
			}else{
				$this->response(false, "Please insert basic information first.");
			}
		}

		public function pageProjectWork($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->insertProjectWork($data)){
				$team = $this->ModelDirector->getProjectWork( $this->session->userdata("StaSh_User_id") );
				$this->response(true, "Project added successfully.", ['work' => $team]);
			}else{
				$this->response(false, "Failed! some error occured.");
			}
		}

		public function pageTeamUpdate($data = []){
			$this->load->model("ModelDirector");
			if($this->ModelDirector->insertTeamMembers($data)){
				$team = $this->ModelDirector->getTemMember( $this->session->userdata("StaSh_User_id") );
				$this->response(true, count($data) . " team members added.", ['team' => $team]);
			}else{
				$this->response(false, "Failed! some error occured.");
			}

		}

	}
?>
