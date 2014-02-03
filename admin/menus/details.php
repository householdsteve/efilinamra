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
require_once 'class/city.php';
require_once 'class/country.php';
require_once 'class/continent.php';

$menuObject	= new class_menu();
$categoryObject	= new class_category();
$cafeObject 			= new class_cafe();
$cityObject 			= new class_city();
$countryObject 		= new class_country();
$continentObject	= new class_continent();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$menuData = $menuObject->getByCode($code);

	if(!$menuData) {
		header('Location: /admin/menus/');
		exit;
	}
	$smarty->assign('menuData', $menuData);
}


$continentPairs = $continentObject->pairs();
if($continentPairs) $smarty->assign('continentPairs', $continentPairs);

/* Ajax */
if(isset($_GET['country_code_search'])) {

	$continentcode		= (isset($_GET['country_code_search']) && $_GET['country_code_search'] != '') ? $_GET['country_code_search'] : '';
	
	if ($continentcode != '') {
		
		$html = '';
		
		$countryData = $countryObject->getByContinent($continentcode);
		
		$html .= '<option value=""> ---- </option>';
		if($countryData) {
			foreach($countryData as $item) {				
				$html .= '<option value="'.$item['country_code'].'" label="'.$item['country_name'].'">'.$item['country_name'].'</option>';	
			}
		}
		echo $html;		
	}
	
	exit;
}

/* Ajax */
if(isset($_GET['city_code_search'])) {

	$countrycode		= (isset($_GET['city_code_search']) && $_GET['city_code_search'] != '') ? $_GET['city_code_search'] : '-1';
	
	if ($countrycode != '') {
		
		$html = '';
		
		$cityData = $cityObject->getByCountry($countrycode);
		
		$html .= '<option value=""> -- None -- </option>';
		if($cityData) {
			foreach($cityData as $item) {				
				$html .= '<option value="'.$item['city_code'].'" label="'.$item['city_name'].'">'.$item['city_name'].'</option>';	
			}
		}
		echo $html;		
	}
	
	exit;
}

/* Ajax */
if(isset($_GET['cafe_code_search'])) {

	$citycode		= (isset($_GET['cafe_code_search']) && $_GET['cafe_code_search'] != '') ? $_GET['cafe_code_search'] : '-1';
	
	if ($citycode != '') {
		
		$html = '';
		
		$cafeData = $cafeObject->getByCity($citycode);
		
		$html .= '<option value=""> ---- </option>';
		if($cafeData) {
			foreach($cafeData as $item) {				
				$html .= '<option value="'.$item['cafe_code'].'" label="'.$item['cafe_name'].'">'.$item['cafe_name'].'</option>';	
			}
		}
		echo $html;		
	}
	
	exit;
}

/* Ajax */
if(isset($_GET['category_code_search'])) {

	$cafecode		= (isset($_GET['category_code_search']) && $_GET['category_code_search'] != '') ? $_GET['category_code_search'] : '-1';
	
	if ($cafecode != '') {
		
		$html = '';
		
		$categoryData = $categoryObject->getByCafe($cafecode);
		
		$html .= '<option value=""> ---- </option>';
		if($categoryData) {
			foreach($categoryData as $item) {				
				$html .= '<option value="'.$item['category_code'].'" label="'.$item['category_name'].'">'.$item['category_name'].'</option>';	
			}
		}
		echo $html;		
	}
	
	exit;
}

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
	
	if(isset($_POST['continent_code']) && trim($_POST['continent_code']) == '') {
		$errorArray['continent_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['country_code']) && trim($_POST['country_code']) == '') {
		$errorArray['country_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['city_code']) && trim($_POST['city_code']) == '') {
		$errorArray['city_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_code']) && trim($_POST['cafe_code']) == '') {
		$errorArray['cafe_code'] = 'required';
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
		$data['menu_description'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['menu_description'])));			
		$data['menu_active']			= isset($_POST['menu_active']) && (int)trim($_POST['menu_active']) == 1 ? 1 : 0;		
		
		if(isset($cafeData)) {
		
			/*Update. */
			$where		= $menuObject->getAdapter()->quoteInto('menu_code = ?', $cafeData['menu_code']);
			$success	= $menuObject->update($data, $where);
			
		} else {
			
			$data['menu_code']	= $menuObject->createReference();	
		
			$success = $menuObject->insert($data);			
		}
		
		header('Location: /admin/menus/');
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/menus/details.tpl');
?>