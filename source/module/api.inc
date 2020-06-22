<?php
// The default API controller
class oAPI {
	var $method;
	public function __construct(){
		$this->check_controller();
	}

	private function check_controller(){
		$method = fia::stringTo(fia::route('oAPI'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('api', $method, 'controller required');}
		$this->method = $method;
	}
}
$runAPI = new oAPI;
?>