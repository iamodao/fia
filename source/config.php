<?php
#GENERAL CONFIGURATION
$o_config = array(
	'machine' => 'oDEV',
	'status' => 'oLIVE',
	'timezone' => 'Europe/London',
	'https' => 'impose',
	'session' => 'oSESSID',
);


#PROJECT INFORMATION
$o_config['oPROJECT'] = array(
	'firm' => 'VERI8™ Inc.',
	'name' => 'FIA Framework',
	'brand' => 'FIA™',
	'domain' => 'fia.go',
	'url' => 'https://www.fia.go',
	'email' => 'admin@fia.go',
	'phone' => '+234 (0) 809-123-7654',
	'version' => 'eVOLVE',
	'routing' => 'oAUTO',
);


#DATABASE INFORMATION
$o_config['oDATABASE'] = array(
	'host' => 'localhost',
	'name' => 'fia_db',
	'user' => 'fia',
	'password' => 'FIA'
);
/**
 * NOTE: $o_config['oDATABASE'] triggers DB connection by default
 **/
?>