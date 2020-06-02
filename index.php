<?php
# Define Separator
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');

$oInit['RD'] = __DIR__;
$oInit['FileInit'] = $oInit['RD'].DS.'source'.DS.'fia.init.php';
if(!file_exists($oInit['FileInit'])){exit('PATH::Missing [Initializer Required]');}
require $oInit['FileInit'];
if(file_exists('sandbox.php')){require 'sandbox.php';}
if(isset($fia) && class_exists('fia') && method_exists('fia', 'orouter')){
	# NOTE ~ when for website [oSITE], for app & api - using auto controllers (oAUTO), or set manually (oGET)
	$projectAs = 'oAUTO';
	$fia->orouter($projectAs);
}
?>