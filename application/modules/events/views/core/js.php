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
		console.log(formdata)

		if (formdata.attendees_course == undefined || formdata.attendees_year == undefined ) {

			alert('Please select event attendees!')
			return false;
		}
		
		$.ajax({
			url: '<?=site_url('events/add')?>',
			data:formdata,
			dataType:'json',
			method:'POST',
			success:
			function(response){
				console.log(response)
				if (response.msg !== undefined) {
				notify(response)

				}
			},
			error:
			function (i,e) {
				// body...
				console.log(i.responseText)
			}
		})

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
				notify(response)
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
})