<?php
	// Textlocal account details
	$username = 'prashant@stageshastra.com';
	$hash = '1q2w3e4rQ';
	
	// Message details
	$bam="7742558868,9928034442";
	$numbers = explode(",",$bam);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode('Please come to the audition on 3rd April at Ville Parle');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('username' => $username, 'password' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('http://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
?>