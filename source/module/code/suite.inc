<?php
class Suite {
	public static function create($input){
		$column = fia::arrayBind($input);
		$query = "INSERT INTO `suite` (`status`, `suite`, `price`, `bind`)
		VALUES (:status, :suite, :price, :bind)";
		$result = fia::runSQL($query, $column, 'oBOOLEAN');
		return $result;
	}


	public static function update($input, $object='profile'){
		$column = fia::arrayBind($input);
		$query = "UPDATE `suite` SET ";
		if($object == 'suite'){$query .= "`suite` = :suite";}
		elseif($object == 'price'){$query .= "`price` = :price";}
		elseif($object == 'status'){$query .= "`status` = :status";}
		$query .=" WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function delete($input){
		$column = fia::arrayBind($input);
		$query = "DELETE FROM `suite` WHERE `bind` = :bind LIMIT 1";
		return fia::isCountSQL($query, $column, 1);
	}


	public static function read($input, $filter='bind'){
		$column = fia::arrayBind($input);
		if($filter == 'bind'){$query = "SELECT * FROM `suite` WHERE `bind` = :bind LIMIT 1";}
		elseif($filter == 'suite'){$query = "SELECT * FROM `suite` WHERE `suite` = :suite";}
		elseif($filter == 'status'){$query = "SELECT * FROM `suite` WHERE `status` = :status";}
		else {$query = "SELECT * FROM `suite`";}
		return fia::runSQL($query, $column, 'oRECORD');
	}
}
?>