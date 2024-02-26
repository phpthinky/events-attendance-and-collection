
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?=current_url()?>" method="POST">
              <h1>Login Form</h1>
              <div class="error-area" style="padding:5px;">
                <?php if(!empty($errors)) { for ($i=0; $i < count($errors); $i++) { 
                  // code...
                  echo "<span class='text text-danger'>".$errors[$i]."</span>";
                }} ?>
              </div>
              <div>
                <input type="text" class="form-control" name="userName" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="passWord" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Enroll student </a>
                </p>
                <p><a href="<?=site_url('scanner')?>">Public scanner</a></p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?=base_url('assets/img/org-logo.png')?>" style="width: 150px;height: 130px;"></h1>
                  <p>©<?=date('Y')?> Students Organization Collections and Events Monitoring System</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            

              <form method="post" action="javascript:void(0)" id="form-enroll">
                
                <div class="row">
                  
                    <div id="quick-info" class="">
                        <div class="form-group row">
                        <label for=" student_id">Student ID</label>
                                                
                          <input type="text" class="form-control" name="student_id" id="student_id" value="<?=isset($id_number) ? $id_number : ''?>" placeholder ="Enter ID Number" min="8" required>                       

                      </div>
                      <div class="form-group row">
                        <label for="student_name" class="col-form-label">Student name</label>
                        
                         <input type="text" name="fName" placeholder="First name"  class="form-control" value="" required>
                         <input type="text" name="mName" placeholder="Middle name"  class="form-control" value="">
                         <input type="text" name="lName" placeholder="Last name"  class="form-control" value="" required>
                         <input type="text" name="ext" placeholder="Extension eg. JR"  class="form-control" value="">
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-form-label">Gender</label>
                          
                          <select class="form-control" name="gender" id="gender" required>
                            <option value="">Select gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            
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

                            <div class="row form-group d-none">
                        <label for="age" class="col-form-label">Status</label>

                          <select class="form-control" name="status" id="m_status" required>
                            <option value="0">Select status</option>
                          </select>
                        </div>
                            <div class="row form-group">

                        <?php  //$this->aauth->generate_recaptcha_field(); ?>
                        </div>
                        
                            <div class="row form-group">
                              <button class="btn btn-outline-success btn-save" type="submit"><i class="fa fa-save"></i> Save</button>
                        </div>
                        
                      </div>
                      <!-- end row -->
                </div>
              </form>

          </section>
        </div>
      </div>