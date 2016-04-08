<?php
session_start();
if(empty($_SESSION['login_actor']))
{
	header("Location:index.php");
}
ini_set('display_errors', '1');
include_once('db_config.php');

$actor_id=$_SESSION['login_actor'];
$sql = "SELECT * FROM actor where actor_id='$actor_id'";
//echo $sql;
$result = mysqli_query($con, $sql);
$row=array();
if (mysqli_num_rows($result) > 0) 
{
    // output data of each row
    while($r= mysqli_fetch_assoc($result))
    {
    	$rows[]=$r;
    	//var_dump($r);
    	//print json_encode($r);
    }
}

function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}
$rows = utf8_converter($rows);
print json_encode($rows);
$error = json_last_error();

//var_dump($json, $error === JSON_ERROR_UTF8);
?>