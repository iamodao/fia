<?php
class format {
	/**==== FORMAT ====**/

	// return formatted numbers
	public static function number($input, $digit=2){
		if(is_numeric($input)){
			$o = $input;
			if(!empty($digit) && is_numeric($digit)){$o = number_format($input, $digit);}
			else {$o = number_format($input);}
			return $o;
		}
		return false;
	}

	// return formatted size (computer-based measurement)
	public static function size($byte){
		if(!empty($byte)){
			if($byte>=1073741824){$o = number_format($byte / 1073741824 , 2) . 'GB';}
			elseif($byte>=1048576){$o = number_format($byte / 1048576 , 2) . 'MB';}
			elseif($byte>=1024){$o = number_format($byte / 1024 , 2) . 'KB';}
			elseif($byte>1){$o = $byte . ' bytes';}
			elseif($byte==1){$o = $byte . ' byte';}
			else {$o = '0';}
			return $o;
		}
		return false;
	}

}
?>