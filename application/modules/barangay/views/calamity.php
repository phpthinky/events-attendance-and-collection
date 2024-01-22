	  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Barangay Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Barangay</a></li>
              <li class="breadcrumb-item"><a href="#">Management</a></li>
              <li class="breadcrumb-item active"><?=$barangay?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-4">
									
									<table class="table table-bordered">
				<tbody>
					
					<?php if (!empty($listall)): ?>
						<?php foreach ($listall as $key => $value): ?>
							<tr>
								<td class="w-5"><i class="fa fa-list"></i></td>
								<td class="on-hover blue view-affected" data-disaster_id="<?=$value->id?>" data-url="<?=site_url('affected/list/'.$value->id)?>"><?=$value->title?></td>
								
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>


				</div>
				<div class="col-lg-8 col-8">
						<div class="card card-outline-primary">
							<div class="card-header">
								<b><label class="text-title disaster-title">Typhoon</label></b>
							</div>
							<div class="card-body">
								<span class="caption">List of affected individuals</span>
								<table class="table table-bordered" id="table-affected">
									<thead>
										<tr>
											<th>Name</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Hello</td>
											<td><a class="link" href="<?=site_url('affected/info/')?>1"><i class="fas fa-eye"></i> View</a></td>
										</tr>
									</tbody>

								</table>
								<div class="card-footer"><a href="<?=site_url('affected/add/'.$barangay.'/typhoon')?>" class="btn"><i class="fa fa-plus"></i> Add affected individual</a>  <button class="btn btn-outline-info btn-view-all"><i class="fa fa-list"></i> View all</button> <button class="btn btn-outline-primary btn-print"><i class="fa fa-print"></i></button> <button class="btn btn-outline-success btn-export"><i class="fa fa-table"></i></button></div>
							</div>
						</div>

				</div>
			</div>
		</div>
	</section>