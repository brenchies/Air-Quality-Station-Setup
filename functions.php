<?php
/* General Details */
$Station_Name = "Cabrits Cruiseship Berth"; /*  Desired Air Quality Station name */
$Company_Name = "Dominica Heritage Association"; /* Name of your Company */
$Unit_ID = "4"; /* The Unit Number you inserted in your Arduino Code (in this Example the UnitID is 1) */
$YourUnitSecretName = "TheSecretName"; /* Unique Secret Name you programmed in your Arduino code */
$Limits = "4"; /* Number of result (rows) you desire for graph and hourly data */

/* Database Details */
$Database_Username = "the_username";  /* Your Database Username */
$Database_Password = "the_password"; /* Your Database Password */
$Database_Name = "the_database_name"; /* Your Database Name */
$Database_Table = "airquality"; /* Your Database Table Name */

$db_con = mysqli_connect("localhost", "$Database_Username", "$Database_Password", "$Database_Name");
return $db_con;
?>

