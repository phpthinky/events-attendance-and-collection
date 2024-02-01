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
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead style="text-align: center;">
									<!--tr>
										<th rowspan="2">Event Name</th>
										<th colspan="2">Penalty</th>
										<th ></th>
									</tr -->
									<tr>
										<th>Event Name</th>
										<th>Late</th>
										<th>Absent</th>
										<th></th>
									</tr>
								</thead>

								<tbody  style="text-align: center;">
									<?php foreach ($list_events_incoming as $key => $value): ?>
										<tr>
											<td><?=$value->event_title?></td>
											<td><?=$value->late?></td>
											<td><?=$value->absent?></td>
											<td>
												<a href="<?=site_url('attendance/start/'.$value->id)?>" class="btn btn-outline-success btn-sm"><i class="fa fa-play"></i> Activate</a> <?php if ($value->status == 0): ?>
													<a class="btn btn-outline-info btn-sm" href="<?=site_url('events/edit/'.$value->id)?>" ><i class="fa fa-edit"></i> Modify</a>
												<?php endif ?>

											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
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