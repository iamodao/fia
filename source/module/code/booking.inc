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

	public static function reservation($filter='', $column='*', $limit=''){
		return oCRUD::read('booking', $filter, $column, $limit);
	}

}
?>