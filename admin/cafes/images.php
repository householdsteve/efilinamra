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
require_once 'class/cafeimage.php';
require_once 'class/File.php';

$cafeObject			= new class_cafe();
$cafeimageObject	= new class_cafeimage();
$fileObject				= new File(array('gif', 'png', 'jpg'));

error_reporting(E_ALL);

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$cafeData = $cafeObject->getByCode($code);

	if(!$cafeData) {
		header('Location: /admin/cafes/');
		exit;
	}
	
	$smarty->assign('cafeData', $cafeData);
} else {
	header('Location: /admin/cafes/');
	exit;	
}

/* Check posted data. */
if(isset($_GET['cafeimage_code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$cafeimagecode			= trim($_GET['cafeimage_code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {	
		$data	= array();
		$data['cafeimage_deleted'] = 1;
		
		$where		= array();
		$where[]	= $cafeimageObject->getAdapter()->quoteInto('cafeimage_code = ?', $cafeimagecode);
		$where[]	= $cafeimageObject->getAdapter()->quoteInto('cafe_code = ?', $cafeData['cafe_code']);
		
		$success	= $cafeimageObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {		
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

/* Check posted data. */
if(isset($_GET['cafeimage_code_update'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$cafeimagecode			= trim($_GET['cafeimage_code_update']);
	
	if(isset($_GET['cafeimage_name']) && trim($_GET['cafeimage_name']) == '') {
		$errorArray['error'] = 'name required.';	
	}	
	
	if(isset($_GET['cafeimage_description']) && trim($_GET['cafeimage_description']) == '') {
		$errorArray['error'] = 'description required.';	
	}

	if($errorArray['error']  == '') {

		/* Get image details. To check order. */
		$cafeimagedata = $cafeimageObject->getByCode($cafeimagecode);
		
		if($cafeimagedata) {
						
			$data 	= array();		
			
			if(($cafeimagedata['cafeimage_order'] != (int)trim($_GET['cafeimage_order'])) && ((int)trim($_GET['cafeimage_order']) != 0)) {				
				$success = $cafeimageObject->updateOrder($cafeimagedata, (int)trim($_GET['cafeimage_order']), $cafeimagedata['cafeimage_order']);				
			}
			
			$data['cafeimage_name'] 			= trim($_GET['cafeimage_name']);		
			$data['cafeimage_description'] 	= trim($_GET['cafeimage_description']);			
			$data['cafeimage_active'] 			= isset($_GET['cafeimage_active']) && (int)trim($_GET['cafeimage_active']) == 1 ? 1 : 0;	
			
			$where		= array();
			$where[]	= $cafeimageObject->getAdapter()->quoteInto('cafeimage_code = ?', $cafeimagecode);
			$where[]	= $cafeimageObject->getAdapter()->quoteInto('cafe_code = ?', $cafeData['cafe_code']);
			$success	= $cafeimageObject->update($data, $where);	

			if(is_numeric($success)) {		
				$errorArray['error']	= '';
				$errorArray['result']	= 1;			
			} else {
				$errorArray['error']	= 'Could not update, please try again.';
				$errorArray['result']	= 0;				
			}
		} else {
			$errorArray['error']	= 'Image does not exist.';
			$errorArray['result']	= 0;					
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

		
$cafeimageData = $cafeimageObject->getGalleryByCafe($cafeData['cafe_code']);

if($cafeimageData) {
	$smarty->assign('cafeimageData', $cafeimageData);
	$smarty->assign('imagecount', count($cafeimageData));
}


/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_FILES['imagefile'])) { 
		/* Check validity of the CV. */
		if((int)$_FILES['imagefile']['size'] == 0) {
			/* Check if its the right file. */
			$errorArray['imagefile'] = 'Please try to upload again, its size is empty or 0.';
			$formValid = false;	
		}
	}
	
	if(isset($_POST['cafeimage_name']) && trim($_POST['cafeimage_name']) == '') {
		$errorArray['cafeimage_name'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data = array();
		$data['cafeimage_name'] 			= trim($_POST['cafeimage_name']);
		$data['cafeimage_description']	= trim($_POST['cafeimage_description']);
		$data['cafeimage_code']				= $cafeimageObject->createReference();		
		$data['cafe_code']						= $cafeData['cafe_code'];
		$data['cafeimage_order']			= count($cafeimageData)+1;
		
		$ext 					= strtolower($fileObject->file_extention($_FILES['imagefile']['name']));					
		$filename			= $data['cafeimage_code'].'.'.$ext;
		$directorycafe	= '/media/cafe/gallery/'.$cafeData['cafe_code'];
		$directory			= $directorycafe.'/'.$data['cafeimage_code'];
		$file					= $_SERVER['DOCUMENT_ROOT'].$directory.'/'.$filename;	
		
		if(!is_dir($directory)) mkdir($_SERVER['DOCUMENT_ROOT'].$directory, 0777, true);
		
		/* Create files for this product type. */
		if(file_put_contents($file, file_get_contents($_FILES['imagefile']['tmp_name']))) {
			
			$newfilename = str_replace($filename, 'mobile_'.$filename, $file);

			/* Create new file and rename it. */
			$uploadObject	= PhpThumbFactory::create($_FILES['imagefile']['tmp_name']);
			$uploadObject->resizePercent ('60');
			
			if($uploadObject->save($newfilename)) {
			
				$data['cafeimage_path']			= '/media/cafe/gallery/'.$cafeData['cafe_code'].'/'.$data['cafeimage_code'];
				$data['cafeimage_filename']	= trim($_FILES['imagefile']['name']);
				$data['cafeimage_extension']	= '.'.$ext ;
				$data['cafeimage_type']			= 'GLY';
				
				$success	= $cafeimageObject->insert($data);

				if(is_numeric($success)) {
					header('Location: /admin/cafes/images.php?code='.$cafeData['cafe_code']);
					exit;
				}
			} else {
				$errorArray['cafeimage_name'] = 'required';
				$formValid = false;				
			}
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}


 /* Display the template
 */	
$smarty->display('admin/cafes/images.tpl');

?>