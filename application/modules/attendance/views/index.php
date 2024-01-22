		
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
									<label class="col-md-12">Event start:  <b><?=toMMdy($event_info->event_startdate).' '.date('h:i a',strtotime($event_info->morning_timein))?></b></label>
									<label class="col-md-12">Event end:  <b><?=toMMdy($event_info->event_enddate).' '.date('h:i a',strtotime($event_info->afternoon_timeout))?></b></label>

									<label class="col-md-12">Day:  <b><?=getDays($event_info->event_timestart,date('Y-m-d'))+1?></b></label>
									<?php endif ?>
								</div>
							</div>
				    <div class="col-lg-4 col-md-4 col-xs-12" >
				    <label>Scan you qrcode here!</label>
				    
				    <div id="qr-reader"></div>
				        
				    </div>
				    <div class="col-md-4 col-xs-12">
				    	
								<div class="row radio">
									<form id="form-time-in-out" method="POST">

										<?php if (!empty($event_info)): ?>
											
										<div class="d-none">
											<input type="hidden" name="event_id" value="<?=isset($event_info->id) ? $event_info->id : 0?>">
											<input type="hidden" name="event_day" value="<?=getDays($event_info->event_timestart,date('Y-m-d'))+1?>">
											

										</div>
										<?php endif ?>

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
									<hr>
									<?php if (!empty($event_info)): ?>
										
									<label class="col-md-12"><button id="start-scanner" class="btn btn-outline-primary">Start scanner</button></label>
									<?php endif ?>
								</div>


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
				                    				<th>Time in</th>
				                    				<th>Time out</th>

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

<div class="modal" id="modal-sample">
	<div class="modal-dialog">
		<div class="modal-body">
			<p>Hello</p>
		</div>
	</div>
</div>