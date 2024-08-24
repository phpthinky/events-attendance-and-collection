		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Student details</a></li>
			<li class="nav-item"><a class="nav-link" href="<?=site_url('students/edit/'.$info->code)?>">Edit</a></li>

			<li class="nav-item"><a class="nav-link"data-toggle="tab" href="#tab-profile">Change profile photo</a></li>
		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
						
						<div class="row">
							<div class="col-md-6 col-sm-6 print-6">
						Students Details
						<hr>

						<div class="qr-code">

						<div class="row">
							<a class="btn btn-outline-success btn-sm" href="<?=base_url('assets/img/qrcode/'.$info->code.'.png')?>" download="<?=isset($info) ? $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext.'.png' : 'my_qr_code.png' ?>">Download QR code</a>
						</div>	
							<?=isset($info) ? '<img src="'.base_url('assets/img/qrcode/').$info->code.'.png"/>' : '' ?>
								
							</div>	
         
							</div>
							<div class="col-md-6 col-sm-6 print-6">
								<div class="row">
									<img src="<?=(!empty($info->profile_photo) ? $info->profile_photo : base_url('assets/img/user.png'))?>" class="profile-photo">
								</div>
								<div class="row">
									<div class="col-md-12"><label class="text-title">Name</label><span class="text-description"><?=isset($info) ? $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext : '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">Course</label><span class="text-description"><?=isset($info) ? $info->course_sub_title : '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">Year & Section</label><span class="text-description"><?=isset($info) ? $info->grade.'-'.$info->section : '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">Address</label><span class="text-description"><?=isset($info) ? $info->address1 : '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">Contact</label><span class="text-description"><?=isset($info) ? $info->contact_no: '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">Email</label><span class="text-description"><?=isset($info->email) ? $info->email: '' ?></span></div>
								</div>

								<div class="row">
									<div class="col-md-12"><label class="text-title">School year</label><span class="text-description"><?=isset($info) ? $info->sy : '' ?> Semester <?=isset($info) ? $info->semester : '' ?></span></div>
								</div>


								<div class="row">
									<div class="col-md-12"><label class="text-title">Semester</label><span class="text-description"><?=isset($info) ? $info->semester : '' ?></span></div>
								</div>
							</div>
							<!-- events attended -->
							<div class="col-md-12">
								<label>Event attended</label>
								<hr>		
								<div class="table-responsive">
									
								<table class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Event Name</th>
											<th rowspan="2">Day</th>
											<th rowspan="2"></th>
											<th colspan="2">Morning</th>
											<th colspan="2">After noon</th>
											<th rowspan="2">Penalty</th>
											<th rowspan="2">Status</th>
										</tr>
										<tr>
											<th>Time-in</th>
											<th>Time-out</th>
											<th>Time-in</th>
											<th>Time-out</th>
											
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($events_penalty)): ?>
											<?php foreach ($events_penalty as $key => $value): ?>
												<tr>
													<td><?=$value->event_title?></td>
													<td><?=$value->no_days?></td>
													<td><?=$value->type?></td>
													<td><?=$value->am_in?></td>
													<td><?=$value->am_out?></td>
													<td><?=$value->pm_in?></td>
													<td><?=$value->pm_out?></td>
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
					<div id="tab-profile" class="tab-pane">
						<label>Change profile</label>
						<hr>
						<div class="form-responsive">
							<form class="form" id="form-change-profile">
								<div class="row form-group">
									<label></label>
								<input type="file" class="file-input" name="profile" id="profile-photo" accept=".jpg,.png">
								</div>

						<div class="row">
							
                            <div class="col-md-4">
                              <img class="preview-photo" src="<?=base_url('assets/img/user.png')?>">
                            </div>

						</div>
						<div class="row">
							<input type="hidden" name="student_id" value="<?=$info->code?>">
						</div>
						<div class="row">
							<br>
							<input type="submit" name="submit" value="Upload" class="btn btn-success">
						</div>
							</form>
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