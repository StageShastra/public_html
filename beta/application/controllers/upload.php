<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Upload extends CI_Controller {

		public function index($value=''){
			$this->uploadActor();
		}

		public function uploadActor($value=''){
			$this->load->library('upload');
			$files = $_FILES;
			$c = count($_FILES['file']['name']);
			if($c > 10){
				return false;
			}
			$error = $images = [];
			for($i = 0; $i < $c; $i++){
				$_FILES['file']['name']= $files['file']['name'][$i];
		        $_FILES['file']['type']= $files['file']['type'][$i];
		        $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
		        $_FILES['file']['error']= $files['file']['error'][$i];
		        $_FILES['file']['size']= $files['file']['size'][$i];    

		        $this->upload->initialize($this->setConfig());
		        if($this->upload->do_upload('file')){
		        	$data = array('upload_data' => $this->upload->data());
		        	$images[] = $data['upload_data']['file_name'];
		        }else{
		        	$error[] = array('error' => $this->upload->display_errors());
		        }
			}

			$this->load->model("ModelActor");
			if($this->ModelActor->updateActorImages($images)){
				return true;
			}else{
				return false;
			}
		}

		public function setConfig($value=''){
			$config = array(
							'upload_path' => './assets/img/actors/',
							'allowed_types' => 'png|jpg|jpeg',
							'overwrite' => TRUE,
							'max_size' => 5120, // 1024 * 5 in Kb
							'encrypt_name' => TRUE
						);
			return $config;
		}

	}

?>