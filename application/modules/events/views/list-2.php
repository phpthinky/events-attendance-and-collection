	<div class="container-fluid">
		<div class="card">
		<div class="row">
			
			<div class="col-lg-8 col-sm-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="events-photo">
							<img src="<?=assets_url('img/events-photo.jpg')?>" style="width: 100%;">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						
		<div class="card">
			<div class="card-header">
				<h2>List of Events</h2>
			</div>
			<div class="card-body">
					
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-incoming">Incoming</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-completed">Completed</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-canceled">Canceled</a></li>

			</ul>
			<div class="tab-content">

					
					<!-- incoming -->
					<div class="tab-pane active" id="tab-incoming">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Event Title</th>
										<th>Attendees</th>

										<th>Absent (Php)</th>
										<th>Late (Php)</th>
										<th>Date</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_incoming)): ?>
										<?php foreach ($list_events_incoming as $key => $value): ?>
											<tr>
												<td><?=$value->event_title. ' - Day '.$value->no_days?></td>
												<td><?=implode(',',$value->courses)?></td>

												<td><?=number_format($value->absent,2)?></td>
												<td><?=number_format($value->late,2)?></td>
												<td><?=toMMdy($value->event_startdate) ." ".time_format($value->morning_timein)?></td>
												
												<td>
													<a href="<?=site_url('attendance/start/'.$value->id)?>" class="btn btn-outline-success btn-sm"><i class="fa fa-play"></i> Activate</a> <?php if ($value->status == 0): ?>
													<a class="btn btn-outline-info btn-sm" href="<?=site_url('events/edit/'.$value->id)?>" ><i class="fa fa-edit"></i> Modify</a>
												<?php endif ?>
												</td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>


					<!-- completed -->
					<div class="tab-pane " id="tab-completed">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Event Title</th>
										<th>Attendees</th>
										<th>Date</th>
										<th>Date Completed</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_completed)): ?>
										<?php foreach ($list_events_completed as $key => $value): ?>
											<tr>
												<td><?=$value->event_title?></td>
												<td><?=implode(',',$value->courses)?></td>

												<td><?=toMMdy($value->event_startdate)." " .time_format($value->morning_timein)?></td>

												<td><?=toMMdy($value->date_completed) ." ".time_format($value->date_completed)?></td>
												<td></td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>

					<!-- canceled -->
					<div class="tab-pane " id="tab-canceled">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Event Title</th>

										<th>Absent (Php)</th>
										<th>Late (Php)</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_canceled)): ?>
										<?php foreach ($list_events_canceled as $key => $value): ?>
											<tr>
												<td><?=$value->event_title?></td>
												<td><?=number_format($value->absent,2)?></td>
												<td><?=number_format($value->late,2)?></td>

												<td><?=toMMdy($value->event_startdate)." " .time_format($value->morning_timein)?></td>
												<td><?=toMMdy($value->event_enddate) . " ".time_format($value->afternoon_timeout)?></td>

												<td><a href="<?=site_url('events/edit/'.$value->id)?>" class="btn btn-default btn-sm" ><i class="fa fa-edit"></i> Modify</a></td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane" id="tab-import">
						Import

						<div class="row">
							<label>Choose excel file</label>
							<input type="file" name="import_excel" accept=".xls,.xlsx">
						</div>
					</div>
				</div>
			</div>
		</div>

					</div>
					
				</div>

			</div>
			<div class="col-lg-4 col-sm-12">

					<label class="text-title">Current events</label>
					<hr>					
					<div class="row">

						<?php if (!empty($list_events)): ?>
							<?php foreach ($list_events as $key => $value): ?>
								<div class="col-lg-12"> <a href="<?=site_url('attendance/start/'.$value->id)?>" class="nav-link text-title"><?=$value->event_title?>
								</a>
								
								<span style="display:block; margin-left: 30px;font-size: 10px;"><?=implode(', ', $value->courses)?></span> 
										
									</div>
							<?php endforeach ?>
						<?php endif ?>

					</div>

			</div>
		</div>
		</div>
	</div>