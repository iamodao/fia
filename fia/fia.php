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


	// initialization method (to initialize application)
	public static function init($data){
		if(!empty($data) && is_array($data)){
			#unset needless variables
			if(isset($data['FileInit'])){unset($data['FileInit']);}
			if(isset($data['FileConfig'])){unset($data['FileConfig']);}
			if(isset($data['FileCore'])){unset($data['FileCore']);}

			if(isset($data['isIn'])){self::$isIn = $data['isIn']; unset($data['isIn']);}
			if(isset($data['isCond'])){self::$isCond = $data['isCond']; unset($data['isCond']);}

			#impose SSL
			if(array_key_exists('imposeSSL', $data)){
				if($data['imposeSSL'] == 'oYeah'){
					self::imposeSSL();
					unset($data['imposeSSL']);
				}
			}

			#set project information properties
			$data = self::project($data);

			#set timezone
			if(array_key_exists('timezone', $data)){
				self::timezone($data['timezone']);
				if(!empty(self::$timezone)){unset($data['timezone']);}
			}

			#set database
			if(array_key_exists('database', $data)){
				self::database($data['database']);
				unset($data['database']);
			}

			#set directory
			$data = self::path($data, 'oSET');
		}
	}


	// check for secured URL and return boolean
	public static function https(){
		$o = false; $https = 'inactive'; $port = 'default';
		if(!empty($_SERVER['HTTPS'])){$https = $_SERVER['HTTPS'];}
		if($https !== 'inactive'){$https == 'active';}
		if(!empty($_SERVER['SERVER_PORT'])){$port = $_SERVER['SERVER_PORT'];}
		if($https == 'active' || $port == 443){$o = true;}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){$o = true;}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'){$o = true;}
		return $o;
	}


	// impose SSL on URL (it also starts session)
	public static function imposeSSL($link='', $permanent='oNope'){
		if(!headers_sent() && empty($_SESSION)){session_start();}
		if(empty($_SESSION['vImposeSSL']) || $_SESSION['vImposeSSL'] !== 'imposed'){
			$protocol = self::https() ? 'https' : 'http';
			if($protocol !== 'https'){
				$o = 'https://';
				if(!empty($link)){$o .= $link;}
				else {
					if(!empty($_SERVER['HTTP_HOST'])){$o .= $_SERVER['HTTP_HOST'];}
					if(!empty($_SERVER['REQUEST_URI'])){$o .= $_SERVER['REQUEST_URI'];}
				}
				if(filter_var($o, FILTER_VALIDATE_URL) !== false){
					$_SESSION['vImposeSSL'] = 'imposed';
					if($permanent == 'iYeah'){header('HTTP/1.1 301 Moved Permanently');}
					header('Location: ' . $o);
					exit;
				}
			}
		}
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

}
?>