<?php
$AU = User::active();
$record = Suite::read();
?>

<h1 class="mt-4">Suites</h1>
<div class="card mb-4">
	<div class="card-header"><i class="fas fa-table mr-1"></i> Suites</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="width:30px;">S/N</th>
						<th class="vae-left">TITLE</th>
						<th style="width:140px;" class="vae-right">PRICE</th>
						<th style="width:80px;">STATUS</th>
						<th style="width:60px;" class="vae-right">STOCK</th>
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
									<td class="vae-left"><?php echo $row['title'];?></td>
									<td class="vae-right"><?php echo format::number($row['price'], 0);?></td>
									<td class="vae-center"><?php echo $row['status'];?></td>
									<td class="vae-right"><?php echo $row['stock'];?></td>
									<td style="width:40px;">Details</td>
									<td style="width:40px;">Edit</td>
									<td style="width:40px;">Trash</td>
								</tr>
							<?php } } else {$row = $record;?>
								<tr>
									<td class="vae-right"><?php echo fia::counter();?></td>
									<td class="vae-left"><?php echo $row['title'];?></td>
									<td class="vae-right"><?php echo format::number($row['price'], 0);?></td>
									<td class="vae-center"><?php echo $row['status'];?></td>
									<td class="vae-right"><?php echo $row['stock'];?></td>
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
