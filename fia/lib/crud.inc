<?php
class oCRUD {
	public static function create($field, $dataset, $table){
		#TODO ~ clean these steps to prevent multiple array creation & multiple foreach calls
		$input = oData::filter($field, $dataset);
		$param = oData::param($input, ':');
		$query = oSQL::statement('oINSERT', 'user', $input);
		return oSQL::run($query, $param, 'oBOOLEAN');
	}

}
?>