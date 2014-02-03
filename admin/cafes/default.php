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

require_once 'class/cafe.php';

$cafeObject = new class_cafe();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
	
	if($code == '') {
		$errorArray['error']	= 'Please add cafe to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['cafe_deleted'] = 1;
		$where = array();
		$where	= $cafeObject->getAdapter()->quoteInto('cafe_code = ?', $code);
		
		$success	= $cafeObject->update($data, $where);	
		
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

if(isset($_GET['code_active'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_active']);
	$status						= isset($_GET['status']) && (int)trim($_GET['status']) == 1 ? 1 : 0;
	
	if($code == '') {
		$errorArray['error']	= 'Please add cafe to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['cafe_active'] = $status;
		$where = array();
		$where	= $cafeObject->getAdapter()->quoteInto('cafe_code = ?', $code);
		
		$success	= $cafeObject->update($data, $where);	
		
		if(is_numeric($success)) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could change status, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Setup Pagination. */
$cafeData = $cafeObject->getAll('cafe_deleted = 0','cafe.cafe_added DESC');

if($cafeData) $smarty->assign_by_ref('cafeData', $cafeData);

/* End Pagination Setup. */


 /* Display the template
 */	
$smarty->display('admin/cafes/default.tpl');

?>