<?php
class Booking {
	public static function create($input, $type='room'){
		$input['bind'] = oCRUD::bindID();
		$input['refid'] = mt_rand(1000,9999);
		$input['type'] = strtoupper($type);
		$field = array('bind', 'refid', 'type', 'name', 'email', 'phone', 'address', 'sex', 'summary', 'schedule');
		if($type == 'room'){$field[] = 'suite';}
		return oCRUD::create($field, $input, 'booking');
	}


	public static function createV2(){
		$field = array('summary', 'name', 'phone', 'email', 'type', 'schedule_date', 'schedule_time');
		$record = fia::dataRecord('oPOST', $field);
		$record['bind'] = time().mt_rand(10000, 99999);
		$record['refid'] = mt_rand(1000,9999);
		$record['author'] = fia::session('active_user_bind');
		$column = fia::arrayBind($record);
		$query = "INSERT INTO `booking` (`refid`, `summary`, `name`, `phone`, `email`, `type`, `schedule_date`, `schedule_time`, `author`, `bind`)
		VALUES (:refid, :summary, :name, :phone, :email, :type, :schedule_date, :schedule_time, :author, :bind)";
		return fia::isCountSQL($query, $column, 1);
	}

}
?>