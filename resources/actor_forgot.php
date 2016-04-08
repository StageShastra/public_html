<?php
//ini_set('display_errors', '1');
include_once('db_config.php');
include_once('mailer.php');

	$username = mysqli_real_escape_string($con,$_REQUEST['email']);
	session_start();
	$_SESSION['userforgot']=$_POST['email'];
	$option = $_REQUEST['option'];

	if($option==1)
	{
		
	
		
			
			//send mail
			$passcode=send_passcode($username);
			$_SESSION['passcode']=$passcode;
			//save passcode in database
			$query="Update actor set actor_passcode='$passcode' WHERE actor_email='$username'";
			//echo $query;
			if (mysqli_query($con, $query)) {
   					 echo "200";
			} 
			else {
    				echo "404";
			}
		
		
		
		//send response

	}

	if($option==2)
	{
		//match_passcode with session
		$code=$_REQUEST['code'];
		$pwd=$_REQUEST['newpwd'];
		//passcode_correct
		if($_SESSION['passcode']==$code)
		{	
			//change password in database
			$query="Update actor set actor_password='$pwd' WHERE actor_passcode='$code'";
			//echo $query;
			if (mysqli_query($con, $query)) {
					 echo "200";
   					 
			} 
			else {
    				echo "404";
			}
		}
		else
		{
			echo "403";
		}
		
		//save user in session
		//redirect to login
	}
	


?>