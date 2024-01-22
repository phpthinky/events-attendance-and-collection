

      	<div class="card">
      		<div class="card-header">
      			Edit student basic information
      		</div>
      		<div class="card-body">


        <form class="form-horizontal" id="frmeditstudents" action="<?=site_url('students/add')?>" method="POST">
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
                          <select class="form-control" name="StudentType" id="e_StudentType" required>

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
                          <select class="form-control" name="class_schedule" id="e_class_schedule" required>
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

                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Center</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="centerId" id="e_centerId" class="form-control" value="<?=$info->centerId?>">
                      
                  </div>                  
                </div>

                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Worker</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="workersId" id="e_workersId" value="<?=$info->workersId?>" class="form-control">
                      
                  </div>                  
                </div>

                <div class="form-group row d-none">
                  <label class="col-sm-12 col-md-2">Student ID#</label>
                  <div class="col-sm-12 col-md-10">
                    <input name="pupilsId" id="e_student_id" value="0" class="form-control">
                      
                  </div>                  
                </div>
                <div class="" id="add-student">
                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                                
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" required name="fName" placeholder="First Name" value="" required />
                            <input type="text" class="form-control" name="mName" placeholder="Middle Name" value=""/>
                            <input type="text" class="form-control" name="lName" required placeholder="Last Name" value="" required />
                              <div class="input-group-append">
                                <input type="text" name="ext" value="" class="form-control" placeholder="Extension: Jr." width="50px">
                              </div>

                          </div>
                          <div class="error"></div>


                              </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-sm-12 col-md-6 col-xs-12">
                          
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-form-label">Birthday</label>
                        <div class="col-sm-12 col-md-8">
                          <input type="date" class="form-control birthday" id="e_birthDate" name="birthDate" placeholder="0" value="" required>
                          <div class="error"></div>
                        
                        </div>

                      </div>
                        </div>  
                        <div class="col-sm-12 col-md-6 col-xs-12">
                          
                      <div class="form-group row">
                        <label for="age" class="col-sm-12 col-md-4 col-form-label">Gender</label>
                        <div class="col-sm-12 col-md-8">
                          <select class="form-control" name="gender" id="e_gender" required>
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
                          <select class="form-control" name="sector" id="e_sector">
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
                         <input class="form-control" placeholder="Residential address" name="address" id="e_address">
                          <div class="error"></div>
                        
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="barangay" class="col-sm-12 col-md-2 col-form-label">Barangay</label>
                        <div class="col-sm-12 col-md-10">
                         <select class="form-control" name="barangay" id="e_barangay">
                          
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
                          <select class="form-control" name="municipality" id="e_municipality">
                            <option>Sablayan</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="province" class="col-sm-12 col-md-2 col-form-label">Province</label>
                        <div class="col-sm-12 col-md-10">
                          <select class="form-control" name="province" id="e_province">
                            <option>Occidental Mindoro</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                    <span class="col-sm-12 col-md-2"></span><div class="col-sm-12 col-md-10">
                      <button class="btn btn-primary" type="submit">Save changes</button>

                    </div>
                    </div>
                      </div>
            </form>
      		</div>
      	</div>