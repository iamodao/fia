<?php
class Auth {
	public static function isLoggedIn($link=''){
		if(fia::session('is_logged_in') !== 'yez'){
			if(empty($link)){
				fia::exitTo('login?oact=not-logged-in', 'oRELATIVE');
			}
			else {
				fia::exitTo($link, 'oRELATIVE');
			}
		}
	}


	public static function Login(){
		$field = array('userid', 'password');
		$record = fia::dataRecord('oPOST', $field);
		$column = fia::arrayBind($record);
		if($record !== false){
			$query = "SELECT * FROM `user` WHERE `username` = :userid AND `password` = :password LIMIT 1";
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


	public static function logout(){
		fia::sessionUnset('oFORM_POST_DATA');
		fia::sessionUnset('active_user_bind');
		fia::sessionUnset('is_logged_in');
		fia::sessionFresh();
		fia::exitTo('login?oact=logged-out', 'oRELATIVE');
	}








	public static function passwordCheck($input){
		$column = fia::arrayBind($input);
		$query = "SELECT * FROM `user` WHERE `password` = :password AND `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}

	public static function passwordUpdate($input){
		$column = fia::arrayBind($input);
		$query = "UPDATE `user` SET `password` = :password WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}





}?>