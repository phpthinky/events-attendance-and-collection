<section class="container-fluid">
	<?php if (!empty($action)): ?>
		<?php if ($action['status'] == false): ?>
			<div class="alert alert-danger"><?php echo $action['msg']; ?></div>
			<?php else: ?>
			<div class="alert alert-success"><?php echo $action['msg']; ?></div>

		<?php endif ?>
<?php else: ?>
	<h4>Note: This action will unenrolled all students for this current semester.</h4>
	<form class="form" action="<?=current_url()?>" method="POST" id="form-restart">
		<div class="row form-group">
			<label>Please enter administrator password</label>
			<input type="password" autocomplete="new-password" name="cpassword" class="form-control">
		</div>

		<div class="row form-group">
			<label>&nbsp;</label>
			<input type="submit" name="submit" value="Submit" class="btn btn-sm btn-danger">
		</div>
	</form>

	<?php endif ?>
</section>