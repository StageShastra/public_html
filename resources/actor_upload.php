<?php
header("Access-Control-Allow-Origin: *"); 
session_start();
if(empty($_SESSION['login_user']))
{
  header("Location:../index.php");
}
include_once('db_config.php');
include_once('simpleImage_class.php');
ini_set('display_errors', '1');
//flags
$img_uploaded=0;
$data_entered=0;
//file config
$ds= DIRECTORY_SEPARATOR;  //1
$storeFolder = '../uploads';

//data
$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$phone = $_POST['phone'];
$whatsapp = $_POST['whatsapp'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$experience = $_POST['experience'];
$range = $_POST['agemin']."-".$_POST['agemax'];
$training = $_POST['training'];
$language = $_POST['language'];
$skills = $_POST['skills'];
$rangearr = explode('-',$range);
$start = $rangearr[0];
$end = $rangearr[1];
$passport = $_POST['passport'];
$actorcard = $_POST['actorcard'];
$profile = "http://stageshastra.com/img/user.png";
$director_id = $_POST['directorid'];
$password = $_POST['password'];
//data ends

$uid=substr($name, 0, 4).round(microtime(true));
$dirmake =  dirname( __FILE__ ) . $ds. $storeFolder . $ds .$uid;
mkdir($dirmake);
//echo "this";
if(isset($_FILES['file']))
{
    $name_array = $_FILES['file']['name']; //file
    $tmp_name_array = $_FILES['file']['tmp_name']; //tmpfile
    // Number of files
    $count_tmp_name_array = count($tmp_name_array);
   // echo $count_tmp_name_array;
     // We define the static final name for uploaded files (in the loop we will add an number to the end)
     $static_final_name = $uid;

     for($i = 0; $i < $count_tmp_name_array; $i++)
     {
          $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
          $fn =$static_final_name."_".$i.".jpg";
          //echo $extension;
          if(move_uploaded_file($tmp_name_array[$i], $dirmake."/".$fn))
          {
               //echo $name_array[$i]." upload is complete<br>";
               if($i==0)
               {
                $profile="http://stageshastra.com/uploads/".$uid."/".$static_final_name."_".$i.".jpg";
               }
               $img_uploaded=1;
               $image = new SimpleImage();
               $image_name=$dirmake."/".$fn;
               $image->load($image_name);
               $img_height = $image->getHeight();
               $img_width = $image->getWidth();
               if($img_height>=$img_width && $img_height > 700)
               {
                $image->resizeToHeight(700);
               }
               if($img_height < $img_width && $img_width >800)
               {
                $image->resizeToWidth(800);
               }
               $image->save($dirmake."/".$fn);
               
          } 
          

     }

}

  
$sql = "INSERT INTO actor (actor_id,actor_email,actor_username,actor_password,actor_name,actor_sex,actor_age,
    actor_dob,actor_age_range_min,actor_age_range_max,actor_height,actor_weight,actor_range,
    actor_contact_number,actor_whatsapp_number,actor_profile_photo,actor_blacklist,actor_card,`actor_physical-attribute`,`actor_facial-attribute`,actor_language,actor_skills,actor_experience,actor_training,actor_projects,actor_images,director_id,actor_passport)
  VALUES ('$uid', '$email', '$email','$password','$name','$sex','$age','$dob','$start','$end','$height','$weight','$range','$phone','$whatsapp','$profile','0','$actorcard','','','$language','$skills','$experience','$training','$project','$i','$director_id','$passport')";
$data_entered=mysqli_query($con, $sql);
if ($data_entered && $img_uploaded) {
      echo "200";
  } else {
      echo "401";
  }
?>     
