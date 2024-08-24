$(function(){


    var event = <?=!empty($event_info) ? json_encode($event_info) : null ?>;
    function get_list(event_id,table) {
        
         $.ajax({
                url:'<?=site_url('attendance/get_list/')?>'+event_id,
                method:'POST',
                dataType:'JSON',
                success:function (response) {
                    // body...
                    if (response !== [] ) {
                        if(!response[0]){
                            return false;
                        }
                        $(table).html('')
                        $.each(response,function (i,d) {
                            // body...

                            $(table).append(
                                $('<tr/>').append(
                                    $('<td/>').text(d.student_id)
                                    ).append(
                                    $('<td/>').text(d.student_name)
                                    ).append(
                                    $('<td/>').text(d.timein)
                                    ).append(
                                    $('<td/>').text(d.timeout)
                                    ).append(
                                    $('<td/>').text(d.pm_in)
                                    ).append(
                                    $('<td/>').text(d.pm_out)
                                    )
                                );


                        })
                    }

                }
            })
    }

    function get_list2(event_id,table,type) {
        console.log(type)
         $.ajax({
                url:'<?=site_url('attendance/get_list/')?>'+event_id,
                method:'POST',
                dataType:'JSON',
                success:function (response) {
                    // body...
                    console.log(response)
                    if (response !== [] ) {
                        $(table).html('')
                        $.each(response,function (i,d) {
                            // body...
                            let timein = '';
                            let timeout = '';
                            if (type == 1) {
                                timein = d.timein;
                                timeout = d.timeout;
                            }else{

                                timein = d.pm_in;
                                timeout = d.pm_out;
                            }
                            $(table).append(
                                $('<tr/>').append(
                                    $('<td/>').text(d.student_id)
                                    ).append(
                                    $('<td/>').text(d.student_name)
                                    ).append(
                                    $('<td/>').text(timein)
                                    ).append(
                                    $('<td/>').text(timeout)
                                    )
                                );


                        })
                    }

                }
            })
    }

    function get_list3(event_id,table) {
        
         $.ajax({
                url:'<?=site_url('attendance/get_list/')?>'+event_id,
                method:'POST',
                dataType:'JSON',
                success:function (response) {
                    // body...
                    console.log(response)
                    if (response !== [] ) {
                        $(table).html('')
                        $.each(response,function (i,d) {
                            // body...
                            
                            $(table).append(
                                $('<tr/>').append(
                                    $('<td/>').text(d.student_id)
                                    ).append(
                                    $('<td/>').text(d.student_name)
                                    ).append(
                                    $('<td/>').text(d.timein)
                                    ).append(
                                    $('<td/>').text(d.timeout)
                                    )
                                );


                        })
                    }

                }
            })
    }
    function show_table() {
        // body...
        console.log(event.has_afternoon)

      //  return false;
    if (event.id) {
        if (event.has_afternoon == 0 ) {
            $('table#table-attendees2').addClass('d-none')
            $('table#table-attendees').removeClass('d-none')

            var table = $('table#table-attendees tbody');
            get_list(event.id,table);

        }else{

            $('table#table-attendees').addClass('d-none')
            $('table#table-attendees2').removeClass('d-none')

            var table = $('table#table-attendees2 tbody');
                let type = event.has_afternoon
                get_list2(event.id,table,type);

        }

    }

    }
show_table();

var resultContainer = document.getElementById('qr-reader-results');
var lastResult, countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        console.log(decodedText);
     
        
        var student_id =  GetURLParameter('qrcode',decodedText);
        if (student_id === undefined) {
            $.notify('Invalid QRCODE');
            return false;
        }
                       // var info = JSON.parse(qrcode_result[1])   
            var formdata = $('#form-time-in-out').serializeObject();
                formdata.student_id = student_id;
console.log(formdata);
             $.ajax({
                url:'<?=site_url('attendance/record')?>',
                data:formdata,
                method:'POST',
                dataType:'JSON',
                beforeSend:function(){
                    $('#scan-result').text('Scanning...');
                },
                success:function(response){
                    console.log(response)
                    if (response.msg){
                        console.log('object is jQuery');

                    }else{
                    response = JSON.parse(response);

                    }



                        if (response.status == true) {
                            $('#scan-result').text(response.msg).addClass('alert alert-success')
                           // let img = $('<img/>').attr('src',response.profile_photo)
                            $.notify(response.msg,'success')

                            show_table();
                        }else{
                            $.notify(response.msg)
                            $('#scan-result').text(response.msg).addClass('alert alert-success')

                        }
                        
                        $('.preview-profile-photo').html('');
                        if (response.profile_photo) {
                                $('.preview-profile-photo').html('<img class="profile-photo" src="'+response.profile_photo+'" />');
                        }
                        
                },
                error:function(i,e){
                    console.log(i.responseText)
                }, complete:function(){

                }
            })
		


    }
}

var start_scanner = false;
$('#start-scanner').on('click',function (e) {
	$(this).addClass('d-none')
			var html5QrcodeScanner = new Html5QrcodeScanner(
			    "qr-reader", { fps: 10, qrbox: 250 });
			html5QrcodeScanner.render(onScanSuccess);
	
})

//current_time();


})

function current_time(){
    const today = new Date();
    
    let month = today.getMonth();
    let year = today.getYear();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checktime(m);
    s = checktime(s);
    
    //$('.current_time').text();
  document.getElementById('current-time').innerHTML = today;
  document.getElementById('current_time').value = h+':'+m+':'+s;
setTimeout(current_time,1000)

}
function checktime(i){
    if (i < 10) {i = "0"+i};
    return i;
}  


$(function(){

    $(document).on('click','#btn-stop-event',function(){
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
                   window.location = '<?=site_url('events')?>';
                }
                notify(response)
            },
            error:
            function (i,e) {
                // body...
                console.log(i.responseText)
            }
        })

    /*  */

            }
    })

    $('input[name="in_out"]').on('click',function(){
        lastResult = ''; 
    })


    $('#btn-cancel-event').on('click',function() {
        if (confirm('This will cancel the current event. No collection will be computed.')) {
            //notify('Canceled','warning');
            let event_id = $(this).data('event_id')
            console.log(event_id);
            $.ajax({
                url:'<?=site_url('events/canceled/')?>'+event_id,
                method:'POST',
                dataType:'JSON',
                success:function (response) {
                    // body...
                    if (response.status == true) {
                        $.notify('Event was canceled. redirecting...')
                    }
                        window.location = '<?=site_url('events')?>';

                    console.log(response)
                },
                error:function(i,e) {
                    console.log(i.responseText)
                }
            })
        }
    })
})