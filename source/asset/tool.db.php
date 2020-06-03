<?php 
//************ BEGIN DATABASE OPERATION ************//
//Handle database connection
class db {
	private static $instance;

	//-------------- Prevent multiple instances ---------------
	private function __construct(){return;}


	//-------------- Returns a single instance ---------------
	public static function instantiate(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	//-------------- Returns connection ---------------
	public static function connect(){
		global $oDB;
		$data = $oDB;
		$dsn = 'mysql:dbname='.$data["database"].';host='.$data["host"]; #Data Source Name
		try {$connection = new PDO($dsn, $data["user"], $data["password"]);}
		catch (PDOException $e){die('Connection failed: ' . $e->getMessage());}
		return $connection;
	}
}

$db = db::connect();

//Handle database insert statement
function insertDB($data, $table){
	$bind = mt_rand(100,999).date('dmYHis').mt_rand(1000,9999);
	$column = 'bind, '; $param = ':bind, '; $datalist[':bind'] = $bind;
	foreach($data as $key => $value){
		$column .= $key.', ';
		$param .= ':'.$key.', ';
		$datalist[':'.$key] = $value;
	}
	$column = trimEdge($column, ',');
	$param = trimEdge($param, ',');
	
	global $db;
	$query = 'INSERT INTO '.$table.'('.$column.') VALUES('.$param.')';
	$statement = $db->prepare("$query");
	$execute = $statement->execute($datalist);
	if($execute){
		$result = $statement->rowCount();
		if($result == 1){return TRUE;}
		return FALSE;
	}
	else {return $statement->errorInfo()[2];}
}


//Handle database select statement
function selectDB($field, $table, $data, $return='boolean'){
	$param = ''; $datalist = array();
	foreach($data as $key => $value){
		$param .= $key.' = :'.$key.' AND ';
		$datalist[':'.$key] = $value;
	}
	$param = trimEdge($param, ' AND');

	global $db;
	$query = 'SELECT '.$field.' FROM '.$table.' WHERE '.$param;
	$statement = $db->prepare("$query");
	$execute = $statement->execute($datalist);
	if($execute){
		$result = $statement->rowCount();
		if($result != 0){
			if($return == 'boolean'){return TRUE;}
			elseif($result == 1){return $statement->fetch();}
			elseif($result > 1){return $statement->fetchAll();}
		}
		return FALSE;
	}
	else {return $statement->errorInfo()[2];}	
}


//Handle database query
function queryDB($query, $return='boolean'){
	global $db;
	$statement = $db->prepare($query);
	$execute = $statement->execute();

	if($execute){
		$result = $statement->rowCount();
		if($result != 0){
			if($return == 'boolean'){return TRUE;}
			else {return $statement->fetchAll(PDO::FETCH_ASSOC);}
		}
		return FALSE;
	}
	else {return $statement->errorInfo()[2];}
}

//************ END DATABASE OPERATION ************//
?>