<?php
$AU = User::active();
$filter = array();
// $activeUser = strtolower($AU['type']);
// if($activeUser != 'admin'){
// 	$ReservationFor = 'for '.$AU['office'];
// 	// $filter['bind'] = $AU['office'];
// }
$filter['bind'] = $_GET['id'];
$record = Booking::read($filter);
?>
<h1 class="mt-4">Reservation Details</h1>
<div class="card col-md-8">
	<table id="dataTable" class="table table-bordered display" style="width:100%">
		<?php if($record == 'NO_RECORD'){?>
			<tr>
				<td colspan="10" style="text-align: center; color: red;">NO RECORDS FOUND!</td>
			</tr>
		<?php } else {?>
			<tr>
				<th scope="row">Ref ID</th>
				<td><?php echo $record['refid'];?></td>
			</tr>
			<tr>
				<th scope="row">Type</th>
				<td><?php echo $record['type'];?></td>
			</tr>
			<?php
			if(!empty($record['suite'])){?>
				<tr>
					<th scope="row">Suite</th>
					<td><?php echo $record['suite'];?></td>
				</tr>
			<?php } ?>
			<tr>
				<th scope="row">Name</th>
				<td><?php echo $record['name'];?></td>
			</tr>
			<tr>
				<th scope="row">Email</th>
				<td><?php echo $record['email'];?></td>
			</tr>
			<tr>
				<th scope="row">Phone</th>
				<td><?php echo $record['phone'];?></td>

			</tr>
			<tr>
				<th scope="row">Summary</th>
				<td><?php echo nl2br($record['summary']);?></td>

			</tr>
			<tr>
				<th scope="row">Schedule</th>
				<td><?php echo $record['schedule'];?></td>

			</tr>
			<tr>
				<th scope="row">Status</th>
				<td><?php echo $record['status'];?></td>
			</tr>
		<?php }?>
	</table>
</div>
</div>