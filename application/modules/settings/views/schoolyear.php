	<section class="content-header"></section>
	<section class="content">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs">
					<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-home">List all</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-add">Add</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-edit-sy">Edit</a></li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-home">
		            <label class="text-title">List all school years</label>
				
			          <div class="row">
							          
							<div class="table-responsive">
									<table class="table table-bordered" id="tbl-sy">
										<thead>
											<tr>
												<th>#</th>
												<th>School Year</th>
												<th>Semester</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($listschoolyear)): ?>
												<?php $i=0; foreach ($listschoolyear as $key => $value): ?>
													<tr>
														<td><?=++$i?></td>
														<td><?=$value->start_year?>-<?=$value->end_year?></td>
														<td><?=schoolyear_status($value->status)?></td>
														<td><a data-year_id="<?=$value->id?>" href="#tab-edit" class="btn btn-sm btn-edit-sy"><i class="fa fa-edit"></i></a></td>
													</tr>
												<?php endforeach ?>
											<?php endif ?>
										</tbody>
									</table>
								</div>
          				</div>
					</div>

		          <div class="tab-pane" id="tab-add">
		            <label class="text-title">Add School year</label>
		            <hr>
		            <form class="form-responsive" id="form-school-year">
		            	<div class="row form-group">
		            		<label>Semester</label>
		            		<select name="semester" class="form-control">
		            			<option value="1">1st Semester</option>
		            			<option value="2">2nd Semester</option>
		            		</select>
		            	</div>
						<div class="row form-group">
		            		<label>Start of class</label>
		            		<input type="date" name="start_year" class="form-control" required>
		            	</div>

		            	<div class="row form-group">
		            		<label>End of class</label>
		            		<input type="date" name="end_year" class="form-control" required>
		            	</div>

		            	<div class="row form-group d-none">
		            		<label>Status</label>
		            		<select name="status" class="form-control" required>
		            			<option value="0">Select status</option>
		            			<option value="1" selected>Present</option>
		            			<option value="2">Completed</option>
		            		</select>
		            	</div>
		            	<div class="row form-group">
		            		<label>&nbsp;</label>
		            		<input type="hidden" name="action" value="add">
		            		<input type="submit" name="add_school_year" class="btn btn-outline-success" value="Save">
		            	</div>
		            </form>
		          </div>

		          <div class="tab-pane" id="tab-edit-sy">
		            <label class="text-title">Edit school year</label>
		            <hr>
		            <form class="form-responsive" id="form-school-year-edit">
		            	<div class="row form-group">
		            		<label>Start of class</label>
		            		<input type="date" name="start_year" class="form-control" required>
		            	</div>

		            	<div class="row form-group">
		            		<label>End of class</label>
		            		<input type="date" name="end_year" class="form-control" required>
		            	</div>

		            	<div class="row form-group">
		            		<label>Status</label>
		            		<select name="status" class="form-control" required>
		            			<option value="0">Select status</option>
		            			<option value="1">Present</option>
		            			<option value="2">Completed</option>
		            		</select>
		            	</div>
		            	<div class="row form-group">
		            		<label>&nbsp;</label>
		            		<input type="hidden" name="action" value="add">
		            		<input type="hidden" name="year_id" value="0">
		            		<input type="submit" name="save" class="btn btn-outline-success d-none" value="Save">
		            	</div>
		            </form>
		          </div>
						</div>
			</div>
			</div>
	</section>



<section class="content">
	

	
</section>