<!DOCTYPE html>
<html lang="en">
<head>
	<?php fia::obit('head');?>
</head>
<body>
	<script src="/asset/js/preloader.js"></script>
	<div class="body-wrapper">

		<?php fia::obit('slice'.DS.'sidebar');?>

		<div class="main-wrapper mdc-drawer-app-content">

			<?php fia::obit('slice'.DS.'navbar');?>

			<div class="page-wrapper mdc-toolbar-fixed-adjust">

				<?php fia::obit('slice'.DS.'content');?>

				<?php fia::obit('slice'.DS.'footer');?>

			</div>
		</div>
	</div>

	<?php fia::obit('js');?>

</body>
</html>