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
		$input = array('name' => 'Jerry Markus', 'summary' => 'Hair Cut');
		$time = strtotime("+2 days 9:45 AM");
		$input['schedule'] = date('Y-m-d H:i:s', $time);
		// $input = array('title' => 'Execute', 'price' => 31500);
		// $input['bind'] = '521159302093145';
		// // $input['id'] = 1;
		fia::ocode('booking');
		$sandbox = Booking::create($input, 'salon');
		// $sandbox = Room::delete($input);
		fia::dump($sandbox);
	}
}

$runAPI = new oAPI;
?>