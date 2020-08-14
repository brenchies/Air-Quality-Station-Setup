 <div class='emojbox' style="background:#444;">
<div style="color:#fff;margin:0em;font-size:220%;">
<?php if($row199['pm_10'] <= "50"){ ?>
<h5>GOOD!</h5>
<center> <img src="emojis/good.png" alt="" style="width:50%; "></center>
<?php } elseif($row199['pm_10'] <= "100"){ ?>
<h5>MODERATE</h5>
<center> <img src="emojis/moderate.png" alt="" style="width:50%; "></center>
<?php } elseif($row199['pm_10'] <= "150"){ ?>
<h5>Unhealthy <spen style="font-size:x-small;">(Sensitive Groups)</span></h5> 
<center> <img src="emojis/unhealthy.png" alt="" style="width:50%; "></center>
<?php } elseif($row199['pm_10'] <= "200"){ ?>
<h5>UNHEALTHY</h5>
<center> <img src="emojis/unhealthy.png" style="width:50%; "></center>
<?php } elseif($row199['pm_10'] <= "300"){ ?>
<h5>VERY UNHEALTHY</h5> 
<center> <img src="emojis/veryunhealthy.png" style="width:50%; "></center>
<?php } elseif($row199['pm_10'] >= "301"){ ?>
<h5>HAZARDOUS</h5>
<center> <img src="emojis/hazardous.png" style="width:50%; "></center>
<?php } ?>
                  
</div><BR>
                  

<svg class='deco-img' enable-background='new 0 0 300 100' height='10px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
<path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
<path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
<path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;	H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
<path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
</svg>
     
</div>
<p>
<b style="color:#e20727;font-size:140%;">Notice</b> : 

<?php if($row199['pm_10'] <= "50"){ ?>
Air quality is considered satisfactory, and air pollution poses little or no risk
<?php } elseif($row199['pm_10'] <= "100"){ ?>
Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution.
<?php } elseif($row199['pm_10'] <= "150"){ ?>
Members of sensitive groups may experience health effects. The general public is not likely to be affected.
<?php } elseif($row199['pm_10'] <= "200"){ ?>
Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects.<BR><BR>
Active children and adults, and people with respiratory disease, such as asthma, should avoid prolonged outdoor exertion; everyone else, especially children, should limit prolonged outdoor exertion.
<?php } elseif($row199['pm_10'] <= "300"){ ?>
Health warnings of emergency conditions. The entire population is more likely to be affected.<BR><BR>
Active children and adults, and people with respiratory disease, such as asthma, should avoid all outdoor exertion; everyone else, especially children, should limit outdoor exertion.
<?php } elseif($row199['pm_10'] >= "301"){ ?>
Everyone should avoid all exposure.
<?php } ?>

</p>
