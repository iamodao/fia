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










	/**==== REDIRECT UTILITY ====**/

	#URL REDIRECT ~ using meta
	public static function redirectMeta($url, $delay=0, $exit='oNOPE'){
		$o = '<meta http-equiv="refresh" content="'.$delay.'; url='.$url.'">';
		if($exit == 'oYEAH'){exit($o);}
		else {return $o;}
	}


	public static function redirect($url, $delay=0, $exit='oNOPE'){
		if($url == 'index'){$url = self::$url;}
		#TODO ~ check if url has http so as not to include base URL
		else {
			$url = self::$url.DS.$url;
		}

		if(!headers_sent($filename, $linenum)){
			if(!empty($delay)){header('Refresh:'.$delay.';url='.$url);}
			else {header('Location: '.$url);}
			if($exit != 'oNOPE'){exit();}
		}
		else {
			#use meta redirect (Headers already sent in $filename on line $linenum)
			return self::redirectMeta($url, $delay, $exit);
		}
	}

	public static function exitTo($url){
		return self::redirect($url, 0, 'oYEAH');
	}










	/**==== INPUT UTILITY ====**/

	#CLEAN INPUT ~ returns clean string/array
	public static function cleanInput($input){
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
		}
		else {
			$o = array();
			foreach ($input as $key => $value){
				$clean = preg_replace($search, '', $value);
				$clean = strip_tags($clean);
				$o[$key] = $clean;
			}
		}
		return trim($o);
	}









	/**==== ROUTING UTILITY ====**/

	#CLEAN ROUTE VALUE
	public static function cleanRoute($i){
		$o = strtolower($i);
		$o = self::cleanInput($o);
		return trim($o);
	}


	#GET & PREPARE ROUTE ~ from URI or input
	public static function oroute($type='oAPP', $i='oGET'){
		if($i == 'oGET'){
			if($type == 'oAPI'){
				if(isset($_GET['oapi'])){$v = $_GET['oapi'];}
				else {return false;}
			}
			elseif($type == 'oAPP'){
				if(isset($_GET['olink'])){$v = $_GET['olink'];}
				else {$v = 'index';}
			}
		}
		elseif(!empty($i)){$v = $i;}

		if(!empty($v)){
			return self::cleanRoute($v);
		}
		return false;
	}


	#ROUTER ~ handles primary controller
	public static function orouter($i='oAUTO'){

		#If redirect is detected from URI
		if(!empty($_GET['oredirect'])){
			$goto = self::cleanRoute($_GET['oredirect']);
			self::exitTo($goto);
		}

		#To be certain module directory is set
		elseif(!empty(self::$path['module'])){

			#Prepare value for $i when it is set to default or empty
			if($i == 'oDEFAULT' || empty($i)){
				if(!empty(self::$routing)){$i = self::$routing;}
				else {$i = 'oAUTO';}
			}

			#SITE
			if($i == 'oSITE'){
				$o['oFile'] = self::$path['module'].'site.php';
				if(!file_exists($o['oFile'])){oExit('site','missing controller file',$o['oFile']);}
				require $o['oFile'];
			}

			#APP ~ when api call on URI doesn't exists
			elseif(!self::oroute('oAPI')){
				$o['oRouter'] = 'oAPP';
				$o['oRoute'] = self::oroute('oAPP');
				$o['oFile'] = self::$path['module'].'app'.DS.$o['oRoute'].'.php';
				if(!file_exists($o['oFile'])){
					$o['oFile'] = self::$path['module'].'app.php';
					if(!file_exists($o['oFile'])){oExit('app','missing controller file', $o['oFile']);}
					#For when $i is set to auto & app.php is used as default app controller file
					elseif($i == 'oAUTO'){
						require $o['oFile'];
						if(!class_exists('oAPP') || !method_exists('oAPP', $o['oRoute'])){oExit('app', '['.$o['oRoute'].'] controller required', $o['oFile']);}
					}
				}

				#For when $i is set to get ~ returns $i value;
				if($i == 'oGET' && !empty($o)){return $o;}
			}


			#API ~ when api call exists on URI
			else {
				$o['oRouter'] = 'oAPI';
				$o['oRoute'] = self::oroute('oAPI');
				$o['oFile'] = self::$path['module'].'api'.DS.$o['oRoute'].'.php';
				if(!file_exists($o['oFile'])){
					$o['oFile'] = self::$path['module'].'api.php';
					if(!file_exists($o['oFile'])){oExit('api','missing controller file', $o['oFile']);}
					#For when $i is set to auto & api.php is used as default api controller file
					elseif($i == 'oAUTO'){
						require $o['oFile'];
						if(!class_exists('oAPI') || !method_exists('oAPI', $o['oRoute'])){oExit('api', '['.$o['oRoute'].'] controller required', $o['oFile']);}
					}
				}

				#For when $i is set to get ~ returns $i value;
				if($i == 'oGET' && !empty($o)){return $o;}
			}
		}
		else {oExit('FIA', 'path undefined', 'module path not set as property of fia class');}
	}
/**
 * NOTE:
 * Redirect takes precedence over everything else
 * Site takes precedence next, when set
 * App takes precedence next, if API call not found in URI (/api/*)
 * Api is next, if API call is found
 *
 * API or APP class & route method will be called automatically only when $i (project routing) is set to oAUTO and the default controller is used
 */



}
?>