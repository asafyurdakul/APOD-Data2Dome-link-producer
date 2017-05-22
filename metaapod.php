<?php
/*
	Created by Asaf Yurdakul, 2017, www.sureyyasoft.com
			
	Licensed under the Apache License, Version 2.0 (the "License"); 
	you may not use this file except in compliance with the License. 
	You may obtain a copy of the License at 
	
		http://www.apache.org/licenses/LICENSE-2.0 
	
	Unless required by applicable law or agreed to in writing, software 
	distributed under the License is distributed on an "AS IS" BASIS, 
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
	See the License for the specific language governing permissions and 
	limitations under the License.
	
*/

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
