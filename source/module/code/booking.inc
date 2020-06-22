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

}
?>