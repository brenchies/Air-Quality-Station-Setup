<?php
/**
* Connect to the mysql database.
*/
include('functions.php');
$db_con = mysqli_connect("127.0.0.1","$Database_Username","$Database_Password","$Database_Name");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>