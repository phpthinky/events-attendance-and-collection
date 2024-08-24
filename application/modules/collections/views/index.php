		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Collections</a></li>

		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
                                  
					<label class="text-title">Collections </label>


                              <div class="row selections">
                                <form id="form-collections" action="javascript:void(0)" method="POST">
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
                                    <div class="col-sm-2 col-xs-2 col-md-6">
                                  <a href="#" class="btn btn-md btn-outline-primary" id="btn-print">Print</a>

                                      
                                    </div>
                                    <div class="col-sm-2 col-xs-2 col-md-6">
                                  <a href="#" class="btn btn-md btn-outline-success" id="btn-export">Export</a>
                                      
                                    </div>
                                  </div>
                                </div>
                                </form>
                              </div>

						<div class="table-responsive">
							<table class="table table-bordered" id="table-collections">
            <thead>
              <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Amount Paid</th>
                <th>Date Paid</th>
                <th>Semester</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                            
                        <tr>
                          <td><?=$value->student_id?></td>
                          <td><?=$value->student_name?></td>

                          <td><?=$value->course?></td>
                          <td><?=$value->amount_pay?></td>
                          <td><?=$value->date_of_payment?></td>
                          <td><?=semester($value->semester)?></td>
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
<span class="d-none" id="semester_no"><?=isset($semester) ? $semester : 0?></span>