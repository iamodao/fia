<?php
class User {


	public static function update($input, $object='profile'){
		$column = fia::arrayBind($input);
		$query = "UPDATE `user` SET ";
		if($object == 'type'){$query .= "`type` = :type";}
		elseif($object == 'username'){$query .= "`username` = :username";}
		elseif($object == 'status'){$query .= "`status` = :status";}
		elseif($object == 'office'){$query .= "`office` = :office";}
		elseif($object == 'phone'){$query .= "`phone` = :phone";}
		elseif($object == 'password'){$query .= "`password` = :password";}
		else {$query .= "`name` = :name AND `phone` = :phone AND `email` = :email";}
		$query .=" WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function delete($input){
		$column = fia::arrayBind($input);
		$query = "DELETE FROM `user` WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function read($input, $filter='bind'){
		$column = fia::arrayBind($input);
		if($filter == 'bind'){$query = "SELECT * FROM `user` WHERE `bind` = :bind LIMIT 1";}
		elseif($filter == 'type'){$query = "SELECT * FROM `user` WHERE `type` = :type";}
		elseif($filter == 'status'){$query = "SELECT * FROM `user` WHERE `status` = :status";}
		else {$query = "SELECT * FROM `user`";}
		return fia::runSQL($query, $column, 'oRECORD');
	}


	public static function employees($filter=''){
		$query = "SELECT * FROM `user` WHERE `status` = 'active'";
		$column = '';
		if(!empty($filter)){
			if(!is_array($filter)){
				$query .= " AND `type` = '".$filter."'";
			}
			// when filter is array
			else {
				$column = fia::arrayBind($filter);
				foreach ($filter as $key => $value){
					$query .= " AND `".$key."` = :".$key;
				}
			}
		}
		$query .= " ORDER BY `name` ASC";
		return fia::runSQL($query, $column, 'oRECORD');
	}
}



















class ActiveUser {
	public $data;

	public function __construct(){
		$input['bind'] = fia::session('active_user_bind');
		$column = fia::arrayBind($input);
		$query = "SELECT * FROM `user` WHERE `bind` = :bind LIMIT 1";
		$result = fia::runSQL($query, $column, 'oRECORD');
		if(fia::isRecordSQL($result, 'bind')){
			if(isset($result['password'])){unset($result['password']);}
			$this->data = $result;
			foreach ($result as $key => $value){$this->$key = $value;}
			return true;
		}
		return false;
	}

	public function info($field=''){
		if(!empty($field) && isset($this->$field)){return $this->$field;}
		elseif($field == 'oDATA' && isset($this->data)){return $this->data;}
		return false;
	}
}
?>