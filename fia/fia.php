<?php
class fia {
	private static $instance;

	public static $isIn;
	public static $isCond;

	public static $firm;
	public static $name;
	public static $brand;
	public static $acronym;
	public static $slogan;

	public static $baseURL;
	public static $domain;
	public static $email;
	public static $phone;
	public static $version;

	public static $timezone;
	public static $pathroot;
	public static $pathlib;
	public static $pathdrive;
	public static $pathcontent;

	protected static $database;


	private function __construct(){}


	private function __clone(){}


	public static function instantiate($o){
		if(is_null(self::$instance)){
			self::$instance = new self();
			self::init($o);
		}
		return self::$instance;
	}




	/**==== UTILITY ====**/
	// Dump data to screen for debugging
	public static function dump($data, $o='oPRE'){
		if($o == 'oDUMP'){return var_dump($data);}
		elseif($o == 'oPRINT'){return print_r($data);}
		elseif($o == 'oPRE'){echo '<pre><tt>'.var_export($data, true).'</tt></pre>';}
		elseif($o == 'oCLASSVAR'){self::dump(get_class_vars($data), 'oPRE');}
		elseif($o == 'oOBJVAR'){self::dump(get_object_vars($data), 'oPRE');}
	}
	/**==== ~UTILITY ====**/
}
?>