
<script src="/asset/vendors/js/vendor.bundle.base.js"></script>
<?php
$js = '';
if(fia::route() == 'dashboard'){
	$js .= '<script src="/asset/vendors/chartjs/Chart.min.js"></script>'."\r\n";
	$js .= '<script src="/asset/vendors/jvectormap/jquery-jvectormap.min.js"></script>'."\r\n";
	$js .= '<script src="/asset/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>'."\r\n";
}
echo $js;
?>
<script src="/asset/js/material.js"></script>
<script src="/asset/js/misc.js"></script>
<?php if(fia::route() == 'dashboard'){echo '<script src="/asset/js/dashboard.js"></script>'."\r\n";}?>
