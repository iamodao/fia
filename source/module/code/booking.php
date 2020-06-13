<?php
class bookingApp {
	static function LoginMessage(){
		$action = fia::routeAction();
		if($action == 'default'){$msg = '<p class=" mdc-theme--info">Please enter your login information</p>';}
		elseif($action == 'logged-out'){$msg = '<p class=" mdc-theme--success">Your account has been logged out</p>';}
		elseif($action == 'not-logged-in'){$msg = '<p class=" mdc-theme--warning">You are required to login</p>';}
		elseif($action == 'login-failed') {$msg = '<p class="mdc-typography mdc-theme--secondary">Sorry, your authentication failed!</p>';}
		if(!empty($msg)){return $msg;}
	}
}
?>