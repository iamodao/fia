<?php
/**
 * FIA™ framework ~ a micro framework for website, application and API development with PHP & MySQL; © 2020 VERI8™, Inc.
 * =====================================================================================================================
 **/

#DEFINE SEPARATOR
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');


#SET DIRECTORY
$o_init['DIR_ROOT'] = __DIR__;
$o_init['DIR_FIA'] = $o_init['DIR_ROOT'].DS.'fia';
$o_init['DIR_SOURCE'] = $o_init['DIR_ROOT'].DS.'source';


#EXIT & ERROR REPORTER
function oExit($obj, $msg, $extra=''){
	$o = strtoupper($obj).'::';
	if(!empty($msg)){$o .=' <strong>'.ucwords($msg).'</strong>';}
	if(!empty($extra)){$o .= ' (<small><em>'.$extra.'</em></small>)';}
	exit($o);
}





#INITIALATION FILE
$init_file = $o_init['DIR_FIA'].DS.'init.php';
if(!file_exists($init_file)){oExit('init', 'missing file', $init_file);}
require $init_file;


#SANDBOX FILE - for development, demo & testing
$sandbox_file = '_ignore/dev5/index.php';
if(file_exists($sandbox_file)){require $sandbox_file;}


#ROUTER CALL
if(isset($fia) && class_exists('fia') && method_exists('fia', 'router')){
	$fia->router('oDEFAULT');
}
?>