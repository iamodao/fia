<!DOCTYPE html>
<html lang="en">
<head>
	<?php fia::bit('head');?>
</head>
<body>
	<script src="/asset/js/preloader.js"></script>
	<div class="body-wrapper">

		<?php fia::bit('slice'.DS.'sidebar');?>

		<div class="main-wrapper mdc-drawer-app-content">

			<?php fia::bit('slice'.DS.'navbar');?>

			<div class="page-wrapper mdc-toolbar-fixed-adjust">

				<?php fia::bit('slice'.DS.'content');?>

				<?php fia::bit('slice'.DS.'footer');?>

			</div>
		</div>
	</div>

	<?php fia::bit('js');?>

</body>
</html>