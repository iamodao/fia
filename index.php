<?php
$oInit['RD'] = __DIR__;
$oInit['FileInit'] = $oInit['RD'].'/source/fia.init.php';
if(!file_exists($oInit['FileInit'])){exit('PATH::Missing [Initializer Required]');}
require $oInit['FileInit'];
if(file_exists('sandbox.php')){require 'sandbox.php';}
if(isset($fia) && class_exists('fia') && method_exists('fia', 'router')){$fia->orouter();}
?>