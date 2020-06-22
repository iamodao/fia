<?php
// app primary controller
class oAPP {
	var $method;

	public function __construct(){
		$method = fia::stringTo(fia::route(), 'oMETHOD');
		if(!empty($method) && method_exists(__CLASS__, $method)){
			$this->method = $method;
			fia::sessionStart();
			$noauthroute = array('login', 'logout', 'index', 'password-reset');
			$exemptroute = fia::routeExempt($noauthroute);
			if(!$exemptroute){
				$this->Auth_IsLoggedIn();
			}
			fia::code('booking');
			return $this->$method();
		}
	}


	public function demo(){}


	public function index(){
		self::Auth_IsLoggedIn('login');
		fia::exitTo('dashboard', 'oRELATIVE');
	}


	public function logout(){
		$this->Auth_Logout();
	}


	public function login(){
		if(fia::routeAction() == 'process'){
			if(!empty($_POST)){
				fia::formData('oPOST', 'login');
				if(!self::Auth_Login()){
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
		fia::theme('auth');
		fia::sessionUnset('active_user_bind');
		fia::sessionUnset('is_logged_in');
	}

	public function passwordReset(){fia::theme('auth');}


	public function dashboard(){fia::theme('main');}


	public function booking(){fia::theme('main');}

	public function roomReservation(){
		fia::theme('main');
	}

	public function loungeReservation(){fia::theme('main');}

	public function cleaningReservation(){fia::theme('main');}

	public function salonReservation(){fia::theme('main');}
	public function rooms(){fia::theme('main');}
	public function suites(){fia::theme('main');}
	public function newEmployee(){fia::theme('main');}
	public function employees(){fia::theme('main');}
	public function updateProfile(){fia::theme('main');}
	public function changePassword(){
		fia::theme('main');
	}
	public function manual(){fia::theme('main');}


	public function settings(){
		// $load_auth_code = fia::ocode('auth');
		// if($load_auth_code){
		// 	$input['bind'] = fia::session('active_user_bind');
		// 	$input['password'] = 'MyOwnGuy';

		// 	if(fia::stringMatch($input) === false){fia::exitTo('settingzs?oact=password-nomatch', 'oRELATIVE');}
		// 	elseif(Auth::passwordCheck($input) === false){fia::exitTo('settings?oact=password-invalid', 'oRELATIVE');}
		// 	elseif(Auth::passwordUpdate($input) === false){fia::exitTo('settings?oact=password-update-failed', 'oRELATIVE');}
		// 	else {
		// 		echo 'Password updated';
		// 	}
		// }
		// // fia::dump($xn);

		// fia::code('user');

		// $input['bind'] = mt_rand();
		// $input['username'] = 'room';
		// $input['password'] = 'RoomGuy';
		// $input['name'] = 'Room Guy';
		// $input['phone'] = '09097996078';
		// $input['email'] = 'room@guy.com';
		// $input['type'] = 'STAFF';
		// $input['office'] = 'ROOM';
		// $input['status'] = 'active';
		// $sand = User::create($input);

		// $input['bind'] = '946937716';
		// $sand = User::read($input, 'ol');

		// fia::dump($sand);
		fia::theme('main');
	}














	private function Auth_Login(){
		$field = array('userid', 'password');
		$record = fia::dataRecord('oPOST', $field);
		$column = fia::arrayBind($record);
		if($record !== false){
			$query = "SELECT `bind` FROM `user` WHERE `username` = :userid AND `password` = :password LIMIT 1";
			$result = fia::runSQL($query, $column, 'oRECORD');
			if(fia::isRecordSQL($result, 'bind')){
				fia::session('active_user_bind', $result['bind']);
				fia::session('is_logged_in', 'yez');
				return true;
			}
		}
		else {
			fia::sessionUnset('active_user_bind');
			fia::sessionUnset('is_logged_in');
		}
		return false;
	}

	private function Auth_Logout(){
		fia::sessionUnset('oFORM_POST_DATA');
		fia::sessionUnset('active_user_bind');
		fia::sessionUnset('is_logged_in');
		fia::sessionFresh();
		fia::exitTo('login?oact=logged-out', 'oRELATIVE');
	}


	private function Auth_User(){
		$query = "SELECT * FROM `user` WHERE `bind` = '".fia::session('active_user_bind')."' LIMIT 1";
		$result = fia::runSQL($query);
		if(fia::isRecordSQL($result, 'oRECORD')){
			return $result['oRECORD'];
		}
		return false;
	}


	private function Auth_RestrictTo($type='', $redirect=''){
		#self::Auth_IsLoggedIn();
		$user = self::Auth_User();
		$restrict = 'no';
		if(!empty($type) && !empty($user['type'])){
			if(!is_array($type) && $type != $user['type']){$restrict = 'yez';}
			elseif(is_array($type) && !in_array($user['type'], $type)){$restrict = 'yez';}
		}
		if($restrict == 'yez'){
			if(!empty($redirect)){fia::exitTo($redirect, 'oRELATIVE');}
			else {fia::exitTo('login', 'oRELATIVE');}
		}
	}

	private function Auth_ChangePassword($input){
		$field = array('password', 'newpassword', 'repassword', 'bind');
		$record = fia::dataRecord($input, $field);
		if($record !== false){
			$query = "SELECT `password` FROM `user` WHERE `bind` = :bind LIMIT 1";
		}


	}



}


$runApp = new oAPP;
?>