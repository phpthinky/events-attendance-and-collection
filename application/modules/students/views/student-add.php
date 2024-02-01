<div class="container-fluid">
  <div class="card">
    <div class="card-body form">
      <form class="form-responsive" id="form-add-students" action="#<?=site_url('students/add_students')?>" method="POST">
        


                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Student ID</label>
                        <div class="col-sm-12 col-md-10">                        
                          <input type="text" name="student_id" value="<?=isset($id_number) ? $id_number : 0?>"> <span class="id-check">Available</span>                       
                        </div>

                      </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                           <div class="row">
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" required name="fName" placeholder="First Name" value="" required /></div>
                            <div class="col-xs-12 col-md-1"><input type="text" class="form-control" name="mName" placeholder="Mi." value=""/></div>
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="lName" required placeholder="Last Name" value="" required /></div>
                            
                            <div class="col-xs-12 col-md-2"><input type="text" name="ext" value="" class="form-control" placeholder="Extension: Jr." width="50px"></div>

                            <div class="col-xs-12 col-md-1">
                              <button class="btn btn-outline-success btn-sm" id="btn-check-student-name" type="button">Check</button>

                            </div>
                            
                            </div>
                            

                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          
                        </div>
                        <div class="col-md-10">
                          <ul class="list-group" id="add-student-list-group">
                            <li class="list-group-item"><a href="#" class="nav-link">list of name will display here...</a>  </li>
                          </ul>
                        </div>
                      </div>



                    <div id="add-other-info" class="d-none">


                      <div class="form-group row">
                        <label for="barangay" class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Residential address" name="address" id="address" required>
                        </div>
                      </div>

                      
                      <div class="form-group row">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Contact Number</label>
                          
                          <div class="col-xs-12 col-md-4">
                         <input class="form-control" placeholder="Contact Number" name="contact_no" id="contact_no">
                        </div>
                      </div>

                      <div class="form-group row d-none">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Email (optional)</label>
                          
                          <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Email" name="email" id="email">
                        </div>
                      </div>

                      <hr>
 <span>Education Details</span>
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">School Year</label>
                        <div class="col-sm-12 col-md-10">
                          
                          <select class="form-control" name="year_id" id="year_id" required>
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

                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Course</label>
                        <div class="col-sm-12 col-md-10">
                          
                          <select class="form-control" name="course" id="course" required>
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

                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Year & Section</label>
                        <div class="col-sm-12 col-md-10">
                          
                           <div class="row">
                          
                            <div class="col-xs-12 col-md-4">

                          <select class="form-control" name="grade" id="grade" required>
                            <option value="">Select Year</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                            <div class="col-xs-12 col-md-4">

                          <select class="form-control" name="section" id="section" required>
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
                            <div class="col-xs-12 col-md-4"></div>
                            
                            <div class="col-xs-12 col-md-2"></div>

                            <div class="col-xs-12 col-md-1"></div>
                            </div>


                        
                        </div>

                      </div>



                      <div class="form-group row">
                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Semester</label>

                            <div class="col-xs-12 col-md-10">

                              <div class="row">
                                <div class="col-md-4">
                                  
                                <select class="form-control" name="semester" id="semester" required>
                                  <option value="1">First semester</option>
                                  <option value="2">Second semester</option>
                                </select>
                                </div>
                              </div>

                        </div>
                        </div>
                      <div class="form-group row">
                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Enrollment Status</label>

                            <div class="col-xs-12 col-md-10">

                              <div class="row">
                                <div class="col-md-4">
                                <select class="form-control" name="status" id="status" required>
                                  <option value="0">None</option>
                                  <option value="1" selected>Enrolled</option>
                                  <option value="2">Not enrolled</option>
                                </select>
                              </div>
                            </div>
                        </div>
                    </div>
                      <div class="form-group row">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">&nbsp;</label>
                          
                          <div class="col-sm-12 col-md-10">
                         <input class="btn btn-outline-success btn-md btn-add" name="submit" type="submit" value="Save">
                        </div>
                      </div>









                    </div>
                    <!--  end other info -->


        <div class="row errors">
          <?php //var_dump($this->input->post()); ?>
        </div>
      </form>

    </div>

  </div>
</div>
