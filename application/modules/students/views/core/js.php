$(function(){
	$('table#table-list-students-library').DataTable();
	var id_number = true;

	$('form#form-add-students input[name="student_id"]').on('change',function(){

		var formdata = {};
			formdata.student_id = $(this).val();
		$.ajax({
			url: '<?=site_url('students/find_id')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			success:
			function(response){
				console.log(response)
				if (response.status == true) {
				//notify(response,'Your good to go!')
					$('.id-check').text('Available');
					id_number = true;

				}else{
					id_number = false;
					$('.id-check').text('Unavailable');
				}
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

	})

	$('form#form-add-students').on('submit',function(e){
		e.preventDefault()
		if (id_number == false) {
			var data = {};
				data.status = false;
				data.msg = 'ID Number is Unavailable!';
			notify(data)
			return false;
		}
		var formdata = new FormData(this);
		//console.log(formdata)
		$.ajax({
			url: '<?=site_url('students/add_students')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			processData:false,
			contentType:false,
			success:
			function(response){
				console.log(response)
				notify(response)
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

	})


	$('#btn-check-student-name').on('click',function(e){
		e.preventDefault()

		var formdata = {};
			formdata.fName = $('input[name="fName"]').val();
			formdata.mName = $('input[name="mName"]').val();
			formdata.lName = $('input[name="lName"]').val();
			formdata.ext = $('input[name="ext"]').val();
		//console.log(formdata)
					$('#add-other-info').addClass('d-none')

		$.ajax({
			url: '<?=site_url('students/find')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			success:
			function(response){
				console.log(response)
				if (response.status == true) {
					$('#add-other-info').removeClass('d-none')
				notify(response,'Your good to go!')

				}else{
				//notify(response,'Student exist!')
					console.log(response.data)
      				var ul = $('#add-student-list-group')
      				$(ul).html('')

      				$.each(response.data,function(i,d){
      					$(ul).append($('<li/>').addClass('list-group-item  d-flex justify-content-between align-items-center').text(d.fName+' '+d.mName+' '+d.lName+' '+d.ext+' - '+d.course_sub_title+' '+d.grade+'-'+d.section).append($('<a/>').addClass("btn btn-sm btn-primary btn-select-this-student").attr('href','<?=site_url('students/edit/')?>'+d.code).data('student_id',d.student_id).text('modify')));     						
      					
      				})
				}
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

	})

})