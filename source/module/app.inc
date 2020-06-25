<?php
// The default APP controller
class oAPP {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		fia::ocode('auth');
		$this->{$this->controller}();
	}

	private function iscontroller(){
		$method = oString::to(fia::route('oAPP'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('app', $method, 'controller required');}
		$this->controller = $method;
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
}
$runAPP = new oAPP;
?>