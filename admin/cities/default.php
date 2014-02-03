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

require_once 'class/city.php';

$cityObject = new class_city();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
	
	if($code == '') {
		$errorArray['error']	= 'Please add city to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['city_deleted'] = 1;
		$where = array();
		$where	= $cityObject->getAdapter()->quoteInto('city_code = ?', $code);
		
		$success	= $cityObject->update($data, $where);	
		
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
$cityData = $cityObject->getAll('city_deleted = 0','city.city_added DESC');

if($cityData) $smarty->assign_by_ref('cityData', $cityData);

/* End Pagination Setup. */


 /* Display the template
 */	
$smarty->display('admin/cities/default.tpl');

?>