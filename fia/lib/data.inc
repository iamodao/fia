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
						if(!empty($v[$index])){$o[$index] = oInput::clean($v[$index]);}
						elseif(isset($v[$index])){$o[$index] = '';}
					}
				}
				elseif(!is_array($filter) && is_array($v)){
					if(!empty($v[$filter])){$o[$filter] = oInput::clean($v[$filter]);}
					elseif(isset($v[$filter])){$o[$filter] = '';}
				}
				elseif(is_array($filter) && !is_array($v) && in_array($v, $filter)){
					$o = oInput::clean($v);
				}
				elseif(!is_array($filter) && !is_array($v) && ($v == $filter)){
					$o = oInput::clean($v);
				}
			}
			elseif(!empty($v)){
				$o = $v;
				if(is_array($o)){
					$clean = array();
					foreach ($o as $key => $value){
						$clean[$key] = oInput::clean($value);
					}
					$o = $clean;
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



	#FILTER RECORD FROM DATA ARRAY - and return value
	public static function filter($field, $dataset){
		if(!empty($dataset) && !empty($field)){
			if($dataset == 'oGET' || $dataset == 'oPOST' || $dataset == 'oREQUEST'  || $dataset == 'oSESSION'){
				$dataset = self::capture($dataset, $field);
				return self::filter($dataset, $field);
			}
			elseif(is_array($dataset)){
				if(!is_array($field) && !empty($dataset[$field])){
					return $dataset[$field];
				}
				elseif(!is_array($field) && isset($dataset[$field])){
					return '';
				}
				elseif(is_array($field)){
					foreach ($field as $index){
						if(!empty($dataset[$index])){$o[$index] = $dataset[$index];}
						else {$o[$index] = '';}
					}
					return $o;
				}
			}
		}
		return false;
	}


	#BIND on array ~ great for SQL bind parameters
	public static function param($data, $symbol=':'){
		if(is_array($data)){
			$o = array();
			foreach ($data as $key => $value){
				$o[$symbol.$key] = $value;
			}
			return $o;
		}
	}


	public static function filter_param($field, $dataset ='oPOST', $symbol=':'){
		$data = self::filter($field, $dataset);
		return self::param($data, $symbol);
	}
}
?>