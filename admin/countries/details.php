<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';


/* objects. */
require_once 'class/country.php';
require_once 'class/continent.php';

$countryObject 		= new class_country();
$continentObject 		= new class_continent();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$countryData = $countryObject->getByCode($code);

	if(!$countryData) {
		header('Location: /admin/countries/');
		exit;
	}
	$smarty->assign('countryData', $countryData);
}

$continentPairs = $continentObject->pairs();

if($continentPairs) $smarty->assign('continentPairs', $continentPairs);

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	
	if(isset($_POST['country_name']) && trim($_POST['country_name']) == '') {
		$errorArray['country_name'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['continent_code']) && trim($_POST['continent_code']) == '') {
		$errorArray['continent_code'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['country_name']					= trim($_POST['country_name']);		
		$data['continent_code']					= trim($_POST['continent_code']);		
		$data['country_active']					= isset($_POST['country_active']) && (int)trim($_POST['country_active']) == 1 ? 1 : 0;		
		$data['country_link']						= toFilename(trim($_POST['country_name']));
		
		if(isset($countryData)) {
		
			/*Update. */
			$where		= $countryObject->getAdapter()->quoteInto('country_code = ?', $countryData['country_code']);
			$success	= $countryObject->update($data, $where);
			
		} else {
			
			$data['country_code']			= $countryObject->createReference();				
			$success = $countryObject->insert($data);			
		}
		
		header('Location: /admin/countries/');
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/countries/details.tpl');
?>