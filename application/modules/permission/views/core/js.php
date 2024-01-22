$(function(){
	list_all_barangay(2);
	list_town(3);
	list_provinces();

	$('input.name').on('keyup',function() {
		// body...
		setTimeout(function() {
			// body...
			var formdata = {};
				formdata.fName = $('input[name="fName"]').val();
				formdata.mName = $('input[name="mName"]').val();
				formdata.lName = $('input[name="lName"]').val();
				formdata.ext = $('input[name="ext"]').val();
				$.ajax({
					url:'<?=site_url('affected/listname')?>',
					dataType:'json',
					data:formdata,
					success:function(response){
						console.log(response);
						if (response.status == true) {
							$('ul#list_names').html('');
							for (var i = response.data.length - 1; i >= 0; i--) {
								
							$('#list_names').append($('<li/>').addClass('list-group-item').append($('<a/>').addClass('item').attr('href','#').data('id',response.data[i].id).text(' '+response.data[i].name).prepend($('<i/>').addClass('fas fa-arrow-circle-right'))));

							}
						}
					}
				})
		},1000);
	})

	$(document).on('click','.item',function(){
		var id = $(this).data('id')
		alert(id)
	})
})