<div class="page">
	<h3  style="padding:0;margin:0;">Events collection for school year <?=$school_year?></h3>
	<h3  style="padding:0;margin:0;">Course - <?=$course?></h3>
	<table class="table table-bordered" id="table-collections">
            <thead>
              <tr>
                <th style="min-width:50px;">ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Amount Paid</th>
                <th>Date Paid</th>
                <th>Semester</th>
              </tr>
            </thead>
            <tbody>

                        <?php if (!empty($list_students)): ?>
                          <?php foreach ($list_students as $key => $value): ?>
                            
                        <tr>
                          <td><?=$value->student_id?></td>
                          <td><?=$value->student_name?></td>

                          <td><?=$value->course?></td>
                          <td><?=$value->amount_pay?></td>
                          <td><?=$value->date_of_payment?></td>
                          <td><?=semester($value->semester)?></td>
                        </tr>
                        
                          <?php endforeach ?>
                        
                        <?php endif ?>
                        
            </tbody>
          </table></div>