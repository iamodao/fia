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


#EXIT - with error message
function oExit($obj, $msg, $extra=''){
	$o = strtoupper($obj).'::';
	if(!empty($msg)){$o .=' <strong>'.ucwords($msg).'</strong>';}
	if(!empty($extra)){
		if(is_string($extra)){$o .= ' (<small><em>'.$extra.'</em></small>)';}
		else {
			$rez['OBJECT'] = $obj;
			$rez['MESSAGE'] = $msg;
			$rez['EXTRA'] = $extra;
			fia::dump($rez);
			exit;
		}
	}
	exit($o);
}


#INIT FILE
$o_initFile = $o_init['DIR_FIA'].DS.'init.php';
if(!file_exists($o_initFile)){oExit('init', 'missing file', $o_initFile);}
require $o_initFile;


#SET INITIAL SESSION ID ~ for reuse when unique session is created within the program
if(!isset($SESSION_INIT_ID)){$SESSION_INIT_ID = session_id();}
defined('SESSION_INIT_ID') ? null : define('SESSION_INIT_ID', $SESSION_INIT_ID);
$fia->sessionStart($SESSION_INIT_ID);



#SANDBOX FILE - for development, demo & testing
$o_sanbox = '_ignore/dev5/index.php';
if(file_exists($o_sanbox)){require $o_sanbox; unset($o_sanbox);}


#CALLING ROUTER
if(isset($fia) && class_exists('fia') && method_exists('fia', 'router')){
	$fia->router('oDEFAULT');
}
?>