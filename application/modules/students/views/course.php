    
    <div class="container-fluid">
      <br>
    <div class="card">
      <div class="card-header">
        
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Student Libary</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-add">Add</a></li>
      <li class="nav-item d-none"><a class="nav-link" data-toggle="tab" href="#tab-import">Import data</a></li>

    </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab-family">
            List of all students
            <hr>

          <div class="row barangay table-responsive">
          <table class="table table-bordered" id="table-list-students-library">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Amount to pay</th>
                <th>Amount paid</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                            
                        <tr>
                          <td><button class="btn btn-block btn-default"><i class="fa fa-qrcode"></i></button></td>
                          <td><?=$value->code?></td>
                          <td><?=trim($value->fName.' '.$value->mName.' '.$value->lName.' '.$value->ext)?></td>

                          <td><?=$value->course_sub_title?></td>
                          <td><?=$value->grade.'-'.$value->section?></td>
                          <td><?=number_format($value->total_late_penalty,2)?></td>
                          <td><?=number_format($value->total_bayad,2)?></td>
                          <td><?php if ($value->total_late_penalty > $value->total_bayad): ?>
                            <a class="btn btn-outline-success btn-sm" href="#">Pay</a>
                          <?php endif ?></td>
                        </tr>
                        
                          <?php endforeach ?>
                       
                        
                        <?php endif ?>
                        
            </tbody>
          </table>

          </div>
          </div>

          <!-- add -->

          <div class="tab-pane" id="tab-add">
            Add Students
            <hr>

            <?php $this->load->view('student-add') ?>
          </div>
          <!-- import -->
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