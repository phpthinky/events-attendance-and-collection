

      	<div class="card">
      		<div class="card-header">
      			Add new student
      		</div>
      		<div class="card-body">

              

        <form class="form-horizontal" id="frmaddstudents" action="<?=site_url('students/add')?>" method="POST">
          <div class="container-fluid">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                    <div class="loader d-none"><img src="<?=base_url('assets/img/loader.gif')?>"></div>
                    <div id="error-area"></div>
                  </div>
                </div>

                     
                      <div class="row">
                        <div class="col-sm-12 col-md-6 col-xs-12">
                           <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-xs-12 col-form-label">Student type</label>
                        <div class="col-sm-12 col-md-8">
                          <select class="form-control" name="StudentType" id="StudentType" required>

                            <option value="1">New</option>
                            <option value="2">Repeater</option>
                          </select>
                        </div>
                      </div>

                        </div>
                        <div class="col-sm-12 col-md-6 col-xs-12">
                          
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-xs-12  col-form-label">School Year</label>
                        <div class="col-sm-12 col-md-8">
                          <select class="form-control" name="class_schedule" id="class_schedule" required>
                            <option value="0">Select class schedule</option>
                            <?php if (!empty($schoolyears)): ?>
                                <?php foreach ($schoolyears as $key => $value): ?>
                                  <option value="<?=$value->YearId?>"><?=tomdy($value->YearStart)?> to <?=tomdy($value->YearEnd)?></option>
                                <?php endforeach ?>
                              <?php endif ?>
                          </select>
                        </div>
                      </div>
                        </div>
                      </div>

                      <div class="row d-none" id="search-student">
                         <div class="col-md-2"><label>Search</label></div>
                      <div class="col-md-10">
                        
                  <div class="input-group input-group">
                  <input type="text" class="form-control" name="searcholdstudent" id="searcholdstudent" placeholder="Search here...">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="btn-find-oldstudent">Go!</button>
                  </span>
                </div>

                      </div>

                      <div class="col-md-2"></div>
                      <div class="col-md-10">
                        
                    <hr>
                    <div id="repeater-result">
                      
                    </div>
                    <hr>
                    
                      </div>
                    </div>

                      </div>
                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Center</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="centerId" id="centerId" class="form-control" value="<?=$info->centerId?>">
                      
                  </div>                  
                </div>

                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Worker</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="workersId" id="workersId" value="<?=$info->workersId?>" class="form-control">
                      
                  </div>                  
                </div>

                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Student ID#</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="pupilsId" id="student_id" value="0" class="form-control">
                      
                  </div>                  
                </div>
                <div class="" id="add-student">
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                           <div class="row">
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" required name="fName" placeholder="First Name" value="" required /></div>
                            <div class="col-xs-12 col-md-1"><input type="text" class="form-control" name="mName" placeholder="Mi." value=""/></div>
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="lName" required placeholder="Last Name" value="" required /></div>
                            
                            <div class="col-xs-12 col-md-3"><input type="text" name="ext" value="" class="form-control" placeholder="Extension: Jr." width="50px"></div>
                            </div>
                            

                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-sm-12 col-md-6 col-xs-12">
                          
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-form-label">Birthday</label>
                        <div class="col-sm-12 col-md-8">
                          <input type="date" class="form-control birthday" id="birthDate" name="birthDate" placeholder="0" value="" required>
                          <div class="error"></div>
                        
                        </div>

                      </div>
                        </div>  
                        <div class="col-sm-12 col-md-6 col-xs-12">
                          
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-form-label">Gender</label>
                        <div class="col-sm-12 col-md-8">
                          <select class="form-control" name="gender" id="gender" required>
                            <option value="">Select gender</option>
                            <option value="1" >Female</option>

                            <option value="2" >Male</option>
                          </select>
                          <div class="error"></div>
                        
                        </div>
                      </div>

                        </div>  
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-2 col-form-label">Sector</label>
                        <div class="col-sm-12 col-md-10">
                          <select class="form-control" name="sector" id="sector">
                            <option value="0">Default</option>
                            <option value="2">Single parent</option>
                            <option value="3">IPs</option>
                            <option value="3">4Ps</option>
                            <option value="1">WD</option>
                          </select>
                          <div class="error"></div>
                        
                        </div>
                      </div>



                      <div class="form-group row">
                        <label for="barangay" class="col-sm-12 col-md-2 col-form-label">Residential address</label>
                        <div class="col-sm-12 col-md-10">
                         <input class="form-control" placeholder="Residential address" name="address" id="address">
                          <div class="error"></div>
                        
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="barangay" class="col-sm-12 col-md-2 col-form-label">Barangay</label>
                        <div class="col-sm-12 col-md-10">
                         <select class="form-control" name="barangay" id="barangay">
                          
                      <option>Arellano</option>
                      <option>Batong Buhay</option>
                      <option>Buenavista</option>
                      <option>Burgos</option>
                      <option>Claudio Salgado</option>
                      <option>Gen. Emillio Aguinaldo</option>
                      <option>Ibud</option>
                      <option>Ilvita</option>
                      <option>Lagnas</option>
                      <option>Ligaya</option>
                      <option>Malisbong</option>
                      <option>Pag-asa</option>
                      <option>Poblacion</option>
                      <option>San Agustin</option>
                      <option>Santa Lucia</option>
                      <option>San Vicente</option>
                      <option>Sato Nino</option>
                      <option>Tagumpay</option>
                      <option>Tuban</option>
                      <option>Victoria</option>
                         </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="municipality" class="col-sm-12 col-md-2 col-form-label">Municipality</label>
                        <div class="col-sm-12 col-md-10">
                          <select class="form-control" name="municipality" id="municipality">
                            <option>Sablayan</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="province" class="col-sm-12 col-md-2 col-form-label">Province</label>
                        <div class="col-sm-12 col-md-10">
                          <select class="form-control" name="province" id="province">
                            <option>Occidental Mindoro</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                    <span class="col-sm-12 col-md-2"></span><div class="col-sm-12 col-md-10">
                      <button class="btn btn-primary" type="submit">Add</button>

                    </div>
                    </div>
                      </div>
            </form>
      	</div>
      </div>