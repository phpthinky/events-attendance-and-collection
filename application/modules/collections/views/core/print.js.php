$(function(){
	$('#btn-print').on('click',function(){
		let semester = $('span#semester_no').text()
		var form = $('form#form-collections');
		$(form).attr('action','<?=site_url('collections/print/')?>'+semester)
		$(form).append('<input type="hidden" name="school_year" value="'+$('select[name="year_id"] option:selected').text()+'" />')
		$(form).append('<input type="hidden" name="course" value="'+$('select[name="course_id"] option:selected').text()+'" />')
		$(form).trigger('submit')
	})

	$('#btn-export').on('click',function(){
		let semester = 1;
			semester = $('#semester_no').text();
		let course_id = $('select#select-course-id').val();
		let year_id = $('select#select-year-id').val();
		window.open('<?=site_url('export/events_collections/')?>'+semester+'/'+year_id+'/'+course_id)
	})
});
