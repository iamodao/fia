<?php
# Define Separator
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');

$oInit['RD'] = __DIR__;

$oInit['FileInit'] = $oInit['RD'].DS.'source'.DS.'fia.init.php';
if(!file_exists($oInit['FileInit'])){exit('PATH::Missing [Initializer Required]');}
require $oInit['FileInit'];

# Include sandbox for development, demo & testing
if(file_exists('_ignore/dev5/index.php')){require '_ignore/dev5/index.php';}

	# NOTE ~ when for website [oSITE], for app & api - using auto controllers (oAUTO), or set manually (oGET)
if(isset($fia) && class_exists('fia') && method_exists('fia', 'orouter')){
	$projectAs = 'oAUTO';
	$fia->orouter($projectAs);
}
?>