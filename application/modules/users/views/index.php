	<main class="main-content-1">
		<div class="divider-50">
				
		</div>
		<section class="container-fluid">
			
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Account settings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Users</a>
                      </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       

		<div class="card">
			<div class="card-header">Account Settings</div>
			<div class="card-body">
				<div class="errors"></div>
				Change email
				<form class="form-horizontal frmupdateuser" id="frmupdateuser-email" method="POST" action="<?=site_url('users/update/email')?>" autoComplete="off">
					<input type="hidden" autoComplete="false">
						
					<div class="row form-group">
						<div class="col-md-3">Email</div>
						<div class="col-md-9"><input type="text" name="email" class="form-control" placeholder="Email" value="<?=$email?>"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-3">Enter Password</div>
						<div class="col-md-9"><input type="password" name="cpassword" class="form-control" autoComplete="new-password" area-autoComplete="none" placeholder="Current password"></div>
					</div>

					<div class="row form-group">
						<div class="col-md-3"></div>
						<div class="col-md-9"><button class="btn btn-danger">Save changes</button></div>
					</div>
				</form>
				<hr>
				Change Password
				<form class="form-horizontal frmupdateuser" id="frmupdateuser-pass" method="POST" action="<?=site_url('users/update/password')?>" autoComplete="off">
					<input type="hidden" autoComplete="false">
						
					<div class="row form-group">
						<div class="col-md-3">Current Password</div>
						<div class="col-md-9"><input type="password" name="cpassword" class="form-control" autoComplete="new-password" area-autoComplete="none" placeholder="Current password"></div>
					</div>
					<div class="row form-group">
						<div class="col-md-3">New Password</div>
						<div class="col-md-9"><input type="password" name="npassword" class="form-control" placeholder ="New password"></div>
					</div>

					<div class="row form-group">
						<div class="col-md-3"></div>
						<div class="col-md-9"><button class="btn btn-danger">Save changes</button></div>
					</div>
				</form>

			</div>
		</div>

                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="row">
								<div class="col-md-10">
								<label>Users</label>									

								</div>
								<div class="col-md-2">
                      				<a href="#" data-toggle="modal" data-target="#modal-add-user" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> add user</a>
									
								</div>
							</div>
	                       <hr>

                       <div class="table-responsive">
                       	<table class="table table-bordered">
                       		<thead>
                       			<th></th>
                       			<th>Username</th>
                       			<th>Email</th>
                       			<th>User Type</th>
                       			<th></th>
                       		</thead>
                       		<tbody>
                       			<?php if (!empty($list_users)): ?>
                       				<?php foreach ($list_users as $key => $value): ?>

                       					<?php if ($value->id > 1): ?>
                       						
                       					<tr>
                       						<td></td>
                       						<td class="row-username-<?=$value->id?>"><?=$value->username?></td>
                       						<td class="row-email-<?=$value->id?>"><?=$value->email?></td>
                       						<td><?php $groups = $this->aauth->get_user_groups($value->id);
                       						$group = array();
                       						foreach ($groups as $k => $v) {
                       							// code...
                       							$group[]=$v->name;
                       						}
                       						echo implode(', ', $group);
                       						 ?></td>
                       						 <td><button class="btn btn-sm btn-default btn-modify-user" data-id="<?=$value->id?>"><i class="fa fa-edit" ></i> Modify</button> <button class="btn btn-sm btn-outline-danger btn-trash-user" data-id="<?=$value->id?>"><i class="fa fa-trash"></i>Delete</button></td>
                       					</tr>
                       					<?php endif ?>
                       				<?php endforeach ?>
                       			<?php endif ?>
                       		</tbody>
                       	</table>
                       </div>
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Good luck!
                      </div>
                    </div>

		</section>


	</main>


	<!-- The Modal -->
<div class="modal" id="modal-add-user">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add user</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       	
       	<form id="form-add-userr" action="javascript:void(0)">
       		<input type="hidden" name="action" value="add-user">
       		<div class="row">
       		<label class="col-md-3">Username</label>
       		<div class="col-md-9"><input type="text" name="username" class="form-control"></div>
       	</div>

       	<div class="row">
       		<label class="col-md-3">Email</label>
       		<div class="col-md-9"><input type="email" name="email" class="form-control"></div>
       	</div>
       	<div class="row">
       		<label class="col-md-3">Password</label>
       		<div class="col-md-9"><input type="password" name="passcode" class="form-control"></div>
       	</div>

       	<div class="row">
       		<label class="col-md-3">&nbsp;</label>
       		<div class="col-md-9"><hr>
       			<div class="result-area"></div>
       		</div>
       	</div>
       	<div class="row">
       		<label class="col-md-3">&nbsp;</label>
       		<div class="col-md-9"><hr><input type="submit" name="add-user" class="btn btn-outline-primary" value="Save"></div>
       	</div>
       	</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>
	<!-- The Modal  edit-->
<div class="modal" id="modal-edit-user">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add user</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       	
       	<form id="form-edit-userr" action="javascript:void(0)">
       		<input type="hidden" name="user_id" value="0">
       		<input type="hidden" name="action" value="add-user">
       		<div class="row">
       		<label class="col-md-3">Username</label>
       		<div class="col-md-9"><input type="text" name="username" class="form-control"></div>
       	</div>

       	<div class="row">
       		<label class="col-md-3">Email</label>
       		<div class="col-md-9"><input type="email" name="email" class="form-control"></div>
       	</div>
       	<div class="row">
       		<label class="col-md-3">Password</label>
       		<div class="col-md-9"><input type="password" name="passcode" class="form-control"></div>
       	</div>

       	<div class="row">
       		<label class="col-md-3">&nbsp;</label>
       		<div class="col-md-9"><hr>
       			<div class="result-area"></div>
       		</div>
       	</div>
       	<div class="row">
       		<label class="col-md-3">&nbsp;</label>
       		<div class="col-md-9"><hr><input type="submit" name="add-user" class="btn btn-outline-primary" value="Save"></div>
       	</div>
       	</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>