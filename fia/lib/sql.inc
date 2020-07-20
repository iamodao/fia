<?php
class oSQL {
	public static function insert($table, $dataset, $option='oPREPARED'){
		$query = '';
		$query .= 'INSERT INTO `'.$table.'` (';
		$field = '';
		foreach ($dataset as $key => $value){
			$field .='`'.$key.'`, ';
		}
		$field = oString::swap($field, ',', '' , $occurence='oLAST');
		$query .= trim($field).') VALUES (';
		$param = '';
		if($option == 'oPREPARED'){
			foreach ($dataset as $key => $value){
				$param .=':'.$key.', ';
			}
			$param = oString::swap($param, ',', '' , $occurence='oLAST');
		}
		$query .= trim($param).');';
		return $query;
	}



	//=====::SQL UTILITY::=====//

	#RETURN ERROR RESPONSE FROM [QUERY STATEMENT OR LAST DATABASE OPERATION]
	public static function stmtF9($sql, $obj='', $i=2){
		$o['oSQL'] = $sql;
		#TODO ~ clean up error reporting

		#NOTE ~ we use DBO by default for object (thus returning error from last database operation)
		if(empty($obj) || $obj === false){$obj = fia::$dbo;}
		$e = $obj->errorInfo();
		if(!empty($e)){
			if($i == 'oALL'){$o['oERROR'] = $e;}
			elseif(is_numeric($i) && $i <3){$o['oERROR'] = $e[$i];}
		}

		if(empty($o['oERROR'])){$o['oERROR']= 'UNKNOWN';}
		return $o;
	}



	#RESOLVE QUERY STATEMENT AND RETURN RESPONSE
	public static function stmt($sql, $stmt){
		if($stmt === false){
			return self::stmtF9($sql, $stmt);
		}
		else {
			$o['oSQL'] = $sql;
			$o['oSUCCESS'] = 'oYEAH';
			if(is_int($stmt)){$o['oCOUNT'] = $stmt;}
			else {
				#TODO ~ a better check for query type
				$is_select = stripos($o['oSQL'], 'select');
				if($is_select !== false){
					$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if($fetch === false){$o['oRECORD'] = 'NO_FETCH';}
					else {
						$o['oCOUNT'] = count($fetch);
						if($o['oCOUNT'] > 1){$o['oRECORD'] = $fetch;}
						elseif($o['oCOUNT'] === 1){$o['oRECORD'] = $fetch[0];}
						elseif($o['oCOUNT'] === 0){$o['oRECORD'] = 'NO_RECORD';}
					}
				}
				else {
					$o['oCOUNT'] = $stmt->rowCount();
				}
			}
		}
		return $o;
	}



	#EXECUTES SQL QUERY & RETURNS RESPONSE
	public static function exec($sql){
		$selectInSQL = stripos($sql, 'select');
		if($selectInSQL !== false){
			exit('ERROR::Unacceptable <em>(Don\'t call <strong>exec()</strong> on SELECT statement</em>)');
		}
		$dbo = fia::$dbo;
		$stmt = $dbo->exec($sql);
		return self::stmt($sql, $stmt);
	}
	/**NOTE:
	 * Don't run SELECT statements on exec
	 * Don't pass user's input directly via SQL into exec
	 * It returns FALSE on failure, and ZERO(0) on success (when no rows affected), or the NUMBER of rows affected
	*/



	#RESET PRIMARY KEY
	public static function reset($table, $column='id'){
		// $sql = "SET @NewID = 0; ";
		// $sql .= "UPDATE `{$table}` SET `{$column}`=(@NewID := @NewID +1) ORDER BY `{$column}`; ";
		// $sql .= "SELECT MAX(`{$column}`) AS `IDMax` FROM `{$table}`; ";
		// $sql .= "ALTER TABLE `{$table}` AUTO_INCREMENT = [IDMax + 1]; ";
		$sql = 'ALTER TABLE `'.$table.'` DROP '.$column.';';
		$sql .= 'ALTER TABLE `'.$table.'` AUTO_INCREMENT = 1;';
		$sql .= 'ALTER TABLE `'.$table.'` ADD '.$column.' int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;';
		return self::run($sql);
	}



	#RUN SQL QUERY - NOTE ~ don't use with user INPUT, best for single case with result
	public static function query($sql){
		$dbo = fia::$dbo;
		$stmt = $dbo->query($sql);
		return self::stmt($sql, $stmt);
	}



	#RUN SQL USING PREPARED STATEMENT
	public static function run($sql, $i='', $return='oDEFAULT'){
		$dbo = fia::$dbo;
		$stmt = $dbo->prepare($sql);
		if(empty(($i))){
			$exec = $stmt->execute();
		}
		elseif(is_array($i)){
			$exec = $stmt->execute($i);
		}
		if($exec === false){
			return self::stmtF9($sql, $stmt);	#returns error as PDO [$dbo->errorInfo()]
		}
		$result = self::stmt($sql, $stmt);
		if($return == 'oBOOLEAN' && isset($result['oSUCCESS'])){return true;}
		elseif($return == 'oCOUNT' && isset($result['oCOUNT'])){return $result['oCOUNT'];}
		elseif($return == 'oRECORD' && isset($result['oRECORD'])){return $result['oRECORD'];}
		else {return $result;}
	}


	public static function isCount($sql, $column, $count=''){
		$o = self::run($sql, $column, 'oCOUNT');
		if($o != $count){return false;}
		return true;
	}







	#SQL CHECK FOR RESULT
	public static function isRecord($result='', $check=''){
		if($result != false && $result != 'NO_RECORD'){
			if(empty($check)){return true;}
			elseif(!empty($check) && is_array($result) && isset($result[$check])){return true;}
		}
		return false;
	}















}
?>