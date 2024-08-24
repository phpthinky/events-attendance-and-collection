<div class="row barangay table-responsive">

                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-12">
                                  <input type="search" id="searchstring-center" name="searchstring" placeholder="Search here..." class="form-control"></p>
                                    </div>
                                  </div>
                                </div>
          <table class="table table-bordered" id="table-list-students-library">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Date registered</th>
                <th>Regitration No.</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                        <tr>
                          <td><a class="btn btn-block btn-default" href="<?=site_url('students/info/'.$value->code)?>"><i class="fa fa-qrcode"></i></a></td>
                          <td><?=$value->code?></td>
                          <td><?=trim($value->fName.' '.$value->mName.' '.$value->lName.' '.$value->ext)?></td>

                          <td><?=$value->course_sub_title?></td>
                          <td><?=$value->grade.'-'.$value->section?></td>
                          <td><?=date_time($value->dateUpdated,true)?></td>
                          <td></td>
                          <td><a href="#" class="btn btn-sm btn-outline-success" data-id="<?=$value->code?>" id="btn-approved"><i class="fa fa-check"></i> Approve</a> <a href="#" class="btn btn-sm btn-outline-danger" data-id="<?=$value->code?>" id="btn-disapproved"><i class="fa fa-trash"></i>Disapprove</a></td>
                          <!--td><?php if ($total_penalty > $value->total_bayad): ?>
                            <a class="btn btn-outline-success btn-sm" href="#">Pay</a>
                          <?php endif ?></td-->
                        </tr>
                        
                          <?php endforeach ?>
                       
                        
                        <?php endif ?>
                        
            </tbody>
          </table>

          </div>