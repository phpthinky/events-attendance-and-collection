		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-courses">Course offered</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-create">Add course</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-edit">Edit course</a></li>

		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-courses">
						

						<!--
					<div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                          </div>
                          <div class="count">179</div>

                          <h3>New Sign ups</h3>
                          <p>Lorem ipsum psdea itgum rixt.</p>
                        </div>
                      </div>

                  -->

						<?php if (!empty($list_courses)): ?>
							
							
							<?php foreach ($list_courses as $key => $value): ?>
								<div class="col-md-3">
							
							<div class="animated">
                          <div class="tile-stats x_panel fixed_height_200 bg-grey">

                            <div class="flex">
                            	<br>
                            	<?php if (!empty($value->logo)): ?>

                            	<center><a href="<?=site_url('students/course/'.$value->course_sub_title)?>"><img src="<?=$value->logo?>" style="width: 100px;height:100px;"></a></center>
                            		<?php else: ?>
                            	<center><a href="<?=site_url('students/course/'.$value->course_sub_title)?>"><img src="<?=base_url('assets/img/user.png')?>" style="width: 100px;height:100px;"></a></center>

                            	<?php endif ?>
                             <p><center><label style="font-size: 1.1em" class="text-title text-d-grey"><?=$value->course_title?></label></center></p>
                            </div>
                          </div>
                        </div>
						</div>

							<?php endforeach ?>

						<?php endif ?>
					</div>

					<div class="tab-pane" id="tab-create">
						Create course
						<hr>


						<?php $this->load->view('create'); ?>
					</div>

					<div class="tab-pane" id="tab-edit">
						Create course
						<hr>


						<?php $this->load->view('edit'); ?>
					</div>
				</div>
			</div>
		</div> 	
		</div>

<div class="modal" id="modal-sample">
	<div class="modal-dialog">
		<div class="modal-body">
			<p>Hello</p>
		</div>
	</div>
</div>