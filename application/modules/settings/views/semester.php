<label>Set semester seettings</label>
<hr>
<form id="set-semester" action="javascript:void(0)">
	
<div class="row">
	<label class="col-md-12 input-radio" style="padding:10px;cursor: pointer;"><input type="radio" name="semester" value="1" <?php if ($settings->current_semester == 1): ?>
		checked
	<?php endif ?>>	First Semester</label>
	<label class="col-md-12 input-radio" style="padding:10px;cursor: pointer;"><input type="radio" name="semester" value="2" <?php if ($settings->current_semester == 2): ?>
		checked
	<?php endif ?>> Second Semester</label>
</div>
</form>