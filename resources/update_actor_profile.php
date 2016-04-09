<?php
session_start();
if(empty($_SESSION['login_actor']))
{
  header("Location:../index.php");
}
include_once('db_config.php');

ini_set('display_errors', '1');

//data
$name = $_REQUEST['name'];
$email =$_REQUEST['email'];
$dob =$_REQUEST['dob'];
$weight =$_REQUEST['weight'];
$height =$_REQUEST['height'];
$phone =$_REQUEST['phone'];
$whatsapp =$_REQUEST['whatsapp'];
$age =$_REQUEST['age'];
$sex =$_REQUEST['sex'];
$experience =$_REQUEST['experience'];
$range =$_REQUEST['agemin']."-".$_POST['agemax'];
$training =$_REQUEST['training'];
$language =$_REQUEST['language'];
$skills =$_REQUEST['skills'];
$rangearr = explode('-',$range);
$start = $rangearr[0];
$end = $rangearr[1];
$passport =$_REQUEST['passport'];
$actorcard =$_REQUEST['actorcard'];
$director_id =$_REQUEST['directorid'];
$password =$_REQUEST['password'];
$actor_id=$_SESSION['login_actor'];
//data ends

//echo "this";


  
$sql = "Update actor set actor_email='$email',actor_password='$password',actor_name='$name',actor_sex='$sex',actor_age='$age',
    actor_dob='$dob',actor_age_range_min='$start',actor_age_range_max='$end',actor_height='$height',actor_weight='$weight',actor_range='$range',
    actor_contact_number='$phone',actor_whatsapp_number='$whatsapp',actor_card='$actorcard',actor_language='$language',actor_skills='$skills',actor_experience='$experience',actor_training='$training',actor_passport='$passport' where actor_id='$actor_id'";
//echo $sql;
$data_entered=mysqli_query($con, $sql);
//echo("Error description: " . mysqli_error($con));
if ($data_entered) {
      echo "200";
  } else {
      echo "401";
  }
?>     
