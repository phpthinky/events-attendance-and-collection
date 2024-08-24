		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Current Event</a></li>
			<li class="nav-item"><a class="nav-link"  href="<?=site_url('events')?>">List Event</a></li>

		</ul>
			</div>
			<div class="card-body">
						<div class="row">
							<div class="co-lg-4 col-md-4 col-xs-12">
								<div class="row">
									
									<?php if (!empty($event_info)): ?>
									<label class="col-md-12">Name of event: <b><?=$event_info->event_title?></b></label>
									<label class="col-md-12">Day:  <b><?=$event_info->no_days?></b></label>
									<label class="col-md-12">Attendee:  <b><?=$event_info->courses?></b></label>
									<label class="col-md-12">School Year:  <b><?=monthyear($event_info->schoolyear->start_year)?> to <?=monthyear($event_info->schoolyear->end_year)?></b></label>
									<label class="col-md-12">Semester:  <b><?=$event_info->semester?></b></label>
								<hr>
									<?php if ($event_info->has_afternoon == 0): ?>
									<label class="col-md-12">Event start:  <b><?=toMMdy($event_info->event_startdate).' '.date('h:i a',strtotime($event_info->morning_timein))?></b></label>
									<label class="col-md-12">Event end:  <b><?=toMMdy($event_info->event_enddate).' '.date('h:i a',strtotime($event_info->afternoon_timeout))?></b></label>	
									<?php endif ?>
									<?php if ($event_info->has_afternoon == 1): ?>

									<label class="col-md-12">Event start:  <b><?=toMMdy($event_info->event_startdate).' '.date('h:i a',strtotime($event_info->morning_timein))?></b></label>
									<label class="col-md-12">Event end:  <b><?=toMMdy($event_info->event_enddate).' '.date('h:i a',strtotime($event_info->morning_timeout))?></b></label>	
										
									<?php endif ?>

									<?php if ($event_info->has_afternoon == 2): ?>

									<label class="col-md-12">Event start:  <b><?=toMMdy($event_info->event_startdate).' '.date('h:i a',strtotime($event_info->afternoon_timein))?></b></label>
									<label class="col-md-12">Event end:  <b><?=toMMdy($event_info->event_enddate).' '.date('h:i a',strtotime($event_info->afternoon_timeout))?></b></label>	
										
									<?php endif ?>


									<?php endif ?>
								</div>
							</div>
				    <div class="col-lg-4 col-md-4 col-xs-12" >
				    <label>Scan you qrcode here!</label>
				    <span style="display:block;padding: 5px;font-size: 14px;" id="scan-result"></span>
				    <div id="qr-reader"></div>

				    </div>
				    <div class="col-md-4 col-xs-12">

								<div class="row">
								<div class="preview-profile-photo"></div>
				        
								</div>

				    	<?php if (!empty($event_info)): ?>
							<?php if ($event_info->has_afternoon == 0): ?>
				    		<form id="form-time-in-out" method="POST">
										
										<div class="d-none">
											<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
											<input type="hidden" name="event_day" value="<?=$event_info->no_days?>">
											

										</div>

									<label class="col-md-12"><input type="hidden" name="current_time" id="current_time" value="<?=date('Y-m-d H:i:s')?>"> <span id="current-time"><?=date('M d Y H:i:s')?></span></label>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out_type" value="1" id="morning" <?php if (date('H') < 12): ?> checked
										
									<?php endif ?>> MORNING</label>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out_type" value="2" value="afternoon" <?php if (date('H') > 11): ?>
										checked
									<?php endif ?>> AFTERNOON </label>
									<hr>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" checked name="in_out" value="in"> TIME IN</label>
									<label class="col-md-12"  style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out" value="out"> TIME OUT </label>
									</form>
				    		<?php endif ?>
							<?php if ($event_info->has_afternoon == 1): ?>


				    		<form id="form-time-in-out" method="POST">
										
										<div class="d-none">
											<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
											<input type="hidden" name="event_day" value="<?=$event_info->no_days?>">
											

										</div>

									<label class="col-md-12"><input type="hidden" name="current_time" id="current_time" value="<?=date('Y-m-d H:i:s')?>"> <span id="current-time"><?=date('M d Y H:i:s')?></span></label>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out_type" value="1" id="morning" checked> MORNING</label>
									<hr>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" checked name="in_out" value="in"> TIME IN</label>
									<label class="col-md-12"  style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out" value="out"> TIME OUT </label>
									</form>

				    		<?php endif ?>

							<?php if ($event_info->has_afternoon == 2): ?>


				    		<form id="form-time-in-out" method="POST">
										
										<div class="d-none">
											<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
											<input type="hidden" name="event_day" value="<?=$event_info->no_days?>">
											

										</div>

									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out_type" value="2" value="afternoon"
										checked> AFTERNOON </label>
									<hr>
									<label class="col-md-12" style="padding: 5px;cursor: pointer;"><input type="radio" checked name="in_out" value="in"> TIME IN</label>
									<label class="col-md-12"  style="padding: 5px;cursor: pointer;"><input type="radio" name="in_out" value="out"> TIME OUT </label>
									</form>

				    		<?php endif ?>

										<?php if ($event_info->status == 1): ?>
											
									<div class="col-md-12"><button id="start-scanner" class="btn btn-outline-success btn-sm">Start scanner</button> <button id="btn-stop-event" data-event_id="<?=$event_info->id?>" class="btn btn-outline-danger btn-sm">End event</button> </div>
									<div class="col-md-12">
										<hr>
										<button id="btn-cancel-event" data-event_id="<?=$event_info->id?>" class="btn btn-outline-primary btn-sm">Cancel event</button>
									</div>

										<?php endif ?>


				    	<?php endif ?>
								


				    </div>
				    <div class="col-lg-12 col-md-12 col-xs-12" >
				        <label>Scan result</label>
				        <div id="qr-reader-results">
				            <dv class="card">
				                <div class="card-header">LIST OF ATTENDEES</div>
				                <div class="card-body">
				                    
				                    <div class="table-responsive">
				                    	<table id="table-attendees" class="table table-hovered">
				                    		<thead>
				                    			<tr>
				                    				<th>ID#</th>
				                    				<th>Name</th>
				                    				<th>AM Time in</th>
				                    				<th>AM Time out</th>	                    				
				                    				<th>PM Time in</th>
				                    				<th>PM Time out</th>
				                    				<th></th>

				                    			</tr>
				                    		</thead>
				                    		<tbody>
				                    			
				                    		</tbody>
				                    	</table>
				                    	<table id="table-attendees2" class="table table-hovered d-none">
				                    		<thead>
				                    			<tr>
				                    				<th>ID#</th>
				                    				<th>Name</th>
				                    				<th>Time in</th>
				                    				<th>Time out</th>
				                    				<th></th>
				                    			</tr>
				                    		</thead>
				                    		<tbody>
				                    			
				                    		</tbody>
				                    	</table>
				                    </div>
				                </div>
				            </dv>
				        </div>
				        
				    </div>
				</div>

			</div>
		</div> 	
		</div>

<div class="modal" id="modal-profile">
	<div class="modal-dialog">
		<div class="modal-body">
			<p>
				<div class="preview-photo"></div>
			</p>
		</div>
	</div>
</div>