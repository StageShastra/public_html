<?php
//ini_set('display_errors', '1');
include_once('db_config.php');
include_once('mailer.php');

	$username = mysqli_real_escape_string($con,$_REQUEST['username']);
	session_start();
	$_SESSION['userforgot']=$_POST['username'];
	$option = $_REQUEST['option'];
	if($option==1)
	{
		
		//getmail
		$query="SELECT director_email FROM director WHERE director_username='$username'";
		$result=mysqli_query($con,$query);
		$count=mysqli_num_rows($result);
		if($count==1)
		{	
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$email=$row['director_email'];
			//send mail
			$passcode=send_passcode($email);
			$_SESSION['passcode']=$passcode;
			//save passcode in database
			$query="Update director set director_pass_code='$passcode' WHERE director_username='$username'";
			
			if (mysqli_query($con, $query)) {
   					 echo "200";
			} 
			else {
    				echo "404";
			}
		}
		else
		{
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
			$query="Update director set director_password='$pwd' WHERE director_pass_code='$code'";
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