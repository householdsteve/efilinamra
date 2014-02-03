<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

error_reporting(E_ALL);

/**
 * Standard includes
 */
require_once 'config/database.php';

require_once 'admin/includes/auth.php';

global $zfsession;

// Clear the identity from the session
$zfsession->userData = null;
$zfsession->identity = null;
$zfsession->link = null;
$zfsession = null;

unset($zfsession->identity);
unset($zfsession->link);
unset($zfsession->userData);
unset($zfsession);


//redirect to login page
header('Location: /admin/login.php');
exit;
?>