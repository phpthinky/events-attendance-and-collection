    
    <div class="container-fluid">
      <br>
    <div class="card">
      <div class="card-header">
        
    <ul class="nav nav-tabs">
      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Student Libary</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-add">Add</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#modal-scanner" href="#tab-quick-edit">Quick edit</a></li>
      <li class="nav-item"><a class="nav-link" href="<?=site_url('import')?>">Import data</a></li>

    </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab-family">
            List of all students
            <hr>

                              <div class="row">

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
          <table class="table table-bordered" id="table-list-students-library" >
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Total Penalty</th>
                <th>Amount paid</th>
                <th>Amount to pay</th>
              </tr>
            </thead>
            <tbody style="font-size: 16px;">

                        
                         <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                              <?php
                               $total_penalty = $value->late + $value->absent;
                               $topay = ($total_penalty - $value->total_bayad);

                                ?>
                            
                        <tr>
                          <td><a class="btn btn-block btn-default" href="<?=site_url('students/info/'.$value->code)?>"><i class="fa fa-qrcode"></i></a></td>
                          <td><?=$value->code?></td>
                          <td><?=trim($value->fName.' '.$value->mName.' '.$value->lName.' '.$value->ext)?></td>

                          <td><?=$value->course_sub_title?></td>
                          <td><?=$value->grade.'-'.$value->section?></td>
                          <td><?=number_format($total_penalty,2)?></td>

                          <td><?=number_format($value->total_bayad,2)?></td>
                          <td><a href="#" class="text-danger"><?=($topay)?></a></td>
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



<!-- notifivation -modal -->
<div class="modal" id="modal-scanner">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">QRCODE SCANNER</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body form">
        <div class="row">
          
            <div class="col-sm-12 col-xs-12 col-lg-6 " id="scanner" >
            <label>Scan you qrcode here!</label>
            
            <div id="qr-reader"></div>
                
            </div>
            <!-- end scanner -->
            <div class="col-sm-12 col-xs-12 col-lg-6 " id="details">
            <div class="container-fluid">
                <div class="row">
                  
                  <hr>
                    
                  <label class="col-md-12"><button id="start-scanner" class="btn btn-outline-primary">Start scanner</button></label>
                </div>
              <form method="post" action="javascript:void(0)" id="form-quick-info">
                
                <div class="row">
                  
                    <div id="quick-info" class="">

                      <div class="form-group row">
                        <label for="student_name" class="col-form-label">Student name</label>
                        <span id="student_name" class="form-control" style="display: block;">Juan Dela Cruz</span>
                         <input type="hidden" name="student_id" value="">
                      </div>
                      <div class="form-group row">
                        <label for="age" class="col-form-label">School Year</label>
                         
                          <select class="form-control" name="year_id" id="m_year_id" required>
                            <option value="">School year</option>
                            <?php if (!empty($listschoolyear)): ?>
                              <?php foreach ($listschoolyear as $key => $value): ?>
                                <option value="<?=$value->id?>" 
                                  <?php if ($value->status == 1): ?>
                                    selected
                                  <?php endif ?>><?=$value->sy_start_year.' - '.$value->sy_end_year?></option>
                              <?php endforeach ?>
                            <?php endif ?>
                          </select>
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-form-label">Course</label>
                          
                          <select class="form-control" name="course" id="m_course" required>
                            <option value="">Select course</option>
                            <?php if (!empty($courses)): ?>
                              <?php foreach ($courses as $key => $value): ?>
                                <option value="<?=$value->id?>" <?php if (isset($course_id)): ?>
                                  <?php if ($course_id == $value->id): ?>
                                    selected
                                  <?php endif ?>
                                <?php endif ?>><?=$value->course_title?></option>
                              <?php endforeach ?>
                            <?php endif ?>
                          </select>

                        

                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-form-label">Semester</label>
                        <select class="form-control" name="year" id="m_year" required>
                            <option value="1">First semester</option>
                            <option value="2">Second semester</option>
                          </select>

                      </div>
 
                            <div class="row form-group">
                        <label for="age" class="col-form-label">Year</label>

                          <select class="form-control" name="grade" id="m_grade" required>
                            <option value="">Select Year</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>

                            <div class="row form-group">
                        <label for="age" class="col-form-label">Section</label>

                          <select class="form-control" name="section" id="m_section" required>
                            <option value="">Select section</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                          </select>
                        </div>

                            <div class="row form-group">
                        <label for="age" class="col-form-label">Status</label>

                          <select class="form-control" name="status" id="m_status" required>
                            <option value="0">Select status</option>
                            <option value="1">Enrolled</option>
                            <option value="2">Not enrolled</option>
                          </select>
                        </div>
                            <div class="row form-group">
                              <button class="btn btn-outline-success btn-save" type="submit"><i class="fa fa-save"></i> Save</button>
                        </div>
                        
                      </div>
                      <!-- end row -->
                </div>
              </form>
            </div>    
                


            </div>
            <!-- end details-->
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer d-none">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
