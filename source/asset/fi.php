<?php
class fi {

	protected static $firm;
	protected static $brand;
	protected static $domain;
	protected static $email;
	protected static $phone;
	protected static $RD; #remote directory [root]
	protected static $CD; #content directory [main]
	protected static $imposeSSL;

	private static $db_name;
	private static $db_server;
	private static $db_username;
	private static $db_password;

	public static $db;

	public static function init($data){
		if(!empty($data) && is_array($data)){
			foreach($data as $key => $value){
				if(!empty($data[$key])){
					if($key == 'RD'){
						$value = self::hostdir($value);
						$value = str_replace('//', '/', $value);
					}
					self::${$key} = $value;
				}
			}

			if(!empty(self::$db_name)){
				try {
					$pdo = new PDO('mysql:dbname='.self::$db_name.';host='.self::$db_server, self::$db_username, self::$db_password);
				} catch (PDOException $e) {
					exit('Connection error: ' . $e->getMessage());
				}
				self::$db = $pdo;
			}
		}
	}

	public static function hostdir($file){
		$path = dirname($file);
		$dir = explode("/",$path);
		$count = count($dir);
		return $dir[$count-1];
	}

	public static function erko($data){
		return '<pre><tt>'.var_export($data, true).'</tt></pre>';
	}

	public static function site($fio=''){
		if(!empty($fio)){
			if(property_exists(__CLASS__, $fio)){return self::${$fio};}
			elseif($fio == 'fi_title'){
				$fipage = self::page();
				if($fipage == 'index'){$fip = self::site('firm');}
				else {
					$fip = mb_convert_case($fipage, MB_CASE_TITLE, "UTF-8");
					$fip = str_replace('-',' ', $fip).' - '. self::site('firm');
				}
				return $fip;
			}
			elseif($fio == 'fi_page'){
				$fip = self::page();
				$fip = str_replace('-',' ', $fip);
				if($fip == 'index'){$fip = 'home';}
				return $fip;
			}
		}
	}

	public static function page(){
		if(!empty($_GET['page'])){$res = strtolower($_GET['page']);}
		elseif(!empty($_SERVER['PHP_SELF'])){
			$res = basename(strtolower($_SERVER['PHP_SELF']));
		}

		if(!empty($res)){
			$res = str_replace('.php', '', $res);
			$res = str_replace('/', '', $res);
			return $res;
		}
		return 'index';
	}

	public static function path($input='', $path='bit'){
		if(!empty($input)){
			$res = '';
			$DS = DIRECTORY_SEPARATOR;
			if($input == 'fi_view'){
				$res .= self::$CD."{$DS}view{$DS}";
				$input = self::page();
			}
			elseif(!strpos($DS, $path)){
				$res .= self::$CD.$DS.$path.$DS;
			}
			$res .= $input.'.php';
			$res = str_replace($DS.$DS, $DS, $res);
			return $res;
		}
	}

	public static function load($input='', $path='bit'){
		$res = self::path($input, $path);
		if(file_exists($res)){include $res; return;}
		if($input == 'fi_view'){
			if($path == 'fi_404'){return self::load('404', 'view');}
			else {
				$path = 'view';
				$input = self::page();
			}
		}
		exit('PATH: ['.$path.'/'.$input.'] is unavailable');
	}

	public static function query($sql){
		$res = self::$db->prepare($sql);
		$exec = $res->execute();
		if(!$exec){return false;}
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}


	public static function form($type=''){
		if($type == 'fi_contact'){
			$notice = '<p style="color: #004B8D;">Please complete the form below with correct information to reach us</p>';
			if(!empty($_POST['name'])){
				$notice = '<p style="color:red;">An error occurred...</p>';
				#prepare form input
				$input['name'] = ''; if(!empty($_POST['name'])){$input['name'] = $_POST['name'];}
				$input['email'] = ''; if(!empty($_POST['email'])){$input['email'] = $_POST['email'];}
				$input['phone'] = ''; if(!empty($_POST['phone'])){$input['phone'] = $_POST['phone'];}
				$input['message'] = ''; if(!empty($_POST['message'])){$input['message'] = $_POST['message'];}
				$input['buid'] = mt_rand().date('Ymdhis');

				$sql = "INSERT INTO `inquiry`(`name`, `email`, `phone`, `message`, `buid`) VALUES('".$input['name']."', '".$input['email']."', '".$input['phone']."', '".$input['message']."', '".$input['buid']."')";
				$sendForm = self::query($sql);
				if($sendForm !== false){$notice = '<p style="color:green;">Your message has been sent successfully</p>';}
			} // Contact Us Form
		}
		return $notice;
	}

		//-------------- Detect HTTPS & Return true or false ---------------
	public static function hasSSL($answer='detect'){
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
	public static function imposeSSL($permanent='nope'){
		if(!isset($_SESSION['imposeSSL']) || $_SESSION['imposeSSL'] != 'imposed'){
			$protocol = self::hasSSL() ? 'https' : 'http';
			if($protocol != 'https'){
				$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				if($permanent == 'yeah'){header('HTTP/1.1 301 Moved Permanently');}
				$_SESSION['imposeSSL'] = 'imposed';
				header('Location: ' . $url);
				exit;
			}
		}
	}
}
?>