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

require_once 'class/menu.php';

$menuObject = new class_menu();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
	
	if($code == '') {
		$errorArray['error']	= 'Please add menu to delete';
		$errorArray['result']	= 0;			
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['menu_deleted'] = 1;
		$where = array();
		
		$where	= $menuObject->getAdapter()->quoteInto('menu_code = ?', $code);
		
		$success	= $menuObject->update($data, $where);	
		
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
$menuData = $menuObject->getAll('menu_deleted = 0','menu.menu_added DESC');

if($menuData) $smarty->assign_by_ref('menuData', $menuData);

/* End Pagination Setup. */


 /* Display the template
 */	
$smarty->display('admin/menus/default.tpl');

?>