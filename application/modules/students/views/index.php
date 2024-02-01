		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Student Libary</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-add">Add</a></li>
			<li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#tab-import">Import data</a></li>

		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
						List of all students
						<hr>

                              <div class="row">

                                <div class="col-md-2">
                                  
                                  <label for="select-center-type">Course</label>
                                  <select id="select-course-id" name="course_id" class="form-control">
                                    <option value="0" selected>View All</option>
                                     <?php if (!empty($list_courses)): ?>
                                      <?php foreach ($list_courses as $key => $value): ?>
                                        <option value="<?=$value->id?>"><?=$value->course_sub_title?></option>
                                      <?php endforeach ?>
                                    <?php endif ?>

                                  </select>
                                </div>
                                <div class="col-md-2">
                                  
                                  <label for="select-barangay">School Year</label>
                                  <select name="year_id" id="select-year-id" class="form-control">
                                    <?php if (!empty($sy)): ?>
                                      <?php foreach ($sy as $key => $value): ?>
                                        <option value="<?=$value->id?>"><?=monthyear($value->start_year)?> - <?=monthyear($value->end_year)?></option>
                                      <?php endforeach ?>
                                    <?php endif ?>
                                  </select>
                                </div>

                                <div class="col-md-6">
                                  <label for="searchstring">Searh here..</label>
                                  <input type="search" id="searchstring-center" name="searchstring" placeholder="Search here..." class="form-control">
                                </div>
                                
                                <div class="col-md-2">
                                  <label for="filter-buttons"><span class="area-hidden">&nbsp;</span></label>
                                  <div class="row" id="filter-buttons">
                                    <div class="col-sm-2 col-xs-2 col-md-6 d-none">
                                  <button type="button" class="btn btn-md btn-primary">Filter</button>
                                      
                                    </div>
                                    <div class="col-sm-2 col-xs-2 col-md-6">
                                  <a href="#" class="btn btn-md btn-success" id="btn-export-centers">Go</a>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
          <div class="row barangay table-responsive">
          <table class="table table-bordered" id="table-list-students-library">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Amount paid</th>
                <th>Amount to pay</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                            	<?php $total_penalty = $value->late + $value->absent; ?>
                        <tr>
                          <td><a class="btn btn-block btn-default" href="<?=site_url('students/info/'.$value->code)?>"><i class="fa fa-qrcode"></i></a></td>
                          <td><?=$value->code?></td>
                          <td><?=trim($value->fName.' '.$value->mName.' '.$value->lName.' '.$value->ext)?></td>

                          <td><?=$value->course_sub_title?></td>
                          <td><?=$value->grade.'-'.$value->section?></td>
                          <td><?=number_format($value->total_bayad,2)?></td>
                          <td><?=number_format($total_penalty,2)?></td>
                          <!--td><?php if ($total_penalty > $value->total_bayad): ?>
                          	<a class="btn btn-outline-success btn-sm" href="#">Pay</a>
                          <?php endif ?></td-->
                        </tr>
                        
                          <?php endforeach ?>
                       
                        
                        <?php endif ?>
                        
            </tbody>
          </table>

          </div>
					</div>

					<!-- add -->

					<div class="tab-pane" id="tab-add">
						Add Students
						<hr>

						<?php $this->load->view('student-add') ?>
					</div>
					<!-- import -->
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