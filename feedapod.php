<?php

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
	$jsonD2Dtext.='"Description": "'.$collection->{'explanation'}.'",';
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
