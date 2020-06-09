<?php
echo '<p><strong>DEV SANDBOX</strong></p>';



$fia->sessionStart('BRIANx');
$demo['Session ID'] = $fia->sessionID('oGET');
$res['BRIANx'] = array_merge($demo, $_SESSION);


$fia->sessionStart('ODAOx');
$demo['Session ID'] = $fia->sessionID('oGET');
$res['ODAOx'] = array_merge($demo, $_SESSION);


$fia->sessionStart('TONYx');
$demo['Session ID'] = $fia->sessionID('oGET');
$res['TONYx'] = array_merge($demo, $_SESSION);


$fia->sessionStop();


$j['Name'] = 'John Doe';
$j['Email'] = 'john@doe.co';
$j['DOB']['Date'] = '14';
$j['DOB']['Month'] = 'Febuary';
$j['DOB']['Year']['Real'] = '1991';
$j['DOB']['Year']['Fake'] = '1995';

fia::dump($j);
// fia::dump(get_class_vars('fia'));
exit();
?>