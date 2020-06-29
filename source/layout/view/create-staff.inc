<h1 class="mt-4">Create Staff</h1>
<div class="card mb-4">
	<div class="card-body">
		<form action="?oact=process" method="POST" accept-charset="utf-8">
			<?php
			Notify('staff');
			if(fia::routeAction() != 'success'){?>
				<div class="form-group row">
					<label for="inputName" class="col-md-2 col-form-label">Name</label>
					<div class="col-md-5">
						<input class="form-control" id="inputName" type="text" placeholder="Name" name="name" value="<?php echo fia::retainFormPost('name');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail" class="col-md-2 col-form-label">Email Address</label>
					<div class="col-md-4">
						<input class="form-control" id="inputEmail" type="text" placeholder="Email Address" name="email" value="<?php echo fia::retainFormPost('email');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputNumber" class="col-md-2 col-form-label">Phone Number</label>
					<div class="col-md-4">
						<input class="form-control" id="inputNumber" type="text" placeholder="Phone Number" name="number" value="<?php echo fia::retainFormPost('number');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputUsername" class="col-md-2 col-form-label">Username</label>
					<div class="col-md-3">
						<input class="form-control" id="inputUsername" type="text" placeholder="Username" name="username" value="<?php echo fia::retainFormPost('username');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-md-2 col-form-label">Password</label>
					<div class="col-md-3">
						<input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" value="<?php echo fia::retainFormPost('password');?>">
					</div>
				</div>
				<input type="hidden" name="type" value="staff">
				<div class="form-group row">
					<label for="inputOffice" class="col-md-2 col-form-label">Office</label>
					<div class="col-md-3">
						<select class="custom-select mr-sm-2" id="inputOffice" name="office" required>
							<option selected>Choose...</option>
							<option value="ROOM">ROOM</option>
							<option value="SALON">SALON</option>
							<option value="LOUNGE">LOUNGE</option>
							<option value="CLEANING">CLEANING</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputSend" class="col-md-2 col-form-label"></label>
					<div class="col-md-2"><input type="submit" class="form-control btn btn-primary" value="Save"></div>
				</div>
			<?php }?>
		</form>
	</div>
</div>