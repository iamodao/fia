<?php
// The default API controller
class oAPI {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		fia::olib('json');
		oJSON::display($this->{$this->controller}());
	}

	private function iscontroller(){
		$method = fia::stringTo(fia::route('oAPI'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('api', $method, 'controller required');}
		$this->controller = $method;
	}

	public  function sandbox(){
		// return array('Name' => 'ODAO VAE');
	}
}

$runAPI = new oAPI;
?>