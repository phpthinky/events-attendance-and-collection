<section class="content-counter">
	
	<div class="row d-none">
		<div class="col-md-3">
			<a href="<?=site_url('settings/restart_semester')?>" class="btn btn-sm btn-block btn-outline-primary">New semester</a>
		</div>
	</div>
	<div class="row">
		<!-- enrollment -->

		<div class="col-md-3">
			<div class="card">
				<div class="card-body h-200">
					<label><i class="fa fa-users"></i> Enrollment count</label>
					<hr>
					<center>
						<h1><?=$total_students?></h1>
					<span>Students</span></center>
				</div>
			</div>
		</div>

		<!-- collections -->

		<div class="col-md-3">
			<div class="card">
				<div class="card-body h-200">
					<label><i class="fa fa-users"></i> Total collections</label>
					<hr>
					<center>
						<h1><?=$total_collections?></h1>
					<span>Amount</span></center>
				</div>
			</div>
		</div>
		<!-- attendance rate -->

		<div class="col-md-3">
			<div class="card">
				<div class="card-body h-200">

					<label><i class="fa fa-users"></i> Attendace Rate</label>
					<hr>
					<center>
						<h1>0%</h1>
					<span>Percent</span></center>

				</div>
			</div>
		</div>

		<?php if (!$this->aauth->is_admin()): ?>
			
		<!-- scanner -->
		<div class="col-md-3">
			<div class="card">
				<div class="card-body h-200">

					<label><i class="fa fa-qrcode"></i></label>
					<hr>
					<center>
						<?php if ($this->aauth->is_allowed(1)): ?>
						<a class="btn btn-block btn-outline-primary" href="<?=site_url('attendance')?>">SCAN NOW</a>
							
						<?php endif ?>

						<?php if ($this->aauth->is_allowed(2)): ?>
						<a class="btn btn-block btn-outline-primary" href="<?=site_url('collections/scanner')?>">SCAN NOW</a>
							
						<?php endif ?>
					</center>
					<span>&nbsp;</span>
				</div>
			</div>
		</div>
	<?php else: ?>

		<div class="col-md-3">
			<div class="card">
				<div class="card-body h-200">

					<label><i class="fa fa-users"></i> Recents Accounts</label>
					<hr>
					<center>
						<h1>0</h1>
					<span>User</span></center>

				</div>
			</div>
		</div>

		<?php endif ?>
	</div>
</section>

<section class="content">
	

	<div class="card" id="charts-container">
		<div class="card-body">
			<div class="row">
				
				<canvas id="charts-collections"></canvas>
			</div>
		</div>
	</div>
</section>