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
		public function excelimport($value=''){
			if(!$this->session->userdata("StaSh_User_Logged_In") || $this->session->userdata("StaSh_User_type") != 'director')
				redirect(base_url());
			$pageInfo = [];
			$this->load->model("ModelDirector");
			$pageInfo['isAllowed'] = $this->ModelDirector->getAdminConfirmation();
			$pageInfo['plan'] = $this->ModelDirector->getDirectorPlan();
			$pageInfo['profile'] = $this->ModelDirector->directorProfile();
			$this->load->view("director/excelimport", $pageInfo);
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
			
			require('/phpClasses/spreadsheet/php-excel-reader/excel_reader2.php');
			require('./phpClasses/spreadsheet/SpreadsheetReader.php');

			$Reader = new SpreadsheetReader($file['tmp_name'], $file['name']);
		    $Sheets = $Reader -> Sheets();

		    // To make temp spreadsheet of csv format
		    $filename = md5($this->session->userdata("StaSh_User_id") . "_" . microtime()) . ".csv";
		    $handle = fopen("./tmpSheets/{$filename}", "a");
		    $line = implode(", ", $fields);
		    fwrite($handle, $line . "\r\n");
		    foreach ($Sheets as $Index => $Name){
		        $Reader -> ChangeSheet($Index);
		        foreach ($Reader as $Row){
		        	$line = '';
		        	$have = true;
		            foreach ($Row as $key => $col) {
		            	// check no col value can be null/empty
		            	if(trim($col) == '')
		            		$have = false;


		            	if($fields[$key] == 'phone'){
		            		if(strlen($col) == 10 && preg_match('/^[0-9]+$/i', $col)){
		            			$col = $col;
		            		}else{
		            			if(strlen($col) > 10){
		            				$col = substr($col, strlen($col) - 10, 10);
		            			}else{
		            				$col = '';
		            			}
		            		}
		            	}

		            	// if gender
		            	if($fields[$key] == 'gender'){
		            		$col = (strtolower($col[0]) == 'm') ? 1 : 0;
		            	}
		            	$line .= trim($col) . ", ";
		            }
		            if($have){
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

	}
?>