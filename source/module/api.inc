<?php
// The default API controller
class oAPI {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		#oJSON::display($this->{$this->controller}());
		$this->{$this->controller}();
	}

	private function iscontroller(){
		$method = oString::to(fia::route('oAPI'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('api', $method, 'controller required');}
		$this->controller = $method;
	}

	private function bindID(){
		return time().mt_rand(10000,99999);
	}

	public  function sandbox(){
		$dataset = array('name' => 'ODAO VAE', 'email' => 'odao@vae24.in', 'phone' => '09097996052', 'sex' => 'male', 'birthdate' => 'October 31, 1987');
		$field = array('name', 'email', 'sex', 'phone');
		$sb = oCRUD::create($field, $dataset, 'user');
		fia::dump($sb);

	}
}

$runAPI = new oAPI;
?>