<?php
require('mailer.php');
if(isset($_POST['subject']))
{
session_start();
$sender=$_SESSION['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$message=nl2br($message);
$mailto=$_POST['mailto'];

send_audition($subject,$message,$mailto,$sender);
}
else
{
	header("Location:../index.php");
}

?>