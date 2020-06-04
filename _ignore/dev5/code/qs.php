<?php
/* QuikSite™ ~ a micro framework for quick website development © 2016 [alpha]
 * Program -> quiksite.php -
 * ===================================================================================
 */

// separators
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('PS') ? null : define('PS', '/');


/** Begin UTILITY functions **/

// perfoms empty check on a variable
function isEmpty($data=''){
	if(!isset($data)){return TRUE;}
	else {
		if(is_array($data)){
			if(empty($data)){return TRUE;}
		} else {
			$data = trim($data);
			$length = strlen($data);
			if($length<1){return TRUE;}
		}
	}
	return FALSE;
}

// check if file exists
function isFile($content=''){
	if(file_exists($content)){return TRUE;}
	else {return FALSE;}
}

// notify 404 error
function notFound($document=''){
	if(!empty($document)){$task = '<p class="paragraph"><i>The requested document <b>"'.$document.'"</b> is unavaliable</i></p>'."\n";}
	else {return false;}
	echo $task;
}

// return document information
function docInfo($task='name', $document='self'){
	#prepare & return result
	if($document == 'self'){$page = $_SERVER['PHP_SELF'];}
	$path = pathinfo($page);
	$ext = '.'.$path['extension'];

	$result = basename($page, $ext);
	if($task == 'filename'){$result = $result.$ext;}
	elseif($task=='file'){$result = $page;}
	elseif($task=='name'){$result = $result;}
	elseif($task=='ext'){$result = $ext;}
	return $result;
}




/** Begin STRING functions **/

// check for needle in string
function inString($string='', $needle=''){
	if(isEmpty($string) || isEmpty($needle)){return FALSE;}
	if(strpos($string, $needle) !== false){return TRUE;}
	return FALSE;
}

// find and replace string
function stringSwap($subject='', $search='', $replace='', $occurence='all'){
	#check if $search is found, else return full string
	$isfound = strstr($subject, $search);
	if(!$isfound){$task = $subject;}
	else {
		if($occurence=='all'){$task = str_replace($search, $replace, $subject);}
		else {
			if($occurence=='first'){$pos = strpos($subject, $search);}
			if($occurence=='last'){$pos = strrpos($subject, $search);}
			if($pos !== false){$task = substr_replace($subject, $replace, $pos, strlen($search));}
			else {$task = $subject;}
		}
	}

 	#return task
	return $task;
}

// trim edges or character(s) from string
function trimEdge($string='', $character=''){
 	#perform validation
	if(isEmpty($string) || is_null($character)){return false;}

 	#prepare & return result
	$task = trim($string);
	$task = preg_replace('/\s+/', '', $task);
	if(!isEmpty($character)){$task = trim($task, $character);}
	return $task;
}

// return words capitalized
function capitalizeWords($string='', $words='library'){
	if(isEmpty($string) || isEmpty($words) || ($words!='library' && !is_array($words))){return false;}
	if($words=='library'){
		$words = array(
			'sms', 'faq', 'cms',
			'Sms', 'Faq', 'Cms'
		);
	}
	$stringBit = preg_split('/\s+/', $string);
	foreach ($stringBit as $bit){
		if(in_array($bit, $words)){
			$capBit = strtoupper($bit);
			$string = str_replace($bit, $capBit, $string);
		}
	}

	#return task
	return $string;
}

// returns cleaned up string
function cleanUp($string=''){
	if(isEmpty($string)){return FALSE;}
	$string = trim($string);
	$string = stringSwap($string, ' and', ' &');
	$string = stringSwap($string, '-', ' ');

	#return task
	return $string;
}

function rewriteRH($string=''){
	if(isEmpty($string)){return FALSE;}
	$string = trim($string);
	$string = stringSwap($string, '_', ' ');
	$string = ucwords($string);
	$words = explode(" ", $string);
	$clean = '';
	foreach ($words as $word){
		$word = stringSwap($word, '_', ' ');

		#Checking
		$check = strtolower($word);
		$check = trim($check);
		// echo $check. ' ~ ';
		if($check == 'bank'){$word = '';}
		if($check == 'banking'){$word = '';}
		if($check == 'boa'){$word = 'BofA';}
		if($check == 'ing'){$word = 'INGBnk';}
		if($check == 'fargo'){$word = 'F.';}

		$clean .= $word. ' ';
	}
	$clean = capitalizeWords($clean);
	$clean = trim($clean);
	return $clean;
}


/** Begin LINK functions **/

// returns referrer url
function refererURL(){
	#prepare & return
	if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){return $_SERVER['HTTP_REFERER'];}
	else {return FALSE;}
}

// make link
function doLink($input=''){
	#perform validation
	if(isEmpty($input)){return FALSE;}

	#prepare & return result
	$input = stringSwap($input, '_', '-');
	$task = '?page='.trim(strtolower($input));
	return $task;
}

// returns link information
function grabLink(){
	#prepare & return result
	$task = 'index';
	if(isset($_GET['page']) && !empty($_GET['page'])){$task = $_GET['page'];}

	$task = trimEdge($task);
	$task = stringSwap($task, '\\', '');
	$task = stringSwap($task, PS, '');
	$task = stringSwap($task, '~', '');
	$task = urldecode($task);
	return $task;
}

// return current page link
function selfLink(){
	#prepare & return result
	return grabLink();
}

// check for active link
function isLinkActive($uri='index'){
	$uri = stringSwap($uri, '&', 'and', 'all');
	$task = grabLink();
	if($uri == $task){return TRUE;}
	return FALSE;
}

// markup url
function markupLink($link='', $name='', $tag='', $target='self', $style='link', $activate='', $link_as='relative'){
	#perform validation
	if(isEmpty($link)){return FALSE;}

	# ~link
	$link = strtolower($link);
	$prepLink = '';
	if($link_as =='absolute'){$prepLink .= $link;}
	elseif($link!='index'){
		$prepLink .= doLink($link);
	}
	else {$prepLink .= getSiteURL();}

	# ~name
	if(isEmpty($name)){$name = stringSwap($link, '_', ' ');}
	$prepName = capitalizeWords($name, 'library'); //make words if found in library, uppercase

	# ~tag
	if(empty($tag)){$tag = $prepName;}
	else {$tag = capitalizeWords($tag, 'library');}
	$prepTag = ucfirst($tag);

	# ~style
	$prepStyle = '';
	$linkIsActive = isLinkActive($link);
	$stayActive = 'no';

	if(is_array($activate)){
		if(in_array(grabLink(), $activate)){$stayActive = 'yeah';}
	} else {
		if(grabLink()==$activate){$stayActive = 'yeah';}
	}

	if(!empty($style) || $linkIsActive || $stayActive == 'yeah'){
		$prepStyle .= ' class="';
		if(!empty($style)){$prepStyle .= $style;}
		if(!empty($style) && $linkIsActive || $stayActive == 'yeah'){$prepStyle .= ' ';}
		if($linkIsActive || $stayActive == 'yeah'){$prepStyle .= 'active';}
		$prepStyle .= '"';
	}

	# ~target
	$prepTarget = '';
	if(!empty($target) && $target !='self'){$prepTarget = ' target="'.$target.'"';}
	$task ='<a href="'.$prepLink.'" title="'.$prepTag.'"'.$prepStyle.$prepTarget.'>'.$prepName.'</a>';
	return $task;
}




/** Begin DIRECTORY functions **/

// return remote directory
function getRD(){
	#collect required data
	global $qs_basepath;

	#prepare & return result
	$task = stringSwap($_SERVER['DOCUMENT_ROOT'], DS, '', 'last');
	if(!empty($qs_basepath)){$task .= DS.$qs_basepath;}
	return strtolower($task);
}




/** Begin DOMAIN & URL functions **/

// convert url to domain
function url2domain($url=''){
	#perform validation
	if(empty($url)){return FALSE;}

	#prepare & return result
	$task = $url;
	$task = stringSwap($task, 'https://', '', 'first');
	$task = stringSwap($task, 'http://', '', 'first');
	$task = stringSwap($task, 'www.', '', 'first');
	$task = stringSwap($task, '/', '', 'last');
	return $task;
}

// return baseurl
function getBaseURL(){
	#collect required data
	global $qs_baseurl;

	#prepare & return result
	if(!empty($qs_baseurl)){$task = $qs_baseurl;}
	else {$task = $_SERVER['HTTP_HOST'];}
	return strtolower($task);
}

// return domain name
function getDomain(){
	#prepare & return result
	if(!empty($qs_domain)){$task = $qs_domain;}
	else {
		$task = url2domain(getBaseURL());
		return strtolower($task);
	}
}

// return domain name with protocol
function getDomainURL(){
	#collect required data
	$task = getDomain();

	#prepare & return result
	$protocol ='';
	if(inString(getBaseURL(), 'https')){$protocol .='https://';}
elseif(inString(getBaseURL(), 'http')){$protocol .='http://';}
else {
	if(isset($_SERVER['HTTPS'])){$protocol .='https://';} else {$protocol .='http://';}
}

if(inString(getBaseURL(), 'www.')){$protocol .='www.';}

	#return result
return strtolower($protocol.$task);
}

// return domain name with protocol
function getDomainBase($subdomain=''){
	#collect required data
	$domain = getDomain();

	#prepare
	if(!empty($subdomain)){$domainbase = stringSwap($domain, $subdomain.'.', '', 'first');}
	else {
		$domainbase = stringSwap($domain, 'en.', '', 'first');
		$domainbase = stringSwap($domainbase, 'us.', '', 'first');
		$domainbase = stringSwap($domainbase, 'uk.', '', 'first');
		$domainbase = stringSwap($domainbase, 'ib.', '', 'first');
	}

	#return result
	return strtolower($domainbase);
}

// return site url
function getSiteURL(){
	#collect required data
	global $qs_basepath;

	#prepare & return result
	$task = getDomainURL();
	if(!empty($qs_basepath)){$task .= PS.$qs_basepath;}
	return $task;
}




/** Begin CORE HELPER functions **/

// get page name from url
function getPage(){
	if(isset($_GET['page']) && !empty($_GET['page'])){$task = $_GET['page'];}
	else {$task = 'index';}
	return strtolower($task);
}

// get content type filename and location
function getFile($content='', $type='page', $separator='DS'){
	#collect required data
	if(empty($content)){$task['content'] = getPage();}
	else {$task['content'] = strtolower($content);}

	if(!empty($type)){$task['type'] = strtolower($type);}
	else {$task['type'] = 'page';}

	#prepare & return result
	#$task = 'source'.constant(strtoupper($separator)).$task['type'].constant(strtoupper($separator)).$task['content'].'.php';
	$task = 'brux'.constant(strtoupper($separator)).$task['content'].'.php';
	return strtolower($task);
}

// load file content
function loadFile($content='', $type='slice'){
	$task = getFile($content, $type);
	if($task){
		if(isFile($task)){include($task);}
		else {return notFound($task);}
	}
	return FALSE;
}




/** Begin DEVELOPER's HELPER functions **/

// return page title
function showTitle(){
	#collect required data
	$page = getPage();
	global $qs_name;
	global $qs_slogan;

	#prepare & return result
	$task = '';
	if($page != 'index'){
		$task .= ucwords(cleanUp($page));
		$task .= ' | '.$qs_name;
	}
	else {
		$task .= $qs_name;
	}

	if($page == 'index' || $page == 'home'){$task .= ' - '.$qs_slogan;}

	return $task;
}

// return page heading
function showHeading(){
	#collect required data
	$page = getPage();
	global $qs_name;
	global $qs_slogan;

	#prepare & return result
	$task = '';
	if($page != 'index'){$task .= ucwords(cleanUp($page)).' :: ';}
	$task .= $qs_name;
	$task .= ' - '.$qs_slogan;
	return $task;
}

// return page breadcrumb
function showBreadcrumb(){
	#collect required data
	$page = getPage();
	global $qs_name;
	global $qs_brand;

	#prepare & return result
	$task = '<a href="'.getSiteURL().'" title="'.$qs_name.'" class="brand">'.$qs_brand.'</a>';
	if($page != 'index'){$task .= ' » <span class="location">'.ucwords(cleanUp($page)).'</span>';}
	return $task;
}

// return responsive date
function showDate(){
	#prepare & return result
	$device = Device::is();
	$task = 'l, F d, Y';
	if($device=='tablet'){$task = 'F d, Y';}
	if($device=='phone'){$task = 'd/m/Y';}
	return date($task);
}

// return greetings
function showGreeting($remark='nope'){
	#prepare
	$hour = date("H");
	if($hour<12){$task = 'Good Morning!';}
	elseif($hour<17){$task = 'Good Afternoon!';}
	else {$task = 'Good Evening!';}

	if($remark=='yeah'){
		$add_remark = '';
		if($hour>2 && $hour<7){$add_remark = "You're up early";}
		elseif($hour>21 || $hour<3){$add_remark = "You're up late";}
		if(!empty($add_remark)){$task = $add_remark.' - <em>'.$task.'</em>';}
	}

	#return result
	return $task;
}

// return copyright
function showCopyright($from='none', $reserved='nope', $to='now'){
	#collect required data
	global $qs_name;
	global $qs_slogan;
	global $qs_acronym;
	global $qs_brand;

	#prepare
	if(empty($from) || $from =='none'){$from = '';} #TO DO (make sure entry is valid date)
	if(empty($to) || $to =='now'){$to = date("Y");}

	$copy ='&copy;';
	$task['link'] ='';

	$task['link'] ='<a href="'.getSiteURL().'" class="brand"';
	$task['link'] .=' title="'.$qs_name;
	if(!empty($qs_slogan)){$task['link'] .=' - '.$qs_slogan;}
	$task['link'] .='">';


	$Brand ='';
	$device = Device::is();
	if($device=='phone'){
		$Brand .=$task['link'];
		if(!empty($qs_acronym)){$Brand .=$qs_acronym;}
	}
	elseif($device=='tablet'){$Brand .=$task['link'].$qs_brand;}
	else{$Brand .=$task['link'].$qs_name;}

	$Brand .='</a>';

	if(empty($from)){$task = $copy.' <small>'.$to.'</small> '.$Brand;}
	else {$task = $copy.' '.$Brand.' <small>'.$from.' - '.$to.'</small>';}
	if(!empty($reserved) && $reserved !='nope'){$task .= '&nbsp; All rights reserved';}

	#return result
	return $task;
}

// markup a link
function makeLink($style, $link, $name='', $tag='', $target='self'){
	return markupLink($link, $name, $tag, $target, $style);
}

// markup group link
function makeLinkGroup($activate, $style, $link, $name='', $tag='', $target='self'){
	return markupLink($link, $name, $tag, $target, $style, $activate);
}

// markup absolute url
function makeLinkAbsolute($style, $link, $name='', $tag='',  $target='_blank', $link_as='absolute'){
	return markupLink($link, $name, $tag, $target, $style, $activate, $link_as);
}





/**================================================================================================
* Class: SESSION
* Objective: Manage PHP session
* Dependency:
*/
class Session {
	private static $instance;
	public static $status;

	private function __construct(){self::$status = 'offline';}


	//Returns an intantiate of class
	public static function instantiate(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return self::$instance;
	}


	//Start session
	public static function start(){
		if(self::$status != 'alive'){
			session_start();
			self::$status = 'alive';
		}

		return;
	}


	//Check if session is online
	public static function online(){
		if(self::$status == 'alive'){return TRUE;}

		return FALSE;
	}


	//Stop session
	public static function stop(){
		if(self::online()){
			self::$status = 'dead';
			session_destroy();
		}

		return;
	}


	//Terminate session
	public static function terminate(){
		if(self::online()){
			$_SESSION = array();
			if(ini_get("session.use_cookies")){
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}
			self::$status = 'dead';
			session_unset();
			session_destroy();
		}

		return;
	}


	//Reset session
	public static function reset(){
		self::terminate();
		self::start();

		return;
	}
}
/** End of Class ================================================================================== */


/**================================================================================================
* Class: DEVICE
* Objective: Manage device detection and rendition settings
* Dependency: Mobile_Detect
*/
#loadFile('plug_detect', 'slice');
class Device {
	private static $instance;

	//Returns an instantiate of class
	public static function instantiate(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}


	//Validate device type
	public static function validate($device=''){
		$devices = array('desktop', 'tablet', 'phone');
		if(!empty($device) && in_array($device, $devices)){return TRUE;}
		return FALSE;
	}


	//Returns device type
	public static function identify(){
		$device = new Mobile_Detect;
		return ($device->isMobile() ? ($device->isTablet() ? 'tablet' : 'phone') : 'desktop');
	}


	//Set device type
	public static function setAs($to='request'){
		Session::Start();
		if($to=='request'){
			if(isset($_REQUEST['v']) && !empty($_REQUEST['v'])){
				if(self::validate($_REQUEST['v'])){return $_SESSION['DeviceIsA'] = $_REQUEST['v'];}
				elseif(!empty($_SESSION['DeviceIsA'])){return $_SESSION['DeviceIsA'];}
				else { return $_SESSION['DeviceIsA'] = self::identify();}
			}
			elseif(!empty($_SESSION['DeviceIsA'])){return $_SESSION['DeviceIsA'];}
			else {return $_SESSION['DeviceIsA'] = self::identify();}
		}
		elseif(self::validate($to)){return $_SESSION['DeviceIsA'] = $to;}
		else {return FALSE;}
	}

	public static function is(){return self::setAs();}
}
/** End of Class ================================================================================== */



	//-------------- Detect HTTPS & Return true or false ---------------
function hasSSL($answer='detect'){
	$resolve = false;
	if($answer == 'yeah'){$resolve = true;}
	elseif($answer == 'nope'){$resolve = false;}
		else {//detect from server
			$https = 'off';
			if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])){$https = $_SERVER['HTTPS'];}
			if($https !== 'off'){$https == 'on';}

			$port = 'default';
			if(isset($_SERVER['SERVER_PORT']) && !empty($_SERVER['SERVER_PORT'])){$port = $_SERVER['SERVER_PORT'];}

			if($https == 'on' || $port == 443){$resolve = true;}
			elseif(!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'){$resolve = true;}
		}
		return $resolve;
	}

	//-------------- Force URL to run HTTPS ---------------
	function imposeSSL($permanent='nope'){
		if(!isset($_SESSION['imposeSSL']) || $_SESSION['imposeSSL'] != 'imposed'){
			$protocol = hasSSL() ? 'https' : 'http';
			if($protocol != 'https'){
				$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				if($permanent == 'yeah'){header('HTTP/1.1 301 Moved Permanently');}
				$_SESSION['imposeSSL'] = 'imposed';
				header('Location: ' . $url);
				exit;
			}
		}
	}
	?>