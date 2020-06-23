<?php
$activeUser = new ActiveUser;
if(strtolower($activeUser->type) != 'admin'){
	$filter['type'] = $activeUser->office;
	$record = Booking::reservations($filter);
}
else {
	$record = Booking::reservations();
}
?>
<table id="dataTable" class="display" style="width:100%">
	<thead>
		<tr>
			<th style="width:30px;">S/N</th>
			<th class="left">NAME</th>
			<th style="width:140px;" class="left">PHONE</th>
			<?php if(strtolower($activeUser->type) == 'admin'){?>
				<th style="width:60px;">TYPE</th>
			<?php } ?>
			<th style="width:60px;">STATUS</th>
			<th style="width:160px;">SCHEDULE</th>
			<th style="width:120px;" colspan="3">MANAGE</th>
		</tr>
	</thead>
	<tbody>

		<?php if($record == 'NO_RECORD'){?>
			<tr>
				<td colspan="10" style="text-align: center; color: red;">NO RECORDS</td>
			</tr>
		<?php } else {
			if(fia::isArrayMulti($record) === true){
				foreach ($record as $row){?>
					<tr>
						<td class="right"><?php echo fia::counter();?></td>
						<td class="left"><?php echo $row['name'];?></td>
						<td><?php echo $row['phone'];?></td>
						<?php if(strtolower($activeUser->type) == 'admin'){?>
							<td class="center"><?php echo $row['type'];?></td>
						<?php } ?>
						<td class="center"><?php echo $row['status'];?></td>
						<td class="center"><?php echo $row['schedule_date'].' '.$row['schedule_time'];?></td>
						<td style="width:40px;">View</td>
						<td style="width:40px;">Edit</td>
						<td style="width:40px;">Delete</td>
					</tr>
				<?php } } else {?>
					<tr>
						<td class="right"><?php echo fia::counter();?></td>
						<td class="left"><?php echo $record['name'];?></td>
						<td><?php echo $record['phone'];?></td>
						<?php if(strtolower($activeUser->type) == 'admin'){?>
							<td class="center"><?php echo $record['type'];?></td>
						<?php } ?>
						<td class="center"><?php echo $record['status'];?></td>
						<td class="center"><?php echo $record['schedule_date'].' '.$record['schedule_time'];?></td>
						<td style="width:40px;">View</td>
						<td style="width:40px;">Edit</td>
						<td style="width:40px;">Delete</td>
					</tr>
				<?php }  }?>
			</tbody>
		</table>