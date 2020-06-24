<?php
class Suite {
	public static function create($input){
		$input['bind'] = oCRUD::bindID();
		$field = array('bind', 'title', 'price');
		return oCRUD::create($field, $input, 'suite');
	}
}
?>