<?php
$AU = User::active();
$ReservationFor = '';
$filter = array();
$activeUser = strtolower($AU['type']);
if($activeUser != 'admin'){
	$ReservationFor = 'for '.$AU['office'];
	$filter['type'] = $AU['office'];
}
$record = Booking::read($filter);
?>

<div class="card mb-4">
	<div class="card-header">
		<i class="fas fa-table mr-1"></i>
		Reservations <?php echo $ReservationFor;?>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="width:30px;">S/N</th>
						<th class="left">NAME</th>
						<th style="width:140px;" class="left">PHONE</th>
						<?php if(strtolower($activeUser) == 'admin'){?>
							<th style="width:60px;">TYPE</th>
						<?php } ?>
						<?php if(strtolower($AU['office']) == 'room' || strtolower($activeUser) == 'admin'){?>
							<th style="width:60px;">SUITE</th>
						<?php } ?>

						<th style="width:60px;">STATUS</th>
						<th style="width:160px;">SCHEDULE</th>
						<?php if(strtolower($activeUser) == 'admin'){?>

							<th style="width:120px;" colspan="3">MANAGE</th>
						<?php } else {?>
							<th style="width:120px;" colspan="2">MANAGE</th>
						<?php } ?>
					</tr>
				</thead>

				<tbody>
					<?php if($record == 'NO_RECORD'){?>
						<tr>
							<td colspan="10" style="text-align: center; color: red;">NO RECORDS FOUND!</td>
						</tr>
					<?php } else {
						if(fia::isArrayMulti($record) === true){
							foreach ($record as $row){?>
								<tr>
									<td class="right"><?php echo fia::counter();?></td>
									<td class="left"><?php echo $row['name'];?></td>
									<td><?php echo $row['phone'];?></td>
									<?php if(strtolower($activeUser) == 'admin'){?>
										<td class="center"><?php echo $row['type'];?></td>
									<?php } ?>
									<?php if(strtolower($AU['office']) == 'room' || strtolower($activeUser) == 'admin'){?>
										<td class="center"><?php echo $row['suite'];?></td>
									<?php } ?>

									<td class="center"><?php echo $row['status'];?></td>
									<td class="center"><?php echo $row['schedule'];?></td>
									<td style="width:40px;"><a href="./booking-details?id=<?php echo $row['bind'];?>" class="text-info">View</a></td>
									<td style="width:40px;"><a href="./update-booking?id=<?php echo $row['bind'];?>" class="text-warning">Update</a></td>
									<?php if(strtolower($activeUser) == 'admin'){?>
										<td style="width:40px;"><a href="#" class="text-danger" onclick="return jsTrash('booking', <?php echo $row['bind'];?>);">Delete</a></td>
									<?php }?>
								</tr>
							<?php } } else {$row = $record;?>
								<tr>
									<td class="right"><?php echo fia::counter();?></td>
									<td class="left"><?php echo $record['name'];?></td>
									<td><?php echo $record['phone'];?></td>
									<?php if(strtolower($activeUser) == 'admin'){?>
										<td class="center"><?php echo $record['type'];?></td>
									<?php } ?>
									<?php if(strtolower($AU['office']) == 'room' || strtolower($activeUser) == 'admin'){?>
										<td class="center"><?php echo $row['suite'];?></td>
									<?php } ?>
									<td class="center"><?php echo $record['status'];?></td>
									<td class="center"><?php echo $record['schedule'];?></td>
									<td style="width:40px;"><a href="./booking-details?id=<?php echo $record['bind'];?>" class="text-info">View</a></td>
									<td style="width:40px;"><a href="./update-booking?id=<?php echo $record['bind'];?>" class="text-warning">Update</a></td>
									<?php if(strtolower($activeUser) == 'admin'){?>
										<td style="width:40px;"><a href="#" class="text-danger" onclick="return jsTrash('booking', <?php echo $record['bind'];?>);">Delete</a></td>
									<?php } ?>
								</tr>
							<?php }  }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
