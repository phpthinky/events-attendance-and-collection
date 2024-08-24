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

		<form method="post" action="" class="d-none">
			

			<div class="row">
				<div class="col-sm-4">Select file to restore.</div>
				<div class="col-sm-4">

				<select class="form-control" name="filename">
					<?php if (!empty($list_file)): ?>
						<?php foreach ($list_file as $key => $value): ?>
							<option><?=$value?></option>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>
			</div>

			<div class="row">
				<div class="col-sm-4">This action will emptied all tables.</div>
				<div class="col-sm-4">
					<input type="hidden" name="action" value="restoredb">
			<input type="submit" name="form" value="Restore" class="btn btn-default btn-sm"></div>
			</div>

		</form>
		<hr>
		<form method="post" action="#reset" id="form-reset-system-data">
			<div class="d-none">
				
			<input type="hidden" name="form" value="Reset">
			<input type="new-password" name="password" value="">
			</div>

			<div class="row">
				<div class="col-sm-4">This action will emptied all tables.</div>
				<div class="col-sm-4">
					<button type="button" id="btn-reset-system-data" class="btn btn-default btn-sm">Reset</button>
				</div>
			</div>

		</form>

		<div class="results"><?php if (!empty($action)): ?>
			<div class="alert alert-success"><?php echo $action; ?></div>
		<?php endif ?></div>
	</div>
</main>