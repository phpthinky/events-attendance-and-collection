<main class="content-wrapper">
	
	<div class="container-fluid">
		<hr>
		<form method="post" action="">
			<div class="row">
				<div class="col-sm-4">This action will backup all table data. (Not yet)</div>
				<div class="col-sm-4">
			<input type="submit" name="form" value="Backup" class="btn btn-default btn-sm"></div>
			</div>
		</form>
<hr>
		<form method="post" action="">
			

			<div class="row">
				<div class="col-sm-4">This action will emptied all tables.</div>
				<div class="col-sm-4">
			<input type="submit" name="form" value="Reset" class="btn btn-default btn-sm"></div>
			</div>

		</form>

		<div class="results"><?php if (!empty($action)): ?>
			<div class="alert alert-success"><?php echo $action; ?></div>
		<?php endif ?></div>
	</div>
</main>