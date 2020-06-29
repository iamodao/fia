<?php $AU = User::active();?>
<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
		<div class="sb-sidenav-menu">
			<div class="nav">
				<div class="sb-sidenav-menu-heading">Navigation</div>
				<a class="nav-link" href="./booking"><div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>Booking</a>
				<a class="nav-link" href="./reservations"><div class="sb-nav-link-icon"><i class="fas fa-snowflake"></i></div>Reservation</a>

				<?php if($AU['type'] == 'ADMIN'){?>
					<div class="sb-sidenav-menu-heading">Hotel</div>
					<a class="nav-link" href="./suites"> <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div> Suites</a>
					<a class="nav-link" href="./create-suite"> <div class="sb-nav-link-icon"><i class="fas fa-person-booth"></i></div> Create Suite</a>

					<div class="sb-sidenav-menu-heading">Staff</div>
					<a class="nav-link" href="./staffs"> <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div> Staffs</a>
					<a class="nav-link" href="./create-staff"> <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div> Create Staff</a>
				<?php } ?>

				<div class="sb-sidenav-menu-heading">Settings</div>
				<a class="nav-link" href="./update-profile"><div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div> Update Profile</a>
				<a class="nav-link" href="./change-password"><div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div> Change Password</a>

				<a class="nav-link" href="./logout"><div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div> Logout</a>
			</div>
		</div>
		<div class="sb-sidenav-footer">
			<div class="small">Logged in as:</div>
			<?php echo $AU['name'];?>
		</div>
	</nav>
</div>