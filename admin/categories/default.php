<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

//error_reporting(!E_ALL);

require_once 'class/category.php';

$categoryObject = new class_category();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
	
	if($code == '') {
		$errorArray['error']	= 'Please add category to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['category_deleted'] = 1;
		$where = array();
		$where	= $categoryObject->getAdapter()->quoteInto('category_code = ?', $code);
		
		$success	= $categoryObject->update($data, $where);	
		
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
$categoryData = $categoryObject->getAll('category_deleted = 0','category.category_added DESC');

if($categoryData) $smarty->assign_by_ref('categoryData', $categoryData);

/* End Pagination Setup. */


 /* Display the template
 */	
$smarty->display('admin/categories/default.tpl');

?>