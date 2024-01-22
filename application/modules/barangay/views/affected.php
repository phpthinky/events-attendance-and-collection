	<section class="content-header">
		<label class="text-header">Barangay Management</label>

	</section>
	<section class="content">
		<div class="container-fluid">
			
		<div class="card">
			<div class="card-header">
				
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-family">Family</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-individual">Individual</a></li>

		</ul>
			</div>
			<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<span>Calamity type:</span> <label class="calamity-type"><?=$calamity_name?></label>
						</div>

						<div class="col-md-6">
							<span>Disaster Name:</span> <label class="disaster-title"><?=ucwords($disaster->title)?></label>
						</div>

						<div class="col-md-6">
							<span>Date occured:</span> <label class="disaster-date-occured"><?=toMMdy($disaster->date_occured)?></label>
						</div>

						<div class="col-md-6">
							<span>Date of assessment:</span> <label class="disaster-date-assessment"><?=toMMdy($disaster->date_assessment)?></label>
						</div>
					</div>
				<div class="tab-content">
					<div class="tab-pane active" id="tab-family">
						</label> <label class="text-title">Affected Family</label>

						<table class="table table-bordered" id="table-affected-family">
							<thead>
								<tr>
									<th>#</th>
									<th>Head of the family</th>
									<th>Size of family</th>
									<th>Damage Status</th>
									<th>Help Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($affected_families)): ?>
									<?php
									$i=1;
									 foreach ($variable as $key => $value): ?>
									<tr>
										<td><?=$i++?></td>
										<td><?=$value->person_name?></td>
										<td><?=$value->no_children?></td>
										<td><?=$value->damage_status?></td>
										<td></td>
									</tr>	
									<?php endforeach ?>

								<?php endif ?>
							</tbody>
						</table>
					</div>

					<div class="tab-pane" id="tab-individual">
						<label class="text-title">Affected Individual</label>
					</div>
				</div>
			</div>
		</div> 	
		</div>
	</section>
