<?php
class Booking {

	public static function reservations($filter=''){
		$query = "SELECT * FROM `booking` WHERE `status` != 'done'";
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
		$query .= " ORDER BY `id` DESC";
		return fia::runSQL($query, $column, 'oRECORD');
	}


	public static function create(){
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