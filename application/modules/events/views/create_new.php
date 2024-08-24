<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h2>Create events</h2>
		</div>
		<div class="card-body form">
			<form class="form-responsive" action="<?=current_url('')?>" method="POST" id="form-add-events">
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Title</label>
					<div class="col-md-9">
						<input class="form-control" name="event_title" id="event_title" type="text">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Start Date</label>
					<div class="col-md-9">
						<input class="form-control min-date" name="event_startdate" id="event_startdate" type="date" value="<?=date('Y-m-d')?>">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">How many days</label>
					<div class="col-md-9">
						<input class="form-control min-date" name="no_days" id="no_days" type="number" value="1" >
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event End Date</label>
					<div class="col-md-9">
						<span class="form-control" id="event_enddate"><?=date('m/d/Y')?></span>
					</div>
				</div>
				<hr>
				<label>Time in-out</label>


				<div class="row form-group">
					<label class="col-md-3" for="event_title"></label>
					<div class="col-md-9">

						<select class="form-control" name="has_afternoon">
							<option value="0">Whole day</option>
							<option value="1">Morning only</option>
							<option value="2">Afterrnoon only</option>
						</select>
					</div>
				</div>

				<div class="row form-group time-in morning">
					<label class="col-md-3" for="event_title">Morning</label>
					<div class="col-md-9"><div class="row">
						
						<div class="col-md-6">
							<label for="morning_timein">Time in</label>
						<input class="form-control" name="morning_timein" id="morning_timein" type="time" value="07:30">
						</div>
						<div class="col-md-6">
							<label for="morning_timeout">Time out</label>
						<input class="form-control" name="morning_timeout" id="morning_timeout" type="time" value="11:30">
						</div>
					</div>
					</div>
				</div>
				<div class="row form-group time-in afternoon">
					<label class="col-md-3" for="event_title">Afternoon Timein</label>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
							<label for="afternoon_timein">Time in</label>

						<input class="form-control" name="afternoon_timein" id="afternoon_timein" type="time" value="13:30">
						</div>
						<fiv class="col-md-6">
							<label for="afternoon_timeout">Time out</label>
							
						<input class="form-control" name="afternoon_timeout" id="afternoon_timeout" type="time" value="17:30">
						</fiv>
						</div>
					</div>
				</div>
				<hr><label>Penalty</label>
				<div class="row form-group">
					<label class="col-md-3" for="event_late_penalty">Late</label>
					<div class="col-md-9">
						<input class="form-control" name="late" id="event_late_penalty" type="text" value="<?=isset($collections_settings->late_penalty) ? $collections_settings->late_penalty : 0?>">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Absent</label>
					<div class="col-md-9">
						<input class="form-control" name="absent" id="absent_penalty" type="text" value="<?=isset($collections_settings->absent_penalty) ? $collections_settings->absent_penalty : 0?>">
					</div>
				</div>
				<hr>
				<label>Select event attendees</label>
				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Select course</label>
					<div class="col-md-9">
						<select name="attendees_course" id="attendees_course" class="form-control multiple" multiple>
							<?php if (!empty($list_courses)): ?>
								<?php foreach ($list_courses as $key => $value): ?>
									<option value="<?=$value->id?>"><?=$value->course_sub_title?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>

					<div class="col-md-12" style="padding:10px;">
						
					<span id="selected_attendees_course" style="color: royalblue;"></span>
					</div>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Select Year</label>
					<div class="col-md-9">
						<select name="attendees_year" id="attendees_year" class="form-control multiple" multiple>
							
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
		
					<div class="col-md-12" style="padding:10px;">
						
					<span id="selected_attendees_year" style="color: royalblue;"></span>
					</div>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Select semester</label>
					<div class="col-md-9">
					<div class="row form-group">

						<select class="form-control" name="semester">
							<option value="1" <?php if ($semester == 1): ?>
							selected
						<?php endif ?>>First semester</option>
							<option value="2" <?php if ($semester == 2): ?>
							selected
						<?php endif ?>>Second semester</option>
						</select>
						
					</div>
					</div>
				</div>

				<div class="row form-group">
					<div class="d-none">
						<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
						<input type="hidden" name="year_id" value="<?=isset($year_id) ? $year_id : 0?>">
					</div>
					<label class="col-md-3" for="event_title">&nbsp;</label>
					<div class="col-md-9">
						<?php if (!empty($year_id)): ?>
							
						<input class="btn btn-outline-primary btn-sm" name="submit" id="btn-submit" type="submit" value="Add event">
						<span class="pre-text text-danger d-none">Please wait...</span>
					<?php else: ?>
						<a class="btn btn-sm disabled" disabled >Disabled - No school year</a>
						<?php endif ?>
					</div>
				</div>

				<div class="row errors">
					<?php //var_dump($this->input->post()); ?>
				</div>
			</form>

		</div>

	</div>
</div>