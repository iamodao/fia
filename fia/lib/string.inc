<?php
class oString {
#RETURNS BOOLEAN ~ check for needle in string
	public static function in($string, $needle, $case="oSENSITIVE"){
		if($case == 'oSENSITIVE'){
			if(strpos($string, $needle) !== false){return true;}
		}
		else {
			if(stripos($string, $needle) !== false){return true;}
		}
		return false;
	}

	#SUBSTITUTE SPACE WITH CHARACTER|STRING AND VICE-VERSA
	public static function spaceTo($string, $value, $inv='oNOPE'){
		if($inv == 'oYEAH'){return str_replace($value, ' ', $string);}
		return preg_replace('/\s+/', $value, $string);
	}

	//-------------- Substitute a character|string in a string and vice-versa ---------------
	public static function swap($string, $search, $substitute , $occurence='oALL', $case="oSENSITIVE"){
		#check if $search is found and return result, else return full string
		$found = self::in($string, $search, $case);
		if(!$found){return $string;}
		else {
			if($occurence == 'oALL'){
				if($case == 'oSENSITIVE'){
					return str_replace($search, $substitute, $string);
				}
				else {
					return str_ireplace($search, $substitute, $string);
				}
			}
			else {
				if($occurence == 'oFIRST'){$pos = strpos($string, $search);}
				if($occurence == 'oLAST'){$pos = strrpos($string, $search);}

				if($pos !== false){
					return substr_replace($string, $substitute, $pos, strlen($search));
				}
				else {return $string;}
			}
		}
	}


	//-------------- Substitute censored word from a string (using library as DB) ---------------
	public static function censored($string, $library, $symbol = ', ', $case='oINSENSITIVE'){
		$o = $string;
		$words = explode(" ", $string);
		if(!is_array($library)){
			$library = explode($symbol, $library);
		}

		foreach ($words as $word){
			if(in_array(strtolower($word), array_map('strtolower', $library))){
				$o = self::swap($o, $word, '***' , 'oALL', $case);
			}
		}
		return $o;
	}


	//-------------- Return false OR value before first occurrence character|string if found ---------------
	public static function before($string, $search, $strip='oYEAH'){
		$pos = strpos($string, $search);
		if($pos && $pos != 0){$result = substr($string, 0, $pos);}
		if($strip != 'oYEAH'){$result = $result.$search;}
		if(isset($result)){return $result;}
		return false;
	}


	//-------------- Return false OR value after first character|string if found ---------------
	public static function after($string, $search, $strip='oYEAH'){
		$found = strstr($string, $search);
		if($found){
			$result = $found;
			if($strip == 'oYEAH'){
				$result = oString::swap($result, $search, '', 'oFIRST');
			}
		}
		if(!empty($result)){return $result;}
		return false;
	}


	public static function match($string='', $comparison='', $rule='oDEFAULT'){
		if($rule == 'oABSOLUTE' && $string === $comparison){return true;}
		elseif($rule != 'oABSOLUTE' && $string == $comparison){return true;}
		return false;
	}

	public static function to($o, $to){
		#Returns domain from URL
		if($to == 'oDOMAIN'){
			$o = oString::swap($o, 'https://', '', 'oFIRST');
			$o = oString::swap($o, 'http://', '', 'oFIRST');

			#Remove sub-directory if found
			if(self::in($o, '/')){
				$o = self::stringBefore($o, '/', 'oYEAH');
			}

			#Remove [known] sub-domain  TODO  ~ use library
			$subs = array('www','en', 'ng');
			$o_stripped = '';
			foreach ($subs as $sub){
				if(self::in($o, $sub)){
					$o = oString::swap($o, 'www.', '', 'oFIRST');
				}
			}
		}

		#Returns page title from string
		if($to == 'oTITLE'){
			$o = oString::swap($o, '-', ' ');
			$o = oString::swap($o, '_', ' ');
			$o = ucwords($o);
		}


		#Returns method-clean name from string
		if($to == 'oMETHOD'){
			$o = oString::swap($o, '-', ' ');
			$o = oString::swap($o, '_', ' ');
			$o = ucwords($o);
			$o = lcfirst($o);
			$o = self::spaceTo($o, '');
		}

		return $o;
	}
}
?>