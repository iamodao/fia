<?php
// app primary controller
class oAPP {
	public function __construct(){
		$method = fia::route();
		if(!empty($method) && method_exists(__CLASS__, $method)){
			return $this->$method();
		}
	}

	public function index(){
		echo 'INDEX on APP';
	}
}

$runApp = new oAPP;
?>