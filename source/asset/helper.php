<?php
function oTitle($return='title'){
	$oPage = strtolower(brax::route()); global $oTitle;
	if($oPage == 'index'){
		$title = brax::app('firm');
		$heading = brax::app('abbr');
	}
	else {
		$title = brax::app('abbr');
		$heading = brax::app('brand');
		if(array_key_exists($oPage, $oTitle)){
			$heading .= ' '.ucwords($oTitle[$oPage]);
			$title .= ' - '.ucwords($oTitle[$oPage]);
		}
	}
	return ${$return};
}


// return page breadcrumb
function oCrumb(){
	#collect required data
	$oPage = strtolower(brax::route());
	global $oTitle;
	#prepare & return result
	$task = '<a href="'.brax::app('url').'" title="'.brax::app('firm').'" class="brand">'.brax::app('brand').'</a>';
	if($oPage != 'index'){$task .= ' » <span class="location">'.ucwords($oTitle[$oPage]).'</span>';}
	return $task;
}

// return reponsive date
function oDate(){
	#prepare & return result
	// $device = Device::is();
	$task = 'l, F d, Y';
	// if($device=='tablet'){$task = 'F d, Y';}
	// if($device=='phone'){$task = 'd/m/Y';}
	return date($task);
}

function oIsURLActive($url){
	$route = brax::route();
	if($route == $url){return TRUE;}
	return FALSE;
}

function oCSSActive($url){
	if(oIsURLActive($url)){echo " active";}
	return;
}

function oTrack($input=''){
	$query = "SELECT * FROM `record` WHERE `track_id` = '$input'";
	$result = queryDB($query, 'record');
	if($result === FALSE){return FALSE;}
	if(brax::isMultiDi($result)){$result = $result[0];}
	return $result;
}
?>