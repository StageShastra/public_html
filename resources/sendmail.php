<?php
require('mailer.php');
require('sendsms.php');
if(isset($_POST['subject']))
{
	session_start();
	$sender=$_SESSION['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	$message=nl2br($message);
	$mailto=$_POST['mailto'];
	$sms=$_POST['sms'];
	$sendto=$_POST['sendto'];
	send_audition($subject,$message,$mailto,$sender);
	echo send_text($sendto,$sms);
}
else
{
	header("Location:../index.php");
}

?>