		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Student details</a></li>
			<li class="nav-item"><a class="nav-link" href="<?=site_url('students/edit/'.$info->code)?>">Edit</a></li>
		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
						
						<div class="row">
							<div class="col-md-6">
						Students Details
						<hr>

						<div class="qr-code">

						<div class="row">
							<a class="btn btn-outline-success btn-sm" href="<?=base_url('assets/img/'.$info->code.'.png')?>" download="<?=isset($info) ? $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext.'.png' : 'my_qr_code.png' ?>">Download QR code</a>
						</div>	
							<?=isset($info) ? '<img src="'.base_url('assets/img/').$info->code.'.png"/>' : '' ?>
								
							</div>	
          <div class="table-responsive">

          	<table class="table table-hovered">
          		<tr>
          			<td>Name</td>
          			<td><?=isset($info) ? $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext : '' ?></td>
          		</tr>
          		<tr>
          			<td>Course</td>
          			<td><?=isset($info) ? $info->course_sub_title : '' ?></td>
          		</tr><tr>
          			<td>Year & Section</td>
          			<td><?=isset($info) ? $info->grade.'-'.$info->section : '' ?></td>
          		</tr><tr>
          			<td>Address</td>
          			<td><?=isset($info) ? $info->address1 : '' ?></td>
          		</tr><tr>
          			<td>Contact number</td>
          			<td><?=isset($info) ? $info->contact_no: '' ?></td>
          		</tr>
          		<tr>
          			<td>Email</td>
          			<td><?=isset($info) ? $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext : '' ?></td>
          		</tr>

          		<tr>
          			<td>Last sy enroll</td>
          			<td><?=isset($info) ? $info->sy : '' ?></td>
          		</tr>

          		<tr>
          			<td>Last semester enroll</td>
          			<td>Semester <?=isset($info) ? $info->semester : '' ?></td>
          		</tr>
          	</table>
          </div>
							</div>

							<!-- events attended -->
							<div class="col-md-6">
								<label>Event attended</label>
								<hr>		
								<div class="table-responsive">
									
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Event name</th>
											<th>Day</th>
											<th>Penalty</th>
											<th>Status</th>

										</tr>
									</thead>
									<tbody>
										<?php if (!empty($events_penalty)): ?>
											<?php foreach ($events_penalty as $key => $value): ?>
												<tr>
													<td><?=$value->event_title?></td>
													<td><?=$value->no_days?></td>
													<td><?=$value->penalty?></td>
													<td><?=is_paid($value->payment_status)?></td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>

								</div>
								<div class="row">
									<div class="col-md-12"><button class="btn btn-outline-primary btn-print"><i class="fa fa-print"></i></button></div>
								</div>
							</div>
						</div>
					</div>

					<!-- add -->

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