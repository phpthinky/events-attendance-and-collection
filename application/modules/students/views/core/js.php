$(function(){
	var table = $('table#table-list-students-library').DataTable();

	
    $('input[name="searchstring"').on('keyup',function(){

      table.search($(this).val()).draw() ;
    })

	var id_number = true;

	$('input[name="student_id"]').on('change',function(){

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
			beforeSend:	function(){
				$('.btn-add').addClass('d-none');
			},
			success: function(response){
				console.log(response)
				//alert(response.data)
				notify(response)
			},
			error: function (i,e) {
				// body...
				console.log(i.responseText)
			},
			complete:function(){
				$('.btn-add').removeClass('d-none');

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
			let rdata ={}
			if (formdata.fName.length <=0) {
				rdata.status = false;
				rdata.msg = 'Please enter first name.';
				notify(rdata)
				$('input[name="fName"]').focus();
				return false;
			}
			if (formdata.lName.length <=0) {
				rdata.status = false;
				rdata.msg = 'Please enter last name.';
				notify(rdata)
				$('input[name="lName"]').focus();

				return false;
			}
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




	$('form#form-edit-students').on('submit',function(e){
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
			url: '<?=site_url('students/save_edited')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			processData:false,
			contentType:false,
			beforeSend:	function(){
				$('.btn-add').addClass('d-none');
			},
			success: function(response){
				console.log(response)
				//alert(response.data)
				notify(response)
			},
			error: function (i,e) {
				// body...
				console.log(i.responseText)
			},
			complete:function(){
				$('.btn-add').removeClass('d-none');

			}
		})

	})


//end onload
})


$(function(){

var resultContainer = document.getElementById('qr-reader-results');
var lastResult, countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        console.log(decodedText);
        var qrcode_result = decodedText.split('/');
        var student_id = qrcode_result[7];
            //var info = JSON.parse(qrcode_result[1])
           // console.log(info)
            var table_body = $('#table-attendees tbody');

            var formdata = {};//$('#form-time-in-out').serializeObject();
                formdata.student_id = student_id;

             $.ajax({
                url:'<?=site_url('students/scanned')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                	if (response.status == true) {
                		$().nSuccess('Scanned completed.')
                	let rdata = response.data;
                	console.log(rdata)
                		$('#form-quick-info span#student_name').text(rdata.fName+' '+rdata.mName+' '+rdata.lName+' '+rdata.ext)
                		$('#form-quick-info select[name="course"]').val(rdata.course_id)
                		$('#form-quick-info select[name="grade"]').val(rdata.grade)
                		$('#form-quick-info select[name="section"]').val(rdata.section)
                		$('#form-quick-info select[name="year"]').val(rdata.year)
                		$('#form-quick-info select[name="year_id"]').val(rdata.year_id)
                		$('#form-quick-info select[name="status"]').val(rdata.enrolled_status)
                		$('#form-quick-info input[name="student_id"]').val(rdata.code)
                		$('#form-quick-info .btn-save').removeClass('d-none')
                	}else{
                		$().nError(response.msg)

                		if($('#form-quick-info .btn-save').hasClass('d-none')){

                		}else{
                		$('#form-quick-info .btn-save').addClass('d-none')

                		}

                	}
                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })
        


    }else{
    }
}

var start_scanner = false;
$('#start-scanner').on('click',function (e) {
    $(this).addClass('d-none')
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
    
})

$('#form-quick-info').on('submit',function(e){
	e.preventDefault();
	var formdata = $(this).serializeObject();
	     $.ajax({
                url:'<?=site_url('students/quick_edit')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                	console.log(response)
                	if(response.status == true){
                		$().nSuccess(response.msg)
                	}else{
                		$().nError(response.msg)
                	}
                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })

})



$('#btn-approved').on('click',function(){
	let formdata = {};
	let tr = $(this).closest('tr');
	formdata.student_id = $(this).data('id');
	formdata.action = 'approved';
	 $.ajax({
                url:'<?=current_url()?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                	console.log(response.status)
                	if(response.status == true){
						$(tr).remove()
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

$('#btn-disapproved').on('click',function(){
	let formdata = {};
	let tr = $(this).closest('tr');
	formdata.student_id = $(this).data('id');
	formdata.action = 'disapproved';

	 $.ajax({
                url:'<?=current_url()?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                	console.log(response)
                	if(response.status == true){
                		$.notify(response.msg,'success')

                	}else{
						$(tr).remove()

                		$.notify(response.msg)
                	}
                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })
})

//edn onload
})