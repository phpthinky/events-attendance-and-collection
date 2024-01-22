<div class="container">
	<div class="card">
		<div class="card-body">
			<form class="form-responsive" id="form-collection-settings" action="#" method="POST" enctype="multipart/form-data">
				<div class="row form-group">
					<label class="col-md-3" for="late_penalty">Late penalty</label>
					<div class="col-md-9">
						<input class="form-control" name="late_penalty" id="late_penalty" step=".1" value="<?=isset($settings->late_penalty)? number_format($settings->late_penalty,2) :25.00?>"  type="number" required>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="late_penalty_minutes">How many minutes before the late penalty happen?</label>
					<div class="col-md-9">
						<input class="form-control"  name="late_penalty_minutes"  step="5" id="late_penalty_minutes" type="number" value="<?=isset($settings->late_penalty_minutes)? $settings->late_penalty_minutes :30?>" required>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Absent penalty</label>
					<div class="col-md-9">
						<input class="form-control" name="absent_penalty" id="absent_penalty" step=".1" type="number" value="<?=isset($settings->absent_penalty)? number_format($settings->absent_penalty,2) :100?>">
					</div>
				</div>


				<div class="row form-group">
					<label class="col-md-3" for="submit">&nbsp;</label>
					<div class="col-md-9">
						<input class="btn btn-outline-primary btn-sm" name="settings" id="btn-submit" type="submit" value="Save settings">
					</div>
				</div>

				<div class="row errors">
					<?php //var_dump($settings->this->input->post()); ?>
				</div>
			</form>

		</div>

	</div>
</div>