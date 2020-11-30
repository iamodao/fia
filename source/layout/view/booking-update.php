<?php
$AU = User::active();
$filter = array();
$filter['bind'] = $_GET['id'];
$record = Booking::read($filter);
?>
<h1 class="mt-4">Booking Update</h1>
<div class="card mb-4">
	<div class="card-body">
		<?php if($record == 'NO_RECORD'){?>
			<tr>
				<td colspan="10" style="text-align: center; color: red;">NO RECORDS FOUND!</td>
			</tr>
		<?php } else {?>
			<form action="?oact=process&id=<?php echo $filter['bind'];?>" method="POST" accept-charset="utf-8">
				<?php
				Notify('booking');
				if(fia::routeAction() != 'success'){?>
					<div class="form-group row">
						<label class="col-md-2 col-form-label" for="inputName">Customer Name</label>
						<div class="col-md-5">
							<input class="form-control" id="inputName" type="text" placeholder="Full Name" name="name" value="<?php echo $record['name'];?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPhone" class="col-md-2 col-form-label">Phone Number</label>
						<div class="col-md-5">
							<input class="form-control" id="inputPhone" type="text" placeholder="Phone Number" name="phone" value="<?php echo $record['phone'];?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail" class="col-md-2 col-form-label">Email Address</label>
						<div class="col-md-5">
							<input class="form-control" id="inputEmail" type="text" placeholder="Email Address" name="email" value="<?php echo $record['email'];?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputSchedule" class="col-md-2 col-form-label">Schedule Date</label>
						<div class="col-md-3">
							<input class="form-control" id="inputSchedule" type="datetime-local" placeholder="Schedule" name="schedule" value="<?php echo $record['schedule'];?>" required>
						</div>
					</div>

					<?php if(strtolower($AU['office']) != 'admin'){?>
						<input type="hidden" name="type" value="<?php echo $AU['office'];?>">
					<?php } else {?>
						<div class="form-group row">
							<label for="inputType" class="col-md-2 col-form-label">Type</label>
							<div class="col-md-3">
								<select class="custom-select mr-sm-2" id="inputType" name="type" required>
									<option selected>Choose...</option>
									<option value="ROOM">ROOM</option>
									<option value="SALON">SALON</option>
									<option value="LOUNGE">LOUNGE</option>
									<option value="CLEANING">CLEANING</option>
								</select>
							</div>
						</div>
					<?php }?>
					<?php if(strtolower($AU['office']) == 'room' || strtolower($AU['office']) == 'admin'){?>
						<div class="form-group row">
							<label for="inputSuite" class="col-md-2 col-form-label">Suite</label>
							<div class="col-md-4">
								<select class="custom-select mr-sm-2" id="Suite" name="suite" <?php if(strtolower($AU['office']) != 'admin'){echo 'required';}?>>
									<option selected>Choose...</option>
									<?php
									$suite = Suite::read();
									if($suites != 'NO_RECORD'){
										if(fia::isArrayMulti($suite) === true){
											foreach ($suite as $row){?>
												<option value="<?php echo $row['title'];?>"><?php echo $row['title'].' - ₦'.format::number($row['price'], 0);?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							<?php }
						}	}?>
						<div class="form-group row">
							<label for="inputSummary" class="col-md-2 col-form-label">Summary</label>
							<div class="col-md-5">
								<textarea class="form-control" id="inputSummary" type="time" placeholder="Enter Summary" name="summary"><?php echo $record['summary'];?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputType" class="col-md-2 col-form-label">Status</label>
							<div class="col-md-3">
								<select class="custom-select mr-sm-2" id="inputType" name="status" required>
									<option value="">Choose...</option>
									<option value="PENDING" <?php if($record['status'] == 'PENDING'){echo ' selected';}?>>PENDING</option>
									<option value="CONFIRMED" <?php if($record['status'] == 'CONFIRMED'){echo ' selected';}?>>CONFIRMED</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputSend" class="col-md-2 col-form-label"></label>
							<div class="col-md-2"><input type="submit" class="form-control btn btn-primary" value="Save"></div>
						</div>
					<?php }?>
				</form>
			<?php }?>
		</div>
	</div>