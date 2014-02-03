<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/city.php';

$cityObject	= new class_city();

$results 				= array();
$list						= array();	

if(isset($_REQUEST['term'])) {
	
	$cityData	= $cityObject->getFrontAll();
	$q			= trim($_REQUEST['term']); 
	
	if(count($cityData) > 0) {
		for($i = 0; $i < count($cityData); $i++) {
			$list[] = array(
				"id" 		=> $cityData[$i]["city_link"],
				"label" 	=> $cityData[$i]['city_name'].', '.$cityData[$i]['country_name'],
				"value" 	=> $cityData[$i]['city_name'].', '.$cityData[$i]['country_name']
			);			
		}
		
		foreach ($list as $details) {
			if (strpos(strtolower($details["value"]), $q) !== false) {
				$results[] = $details;
			}
		}		
	}
}

if(count($results) > 0) {
	echo json_encode($results); 
	exit;
} else {
	echo json_encode(array('id' => '', 'label' => 'no results')); 
	exit;
}
exit;

?>