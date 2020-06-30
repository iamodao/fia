<?php $AU = User::active();?>
<h1 class="mt-4">Update Profile</h1>
<div class="card mb-4">
	<div class="card-body">
		<form action="?oact=process" method="POST" accept-charset="utf-8">
			<?php
			Notify('update-profile');
			if(fia::routeAction() != 'success'){?>
				<div class="form-group row">
					<label for="inputName" class="col-md-2 col-form-label">Name</label>
					<div class="col-md-5">
						<input class="form-control" id="inputName" type="text" placeholder="Name" name="name" value="<?php echo $AU['name'];?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail" class="col-md-2 col-form-label">Email Address</label>
					<div class="col-md-4">
						<input class="form-control" id="inputEmail" type="text" placeholder="Email Address" name="email" value="<?php echo $AU['email'];?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputNumber" class="col-md-2 col-form-label">Phone Number</label>
					<div class="col-md-4">
						<input class="form-control" id="inputNumber" type="text" placeholder="Phone Number" name="phone" value="<?php echo $AU['phone'];?>">
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