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
		// $input = array('name' => 'Felix Liberty', 'summary' => 'One Night Stay', 'suite' => '790159301645356');
		// $time = strtotime("+2 days 9:45 AM");
		// $input['schedule'] = date('Y-m-d H:i:s', $time);
		// $input = array('title' => 'Execute', 'price' => 31500);
		$input['suite'] = '790159301645356';
		// $input['type'] = 'salon';
		fia::ocode('booking');
		$sandbox = Booking::read($input, '*', '1, 2  ');
		// $sandbox = Room::delete($input);
		fia::dump($sandbox);
	}
}

$runAPI = new oAPI;
?>