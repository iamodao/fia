<!DOCTYPE html>
<html lang="en">
<head>

	<?php fia::obit('head');?>

</head>
<body class="bg-primary">
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">

								<?php fia::oview();?>

							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<div id="layoutAuthentication_footer">

			<?php fia::oslice('footer');?>

		</div>
	</div>

	<?php fia::obit('js');?>

</body>
</html>