<?php
$AU = User::active();
$record = User::read(array('type' => 'STAFF'));
?>

<h1 class="mt-4">Staffs</h1>
<div class="card mb-4">
	<div class="card-header"><i class="fas fa-table mr-1"></i> Staffs</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="width:30px;">S/N</th>
						<th style="width:230px;" class="vae-left">NAME</th>
						<th style="width:90px;" class="vae-left">USERNAME</th>
						<th style="width:70px;" class="vae-left">OFFICE</th>
						<th style="width:90px;" class="vae-right">PHONE</th>
						<th style="width:80px;" class="vae-center">STATUS</th>
						<th style="width:120px;" colspan="3">MANAGE</th>
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
									<td class="vae-right"><?php echo fia::counter();?></td>
									<td class="vae-left"><?php echo $row['name'];?></td>
									<td class="vae-left"><?php echo $row['username'];?></td>
									<td class="vae-left"><?php echo $row['office'];?></td>
									<td class="vae-right"><?php echo $row['phone'];?></td>
									<td class="vae-center"><?php echo $row['status'];?></td>
									<td style="width:40px;">Details</td>
									<td style="width:40px;">Edit</td>
									<td style="width:40px;">Trash</td>
								</tr>
							<?php } } else {$row = $record;?>
								<tr>
									<td class="vae-right"><?php echo fia::counter();?></td>
									<td class="vae-left"><?php echo $row['name'];?></td>
									<td class="vae-left"><?php echo $row['username'];?></td>
									<td class="vae-left"><?php echo $row['office'];?></td>
									<td class="vae-right"><?php echo $row['phone'];?></td>
									<td class="vae-center"><?php echo $row['status'];?></td>
									<td style="width:40px;">Details</td>
									<td style="width:40px;">Edit</td>
									<td style="width:40px;">Trash</td>
								</tr>
							<?php }  }?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
