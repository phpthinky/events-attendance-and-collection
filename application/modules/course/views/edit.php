<div class="container">
	<div class="card">
		<div class="card-body">
			<form class="form-responsive" id="form-edit-course" action="#" method="POST" enctype="multipart/form-data">
				
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Select course to be edit</label>
					<div class="col-md-9">
						<select class="form-control" name="course_title" id="select-course-edit" required>
					<option value="">No selected</option>
						<?php if (!empty($list_courses)): ?>
							
							
							<?php foreach ($list_courses as $key => $value): ?>
<option value="<?=$value->id?>"><?=$value->course_sub_title?></option>
							<?php endforeach ?>

						<?php endif ?>

				</select>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Course Title</label>
					<div class="col-md-9">
						<input class="form-control" name="course_title" id="ecourse_title" type="text" required>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Acronym</label>
					<div class="col-md-9">
						<input class="form-control"  name="course_sub_title" id="ecourse_sub_title" type="text" required>
					</div>
				</div>

				<div class="row form-group d-none">
					<label class="col-md-3" for="event_title">Description (optional)</label>
					<div class="col-md-9">
						<input class="form-control" name="description" id="ecourse_description" type="text">
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