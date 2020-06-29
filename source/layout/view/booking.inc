<?php $AU = User::active();?>
<div class="mdc-layout-grid">
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell--span-12">
			<div class="mdc-card">
				<h6 class="card-title"><?php echo $AU['office'];?> > Create Booking</h6>
				<div class="template-demo">
					<form action="?oact=process" method="POST" accept-charset="utf-8">

						<div class="mdc-layout-grid__inner mdc-btn-down">
							<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
								<?php echo Message::booking();?>
							</div>
						</div>
						<?php
						if(fia::routeAction() != 'success'){?>


							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
									<div class="mdc-text-field mdc-text-field--outlined">
										<input class="mdc-text-field__input" id="name" name="name" value="<?php echo fia::retainFormPost('name');?>">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="name" class="mdc-floating-label">Name</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
									<div class="mdc-text-field mdc-text-field--outlined">
										<input class="mdc-text-field__input" id="phone" name="phone" value="<?php echo fia::retainFormPost('phone');?>">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="phone" class="mdc-floating-label">Phone Number</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
									<div class="mdc-text-field mdc-text-field--outlined">
										<input class="mdc-text-field__input" id="email" name="email" type="email" value="<?php echo fia::retainFormPost('email');?>">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="email" class="mdc-floating-label">Email Address</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
									<div class="mdc-text-field mdc-text-field--outlined datepicker-box-top">
										<input class="mdc-text-field__input" id="date" name="schedule_date" type="date" value="<?php echo fia::retainFormPost('schedule_date');?>">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="date" class="mdc-floating-label">Date</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>

								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-2-desktop">
									<div class="mdc-text-field mdc-text-field--outlined datepicker-box-top">
										<input class="mdc-text-field__input" id="time" name="schedule_time" type="time" value="<?php echo fia::retainFormPost('schedule_time');?>">
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="time" class="mdc-floating-label">Time</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
							</div>


							<?php if(strtolower($AU['office']) != 'admin'){?>
								<input type="hidden" name="type" value="<?php echo $AU->office;?>">
							<?php } else {?>


								<div class="mdc-select demo-width-class mdc-btn-down" data-mdc-auto-init="MDCSelect">
									<input type="hidden" name="type">
									<i class="mdc-select__dropdown-icon"></i>
									<div class="mdc-select__selected-text"></div>
									<div class="mdc-select__menu mdc-menu-surface demo-width-class">
										<ul class="mdc-list">
											<li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true"></li>
											<li class="mdc-list-item" data-value="SALON">Salon</li>
											<li class="mdc-list-item" data-value="LOUNGE">Lounge</li>
											<li class="mdc-list-item" data-value="CLEANING">Cleaning</li>
										</ul>
									</div>
									<span class="mdc-floating-label">Pick a Booking type</span>
									<div class="mdc-line-ripple"></div>
								</div>


							<?php }?>

							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
									<div class="mdc-text-field mdc-text-field--textarea">
										<textarea class="mdc-text-field__input" rows="4" cols="40"  aria-label="label" id="summary" name="summary"><?php echo fia::retainFormPost('summary');?></textarea>
										<div class="mdc-notched-outline mdc-notched-outline--upgraded">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__notch" style="">
												<label for="summary" class="mdc-floating-label">Summary</label>
											</div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
							</div>


							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
									<input type="submit" class="mdc-button mdc-button--unelevated filled-button--dark mdc-btn-down"  value="Save">
								</div>
							</div>
						<?php }?>

					</form>



				</div>
			</div>
		</div>
	</div>
</div>