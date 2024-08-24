$(function(){

	$('#course_logo').on('change',function(e){
		//$(this).previewphoto
		previewphoto(this)
	})

	$('form#form-add-course').on('submit',function(e){
		e.preventDefault()

		var formdata = new FormData(this);
		//console.log(formdata)
		$.ajax({
			url: '<?=site_url('course/create')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			processData:false,
			contentType:false,
			success:
			function(response){
				console.log(response)
				if (response.status == true) {
					$.notify(response.msg,'success')
				}else{
					$.notify(response.msg,'error')
				}
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

	})



	$('form#form-edit-course').on('submit',function(e){
		e.preventDefault()
		let id = $('#select-course-edit').val();
		var formdata = new FormData(this);
		//console.log(formdata)
		$.ajax({
			url: '<?=site_url('course/update/')?>'+id,
			data:formdata,
			dataType:'json',
			method:'POST',
			processData:false,
			contentType:false,
			success:
			function(response){
				console.log(response)
				if (response.status == true) {
					$.notify(response.msg,'success')
				}else{
					$.notify(response.msg,'error')
				}
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})


	})


		$('#select-course-edit').on('change',function(){
			let id = $(this).val()
			

			$.ajax({
				url:'<?=site_url('course/get/')?>'+id,
				dataType:'json',
				success:function(response) {
					if (response.status == true) {
						let data = response.data
						$('#form-edit-course #ecourse_title').val(data.course_title)
						$('#form-edit-course #ecourse_sub_title').val(data.course_sub_title)
						$('#form-edit-course #ecourse_description').val(data.course_description)
						$('#form-edit-course .preview-photo').attr('src',data.logo)

					}
				},
				error:function(i,e) {
					console.log(i.responseText)
				}
			})
		})
})