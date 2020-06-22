<?php
/**
 * FIA™ framework ~ a micro framework for website, application and API development with PHP & MySQL; © 2020 VERI8™, Inc.
 * =====================================================================================================================
 **/
class fia {

	#DEFINE PROPERTIES
	private static $instance;

	public static $firm;
	public static $name;
	public static $brand;
	public static $acronym;
	public static $slogan;
	public static $url;
	public static $domain;
	public static $email;
	public static $phone;
	public static $routing;
	public static $version;
	public static $author;
	public static $path;
	public static $dbo;
	public static $timezone;
	public static $machine;




	/**==== ROUTING UTILITY ====**/

	#CHECK IF ACTIVE ROUTE SHOULD BE EXEMPTED ~ returns true of false
	public static function routeExempt($exemption, $route=''){
		if(empty($route) || $route == 'oACTIVE'){$route = self::route();}
		if(!is_array($exemption) && $route == $exemption){return true;}
		elseif(is_array($exemption) && in_array($route, $exemption)){return true;}
		return false;
	}



	#CLEAN ROUTE VALUE
	public static function routeClean($i){
		$o = strtolower($i);
		$o = self::inputClean($o);
		return trim($o);
	}


	#RETURN ACTION URI FROM ROUTE
	public static function routeAction($i='oGET'){
		if($i == 'oGET'){
			if(!empty($_GET['oact'])){$o = $_GET['oact'];}
			else {$o = 'default';}
			return strtolower($o);
		}
	}



	#GET & PREPARE ROUTE ~ from URI or input
	public static function route($type='oAPP', $i='oGET'){
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
			return self::routeClean($v);
		}
		return false;
	}


	#ROUTER ~ handles primary controller
	public static function router($i='oAUTO'){

		#If redirect is detected from URI
		if(!empty($_GET['oredirect'])){
			$goto = self::routeClean($_GET['oredirect']);
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
				return self::osite();
			}


			#APP ~ when api call on URI doesn't exists
			elseif(!self::route('oAPI')){
				// $o['oRouter'] = 'oAPP';
				// $o['oRoute'] = self::route('oAPP');
				// $o['oFile'] = self::$path['module'].'app'.DS.$o['oRoute'].'.php';
				// if(!file_exists($o['oFile'])){
				// 	$o['oFile'] = self::$path['module'].'app.php';
				// 	if(!file_exists($o['oFile'])){oExit('app','missing controller file', $o['oFile']);}
				// 	#For when $i is set to auto & app.php is used as default app controller file
				// 	elseif($i == 'oAUTO'){
				// 		require $o['oFile'];
				// 		$routename = self::stringTo($o['oRoute'], 'oMETHOD');
				// 		if(!class_exists('oAPP') || !method_exists('oAPP', $routename)){oExit('app', '['.$o['oRoute'].'] controller required', $o['oFile']);}
				// 	}
				// }

				// #For when $i is set to get ~ returns $i value;
				// if($i == 'oGET' && !empty($o)){return $o;}
				return self::oapp($i);
			}


			#API ~ when api call exists on URI
			else {
				return self::oapi($i);
			}
		}
		else {oExit('FIA', 'path undefined', 'module path not set as property of fia class');}
	}
	/**NOTE:
	 * REDIRECT takes precedence over everything else
	 * SITE takes precedence next, when set
	 * APP takes precedence next, if API call not found in URI (/api/*)
	 * API is next, if API call is found
	 * API or APP class & route method will be called automatically only when $i (project routing) is set to oAUTO and the default controller is used
	*/










	/**==== lOADER UTILITY ====**/

	#PREPARE ~ get and return a file based on path (use view as default path)
	public static function prepare($i='oGET', $path='oVIEW'){
		$v = self::router('oGET');
		if(isset($v['oRouter'])){
			$router = $v['oRouter'];
			if($i !== 'oGET'){$route = $i;} else {$route = $v['oRoute'];}

			if($router == 'oAPI' || $path == 'oAPI'){$o = self::$path['module'].'api'.DS.$route;}
			elseif($path == 'oAPP'){$o = self::$path['module'].'app'.DS.$route;}
			elseif($path == 'oBIT'){$o = self::$path['layout'].'bit'.DS.$route;}
			elseif($path == 'oTHEME'){$o = self::$path['layout'].'skin'.DS.$route;}
			elseif($path == 'oVIEW'){$o = self::$path['layout'].'view'.DS.$route;}
			elseif($path == 'oCODE'){$o = self::$path['module'].'code'.DS.$route;}

			if(!empty($o)){return $o.'.php';}
		}
	}



	public static function ofile($o = '', $option='oLOAD', $type=''){
		if(!empty($o)){
			if($type == 'oCODE'){$o = self::$path['module'].'code'.DS.$o;}
			if($type == 'oSITE'){$o = self::$path['module'].$o;}
			if($type == 'oAPP'){$o = self::$path['module'].'app'.DS.$o;}
			if($type == 'oAPI'){$o = self::$path['module'].'api'.DS.$o;}
			$o = strtolower($o);
			$file = $o.'.html';
			if(!file_exists($file)){$file = $o.'.inc';}
			if(!file_exists($file)){$file = $o.'.php';}

			if($option == 'oLOAD'){
				if(!file_exists($file)){
					oExit($type, 'file unavailable', $file);
				}
				require $file;
				return true;
			}
			elseif($option == 'oRETURN'){
				return $file;
			}
		}
		return false;
	}








	#CODE ~ return or load
	public static function ocode($i='oGET', $option='oLOAD'){
		if(!empty($i)){
			if($i !== 'oGET'){$o = $i;}
			else {
				$v = self::router('oGET');
				if(isset($v['oRoute'])){$o = $v['oRoute'];}
			}
			return self::ofile($o, $option, 'oCODE');
		}
	}




	#SITE ~ Load default site controller
	public static function osite($input='', $option='oLOAD'){
		if(empty($input)){$input = 'site';}
		return self::ofile($input, $option, 'oSITE');
	}


	public static function oapi($i='oAUTO', $option='oLOAD'){
		$o['oRouter'] = 'oAPI';
		$o['oRoute'] = self::route('oAPI');
		$o['oFile'] = self::ofile($o['oRoute'], 'oRETURN', 'oAPI');
		if(!file_exists($o['oFile'])){
			$file = self::$path['module'].'api';
			$o['oFile'] = self::ofile($file, 'oRETURN', 'oDEFAULT');
		}

		if($option == 'oLOAD'){
			if(!file_exists($o['oFile'])){
				oExit('oapi', 'controller file unavailable', $o['oFile']);
			}
			require $o['oFile'];
			return true;
		}
		elseif($option == 'oRETURN'){
			return $o;
		}
	}

	public static function oapp($i='oAUTO', $option='oLOAD'){
		$o['oRouter'] = 'oAPP';
		$o['oRoute'] = self::route('oAPP');
		$o['oFile'] = self::ofile($o['oRoute'], 'oRETURN', 'oAPP');
		if(!file_exists($o['oFile'])){
			$file = self::$path['module'].'app';
			$o['oFile'] = self::ofile($file, 'oRETURN', 'oDEFAULT');
		}

		if($option == 'oLOAD'){
			if(!file_exists($o['oFile'])){
				oExit('oapp', 'controller file unavailable', $o['oFile']);
			}
			require $o['oFile'];
			return true;
		}
		elseif($option == 'oRETURN'){
			return $o;
		}
	}




	#LOAD ~ load a file | use view path by default
	public static function load($i='oGET', $path='oVIEW'){
		$o = self::prepare($i, $path);
		if(file_exists($o)){require $o; return;}
		oExit('path', $path.' unavailable', $o);
	}


	#VIEW ~ return or load
	public static function view($i='oGET', $v='oLOAD'){
		if($v == 'oLOAD'){return self::load($i, 'oVIEW');}
		else {return self::prepare($i, 'oVIEW');}
	}


	#THEME ~ return or load
	public static function theme($i='oGET', $v='oLOAD'){
		if($v == 'oLOAD'){return self::load($i, 'oTHEME');}
		else {return self::prepare($i, 'oTHEME');}
	}


	#BIT ~ return or load
	public static function bit($i='oGET', $v='oLOAD'){
		if($v == 'oLOAD'){return self::load($i, 'oBIT');}
		else {return self::prepare($i, 'oBIT');}
	}




	#SUBSTITUTE SPACE WITH CHARACTER|STRING AND VICE-VERSA
	public static function spaceTo($string, $value, $inv='oNOPE'){
		if($inv == 'oYEAH'){return str_replace($value, ' ', $string);}
		return preg_replace('/\s+/', $value, $string);
	}



	#ARRAY
	public static function isArrayMulti($i){
		foreach ($i as $v) {
			if (is_array($v)) return true;
		}
		return false;
	}


	#RETURNS BOOLEAN ~ check for needle in string
	public static function stringIn($string, $needle){
		if(strpos($string, $needle) !== false){return true;}
		return false;
	}

	//-------------- Substitute a character|string in a string and vice-versa ---------------
	public static function stringSwap($string, $search, $substitute , $occurence='oALL'){
		#check if $search is found and return result, else return full string
		$found = self::stringIn($string, $search);
		if(!$found){return $string;}
		else {
			if($occurence == 'oALL'){return str_replace($search, $substitute, $string);}
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

	//-------------- Return false OR value before first occurrence character|string if found ---------------
	public static function stringBefore($string, $search, $strip='oYEAH'){
		$pos = strpos($string, $search);
		if($pos && $pos != 0){$result = substr($string, 0, $pos);}
		if($strip != 'oYEAH'){$result = $result.$search;}
		if(isset($result)){return $result;}
		return false;
	}


	//-------------- Return false OR value after first character|string if found ---------------
	public static function stringAfter($string, $search, $strip='oYEAH'){
		$found = strstr($string, $search);
		if($found){
			$result = $found;
			if($strip == 'oYEAH'){
				$result = self::stringSwap($result, $search, '', 'oFIRST');
			}
		}
		if(!empty($result)){return $result;}
		return false;
	}

	public static function stringMatch($string='', $comparison='', $rule='oDEFAULT'){
		if($rule == 'oABSOLUTE' && $string === $comparison){return true;}
		elseif($rule != 'oABSOLUTE' && $string == $comparison){return true;}
		return false;
	}

	public static function stringTo($o, $to){
		#Returns domain from URL
		if($to == 'oDOMAIN'){
			$o = self::stringSwap($o, 'https://', '', 'oFIRST');
			$o = self::stringSwap($o, 'http://', '', 'oFIRST');

			#Remove sub-directory if found
			if(self::stringIn($o, '/')){
				$o = self::stringBefore($o, '/', 'oYEAH');
			}

			#Remove [known] sub-domain  TODO  ~ use library
			$subs = array('www','en', 'ng');
			$o_stripped = '';
			foreach ($subs as $sub){
				if(self::stringIn($o, $sub)){
					$o = self::stringSwap($o, 'www.', '', 'oFIRST');
				}
			}
		}

		#Returns page title from string
		if($to == 'oTITLE'){
			$o = self::stringSwap($o, '-', ' ');
			$o = self::stringSwap($o, '_', ' ');
			$o = ucwords($o);
		}


		#Returns method-clean name from string
		if($to == 'oMETHOD'){
			$o = self::stringSwap($o, '-', ' ');
			$o = self::stringSwap($o, '_', ' ');
			$o = ucwords($o);
			$o = lcfirst($o);
			$o = self::spaceTo($o, '');
		}

		return $o;
	}













	/**==== URL UTILITY ====**/

	#RETURN URL REFERRER ~ if available
	public static function refURL(){
		if(!empty($_SERVER['HTTP_REFERER'])){return $_SERVER['HTTP_REFERER'];}
		return false;
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
			if($method == 'oGET' && !empty($_GET[$i])){$o = $_GET[$i];}
			if($method == 'oPOST' && !empty($_POST[$i])){$o = $_POST[$i];}
			if($method == 'oREQUEST' && !empty($_REQUEST[$i])){$o = $_REQUEST[$i];}
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










	//=====::INITIALIZATION UTILITY::=====//

	#INITIALIZATION ~ to initialize application
	public static function initialize($o){
		if(!empty($o) && is_array($o)){

			#session
			if(!empty($o['session'])){
				self::sessionName($o['session']);
				unset($o['session']);
			}
			self::sessionStart();

			#enforce https
			if(array_key_exists('https', $o) && $o['https'] == 'impose'){
				self::imposeSSL();
				unset($o['https']);
			}

			#check status & respond (-set error_reporting)
			if(!empty($o['status'])){
				if($o['status'] != 'oLIVE'){oExit('project', 'offline!', 'Sorry, this project is offline at the moment');}
				unset($o['status']);
			}

			#set machine (TODO -set error_reporting)
			if(!empty($o['machine'])){
				self::$machine = $o['machine'];
				unset($o['machine']);
			}

			#set timezone
			if(array_key_exists('timezone', $o)){
				$timezone = self::timezone($o['timezone']);
				if($timezone !== false){self::$timezone = $o['timezone'];}
				if(!empty(self::$timezone)){unset($o['timezone']);}
			}
			if(empty(self::$timezone)){
				self::$timezone = 'Africa/Lagos';
				self::timezone(self::$timezone);
			}

			#set project information
			$o = self::project($o);

			#set database
			if(array_key_exists('oDATABASE', $o)){
				self::database($o['oDATABASE']);
				unset($o['oDATABASE']);
			}

			#set path
			$o = self::path($o);
		}
	}



	#SET PROJECT INFORMATION AS OBJECT PROPERTIES
	private static function project($o){
		if(isset($o['oPROJECT']) && !empty($o['oPROJECT']) && is_array($o['oPROJECT'])){
			$project = $o['oPROJECT'];
			if(!isset($project['url'])){self::url('oSET');}
			if(!isset($project['domain'])){self::domain('oSET');}
			if(!isset($project['email'])){self::email('oSET');}

			foreach ($project as $key => $value){
				if(property_exists(__CLASS__, $key) && !empty($value)){
					#fix email without @
					if($key == 'email' && self::stringIn($value, '@') === false){
						$value = $value.'@'.self::$domain;
					}
					self::${$key} = $value;
					unset($project[$key]);
				}
				elseif($key == 'url' && empty($value)){
					self::url('oSET');
					unset($project['url']);
				}
				elseif($key == 'domain' && empty($value)){
					self::domain('oSET');
					unset($project['domain']);
				}
				elseif($key == 'email' && empty($value)){
					self::email('oSET');
					unset($project['email']);
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
			if(empty($o['path'])){unset($o['path']);}
		}
		return $o;
	}










	//=====::SESSION UTILITY::=====//

	#RETURN SESSION VALUE - $_SESSION['value']
	public static function session($i='', $v='', $id=''){
		if(!empty($id)){self::sessionStart($id);}
		if(!empty($i)){
			if(!empty($v)){$_SESSION[$i] = $v;}
			elseif(isset($_SESSION[$i])){
				return $_SESSION[$i];
			}
		}
	}



	#CLOSE SESSION WRITE
	public static function sessionClose(){
		return session_write_close();
	}



	#SET/GET SESSION ID
	public static function sessionID($id=''){
		if(empty($id)){session_id();}
		elseif($id == 'oGET'){return session_id();}
		else {
			self::sessionClose();
			session_id($id);
		}
	}



	#SET/GET SESSION NAME
	public static function sessionName($name=''){
		if(empty($name)){session_id();}
		elseif($name == 'oGET'){return session_name();}
		else {session_name($name);}
	}



	#START SESSION
	public static function sessionStart($id=''){
		if(empty($id) || $id == 'oGET'){
			if(headers_sent() === false && !isset($_SESSION)){
				session_start();
				if(empty($_SESSION['INIT_SESSION_ID'])){$_SESSION['INIT_SESSION_ID'] = session_id();}
				return;
			}
		}
		else {
			self::sessionID($id);
			session_start();
			return;
		}
	}



	#ROLLBACK SESSION - (rollback to last active session information)
	public static function sessionReset(){
		if(!isset($_SESSION)){
			return session_reset();
		}
	}



	#ABORT SESSION - (maintain session yet discard session changes on current page)
	public static function sessionAbort(){
		if(!empty($_SESSION)){
			return session_abort();
		}
	}



	#DELETE SESSION - (unset session or a session's variable)
	public static function sessionUnset($var=''){
		if(!empty($_SESSION)){
			if(!empty($var) && !empty(self::session($var))){
				unset($_SESSION[$var]);
				return true;
			}
			elseif(empty($var)){
				session_unset();
				return true;
			}
		}
		return false;
	}



	#DESTROY SESSION - (destroys all data within current session)
	public static function sessionDestroy(){
		if(isset($_SESSION['session_status'])){
			unset($_SESSION['session_status']);
		}
		return session_destroy();
	}



	#TERMINATE SESSION
	public static function sessionTerminate(){
		if(!empty($_SESSION)){
			$_SESSION = array();
			if(ini_get("session.use_cookies")){
				$params = session_get_cookie_params();
				setcookie(
					session_id(),
					'',
					time() - 42000,
					$params["path"],
					$params["domain"],
					$params["secure"],
					$params["httponly"]
				);
			}
			session_unset();
			session_destroy();
		}
	}



	#STOP A PARTCTULAR SESSION
	public static function sessionStop($id='oGET'){
		if($id == 'oGET'){$id = self::sessionID('oGET');}
		self::sessionStart($id);
		self::sessionTerminate();
		// self::sessionStart($id);
	}



	#TERMINATE & START FRESH SESSION
	public static function sessionFresh($i=''){
		if(empty($i) && !empty(self::$session)){$i = self::$session;}
		if(!empty($i)){
			self::sessionStop($i);
			self::sessionStart($i);
		}
		else {
			self::sessionStart();
			self::sessionTerminate();
			self::sessionStart();
		}
		return $i;
	}










	//=====::SSL UTILITY::=====//

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
		self::sessionStart();
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










	/**=====::REDIRECT UTILITY::=====**/

	#URL REDIRECT ~ using meta
	public static function redirectMeta($link, $delay=0, $path='oRELATIVE', $exit='oNOPE'){
		$o = '<meta http-equiv="refresh" content="'.$delay.'; url='.$link.'">';
		if($exit == 'oYEAH'){exit($o);}
		else {return $o;}
	}



	#URL REDIRECT
	public static function redirect($link, $delay=0, $path='oRELATIVE', $exit='oNOPE'){
		if($path == 'oRELATIVE'){
			$o = '.'.PS;
			if($link != 'index'){$o .= $link;}
		}
		elseif($path == 'oNONE'){
			if($link != 'index'){$o = $link;}
			else {$o = '.'.PS;}
		}
		elseif($path == 'oURL'){
			$o = self::$url;
			if($link != 'index'){$o .= PS.$link;}
		}

		if(!headers_sent($filename, $linenum)){
			if(!empty($delay)){header('Refresh:'.$delay.';url='.$o);}
			else {header('Location: '.$o);}
			if($exit != 'oNOPE'){exit();}
		}
		else {
			#use meta redirect (Headers already sent in $filename on line $linenum)
			return self::redirectMeta($o, $delay, $path, $exit);
		}
	}



	#REDIRECT & EXIT
	public static function exitTo($url, $path='oRELATIVE'){
		return self::redirect($url, 0, $path, 'oYEAH');
	}










	/**=====::DATA UTILITY::=====**/

	#CAPTURE DATA (POST/GET/REQUEST/SESSION/any), FILTER RELEVANT INFO AND RETURN CLEANED
	public static function dataCapture($i='oPOST', $filter=''){
		if(!empty($i)){
			if($i == 'oGET' && !empty($_GET)){$v = $_GET;}
			elseif($i == 'oPOST' && !empty($_POST)){$v = $_POST;}
			elseif($i == 'oREQUEST' && !empty($_REQUEST)){$v = $_REQUEST;}
			elseif($i == 'oSESSION' && !empty($_SESSION)){$v = $_SESSION;}
			elseif(!empty($i)){$v = $i;}

			if(!empty($filter) && !empty($v)){
				if(is_array($filter) && is_array($v)){
					$o = array();
					foreach ($filter as $index){
						if(!empty($v[$index])){$o[$index] = self::inputClean($v[$index]);}
						elseif(isset($v[$index])){$o[$index] = '';}
					}
				}
				elseif(!is_array($filter) && is_array($v)){
					if(!empty($v[$filter])){$o[$filter] = self::inputClean($v[$filter]);}
					elseif(isset($v[$filter])){$o[$filter] = '';}
				}
				elseif(is_array($filter) && !is_array($v) && in_array($v, $filter)){
					$o = self::inputClean($v);
				}
				elseif(!is_array($filter) && !is_array($v) && ($v == $filter)){
					$o = self::inputClean($v);
				}
			}
		}

		if(!empty($o)){
			#Remove main uri [oapi & olink] for array if it exists
			if(isset($o['oapi'])){unset($o['oapi']);}
			if(isset($o['olink'])){unset($o['olink']);}
			return $o;
		}
		return false;
	}



	#READ RECORD FROM DATA ARRAY - and return value
	public static function dataRecord($data, $record){
		if(!empty($data) && !empty($record)){
			if($data == 'oGET' || $data == 'oPOST' || $data == 'oREQUEST'  || $data == 'oSESSION'){
				$data = self::dataCapture($data, $record);
				return self::dataRecord($data, $record);
			}
			elseif(is_array($data)){
				if(!is_array($record) && !empty($data[$record])){
					return $data[$record];
				}
				elseif(!is_array($record) && isset($data[$record])){
					return '';
				}
				elseif(is_array($record)){
					foreach ($record as $index){
						if(!empty($data[$index])){$o[$index] = $data[$index];}
						else {$o[$index] = '';}
					}
					return $o;
				}
			}
		}
		return false;
	}










	/**=====::INPUT UTILITY::=====**/

	#CLEAN INPUT ~ returns clean string/array
	public static function inputClean($input){
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










	/**=====::FORM UTILITY::=====**/

	#REMOVE BUTTONS FROM FORM DATA (submit, update, delete, save)
	public static function removeBTN($o){
		$btns = array('submit', 'update', 'delete', 'save');
		foreach ($btns as $btn){
		#Unset button from data (example submitBTN)
			if(isset($o[$btn.'BTN'])){
				unset($o[$btn.'BTN']);
			}
		}
		return $o;
	}



	public static function formData($i='oPOST', $name=''){
		if($i == 'oPOST' && !empty($_POST)){
			self::session('oFORM_POST_DATA', $_POST);
		}
	}

	public static function retainFormPost($i='', $form=''){
		if(!empty(self::session('oFORM_POST_DATA'))){
			$data = self::session('oFORM_POST_DATA');
			if(isset($data[$i])){return $data[$i];}
		}
	}











	//=====::MISCELLANEOUS UTILITY::=====//

	#SET TIMEZONE & RETURN BOOLEAN
	public static function timezone($i='oFIA'){
		if($i == 'oFIA' || empty($i)){$i = 'Africa/Lagos';}
		$o = date_default_timezone_set($i);
		return $o;
	}



	#STATIC COUNTER
	public static function counter($i=''){
		static $counter = 1; #on first run
		if(!empty($i)){$counter = $counter + $i;}
    return $counter++; #returns counter + 1
  }



	#RETURN SERVER-BASE INFORMATION (for example server URL)
  public static function base($i='oDOMAIN'){
  	if($i == 'oDIR'){$o = $_SERVER['DOCUMENT_ROOT'];}
  	if($i == 'oHOST' || $i == 'oSERVER'){
  		if($i == 'oHOST'){$o = $_SERVER['HTTP_HOST'];}
  		if($i == 'oSERVER'){$o = $_SERVER['SERVER_NAME'];}
  		if(!empty(self::session('oSSL'))){$o = 'https://'.$o;} else {$o = 'http://'.$o;}
  	}
  	if($i == 'oDOMAIN'){$o = self::stringTo(self::base('oHOST'), 'oDOMAIN');}
  	if(!empty($o)){return strtolower($o);}
  }



	#SET/GET BASE DOMAIN & ASSIGN TO PROPERTY
  public static function domain($i='oGET'){
  	if($i == 'oSET'){
  		self::$domain = self::base('oDOMAIN');
  	}
  	elseif($i == 'oGET'){
  		if(!empty(self::$domain)){return self::$doman;}
  		return self::base('oDOMAIN');
  	}
  }



	#SET/GET BASE URL & ASSIGN TO PROPERTY
  public static function url($i='oGET'){
  	if($i == 'oSET'){
  		self::$url = self::base('oSERVER');
  	}
  	elseif($i == 'oGET'){
  		if(!empty(self::$url)){return self::$url;}
  		return self::base('oSERVER');
  	}
  }



  #SET/GET PRIMATY EMAIL & ASSIGN TO PROPERTY
  public static function email($i='oGET'){
  	if($i == 'oSET'){
  		self::$email = 'admin@'.self::base('oDOMAIN');
  	}
  	elseif($i == 'oGET'){
  		if(!empty(self::$email)){return self::$email;}
  		return 'admin@'.self::base('oDOMAIN');
  	}
  }



	#RETURN PATHS
  public static function pathTo($i='', $prefix='oURL'){
  	if(isset(self::$path[$i])){return self::$path[$i];}
  	else {
			#TODO ~ improve path to method
  		$o = '';
  		if($prefix == 'oURL'){$o .= self::$url;}
  		$o .= PS.'asset'.PS;
  		if($i == 'JS'){$o .= 'js';}
  		elseif($i == 'CSS'){$o .= 'css';}
  		elseif($i == 'IMG'){$o .= 'image';}
  		elseif($i == 'MEDIA'){$o .= 'media';}
  		if(!empty($o) && $i != 'ASSET'){return $o.PS;}
  		else {return $o;}
  	}
  }



	#GET & SET LANGUAGE
  public static function lang($lang=''){
  	if(!empty($lang)){$o = $lang;}
  	elseif(!empty($_GET['lang'])){$o = $_GET['lang'];}
  	elseif(!empty($_POST['oLang'])){$o = $_POST['oLang'];}
  	elseif(!empty($_SESSION['oLANG'])){$o = $_SESSION['oLANG'];}
  	else {$o = 'en';}

  	if(empty($_SESSION['oLANG'])){
  		self::sessionStart();
  		$_SESSION['oLANG'] = $o;
  	}
  	elseif($_SESSION['oLANG'] != $o){$_SESSION['oLANG'] = $o;}
  	return strtolower($o);
  }



	#PRINT REPORT ~ especially nice for debugging
  public static function dump($input, $i='oNEAT', $v='oECHO'){
  	if(!empty($input)){
  		if($i == 'oPRE'){$o = '<pre><tt>'.var_export($input, true).'</tt></pre>';}
  		elseif($i == 'oDUMP'){return var_dump($input);}
  		elseif($i == 'oPRINT'){return print_r($input);}
  		elseif($i == 'oNEAT'){
  			if(is_array($input)){
  				$o = '<span>';
  				foreach ($input as $key => $value){
  					$o .= '<strong style="color:brown;">'.$key.':</strong> ';
  					if(is_array($value) || is_object($value)){
  						if(is_array($value)){$label = 'array';}
  						elseif(is_object($value)){$label = 'object';}
  						$o .= '<em style="color:gold;">is_'.$label.'</em><br><span style="display:inline-block; padding:8px; margin: 4px auto 6px 8px; border:1px dotted gold; border-radius:3px; background: rgba(255,255,255, 0.2);">'.self::dump($value, 'oPRE', 'oDEFAULT').'</span>';
  					}
  					else {$o .= '<span style="font-size:0.942em; color: #454545; font-family:sans-serif; line-height:1.4;">'.$value;}
  					$o .= '</span><br>';
  				}
  				$o .= '</span>';
  			}
  			else {
  				$o = $input;
  			}
  		}

  		if($v == 'oECHO'){
  			if($o === true){return self::dump(array('BOOLEAN' => "TRUE"));}
  			echo $o; return;
  		}
  		else {return $o;}
  	}

  	return self::dump(array('BOOLEAN' => "FALSE"));
  }










	//=====::DATABASE UTILITY::=====//

	#CREATE DATABASE CONNECTION AND SET DATABASE OBJECT PROPERTY
  protected static function database($o, $driver='oPDO'){
  	if(!empty($o) && is_array($o)){

			#Using PDO driver
  		if($driver == 'oPDO'){
  			try {$pdo = new PDO('mysql:dbname='.$o['name'].';host='.$o['host'], $o['user'], $o['password']);}
  			catch (PDOException $e){oExit('database', 'connection error', $e->getMessage());}
  			self::$dbo = $pdo;
  		}
  	}
  }



	#RETURN DATABASE OBJECT
  public static function dbo(){
  	if(!empty(self::$dbo)){return self::$dbo;}
  	return false;
  }










	//=====::SQL UTILITY::=====//

	#RETURN ERROR RESPONSE FROM [QUERY STATEMENT OR LAST DATABASE OPERATION]
  public static function stmtF9($sql, $obj='', $i=2){
  	$o['oSQL'] = $sql;
		#TODO ~ clean up error reporting

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



	#RESOLVE QUERY STATEMENT AND RETURN RESPONSE
  public static function stmt($sql, $stmt){
  	if($stmt === false){
  		return self::stmtF9($sql, $stmt);
  	}
  	else {
  		$o['oSQL'] = $sql;
  		$o['oSUCCESS'] = 'oYEAH';
  		if(is_int($stmt)){$o['oCOUNT'] = $stmt;}
  		else {
				#TODO ~ a better check for query type
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



	#EXECUTES SQL QUERY & RETURNS RESPONSE
  public static function execSQL($sql){
  	$selectInSQL = stripos($sql, 'select');
  	if($selectInSQL !== false){
  		exit('ERROR::Unacceptable <em>(Don\'t call <strong>execSQL()</strong> on SELECT statement</em>)');
  	}
  	$dbo = self::$dbo;
  	$stmt = $dbo->exec($sql);
  	return self::stmt($sql, $stmt);
  }
	/**NOTE:
	 * Don't run SELECT statements on exec
	 * Don't pass user's input directly via SQL into exec
	 * It returns FALSE on failure, and ZERO(0) on success (when no rows affected), or the NUMBER of rows affected
	*/



	#RESET PRIMARY KEY
	public static function resetSQL($table, $column){
		$sql = "SET @NewID = 0; ";
		$sql .= "UPDATE `{$table}` SET `{$column}`=(@NewID := @NewID +1) ORDER BY `{$column}`; ";
		$sql .= "SELECT MAX(`{$column}`) AS `IDMax` FROM `{$table}`; ";
		$sql .= "ALTER TABLE `{$table}` AUTO_INCREMENT = [IDMax + 1]; ";
		return self::runSQL($sql);
	}



	#RUN SQL QUERY - NOTE ~ don't use with user INPUT, best for single case with result
	public static function querySQL($sql){
		$dbo = self::$dbo;
		$stmt = $dbo->query($sql);
		return self::stmt($sql, $stmt);
	}



	#RUN SQL USING PREPARED STATEMENT
	public static function runSQL($sql, $i='', $return='oDEFAULT'){
		$dbo = self::$dbo;
		$stmt = $dbo->prepare($sql);
		if(empty(($i))){
			$exec = $stmt->execute();
		}
		elseif(is_array($i)){
			$exec = $stmt->execute($i);
		}
		if($exec === false){
			return self::stmtF9($sql, $stmt);	#returns error as PDO [$dbo->errorInfo()]
		}
		$result = self::stmt($sql, $stmt);
		if($return == 'oBOOLEAN' && isset($result['oSUCCESS'])){return true;}
		elseif($return == 'oCOUNT' && isset($result['oCOUNT'])){return $result['oCOUNT'];}
		elseif($return == 'oRECORD' && isset($result['oRECORD'])){return $result['oRECORD'];}
		else {return $result;}
	}


	public static function isCountSQL($query, $column, $count=''){
		$o = fia::runSQL($query, $column, 'oCOUNT');
		if($o != $count){return false;}
		return true;
	}



	#SQL BINDER on array
	public static function arrayBind($data, $symbol=':'){
		if(is_array($data)){
			$o = array();
			foreach ($data as $key => $value){
				$in = $symbol.$key;
				$o[$in] = $value;
			}
			return $o;
		}
	}



	#SQL CHECK FOR RESULT
	public static function isRecordSQL($result='', $check=''){
		if($result != false && $result != 'NO_RECORD'){
			if(empty($check)){return true;}
			elseif(!empty($check) && is_array($result) && isset($result[$check])){return true;}
		}
		return false;
	}

}
?>