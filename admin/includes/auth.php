<?php

//error_reporting(!E_DEPRECATED);

//standard config include.
require_once 'config/database.php';
require_once 'config/smarty.php';

//include the Zend class for Authentification
require_once 'Zend/Session.php';

// Set up the namespace
$zfsession = new Zend_Session_Namespace('BackendLogin');

// Check if logged in, otherwise redirect
if (!isset($zfsession->userData) || is_null($zfsession->userData)) {
	header('Location: /admin/login.php');
	exit();
} else {
	
	$smarty->assign('admin', $zfsession->userData);

}

$zfsession->campaign['images']	= array(
															'min'			=> array('width' => '50', 'height' => '50', 'code' => 'min_'),
															'tiny'			=> array('width' => '120', 'height' => '120', 'code' => 'tny_'),
															'thumb'		=> array('width' => '300', 'height' => '200', 'code' => 'tmb_'),
															'medium'	=> array('width' => '570', 'height' => '320', 'code' => 'mdm_'),
															'big'			=> array('width' => '536', 'height' => '480', 'code' => 'big_'),
															'orig'			=> array('width' => '3000', 'height' => '3000', 'code' => '')
														);
$smarty->assign('images', $zfsession->campaign['images']);

function toFilename($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);	
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace("â€“", "ae", $string);	
	$string = str_replace("â", "a", $string);	
	$string = str_replace("€", "e", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '_' , $string);		
	$string = str_replace(':' , '_' , $string);		
	$string = str_replace('[' , '_' , $string);		
	$string = str_replace(']' , '_' , $string);		
	$string = str_replace('|' , '_' , $string);		
	$string = str_replace('\\' , '_' , $string);		
	$string = str_replace('%' , '_' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '' , $string);	
	return $string;
			
}														
?>