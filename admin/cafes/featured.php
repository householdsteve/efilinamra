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
	
	if(isset($_POST['cafeimage_description']) && trim($_POST['cafeimage_description']) == '') {
		$errorArray['cafeimage_description'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['cafeimage_type']) && trim($_POST['cafeimage_type']) != '') {
		if(trim($_POST['cafeimage_type']) == 'FTRL' || trim($_POST['cafeimage_type']) == 'FTR' || trim($_POST['cafeimage_type']) == 'FTRX') {
			/* Check image already exists. */
			$cafefeaturedData = $cafeimageObject->getByFeatured($code, trim($_POST['cafeimage_type']));
			
			if($cafefeaturedData) {
				$errorArray['cafeimage_type'] = 'Feature image type already exists.';
				$formValid = false;					
			}
		} else {
			$errorArray['cafeimage_type'] = 'required';
			$formValid = false;					
		}
	} else {
		$errorArray['cafeimage_type'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data = array();
		$data['cafeimage_name'] 			= trim($_POST['cafeimage_name']);
		$data['cafeimage_description']	= trim($_POST['cafeimage_description']);
		$data['cafeimage_code']				= $cafeimageObject->createReference();		
		$data['cafe_code']						= $cafeData['cafe_code'];
			
		$ext 					= strtolower($fileObject->file_extention($_FILES['imagefile']['name']));					
		$filename			= $data['cafeimage_code'].'.'.$ext;
		$directorycafe	= '/media/cafe/featured/'.$cafeData['cafe_code'];
		$directory			= $directorycafe.'/'.$data['cafeimage_code'];
		$file					= $_SERVER['DOCUMENT_ROOT'].$directory.'/'.$filename;	
		
		if(!is_dir($directory)) mkdir($_SERVER['DOCUMENT_ROOT'].$directory, 0777, true);
		
		if(file_put_contents($file, file_get_contents($_FILES['imagefile']['tmp_name']))) {
			/* Create files for this product type. 
			foreach($zfsession->campaign['images'] as $image) {
			
				$newfilename = str_replace($filename, $image['code'].$filename, $file);

				$uploadObject	= PhpThumbFactory::create($_FILES['imagefile']['tmp_name']);
				$uploadObject->adaptiveResize($image['width'], $image['height']);
				$uploadObject->save($newfilename);
			}
			*/
			$data['cafeimage_path']			= '/media/cafe/featured/'.$cafeData['cafe_code'].'/'.$data['cafeimage_code'];
			$data['cafeimage_filename']	= trim($_FILES['imagefile']['name']);
			$data['cafeimage_extension']	= '.'.$ext ;
			$data['cafeimage_type']			= trim($_POST['cafeimage_type']);
			
			$success	= $cafeimageObject->insert($data);

			if(is_numeric($success)) {
				
				header('Location: /admin/cafes/featured.php?code='.$cafeData['cafe_code']);
				exit;
			}
		} else {
			
			echo('NO');
			$errorArray['cafeimage_name'] = 'could not upload file.';
			$formValid = false;			
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}

		
$cafeimageData = $cafeimageObject->getFeaturedByCafe($cafeData['cafe_code']);

if($cafeimageData) {
	$smarty->assign('cafeimageData', $cafeimageData);
}


 /* Display the template
 */	
$smarty->display('admin/cafes/featured.tpl');

?>