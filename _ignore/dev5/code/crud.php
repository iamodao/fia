<?php
class CRUD {
	private static $instance;
	public static $connection;

	//-------------- Prevent multiple instances ---------------
	private function __construct($driver='MySQL', $dataset='o_auto'){
		if($driver == 'MySQL'){
			require_once 'mysql.php';
			return self::$connection = MySQLPDO::instantiate($dataset);
		}
		return;
	}

	//-------------- Prevent duplication ---------------
	private function __clone(){return;}

	//-------------- Returns a single instance ---------------
	public static function instantiate($driver='MySQL', $dataset='o_auto'){
		if(is_null(self::$instance)){
			self::$instance = new self($driver, $dataset);
		}
		return self::$instance;
	}

	//-------------- Auto populate dataset with puid|suid|bind ---------------
	public static function guid($dataset){
		$data = array();
		if(empty($dataset)){$dataset = array();}
		if(!array_key_exists('bind', $dataset)){$data['bind'] = Helper::randomize('bind');}
		if(!array_key_exists('puid', $dataset)){$data['puid'] = Helper::randomize('puid');}
		if(!array_key_exists('suid', $dataset)){$data['suid'] = Helper::randomize('suid');}
		return array_merge($data, $dataset);
	}

	//--------------Return single row from recordset  ---------------
	public static function row($recordset){
		return self::$connection->fetchRow($recordset,'ASSOC');
	}

	//-------------- Return all row from recordset ---------------
	public static function rows($recordset){
		return self::$connection->fetchRows($recordset,'ASSOC');
	}

	//-------------- Return number of rows from recordset ---------------
	public static function numRows($recordset){
		return self::$connection->numRows($recordset);
	}

	//-------------- Query Database ---------------
	public static function query($query, $boolean='nope'){
		return self::$connection->query($query, $boolean);
	}

	//-------------- Create Record ---------------
	public static function create($table, $dataset, $boolean='yeah'){
		$dataset = self::guid($dataset);
		$result = self::$connection->insert($table, $dataset, $boolean);
		return $result;
	}

	//-------------- Read Record ---------------
	public static function read($table, $field, $condition='o_all', $boolean='nope'){
		$query = "SELECT ".$field." FROM `".$table.'`';
		if(!empty($condition) && $condition != 'o_all'){$query .= ' '.$condition;}
		$result = self::$connection->query($query, $boolean);
		return $result;
	}

	//-------------- Find records from table ---------------
	public static function find($table, $field, $dataset, $boolean='nope'){
		return self::$connection->select($table, $field, $dataset, $sym='=', $boolean);
	}

	//-------------- Update Record in table ---------------
	public static function update($table, $dataset, $condition='', $boolean='nope'){
		$result = self::$connection->update($table, $dataset, $condition, $boolean);
		return $result;
	}

	//-------------- Delete record ---------------
	public static function remove($table, $condition, $limit, $boolean='nope'){
		$query = "DELETE FROM `".$table.'`';
		if(!empty($condition) && $condition != 'o_all'){$query .= ' '.$condition;}
		if(!empty($limit) && $limit != 'o_none'){$query .=' LIMIT '.$limit;}
		$result = self::$connection->query($query, $boolean);
		if($result === true){return true;}
		return false;
	}

	//-------------- Delete records from table using id ---------------
	public static function removeID($table, $id, $boolean='nope'){
		$condition = "WHERE `id` = '".$id."'";
		return self::remove($table, $condition, 1, $boolean);
	}

	//-------------- Delete records from table using bind ---------------
	public static function removeBIND($table, $bind, $boolean='nope'){
		$condition = "WHERE `bind` = '".$bind."'";
		return self::remove($table, $condition, 1, $boolean);
	}

	//-------------- Delete records from table using puid ---------------
	public static function removePUID($table, $puid, $boolean='nope'){
		$condition = "WHERE `puid` = '".$puid."'";
		return self::remove($table, $condition, 1, $boolean);
	}

	//-------------- Delete records from table using suid ---------------
	public static function removeSUID($table, $suid, $boolean='nope'){
		$condition = "WHERE `suid` = '".$suid."'";
		return self::remove($table, $condition, 1, $boolean);
	}



	//-------------- Check records existence in table ---------------
	public static function exist($table, $column, $record, $limit='o_none', $return='boolean'){
		$query = "SELECT '".$column."' FROM `".$table."` WHERE `".$column."` = '".$record."'";
		if(!empty($limit) && $limit != 'o_none'){$query .=' LIMIT '.$limit;}
		$result = self::$connection->query($query, 'nope');
		$count = self::$connection->numRows($result);
		if($count != 0){
			if($return == 'count'){return $count;}
			elseif($return == 'record'){return $result;}
			else {return true;}
		}
		return false;
	}

	//-------------- Delete all records in table ---------------
	public static function expunge($table){
		$query = "TRUNCATE `".$table.'`';
		$result = self::$connection->query($query, 'yeah');
		if($result === true){return true;}
		return false;
	}
}
// END OF CLASS - CRUD
?>