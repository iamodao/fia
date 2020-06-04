<?php
if(!isset($_SESSION)){session_start();}
require('config.php');
require('qs.php');
imposeSSL();
if(!function_exists("GetSQLValueString")){
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
		global $connect;
		if (PHP_VERSION < 6){
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}
		$theValue = mysqli_real_escape_string($connect, $theValue);
		switch ($theType){
			case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "long":
			case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
			case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
		}
		return $theValue;
	}
}

$currentPage = $_SERVER["PHP_SELF"];

$loginFormAction = $_SERVER['PHP_SELF'];
if(isset($_GET['accesscheck'])){$_SESSION['PrevUrl'] = $_GET['accesscheck'];}

$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){$logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);}

$editFormAction = $_SERVER['PHP_SELF'];
if(isset($_SERVER['QUERY_STRING'])){$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);}


$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

if(!function_exists('isAuthorized')){
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup){
		$isValid = false;
		if(!empty($UserName)) {
			$arrUsers = Explode(",", $strUsers);
			$arrGroups = Explode(",", $strGroups);
			if (in_array($UserName, $arrUsers)){
				$isValid = true;
			}
			if (in_array($UserGroup, $arrGroups)){
				$isValid = true;
			}
			if (($strUsers == "") && true){
				$isValid = true;
			}
		}
		return $isValid;
	}
}

/** UTILITY FUNCTIONS **/
function runQuery($query, $record='fetchAll'){
	global $connect; $result = false;
	$data = mysqli_query($connect, $query) or die(mysqli_error($connect));

	if($record == 'totalRows'){$result = mysqli_num_rows($data);}
	elseif($record == 'affectedRows'){$result = mysqli_affected_rows($connect);}
	elseif($record == 'fetchAll' || $record == 'fetchRow'){
		$rows = array();
		while ($row = mysqli_fetch_assoc($data)){$rows[] = $row;}
		$result['rows'] = $rows;
		$result['totalRows'] = mysqli_num_rows($data);
	}
	elseif(!empty($record)){
		$row = mysqli_fetch_assoc($data);
		$result = $row[$record];
	}

	if($record == 'fetchRow'){
		$result = $result['rows'];
		if(!empty($result)){$result = $result[0];}
	}
	return $result;
}


function recordExist($filter='', $table='', $value=''){
	global $database; global $connect;
	$query = sprintf("SELECT `".$filter."` FROM `".$table."` WHERE `".$filter."` = %s", GetSQLValueString($value, "text"));
	$totalRows = runQuery($query, 'totalRows');
	if($totalRows > 0){return true;}
	return false;
}

function isActivePage($page=''){
	$activePage = $_SERVER['PHP_SELF'];
	$activePage = basename($activePage);
	if($page == $activePage){return true;}
	return false;
}

function cssActive($page=''){
	$output = '';
	if(isActivePage($page)){$output .= ' class="active"';}
	return $output;
}

function currencyToSymbol($currency=''){
	$currency = strtolower($currency); $symbol = '';
	if($currency == 'dollar'){$symbol = '$';}
	if($currency == 'pound'){$symbol = '£';}
	if($currency == 'euro'){$symbol = '€';}
	if($currency == 'yen'){$symbol = '¥';}
	if($currency == 'yuan'){$symbol = '¥';}
	if($currency == 'rupee'){$symbol = '₹';}
	if($currency == 'naira'){$symbol = '₦';}
	return $symbol;
}

function numFormat($number=''){
	if(is_numeric($number)){return number_format($number, 2);}
	else {return $number;}
}

function dateAs($date='', $type=''){
	$result = $date;
	$date = strtotime($date);
	if($type == 'MySQL_DateTime'){$result = date("Y-m-d H:i:s", $date);}
	if($type == 'MySQL_Date'){$result = date("Y-m-d", $date);}
	if($type == 'MySQL_Time'){$result = date("H:i:s", $date);}
	if($type == 'oDate'){$result = date("d-M-Y", $date);}
	if($type == 'oDateAlt'){$result = date("d/m/Y", $date);}
	return $result;
}

function randomize($return=''){
	$alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$alpha_s = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

	if($return == 'trasno'){
		$random = array_rand($alpha, 3);
		$randomize = mt_rand(10000, 99999).$alpha[$random[0]].$alpha[$random[1]].$alpha[$random[2]].mt_rand(100, 999);
	}
	if($return == 'buid'){$randomize = mt_rand(10000000, 99999999);}
	if($return == 'accountno'){$randomize = mt_rand(10000000, 99999999).mt_rand(00,99);}
	if($return == 'swift'){
		$random = array_rand($alpha, 5);
		$randomize = $alpha[$random[0]].$alpha[$random[1]].$alpha[$random[2]].$alpha[$random[3]];
	}
	if($return == 'image'){
		$alphabet = array_merge($alpha, $alpha_s);
		$random = array_rand($alphabet, 10);
		$randomize = $alphabet[$random[0]].$alphabet[$random[1]].$alphabet[$random[2]];
		$randomize .= mt_rand(1000, 9999).$alphabet[$random[3]].$alphabet[$random[4]].$alphabet[$random[5]];
		$randomize .= $alphabet[$random[9]].mt_rand(1, 999).$alphabet[$random[6]].$alphabet[$random[7]].$alphabet[$random[8]];
	}
	return $randomize;
}

function retainInput($field='', $method='post'){
	$value = '';
	if(!isEmpty($field)){
		if($method == 'post'){if(isset($data[$field])){$value = $data[$field];}}
		if($method == 'get'){if(isset($_GET[$field])){$value = $_GET[$field];}}
		if($method == 'request'){if(isset($_REQUEST[$field])){$value = $_REQUEST[$field];}}
	}
	return $value;
}

function retainSelect($value='', $field='', $method='post'){
	$input = retainInput($field);
	if(is_array($input) && in_array($value, $input)){return true;}
	return false;
}

function fileUploadErrorMsg($code){
	//errors
	$errors = array (
		// 0 => 'There is no error, the file uploaded with success',
		1 => 'The selected file size is too large',
		2 => 'The selected file exceeds the maximum allowed size',
		3 => 'The file was only partially uploaded',
		4 => 'No file was uploaded',
		6 => 'Missing a temporary folder',
		7 => 'Failed to write file to disk.',
		8 => 'A PHP extension stopped the file upload.');

	if($code == 1 || $code == 2){
		return 'The selected file for upload is too large';
	}
	return $errors[$code];
}





/** APP-RELATED FUNCTIONS **/
function firm($record='fetchRow'){
	$query = "SELECT * FROM `firm` ORDER BY `id` DESC LIMIT 1";
	return runQuery($query, $record);
}

function imgPass($passport=''){
	$img ='../brux/upload/'.$passport;
	if(!file_exists($img)){$img = '../brux/noimg.jpg';}
	else {$img = $img;}
	return $img;
}

function doAccountNo(){
	$accountno = getClient('accountno');
	if(empty($accountno)){$accountno = randomize('accountno');}
	return $accountno;
}

function calcTransBal($user=''){
	global $connect;
	$qryCR = "SELECT SUM(`amount` ) AS `credit` FROM `transaction` WHERE `type` = 'CR' AND `user` ='$user'";
	$qryDR = "SELECT SUM(`amount` ) AS `debit` FROM `transaction` WHERE `type` = 'DR' AND `user` ='$user'";
	$dataCR = mysqli_query($connect, $qryCR) or die(mysqli_error($connect));
	$dataDR = mysqli_query($connect, $qryDR) or die(mysqli_error($connect));
	$rowdataCR = mysqli_fetch_assoc($dataCR);
	$rowdataDR = mysqli_fetch_assoc($dataDR);
	$calcTransBal = array_merge($rowdataCR, $rowdataDR);
	return ($calcTransBal['credit'] - $calcTransBal['debit']);
}

function transBal($id, $user){
	global $connect;
	$qryCR = "SELECT SUM(`amount` ) AS `credit` FROM `transaction` WHERE `type` = 'CR' AND `user` ='$user' AND `id` <='$id'";
	$qryDR = "SELECT SUM(`amount` ) AS `debit` FROM `transaction` WHERE `type` = 'DR' AND `user` ='$user' AND `id` <='$id'";
	$dataCR = mysqli_query($connect, $qryCR) or die(mysqli_error($connect));
	$dataDR = mysqli_query($connect, $qryDR) or die(mysqli_error($connect));
	$rowdataCR = mysqli_fetch_assoc($dataCR);
	$rowdataDR = mysqli_fetch_assoc($dataDR);
	$calcTransBal = array_merge($rowdataCR, $rowdataDR);
	return ($calcTransBal['credit'] - $calcTransBal['debit']);
}


function updateAccBal($amount, $value, $column){
	global $connect;
	$updateSQL = sprintf("UPDATE `client` SET `accbal`=%s WHERE `".$column."`=%s",
		GetSQLValueString($amount, "text"),
		GetSQLValueString($value, "text"));
	mysqli_query($connect, $updateSQL) or die(mysqli_error($connect));
}


function updateTransBal($user){
	global $connect;

	#Get ID of most recent transaction belonging to the user
	$query = "SELECT `id` FROM `transaction` WHERE `user` = '".$user."' ORDER BY `id` DESC";
	$lastTrans = runQuery($query, 'fetchRow');
	$lastTransID = $lastTrans['id'];

	#Get ID of next transaction's balance to be updated (belonging to user)
	$nextID = $lastTransID;
	for($count = 1; $count <= $lastTransID; $count++){
		$transBal = transBal($nextID, $user);
		$updateSQL = sprintf("UPDATE `transaction` SET `balance`=%s WHERE `id`=%s AND `user` ='$user'",
			GetSQLValueString($transBal, "text"),
			GetSQLValueString($nextID, "text"),
			GetSQLValueString($user, "text"));
		mysqli_query($connect, $updateSQL) or die(mysqli_error($connect));
		$nextID = $nextID - 1;
	}
}



/** MANAGER FUNCTIONS **/
function totalClient(){
	global $connect;
	$query_data = "SELECT `uname` FROM `client` ORDER BY `id` DESC";
	$data = mysqli_query($connect, $query_data) or die(mysqli_error($connect));
	$row_data = mysqli_fetch_assoc($data);
	$totalRows_data = mysqli_num_rows($data);
	mysqli_free_result($data);
	return $totalRows_data;
}

function totalTransfer(){
	global $connect;
	$query_data = "SELECT * FROM `transfer` ORDER BY `id` DESC";
	$data = mysqli_query($connect, $query_data) or die(mysqli_error($connect));
	$row_data = mysqli_fetch_assoc($data);
	$totalRows_data = mysqli_num_rows($data);
	return $totalRows_data;
	mysqli_free_result($data);
}

function getClient($record='', $filter='user'){
	global $connect;
	$column = 'id'; $value = "-1";

	if($filter == 'user'){
		$column = 'uname'; if(isset($_GET['ClientID'])){$value = $_GET['ClientID'];}
	}

	$query_data = sprintf("SELECT * FROM `client` WHERE `$column` = %s", GetSQLValueString($value, "text"));
	$data = mysqli_query($connect, $query_data) or die(mysqli_error($connect));
	$row_data = mysqli_fetch_assoc($data);
	$totalRows_data = mysqli_num_rows($data);
	mysqli_free_result($data);
	if($record == 'totalRows'){return $totalRows_data;}
	elseif(!empty($record)){return $row_data[$record];}
}



function webAdmin($record=''){
	global $connect;
	$query_data = "SELECT * FROM `mang` WHERE `type` = 'webadmin' ORDER BY id ASC";
	$data = mysqli_query($connect, $query_data) or die(mysqli_error($connect));
	$row_data = mysqli_fetch_assoc($data);
	$totalRows_data = mysqli_num_rows($data);
	if($record == 'totalRows'){return $totalRows_data;}
	elseif(!empty($record)){return $row_data[$record];}
	mysqli_free_result($data);
}

function admin($record=''){
	$colname_data = "-1"; if(isset($_SESSION['MM_Username'])){$colname_data = $_SESSION['MM_Username'];}
	global $connect;
	$query_data = sprintf("SELECT * FROM `mang` WHERE email = %s", GetSQLValueString($colname_data, "text"));
	$data = mysqli_query($connect, $query_data) or die(mysqli_error($connect));
	$row_data = mysqli_fetch_assoc($data);
	$totalRows_data = mysqli_num_rows($data);
	mysqli_free_result($data);
	if($record == 'totalRows'){return $totalRows_data;}
	elseif(!empty($record)){return $row_data[$record];}
}



/** CLIENT FUNCTIONS **/
function clientActive($record='fetchAll'){
	$username = "-1"; if(isset($_SESSION['MM_Username'])){$username = $_SESSION['MM_Username'];}
	$query = sprintf("SELECT * FROM `client` WHERE `uname` = %s", GetSQLValueString($username, "text"));
	return runQuery($query, $record);
}

function clientManager($record=''){
	$query = "SELECT * FROM `mang` WHERE `type` != 'webadmin' AND `rank` = 'default' ORDER BY `id` LIMIT 1";
	return runQuery($query, $record);
}

function clientTransfer($user='', $record='fetchAll', $isPending = ''){
	$query = "SELECT * FROM `transfer` WHERE `user` = '".$user."'";
	if($isPending == 'yeah'){$query .= " AND `status` = 'pending'";}
	$query .= " ORDER BY `id` DESC";
	return runQuery($query, $record);
}

function clientTransaction($user='', $record='fetchAll'){
	$query = "SELECT * FROM `transaction` WHERE `user` = '".$user."' ORDER BY `id` DESC";
	return runQuery($query, $record);
}

function getTransfer($filter='', $value='', $record=''){
	global $database; global $connect;
	$query = sprintf("SELECT * FROM `transfer` WHERE `".$filter."` = %s", GetSQLValueString($value, "text"));
	$result = runQuery($query, $record);
	if(!empty($result)){return $result;}
	return false;
}

function getBilling($filter='', $value='', $record='fetchRow'){
	global $database; global $connect;
	if($filter == 'default'){$query = "SELECT * FROM `billing` ORDER BY `id` ASC LIMIT 1";}
	else {$query = sprintf("SELECT * FROM `billing` WHERE `".$filter."` = %s", GetSQLValueString($value, "text"));}
	$result = runQuery($query, $record);
	if(!empty($result)){return $result;}
	return false;
}

function billingNext($buid='', $transferID=''){
	global $database; global $connect;
	$query = sprintf("SELECT * FROM `billing` WHERE `buid` = %s", GetSQLValueString($buid, "text"));
	$result = runQuery($query, 'fetchRow');
	if(!empty($result)){
		if($result['next'] != 'completed'){
			$query_next = sprintf("SELECT * FROM `billing` WHERE `buid` = %s", GetSQLValueString($result['next'], "text"));
			$next = runQuery($query_next, 'fetchRow');
			if(!empty($next)){
				$billingNext['msg'] = '<span class="bg-iwarning text-uppercase ibox-10">'.$next['statement'].'</span>';
				$billingNext['url'] = 'next.php?transferID='.$transferID.'&ID='.$next['buid'];
			}
		} else {
			$billingNext['msg'] = '<span class="bg-success text-uppercase ibox-10">Transfer Completed</span>';
			$billingNext['url'] = 'completed.php?transferID='.$transferID;
		}
		return $billingNext;
	}

	return false;
}
















/**================================================
	ACCOUNT SECTION
	================================================**/

	function createTransfer($data){
		$buid = randomize('buid');
		global $userInfo;
		$insertSQL = sprintf("INSERT INTO `transfer` (`buid`, `user`, `amount`, `account`, `holder`, `bank`, `location`)
			VALUES (%s, %s, %s, %s, %s, %s, %s)",
			GetSQLValueString($buid, "text"),
			GetSQLValueString($userInfo['uname'], "text"),
			GetSQLValueString($data['amount'], "text"),
			GetSQLValueString($data['account'], "text"),
			GetSQLValueString($data['holder'], "text"),
			GetSQLValueString(rewriteRH($data['bank']), "text"),
			GetSQLValueString($data['location'], "text"));
		$insert = runQuery($insertSQL, 'affectedRows');
		if($insert == 1){
			$updateSQL = "UPDATE `client` SET `outgo` = '".$data['amount']."' WHERE `uname` = '".$userInfo['uname']."'";
			$update = runQuery($updateSQL, 'affectedRows');

			if($userInfo['billing'] == 'nobill'){
				header("Location: splash.auto.php?transferID=".$buid);
				exit();
			} else {
				header("Location: splash.php?transferID=".$buid);
				exit();
			}
		}
	}

	function isTransfer($buid){
		$query = sprintf("SELECT * FROM `transfer` WHERE `buid` = %s", GetSQLValueString($buid, "text"));
		$result = runQuery($query, 'totalRows');
		if(!empty($result)){return true;}
		return false;
	}

	function validateTransfer(){
	// when transaction id is not set on URL
		if(empty($_GET['transferID'])){
			echo '<meta http-equiv="Refresh" content="3; URL=dashboard.php">';
			$msg = '<p class="text-danger" style="margin: 100px auto; text-align: center">You do not have any transfer selected</p>';
			return $msg;
		}
	// when transaction id is set on URL but not valid
		elseif(!isTransfer($_GET['transferID'])){
			echo '<meta http-equiv="Refresh" content="3; URL=dashboard.php">';
			$msg = '<p class="text-danger" style="margin: 100px auto; text-align: center">You are attempting to process a transaction that does not exist</p>';
			return $msg;
		}
	}

	function transferProcess(){
		$result = false;
		if(!empty($_GET['transferID'])){
			$transfer = getTransfer('buid', $_GET['transferID'], 'fetchRow');
			if(!empty($transfer['process_serial'])){
				$result = $transfer['process_serial'];
			}
		}
		return $result;
	}

	function transferBilling(){
		$billing = false;
		global $userInfo;
		if(transferProcess() == 'default'){
			if($userInfo['billing'] == 'default'){
				$billing = getBilling('default', '', 'fetchRow');
			}
			else {
				$billing = getBilling('buid', $userInfo['billing'], 'fetchRow');
			}
		}
		else {
			$billing = getBilling('buid', transferProcess(), 'fetchRow');
		}
		return $billing;
	}

	function validateSplash(){
		if(empty($_GET['transferID'])){
			echo '<meta http-equiv="Refresh" content="3; URL=dashboard.php">';
			return $msg = '<p class="text-danger" style="margin: 100px auto; text-align: center">You do not have any transfer selected</p>';
		} else {
			$splashURL = 'splash.php?transferID='.$_GET['transferID'];
			header("Location: ". $splashURL);
		}
	}


	function validateBilling(){
		$query = sprintf("SELECT * FROM `billing` WHERE `buid` = '".$_POST['billing']."' AND `value` = %s", GetSQLValueString($_POST['value'], "text"));
		$result = runQuery($query, 'fetchRow');
		if(!empty($result)){return $result;}
		return false;
	}

	function AuthSend($data){
		$to = $data['name'].'<'.$data['email'].'>';
		$subject = 'Re: Authentication - '.$data['otpcode'];
		$message = '<p>Hello <b>'.$data['name'].'</b>,<br><br>Your authentication confirmation code is: '.$data['otpcode'].'<br>Use this code to login your account. We will never ask you to share this code with anyone.<br><br><br>Kind Regards<br>Deniz Royal Group<br><i>Customer Support Desk</i></p>';
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		$headers[] = 'From: Deniz Royal Group<alert@denizroyalgroup.com>';
		if(mail($to, $subject, $message, implode("\r\n", $headers), '-fwebmaster@denizroyalgroup.com')){return true;}
		return false;
	}
	?>