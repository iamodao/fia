<?php
// $fia->dump($fia->dbo_query('SELECT * FROM `firm` WHERE `id` > 30'));
#$query = $fia->dbo_query('SELECT * FROM `firm` WHERE `id` > 30');

// $fetch = $query->fetch(PDO::FETCH_ASSOC);
// $record = $query['oRESULT'];
// foreach ($record as $key => $row){
// 	foreach ($row as $label => $value) {
// 		echo strtoupper($label).': '.$value.'<br>';
// 	}
// 	echo '<hr>';
// }


// $demo = $fia->resetPKSQL('firm', 'id');
// $q = "INSERT INTO `firm` (`name`) VALUES ('Jerry Gyang')";
// $q = "UPDATE `firm` SET `email` = 'info@jerry.com' WHERE `id` > 31";
// $q = "DELETE FROM `firm` WHERE `id` > 30";
$q = "SELECT * FROM `firmz` WHERE `id` > 31";
$demo = $fia->runSQL($q);
$fia->dump($demo);
exit();
?>