<?php
/**
 * FIA™ framework ~ a micro framework for website, application and API development with PHP & MySQL; © 2020 VERI8™, Inc.
 * =====================================================================================================================
 **/
class fia {

	#DEFINE PROPERTIES
	private static $instance;

	public static $timezone;
	public static $firm;
	public static $name;
	public static $brand;
	public static $acronym;
	public static $slogan;
	public static $domain;
	public static $url;
	public static $email;
	public static $phone;
	public static $version;
	public static $routing;
	public static $dbo;
	public static $path;
	public static $machine;


	#PREVENT MULTIPLE INSTANCE
	private function __construct(){}


	#PREVENT DUPLICATE INSTANCE
	private function __clone(){}


	#INSTANTIATE ~ return instance of static class
	public static function instantiate($o){
		if(is_null(self::$instance)){
			self::$instance = new self();
			self::initialize($o);
		}
		return self::$instance;
	}


	#RETURNS BOOLEAN ON HTTPS CHECK
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


	#IMPOSE SSL on URL ~  also starts session
	public static function imposeSSL($url='', $move='oNOPE'){
		if(headers_sent() === false && !isset($_SESSION)){session_start();}
		if(empty($_SESSION['oSSL']) || $_SESSION['oSSL'] !== 'imposed'){
			$protocol = self::https() ? 'https' : 'http';
			if($protocol !== 'https'){
				$o = 'https://';
				if(!empty($url)){$o .= $url;}
				else {
					if(!empty($_SERVER['HTTP_HOST'])){$o .= $_SERVER['HTTP_HOST'];}
					if(!empty($_SERVER['REQUEST_URI'])){$o .= $_SERVER['REQUEST_URI'];}
				}
				if(filter_var($o, FILTER_VALIDATE_URL) !== false){
					$_SESSION['oSSL'] = 'imposed';
					if($move == 'oYEAH'){header('HTTP/1.1 301 Moved Permanently');}
					header('Location: ' . $o);
					exit;
				}
			}
		}
	}


	#SET TIMEZONE & RETURN BOOLEAN
	public static function timezone($i='oFIA'){
		if($i == 'oFIA' || empty($i)){$i = 'Africa/Lagos';}
		$o = date_default_timezone_set($i);
		return $o;
	}


	#SET BASE DOMAIN & ASSIGN TO PROPERTY
	protected static function domain(){
	}


	#SET BASE URL & ASSIGN TO PROPERTY
	protected static function url(){
	}


	#SET PROJECT INFORMATION AS OBJECT PROPERTIES
	private static function project($o){
		if(isset($o['oPROJECT']) && !empty($o['oPROJECT']) && is_array($o['oPROJECT'])){
			$project = $o['oPROJECT'];
			foreach ($project as $key => $value){
				if(property_exists(__CLASS__, $key) && !empty($value)){
					self::${$key} = $value;
					unset($project[$key]);
				}
				elseif($key == 'domain' && empty($value)){
					self::domain();
					unset($project['domain']);
				}
				elseif($key == 'url' && empty($value)){
					self::url();
					unset($project['url']);
				}
			}
			unset($o['oPROJECT']);
			if(!empty($project)){$o['oPROJECT'] = $project;}
		}
		return $o;
	}


	#SET PATH TO DIRECTORIES
	private static function path($o=''){
		if(array_key_exists('DIR_ROOT', $o) && !empty($o['DIR_ROOT'])){
			self::$path['root'] = $o['DIR_ROOT'].DS;
			unset($o['DIR_ROOT']);
		}
		if(array_key_exists('DIR_FIA', $o) && !empty($o['DIR_FIA'])){
			self::$path['fia'] = $o['DIR_FIA'].DS;
			unset($o['DIR_FIA']);
		}
		if(array_key_exists('DIR_SOURCE', $o) && !empty($o['DIR_SOURCE'])){
			self::$path['source'] = $o['DIR_SOURCE'].DS;
			unset($o['DIR_SOURCE']);
		}
		if(!empty($o['path'])){
			$path = $o['path'];
			if(!empty($path['module'])){
				self::$path['module'] = $path['module'].DS;
				unset($path['module']);
			}
			if(!empty($path['layout'])){
				self::$path['layout'] = $path['layout'].DS;
				unset($path['layout']);
			}
			if(!empty($path['drive'])){
				self::$path['drive'] = $path['drive'].DS;
				unset($path['drive']);
			}
			$o['path'] = $path;
			if(empty($o['path'])){unset($o['path']);  }
		}
		return $o;
	}


	#GET PATH
	public static function pathTo($i='', $prefix=''){
		if(isset(self::$path[$i])){return self::$path[$i];}
		else {
			#TODO ~ improve path to method
			$o = 'asset'.PS;
			if($i == 'JS'){$o .= 'js';}
			elseif($i == 'CSS'){$o .= 'css';}
			elseif($i == 'IMG'){$o .= 'image';}
			elseif($i == 'MEDIA'){$o .= 'media';}
			if(!empty($o) && $i != 'ASSET'){return $o.PS;}
			else {return $o;}
		}
	}


	#INITIALIZATION ~ to initialize application
	public static function initialize($o){
		if(!empty($o) && is_array($o)){

			#Enforce https
			if(array_key_exists('https', $o) && $o['https'] == 'impose'){
				self::imposeSSL();
				unset($o['https']);
			}

			#check status & respond (-set error_reporting)
			if(!empty($o['status'])){
				if($o['status'] != 'oLIVE'){oExit('project', 'offline!', 'Sorry, this project is offline at the moment');}
				unset($o['status']);
			}

			#Set machine & TODO -set error_reporting
			if(!empty($o['machine'])){
				self::$machine = $o['machine'];
				unset($o['machine']);
			}


			#Set timezone
			if(array_key_exists('timezone', $o)){
				$timezone = self::timezone($o['timezone']);
				if($timezone !== false){self::$timezone = $o['timezone'];}
				if(!empty(self::$timezone)){unset($o['timezone']);}
			}
			if(empty(self::$timezone)){
				self::$timezone = 'Africa/Lagos';
				self::timezone(self::$timezone);
			}

			#Set project information
			$o = self::project($o);

			#set database
			if(array_key_exists('oDATABASE', $o)){
				self::database($o['oDATABASE']);
				unset($o['oDATABASE']);
			}

			#Set path
			$o = self::path($o);
		}
	}










	/**==== DATABASE UTILITY ====**/

	#CREATE DATABASE CONNECTION AND SET DATABASE OBJECT PROPERTY
	protected static function database($o, $extension='oPDO'){
		if(!empty($o) && is_array($o)){

			#using PDO connection
			if($extension == 'oPDO'){
				try {
					$pdo = new PDO('mysql:dbname='.$o['name'].';host='.$o['host'], $o['user'], $o['password']);
				} catch (PDOException $e){
					oExit('DB', 'connection error', $e->getMessage());
				}
				self::$dbo = $pdo;
			}
		}
	}










	/**==== ROUTING UTILITY ====**/


}
?>