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

	public static function update($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::updateBIND($input, 'user');}
	}


	public static function create($input){
		$input['bind'] = oCRUD::bindID();
		$field = array('username', 'password', 'name', 'phone', 'email', 'type', 'office', 'bind');
		return oCRUD::create($field, $input, 'user');
	}

}
?>