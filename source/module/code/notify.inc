<?php
function Notify($method=''){
	$action = fia::routeAction();
	$notify = '<p class="small mb-3 ';

	if($method == 'login'){
		if($action == 'login-failed'){$notify .= 'text-danger">Sorry, your authentication failed!';}
		elseif($action == 'not-logged-in'){$notify .= 'text-warning">You are required to login';}
		elseif($action == 'logged-out'){$notify .= 'text-success">Your account has been logged out';}
		else {$notify .= 'text-info">Please enter your login information';}
	}

	if($method == 'booking'){
		if($action == 'error'){$notify .= 'text-danger">Sorry, your action failed!';}
		elseif($action == 'warning'){$notify .= 'text-warning">Please correct the following errors';}
		elseif($action == 'success'){$notify .= 'text-success">You have successfully completed a booking';}
		else {$notify .= 'text-info">Please complete the form below with valid information';}
	}

	if($method == 'suite'){
		if($action == 'error'){$notify .= 'text-danger">Sorry, your action failed!';}
		elseif($action == 'warning'){$notify .= 'text-warning">Please correct the following errors';}
		elseif($action == 'success'){$notify .= 'text-success">You have successfully created a suite';}
		else {$notify .= 'text-info">Please complete the form below with valid information';}
	}

	if($method == 'staff'){
		if($action == 'error'){$notify .= 'text-danger">Sorry, your action failed!';}
		elseif($action == 'warning'){$notify .= 'text-warning">Please correct the following errors';}
		elseif($action == 'success'){$notify .= 'text-success">You have successfully created a staff';}
		else {$notify .= 'text-info">Please complete the form below with valid information';}
	}

	$notify .= "</p>";
	echo $notify;
	return true;
}

?>