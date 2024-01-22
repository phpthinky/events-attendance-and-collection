	<section class="content-header"></section>
	<section class="content">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Home</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add">Add</a></li>
          <li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#edit">Edit</a></li>
          <li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#tab-addtown">Town</a></li>
					<li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#tab-addstate">State</a></li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="home">
				
          <div class="row barangay">
          

          </div>
					</div>


					<div class="tab-pane" id="add">
						<div class="form-responsive">
							<div class="row">
								<div class="col-md-12"><h4 class="text-title">Add Barangay</h4></div>
								<div class="col-md-6"></div>
							</div>
              		<div class="row">
              			<div class="col-md-2"></div>
              			<div class="col-md-9"><div class="error-area"></div></div>
              		</div>
              		<hr>
              		<form class="form-horizontal" method="POST" action="<?=site_url('centers')?>" id="frmaddcenter">


                <div class="d-none">
                  <input type="hidden" name="form" value="add">
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Name of Barangay</label>
                  <div class="col-sm-8">
                    <input type="text" name="centerName" id="centerName" class="form-control" placeholder=" Name of Barangay" required>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Town/City</label>
                  <div class="col-sm-8">
                    <select class="form-control"  name="town" id="list_town"  required>
                      <option>Select Town/City</option>
                    </select>
                  </div> 
                  <div class="col-sm-2"><a href="#addtown" class="btn btn-default"><i class="fas fa-plus"></i></a></div>                 
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">State/Province</label>
                  <div class="col-sm-8">
                    <select class="form-control"  name="provinces" id="list_provinces"  required>
                      <option>Select State/Province</option>
                    </select>
                  </div>      
                  <div class="col-sm-2"><a href="#addstate" class="btn btn-default"><i class="fas fa-plus"></i></a></div>                 

                </div>

                <div class="form-group row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10"><button class="btn btn-danger">Add</button></div>
                </div>
              </form>
              	</div>
					</div>
					<div class="tab-pane" id="edit">
						<div class="form-responsive">
							<div class="row">
								<div class="col-md-12"><h4 class="text-title">Edit Center</h4></div>

								<div class="col-md-6"><div class="alert"></div></div>
							</div>
              		<div class="row">
              			<div class="col-md-2"></div>
              			<div class="col-md-9"><div class="error-area"></div></div>
              		</div>
              		<hr>
              		<form class="form-horizontal" method="POST" action="<?=site_url('centers')?>" id="frmeditcenter">


                <div class="d-none">
                  <input type="hidden" name="form" value="edit">
                  <input type="hidden" name="centerId" value="0">
                </div>
                <div class="form-group row">
                  <label class="col-sm-2">Name of Barangay</label>
                  <div class="col-sm-10">
                    <input type="text" name="barangay" id="barangay" class="form-control" placeholder=" Name of Barangay" required>
                  </div>                  
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">Town/City</label>
                  <div class="col-sm-8">
                    <select class="form-control"  name="town" id="elist_town"  required>
                      <option>Select Town/City</option>
                    </select>
                  </div> 
                  <div class="col-sm-2"><a href="#addtown" class="btn btn-default"><i class="fas fa-plus"></i></a></div>                 
                </div>

                <div class="form-group row">
                  <label class="col-sm-2">State/Province</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="province" id="elist_provinces" required>
                      <option>Select State/Province</option>
                    </select>
                  </div>      
                  <div class="col-sm-2"><a href="#addstate" class="btn btn-default"><i class="fas fa-plus"></i></a></div>                 

                </div>


                <div class="form-group row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10"><button class="btn btn-danger">Update</button></div>
                </div>
              </form>

              	</div>

					</div>
          <div class="tab-pane" id="tab-addtown">
            <label class="text-title">Add Town/City</label>
          </div>

          <div class="tab-pane" id="tab-addstate">
            <label class="text-title">Add State</label>
          </div>
				</div>
			</div>
		</div>
	</section>