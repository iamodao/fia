<h1 class="mt-4">Create Suite</h1>
<div class="card mb-4">
	<div class="card-body">
		<form action="?oact=process" method="POST" accept-charset="utf-8">
			<?php
			Notify('suite');
			if(fia::routeAction() != 'success'){?>
				<div class="form-group row">
					<label for="inputTitle" class="col-md-2 col-form-label">Title</label>
					<div class="col-md-5">
						<input class="form-control" id="inputTitle" type="text" placeholder="Title" name="title" value="<?php echo fia::retainFormPost('title');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPrice" class="col-md-2 col-form-label">Price</label>
					<div class="col-md-3">
						<input class="form-control" id="inputPrice" type="number" placeholder="Price" name="price" value="<?php echo fia::retainFormPost('price');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputStock" class="col-md-2 col-form-label">Stock</label>
					<div class="col-md-3">
						<input class="form-control" id="inputStock" type="number" placeholder="Stock" name="stock" value="<?php echo fia::retainFormPost('stock');?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputSend" class="col-md-2 col-form-label"></label>
					<div class="col-md-2"><input type="submit" class="form-control btn btn-primary" value="Save"></div>
				</div>
			<?php }?>
		</form>
	</div>
</div>