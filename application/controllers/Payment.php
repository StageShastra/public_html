<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Payment extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->model("ModelPayment");
		}

		protected function displayPageNotFound() {
			$this->output->set_status_header('404');
			show_404();
		}

		public function index($value=''){
			$plan = isset($_REQUEST['plan']) ? $_REQUEST['plan']: 0;
			if($this->session->userdata("StaSh_User_Logged_In"))
				if($this->session->userdata("StaSh_User_type") == 'actor')
					$this->paymentActor($plan);
				else
					$this->paymentDirector($plan);
			else
				redirect(base_url() . 'home/pricing');
		}

		public function paymentActor($plan = 0){
			setcookie("Cstko_user_id", $this->session->userdata("StaSh_User_id"), time() + 3600, "/");
			$pageInfo['plan'] = $plan;
			$this->load->view("checkout_actor", $pageInfo);
		}

		public function paymentDirector($plan = 0){
			setcookie("Cstko_user_id", $this->session->userdata("StaSh_User_id"), time() + 3600, "/");
			$pageInfo['plan'] = $plan;
			$this->load->view("checkout_director", $pageInfo);
		}

		public function success( $plan = '' ){
			$pay_id = $req_id = '';

			if(isset($_REQUEST['payment_id'])){
				$pay_id = trim($_REQUEST['payment_id']);
				$req_id = null;
				$this->ModelPayment->insertPaymentSuccess($pay_id, $req_id);
				$user = (int)$this->input->cookie("Cstko_user_id");
				$payment = $this->curlPaymentDetails( $pay_id, $req_id );
				$payment = json_decode($payment, 1);


				$email = '';
				$amount = 0;
				if($payment['status']){
					$email = $payment['payment_request']['email'];
					$amount = (double)$payment['payment_request']['amount'];
				}

				if($amount >= 5000){
					// Director
					$plan = "Basic";
					$end = strtotime("+1 day");
					$sms = 0;
					if($amount == 5000){
						$plan = "Basic";
						$end = strtotime("+30 days");
						$sms = 100;
					}elseif( $amount == 27000 ){
						$plan = "Pro";
						$end = strtotime("+6 months");
						$sms = 200;
					}elseif($amount == 48000){
						$plan = "Pro Plus";
						$end = strtotime("+1 year");
						$sms = 500;
					}else{
						// something wrong.
					}

					$this->ModelPayment->insertDirectorPlan( $plan, $user, $end, $sms );
				}else{
					$plan = 'Pro';
					if($amount == 600){
						$end = strtotime("+3 months");
					}elseif($amount == 1200){
						$end = strtotime("+6 months");
					}elseif($amount==10){
						$end = strtotime("+3 months");
					}
					else{
						$end = strtotime("+1 year");
					}

					$this->ModelPayment->insertActorPlan($plan, $end);
				}

			}
			$page = $this->session->userdata("StaSh_User_type");
			$pageInfo['title'] = "Thank you.";
			if( $plan == '' ){
				$pageInfo['body'] = "Your Payment Success.<br><p>Payment Id: {$pay_id}</p><p>Payment Request Id: {$req_id}</p>";
				
			}else{
				if($plan == 'basic'){
					$pageInfo['body'] = "You are active now in Free Basic for 1 Years.";
				}else{
					$this->displayPageNotFound();
				}
			}
			$pageInfo['body'] .= "<p><b>You will be redirected in 10 secs. If its taking too long <a href='".base_url()."{$page}'>redirect here.</a></b></p>";
			
			$pageInfo['redirect'] = true;
			$pageInfo['page'] = $page;

			setcookie('Cstko_user_id', null, -1, '/');

			$this->load->view("confirm", $pageInfo);
		}

		public function webhook($value=''){
			$post = $this->input->post();
			$mac = $this->input->post("mac");
			unset($post['mac']);
			$ver = explode('.', phpversion());
			$major = (int)$ver[0];
			$minor = (int)$ver[1];
			if($major >= 5 and $minor >= 4){
				ksort($post, SORT_STRING | SORT_FLAG_CASE);
			}else{
				uksort($post, 'strcasecmp');
			}
			$mac_calculated = hash_hmac("sha1", implode("|", $post), "7af97257b52247d2b571909d75825333");
			if( $mac == $mac_calculated )
				$post['mac'] = 1;
			else
				$post['mac'] = 0;
			$this->insertPaymentData( $post );
		}

		public function curlPaymentDetails($id = '', $req = ''){
			$ch = curl_init();
			$url = "https://www.instamojo.com/api/1.1/payment-requests/{$req}/{$id}/";
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:e53d4a76a226af7d520ee1755dcaf43a",
                  "X-Auth-Token:f423d30c687ce6abcae30adfa8082977"));
			$response = curl_exec($ch);
			curl_close($ch); 

			return $response;
		}

	}