# Air-Quality-Station-Setup
All you need in Setting up your own Air Quality Monitoring Station

<h1 style="font-size:140%;margin-left:0.8em;"><b style="color:#444;">Air Quality Station Tutorial</b></h1>
</div><BR>
</section>

<section style="background-color:#e8f3fc;">
<div class="maincontent"><br>
<div class="left-box" style="font-size:120%;line-height:1.6em;">
<h1> 1_ Step One :  Create MySql Database</h1><br>
<p><b>Here we will discuss the steps to creating a Database (MySQL) that will be used to both store and display the data collected
from the air quality monitoring unit. You can follow this video (<a href="https://www.youtube.com/watch?v=0tdFBqDsOqQ" target="_new">https://www.youtube.com/watch?v=0tdFBqDsOqQ</a>) till 5:20 for a visual perspective of this procedure.</b>
<br><BR>
<b>1</b>) Login into your web hosting provider's control panel. ie. Most use "CPanel". To access your CPanel account, go directly to 
<b>http://YourDomainName.com/cpanel</b>.<BR> <img src="img/cpanellogin.png" alt="" style="width:30%;padding:1em;"><BR><BR>
<b>2</b>) Look for the Tab that says "Databases". Once found, click on "<b>MySQL® Databases</b>" <BR>
<img src="img/databases.png" alt="" style="width:50%;padding:1em;"><br><BR>
<b>3</b>) Here we need to do three (<b>3</b>) things. <b>Firstly</b>, you should go ahead and create a database name of your choice then click "Create Database".<BR>
<img src="http://science.brenchies.com/aq/img/createdatabase.png" alt="" style="width:50%;padding:1em;"><BR>
<b>Secondly</b>, you need to create a MySQL user account. Scroll down the same page and look for the area that says "MySQL Users". Insert a Username and Password combination of your choice then click "Create User".
<b>Lastly</b>, scroll on that same MySQL page for where it says "Add User to Database". Under the user drop down menu bar, select the MySQL user account you just created and under the database drop down menu, select 
the database name you created for your unit. Next click "Add". On the "<b>Manage User Privileges</b>" page, ensure to select the "<B>ALL PRIVILEGES</b>" radio button, then click "<b>Make Changes</b>".<BR>
<img src="http://science.brenchies.com/aq/img/addusertodb.png" alt="" style="width:50%;padding:1em;"><BR><BR>
<b>4</b>) Go back to your CPanel main page (http://YourDomainName.com/cpanel). Locate the "Databases" tab then click on "phpMyAdmin". On the newly opened page, click on the database you recently created 
situated to the left of the window. Next, click on "SQL" on the top-right portion of that page as seen in the image below.<BR>
<img src="http://science.brenchies.com/aq/img/sql.png" alt="" style="width:80%;"><BR>
In the "<b>Run SQL query/queries..</b>" field, copy and paste script below." then click "Go".<BR><BR>

CREATE TABLE IF NOT EXISTS `airquality` (<BR>
  `airquality_id` int(100) NOT NULL AUTO_INCREMENT,<BR>
  `unit_id` int(10) NOT NULL,<BR>
  `pm_1` varchar(100) NOT NULL DEFAULT '',<BR>
  `pm_2_5` varchar(100) NOT NULL DEFAULT '',<BR>
  `pm_10` varchar(100) NOT NULL DEFAULT '',<BR>
  `celcius` varchar(100) NOT NULL DEFAULT '',<BR>
  `fahrenheit` varchar(100) NOT NULL DEFAULT '',<BR>
  `humidity` varchar(100) NOT NULL DEFAULT '',<BR>
   i_p varchar(60) NOT NULL,<BR>
   mtimestamp varchar(60) NOT NULL,<BR>
  `date_received` varchar(50) NOT NULL,<BR>
  `thedate` varchar(50) NOT NULL,<BR>
  `thetime` varchar(50) NOT NULL,<BR>
  PRIMARY KEY (`airquality_id`),<BR>
  UNIQUE KEY `id` (`airquality_id`),<BR>
  KEY `id_2` (`airquality_id`)<BR>
);<BR><BR>

</p><BR>
<h1> 2_ Step Two :  Editing Key "Functions"</h1><br>
<p>
<b>1</b>)  Check your Air Quality scripts folder for a file named "<b>functions.php</b>" and open it.<br><br>
<b>2</b>) The "General Details" section is where we are going to give your monitoring station a Name, have your company name displayed at the footer of your webpage and take some security measures. Now Let's Edit.
See my example below.
<BR>
<i>
$Station_Name = "<b>Cabrits Cruiseship Berth</b>"; <br>
$Company_Name = "<b>Dominica Heritage Association</b>"; <BR>
$Unit_ID = "<b>1</b>"; <BR>
$YourUnitSecretName = "<b>LennoxHonychurch</b>"; <br>
$Limits = "<b>5</b>";  ( /* Number of result (rows) you desire for graph and hourly data */ )<BR>

</i><br>
You done ? Now, let us do the same for the "Database Details".<BR><br>
<i>
$Database_Username = "<b>the_username</b>";<br>
$Database_Password = "<b>the_password</b>";<br>
$Database_Name = "<b>the_database_name</b>";<br>
$Database_Table = "<b>airquality</b>";<br>

</i><br>
</p>

<h1> 3_ Step Three :  Moving Files Over</h1><br>
<p>
<b>1</b>) Create a folder with a name of choice within the "public_html" folder of your web host account. This can be accessed via FTP or File Manager in CPanel. <BR><BR>
<b>2</b>) In that new folder you have created, Drag and Drop the <b>entire Air Quality Files</b> from your air quality scripts folder.
</p>
<br>
<h1> 4_ Final Step :  Edit Hardware</h1><br>
<p>
<b>1</b>) Edit Particles script named HT_PM.ino via particles.io. Look for where it says (<b>int unitid=1;
const char* unitsecretname="BrenchiesLab";</b>) and edit the value respectively with your choice.<BR><BR>
<b>2</b>) If you are confident you have done all what needs to be done, go to the url where you dropped the monitoring scripts and you should see live data from your unit every 10 seconds.
</p>
<br>
<h1> Optional : </h1><br>
<p>
Documentation for Line Graph can be found here (<a href="https://developers.google.com/chart/interactive/docs/gallery/linechart" target="_new">https://developers.google.com/chart/interactive/docs/gallery/linechart</a>)<BR><BR>
Make simple changes like Legal position, Graph Title and graph background color. Open <b>index.php</b> and go to line 823 to 827.<BR>
        var options = {<BR>
          title: 'Air Quality Station Graph',<BR>
          curveType: 'function',<BR>
          legend: { position: 'right' }, /* <b>Change to bottom, left, top</b> */<BR>
         backgroundColor: '#fff' /* <b>Change background color using Hexadecimals</b> */<BR>
        };<BR><BR>
</p>
<h1> For Help : </h1><br>
<p>
For assistance, click <a href="http://science.brenchies.com/contactus/" target="_new">Here</a>.
</p>
</div>
</div><div style="clear: both;"></div><BR><BR>
</section>


<section style="background-color:#282359;height:20px;">
<div class="mainboxcontent">
<b style="padding:1em;font-size:x-small;color:#ffffff;">&copy; B-Lab</b>
</div>
</section>

</body>
</html>
