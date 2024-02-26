<section class="content">
	<div class="card" id="action-container">
		<div class="row">
			<div class="col-md-4">
				<select class="form-control" name="year_id" id="chart-year-id">
					<option value="0">Select school year</option>
					 <?php if (!empty($sy)): ?>
                              <?php foreach ($sy as $key => $value): ?>
                                <option value="<?=$value->id?>" 
                                  <?php if ($value->status == 1): ?>
                                    selected
                                  <?php endif ?>><?=monthyear($value->start_year).' - '.monthyear($value->end_year)?></option>
                              <?php endforeach ?>
                            <?php endif ?>
				</select>
			</div>
			<div class="col-md-4 download-area" ><a href="#" class="btn btn-outline-primary btn-print" title="Print"><i class="fa fa-print"></i></a> <a href="#" class="btn btn-outline-success btn-download" title="Download" data-title="Download"><i class="fa fa-download"></i></a></div>
		</div>
	</div>

	<div class="card" id="charts-container">
		<div class="card-body">
			<div class="row">
				
				<canvas id="charts-collections"></canvas>
			</div>
		</div>
	</div>
</section>