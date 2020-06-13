<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
	<div class="mdc-drawer__header">
		<a href="/" class="brand-logo"><img src="/asset/images/logo.png" alt="logo"></a>
	</div>
	<div class="mdc-drawer__content">
		<div class="mdc-list-group">
			<nav class="mdc-list mdc-drawer-menu">
				<div class="mdc-list-item mdc-drawer-item">
					<a class="mdc-drawer-link" href="/dashboard">
						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i> Dashboard
					</a>
				</div>
				<div class="mdc-list-item mdc-drawer-item">
					<a class="mdc-drawer-link" href="/booking">
						<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i> Booking
					</a>
				</div>
				<?php
				fia::bit('nav'.DS.'reservation');
				fia::bit('nav'.DS.'hotel');
				fia::bit('nav'.DS.'employee');
				fia::bit('nav'.DS.'settings');
				?>
				<div class="mdc-list-item mdc-drawer-item">
					<a class="mdc-drawer-link" href="/logout"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">input</i> Logout </a>
				</div>
			</nav>
		</div>
	</div>
</aside>