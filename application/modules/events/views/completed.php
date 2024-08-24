	
<div class="form-responsive">
	<h4>List of event attendance by course</h4>
	<div class="row">

                      <div class="col-md-3">
                        <label for="events">School Year</label>

                          <select class="form-control" name="year_id" id="select-year_id">
                          <option value="0">No Selected</option>
                          <?php if (!empty($list_schoolyears)): ?>
                          	
                          <?php foreach ($list_schoolyears as $key => $value): ?>
                            <option value="<?=$value->id?>"><?=monthyear($value->start_year) .' - '. monthyear($value->end_year)?> -  semester <?=$value->semester?></option>
                          <?php endforeach ?>
                            </select>

                          <?php endif ?>
                      </div>
                      <div class="col-md-3">
                        <label for="events">Event name</label>

                          <select class="form-control" name="events" id="select-events">
                          <option value="0">No Selected</option>
                          <?php foreach ($list_events_completed as $key => $value): ?>
                            <option value="<?=$value->id?>" <?php if ($value->id == $event_id): ?>
                              selected
                            <?php endif ?>><?=$value->event_title?></option>
                          <?php endforeach ?>
                            </select>
                      </div>
                       <div class="col-md-3">
                        <label for="course">Course</label>
                          <select class="form-control" name="course" id="select-course">
                          <option value="0">No selected</option>
                          
                          <?php foreach ($list_courses as $key => $value): ?>
                            <option value="<?=$value->id?>"><?=$value->course_title?></option>
                          <?php endforeach ?>
                        </select>
                          </div>

                       <div class="col-md-3">
                        <label for="btn-print" style="display:block;">&nbsp;</label>
                       	<button class="btn btn-outline-info btn-print" id="btn-print">Print</button>
                       
                        <a href="javascript:void(0)" class="btn btn-outline-success btn-export" id="btn-export">Export</a>
                       </div>
                    </div>

</div>
<hr>
	<div class="table-responsive">
							<table class="table table-bordered" id="table-list-completed">
								
								<thead>
										<tr>
											<th rowspan="2">Student Name</th>
											<th rowspan="2">Course</th>
											<th rowspan="2">Date of event</th>
											<th colspan="2">Morning</th>
											<th colspan="2">After noon</th>
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
									
								</tbody>
							</table>
						</div>