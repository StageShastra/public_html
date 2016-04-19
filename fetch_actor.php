<?php
session_start();
if(empty($_SESSION['login_user']))
{
    header("Location:index.php");
}
ini_set('display_errors', '1');
include_once('resources/db_config.php');
include_once('resources/functions.php');
$data = $_REQUEST['data'];
header("Content-Type: application/json");
print_r($data);
exit();
//echo data;
$data[0]="actor_".strtolower($data[0]);
$data[1]="actor_".strtolower($data[1]);
$data[2]="actor_".strtolower($data[2]);
$data[3]="actor_".strtolower($data[3]);
$data[4]="actor_".strtolower($data[4]);
$director_id=$_SESSION['login_user'];
$sql = "SELECT * FROM actor where director_id='$director_id'";
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