<?php
// The default APP controller
class oAPP {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		fia::sessionStart();
		fia::ocode('auth');
		fia::ocode('message');
		$no_auth_routes = array('login', 'logout', 'lost-password', 'index');
		if(!fia::routeExempt($no_auth_routes)){
			Auth::isLoggedIn();
		}
		fia::ocode('user');
		$this->{$this->controller}();
	}


	private function iscontroller(){
		$method = oString::to(fia::route('oAPP'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('app', $method, 'controller required');}
		$this->controller = $method;
	}










	protected function dashboard(){fia::otheme('main');}
	protected function booking(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'booking');
				fia::ocode('booking');
				if(Booking::create() == true){fia::exitTo('booking?oact=success', 'oRELATIVE');}
				fia::exitTo('booking?oact=error', 'oRELATIVE');
			}
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function reservations(){
		fia::ocode('booking');
		fia::otheme('main');
	}


}

$runAPP = new oAPP;
?>