<?php
//CREATE RECORD
$dataset = array('name' => 'ODAO VAE', 'email' => 'odao@vae24.co.uk', 'phone' => '09057996054', 'sex' => 'male', 'birthdate' => 'October 31, 1987');
$dataset['bind'] = self::bindID();
$field = array('bind','name', 'email', 'sex', 'phone');
$json['OUPUT'] = oCRUD::create($field, $dataset, 'user');


?>