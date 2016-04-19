<?php
      //config
      header("Access-Control-Allow-Origin: *"); 
      session_start();
       if(!isset($_SESSION['STASH_ACTOR_LOGIN']))
              header("Location: index.php");
      include_once('db_config.php');
      include_once('simpleImage_class.php');
      include_once '../resources/functions.php';
      ini_set('display_errors', '1');
      
      //variables
      $actor_ref = $_SESSION['STASH_ACTOR_ID'];
      $actorProfile = getActorProfile($actor_ref);
      $profile="";
      $uid="";
      $images = $actorProfile['StashActor_images'];

      //flags
      $img_uploaded=0;
      $data_entered=0;
      $direxists=0;

      //check dir exists or not
      if($images=="")
      {
        $images=0;
        $name = $_SESSION['STASH_ACTOR_NAME'];
        $uid = substr($name, 0, 4).round(microtime(true));

      }
      else
      {
        //echo "reaching here";
        $exp_array = explode("/", $actorProfile['StashActor_avatar']);
        $uid = $exp_array[4];
        $direxists=1;
      }
      //file config
      $ds= DIRECTORY_SEPARATOR;  //1
      $storeFolder = '../uploads';
      $dirmake =  dirname( __FILE__ ) . $ds. $storeFolder . $ds .$uid;

      if(!$direxists)
      {
        mkdir($dirmake);
      }
     
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
              $k=$i+$images;
              $fn =$static_final_name."_".$k.".jpg";
              //echo $extension;
              if(move_uploaded_file($tmp_name_array[$i], $dirmake."/".$fn))
              {
                   //echo $name_array[$i]." upload is complete<br>";
                   if($i==0)
                   {
                    $profile="http://stageshastra.com/uploads/".$uid."/".$static_final_name."_".$k.".jpg";
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

      $images=$images+$count_tmp_name_array;

      $query = "Update beta_actor_profile set StashActor_images=$images, StashActor_avatar='$profile' where StashActor_actor_ref=$actor_ref";
      $runSQL = mysqli_query($connection, $query);
      //echo $query;
      if(mysqli_affected_rows($connection))
      echo 200;
      return false;
      ?>     
