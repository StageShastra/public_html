<?php

session_start();
if(empty($_SESSION['login_user']))
{
    header("Location:index.php");
}

//ini_set('display_errors', '1');
include_once('db_config.php');
if(isset($_REQUEST['actor_id']))
{
	$actor_id = mysqli_real_escape_string($con,$_REQUEST['actor_id']);
	//$password = md5($password);
	$query="DELETE from actor WHERE actor_id='$actor_id'";
	$result=mysqli_query($con,$query);
	echo $query;
	var_dump($result);
}
else
{
	header("Location:../index.php");
}

?>