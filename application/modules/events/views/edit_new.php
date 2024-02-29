<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h2>Edit events</h2>
		</div>
		<div class="card-body">
			<form class="form-responsive" action="<?=current_url('')?>" method="POST" id="form-add-events">
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Title</label>
					<div class="col-md-9">
						<input class="form-control" name="event_title" id="event_title" type="text" value="<?=isset($event_info->event_title) ? $event_info->event_title : ''?>">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Start Date</label>
					<div class="col-md-9">
						<input class="form-control min-date" name="event_startdate" id="e_event_startdate" type="date" value="<?=isset($event_info->event_startdate) ? $event_info->event_startdate : date('Y-m-d')?>">
					</div>
				</div>


				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event End Date</label>
					<div class="col-md-9">
						<span class="form-control" id="event_enddate"><?=isset($event_info->event_enddate) ? tomdy($event_info->event_enddate) : date('Y-m-d')?></span>
					</div>
				</div>



				<div class="row form-group">
					<label class="col-md-3" for="event_title">Day</label>
					<div class="col-md-9">
						<span class="form-control" id="no_days"><?=isset($event_info->no_days) ? $event_info->no_days : ''?></span>
					</div>
				</div>

				<hr>
				<label>Time in-out</label>

				<div class="row form-group">
					<label class="col-md-3" for="event_title"></label>
					<div class="col-md-9">

						<select class="form-control" name="has_afternoon">
							<option value="0">Whole day</option>
							<option value="1" <?php if ($event_info->has_afternoon == 1): ?>
								selected
							<?php endif ?>>Morning only</option>
							<option value="2" <?php if ($event_info->has_afternoon == 2): ?>
								selected
							<?php endif ?>>Afterrnoon only</option>
						</select>
					</div>
				</div>

				<div class="row form-group time-in morning">
					<label class="col-md-3" for="event_title">Morning</label>
					<div class="col-md-9"><div class="row">
						
						<div class="col-md-6">
							<label for="morning_timein">Time in</label>
						<input class="form-control" name="morning_timein" id="morning_timein" type="time"  value="<?=isset($event_info->morning_timein) ? $event_info->morning_timein : '00:00'?>">
						</div>
						<div class="col-md-6">
							<label for="morning_timeout">Time out</label>
						<input class="form-control" name="morning_timeout" id="morning_timeout" type="time"  value="<?=isset($event_info->morning_timeout) ? $event_info->morning_timeout : '00:00'?>">
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

						<input class="form-control" name="afternoon_timein" id="afternoon_timein" type="time"  value="<?=isset($event_info->afternoon_timein) ? $event_info->afternoon_timein : '00:00'?>">
						</div>
						<fiv class="col-md-6">
							<label for="afternoon_timeout">Time out</label>
							
						<input class="form-control" name="afternoon_timeout" id="afternoon_timeout" type="time"  value="<?=isset($event_info->afternoon_timeout) ? $event_info->afternoon_timeout : '00:00'?>">
						</fiv>
						</div>
					</div>
				</div>


				<hr><label>Penalty</label>
				<div class="row form-group">
					<label class="col-md-3" for="event_late_penalty">Late</label>
					<div class="col-md-9">
						<input class="form-control" name="late" id="event_late_penalty" type="text" value="<?=isset($event_info->late) ? number_format($event_info->late,2) : 0?>">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Absent</label>
					<div class="col-md-9">
						<input class="form-control" name="absent" id="absent_penalty" type="text" value="<?=isset($event_info->absent) ? number_format($event_info->absent,2) : 0?>">
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
							
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
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
						<label class="col-md-12 input-radio" style="padding:10px;cursor: pointer;"><input type="radio" name="semester" value="1" <?php if ($event_info->semester == 1): ?>
							checked
						<?php endif ?>>	First Semester</label>
						<label class="col-md-12 input-radio" style="padding:10px;cursor: pointer;"><input type="radio" name="semester" value="2" <?php if ($event_info->semester == 2): ?>
							checked
						<?php endif ?>> Second Semester</label>
					</div>
					</div>
				</div>
<hr>

				<div class="row form-group">
					<label class="col-md-3" for="absent_penalty">Event Status</label>
					<div class="col-md-9">
						<select class="form-control" name="status">
							<option value="0" <?php if ($event_info->status == 0): ?>
								selected
							<?php endif ?> >Incoming</option>
							<option value="1" <?php if ($event_info->status == 1): ?>
								selected
							<?php endif ?> >Active</option>
							<option value="2" <?php if ($event_info->status == 2): ?>
								selected
							<?php endif ?> >Completed</option>
							<option value="3" <?php if ($event_info->status == 3): ?>
								selected
							<?php endif ?> >Canceled</option>
						</select>
					</div>
				</div>

				<div class="row form-group">
					<div class="d-none">
						<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
						<input type="hidden" name="year_id" value="<?=isset($event_info->year_id) ? $event_info->year_id : 0?>">

					</div>
					<label class="col-md-3" for="event_title">&nbsp;</label>
					<div class="col-md-9">
						<input class="btn btn-outline-primary btn-sm" name="submit" id="btn-submit" type="submit" value="Update event">
					</div>
				</div>

				<div class="row errors">
					<?php //var_dump($this->input->post()); ?>
				</div>
			</form>

		</div>

	</div>
</div>