		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Current Events</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-incoming">Incoming</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-completed">Completed</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-canceled">Canceled</a></li>

		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">

					<div class="tab-pane active" id="tab-family">
						<label class="text-title">list current events</label>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event Title</th>
										<th>Absent (Php)</th>
										<th>Late (Php)</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events)): ?>
										<?php foreach ($list_events as $key => $value): ?>
											<tr>
												<td><?=$value->id?></td>
												<td><?=$value->event_title?></td>
												<td><?=number_format($value->absent,2)?></td>
												<td><?=number_format($value->late,2)?></td>
												<td><?=toMMdy($value->event_startdate)." " .time_format($value->morning_timein)?></td>
												<td><?=toMMdy($value->event_enddate) . " ".time_format($value->afternoon_timeout)?></td>
												<td><?=is_active($value->status)?></td>
												<?php if ($value->status == 2): ?>
													<td></td>
													<?php else: ?>
														<td><a href="<?=site_url('attendance/start/'.$value->id)?>" class="btn btn-default btn-sm"><i class="fa fa-play"></i> Start</a> <a data-event_id="<?=$value->id?>" href="#" class="btn btn-default btn-sm btn-stop-event"><i class="fa fa-stop"></i> End event</a> <?php if ($value->status == 0): ?>
													<a class="btn btn-default btn-sm" href="<?=site_url('events/edit/'.$value->id)?>" ><i class="fa fa-edit"></i> Modify</a>
												<?php endif ?></td>
												<?php endif ?>
												
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- incoming -->
					<div class="tab-pane " id="tab-incoming">
						<label class="text-title">list incoming events</label>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event Title</th>

										<th>Absent (Php)</th>
										<th>Late (Php)</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_incoming)): ?>
										<?php foreach ($list_events_incoming as $key => $value): ?>
											<tr>
												<td><?=$value->id?></td>
												<td><?=$value->event_title?></td>
												<td><?=number_format($value->absent,2)?></td>
												<td><?=number_format($value->late,2)?></td>
												<td><?=toMMdy($value->event_startdate) ." ".time_format($value->morning_timein)?></td>
												<td><?=toMMdy($value->event_enddate)." ".time_format($value->afternoon_timeout)?></td>
												<td><?=is_active($value->status)?></td>
												<td><a href="#" class="btn btn-default btn-sm"><i class="fa fa-list"></i> Info</a>  <a href="<?=site_url('attendance/start/'.$value->id)?>" class="btn btn-default btn-sm"><i class="fa fa-play"></i> Start</a> <a href="<?=site_url('events/edit/'.$value->id)?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Modify</a></td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>


					<!-- completed -->
					<div class="tab-pane " id="tab-completed">
						<label class="text-title">list completed events</label>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event Title</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Date Completed</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_completed)): ?>
										<?php foreach ($list_events_completed as $key => $value): ?>
											<tr>
												<td><?=$value->id?></td>
												<td><?=$value->event_title?></td>

												<td><?=toMMdy($value->event_startdate)." " .time_format($value->morning_timein)?></td>
												<td><?=toMMdy($value->event_enddate) . " ".time_format($value->afternoon_timeout)?></td>

												<td><?=toMMdy($value->date_completed) ." ".time_format($value->date_completed)?></td>
												<td><?=is_active($value->status)?></td>
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
						<label class="text-title">list completed events</label>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event Title</th>

										<th>Absent (Php)</th>
										<th>Late (Php)</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_events_canceled)): ?>
										<?php foreach ($list_events_canceled as $key => $value): ?>
											<tr>
												<td><?=$value->id?></td>
												<td><?=$value->event_title?></td>
												<td><?=number_format($value->absent,2)?></td>
												<td><?=number_format($value->late,2)?></td>

												<td><?=toMMdy($value->event_startdate)." " .time_format($value->morning_timein)?></td>
												<td><?=toMMdy($value->event_enddate) . " ".time_format($value->afternoon_timeout)?></td>

												<td><?=is_active($value->status)?></td>
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

<div class="modal" id="modal-sample">
	<div class="modal-dialog">
		<div class="modal-body">
			<p>Hello</p>
		</div>
	</div>
</div>