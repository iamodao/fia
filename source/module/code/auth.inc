<?php
class Auth {

	public function isLoggedIn($link=''){
		if(fia::session('is_logged_in') !== 'yez'){
			if(empty($link)){
				fia::exitTo('login?oact=not-logged-in', 'oRELATIVE');
			}
			else {
				fia::exitTo($link, 'oRELATIVE');
			}
		}
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