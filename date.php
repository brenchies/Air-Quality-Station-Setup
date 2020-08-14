 <?php
include("database.php");
$query199="SELECT 
     *
   FROM 
$Database_Table
ORDER BY airtemp_id DESC
   LIMIT 1"; 
$result199=mysqli_query($db_con,$query199) or die(mysqli_connect_error());
$row199 = mysqli_fetch_assoc($result199)
?>
<b>RECEIVED ( <span style="margin-top:-12em;font-size: xsmall;">
<?php 
$whatstime = $row199['mtimestamp'];
$now = mktime();
$afterminus = abs($now - $whatstime);
$seconds = round(abs($afterminus / 1));
$theminutes = round(abs($afterminus / 60));
$hours = round(abs($afterminus / 3600));
$days = round(abs($afterminus / 86400));
$weeks = round(abs($afterminus / 604800));
$months = round(abs($afterminus / 2628000));
$years = round(abs($afterminus / 31556952));

if ($seconds <= 59){

 	if ($seconds == 1){
 	echo "one second ago";
 	}else {
	echo "$seconds seconds ago";
	 }

	}
elseif ($theminutes <= 60){

 	if ($theminutes == 1){
 	echo "one minute ago";
 	}else {
	echo "$theminutes minutes ago";
	 }

	} elseif ($hours <= 24){

    if ($hours == 1){
    echo "an hour ago";

    } else {
	 echo "$hours hours ago";
	}

  } elseif ($days <= 7){

    if ($days == 1){

      echo "yesterday";

    } else {

      echo "$days days ago";

    }

   }  elseif ($weeks <= 7){
  
if ($weeks == 1){
    echo "a week ago";

    } else {
	 echo "$weeks weeks ago";
	}

 }  elseif ($months <= 30){
  
if ($months == 1){
    echo "a month ago";

    } else {
	 echo "$months months ago";
	}

    }

 ?>


</span> )</b>&nbsp;&nbsp;&nbsp;&nbsp;  Date: <b><?php echo $row199['thedate']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;Time: <b><?php echo $row199['thetime']; ?></b>
