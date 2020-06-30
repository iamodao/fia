<?php $AU = User::active();?>
<h1 class="mt-4">Change Password</h1>
<div class="card mb-4">
	<div class="card-body">
		<form action="?oact=process" method="POST" accept-charset="utf-8">
			<?php
			Notify('change-password');
			if(fia::routeAction() != 'success'){?>
				<div class="form-group row">
					<label for="inputPassword" class="col-md-2 col-form-label">Password</label>
					<div class="col-md-5">
						<input class="form-control" id="inputPassword" type="password" placeholder="Enter new password" name="password">
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