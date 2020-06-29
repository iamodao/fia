<?php
class User {

	public static function active(){
		if(!empty(fia::session('active_user_bind'))){
			$filter['bind'] = fia::session('active_user_bind');
			$result = oCRUD::read('user', $filter, '*', 1);
			if(isset($result['password'])){unset($result['password']);}
			if(!empty($result)){return $result;}
		}
		return false;
	}


	public static function read($filter='', $column='*', $limit=''){
		return oCRUD::read('user', $filter, $column, $limit);
	}

	// public static function create($input){
	// 	$column = fia::arrayBind($input);
	// 	$query = "INSERT INTO `user`
	// 	VALUES (:username, :password, :name, :phone, :email, :type, :office, :bind)";
	// 	$result = fia::runSQL($query, $column, 'oBOOLEAN');
	// 	return $result;
	// }

	public static function create($input){
		$input['bind'] = oCRUD::bindID();
		$field = array('username', 'password', 'name', 'phone', 'email', 'type', 'office', 'bind');
		return oCRUD::create($field, $input, 'user');
	}

}
?>