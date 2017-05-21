<?php

if(!isset($_GET['api_key']))
{
	echo "Api key parameter error";
	return;
}

$iteration = 5;
if(isset($_GET['count']))
{
	$iteration = $_GET['count'];
}

$api_key = $_GET['api_key'];

$jsonD2Dtext = "{";
$jsonD2Dtext.= '"Creator": "National Aeronautics and Space Administration",';
$jsonD2Dtext.= '"URL": "https://www.nasa.gov",';
$jsonD2Dtext.='"Contact": {
					"Address": "NASA Headquarters, 300 E. Street SW, Suite 5R30",
					"City" : "Washington, DC",
					"Country": "U.S",
					"PostalCode" : "20546" },';
$jsonD2Dtext.='"Logo": "https://www.nasa.gov/images/content/256357main_Symbols1-xltn.jpg",';
$jsonD2Dtext.='"Feeds": [{';
$jsonD2Dtext.='"URL": "http://www.sureyyasoft.com/d2d/feedapod.php?api_key="'. $api_key . '&count='. $iteration. ',';
$jsonD2Dtext.='"Type": "Images",';
$jsonD2Dtext.='"Name": "APOD",';
$jsonD2Dtext.='"Description": "NASA Astronomy Picture of the Day"';
$jsonD2Dtext.='}]}';

echo $jsonD2Dtext;


?>