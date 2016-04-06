<?php
session_start();
if(empty($_SESSION['login_user']))
{
	header("Location:index.php");
}
ini_set('display_errors', '1');
include_once('db_config.php');
$datatype=$_POST['type'];

if($datatype=="skills")
{
	$sql = "SELECT skill_name FROM skills";
	$result = mysqli_query($con, $sql);
	$row=array();
	if (mysqli_num_rows($result) > 0) 
	{
    	// output data of each row
    	while($r= mysqli_fetch_assoc($result))
    	{
    		$rows[]=$r;
    	}
	}
	print json_encode($rows);
}
if($datatype=="languages")
{
	$sql = "SELECT language_name FROM languages";
	$result = mysqli_query($con, $sql);
	$row=array();
	if (mysqli_num_rows($result) > 0) 
	{
    	// output data of each row
    	while($r= mysqli_fetch_assoc($result))
    	{
    		$rows[]=$r;
    	}
	}
	print json_encode($rows);

}
if($datatype=="physical_attributes")
{
	$sql = "SELECT physical_attribute FROM physical_attribute";
	$result = mysqli_query($con, $sql);
	$row=array();
	if (mysqli_num_rows($result) > 0) 
	{
    	// output data of each row
    	while($r= mysqli_fetch_assoc($result))
    	{
    		$rows[]=$r;
    	}
	}
	print json_encode($rows);
}
if($datatype=="facial_attributes")
{
	$sql = "SELECT facial_attribute FROM facial_attribute";
	$result = mysqli_query($con, $sql);
	$row=array();
	if (mysqli_num_rows($result) > 0) 
	{
    	// output data of each row
    	while($r= mysqli_fetch_assoc($result))
    	{
    		$rows[]=$r;
    	}
	}
	print json_encode($rows);
}

?>