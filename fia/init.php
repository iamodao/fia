<?php
# Start session
if(!isset($_SESSION)){session_start();}
$oInit['FD'] = __DIR__;


# Configuration ~ NOTE: application directory is set to config.php's directory. And when config is not set, root directory (RD) becomes config directory
$oInit['FileConfig'] = $oInit['RD'].DS.'source'.DS.'config.php';
if(!file_exists($oInit['FileConfig'])){
	$oInit['FileConfig'] = $oInit['FD'].DS.'config.php';
	if(!file_exists($oInit['FileConfig'])){
		$oInit['FileConfig'] = $oInit['RD'].DS.'config.php';
	}
}

if(file_exists($oInit['FileConfig'])){
	require $oInit['FileConfig'];
	if(isset($oInitConfig) && is_array($oInitConfig) && isset($oInit) && is_array($oInit)){$oInit = array_merge($oInit, $oInitConfig);}
}

$oInit['CD'] = dirname($oInit['FileConfig']);


# Module Directory
$moduleDir = $oInit['CD'].DS.'module';
if(is_dir($moduleDir)){$oInit['moduleDir'] = $moduleDir;}

# Upload Directory
$uploadDrive = $oInit['CD'].DS.'drive';
if(is_dir($uploadDrive)){$oInit['drive'] = $uploadDrive;}


# Include FIA & Initialize
$oInit['FileCore'] = $oInit['FD'].DS.'fia.php';
if(file_exists($oInit['FileCore'])){
	require $oInit['FileCore'];
	if(!class_exists('fia') || !method_exists('fia', 'init')){exit('CORE::Unavailable [Initialization Failed]');}
	$fia = fia::instantiate($oInit);
	unset($oInit);
}
?>