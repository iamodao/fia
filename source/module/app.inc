<?php
// The default APP controller
class oAPP {
	var $controller;

	public function __construct(){
		#fia::sessionStart();
		fia::ocode('auth');
		fia::ocode('notify');
		$no_auth_routes = array('login', 'logout', 'password-reset', 'index');
		if(!fia::routeExempt($no_auth_routes)){
			Auth::isLoggedIn();
		}
		fia::ocode('user');
		$this->iscontroller();
		$this->{$this->controller}();
	}

	private function iscontroller(){
		$method = oString::to(fia::route('oAPP'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('app', $method, 'controller required');}
		$this->controller = $method;
	}

	protected function logout(){
		Auth::logout();
	}

	protected function index(){
		Auth::isLoggedIn('login');
		fia::exitTo('dashboard', 'oRELATIVE');
	}


	protected function login(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'login');
				if(!Auth::login()){
					fia::exitTo('login?oact=login-failed', 'oRELATIVE');
				}
				else {
					fia::sessionUnset('oFORM_POST_DATA');
					fia::exitTo('dashboard', 'oRELATIVE');
				}
			}
			else {
				fia::exitTo('login', 'oRELATIVE');
			}
		}
		fia::otheme('auth');
		fia::sessionUnset('active_user_bind');
		fia::sessionUnset('is_logged_in');
	}


	protected function passwordReset(){
		fia::otheme('auth');
	}


	protected function dashboard(){
		fia::otheme('main');
	}


}
$runAPP = new oAPP;
?>