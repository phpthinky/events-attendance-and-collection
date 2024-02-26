		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Public scanner</a></li>

		</ul>
			</div>
			<div class="card-body">
						<div class="row">
							<div class="co-lg-4 col-md-4 col-xs-12">
								<div class="row">
								</div>
							</div>
				    <div class="col-lg-4 col-md-4 col-xs-12" >
				    <label>Scan you qrcode here!</label>
				    
				    <div id="qr-reader"></div>
				        
				    </div>
				    <div class="col-md-4 col-xs-12">
				    	
								<div class="row radio">
									
									<hr>
										
									<label class="col-md-12"><button id="start-scanner" class="btn btn-outline-primary">Start scanner</button></label>
								</div>


				    </div>
				    <div class="col-lg-12 col-md-12 col-xs-12" >
				        <label>Scan result</label>
				        <div id="qr-reader-results">
				            <dv class="card">
				                <div class="card-header">STUDENT BALANCE SHEET</div>
				                <div class="card-body">
				                	<div class="row">
				                		<div class="col-md-12">
				                			<h2 id="c-student-name"><?=isset($mga_utang->info) ? $mga_utang->info->fName.' '.$mga_utang->info->mName.' '.$mga_utang->info->lName. ' '.$mga_utang->info->ext: 'No name'?></h2>
				                		</div>
				                		<div class="col-md-12">

				                			<ul id="c-student-info">
				                				<?php if (!empty($mga_utang->info)): ?>
				                					
				                				<li><?=$mga_utang->info->address1?></li>
				                				<li><?=$mga_utang->info->course_sub_title?></li>
				                				<li><?=$mga_utang->info->contact_no?></li>
				                				<li><?=$mga_utang->info->year?> | <?=$mga_utang->info->section?></li>

				                				<?php endif ?>
				                			</ul>
				                		</div>
				                	</div>
				                    <div class="row">
				                    	
				                    <div class="table-responsive">
				                    	<table id="table-balance-sheet" class="table table-hovered">
				                    		<thead>
				                    			<tr>
				                    				<th>#</th>
				                    				<th>Event name</th>
				                    				<th>Balance</th>
				                    				<th>Status</th>
				                    				<th></th>

				                    			</tr>
				                    		</thead>
				                    		<tbody>
				                    			<?php if (!empty($mga_utang)): ?>
				                    			<?php $utang = $mga_utang->utang; ?>

				                    				<?php $i=1; foreach ($utang as $key => $value): ?>
				                    					<tr>
				                    						<td><?=$i++?></td>
				                    						<td><?=$value->event_title?></td>
				                    						<td><?=$value->bayarin?></td>
				                    						<td></td>
				                    					</tr>
				                    				<?php endforeach ?>
				                    			<?php endif ?>
				                    			
				                    		</tbody>
				                    	</table>
				                    </div>

				                    </div>
				                </div>
				            </dv>
				        </div>
				        
				    </div>
				</div>

			</div>
		</div> 	
		</div>
<div class="modal fade" id="modal-pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pay student balance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" id="form-pay">
        	<input type="hidden" name="event_id" id="pay_event_id" value="0">
        	<input type="hidden" name="student_id"id="pay_student_id"  value="0">
        	<div class="row form-group">
        		
        	<label>Input amount</label>
        	<input class="form-control" type="number" name="amount_paid">
        	</div>

        	<div class="row form-group">
        		
        	<label></label>
        	<input class="btn btn-outline-success" id="btn-paid" type="submit" name="submit" value="Pay">
        	</div>
        </form>
      </div>
      <div class="modal-footer d-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>