		
		<div class="container-fluid">
			<br>
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Collections</a></li>

		</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
					<label class="text-title">list current events</label>
						<div class="table-responsive">
							<table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Amount Paid</th>
                <th>Date Paid</th>
                <th>Semester</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                            
                        <tr>
                          <td><button class="btn btn-block btn-default"><i class="fa fa-qrcode"></i></button></td>
                          <td><?=$value->code?></td>
                          <td><?=$value->fName. ' '. $value->mName.' '.$value->lName.' '.$value->ext?></td>

                          <td><?=$value->course_sub_title?></td>
                          <td><?=$value->grade.'-'.$value->section?></td>
                          <td><?=$value->amount_pay?></td>
                          <td><?=$value->date_of_payment?></td>
                          <td><?=semester($value->year)?></td>
                        </tr>
                        
                          <?php endforeach ?>
                        
                        <?php endif ?>
                        
            </tbody>
          </table>
						</div>
					</div>

					<div class="tab-pane" id="tab-import">
						Import

						<div class="row">
							<label>Choose excel file</label>
							<input type="file" name="import_excel" accept=".xls,.xlsx">
						</div>
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