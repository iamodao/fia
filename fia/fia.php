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
	public static function init($o){
		if(!empty($o) && is_array($o)){
			#unset needless variables
			if(isset($o['FileInit'])){unset($o['FileInit']);}
			if(isset($o['FileConfig'])){unset($o['FileConfig']);}
			if(isset($o['FileCore'])){unset($o['FileCore']);}

			if(isset($o['isIn'])){self::$isIn = $o['isIn']; unset($o['isIn']);}
			if(isset($o['isCond'])){self::$isCond = $o['isCond']; unset($o['isCond']);}

			#impose SSL
			if(array_key_exists('imposeSSL', $o)){
				if($o['imposeSSL'] == 'oYeah'){
					self::imposeSSL();
					unset($o['imposeSSL']);
				}
			}

			#set project information properties
			$o = self::project($o);

			#set timezone
			if(array_key_exists('timezone', $o)){
				self::timezone($o['timezone']);
				if(!empty(self::$timezone)){unset($o['timezone']);}
			}

			#set database
			if(array_key_exists('database', $o)){
				self::database($o['database']);
				unset($o['database']);
			}

			#set directory
			$o = self::path($o, 'oSET');
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

	// set project information as object properties
	private static function project($o){
		if(isset($o['project']) && !empty($o['project']) && is_array($o['project'])){
			$project = $o['project'];
			foreach ($project as $key => $value){
				if(property_exists(__CLASS__, $key) && !empty($value)){
					self::${$key} = $value;
					unset($project[$key]);
				}
				elseif($key == 'baseURL' && empty($value)){
					self::baseURL();
					unset($project['baseURL']);
				}
				elseif($key == 'domain' && empty($value)){
					self::domain();
					unset($project['domain']);
				}
			}
			unset($o['project']);
			if(!empty($project)){$o['project'] = $project;}
		}
		return $o;
	}


	// set timezone and assign value to class property
	private static function timezone($o='oFIA'){
		if($o == 'oFIA' || empty($o)){$o = 'Africa/Lagos';}
		$timezone = date_default_timezone_set($o);
		if($timezone !== false){self::$timezone = $o;}
	}




	/**==== DATABASE ====**/

	// create database connection and set property to database object
	private static function database($o, $extension='oPDO'){
		if(!empty($o) && is_array($o)){

			#using PDO connection
			if($extension == 'oPDO'){
				try {
					$pdo = new PDO('mysql:dbname='.$o['name'].';host='.$o['host'], $o['user'], $o['password']);
				} catch (PDOException $e) {
					exit('Connection error: '.$e->getMessage());
				}
				self::$database = $pdo;
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