
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daycare Worker</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daycare workers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
                                    <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link <?=(!empty($action) ? '' : 'active')?>" href="#home" data-toggle="tab">Daycare Workers</a></li>
                  <li class="nav-item"><a class="nav-link <?=(!empty($action) ? 'active' : '')?>" href="#addWorker" data-toggle="tab">Add Worker</a></li>
                  <li class="nav-item"><a class="nav-link <?=(!empty($action) ? 'active' : '')?>" href="#addschedule" data-toggle="tab">Assign worker class schedule</a></li>
                  <li class="nav-item d-none"><a class="nav-link <?=(!empty($action) ? 'active' : '')?>" href="#edit" data-toggle="tab">Edit</a></li>
                </ul>


          </div>
          <div class="card-body">
            <div class="tab-content">

                            <div class="tab-pane <?=(!empty($action) ? '' : 'active')?>" id="home">
                              <div class="row">
                                <div class="col-md-3">
                                  
                                  <label for="workertype">Select Worker Type</label>
                                  <select id="workertype" name="workertype" class="form-control">
                                    <option value="0" selected>List all workers</option>
                                    <option value="1">List all workers with assigned classess</option>
                                  </select>
                                </div>
                                <div class="col-md-9">
                                  <label for="searchstring">Searh here..</label>
                                  <input type="search" id="searchstring" name="searchstring" placeholder="Search here..." class="form-control">
                                </div>
                              </div>
                                <div class="table-responsive">
                                  <hr>
                <h4 class="table-title text-title">List all workers</h4>
                <table id="worker-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Center</th>
                    <th>Job Status</th>
                    <th>Class Start</th>
                    <th>Class End</th>
                    <th>Class status</th>
                    <th>Total Students</th>
                    <th style="min-width:60px !important"></th>
                  </tr>
                  </thead>
                  <tbody>

                  
                  </tbody>
                </table>

                                </div>

                            </div>
            <div class="tab-pane <?=(!empty($action) ? 'active' : '')?>" id="addWorker">
              <form class="form-horizontal" id="frmaddworker" method="POST" action="<?=site_url('workers/add')?>">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                    <div class="loader d-none"><img src="<?=base_url('assets/img/loader.gif')?>"></div>
                    <div id="error-area"></div>
                  </div>
                </div>
                <div class="d-none">
                  <input type="hidden" name="form" value="add"/>
                </div>
                          <?php echo validation_errors(); ?>
                          <?php if(!empty($hasErrors)) echo $hasErrors; ?>

                <div class="form-group row">
                  <label class="col-sm-2">Select center</label>
                  <div class="col-sm-10">
                    <select name="centerId" id="centerId" class="form-control" required>
                      <option value="0">Select assigned center here</option>
                      <?php foreach ($centers as $key => $value): ?>
                        <option value="<?=$value->centerId?>"><?=$value->centerName?></option>
                      <?php endforeach ?>
                    </select>
                  </div>                  
                </div>


                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                           <div class="row">
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="fName" placeholder="First Name" value="" required /></div>
                            <div class="col-xs-12 col-md-1"><input type="text" class="form-control" name="mName" placeholder="Mi." value=""/></div>
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="lName" required placeholder="Last Name" value="" required /></div>
                            
                            <div class="col-xs-12 col-md-3"><input type="text" name="ext" value="" class="form-control" placeholder="Extension: Jr." width="50px"></div>
                            </div>
                            

                        </div>
                      </div>


                <div class="form-group row">

                  <label class="col-sm-2">Gender</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                  </div> 
                  <label class="col-sm-2">Email</label>
                  <div class="col-sm-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="user@email.com" required>
                  </div> 
                
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Address</label>
                  <div class="col-sm-10">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                    <?=form_error('address')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Birthday</label>
                  <div class="col-sm-10">
                    <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Birthday">
                    <?=form_error('birthday')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Date Hired</label>
                  <div class="col-sm-10">
                    <input type="date" name="dateHired" id="dateHired" class="form-control" placeholder="Date Hired">
                    <?=form_error('dateHired')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Job Status</label>
                  <div class="col-sm-10">
                    <select name="jobStatus" id="jobStatus" class="form-control" >
                      <option value="1">Job Order</option>
                      <option value="2">Contractual</option>
                      <option value="3">Permanent</option>
                      <option value="4">Resigned</option>
                      <option value="5">Retired</option>
                    </select>
                    <?=form_error('jobStatus')?>
                  </div>                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10"><button class="btn btn-danger">Add</button></div>
                </div>
              </form>
            </div>
            <!-- /tab-add-worker -->

            <div class="tab-pane <?=(!empty($action) ? 'active' : '')?>" id="edit">
              
              <form class="form-horizontal" id="frmedit" method="POST"  action="<?=current_url()?>">

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10">
                  <span class="error-area"></span>
    
  </div>
</div>                <div class="d-none">
                  <input type="hidden" name="form" value="edit">
                  <input type="hidden" name="workersId" value="0">
                </div>
                
                          <?php echo validation_errors(); ?>
                          <?php if(!empty($hasErrors)) echo $hasErrors; ?>

                <div class="form-group row">
                  <label class="col-sm-2">Select center</label>
                  <div class="col-sm-10">
                    <select name="centerId" id="centerId" class="form-control" required>
                      <option value="0">Select assigned center here</option>
                      <?php foreach ($centers as $key => $value): ?>
                        <option value="<?=$value->centerId?>"><?=$value->centerName?></option>
                      <?php endforeach ?>
                    </select>
                  </div>                  
                </div>


                      <div class="form-group row">
                        <label for="name" class="col-sm-12 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-12 col-md-10">
                           <div class="row">
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="fName" placeholder="First Name" value="" required /></div>
                            <div class="col-xs-12 col-md-1"><input type="text" class="form-control" name="mName" placeholder="Mi." value=""/></div>
                            <div class="col-xs-12 col-md-4"><input type="text" class="form-control" name="lName" required placeholder="Last Name" value="" required /></div>
                            
                            <div class="col-xs-12 col-md-3"><input type="text" name="ext" value="" class="form-control" placeholder="Extension: Jr." width="50px"></div>
                            </div>
                            

                        </div>
                      </div>


                <div class="form-group row">
                

                  <label class="col-sm-2">Gender</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                  </div> 
                  <label class="col-sm-2">Email</label>
                  <div class="col-sm-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="user@email.com" required>
                  </div> 
                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Address</label>
                  <div class="col-sm-10">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                    <?=form_error('address')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Birthday</label>
                  <div class="col-sm-10">
                    <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Birthday">
                    <?=form_error('birthday')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Date Hired</label>
                  <div class="col-sm-10">
                    <input type="date" name="dateHired" id="dateHired" class="form-control" placeholder="Date Hired">
                    <?=form_error('dateHired')?>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Job Status</label>
                  <div class="col-sm-10">
                    <select name="jobStatus" id="jobStatus" class="form-control" >
                      <option value="1">Job Order</option>
                      <option value="2">Contractual</option>
                      <option value="3">Permanent</option>
                      <option value="4">Resigned</option>
                      <option value="5">Retired</option>
                    </select>
                    <?=form_error('jobStatus')?>
                  </div>                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10"><button class="btn btn-danger">Update</button></div>
                </div>
              </form>
            </div>
            <!-- /tab-edit-worker -->

            <!-- tab-assign-schedule -->
            <div class="tab-pane" id="addschedule">
              <form class="form-responsive" id="frmselectschoolyear" method="post" action="<?=site_url('workers/addtomyschoolyear')?>">
                      <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-9"><div class="pull-right"><span id="error-area"></span></div></div>
                      </div>
                      <div class="d-none">
                        
                        <input type="hidden" name="workersId" value="">

                      </div>

                        <div class="row form-group">
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
                          <div class="col-md-3"><label>Select worker</label></div>
                          <div class="col-md-9">
                            <select class="form-control" id="all_workers" name="workersId" required>
                              <option value="">Select here..</option>
                              <?php if (!empty($all_workers)): ?>
                                <?php foreach ($all_workers as $key => $value): ?>
                                  <option value="<?=$value->workersId?>"><?=$value->fName.', '.$value->fName.' '.$value->mName. ' '. $value->ext?></option>
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
            </div>
            <!-- /tab-assign-schedule -->


          </div>


          </div>
        </div>

    </div>
  </div>

  </div>