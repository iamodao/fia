<?php
class oCRUD {
	public static function create($field, $dataset, $table){
		#TODO ~ clean these steps to prevent multiple array creation & multiple foreach calls
		$input = oData::filter($field, $dataset);
		$param = oData::param($input, ':');
		$query = oSQL::insert($table, $input);
		return oSQL::run($query, $param, 'oBOOLEAN');
	}


	public static function read($table,  $filter='', $column='*', $limit=''){
		$query = "SELECT {$column} FROM `{$table}`";
		$param = '';
		if(!empty($filter)){
			$param = oData::param($filter, ':');
			$query .= ' WHERE ';
			foreach ($filter as $key => $value) {
				$query .= '`'.$key.'` = :'.$key.' AND';
			}
		}
		$query = oString::swap($query, ' AND', '' , $occurence='oLAST');
		if(!empty($limit)){$query .= ' LIMIT '.$limit;}
		return oSQL::run($query, $param, 'oRECORD');
	}


	public static function updateBIND($input, $table){
		$query = 'UPDATE `'.$table.'` SET ';
		foreach ($input as $key => $value){
			if($key != 'bind'){
				$query .= '`'.$key.'` = :'.$key.', ';
			}
		}
		$query = oString::swap($query, ',', '' , $occurence='oLAST');
		$query .=' WHERE `bind` = :bind LIMIT 1';
		return oSQL::run($query, $input, 'oBOOLEAN');
	}


	public static function deleteBIND($input, $table){
		$query = 'DELETE FROM `'.$table.'` WHERE `bind` = :bind LIMIT 1';
		return oSQL::run($query, $input, 'oBOOLEAN');
		#return oSQL::isCount($query, $input, 1);
	}


	public static function exist($column, $value, $table){
		$input[$column] = $value;
		$param = oData::param($input, ':');
		$query = 'SELECT `'.$column.'` FROM `'.$table."` WHERE `".$column."` = :".$column;
		return oSQL::run($query, $param, 'oCOUNT');
	}


	public static function bindID(){
		return mt_rand(100,999).time().mt_rand(10,99);
	}
}
?>
