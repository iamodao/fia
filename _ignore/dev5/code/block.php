<?php
$_REQUEST['oURI'] = $_SERVER['REQUEST_URI']; echo __FILE__.'<pre>'.var_export($_REQUEST, TRUE).'</pre>';
echo '<pre>'.var_export($oInit, TRUE).'</pre>';
?>

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


$email = 'wayne@johnson.co';
$insV = array(':name' => 'Wayne Johnson', ':email' => $email, ':phone' => '0909766534');
$q = "INSERT INTO `firm`(name, email, phone) VALUES (:name, :email, :phone)";
$demo = $fia->runSQL($q, $insV);


	// $time = strtotime("+2 days 9:45 AM");
		// $input['schedule'] = date('Y-m-d H:i:s', $time);
?>