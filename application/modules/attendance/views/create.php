<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h2>Create events</h2>
		</div>
		<div class="card-body">
			<form class="form-responsive" action="<?=current_url('')?>" method="POST">
				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Title</label>
					<div class="col-md-9">
						<input class="form-control" name="event_title" id="event_title" type="text">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Start Date</label>
					<div class="col-md-9">
						<input class="form-control" name="event_startdate" id="event_startdate" type="date">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event Start Time</label>
					<div class="col-md-9">
						<input class="form-control" name="event_timestart" id="event_timestart" type="time">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event End Date</label>
					<div class="col-md-9">
						<input class="form-control" name="event_enddate" id="event_enddate" type="date">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">Event End Time</label>
					<div class="col-md-9">
						<input class="form-control" name="event_timeend" id="event_timeend" type="time">
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3" for="event_title">&nbsp;</label>
					<div class="col-md-9">
						<input class="btn btn-outline-primary btn-sm" name="submit" id="btn-submit" type="submit" value="Add event">
					</div>
				</div>

				<div class="row errors">
					<?php //var_dump($this->input->post()); ?>
				</div>
			</form>

		</div>

	</div>
</div>