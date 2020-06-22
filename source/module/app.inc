<?php
// The default APP controller
class oAPP {
	var $controller;

	public function __construct(){
		$this->set_controller();
		fia::sessionStart();
		$no_auth_routes = array('login', 'logout', 'lost-password');
		if(!fia::routeExempt($no_auth_routes)){
			fia::ocode('auth');
			Auth::isLoggedIn();
		}
		$method = $this->controller;
		$this->$method();
	}


	private function set_controller(){
		$method = fia::stringTo(fia::route('oAPP'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('app', $method, 'controller required');}
		$this->controller = $method;
	}


	protected function index(){}

	protected function login(){
		fia::otheme('auth');
		fia::sessionUnset('active_user_bind');
		fia::sessionUnset('is_logged_in');
	}


}

$runAPP = new oAPP;
?>