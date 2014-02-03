<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/cafe.php';

$cafeObject	= new class_cafe();

$results 				= array();
$list						= array();	

if(isset($_REQUEST['term'])) {
	
	$q			= trim($_REQUEST['term']); 
	
	$cafeData	= $cafeObject->search($q);	

	if($cafeData) {
		for($i = 0; $i < count($cafeData); $i++) {
			$results[] = array(
				"id" 		=> $cafeData[$i]["code"],
				"label" 	=> $cafeData[$i]['name'],
				"value" 	=> $cafeData[$i]['name']
			);			
		}
		/*
		foreach ($list as $details) {
			if (strpos(strtolower($details["value"]), $q) !== false) {
				$results[] = $details;
			}
		}	
*/		
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