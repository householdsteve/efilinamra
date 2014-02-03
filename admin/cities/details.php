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
require_once 'class/city.php';
require_once 'class/country.php';
require_once 'class/continent.php';

$cityObject 			= new class_city();
$countryObject 		= new class_country();
$continentObject	= new class_continent();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$cityData = $cityObject->getByCode($code);

	if(!$cityData) {
		header('Location: /admin/cities/');
		exit;
	}
	$smarty->assign('cityData', $cityData);
}


$continentPairs = $continentObject->pairs();
if($continentPairs) $smarty->assign('continentPairs', $continentPairs);

/* Ajax */
if(isset($_GET['country_code_search'])) {

	$continentcode		= (isset($_GET['country_code_search']) && $_GET['country_code_search'] != '') ? $_GET['country_code_search'] : '';
	
	if ($continentcode != '') {
		
		$html = '';
		
		$countryData = $countryObject->getByContinent($continentcode);
		
		$html .= '<select name="country_code" id="country_code">';
		$html .= '<option value=""> ---- </option>';
		if($countryData) {
			foreach($countryData as $item) {				
				$html .= '<option value="'.$item['country_code'].'" label="'.$item['country_name'].'">'.$item['country_name'].'</option>';	
			}
		}
		$html .= '</select>'; 
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
	
	if(isset($_POST['city_name']) && trim($_POST['city_name']) == '') {
		$errorArray['city_name'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['country_code']) && trim($_POST['country_code']) == '') {
		$errorArray['country_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['continent_code']) && trim($_POST['continent_code']) == '') {
		$errorArray['continent_code'] = 'required';
		$formValid = false;		
	}
	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['city_name']					= trim($_POST['city_name']);		
		$data['country_code']				= trim($_POST['country_code']);							
		$data['city_active']					= isset($_POST['city_active']) && (int)trim($_POST['city_active']) == 1 ? 1 : 0;		
		$data['city_link']					= toFilename(trim($_POST['city_name']));
		
		if(isset($cityData)) {
		
			/*Update. */
			$where		= $cityObject->getAdapter()->quoteInto('city_code = ?', $cityData['city_code']);
			$success	= $cityObject->update($data, $where);
			
		} else {
			
			$data['city_code']			= $cityObject->createReference();	
		
			$success = $cityObject->insert($data);			
		}
		
		header('Location: /admin/cities/');
		exit;						
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/cities/details.tpl');
?>