<div class="container">
	<div class="card">
		<div class="card-body">
			<form class="form-responsive" id="form-add-course" action="#" method="POST" enctype="multipart/form-data">
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Course Title</label>
					<div class="col-md-9">
						<input class="form-control" name="course_title" id="course_title" type="text" required>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Acronym</label>
					<div class="col-md-9">
						<input class="form-control"  name="course_sub_title" id="course_sub_title" type="text" required>
					</div>
				</div>

				<div class="row form-group d-none">
					<label class="col-md-3" for="event_title">Description (optional)</label>
					<div class="col-md-9">
						<input class="form-control" name="description" id="course_description" type="text">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Logo (150x150 pixel)</label>
					<div class="col-md-9">
						<div class="row">
							
						<input class="file-input" name="logo" id="course_logo" type="file" accept=".jpg,.png">

						</div>
						<div class="row">
							
                            <div class="col-md-4">
                              <img class="preview-photo" src="<?=base_url('assets/img/user.png')?>">
                            </div>

						</div>
					</div>
				</div>


				<div class="row form-group">
					<label class="col-md-3" for="event_title">&nbsp;</label>
					<div class="col-md-9">
						<input class="btn btn-outline-primary btn-sm" name="submit" id="btn-submit" type="submit" value="Save course">
					</div>
				</div>

				<div class="row errors">
					<?php //var_dump($this->input->post()); ?>
				</div>
			</form>

		</div>

	</div>
</div>