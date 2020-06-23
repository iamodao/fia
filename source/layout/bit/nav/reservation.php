
<?php
$activeUser = new ActiveUser;
if(strtolower($activeUser->type) == 'admin'){?>
	<div class="mdc-list-item mdc-drawer-item">
		<a class="mdc-expansion-panel-link" href="javascript:void(0)" data-toggle="expansionPanel" data-target="reservation-menu">
			<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">ac_unit</i> Reservation
			<i class="mdc-drawer-arrow material-icons">chevron_right</i>
		</a>
		<div class="mdc-expansion-panel" id="reservation-menu">
			<nav class="mdc-list mdc-drawer-submenu">
				<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/room-reservations"> <i class="mdi mdi-spa"></i><span class="space-8"></span> Room </a></div>
				<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/salon-reservation"> <i class="mdi mdi-face"></i><span class="space-8"></span> Salon </a></div>
				<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/lounge-reservation"> <i class="mdi mdi-smoking"></i><span class="space-8"></span> Lounge </a></div>
				<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/cleaning-reservation"> <i class="mdi mdi-hot-tub"></i><span class="space-8"></span> Cleaning </a></div>
			</nav>
		</div>
	</div>
<?php } elseif(strtolower($activeUser->office) == 'room'){?>
	<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/reservations"> <i class="mdi mdi-spa"></i><span class="space-8"></span> Room </a></div>
<?php } elseif(strtolower($activeUser->office) == 'salon'){?>
	<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/reservations"> <i class="mdi mdi-face"></i><span class="space-8"></span> Salon </a></div>
<?php } elseif(strtolower($activeUser->office) == 'lounge'){?>
	<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/reservations"> <i class="mdi mdi-smoking"></i><span class="space-8"></span> Lounge </a></div>
<?php } elseif(strtolower($activeUser->office) == 'cleaning'){?>
	<div class="mdc-list-item mdc-drawer-item"><a class="mdc-drawer-link" href="/reservations"> <i class="mdi mdi-hot-tub"></i><span class="space-8"></span> Cleaning </a></div>
	<?php }?>