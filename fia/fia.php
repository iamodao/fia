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
	public static $pathmodule;
	public static $pathcontent;

	protected static $dbo; #database object


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
		if(headers_sent() === false && !isset($_SESSION)){session_start();}
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


	private static function baseURL(){
	}


	private static function domain(){
	}


	// set (from config) & get default directory paths
	public static function path($o='', $task='oGET'){
		#set paths
		if($task == 'oSET'){
			if(array_key_exists('RD', $o) && !empty($o['RD'])){
				self::$pathroot = $o['RD'].DS;
				unset($o['RD']);
			}
			if(array_key_exists('FD', $o) && !empty($o['FD'])){
				self::$pathlib = $o['FD'].DS;
				unset($o['FD']);
			}
			if(array_key_exists('CD', $o) && !empty($o['CD'])){
				self::$pathcontent = $o['CD'].DS;
				unset($o['CD']);
			}
			if(array_key_exists('moduleDir', $o) && !empty($o['moduleDir'])){
				self::$pathmodule = $o['moduleDir'].DS;
				unset($o['moduleDir']);
			}
			if(array_key_exists('drive', $o) && !empty($o['drive'])){
				self::$pathdrive = $o['drive'].DS;
				unset($o['drive']);
			}

			return $o;
		}

		#get paths
		if($task == 'oGET'){
			if(isset(self::${$o})){return self::${$o};}
			else {
				$path = PS;
				if($o=='CSS' || $o=='JS' || $o=='IMG' || $o=='MEDIA'){$path .= 'asset'.PS;}
				return $path;
			}
		}
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
				self::$dbo = $pdo;
			}
		}
	}


	// return database object
	public static function dbo(){
		if(!empty(self::$dbo)){return self::$dbo;}
		return false;
	}










	/**==== SQL ====**/

	// execute SQL and return response (use only when no user input & no fetching required)
	# NOTE: returns FALSE on failure, and ZERO(0) on success when no rows affected or the NUMBER of rows affected


	// return error response from [query statement or last database operation]
	public static function stmtF9($sql, $obj='', $i=2){
		$o['oSQL'] = $sql;
		# TODO ~ clean up error reporting

		#NOTE ~ we use DBO by default for object (thus returning error from last database operation)
		if(empty($obj) || $obj === false){$obj = self::$dbo;}
		$e = $obj->errorInfo();
		if(!empty($e)){
			if($i == 'oALL'){$o['oERROR'] = $e;}
			elseif(is_numeric($i) && $i <3){$o['oERROR'] = $e[$i];}
		}

		if(empty($o['oERROR'])){$o['oERROR']= 'UNKNOWN';}
		return $o;
	}



	// resolve query statement and return response
	public static function stmt($sql, $stmt){
		if($stmt === false){
			return self::stmtF9($sql, $stmt);
		}
		else {
			$o['oSQL'] = $sql;
			$o['oSUCCESS'] = 'oYeah';
			if(is_int($stmt)){$o['oCOUNT'] = $stmt;}
			else {
				# TODO ~ a better check for query type
				$is_select = stripos($o['oSQL'], 'select');
				if($is_select !== false){
					$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if($fetch === false){$o['oRECORD'] = 'NO_FETCH';}
					else {
						$o['oCOUNT'] = count($fetch);
						if($o['oCOUNT'] > 1){$o['oRECORD'] = $fetch;}
						elseif($o['oCOUNT'] === 1){$o['oRECORD'] = $fetch[0];}
						elseif($o['oCOUNT'] === 0){$o['oRECORD'] = 'NO_RECORD';}
					}
				}
				else {
					$o['oCOUNT'] = $stmt->rowCount();
				}
			}
		}
		return $o;
	}


	// NOTE ~ don't use for SELECT statement, and don't use with user INPUT
	public static function execSQL($sql){
		$selectInSQL = stripos($sql, 'select');
		if($selectInSQL !== false){
			exit('ERROR::Unacceptable <em>(Don\'t call <strong>execSQL()</strong> on SELECT statement</em>)');
		}
		$dbo = self::$dbo;
		$stmt = $dbo->exec($sql);
		return self::stmt($sql, $stmt);
	}


	// reset primary key
	public static function resetSQL($table, $column){
		$sql = "SET @NewID = 0; ";
		$sql .= "UPDATE `{$table}` SET `{$column}`=(@NewID := @NewID +1) ORDER BY `{$column}`; ";
		$sql .= "SELECT MAX(`{$column}`) AS `IDMax` FROM `{$table}`; ";
		$sql .= "ALTER TABLE `{$table}` AUTO_INCREMENT = [IDMax + 1]; ";
		return self::execSQL($sql);
	}


	// NOTE ~ don't use with user INPUT, best for single case with result
	public static function querySQL($sql){
		$dbo = self::$dbo;
		$stmt = $dbo->query($sql);
		return self::stmt($sql, $stmt);
	}


	// run SQL in prepared statement
	public static function runSQL($sql, $i=''){
		$dbo = self::$dbo;
		$stmt = $dbo->prepare($sql);
		if(empty(($i))){$exec = $stmt->execute();} elseif(is_array($i)){$exec = $stmt->execute($i);}
		if($exec === false){
			return self::stmtF9($sql, $stmt);	#return error as PDO [$dbo->errorInfo()]
		}
		return self::stmt($sql, $stmt);
	}

















	/**==== ROUTING ====**/

	public static function cleanRoute($i){
		$o = strtolower($i);
		$o = self::cleanInput($o);
		return trim($o);
	}

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



	// router - checks current URI & calls appropriate controller NOTE ~ use for app & api, not site
	public static function orouter($i='oAUTO'){
		if(!empty($_GET['oredirect'])){
			$goto = self::cleanRoute($_GET['oredirect']);
			self::exitTo($goto);
		}
		elseif(!empty(self::$pathmodule)){
			if($i == 'oSITE'){ #for SITE
				$o['oFile'] = self::$pathmodule.'site.php';
				if(!file_exists($o['oFile'])){exit('SITE::Missing [Controller File Required]');}
				require $o['oFile'];
			}
			elseif(!self::oroute('oAPI')){ #for APP
				$o['oRouter'] = 'oAPP';
				$o['oRoute'] = self::oroute('oAPP');
				$o['oFile'] = self::$pathmodule.'app'.DS.$o['oRoute'].'.php';
				if(!file_exists($o['oFile'])){
					$o['oFile'] = self::$pathmodule.'app.php';
					if(!file_exists($o['oFile'])){exit('APP::Missing [Controller File Required]');}
				}

				if($i == 'oAUTO'){
					require $o['oFile'];
					if(!class_exists('oAPP') || !method_exists('oAPP', $o['oRoute'])){exit('APP::<strong><em>'.$o['oRoute'].'</em></strong> [Controller Required]');}
				}
				elseif($i == 'oGET'){return $o;}
			}
			else { #for API
				$o['oRouter'] = 'oAPI';
				$o['oRoute'] = self::oroute('oAPI');
				$o['oFile'] = self::$pathmodule.'api'.DS.$o['oRoute'].'.php';
				if(!file_exists($o['oFile'])){
					$o['oFile'] = self::$pathmodule.'api.php';
					if(!file_exists($o['oFile'])){exit('API::Missing [Controller File Required]');}
				}

				if($i == 'oAUTO'){
					require $o['oFile'];
					if(!class_exists('oAPI') || !method_exists('oAPI', $o['oRoute'])){exit('API::<strong><em>'.$o['oRoute'].'</em></strong> [Controller Required]');}
				}
				elseif($i == 'oGET'){return $o;}
			}
		}
	}











	/**==== lOADER ====**/

	public static function oprepare($i='oGET', $path='oVIEW'){
		$v = self::orouter('oGET');
		if(isset($v['oRouter'])){
			$router = $v['oRouter'];
			if($i !== 'oGET'){$route = $i;} else {$route = $v['oRoute'];}

			if($router == 'oAPI' || $path == 'oAPI'){$o = self::$pathmodule.'api'.DS.$route;}
			elseif($path == 'oAPP'){$o = self::$pathmodule.'app'.DS.$route;}
			elseif($path == 'oSITE'){$o = self::$pathmodule.'layout'.DS.'site'.DS.$route;}
			elseif($path == 'oBIT'){$o = self::$pathcontent.'layout'.DS.'bit'.DS.$route;}
			elseif($path == 'oTHEME'){$o = self::$pathcontent.'layout'.DS.'skin'.DS.$route;}
			elseif($path == 'oVIEW'){$o = self::$pathcontent.'layout'.DS.'view'.DS.$route;}

			if(!empty($o)){return $o.'.php';}
		}
	}


	public static function oload($i='oGET', $path='oVIEW'){
		$o = self::oprepare($i, $path);
		if(file_exists($o)){require $o; return;}
		exit('PATH: Unavailable '.$path.' [<em>'.$o.'</em>]');
	}










	/**==== URL ====**/

	// return URL referrer
	public static function refURL(){
		if(!empty($_SERVER['HTTP_REFERER'])){return $_SERVER['HTTP_REFERER'];}
		return false;
	}












	/**==== REDIRECT ====**/

	// URL redirect meta
	public static function redirectMeta($url, $delay=0, $exit='oNope'){
		$o = '<meta http-equiv="refresh" content="'.$delay.'; url='.$url.'">';
		if($exit == 'oYeah'){exit($o);}
		else {return $o;}
	}


	public static function redirect($url, $delay=0, $exit='oNope'){
		if($url == 'index'){$url = self::$baseURL;}
		#TODO ~ check if url has http so as not to include baseURL
		else {
			$url = self::$baseURL.DS.$url;
		}

		if(!headers_sent($filename, $linenum)){
			if(!empty($delay)){header('Refresh:'.$delay.';url='.$url);}
			else {header('Location: '.$url);}
			if($exit != 'oNope'){exit();}
		}
		else {
			#use meta redirect (Headers already sent in $filename on line $linenum)
			return self::redirectMeta($url, $delay, $exit);
		}
	}

	public static function exitTo($url){
		return self::redirect($url, 0, 'oYeah');
	}










	/**==== DIRECTORY ====**/

	// check if path is a directory & returns true or false
	public static function isDir($path){
		if(is_dir($path)){return true;}
		return false;
	}









	/**==== FILE ====**/

	// check if path is a file & returns true or false
	public static function isFile($path){
		if(self::isDir($path)){return false;}
		elseif(is_file($path) === false){return false;}
		return true;
	}

	// returns file information
	public static function infoFile($i='oData', $file='oSelf'){
		if($file == 'oSelf'){$file = $_SERVER['PHP_SELF'];}
		$path = pathinfo($file);
		if($i == 'oDir' && !empty($path['dirname'])){$o = $path['dirname'];}
		elseif($i == 'oBase' && !empty($path['basename'])){$o = $path['basename'];}
		elseif($i == 'oExt' && !empty($path['extension'])){$o = $path['extension'];}
		elseif($i == 'oName' && !empty($path['filename'])){$o = $path['filename'];}
		elseif($i == 'oData'){$o = $path;}
		if(!empty($i)){return $o;}
		return false;
	}

	// download file information
	public static function downloadFile($file, $save=''){
		if(self::isFile($file)){
			$name = self::infoFile('oName', $file);
			$ext = self::infoFile('oExt', $file);
			#TODO ~ naming convention
			if(empty($save)){$save = $name.'_'.mt_rand();}
			$save = $save.'.'.$ext;
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename ="'.$save.'"');
			readfile($file);
			exit;
		}
	}










	/**==== FORMAT ====**/

	// return formatted numbers
	public static function numberFormat($input, $digit=2){
		if(is_numeric($input)){
			$o = $input;
			if(!empty($digit) && is_numeric($digit)){$o = number_format($input, $digit);}
			else {$o = number_format($input);}
			return $o;
		}
		return false;
	}

	// return formatted size (computer-based measurement)
	public static function sizeFormat($byte){
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










	/**==== INPUT ====**/

	// [returns clean string/array
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


	// remove or add slash to string/array
	public static function slashInput($input, $task='oTRIM'){
		if($task == 'oTRIM'){
			if(!is_array($input)){
				$o = '';
				$o = stripslashes($input);
			}
			else {
				$o = array();
				foreach ($input as $key => $value){
					$clean = stripslashes($value);
					$o[$key] = $clean;
				}
			}
		}
		elseif($task == 'oADD'){
			if(!is_array($input)){
				$o = '';
				$o = addslashes($input);
			}
			else {
				$o = array();
				foreach ($input as $key => $value){
					$clean = addslashes($value);
					$o[$key] = $clean;
				}
			}
		}
	}


	// retain form input
	public static function retainInput($i='', $method='oPOST'){
		$o = '';
		if(!empty($i)){
			if($method == 'oGET'){if(isset($_GET[$i])){$o = $_GET[$i];}}
			if($method == 'oPOST'){if(isset($_POST[$i])){$o = $_POST[$i];}}
			if($method == 'oREQUEST'){if(isset($_REQUEST[$i])){$o = $_REQUEST[$i];}}
		}
		return $o;
	}


	// check if input's value is retained
	public static function isRetainedInput($value='', $i='', $method='oPOST'){
		$retained = self::retainInput($i, $method);
		if($value == $retained){return true;}
		return false;
	}


	// retain input's group (array) of values [check if value is in options] ~TODO | test this method
	public static function retainGroupInput($output='oCHECK', $value='', $i='', $method='oPOST'){
		$retained = self::retainInput($i, $method);
		if(is_array($retained) && in_array($value, $retained)){
			if($output == 'oCHECK'){return true;}
			return $output;
		}
		return false;
	}











	/**==== DATA ====**/

	// capture data from post/get/request, filter relevant info and return it
	public static function captureData($i='oPOST', $filter=''){
		if(!empty($i)){
			if($i == 'oGET' && !empty($_GET)){$v = $_GET;}
			elseif($i == 'oPOST' && !empty($_POST)){$v = $_POST;}
			elseif($i == 'oREQUEST' && !empty($_REQUEST)){$v = $_REQUEST;}

			if(!empty($filter) && is_array($filter) && is_array($o)){
				$o = array();
				foreach ($filter as $index){
					if(isset($v[$index])){$o[$index] = self::cleanInput($v[$index]);}
					else {$o[$index] = '';}
				}
			}
			else {
				$o = $v;
			}
		}

		if(!empty($o)){
			#remove main uri [oapi & olink] for array if it exists
			if(isset($o['oapi'])){unset($o['oapi']);}
			if(isset($o['olink'])){unset($o['olink']);}
			return $o;
		}
		return false;
	}











	/**==== UTILITY ====**/

	// set language
	public static function lang($lang=''){
		if(!empty($lang)){$o = $lang;}
		elseif(!empty($_GET['lang'])){$o = $_GET['lang'];}
		elseif(!empty($_POST['oLang'])){$o = $_POST['oLang'];}
		elseif(!empty($_SESSION['oLang'])){$o = $_SESSION['oLang'];}
		else {$o = 'en';}

		if(empty($_SESSION['oLang'])){$_SESSION['oLang'] = $o;}
		elseif($_SESSION['oLang'] != $o){$_SESSION['oLang'] = $o;}
		return strtolower($o);
	}


	// perform JSON operations
	public static function json($input, $i='oENCODE'){
		if(!empty($input)){
			if($i == 'oENCODE'){return json_encode($input);}
			elseif($i == 'oPRINT'){
				header('Content-Type: application/json');
				echo json_encode($input, JSON_PRETTY_PRINT);
				exit;
			}
		}
		return;
	}


	// dump data to screen for debugging
	public static function dump($data, $o='oPRE'){
		if($o == 'oDUMP'){return var_dump($data);}
		elseif($o == 'oPRINT'){return print_r($data);}
		elseif($o == 'oPRE'){echo '<pre><tt>'.var_export($data, true).'</tt></pre>';}
		elseif($o == 'oCLASSVAR'){self::dump(get_class_vars($data), 'oPRE');}
		elseif($o == 'oOBJVAR'){self::dump(get_object_vars($data), 'oPRE');}
	}
}
?>