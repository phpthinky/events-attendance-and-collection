		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Collection scanner</a></li>

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
				                    						<td><?=$value->late_fee?></td>
				                    						<td><button class="btn btn-outline-success btn-sm">Pay</button></td>
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

<div class="modal" id="modal-sample">
	<div class="modal-dialog">
		<div class="modal-body">
			<p>Hello</p>
		</div>
	</div>
</div>