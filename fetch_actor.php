<?php
session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location:index.php");
}
error_reporting(E_ERROR);
//ini_set('display_errors', '1');
include_once('resources/db_config.php');
include_once('resources/functions.php');


$tag2name = array(
            'Name' => "name",
            'Age' => "dob",
            'Email' => 'email',
            'Height' => 'height',
            'Sex' => 'gender',
            'Mobile' => "mobile",
            'Weight' => "weight",
            'Range' => 'range',
            'Skills' => "skills",
            'Language' => "language",
            'Whatsapp' => 'whatsapp'
        );
//echo "assa";


$director_id=$_SESSION['login_user'];

$actorsInDirector = getActorWithDirector($director_id);
if(count($actorsInDirector)!=0)
{
  $actor_ref_list = arr2csv($actorsInDirector);

$actorProfile = getActorProfileByIds($actor_ref_list);
if(count($actorProfile)){
    echo json_encode($actorProfile);
    exit();
}  
}
else{

    echo "null";
}


//var_dump($json, $error === JSON_ERROR_UTF8);
?>