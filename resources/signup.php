<?php
ini_set('display_errors', '1');
include_once('db_config.php');
include_once('mailer.php');
if(isset($_REQUEST['fullname']))
{
	$fullname = $_REQUEST['fullname'];
	$email =$_REQUEST['email'];
	$contact =$_REQUEST['contact'];

	//$password = md5($password);
	$sql = "INSERT INTO signup (director_name, director_email, director_phone)
	VALUES ('$fullname', '$email', '$contact')";
        //echo $sql;
	$result=mysqli_query($con, $sql);
        if($result)
        {
 	  send_thanks($email,$fullname);
        }

}
else
{
	header("Location:../index.php");
}

?>