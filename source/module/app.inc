<?php
// The default APP controller
class oAPP {
	var $controller;

	public function __construct(){
		fia::ocode('auth');
		fia::ocode('notify');
		$no_auth_routes = array('login', 'logout', 'password-reset', 'index');
		if(!fia::routeExempt($no_auth_routes)){
			Auth::isLoggedIn();
		}
		fia::ocode('user');
		fia::ocode('booking');
		fia::ocode('suite');
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
		fia::sessionUnset('oFORM_POST_DATA');
	}


	protected function passwordReset(){
		fia::otheme('auth');
	}


	protected function dashboard(){
		fia::otheme('main');
	}

	protected function booking(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'booking');
				$_POST['schedule'] = '';
				if(!empty($_POST['schedule_date'])){$_POST['schedule'] .= $_POST['schedule_date'];} else {
					$date = strtotime('Tomorrow');
					$_POST['schedule'] .= date("Y-m-d", $date);
				}
				if(!empty($_POST['schedule_time'])){$_POST['schedule'] .= ' '.$_POST['schedule_time'];} else {$_POST['schedule'] .= ' 09:45:30';}
				$booking = Booking::create($_POST, strtolower($_POST['type']));
				if($booking == true){fia::exitTo('booking?oact=success', 'oRELATIVE');}
			}
			fia::exitTo('booking?oact=error', 'oRELATIVE');
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function createSuite(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'suite');
				$suite = Suite::create($_POST);
				if($suite == true){fia::exitTo('create-suite?oact=success', 'oRELATIVE');}
			}
			fia::exitTo('create-suite?oact=error', 'oRELATIVE');
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function createStaff(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'staff');
				$staff = User::create($_POST);
				if($staff == true){fia::exitTo('create-staff?oact=success', 'oRELATIVE');}
			}
			fia::exitTo('create-staff?oact=error', 'oRELATIVE');
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function updateProfile(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'profile');
				$_POST['bind'] = fia::session('active_user_bind');
				$result = User::update($_POST);
				if($result == true){fia::exitTo('update-profile?oact=success', 'oRELATIVE');}
			}
			fia::exitTo('update-profile?oact=error', 'oRELATIVE');
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function changePassword(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'password');
				$_POST['bind'] = fia::session('active_user_bind');
				$result = User::update($_POST);
				if($result == true){fia::exitTo('change-password?oact=success', 'oRELATIVE');}
			}
			fia::exitTo('change-password?oact=error', 'oRELATIVE');
		}
		elseif(fia::routeAction() == 'success'){
			fia::redirect('login?oact=changed-password', 3, 'oRELATIVE', 'oNOPE');
		}
		fia::otheme('main');
		fia::sessionUnset('oFORM_POST_DATA');
	}

	protected function reservations(){
		fia::otheme('main');
	}

	protected function suites(){
		fia::otheme('main');
	}

	protected function staffs(){
		fia::otheme('main');
	}

	protected function delete(){
		$record = fia::routeAction();
		$id = $_GET['id'];
		if(!empty($id) && !empty($record)){
			$input['bind'] = $id;
			if($record == 'booking'){$result = Booking::delete($input);}
			if($result == true){fia::exitTo('reservations?oact=deleted', 'oRELATIVE');}
		}
	}
}
$runAPP = new oAPP;
?>