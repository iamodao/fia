
<script src="/asset/jquery.js" crossorigin="anonymous"></script>
<script src="/asset/bootstrap.js" crossorigin="anonymous"></script>
<script src="/asset/main.js"></script>
<script src="/asset/chart.js" crossorigin="anonymous"></script>
<script src="/asset/chart-area-demo.js"></script>
<script src="/asset/chart-bar-demo.js"></script>
<script src="/asset/jquery.datatables.js" crossorigin="anonymous"></script>
<script src="/asset/datatables.js" crossorigin="anonymous"></script>
<script>
	// Call the dataTables jQuery plugin
	$(document).ready(function() {
		$('#dataTable').DataTable();
	});

	function jsTrash(record, id){
		var decision = confirm("Are you certain?");
		if(decision === true){
			var url = './delete?id='+id+'&oact='+record;
			window.location.href = url;
		}
		return;
	}
</script>