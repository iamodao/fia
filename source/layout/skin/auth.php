<!DOCTYPE html>
<html lang="en">
<head>
	<?php fia::bit('head');?>
</head>
<body>
	<div class="body-wrapper">
		<div class="main-wrapper">
			<div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
				<main class="auth-page">

					<?php fia::view();?>

				</main>
			</div>
		</div>
	</div>
	<?php fia::bit('js');?>
</body>
</html>