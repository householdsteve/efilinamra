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
require_once 'class/continent.php';

$continentObject 		= new class_continent();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$continentData = $continentObject->getByCode($code);

	if(!$continentData) {
		header('Location: /admin/continents/');
		exit;
	}
	$smarty->assign('continentData', $continentData);
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	
	if(isset($_POST['continent_name']) && trim($_POST['continent_name']) == '') {
		$errorArray['continent_name'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['continent_name']					= trim($_POST['continent_name']);			
		$data['continent_active']					= isset($_POST['continent_active']) && (int)trim($_POST['continent_active']) == 1 ? 1 : 0;		
		$data['continent_link']					= toFilename(trim($_POST['continent_name']));
		
		if(isset($continentData)) {
		
			/*Update. */
			$where		= $continentObject->getAdapter()->quoteInto('continent_code = ?', $continentData['continent_code']);
			$success	= $continentObject->update($data, $where);
			
		} else {
			
			$data['continent_code']			= $continentObject->createReference();				
			$success = $continentObject->insert($data);			
		}
		
		header('Location: /admin/continents/');
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/continents/details.tpl');
?>