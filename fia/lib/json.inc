<?php
/**=====::JSON UTILITY::=====**/
class oJSON {
	#JSON ERROR INTERPRETER
	public static function error($e, $i=''){
		$o['JSON_INPUT'] = $i; $o['JSON_ERROR'] = $e;
		if($e == 4){$o['JSON_ERROR_MSG'] = 'Syntax error';}
		elseif($e == 5){$o['JSON_ERROR_MSG'] = 'Malformed UTF-8 characters, possibly incorrectly encoded';}
		if(!empty($o)){return $o;}
	}

	#PERFORM JSON OPERATIONS (encode, decode & print)
	public static function run($input, $i='oENCODE'){
		if(!empty($input)){
			if($i == 'oENCODE'){$o = json_encode($input);}
			elseif($i == 'oDECODE'){$o = json_decode($input);}
			$e = json_last_error();
			if(!empty($e)){return self::error($e, $input);}
			elseif($i == 'oENCODE' || $i == 'oDECODE'){return $o;}
			elseif($i == 'oPRINT'){
				header('Content-Type: application/json');
				echo json_encode($input, JSON_PRETTY_PRINT);
				exit;
			}
		}
		return;
	}

	public static function encode($input){
		return self::run($input, $i='oENCODE');
	}

	public static function decode($input){
		return self::run($input, $i='oDECODE');
	}

	public static function display($input){
		return self::run($input, $i='oPRINT');
	}
}
?>