$(function(){
	var semester = 0;
$('.input-radio').on('click',function(){


		var frmdata =  $('form#set-semester').serializeObject();
		if (semester == frmdata.semester) {
			
			//return false;

		}else{


		semester = frmdata.semester;
		console.log(frmdata);
			$.ajax({
				url:'<?=current_url()?>',
				data:frmdata,
				method:'POST',
				dataType:'json',
				success:function(response){

				},error:function(i,e){
					console.log(i.responseText)
				}
			})

		}

});


//end on load function
});


