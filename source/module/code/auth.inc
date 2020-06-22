<?php
class Auth {

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