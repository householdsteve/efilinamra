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
require_once 'class/cafe.php';
require_once 'class/city.php';
require_once 'class/country.php';
require_once 'class/continent.php';
require_once 'class/File.php';

$cafeObject 			= new class_cafe();
$cityObject 			= new class_city();
$countryObject 		= new class_country();
$continentObject	= new class_continent();
$fileObject				= new File(array('gif', 'png', 'jpg'));

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$cafeData = $cafeObject->getByCode($code);

	if(!$cafeData) {
		header('Location: /admin/cafes/');
		exit;
	}
	$smarty->assign('cafeData', $cafeData);
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
		
		$html .= '<option value=""> ---- </option>';
		if($cityData) {
			foreach($cityData as $item) {				
				$html .= '<option value="'.$item['city_code'].'" label="'.$item['city_name'].'">'.$item['city_name'].'</option>';	
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
	
	if(isset($_POST['cafe_name']) && trim($_POST['cafe_name']) == '') {
		$errorArray['cafe_name'] = 'required';
		$formValid = false;		
	}
	
	/*
	if(isset($_POST['city_code']) && trim($_POST['city_code']) == '') {
		$errorArray['city_code'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_latitude']) && trim($_POST['cafe_latitude']) == '') {
		$errorArray['cafe_latitude'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_longitude']) && trim($_POST['cafe_longitude']) == '') {
		$errorArray['cafe_longitude'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_address']) && trim($_POST['cafe_address']) == '<br>') {
		$errorArray['cafe_address'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_openingweekdays']) && trim($_POST['cafe_openingweekdays']) == '') {
		$errorArray['cafe_openingweekdays'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_openingweekhours']) && trim($_POST['cafe_openingweekhours']) == '') {
		$errorArray['cafe_openingweekhours'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_openingweekenddays']) && trim($_POST['cafe_openingweekenddays']) == '') {
		$errorArray['cafe_openingweekenddays'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_openingweekendhours']) && trim($_POST['cafe_openingweekendhours']) == '') {
		$errorArray['cafe_openingweekendhours'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafe_telephone']) && trim($_POST['cafe_telephone']) == '') {
		$errorArray['cafe_telephone'] = 'required';
		$formValid = false;		
	}
	*/
	if(isset($cafeData)) {
		if(isset($_POST['cafe_featured']) && (int)trim($_POST['cafe_featured']) == 1) {
			
			/* Check if all feature images are there. */
			$featureData = $cafeObject->getValidateToFeature($cafeData['cafe_code']);
			
			if(!$featureData) {
				$errorArray['cafe_featured'] = 'Please select feature images before making this cafe featured.';
				$formValid = false;		
			}
		}
	}
	/*
	if(!isset($cafeData)) {
		if(isset($_FILES['logofile'])) { 
	
			if((int)$_FILES['logofile']['size'] == 0) {
	
				$errorArray['logofile'] = 'Please upload logo image.';
				$formValid = false;	
			}
		}

		if(isset($_FILES['searchfile'])) { 
		
			if((int)$_FILES['searchfile']['size'] == 0) {
		
				$errorArray['searchfile'] = 'Please upload search result image.';
				$formValid = false;	
			}
		}	
	}
	*/
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['cafe_name']							= trim($_POST['cafe_name']);		
		$data['city_code']								= trim($_POST['city_code']);					
		$data['cafe_address'] 						= htmlspecialchars_decode(stripslashes(trim($_POST['cafe_address'])));					
		$data['cafe_openinghours'] 				= htmlspecialchars_decode(stripslashes(trim($_POST['cafe_openinghours'])));		
		$data['cafe_openingweekdays']			= trim($_POST['cafe_openingweekdays']);				
		$data['cafe_openingweekhours']			= trim($_POST['cafe_openingweekhours']);				
		$data['cafe_openingweekenddays']		= trim($_POST['cafe_openingweekenddays']);				
		$data['cafe_openingweekendhours']	= trim($_POST['cafe_openingweekendhours']);							
		$data['cafe_featured']						= isset($cafeData) && isset($_POST['cafe_featured']) && (int)trim($_POST['cafe_featured']) == 1 ? 1 : 0;
		$data['cafe_latitude']							= trim($_POST['cafe_latitude']);	
		$data['cafe_longitude']						= trim($_POST['cafe_longitude']);	
		$data['cafe_bookinglink']					= trim($_POST['cafe_bookinglink']);	
		
		$data['cafe_telephone']						= trim($_POST['cafe_telephone']);
		$data['cafe_cellphone']						= trim($_POST['cafe_cellphone']);
		$data['cafe_link']								= toFilename(trim($_POST['cafe_name']));		
		
		if(isset($cafeData)) {
		
			/*Update. */
			$where		= $cafeObject->getAdapter()->quoteInto('cafe_code = ?', $cafeData['cafe_code']);
			$success	= $cafeObject->update($data, $where);
			$data['cafe_code'] = $cafeData['cafe_code'];
		} else {
			$data['cafe_active']	= 0;
			$data['cafe_code']		= $cafeObject->createReference();	
		
			$success = $cafeObject->insert($data);			
		}
		
		/* Upload files. */
		if(isset($_FILES['logofile'])) { 
			if((int)$_FILES['logofile']['size'] != 0) {
			
				$ext 			= strtolower($fileObject->file_extention($_FILES['logofile']['name']));					
				$filename	= 'logo_'.$data['cafe_code'].'.'.$ext;
				$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/cafe/'.$data['cafe_code'];
				$file			= $directory.'/'.$filename;	
				
				if(!is_dir($directory)) mkdir($directory, 0777, true);
				
				if(file_put_contents($file, file_get_contents($_FILES['logofile']['tmp_name']))) {

					$datalogo = array();
					$datalogo['cafe_image_logo'] = '/media/cafe/'.$data['cafe_code'].'/'.$filename;
					
					$where		= $cafeObject->getAdapter()->quoteInto('cafe_code = ?', $cafeData['cafe_code']);
					$success	= $cafeObject->update($datalogo, $where);
			
				} else {
					$errorArray['logofile'] = 'Could not upload logo, please try again.';
					$formValid = false;					
				}
			}			
		}
		
		if(isset($_FILES['searchfile'])) {
			if((int)$_FILES['searchfile']['size'] != 0) {
			
				$ext 			= strtolower($fileObject->file_extention($_FILES['searchfile']['name']));					
				$filename	= 'search_'.$data['cafe_code'].'.'.$ext;
				$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/cafe/'.$data['cafe_code'];
				$file			= $directory.'/'.$filename;	
				
				if(!is_dir($directory)) mkdir($directory, 0777, true);
				
				if(file_put_contents($file, file_get_contents($_FILES['searchfile']['tmp_name']))) {

					$datasearch = array();
					$datasearch['cafe_image_search'] = '/media/cafe/'.$data['cafe_code'].'/'.$filename;
					
					$where		= $cafeObject->getAdapter()->quoteInto('cafe_code = ?', $cafeData['cafe_code']);
					$success	= $cafeObject->update($datasearch, $where);
			
				} else {
					$errorArray['searchfile'] = 'Could not upload search file, please try again.';
					$formValid = false;					
				}
			}			
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			header('Location: /admin/cafes/');
			exit;						
		}
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
 /* Display the template  */	
$smarty->display('admin/cafes/details.tpl');
?>