<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

error_reporting(!E_ALL);

require_once 'class/country.php';

$countryObject = new class_country();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
	
	if($code == '') {
		$errorArray['error']	= 'Please add country to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['country_deleted'] = 1;
		$where = array();
		$where	= $countryObject->getAdapter()->quoteInto('country_code = ?', $code);
		
		$success	= $countryObject->update($data, $where);	
		
		if(is_numeric($success)) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Setup Pagination. */
$countryData = $countryObject->getAll('country_deleted = 0','country.country_added DESC');

if($countryData) $smarty->assign_by_ref('countryData', $countryData);

/* End Pagination Setup. */


 /* Display the template
 */	
$smarty->display('admin/countries/default.tpl');

?>