<?php
/**=====::DATA UTILITY::=====**/
class oData {
	#CAPTURE DATA (POST/GET/REQUEST/SESSION/any), FILTER RELEVANT INFO AND RETURN CLEANED
	public static function capture($i='oPOST', $filter=''){
		if(!empty($i)){
			if($i == 'oGET' && !empty($_GET)){$v = $_GET;}
			elseif($i == 'oPOST' && !empty($_POST)){$v = $_POST;}
			elseif($i == 'oREQUEST' && !empty($_REQUEST)){$v = $_REQUEST;}
			elseif($i == 'oSESSION' && !empty($_SESSION)){$v = $_SESSION;}
			elseif(!empty($i)){$v = $i;}

			if(!empty($filter) && !empty($v)){
				if(is_array($filter) && is_array($v)){
					$o = array();
					foreach ($filter as $index){
						if(!empty($v[$index])){$o[$index] = self::inputClean($v[$index]);}
						elseif(isset($v[$index])){$o[$index] = '';}
					}
				}
				elseif(!is_array($filter) && is_array($v)){
					if(!empty($v[$filter])){$o[$filter] = self::inputClean($v[$filter]);}
					elseif(isset($v[$filter])){$o[$filter] = '';}
				}
				elseif(is_array($filter) && !is_array($v) && in_array($v, $filter)){
					$o = self::inputClean($v);
				}
				elseif(!is_array($filter) && !is_array($v) && ($v == $filter)){
					$o = self::inputClean($v);
				}
			}
		}

		if(!empty($o)){
			#Remove main uri [oapi & olink] for array if it exists
			if(isset($o['oapi'])){unset($o['oapi']);}
			if(isset($o['olink'])){unset($o['olink']);}
			return $o;
		}
		return false;
	}



	#READ RECORD FROM DATA ARRAY - and return value
	public static function record($data, $record){
		if(!empty($data) && !empty($record)){
			if($data == 'oGET' || $data == 'oPOST' || $data == 'oREQUEST'  || $data == 'oSESSION'){
				$data = self::capture($data, $record);
				return self::record($data, $record);
			}
			elseif(is_array($data)){
				if(!is_array($record) && !empty($data[$record])){
					return $data[$record];
				}
				elseif(!is_array($record) && isset($data[$record])){
					return '';
				}
				elseif(is_array($record)){
					foreach ($record as $index){
						if(!empty($data[$index])){$o[$index] = $data[$index];}
						else {$o[$index] = '';}
					}
					return $o;
				}
			}
		}
		return false;
	}


	public static function bindSQL($field, $dataset ='oPOST', $symbol=':'){
		$data = self::record($dataset, $field);
		return oSQL::bindparam($data, $symbol);
	}
}
?>