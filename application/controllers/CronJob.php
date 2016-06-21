<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class CronJob extends CI_Controller {

		public function index($value=''){
			$this->displayPageNotFound();
		}

		public function reminderMail($value=''){
			
			$this->load->model("Auth");
			$time = strtotime("-15 days");

			$sentLastReminder = $this->Auth->getLastReminderData($time);
			$inactiveUsers = $this->Auth->getInactiveUsers($time);

			$allInActiveUser = array_diff($inactiveUsers, $sentLastReminder);
			$inActiveEmails = $this->Auth->getEmailByIds($allInActiveUser);
			//echo "<pre>";
			if(count($inActiveEmails)){
				$this->load->model("Email");
				if($this->Email->sendReminderMail($inActiveEmails)){
					$this->Auth->insertLastReminderSent($allInActiveUser);
				}else{
					echo "<h3> Reminder Emails Send. </h3>";
				}
			}else{
				echo "Wow! No inactive User for so long.";
			}
		}

		public function mergeArrays($array1 = [], $array2 = []){
			$arr = [];
			foreach ($array1 as $key => $value) {
				if(!in_array($value, $array2))
					$arr[] = trim($value);
			}

			$arr = array_merge($arr, $array2);
		}

		protected function displayPageNotFound() {
			$this->output->set_status_header('404');
			show_404();
		}

	} 

?>