<?php
class oCRUD {
	public static function create($field, $dataset, $table){
		#TODO ~ clean these steps to prevent multiple array creation & multiple foreach calls
		$input = oData::filter($field, $dataset);
		$param = oData::param($input, ':');
		$query = oSQL::insert($table, $input);
		return oSQL::run($query, $param, 'oBOOLEAN');
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