<?php
session_start();
if(empty($_SESSION['login_user']))
{
	header("Location:index.html");
}
include_once('resources/db_config.php');
ini_set('display_errors', '1');
//flags
$img_uploaded=0;
$data_entered=0;
//file config
$ds= DIRECTORY_SEPARATOR;  //1
$storeFolder = 'uploads';

//data
$name=$_POST['name'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$facattr=$_POST['facattr'];
$phyattr=$_POST['phyattr'];
$weight=$_POST['weight'];
$height=$_POST['height'];
$phone=$_POST['phone'];
$age=$_POST['age'];
$sex=$_POST['sex'];
$experience=$_POST['experience'];
$project=$_POST['project'];
$range=$_POST['range'];
$training=$_POST['training'];
$audition=$_POST['auditions'];
$language=$_POST['language'];
$skills=$_POST['skills'];
$rangearr=explode('-',$range);
$start=$rangearr[0];
$end=$rangearr[1];
$profile="http://stageshastra.com/img/user.png";
$director_id=$_SESSION['login_user'];
//data ends

$uid=substr($name, 0, 4).round(microtime(true));
$dirmake =  dirname( __FILE__ ) . $ds. $storeFolder . $ds .$uid;
mkdir($dirmake);

if(isset($_FILES['file']))
{
 	$name_array = $_FILES['file']['name'];
    $tmp_name_array = $_FILES['file']['tmp_name'];
    // Number of files
    $count_tmp_name_array = count($tmp_name_array);
   // echo $count_tmp_name_array;
     // We define the static final name for uploaded files (in the loop we will add an number to the end)
     $static_final_name = $uid;

     for($i = 0; $i < $count_tmp_name_array; $i++)
     {
          $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
          //echo $extension;
          if(move_uploaded_file($tmp_name_array[$i], $dirmake."/".$static_final_name."_".$i.".".$extension))
          {
               //echo $name_array[$i]." upload is complete<br>";
               if($i==0)
               {
               	$profile="http://stageshastra.com/uploads/".$uid."/".$static_final_name."_".$i.".".$extension;
               }
               $img_uploaded=1;
          } 
          

     }

}

	
$sql = "INSERT INTO actor (actor_id,actor_email,actor_username,actor_name,actor_sex,actor_age,
		actor_dob,actor_age_range_min,actor_age_range_max,actor_height,actor_weight,actor_range,
		actor_contact_number,actor_whatsapp_number,actor_profile_photo,actor_blacklist,actor_card,`actor_physical-attribute`,`actor_facial-attribute`,actor_language,actor_skills,actor_experience,actor_training,actor_projects,actor_images,director_id)
	VALUES ('$uid', '$email', '$uid','$name','$sex','$age','$dob','$start','$end','$height','$weight','$range','$phone','$phone','$profile','0','1','$phyattr','$facattr','$language','$skills','$experience','$training','$project','$i','$director_id')";
$data_entered=mysqli_query($con, $sql);
if ($data_entered && $img_uploaded) {
	    echo "200";
	} else {
	    echo "401";
	}
?>     
