<?php
class Suite {
	public static function create($input){
		$input['bind'] = oCRUD::bindID();
		$field = array('bind', 'title', 'price', 'stock');
		return oCRUD::create($field, $input, 'suite');
	}


	public static function read($filter='', $column='*', $limit=''){
		return oCRUD::read('suite', $filter, $column, $limit);
	}


	public static function update($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::updateBIND($input, 'suite');}
	}


	public static function delete($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::deleteBIND($input, 'suite');}
	}
}



class Room {
	public static function create($input){
		$input['bind'] = oCRUD::bindID();
		$field = array('bind', 'title', 'suite');
		$room_result = oCRUD::create($field, $input, 'room');
		if($room_result === true){
			$suite['bind'] = $input['suite'];
			$suite_result =  Suite::read($suite, $column='stock', 1);
			$suite['stock'] = $suite_result['stock'] + 1;
			return Suite::update($suite);
		}
		return $room_result;
	}


	public static function read($filter='', $column='*', $limit=''){
		return oCRUD::read('room', $filter, $column, $limit);
	}


	public static function update($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::updateBIND($input, 'room');}
	}


	public static function delete($input, $filter='oBIND'){
		if($filter == 'oBIND'){
			$room = self::read($input, '`suite`');
			if(!empty($room['suite'])){
				$suite['bind'] = $room['suite'];
				$room_result = oCRUD::deleteBIND($input, 'room');
				if($room_result === true){
					$suite_result =  Suite::read($suite, 'stock', 1);
					$suite['stock'] = $suite_result['stock'] - 1;
					if($suite['stock'] < 0){$suite['stock'] = 0;}
					return Suite::update($suite);
				}
				return $room_result;
			}
			return $room;
		}
	}
}
?>