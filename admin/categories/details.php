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
require_once 'class/category.php';

$categoryObject	= new class_category();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$categoryData = $categoryObject->getByCode($code);

	if(!$categoryData) {
		header('Location: /admin/cafes/');
		exit;
	}
	$smarty->assign('categoryData', $categoryData);
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	
	if(isset($_POST['category_name']) && trim($_POST['category_name']) == '') {
		$errorArray['category_name'] = 'required';
		$formValid = false;		
	}

	if(isset($_POST['category_description']) && trim($_POST['category_description']) == '<br>') {
		$errorArray['category_description'] = 'required';
		$formValid = false;		
	}	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['category_name']			= trim($_POST['category_name']);		
		$data['category_description']	= trim($_POST['category_description']);											
		$data['category_active']			= isset($_POST['category_active']) && (int)trim($_POST['category_active']) == 1 ? 1 : 0;		
		
		if(isset($cafeData)) {
		
			/*Update. */
			$where		= $categoryObject->getAdapter()->quoteInto('category_code = ?', $cafeData['category_code']);
			$success	= $categoryObject->update($data, $where);
			
		} else {
			
			$data['category_code']			= $categoryObject->createReference();	
		
			$success = $categoryObject->insert($data);			
		}
		
		header('Location: /admin/categories/');
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/categories/details.tpl');
?>