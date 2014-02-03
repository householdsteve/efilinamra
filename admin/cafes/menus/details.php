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
require_once 'class/menu.php';
require_once 'class/category.php';
require_once 'class/cafe.php';

$menuObject			= new class_menu();
$categoryObject	= new class_category();
$cafeObject 			= new class_cafe();

$cafeObject	= new class_cafe();

if (isset($_GET['cafe']) && trim($_GET['cafe']) != '') {
	
	$cafe = trim($_GET['cafe']);
	
	$cafeData = $cafeObject->getByCode($cafe);

	if(!$cafeData) {
		header('Location: /admin/cafes/');
		exit;
	}
	
	$smarty->assign('cafeData', $cafeData);
} else {
	header('Location: /admin/cafes/');
	exit;	
}

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$menuData = $menuObject->getByCode($code);

	if(!$menuData) {
		header('Location: /admin/menus/');
		exit;
	}
	$smarty->assign('menuData', $menuData);
}

$categoryData = $categoryObject->pairs();
if($categoryData) $smarty->assign('categoryData', $categoryData);

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	
	if(isset($_POST['menu_name']) && trim($_POST['menu_name']) == '') {
		$errorArray['menu_name'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['category_code']) && trim($_POST['category_code']) == '') {
		$errorArray['category_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['menu_description']) && trim($_POST['menu_description']) == '<br>') {
		$errorArray['menu_description'] = 'required';
		$formValid = false;		
	}

	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['menu_name']			= trim($_POST['menu_name']);		
		$data['category_code']		= trim($_POST['category_code']);		
		$data['cafe_code']				= $cafeData['cafe_code'];
		$data['menu_description'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['menu_description'])));			
		$data['menu_active']			= isset($_POST['menu_active']) && (int)trim($_POST['menu_active']) == 1 ? 1 : 0;		
		
		if(isset($menuData)) {
		
			/*Update. */
			$where		= $menuObject->getAdapter()->quoteInto('menu_code = ?', $menuData['menu_code']);
			$success	= $menuObject->update($data, $where);
			
		} else {
			
			$data['menu_code']	= $menuObject->createReference();	
		
			$success = $menuObject->insert($data);			
		}
		
		header('Location: /admin/cafes/menus/?code='.$cafeData['cafe_code']);
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/cafes/menus/details.tpl');
?>