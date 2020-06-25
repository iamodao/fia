
<script src="<?php echo fia::pathTo('ASSET');?>jquery.js" crossorigin="anonymous"></script>
<script src="<?php echo fia::pathTo('ASSET');?>bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo fia::pathTo('ASSET');?>main.js"></script>
<script src="<?php echo fia::pathTo('ASSET');?>chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo fia::pathTo('ASSET');?>chart-area-demo.js"></script>
<script src="<?php echo fia::pathTo('ASSET');?>chart-bar-demo.js"></script>
<script src="<?php echo fia::pathTo('ASSET');?>jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo fia::pathTo('ASSET');?>dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
	// Call the dataTables jQuery plugin
	$(document).ready(function() {
		$('#dataTable').DataTable();
	});
</script>