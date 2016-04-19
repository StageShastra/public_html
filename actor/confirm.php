<?php

	include_once '../resources/db_config.php';
	include_once '../resources/functions.php';

	if(isset($_GET['_token'])){
		$_token = trim(str_replace(" ", "+", $_GET['_token']));
		$decrypted = base64_decode($_token);

		$pieces = explode("//", $decrypted);
		$email = trim($pieces[0]);
		$time = (int)trim($pieces[1]) + 86400; //24 hrs time window

		if($time < time()){
			die("<h3> <b>Warning: </b> token expired</h3>");
		}

		if(isActorExist($email)){
			if(confirmActorAccount($email)){
				header("Location: index.php?status=SUCCESS");
				exit();
			}else{
				die("<h3> <b>Warning: </b> Token has been used already.</h3>");
			}
		}else{
			die("<h3> <b>Warning: </b> This is Token is invalid.</h3>");
		}

	}

?>