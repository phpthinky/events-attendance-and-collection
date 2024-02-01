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

$('#form-school-year').on('submit',function(e){
	e.preventDefault();

	var formdata = $(this).serializeObject();
             $.ajax({
                url:'<?=site_url('settings/schoolyear')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    notify(response)
                },
                error:function(i,e){
                    console.log(i.responseText)
                },
                complete:function () {
                	// body...
					fill_sy_table();

                }
            })
})


$('#form-school-year-edit').on('submit',function(e){
	e.preventDefault();

	var formdata = $(this).serializeObject();

             $.ajax({
                url:'<?=site_url('settings/schoolyear')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    notify(response)

                },
                error:function(i,e){
                    console.log(i.responseText)
                },
                complete:function () {
                	// body...
					fill_sy_table();
  					$('#form-school-year-edit input[name="save"]').addClass('d-none');


                }
            })
})
$(document).on('click','.btn-edit-sy',function(e){
	e.preventDefault()
	var year_id = $(this).data('year_id')
	$('a[href="#tab-edit-sy"]').trigger('click');
  		$('#form-school-year-edit input[name="save"]').addClass('d-none');

$.getJSON( "<?=site_url('settings/listschoolyears')?>", function( data ) {
  $.each( data, function( key, val ) {
  	if (data.id = year_id) {
  		$('#form-school-year-edit input[name="action"]').val('edit');
  		$('#form-school-year-edit input[name="start_year"]').val(val.start_year);
  		$('#form-school-year-edit input[name="end_year"]').val(val.end_year);
  		$('#form-school-year-edit select[name="status"]').val(val.status);
  		$('#form-school-year-edit input[name="year_id"]').val(year_id);
  		$('#form-school-year-edit input[name="save"]').removeClass('d-none');
		


  		return false;
  	}
  });

});

})

$(document).on('click','.btn-trash-sy',function(e){
	e.preventDefault()
	var year_id = $(this).data('year_id')
	var tr = $(this).parent().parent()

		var formdata = {};
		formdata.action ='trash';
		formdata.year_id =year_id;
             $.ajax({
                url:'<?=site_url('settings/schoolyear')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    notify(response)
                    if (response.status == true) {
						$(tr).remove()

                    }

                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })
})

function fill_sy_table(argument) {
		// body...
	$.getJSON( "<?=site_url('settings/listschoolyears')?>", function( data ) {
	  var items = [];
	  var $i =1;
	  $.each( data, function( key, val ) {
	    items.push( '<tr><td>'+$i+'</td><td>'+val.sy_start_year+' - '+val.sy_end_year+'</td><td>'+val.sy_status+'</td><td><a href="#" data-year_id="'+val.id+'" class="btn btn-sm btn-edit-sy"><i class="fa fa-edit"></i></a> <a href="#" data-year_id="'+val.id+'" class="btn btn-sm btn-ouline-danger btn-trash-sy"><i class="fa fa-trash"></i></a></td></tr>' );
	 	$i++;
	  });
	// console.log(items);
	 var table_sy = $('table#tbl-sy tbody');
	 $(table_sy).html('');
	 $(table_sy).append(items.join(""))

	});


}

fill_sy_table();
//end on load function
});


/*

$.getJSON( "<?=site_url('settings/listschoolyears')?>", function( data ) {
  var items = [];
  $.each( data, function( key, val ) {
    items.push( "<li id='" + key + "'>" + val + "</li>" );
  });
 
  $( "<ul/>", {
    "class": "my-new-list",
    html: items.join( "" )
  }).appendTo( "body" );
});

*/

