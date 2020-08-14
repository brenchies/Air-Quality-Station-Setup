<?php
if ($_POST['submit_mail'] == "Download") {
$selectdate = $_POST['selectdate'];
$latestrow = $_POST['latestrow'];
$firstdate = $_POST['firstdate'];
$seconddate = $_POST['seconddate'];
$downloadall = $_POST['downloadall'];
$download3 = $_POST['download3'];
$download30 = $_POST['download30'];
$download1h = $_POST['download1h'];
$multihours = $_POST['multihours'];

include('functions.php');
$db_con = mysqli_connect("127.0.0.1","$Database_Username","$Database_Password","$Database_Name");


if($_POST['selectdate'] != ""){
   // print "<center><div class='error'>this is select date name : $selectdate</div></center><BR>";
      $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table WHERE thedate='$selectdate'");
    }
    
if($_POST['latestrow'] != ""){
    $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM (
   SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table ORDER BY airtemp_id DESC LIMIT $latestrow
)Var1
   ORDER BY airtemp_id ASC");

    }

if($_POST['downloadall'] != ""){
   $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table");

    }
    
if($_POST['download3'] != ""){
      $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table where mtimestamp > UNIX_TIMESTAMP() - '300'");

    }

if($_POST['download30'] != ""){
     $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table where mtimestamp > UNIX_TIMESTAMP() - '1800'");
    }
    include('functions.php');

if($_POST['download1h'] == "3600"){
$multi = 3600;
   $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table  where mtimestamp > UNIX_TIMESTAMP() - '$multi'");
    }
    
if($_POST['multihours'] != ""){
   $multihours = $_POST['multihours'];
   $multi = $multihours * 3600;
   $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table where mtimestamp > UNIX_TIMESTAMP() - '$multi'");
    }

if($_POST['firstdate'] != "" ||  $_POST['seconddate'] != ""){
    $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table WHERE thedate BETWEEN '$firstdate' AND '$seconddate' ORDER BY airtemp_id ASC");

    }
if($_POST['check_list'] != ""){
$markers = str_repeat('?, ', count($_POST['check_list']) - 1) . '?';
    $params = implode(",", array_fill(0, count($_POST['check_list']), "?"));
$checkbox1 = $_POST['check_list'];
    $chk="";  
    foreach($checkbox1 as $chk1)  
       {  
          $chk.= "'".$chk1."',";  
       }  
 $result = $db_con->query("SELECT airtemp_id,pm_1,pm_2_5,pm_10,celcius,fahrenheit,humidity,mtimestamp,date_received FROM $Database_Table WHERE thedate IN ($chk'')");

  }

$posteddate=date("Y-m-d");
date_default_timezone_set('Jamaica');
$dat1=date('h:');
$dat=date('i:s A');
$dat2=$dat1+1;
$registered=$posteddate ." ".$dat2.":". $dat;

if (!$result) die('Couldn\'t fetch data. Report this.');
$num_fields = mysqli_num_fields($result);
$headers = array();
while ($fieldinfo = mysqli_fetch_field($result)) {
    $headers[] = $fieldinfo->name;
}  
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="airquality.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
    
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
<?php 
include('functions.php');
echo $Station_Name;
?> Air Quality Station</title>
<META NAME="description" CONTENT="<?php echo $Station_Name; ?> Air Quality Monitoring Station">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="3600;URL='<?php echo $_SERVER['PHP_SELF']; ?>'">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>

@import url(https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,500,700&subset=latin-ext,latin);

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {margin:0; padding:0; border:0; outline:0; font-size:100%; vertical-align:baseline; background:transparent;} body {line-height: 1;}ol, ul{list-style:none;} blockquote, q{quotes:none;} blockquote:before, blockquote:after, q:before, q:after{content:'';content:none;} :focus{outline:0;} ins{text-decoration:none;} del{text-decoration:line-through;} table{border-collapse:collapse; border-spacing:0;}
		body {
  background:#E6EEF6;
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: 300;
  font-size: 15px;
}
.maincontent {
	max-width: 1300px;
	margin-left: auto;
	margin-right: auto;
}
section { margin:0px; }
section p { line-height:2em; font-family:'Raleway light'; }
.mainboxcontent {
	max-width: 1700px;
	margin-left: auto;
	margin-right: auto;
}
.mainboxcontent p { 
padding:1em;
}
.h5 {
    font: 100 35px / 52px "opensanslight", open-sans, sans-serif;
   margin-left:0.4em;
float:left;padding-top:0.5em;font-size:320%;color:#ffffff;
}

.footer p {
  margin: 0;
  font-size: 1.5em;
  padding: 2.5em ;
}

.title {color:#C8470A;font-weight: bold; margin-bottom: 0.5em; margin-left:2em;float:left;}

.oo { border: 1px solid #000;}


.rcorners3 {
  border-radius: 15px 50px;
  background: #fff;
  padding: 20px; 
  margin:1em;
  width: 150px;
  float:left;
  	 box-shadow: 0 0 10px rgba(46, 59, 125, 0.23);

  height: 80px; 
} 
.rcorners1 {
  border-radius: 15px 50px 30px 5px;
  background: #f56415;
  padding: 20px; 
    margin:1em;
	 box-shadow: 0 0 10px rgba(46, 59, 125, 0.23);

 float:left;  width: 150px;
  height: 80px; 
}
/*columns */


 .emojbox {
	 position: relative;
	 display: -webkit-flex;
	 display: flex;
	 -webkit-flex-direction: column;
	 flex-direction: column;
	 -webkit-align-items: stretch;
	 align-items: stretch;
	 text-align: center;
	 -webkit-flex: 0 1 330px;
	 flex: 0 1 330px;
}
.emojbox {
	 font-family: 'Open Sans', sans-serif;
	 cursor: default;
	 color: #84697c;
	 background: #fff;
	 box-shadow: 0 0 10px rgba(46, 59, 125, 0.23);
	 border-radius: 20px 20px 10px 10px;
	 width: 93.5%;
}
 @media screen and (min-width: 66.25em) {
	 .em .pricing-item {
		 margin: 1em -0.5em;
	}
	}
.em .deco-img {
	 position: absolute;
	 bottom: 0;
	 left: 0;
	 width: 100%;
	 height: 60px;
}

 .em .deco-layer {
	 -webkit-transition: -webkit-transform 0.5s;
	 transition: transform 0.5s;
}
 .em .emojbox:hover .deco-layer--1 {
	 -webkit-transform: translate3d(15px, 0, 0);
	 transform: translate3d(15px, 0, 0);
}
 .em .emojbox:hover .deco-layer--2 {
	 -webkit-transform: translate3d(-15px, 0, 0);
	 transform: translate3d(-15px, 0, 0);
}


 .em .pricing-currency {
	 font-size: 0.15em;
	 vertical-align: top;
}

 .em .pricing-feature-list {
	 margin: 0;
	 padding: 0.25em 0 2.5em;
	 list-style: none;
	 text-align: center;
}
 .em .pricing-feature {
	 padding: 1em 0;
}
 .em .pricing-action {
	 font-weight: bold;
	 padding: 1em 2em;
	 color: #fff;
	 border-radius: 30px;
	 background: #4d4766;
	 -webkit-transition: background-color 0.3s;
	 transition: background-color 0.3s;
}
 .em .pricing-action:hover, .em .pricing-action:focus {
	 background-color: #100a13;
}

.unitdates { 
	font-size:16px;
	background:#444;
	float:right;
	height:15px;
	padding:0.4em;
}
.unittitle { 
	float:left;
}
@media  (max-width:938px){
.unittitle { width: 98.5%; }
.unitdates { display: none;}

}
.pms { font-weight:bold; text-align:center;border-radius: 5px;background:#444;padding:0.4em;color:#fff;font-size:140%; }
.sbar { 
	width:90%;
}
.sbar1 { 
	width:72%; 
	height: 22px; 
	font-size:120%; 
	margin-left:0.5em;
	float:left;
	border-radius:5px;
	padding:1em;
	border: #b6c2c5 solid 1px; 
	color:#000;
	margin-bottom:1em;
}

#cel { background-color:#ffffff; }


* Progress Bar Styling */
progress, progress[role] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: none;
  height: 10px;
  
}

// The unordered list
.skill-list {
  list-style: none;
  margin: 0;
  padding: 1em;
  
}

// The list item
.skill {
  margin-bottom: 1em;
  position: relative;
  h3 {
    color: #fff;
    left: 1em;
    line-height: 1;
    position: absolute;
    top: 1em;
  }
  ::-webkit-progress-value { 
    -webkit-animation: bar-fill 2s;
    width: 0px;
  }
}

// Style the bar colors
.skill-1::-webkit-progress-value {
  background: #ff9e2c;
}

.skill-1::-moz-progress-bar {
  background: #ff9e2c;
}

.skill-2::-webkit-progress-value {
  background: #f35609;
}

.skill-2::-moz-progress-bar {
  background: #4ecdc4;
}

.skill-3::-webkit-progress-value {
  background: #f0ba00;
  
}

.skill-3::-moz-progress-bar {
  background: #ff6b6b;
}

// Animation Keyframes
@-webkit-keyframes bar-fill {
  0% { width: 0; }
}

@keyframes bar-fill {
  0% { width: 0; }
}
progress { height:80px;background:#444;border-radius:5;}

.button,.button2 {
    background: #0a78ab none repeat scroll 0 0;
    border-radius: 4px;
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    display: inline-block;
    font-family: "Montserrat", sans-serif;
    font-size: 14px;
    font-weight: 700;
    padding: 13px 30px;
    text-transform: uppercase;
    border: medium none;
    color: #fff;
    cursor: pointer;
    -webkit-transition: all 0.4s ease 0s;
    transition: all 0.4s ease 0s
}

.button:hover,.button2:hover {
    background: #f0e8db none repeat scroll 0 0;
    color: #2195b8;
}
.right-box {
	border-radius: 5px;
	box-shadow:0 1px 1px rgba(0,0,0,0.1);
	-webkit-box-shadow:0 1px 1px rgba(0,0,0,0.1);
	-moz-box-shadow:0 1px 1px rgba(0,0,0,0.1);
	-o-box-shadow:0 1px 1px rgba(0,0,0,0.1);
	width:85%;margin-top:0.5em;margin-left:1em;
	background-color:#fff;
	padding:15px 15px 15px;
	-webkit-transition:transform .2s ease,-webkit-box-shadow .2s ease;
	-moz-transition:transform .2s ease,-moz-box-shadow .2s ease;
	transition:transform .2s ease,box-shadow .2s ease;
	top:0!important
}
.dropdownbar { 
	border-radius:10px;
	color:#9f2225; 
	font:18px Arial, Helvetica, sans-serif; 
	padding:8px;
	text-align:left;
	margin-left:6px;
	display:block;
	border:none;
	border-bottom:1px solid #0a59a3;
	width:92%;
}

.dropdownbar { 
	height: 50px;
	border: solid #0a59a3 1px;
	margin-left:0.8em;
}

.btn.yellow {
	background: #ffd02b;
	padding: 0 6px;
	font-size: 110%;
	line-height: 1.7em;
	color: #170876;
	-webkit-box-shadow: 0 1px 0 0 rgba(224, 164, 12, 1);
	box-shadow: 0 1px 0 0 rgba(224, 164, 12, 1);
	text-shadow: 0 -1px 0 #e0a414
	text-align: center;

}
.btn {
	text-align: center;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	width:150px;
	display: inline-block;
	margin-bottom:0.5em;border:none;height:60px;
}

.btn.yellow:hover {
	background: #ffe690;
	color: #292929
}


.btn.yellow:active {
	background: #e0a414;
	color: #292929
}
.oo-input,.oo-input {margin-bottom:1em; height:30px;border-radius:10px;color:#9f2225; font:18px Arial, Helvetica, sans-serif; padding:1em;text-align:left;margin-left:6px;display:block;border:none;border:1px solid #0a59a3;width:92%;}
.emoji { width:50%;}
h5  { color:#fff;margin:0.5em; }

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  margin-left: 1em;
  width: 94%;
  table-layout: fixed;
}


table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
    width:94%;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.left { float:left;width:20%;margin:1em; }
.right {float:left;width:75%; }
@media  (max-width:891px){
.left{ width: 98.5%; }
.right {width: 98.5%;}
.emojbox {	 width: 97.5%; }

}


@media  (max-width:1000px){
.rcorners3,.rcorners1{ width: 38.5%; }
}
@media  (max-width:900px){
.emojbox {	 width: 96.5%; }
}
@media  (max-width:800px){
.emojbox {	 width: 97%; }
}
@media  (max-width:700px){
}
@media  (max-width:700px){
.button2 { width: 93.5%; }
.emojbox {	 width: 97%; }
.rcorners3,.rcorners1{ width: 82.5%; }
}
@media  (max-width:650px){
.emojbox {	 width: 93.5%; }
}
</style>
</head>
<body>

 <?php
include("database.php");
$uid = $row99['theuser_id'];
$query199="SELECT 
     *
   FROM 
$Database_Table
ORDER BY airtemp_id DESC
   LIMIT 1"; 
$result199=mysqli_query($db_con,$query199) or die(mysqli_connect_error());
$row199 = mysqli_fetch_assoc($result199)
?>
<section style="top:0;">
<div class="maincontent"><BR>
<center><img src="logo.png" alt="" style="width:15%;"></center>
<br><br>
<div class="mainboxcontent" style="margin:auto;">

<div
style="width:94%;max-width:1400px;margin:auto;background:#fbfbfb;  
box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;
border-radius: 10px 10px 10px 10px;">
<div style="background:#000000;width:100%;color:#fff;padding:0em 0em 0.5em 0em;height:22px;">

<div class="unittitle"><b style="border-radius: 5px;
color:#ffffff;background-color:#d41813;padding:0.7em;height:30px;"><?php echo $Station_Name; ?> Station</b></div>

<div class="unitdates">
<div id="date"> </div>

<script type="text/javascript" src="jquery-3.3.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
setInterval(function () {
$('#date').load("date.php")
}, 3000);
});
</script>


</div>
</div>
<div style="clear: both;"></div>


<div class="left">
<div class='em'>
    
<!-- from here -->
<div id="leftdata"> </div>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>

		<script type="text/javascript">
		
		$(document).ready(function() {
			setInterval(function () {
			$('#leftdata').load("left.php")
			}, 3000);

		});
	</script>

 <Center><img id="something" src="animate.gif" style="width:20%;"  border="0" alt="" /></center>

<script type="text/javascript">window.setTimeout("document.getElementById('something').style.display='none';", 3000); </script>
<!-- to here -->

</div>
</div>



<div class="right">

<div id="rightdata"> </div>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>

		<script type="text/javascript">
		
		$(document).ready(function() {
			setInterval(function () {
			$('#rightdata').load("rightdata.php")
			}, 3000);

		});
	</script>

 <Center><img id="something2" src="l.gif" style="width:20%;"  border="0" alt="" /></center>

<script type="text/javascript">window.setTimeout("document.getElementById('something2').style.display='none';", 3000); </script>


<div style="clear: both;"></div>

<BR><BR>

<div style="margin-left: 1em;">
  <button class="button2" style="padding-bottom:1em;margin-bottom:0.7em;" onclick="openCity('Hourly')">Hourly Data</button>
   <button  style="margin-bottom:0.7em;" class="button2" onclick="openCity('Graph')">Graph</button>
  <button style="margin-bottom:0.7em;" class="button2" onclick="openCity('Downloads')">Downloads</button>
</div>



<div id="Hourly" class="boss" style="display:none;">
<table>
<thead>
<tr>
<th scope="col">PM 1</th>
<th scope="col">PM 2.5</th>
<th scope="col">PM 10</th>
<th scope="col">Temperature</th>
<th scope="col">Received</th>
</tr>
</thead>

<tbody>

 <?php
include("database.php");
$query2="SELECT 
     *
   FROM 
 $Database_Table
 WHERE unit_id = '$Unit_ID'
ORDER BY airtemp_id DESC
   LIMIT 1"; 
$result2=mysqli_query($db_con,$query2) or die(mysqli_connect_error());
$row2 = mysqli_fetch_assoc($result2)
?>
<?php
include("database.php");
$thelatestdate = $row2['thedate'];

$query55="SELECT 
pm_1,pm_2_5,pm_10,celcius,thetime,mtimestamp,airtemp_id,thedate,HOUR(thetime) as FromHour, count(*)
       FROM 
 $Database_Table
         WHERE unit_id = '$Unit_ID' AND thedate ='$thelatestdate'    
         group by HOUR(thetime)  
         order by airtemp_id
		DESC LIMIT $Limits"; 
		 $result55=mysqli_query($db_con,$query55);
$num_rows = 0;
$num=mysqli_num_rows($result55);
while($row55 = mysqli_fetch_assoc($result55))
{ 
$num_rows++;
?>


<tr>
<td data-label="PM 1"><?php echo $row55['pm_1']; ?></td>
<td data-label="PM 2.5"><?php echo $row55['pm_2_5']; ?></td>
<td data-label="PM 10"><?php echo $row55['pm_10']; ?></td>
<td data-label="Temperature"><?php echo $row55['celcius']; ?> &#8451;</td>
<td data-label="Received"><?php 
$whatstime = $row55['mtimestamp'];
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

 ?></td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'PM 1', 'PM 2.5', 'PM 10'],
          <?php
include("database.php");
$thelatestdate = $row2['thedate'];

$query56="SELECT 
pm_1,pm_2_5,pm_10,celcius,thetime,mtimestamp,airtemp_id,thedate,HOUR(thetime) as FromHour, count(*)
       FROM 
$Database_Table
         WHERE unit_id = '$Unit_ID' AND thedate ='$thelatestdate'    
         group by HOUR(thetime)  
         order by airtemp_id
		DESC LIMIT $Limits"; 
		 $result56=mysqli_query($db_con,$query55);
$num_rows = 0;
$num=mysqli_num_rows($result56);
while($row56 = mysqli_fetch_assoc($result56))
{ 
$num_rows++;
?>
['<?php echo $row56['thetime']; ?>',  <?php echo $row56['pm_1']; ?>, <?php echo $row56['pm_2_5']; ?>,  <?php echo $row56['pm_10']; ?>],      
<?php } ?>
        ]);

        var options = {
          title: 'Air Quality Station Graph',
          curveType: 'function',
          legend: { position: 'right' }, /* change to bottom, left, top */
         backgroundColor: '#fff'

        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      //  chart.draw(data, {width: 400, height: 240, min: 0});

        chart.draw(data, options);
      }
    </script>
    
 

<div id="Graph" class="boss">
 <div id="curve_chart" style="height: 270px; width: 97%;margin-left:0.8em;border-radius:20px;"></div>
<BR>
<div>

</div>
</div>

<div id="Downloads" class="boss" style="display:none;">

<div class="right-box">
<h1>Downloads</h1><BR>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
      
<script type="text/javascript"> 
 $(document).ready(function(){
 //hides dropdown content
  $(".size_chart").hide();
  
  //unhides first option content
  $("#option0").show();
  
  //listen to dropdown for change
  $("#size_select").change(function(){
    //rehide content on change
    $('.size_chart').hide();
    //unhides current item
    $('#'+$(this).val()).show();
  });
  
});   
</script> 
 <?php
include("database.php");
$result155 = mysqli_query($db_con,"SELECT count(*) FROM  $Database_Table");
$numberoflistings = $result155->fetch_row()[0]; 
?>

<select id="size_select" class="dropdownbar" style="width:94%;">
<option value="option0">Select a Data Option for Download</option>
<?php
if($numberoflistings <= "30000"){ ?>
<option value="option1">Download All Data</option>
<?php } ?>

<option value="option2">5 minutes ago Data</option>
<option value="option3">30 Minutes ago Data</option>
<option value="option4">1 Hour ago Data</option>
<option value="option8">Download Multiple Hours</option>
<option value="option5">Select Data by Date</option>
<option value="option6">Download Latest Number of Rows of Data</option>
<option value="option7">Select Multiple Data Dates</option>
</select>

<?php if($numberoflistings <= "30000"){ ?>

<div class="back">
<div id="option1" class="size_chart"><BR>
<b style="font-size:140%;margin-left:0.5em;font-weight:bold;">Download all Data</b><BR><BR>
<form action="" method="POST">
<input type="hidden" name="downloadall" value="all">
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>
<?php } ?>

<div class="back">
<div id="option2" class="size_chart"><br>
<b style="font-size:140%;margin-left:0.5em;font-weight:bold;">Download Latest 5 Minutes of Data</b><BR><BR>
<form action="" method="POST">
<input type="hidden" name="download3" value="300">
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>

<div class="back">
<div id="option3" class="size_chart"><br>
<b style="font-size:140%;margin-left:0.5em;font-weight:bold;">Download Latest 30 Minutes of Data</b><BR><BR>
<form action="" method="POST">
<input type="hidden" name="download30" value="1800">
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>

<div class="back">
<div id="option4" class="size_chart"><br>
<b style="font-size:140%;margin-left:0.5em;font-weight:bold;">Download Latest 1 hour of Data</b><BR><BR>
<form action="" method="POST">
<input type="hidden" name="download1h" value="3600">
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>

<div class="back">
<div id="option8" class="size_chart"><br>
<b style="font-size:120%;margin-left:0.5em;font-weight:bold;">Download Multiple hours of Data</b><BR><BR>
<form action="" method="POST">
<p><input class="oo-input" pattern="[0-9]{10}" id="oo-input" placeholder="Insert Hours" name="multihours" value="<?php echo $_POST['multihours']; ?>" type="number"></p>
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>

<div class="back">
<div id="option5" class="size_chart"><br>
<b style="font-size:120%;margin-left:0.5em;font-weight:bold;">Select Date</b><BR><BR>
<form action="" method="POST">
<select size="1"  name="selectdate" class="dropdownbar">
<?php
include("database.php");
$query233="select DISTINCT thedate from $Database_Table ORDER BY thedate DESC";  
$result233=mysqli_query($db_con,$query233);
while($row233 = mysqli_fetch_assoc($result233))
{ 

?>
<option value="<?php echo $row233['thedate']; ?>"><?php echo $row233['thedate']; ?></option>
<?php } ?>
</select><BR><BR>
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>

<div class="back">
<div id="option6" class="size_chart"><BR>
<b style="font-size:120%;margin-left:0.5em;font-weight:bold;">Download Latest Number of Rows of Data</b><BR><BR>
<form action="" method="POST">
<p><input class="oo-input" pattern="[0-9]{10}" id="oo-input" placeholder="Insert Data Count" name="latestrow" value="<?php echo $_POST['latestrow']; ?>" type="number"></p>
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div></div>
<style>
.scrollcheck { border:2px solid #ccc; width:300px; height: 100px; overflow-y: scroll; }
</style>
<div class="back">
<div id="option7" class="size_chart"><br>
<b style="font-size:120%;margin-left:0.5em;font-weight:bold;">Select Multiple dates of Data</b><BR><BR>
<form action="" method="POST">
<div class="scrollcheck">
<?php
include("database.php");
$query233="select DISTINCT thedate from $Database_Table";  
$result233=mysqli_query($db_con,$query233);
while($row233 = mysqli_fetch_assoc($result233))
{ 

?>
<input class="single-checkbox" value="<?php echo $row233['thedate']; ?>" name="check_list[]" type="checkbox"><?php echo $row233['thedate']; ?><br>
<?php } ?>
</div>


<BR>
<div class="fieldBlock">
<input name="submit_mail" class="btn yellow" style="margin-bottom:0.5em;border:none;font-size:120%;width:120px;height:60px;" type="submit" value="Download">
</div>
</form>
</div>

<script>
var limit = 5;
$('input.single-checkbox').on('change', function(evt) {
   if($(this).siblings(':checked').length >= limit) {
       this.checked = false;
   }
});
</script>
</div>
</div>
</div>   


</div>

<div style="clear: both;"></div>
<BR>

</div>
<BR>

</div> </div>
<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("boss");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>
<BR><BR>
</section><div style="clear: both;"></div>

<section style="background-color:#444;color:#fff;height:50px;text-align:center;">
<div class="maincontent">
<BR><b style="margin:1em;font-size:small;">Copyright &copy; <?php echo date('Y'); ?> <?php echo $Company_Name; ?></b><br><br>
</div>
</section>
</body>
</html>