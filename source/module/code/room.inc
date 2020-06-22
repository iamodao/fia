<?php
class Room {
	public static function create($input){
		$column = fia::arrayBind($input);
		$query = "INSERT INTO `room` (`status`, `suite`, `room`, `bind`)
		VALUES (:status, :suite, :room, :bind)";
		$result = fia::runSQL($query, $column, 'oBOOLEAN');
		return $result;
	}


	public static function update($input, $object='profile'){
		$column = fia::arrayBind($input);
		$query = "UPDATE `room` SET ";
		if($object == 'suite'){$query .= "`suite` = :suite";}
		elseif($object == 'room'){$query .= "`room` = :room";}
		elseif($object == 'status'){$query .= "`status` = :status";}
		$query .=" WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function delete($input){
		$column = fia::arrayBind($input);
		$query = "DELETE FROM `room` WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function read($input, $filter='bind'){
		$column = fia::arrayBind($input);
		if($filter == 'bind'){$query = "SELECT * FROM `room` WHERE `bind` = :bind LIMIT 1";}
		elseif($filter == 'suite'){$query = "SELECT * FROM `room` WHERE `suite` = :suite";}
		elseif($filter == 'status'){$query = "SELECT * FROM `room` WHERE `status` = :status";}
		else {$query = "SELECT * FROM `room`";}
		return fia::runSQL($query, $column, 'oRECORD');
	}
}
?>