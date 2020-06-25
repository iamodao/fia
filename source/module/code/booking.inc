<?php
class Booking {
	public static function create($input, $type='room'){
		$input['bind'] = oCRUD::bindID();
		$input['refid'] = mt_rand(1000,9999);
		$input['type'] = strtoupper($type);
		$field = array('bind', 'refid', 'type', 'name', 'email', 'phone', 'address', 'sex', 'summary', 'schedule');
		if($type == 'room'){$field[] = 'suite';}
		return oCRUD::create($field, $input, 'booking');
	}

	public static function read($filter='', $column='*', $limit=''){
		return oCRUD::read('booking', $filter, $column, $limit);
	}

	public static function update($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::updateBIND($input, 'booking');}
	}


	public static function delete($input, $filter='oBIND'){
		if($filter == 'oBIND'){return oCRUD::deleteBIND($input, 'booking');}
	}

}
?>