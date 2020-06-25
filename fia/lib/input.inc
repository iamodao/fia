<?php
/**=====::INPUT UTILITY::=====**/
class oInput {
	#CLEAN INPUT ~ returns clean string/array
	public static function clean($input){
		#strip out JS, HTML, CSS & multi-line comments
		$search = array(
			'@<script[^>]*?>.*?</script>@si',
			'@<[\/\!]*?[^<>]*?>@si',
			'@<style[^>]*?>.*?</style>@siU',
			'@<![\s\S]*?--[ \t\n\r]*>@'
		);
		if(!is_array($input)){
			$o = '';
			$o = preg_replace($search, '', $input);
			$o = strip_tags($o);
			$o = trim($o);
		}
		else {
			$o = array();
			foreach ($input as $key => $value){
				$clean = preg_replace($search, '', $value);
				$clean = strip_tags($clean);
				$o[$key] = trim($clean);
			}
		}
		return $o;
	}
}
?>