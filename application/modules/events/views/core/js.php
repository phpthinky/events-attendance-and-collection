$(function(){
	/*
	if ($('body').hasClass('nav-md')) {
		$('body').removeClass('nav-md')
		$('body').addClass('nav-sm')
	}
	*/
	var event_id = '<?=isset($event_info->id) ? $event_info->id: 0?>';
	var event_attendees_course = '<?=isset($event_info->attendees_course) ? $event_info->attendees_course: '[]'?>';
	var event_attendees_year = '<?=isset($event_info->attendees_year) ? $event_info->attendees_year: '[]' ?>';

	if (event_attendees_course.length > 0) { var attendees_course = JSON.parse
	(event_attendees_course); if (attendees_course.length > 0) { $
	('#attendees_course').val(attendees_course) } } if
	(event_attendees_year.length > 0) {

		var attendees_year = JSON.parse(event_attendees_year);
		if (attendees_year.length > 0) {
			$('#attendees_year').val(attendees_year)
		}

	}
	$('form#form-add-events').on('submit',function(e){
		e.preventDefault()

		var formdata = $(this).serializeObject();
		//console.log(formdata)

		if (formdata.attendees_course == undefined || formdata.attendees_year == undefined ) {

			$.notify('Please select event attendees!')
			return false;
		}
		
		$.ajax({
			url: '<?=site_url('events/add')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			beforeSend:function(){
				$('#btn-submit').addClass('d-none')
				$('.pre-text').removeClass('d-none')
			},
			success:function(response){
				console.log(response)
				if (response.status == true) {
				$.notify(response.msg,'success')

				}else{
				$.notify(response.msg)
				$('#btn-submit').removeClass('d-none')

				}
			},
			error:function (i,e) {
				// body...
				console.log(i.responseText)
				$('.pre-text').text('Something went wrong!')

			},
			complete:function(){
				$('.pre-text').addClass('d-none')

			}

		})

	})
	$('#event_startdate').on('change',function(){
		var date = $(this).val();
		var days = $('input[name="no_days"]').val();
		var ndate = addDays(date,(days-1));
		//alert(ndate);

		$('#event_enddate').text(tomdy(ndate))
	})
 	
	$('#e_event_startdate').on('change',function(){
		var date = $(this).val();
		$('#event_enddate').text(tomdy(date))
	})
	$('select#attendees_course').on('change',function(){
		var text = [];
		$('select#attendees_course option:selected').each(function(){

		   var $this = $(this);
		   if ($this.length) {
		   	text.push($this.text())
		   }
		})
		    $('#selected_attendees_course').text(text.join(', '))

	})

	$('select#attendees_year').on('change',function(){
		var text = [];
		$('select#attendees_year option:selected').each(function(){

		   var $this = $(this);
		   if ($this.length) {
		   	text.push($this.text())
		   }
		})
		    $('#selected_attendees_year').text(text.join(', '))

	})
	$(document).on('click','.btn-stop-event',function(){
		var formdata = {};
			formdata.action = 'stop';
			formdata.event_id  = $(this).data('event_id');
			//var data = {}
			//data.status = true;
			//data.msg = "Sample msg";
			//notify(data);
			//return false;
			var tr = $(this).parent().parent();
			if (confirm('This action will stop the event! Click Ok to continue.')) {
			console.log(formdata)


/**/
		$.ajax({
			url: '<?=site_url('events/stop')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			success:
			function(response){
				console.log(response)
				if (response.status == true) {
					$(tr).remove()

				}
				$.notify(response.msg,'warning')
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

	/*	*/

			}
	})


	$('select[name="has_afternoon"]').on('change',function(){
		let val = $(this).val();
		$('.time-in').addClass('d-none')
		if (val == 1) {
			$('.morning').removeClass('d-none')
			$('.afternoon').addClass('d-none')
		}

		if (val == 2) {
			$('.afternoon').removeClass('d-none')
			$('.morning').addClass('d-none')
		}

		if (val == 0) {
			$('.morning').removeClass('d-none')
			$('.afternoon').removeClass('d-none')
		}
	})
	$('select[name="has_afternoon"]').trigger('change')
	
	$('select#select-year_id').on('change',function(){
		$.ajax({
			url:'<?=site_url('events/listevents/')?>'+$(this).val(),
			dataType:'text',
			success:function(response){
				//console.log(response)
				$('select#select-events').html(response)
			},
			error: function(i,e){
				console.log(i.responseText)
			}
		})

	});


	$('select#select-course').on('change',function(){

		$('select#select-events').trigger('change');		

	});

	$('select#select-events').on('change',function(){

		var formdata = {};
			formdata.event_id = $(this).val();
			formdata.course_id = $('select#select-course').val();
			formdata.year_id = $('select#select-year_id').val();
			

			$.ajax({
			url: '<?=site_url('events/get_attendees/')?>'+formdata.event_id+'/'+formdata.course_id,
			data:formdata,
			dataType:'json',
			success:
			function(response){
				console.log(response)
				//if (response.status == true) {
					console.log(response.data)
					$('#table-list-completed').DataTable({
						dom:'B',
						destroy:true,
						data:response.data,
						columns:[
							{data:'student_name'},
							{data:'course_sub_title'},
							{data:'date_of_event'},
							{data:'timein'},
							{data:'timeout'},
							{data:'pm_in'},
							{data:'pm_out'},
							{data:'status'},


							]
					})
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})


	});


		$('select#select-events').trigger('change');	

		$('#btn-export').on('click',function(){

			let event_id = $('select#select-events').val();
			let course_id = $('select#select-course').val();
			let year_id = $('select#select-year_id').val();
			//	let a = $('<a/>');
				let url = '<?=site_url()?>'+'/export/events_completed/'+year_id+'/'+event_id+'/'+course_id;
				window.open(url)
			})

	//end onload
})