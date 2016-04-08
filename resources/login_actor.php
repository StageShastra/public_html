<?php
//ini_set('display_errors', '1');
include_once('db_config.php');
if(isset($_POST['email']))
{
	$username = mysqli_real_escape_string($con,$_POST['email']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	//$password = md5($password);
	$query="SELECT * FROM actor WHERE actor_username='$username' and actor_password='$password'";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	// If result matched $username and $password, table row  must be 1 row
	if($count==1)
	{	
		session_start();
		$_SESSION['login_actor']=$row['actor_id']; //Storing user session value.
		$_SESSION['email']=$row['actor_email'];
		echo "200";
	}
	else 
	{
		echo "401";
	}

}
else
{
	header("Location:../index.php");
}

?>