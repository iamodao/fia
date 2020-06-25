<?php
function Notify($method=''){
	// public static function booking(){
	// 	$action = fia::routeAction();
	// 	if($action == 'default'){$msg = '<p class=" mdc-theme--info">Please complete the form below with valid information</p>';}
	// 	elseif($action == 'success'){$msg = '<p class=" mdc-theme--success">You have successfully completed a booking</p>';}
	// 	elseif($action == 'warning'){$msg = '<p class=" mdc-theme--warning">Please correct the following errors</p>';}
	// 	elseif($action == 'error') {$msg = '<p class="mdc-typography mdc-theme--secondary">Sorry, your action failed!</p>';}
	// 	if(!empty($msg)){return $msg;}
	// }

	// public static function passwordReset(){}


	$action = fia::routeAction();
	$notify = '<p class="small mb-3 ';

	if($method == 'login'){
		if($action == 'login-failed'){$notify .= 'text-danger">Sorry, your authentication failed!';}
		elseif($action == 'not-logged-in'){$notify .= 'text-warning">You are required to login';}
		elseif($action == 'logged-out'){$notify .= 'text-success">Your account has been logged out';}
		else {$notify .= 'text-info">Please enter your login information';}
	}

	$notify .= "</p>";
	echo $notify;
	return true;
}

?>