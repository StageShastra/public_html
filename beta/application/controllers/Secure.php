<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Secure extends CI_Controller {
		
		public function confirm($link = ''){
			$encryptedText = str_replace(" ", "+", urldecode($link));

			$this->load->library('encrypt');
			$info = $this->encrypt->decode(trim($encryptedText));
			$info = explode("_", $info);
			$data = array(
						"email" => trim($info[0]),
						"ref" => (int)trim($info[1])
					);
			$this->load->model("Auth");
			
			if($this->Auth->ifUserExist($data['email'])){
				if($this->Auth->confirmEMail($data['email'])){
					echo "<h3 style='color:green;'> You Email: {$data['email']} is confirmed now. You will be redirected to Login page in 5 seconds.  </h3>";
					echo "</br> <h4 style='color:#666;'> <i> If you are not redirected automatically, Login <a href='".base_url()."'> here </a> </i> </h4>";
					
					echo "<script>
							setTimeout(function(){
								window.location.href = '".base_url()."';
							}, 5000);
						</script>";
					
				}else{
					exit("<h4 style='color:red;'> You Email is lalready confirmed. </h4>");
				}
			}else{
				exit("<h4 style='color:red;'> <b>Warning :: </b>Invalid Token </h4>");
			}
		}
		
	}

	
?>