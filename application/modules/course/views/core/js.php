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

})