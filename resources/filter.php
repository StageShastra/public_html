<?php
session_start();
if(empty($_SESSION['login_user']))
{
  header("Location:index.php");
}
//ini_set('display_errors', '1');
include_once('db_config.php');

$age_min = $_REQUEST['age_min'];
$age_max = $_REQUEST['age_max'];
$sex = $_REQUEST['sex'];
$hmin = $_REQUEST['hmin'];
$hmax = $_REQUEST['hmax'];
$projects = $_REQUEST['projects'];
$skills = $_REQUEST['skills']; 
if($age_min=="")
{
  $age_min=0;
}
if($age_max=="")
{
  $age_max=120;
}
if($hmin=="")
{
  $hmin=0;
}
if($hmax=="")
{
  $hmax=220;
}
$projectsarray = explode(',', $projects);
$skillsarray = explode(',', $skills);

$age_query = " actor_age BETWEEN ".$age_min." AND ".$age_max;
$height_query = " AND actor_height BETWEEN ".$hmin." AND ".$hmax;
if($sex=="")
{
  $sex_query="";
}
else
{
  $sex_query = " AND actor_sex LIKE '".$sex."'";
}
$skills_count=count($skillsarray);
$projects_count=count($projectsarray);
//var_dump($skillsarray);
if($skillsarray[0]=="")
{
  $skills_query="";
}
else
{
  $skills_query=" AND actor_skills LIKE";
  for($i=0;$i<$skills_count;$i++)
  {
    $skills_query=$skills_query." '%".$skillsarray[$i]."%'";
    if($skills_count>1 && $i!=$skills_count-1)
    {
      $skills_query=$skills_query." OR actor_skills LIKE";
    }
  }
}

//projects query
if($projectsarray[0]=="")
{
  $projects_query="";
}
else
{
  $projects_query=" AND actor_projects LIKE";
  for($i=0;$i<$projects_count;$i++)
  {
    $projects_query= $projects_query." '%".$projectsarray[$i]."%'";
    if($projects_count>1 && $i!=$projects_count-1)
    {
      $projects_query=$projects_query." OR actor_projects LIKE";
    }
  }
}

$query = "Select * from actor where".$age_query." ".$sex_query." ".$height_query." ".$projects_query." ".$skills_query." AND director_id=".$_SESSION[login_user];
//echo "$query";
$result = mysqli_query($con, $query);
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

?>