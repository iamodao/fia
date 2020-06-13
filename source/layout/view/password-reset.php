<div class="mdc-layout-grid">
	<div class="mdc-layout-grid__inner">
		<div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
		<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">
			<div class="mdc-card">
				<form name="loginForm" method="post" action="?oact=process">
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
								<?php echo bookingApp::PasswordResetMessage();?>
							</div>
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
								<div class="mdc-text-field w-100">
									<input class="mdc-text-field__input" id="text-field-hero-input" name="email" value="<?php echo fia::retainFormPost('email');?>">
									<div class="mdc-line-ripple"></div>
									<label for="text-field-hero-input" class="mdc-floating-label">Email</label>
								</div>
							</div>
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
								<div class="mdc-form-field">

								</div>
							</div>
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center justify-content-end"> <a href="/login">Back to Login</a> </div>
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
								<input type="submit" value="Reset Now" class="mdc-button mdc-button--raised w-100">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
	</div>
</div>
