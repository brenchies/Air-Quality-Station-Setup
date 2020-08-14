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
<div class="rcorners3">
<u style="padding:0.5em;">PM 1</u>
<BR><BR>
<div class="pms"><?php echo $row199['pm_1']; ?></div>
</div>

<div class="rcorners3"><u style="padding:0.5em;">PM 2.5</u>
<br><BR>
<div class="pms"><?php echo $row199['pm_2_5']; ?></div>
</div>

<div class="rcorners3"><u style="padding:0.5em;">PM 10</u>
<BR><BR>
<div class="pms"><?php echo $row199['pm_10']; ?></div>
</div>

<div class="rcorners1"><u style="padding:0.5em;color:#fff;">Temperature</u>
<BR><BR>
<div id="cel" class="sbar1" style="float:right;margin-right:0.1em;">
<b><?php echo $row199['celcius']; ?>&#8451;</b>
<progress class="skill-2" max="100" value="<?php echo $row199['celcius']; ?>" style="width:100%;height:20%;"></progress>
</div>
<div style="clear: both;"></div>
</div>
