<?php
// The default API controller
class oAPI {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		// oJSON::display($this->{$this->controller}());
		$this->{$this->controller}();
	}

	private function iscontroller(){
		$method = oString::to(fia::route('oAPI'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('api', $method, 'controller required');}
		$this->controller = $method;
	}

	private function bindID(){
		return mt_rand(100,999).time().mt_rand(10,99);
	}

	public  function sandbox(){
		$sb = oCRUD::exist('email', 'odao@vae24.ng', 'user');
		fia::dump($sb);
	}
}

$runAPI = new oAPI;
?>