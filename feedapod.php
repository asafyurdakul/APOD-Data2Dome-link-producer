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

$iteration = 5;
if(isset($_GET['count']))
{
	$iteration = $_GET['count'];	
}

if(!isset($_GET['api_key']))
{
	echo "Api key parameter error";
	return;
}
$api_key = $_GET['api_key'];

$date = new DateTime();

$jsonD2Dtext = "{";
$jsonD2Dtext.= '"Count":'.$iteration.',';
$jsonD2Dtext.='"Collections": [';
for ($i=0; $i< $iteration ; $i++){

	$datestr = $date->format("Y-m-d");
	$json = file_get_contents('https://api.nasa.gov/planetary/apod?api_key='. $api_key .'&date='.$datestr);
	$collection = json_decode($json); 

	$jsonD2Dtext.='{';
	$jsonD2Dtext.='"Creator": "National Aeronautics and Space Administration",';
	$jsonD2Dtext.='"URL": "http://www.nasa.gov",';
	$jsonD2Dtext.='"Contact": {
					"Address": "NASA Headquarters, 300 E. Street SW, Suite 5R30",
					"City" : "Washington, DC",
					"Country": "U.S",
					"PostalCode" : "20546" },';
	$jsonD2Dtext.='"ID": "'.$collection->{'title'}.'",';
	$jsonD2Dtext.='"Title": "'.$collection->{'title'}.'",';
	$desc = str_replace('"','',$collection->{'explanation'});
	$jsonD2Dtext .= '"Description": "' . $desc. '",';
	$jsonD2Dtext.='"Credit": "NASA",';
	$jsonD2Dtext.='"PublicationDate": "'.$datestr.'",';
	$jsonD2Dtext.='"Assets": [{';
	if ($collection->{'media_type'} == "video"){
		$jsonD2Dtext.='"MediaType": "Video",';	
		$jsonD2Dtext.='"Resources": [{';
		$jsonD2Dtext.='"ResourceType": "Original",';
		$jsonD2Dtext.='"Dimensions": [0, 0],';
		$jsonD2Dtext.='"MediaType": "Video",';
		$jsonD2Dtext.='"ProjectionType": "Tan",';
		$jsonD2Dtext.='"URL": "'.$collection->{'url'}.'"';
		$jsonD2Dtext.='}]}]';
	}
	else{
		$jsonD2Dtext.='"MediaType": "Image",';
		$jsonD2Dtext.='"Resources": [{';
		$jsonD2Dtext.='"ResourceType": "Large",';
		$jsonD2Dtext.='"MediaType": "Image",';
		$jsonD2Dtext.='"ProjectionType": "Tan",';
		$jsonD2Dtext.='"Dimensions": [0, 0],';
		$jsonD2Dtext.='"URL": "'.$collection->{'hdurl'}.'"},{';
		$jsonD2Dtext.='"ResourceType": "Thumbnail",';
		$jsonD2Dtext.='"MediaType": "Image",';
		$jsonD2Dtext.='"Dimensions": [0, 0],';
		$jsonD2Dtext.='"ProjectionType": "Tan",';
		$jsonD2Dtext.='"URL": "'.$collection->{'url'}.'"},{';
		$jsonD2Dtext.='"ResourceType": "Icon",';
		$jsonD2Dtext.='"Dimensions": [0, 0],';
		$jsonD2Dtext.='"MediaType": "Image",';
		$jsonD2Dtext.='"ProjectionType": "Tan",';
		$jsonD2Dtext.='"URL": "'.$collection->{'url'}.'"';
		$jsonD2Dtext.='}]}]';
		
	}
	
	$date->sub(new DateInterval('P1D'));
	
	$jsonD2Dtext.='},';
}
$jsonD2Dtext= rtrim($jsonD2Dtext, ",") ;
$jsonD2Dtext .= ']}';

echo $jsonD2Dtext;



?>
