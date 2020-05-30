<?php
$oInit['FileInit'] = 'fia/init.php';
$oInit['RD'] = __DIR__;
if(!file_exists($oInit['FileInit'])){exit('PATH::Missing [Initializer Required]');}
require $oInit['FileInit'];
if(file_exists('sandbox.php')){require 'sandbox.php';}
?>