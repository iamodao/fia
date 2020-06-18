<?php
$record = bookingApp::Employees();
?>
<table id="dataTable" class="display" style="width:100%">
	<thead>
		<tr>
			<th class="col-md-6">S/N</th>
			<th>Name</th>
			<th>Phone</th>
			<th>Usernam</th>
			<th>Type</th>
			<th>Manage</th>
		</tr>
	</thead>
	<tbody>

		<?php if($record == 'NO_RECORD'){?>
			<tr>
				<td colspan="7" style="text-align: center; color: red;">NO RECORDS</td>
			</tr>
		<?php } else {
			if(fia::isArrayMulti($record) === true){
				foreach ($record as $row){?>
					<tr>
						<td><?php echo fia::counter();?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['phone'];?></td>
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['type'];?></td>
						<td></td>
					</tr>
				<?php } } else {?>
					<tr>
						<td><?php echo fia::counter();?></td>
						<td><?php echo $record['name'];?></td>
						<td><?php echo $record['phone'];?></td>
						<td><?php echo $record['username'];?></td>
						<td><?php echo $row['type'];?></td>
						<td></td>
					</tr>
				<?php }  }?>
			</tbody>
		</table>