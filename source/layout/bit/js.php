
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



<script src="//code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>