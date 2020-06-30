<?php
function Notify($method=''){
	$action = fia::routeAction();
	$notify = '<p class="small mb-3 ';

	if($method == 'login'){
		if($action == 'login-failed'){$notify .= 'text-danger">Sorry, your authentication failed!';}
		elseif($action == 'not-logged-in'){$notify .= 'text-warning">You are required to login';}
		elseif($action == 'logged-out'){$notify .= 'text-success">Your account has been logged out';}
		elseif($action == 'changed-password'){$notify .= 'text-success">Your have password was changed. Please login again';}
		else {$notify .= 'text-info">Please enter your login information';}
	}
	else {
		if($action == 'error'){$notify .= 'text-danger">Sorry, your action failed!';}
		elseif($action == 'warning'){$notify .= 'text-warning">Please correct the following errors';}
		elseif($action == 'success'){
			if($method == 'staff'){$notify .= 'text-success">You have successfully created a staff';}
			if($method == 'suite'){$notify .= 'text-success">You have successfully created a suite';}
			if($method == 'booking'){$notify .= 'text-success">You have successfully completed a booking';}
			if($method == 'update-profile'){$notify .= 'text-success">You have successfully updated your profile';}
			if($method == 'change-password'){$notify .= 'text-success">You have successfully changed your password';}
		}
		else {$notify .= 'text-info">Please complete the form below with valid information';}
	}

	$notify .= "</p>";
	echo $notify;
	return true;
}

?>