<section class="content">
<br>
	<div class="card">
		<div class="card-body">
			<div class="container-fluid">
        <label class="text-title"><?=isset($calamity) ? $calamity : 'Typhoon' ?> - Affected individual</label>

        <form class="form-horizontal" id="frmStudents" action="<?=site_url('affected/add')?>" method="POST">
                      <div class="row">
                        <div class="col-sm-2">&nbsp;</div>
                        <div class="col-sm-10">
                          <div class="errors <?php if(!empty($hasErrors)) echo 'alert alert-danger'; ?>" >
                          </div>
                        </div>
                      </div>
                <div class="form-group row">
                  <label class="col-sm-2">Disaster Name</label>
                  <div class="col-sm-10">
                    <input name="calamity" type="hidden" id="calamity" class="form-control" value="<?=isset($calamity) ? $calamity : ''?>">
                    <span class="text-bordered"><?=isset($calamity) ? $calamity : ''?></span>
                      
                  </div>                  
                </div>
                <div class="form-group row">
                  <label class="col-sm-2">Assessmet date</label>
                  <div class="col-sm-10">
                    <input name="assessment_date" type="date" id="assessment_date" class="form-control" value="<?=isset($assessment_date) ? $calamity : ''?>">
                   
                      
                  </div>                  
                </div>

                <div class="form-group row parent d-none">
                  <label class="col-sm-2">Parent</label>
                  <div class="col-sm-10">
                    <input name="parent_id" id="parent_id" type="hidden" class="form-control" value="<?=isset($parent_id) ? $parent_id : ''?>">
                    <span class="form-control parent_id"><?=isset($parent_id) ? $parent_id : ''?></span>
                      
                  </div>                  
                </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                                
                          <div class="input-group mb-3">
                            <input type="text" class="form-control name" required name="fName" placeholder="First Name" value="<?php echo set_value('fName')?>">
                            <input type="text" class="form-control name" name="mName" placeholder="Middle Name" value="<?php echo set_value('mName')?>">
                            <input type="text" class="form-control name" name="lName" required placeholder="Last Name" value="<?php echo set_value('lName')?>">
                              <div class="input-group-append">
                                <input type="text" name="ext" value="<?php echo set_value('ext')?>" class="form-control name" placeholder="Extension: Jr." width="50px">
                              </div>

                          </div>
                              <ul id="list_names" class="list-group">
                                <li class="list-group-item"><a class="item" data-id="0" href="#"><i class="fas fa-arrow-circle-right"></i> List name here... </a></li>
                                <li class="list-group-item"><a class="item"  data-id="0" href="#"><i class="fas fa-arrow-circle-right"></i> List name here...</a></li>
                              </ul>

                              </div>
                      </div>
                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Birthday</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="birthday" name="birthday" placeholder="0" value="<?php echo set_value('birthDate')?>" required>
                        </div>

                      </div>
                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <?php $gender = set_value('gender'); ?>
                          <select class="form-control" name="gender" id="gender" required>
                            <option value="">Select gender</option>
                            <option>Female</option>

                            <option>Male</option>
                          </select>
                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Civil Status</label>
                        <div class="col-sm-10">
                          <?php $civil_status = set_value('civil_status'); ?>
                          <select class="form-control" name="civil_status" id="civil_status" required>
                            <option value="">Select here..</option>
                            <option>Single</option>

                            <option>Married</option>
                            <option>Single parent</option>
 
 
                            <option>Live in</option>
 
                            <option>Legally separated</option>
                            <option>Divorce</option>
                            <option>Widow</option>
                          </select>
                        
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="contact_no" class="col-sm-2 col-form-label">Contact No.</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="0909-021-0210">

                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="list_provinces" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">

                          <div class="input-group mb-3">
                            

                          <select class="form-control" name="province" id="list_provinces"></select>
                          <select class="form-control" name="town" id="list_town"></select>
                          <select class="form-control" name="barangay" id="list_barangay"></select>
                         <input class="form-control" name="zone" id="zone" type="text" placeholder="Enter Zone">
                            

                        </div>
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Spouse Name</label>
                        <div class="col-sm-10">
                                
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" required name="sfName" placeholder="First Name" value="<?php echo set_value('sfName')?>">
                            <input type="text" class="form-control" name="smName" placeholder="Middle Name" value="<?php echo set_value('smName')?>">
                            <input type="text" class="form-control" name="slName" required placeholder="Last Name" value="<?php echo set_value('slName')?>">
                              <div class="input-group-append">
                                <input type="text" name="sext" value="<?php echo set_value('sext')?>" class="form-control" placeholder="Extension: Jr." width="50px">
                              </div>

                          </div>

                              </div>
                      </div>

                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Spouse Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="sgender" id="sgender" required>
                            <option value="">Select gender</option>
                            <option>Female</option>

                            <option>Male</option>
                          </select>
                        
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="no_children" class="col-sm-2 col-form-label">No of children</label>
                        <div class="col-sm-10">
                         <input class="form-control" name="no_children" id="no_children" type="number" value="0">
                          
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="no_children" class="col-sm-2 col-form-label">Is head of the family?</label>
                        <div class="col-sm-10">
                         
                         <select class="form-control">
                           <option value="2">No</option>

                           <option value="1">Yes</option>
                         </select>
                          
                        </div>
                      </div>
                      <hr>
                      <span class="text-title text-info">Damage details</span>

              <div class="row form-group">
                <label  for="disaster_damage_status" class="col-sm-2 col-form-label">Damage Status</label>
                        <div class="col-sm-10">
                <select class="form-control" id="disaster_damage_status" name="damage_status">
                  <option value="0">No damaged</option>
                  <option value="1">Minimal damaged</option>
                  <option value="2">Partialy damaged</option>
                  <option value="3">Half damaged</option>
                  <option value="4">Totally damaged</option>
                </select>
                </div>
              </div>

              <div class="row form-group">

                <label  for="disaster_damage_status" class="col-sm-2 col-form-label">Damage Percentage (%)</label>
                        <div class="col-sm-10">
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="damage_percentage" id="disaster_damage_percentage" placeholder="100">
                            <label style="padding:10px;" class="caption">%</label>

                          </div>
                        </div>
              </div>

                      <div class="form-group row">
                        <label for="damage_image" class="col-sm-2 col-form-label">Upload photo</label>
                        <div class="col-sm-10">
                <input type="file" name="damage_image" id="damage_image" class="btn on-hover" accept=".jpg,.png">
                         
                          
                        </div>
                      </div>
                      <div class="row">
                    <span class="col-sm-2"></span><div class="col-sm-10">
                      <button class="btn btn-primary" type="submit">Save</button>

                    </div>
    
                      </div>
                    
            </form>

      </div>
		</div>
	</div>
  <br>
</section>