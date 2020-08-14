# Air-Quality-Station-Setup
All you need in Setting up your own Air Quality Monitoring Station
1_ Step One : Create MySql Database

Here we will discuss the steps to creating a Database (MySQL) that will be used to both store and display the data collected from the air quality monitoring unit. You can follow this video (https://www.youtube.com/watch?v=0tdFBqDsOqQ) till 5:20 for a visual perspective of this procedure. 

1) Login into your web hosting provider's control panel. ie. Most use "CPanel". To access your CPanel account, go directly to http://YourDomainName.com/cpanel.

<img src="http://arubarealestatebosses.com/test/display/Aruba-Realestate-Drinnon-Nyerere-Sales-Agent-1.jpg">
2) Look for the Tab that says "Databases". Once found, click on "MySQL® Databases" 


3) Here we need to do three (3) things. Firstly, you should go ahead and create a database name of your choice then click "Create Database".

Secondly, you need to create a MySQL user account. Scroll down the same page and look for the area that says "MySQL Users". Insert a Username and Password combination of your choice then click "Create User". Lastly, scroll on that same MySQL page for where it says "Add User to Database". Under the user drop down menu bar, select the MySQL user account you just created and under the database drop down menu, select the database name you created for your unit. Next click "Add". On the "Manage User Privileges" page, ensure to select the "ALL PRIVILEGES" radio button, then click "Make Changes".


4) Go back to your CPanel main page (http://YourDomainName.com/cpanel). Locate the "Databases" tab then click on "phpMyAdmin". On the newly opened page, click on the database you recently created situated to the left of the window. Next, click on "SQL" on the top-right portion of that page as seen in the image below.

In the "Run SQL query/queries.." field, copy and paste script below." then click "Go".

CREATE TABLE IF NOT EXISTS `airquality` (
`airquality_id` int(100) NOT NULL AUTO_INCREMENT,
`unit_id` int(10) NOT NULL,
`pm_1` varchar(100) NOT NULL DEFAULT '',
`pm_2_5` varchar(100) NOT NULL DEFAULT '',
`pm_10` varchar(100) NOT NULL DEFAULT '',
`celcius` varchar(100) NOT NULL DEFAULT '',
`fahrenheit` varchar(100) NOT NULL DEFAULT '',
`humidity` varchar(100) NOT NULL DEFAULT '',
i_p varchar(60) NOT NULL,
mtimestamp varchar(60) NOT NULL,
`date_received` varchar(50) NOT NULL,
`thedate` varchar(50) NOT NULL,
`thetime` varchar(50) NOT NULL,
PRIMARY KEY (`airquality_id`),
UNIQUE KEY `id` (`airquality_id`),
KEY `id_2` (`airquality_id`)
);


2_ Step Two : Editing Key "Functions"

1) Check your Air Quality scripts folder for a file named "functions.php" and open it.

2) The "General Details" section is where we are going to give your monitoring station a Name, have your company name displayed at the footer of your webpage and take some security measures. Now Let's Edit. See my example below. 
$Station_Name = "Cabrits Cruiseship Berth"; 
$Company_Name = "Dominica Heritage Association"; 
$Unit_ID = "1"; 
$YourUnitSecretName = "LennoxHonychurch"; 
$Limits = "5"; ( /* Number of result (rows) you desire for graph and hourly data */ )

You done ? Now, let us do the same for the "Database Details".<BR><BR>

$Database_Username = "the_username";<BR>
$Database_Password = "the_password";<BR>
$Database_Name = "the_database_name";<BR>
$Database_Table = "airquality";<BR><BR>

3_ Step Three : Moving Files Over

1) Create a folder with a name of choice within the "public_html" folder of your web host account. This can be accessed via FTP or File Manager in CPanel. 

2) In that new folder you have created, Drag and Drop the entire Air Quality Files from your air quality scripts folder.

4_ Final Step : Edit Hardware

1) Edit Particles script named HT_PM.ino via particles.io. Look for where it says (int unitid=1; const char* unitsecretname="BrenchiesLab";) and edit the value respectively with your choice.

2) If you are confident you have done all what needs to be done, go to the url where you dropped the monitoring scripts and you should see live data from your unit every 10 seconds.

Optional :

Documentation for Line Graph can be found here (https://developers.google.com/chart/interactive/docs/gallery/linechart)

Make simple changes like Legal position, Graph Title and graph background color. Open index.php and go to line 823 to 827.
var options = {
title: 'Air Quality Station Graph',
curveType: 'function',
legend: { position: 'right' }, /* Change to bottom, left, top */
backgroundColor: '#fff' /* Change background color using Hexadecimals */
};

For Help :

For assistance, click Here.
