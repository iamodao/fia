<?php
#CONFIGURATION FILE
$config_file_name = 'config.php';
$config_file = $o_init['DIR_SOURCE'].DS.$config_file_name;
if(!file_exists($config_file)){
	$config_file = $o_init['DIR_FIA'].DS.$config_file_name;
	if(!file_exists($config_file)){
		$config_file = $o_init['DIR_ROOT'].DS.$config_file_name;
	}
}

if(file_exists($config_file)){
	require $config_file;
	if(isset($o_config) && is_array($o_config) && isset($o_init) && is_array($o_init)){
		$o_init = array_merge($o_init, $o_config);
	}
}
else {
	oExit('config', 'missing file', $config_file);
}


#MODULE DIRECTORY
$module_path = $o_init['DIR_SOURCE'].DS.'module';
if(is_dir($module_path)){$o_init['path']['module'] = $module_path;}
else {oExit('module', 'no directory', $module_path.DS);}


#LAYOUT DIRECTORY
$layout_path = $o_init['DIR_SOURCE'].DS.'layout';
if(is_dir($layout_path)){$o_init['path']['layout'] = $layout_path;}
else {oExit('layout', 'no directory', $layout_path.DS);}


#UPLOAD DIRECTORY
$drive_path = $o_init['DIR_SOURCE'].DS.'drive';
if(is_dir($drive_path)){$o_init['path']['drive'] = $drive_path;}


#CORE LIBRARY
$core_lib = $o_init['DIR_FIA'].DS.'lib'.DS;
require($core_lib.'string.inc');
require($core_lib.'json.inc');
require($core_lib.'sql.inc');
require($core_lib.'data.inc');
require($core_lib.'crud.inc');
require($core_lib.'input.inc');
require($core_lib.'format.inc');


#FIA CORE, INSTANTIATION & INITIALIZATION
$core_file = $o_init['DIR_FIA'].DS.'fia.php';
if(file_exists($core_file)){
	require $core_file;
	if(!class_exists('fia') || !method_exists('fia', 'initialize')  || !method_exists('fia', 'instantiate')){
		oExit('core', 'unavailable', 'Initialization Failed');
	}

	$fia = fia::instantiate($o_init);
	unset($o_init);
}
else {
	oExit('core', 'missing file', $core_file);
}
?>