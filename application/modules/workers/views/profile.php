  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Worker Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Worker profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <?php if (!empty($info)): ?>

                  <img class="profile-user-img img-fluid img-circle"
                       src="<?=base_url('assets/img/user.png')?>"
                       alt="User profile picture">
                <?php endif ?>
                </div>
                <?php if (!empty($info)): ?>
                <h3 class="profile-username text-center"><?=$info->fName.' '.$info->mName.' '.$info->lName?></h3>

                <p class="text-muted text-center"></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?=$info->email?></a>
                  </li>

                  <li class="list-group-item">
                    <b>Birthday</b> <a class="float-right"><?=$info->birthDate?></a>
                  </li>

                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right"><?=gender($info->gender)?></a>
                  </li>
               </ul>

                <?php endif ?>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary card-outline">
              
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-university mr-1"></i> Assigned Center</strong>

                <p class="text-muted">
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                <p class="text-muted"><?=$info->address?></p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted"></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-10">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Assessment</a></li>

                  <li class="nav-item"><a class="nav-link" href="#nutritions" data-toggle="tab">Nutrition</a></li>
                  <?php if (!$this->aauth->is_admin()): ?>
                  <li class="nav-item"><a class="nav-link" href="#addStudents" data-toggle="tab">Add student</a></li>

                  <li class="nav-item"><a class="nav-link" href="#addSchoolYear" data-toggle="tab">School Years</a></li>
                  <li class="nav-item d-none"><a class="nav-link" href="#editStudents" data-toggle="tab">Repeater</a></li>
                  <?php endif ?>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="card" id="cardWeight"> 
                      <div class="card-header">
                        Enrolled Student by Academic Year
                      </div>
                      <div class="card-body">
                          <form id="frmfindmystudent" method="post" action="javascript:void(0)">
                        <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12">
                          <select class="form-control" name="class_schedule">
                            <option value="0">Select classes</option>
                              <?php if (!empty($myschoolyear)): ?>
                                <?php foreach ($myschoolyear as $key => $value): ?>
                                  <option value="<?=$value->year_id?>"><?=tomdy($value->class_start)?> to <?=tomdy($value->class_end)?></option>
                                <?php endforeach ?>
                              <?php endif ?>
                            

                          </select>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          
                  <div class="input-group input-group">
                  <input type="text" class="form-control" name="searchstring" id="searchstring" placeholder="Search here...">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="btn-go">Go!</button>
                  </span>
                </div>

                        </div>
                        
                        </div>
                        </form>

                    <br/>
                        <div class="row form-responsive">
                        
        
                <table id="tblmystudents" class="table table-bordered w-100">
                  <thead>
                  <tr>
                    <th  style="width:50px !important">#</th>
                    <th>Name</th>
                    <th>Age (months)</th>
                    <th>Gender</th>

                              <th>Address</th>
                              <th>Student Type</th>
                    <th>Class Schedule</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>


                        </div>
                      </div>
                    </div>

                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="card">  
                      <div class="card-header">Student Assessment</div>
                      <div class="card-body">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Student ID#</th>
                              <th>AY</th>
                              <th>Date of Assessment</th>
                              <th>Scaled Score</th>
                              <th>Standard Score</th>
                              

                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.timeline -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="nutritions">
                    <?php $this->load->view('workers/nutritions'); ?>
                    
                  </div>
                  <div class="tab-pane" id="addSchoolYear">
                    Add School Year

                    <div class="card">
                      <div class="card-header">
                        
                      </div>
                      <div class="card-body">
                        <form id="frmschoolyear" method="post" action="javascript:void(0)">
                          

                        <div class="row form-group">
                          <div class="col-md-3"><label>&nbbsp;</label></div>
                          <div class="col-md-9"><span id="error-area"></span></div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-3"><label>Start Date</label></div>
                          <div class="col-md-9"><input type="date" name="startdate" class="form-control" placeholder="Start of school year"></div>
                        </div>

                        <div class="row form-group">
                          <div class="col-md-3"><label>End Date</label></div>
                          <div class="col-md-9"><input type="date" name="enddate" class="form-control" placeholder="End of school year"></div>
                        </div>

                        <div class="row form-group">
                          <div class="col-md-3"><label>&nbsp;</label></div>
                          <div class="col-md-9"><button type="submit" class="btn btn-danger">Add</button></div>
                        </div>

                        <div class="d-none">
                          <input type="hidden" name="form" value="add_schoolyear">
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- select school year / -->
                    <hr>
                    <form class="form-responsive d-none" id="frmselectschoolyear" method="post" action="<?=site_url('workers/addtomyschoolyear')?>">
                      <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-9"><div class="pull-right"><span id="error-area"></span></div></div>
                      </div>
                      <div class="row form-group">
                        <input type="hidden" name="workersId" value="<?=$info->workersId?>">
                          <div class="col-md-3"><label>Select school year</label></div>
                          <div class="col-md-9">
                            <select class="form-control" id="schoolyears" name="schoolyears" required>
                              <option value="">Select here..</option>
                              <?php if (!empty($schoolyears)): ?>
                                <?php foreach ($schoolyears as $key => $value): ?>
                                  <option value="<?=$value->YearId?>"><?=tomdy($value->YearStart)?> to <?=tomdy($value->YearEnd)?></option>
                                <?php endforeach ?>
                              <?php endif ?>
                            </select>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col-md-3"><label>&nbsp;</label></div>
                          <div class="col-md-9"><button type="submit" class="btn btn-danger">Save</button></div>
                        </div>
                    </form>
                    <!-- / select school year -->
                  </div>

                  <!-- /.tab-pane -->
                  
                  
                  <div class="tab-pane" id="addStudents">
                    <?php $this->load->view('workers/students_add'); ?>
                   
                  </div>
                  <!-- /.tab-pane -->


                  <!-- /.tab-pane -->
                  
                  
                  <div class="tab-pane" id="editStudents">
                    <?php $this->load->view('workers/students_edit'); ?>
                   
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->