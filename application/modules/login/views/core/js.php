$(function(){
	//alert('Hello')
	$('#form-enroll').on('submit',function(e){
		e.preventDefault();

		let id_number = $('#student_id').val();
		if (id_number.length < 8 || id_number.length > 12) {
					$.notify('Invalid Student ID');
			return false;
		}
		
		var formdata = $(this).serializeArray();
		$.ajax({
			url:'<?=site_url('login/enroll')?>',
			dataType:'json',
			method:'POST',
			data: formdata,
			success:function(response){
				console.log(response)
				if (response.status == true) {
					$.notify(response.msg,'success')
				}else{
					$.notify(response.msg)

				}
			},
		    error:function(i,e){
		        console.log(i.responseText)
		      }
		})
	})
})