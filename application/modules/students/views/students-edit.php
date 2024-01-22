<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <form class="form-responsive" id="form-edit-students" action="<?=site_url('students/save_edited')?>" method="POST">
        

                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Student ID</label>
                        <div class="col-sm-12 col-md-10">
                          <input type="text" name="student_id_disabled" value="<?=$info->code?>" readonly>                        
                          <input type="hidden" name="student_id" value="<?=$info->code?>">                        
                        </div>

                      </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                           <div class="row">
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" required name="fName" placeholder="First Name" value="<?=$info->fName?>" required /></div>
                            <div class="col-xs-12 col-md-1"><input type="text" class="form-control" name="mName" placeholder="Mi." value="<?=$info->mName?>"/></div>
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="lName" required placeholder="Last Name" value="<?=$info->lName?>" required /></div>
                            
                            <div class="col-xs-12 col-md-2"><input type="text" name="ext" value="<?=$info->ext?>" class="form-control" placeholder="Extension: Jr." width="50px"></div>

                            <div class="col-xs-12 col-md-1">
                              <button class="btn btn-outline-success btn-sm" id="btn-check-student-name" type="button">Check</button>

                            </div>
                            
                            </div>
                            

                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <ul class="list-group d-none" id="add-student-list-group">
                            <li class="list-group-item"><a href="#" class="nav-link">list of name will display here...</a>  </li>
                          </ul>
                        </div>
                      </div>



                    <div id="add-other-info" class="">

                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Course</label>
                        <div class="col-sm-12 col-md-10">
                          
                          <select class="form-control" name="course" id="course" required>
                            <option value="">Select course</option>
                            <?php if (!empty($courses)): ?>
                              <?php foreach ($courses as $key => $value): ?>
                                <option value="<?=$value->id?>" <?php if ($info->course_id == $value->id): ?>
                                  selected
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


                          <select class="form-control" name="year" id="year" required>
                            <option value="1" <?php if ($info->year == 1): ?>
                                  selected
                                <?php endif ?>>First semester</option>
                            <option value="2" <?php if ($info->year == 2): ?>
                                  selected
                                <?php endif ?>>Second semester</option>
                          </select>

                        </div>
                            <div class="col-xs-12 col-md-4">

                          <select class="form-control" name="grade" id="grade" required>
                            <option value="">Select Year</option>
                            <option <?php if ($info->grade == 1): ?>
                                  selected
                                <?php endif ?>>1</option>
                            <option <?php if ($info->grade == 2): ?>
                                  selected
                                <?php endif ?>>2</option>
                            <option <?php if ($info->grade == 3): ?>
                                  selected
                                <?php endif ?>>3</option>
                            <option <?php if ($info->grade == 4): ?>
                                  selected
                                <?php endif ?>>4</option>
                            <option <?php if ($info->grade == 5): ?>
                                  selected
                                <?php endif ?>>5</option>
                          </select>
                        </div>
                            <div class="col-xs-12 col-md-4">

                          <select class="form-control" name="section" id="section" required>
                            <option value="">Select section</option>
                            <option <?php if ($info->section == "A"): ?>
                                  selected
                                <?php endif ?>>A</option>
                            <option <?php if ($info->section == "B"): ?>
                                  selected
                                <?php endif ?>>B</option>
                            <option <?php if ($info->section == "C"): ?>
                                  selected
                                <?php endif ?>>C</option>
                            <option <?php if ($info->section == "D"): ?>
                                  selected
                                <?php endif ?>>D</option>
                            <option <?php if ($info->section == "E"): ?>
                                  selected
                                <?php endif ?>>E</option>
                            <option <?php if ($info->section == "F"): ?>
                                  selected
                                <?php endif ?>>F</option>
                            <option <?php if ($info->section == "G"): ?>
                                  selected
                                <?php endif ?>>G</option>
                          </select>
                        </div>
                            <div class="col-xs-12 col-md-4"></div>
                            
                            <div class="col-xs-12 col-md-2"></div>

                            <div class="col-xs-12 col-md-1"></div>
                            </div>


                        
                        </div>

                      </div>



                      <div class="form-group row">
                        <label for="barangay" class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Residential address" name="address" id="address" value="<?=$info->address1?>" required>
                        </div>
                      </div>

                      
                      <hr>
 <span>Contact Details</span>
                      <div class="form-group row">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Contact Number</label>
                          
                          <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Contact Number" name="contact_no" id="contact_no" value="<?=$info->contact_no?>">
                        </div>
                      </div>

                      <div class="form-group row d-none">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">Email (optional)</label>
                          
                          <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Email" name="email" id="email">
                        </div>
                      </div>

                      <div class="form-group row">

                         <label for="province" class="col-sm-12 col-md-2 col-form-label">&nbsp;</label>
                          
                          <div class="col-sm-12 col-md-10">
                         <input class="btn btn-outline-success btn-md" name="submit" type="submit" value="Save">
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