<!DOCTYPE html>
<html lang="en">
<head>

	<?php fia::obit('head');?>

</head>
<body class="sb-nav-fixed">

	<?php fia::oslice('header');?>

	<div id="layoutSidenav">

		<?php fia::oslice('sidebar');?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid">

					<?php fia::oview();?>

				</div>
			</main>

			<?php fia::oslice('footer');?>

		</div>
	</div>

	<?php fia::obit('js');?>

</body>
</html>
