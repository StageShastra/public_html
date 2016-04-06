<?php
ini_set('display_errors', '1');
$host = "localhost";
$user = "stash_admin";
$password = "1q2w3e4rA";
$db = "stage_shastra";
$con=mysqli_connect($host,$user,$password,$db);
if ( mysqli_connect_errno() ) {
            echo "<div>";
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            echo "</div>";
        }

?>