<?php
class User {
	public static function read($filter='', $column='*', $limit=''){
		return oCRUD::read('user', $filter, $column, $limit);
	}
}
?>