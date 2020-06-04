<?php

$demo = array('FirstName' => 'Anthony', 'LastName' => 'Osawere');
fia::json($demo, 'oPRINT');


echo '<b>QUERY DEBURGING'.'</b><br>';

#$demo = $fia->resetSQL('firm', 'id');

$qry = "DELETE FROM `firm` WHERE `id` > 30";
$qry = "INSERT INTO `firm` (`name`) VALUES ('Jerry Gyang')";
$qry = "UPDATE `firm` SET `email` = 'info@jerry.com' WHERE `id` > 31";
$qry = "SELECT * FROM `firm` WHERE `id` > 50";

$demo = $fia->querySQL($qry);
$fia->dump($demo);
exit();
?>