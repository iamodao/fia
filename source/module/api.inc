<?php
// The default API controller
class oAPI {
	var $controller;

	public function __construct(){
		$this->iscontroller();
		oJSON::display($this->{$this->controller}());
	}

	private function iscontroller(){
		$method = oString::to(fia::route('oAPI'), 'oMETHOD');
		if(empty($method) || !method_exists(__CLASS__, $method)){oExit('api', $method, 'controller required');}
		$this->controller = $method;
	}

	protected function booking(){
		if(!empty($_POST)){
			$_POST['schedule'] = '';
			if(!empty($_POST['schedule_date'])){$_POST['schedule'] .= $_POST['schedule_date'];} else {
				$date = strtotime('Tomorrow');
				$_POST['schedule'] .= date("Y-m-d", $date);
			}
			if(!empty($_POST['schedule_time'])){$_POST['schedule'] .= ' '.$_POST['schedule_time'];} else {$_POST['schedule'] .= ' 09:45:30';}
			$booking = Booking::create($_POST, strtolower($_POST['type']));
			if($booking == true){
				$jsonResp = ['response' => 'success'];
			}
			$jsonResp = ['response' => 'error'];
		}
		else {$jsonResp = ['response' => 'bad request'];}
		echo oJSON::run($jsonResp);
	}
}

$runAPI = new oAPI;
?>