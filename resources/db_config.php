<?php
ini_set('display_errors', '1');

//DB Constants

include 'constants.php';
/*$host = "localhost";
$user = "root";
$password = "";
$db = "db_stage_shastra";*/
$con=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( mysqli_connect_errno() ) {
            echo "<div>";
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            echo "</div>";
        }

?>