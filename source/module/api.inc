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



	public  function sandbox(){
		// oSQL::reset('room', 'id');
		// $input = array('title' => '207', 'suite' => '442159301116415');
		// $input = array('title' => 'Execute', 'price' => 31500);
		// $input['bind'] = '521159302093145';
		// // $input['id'] = 1;
		// fia::ocode('suite');
		// // $sandbox = Room::create($input);
		// $sandbox = Room::delete($input);
		// fia::dump($sandbox);
	}
}

$runAPI = new oAPI;
?>