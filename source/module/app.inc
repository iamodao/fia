<?php
// The default APP controller
class oAPP {
	var $method;
	public function __construct(){
		$this->check_controller();
	}

	private function check_controller(){
		$method = fia::stringTo(fia::route('oAPP'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('app', $method, 'controller required');}
		$this->method = $method;
	}
}
$runAPP = new oAPP;
?>