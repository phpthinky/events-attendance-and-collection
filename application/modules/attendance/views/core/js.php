$(function(){
var resultContainer = document.getElementById('qr-reader-results');
var lastResult, countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        console.log(decodedText);
        var qrcode_result = JSON.parse(decodedText);
        var student_id = qrcode_result[0];
            var info = JSON.parse(qrcode_result[1])
           // console.log(info)
            /*var table_body = $('#table-attendees tbody')
                $(table_body).prepend(
                    $('<tr/>').append(
                        $('<td/>').text(student_id)
                        ).append(
                        $('<td/>').text(info.name)

                        ).append(
                        $('<td/>').addClass('time-in-'+student_id)
                        
                        ).append(
                        $('<td/>').addClass('time-out-'+student_id)
                        
                        ).data('student_id',student_id)
                    );
                */
            var formdata = $('#form-time-in-out').serializeObject();
                formdata.student_id = student_id;
               /*
                formdata.timeinout = $('input[name="in_out"]:checked').val();
                formdata.event_id = '<?=isset($event_info->id) ? $event_info->id : 0?>';
                formdata.current_time = '<?=date('Y-m-d H:i:s')?>';
                */
                console.log(formdata);
                if (formdata.in_out == 'in') {
                $('td.time-in-'+student_id).text(formdata.current_time)

                }
                if (formdata.in_out == 'out') {
                $('td.time-out-'+student_id).text(formdata.current_time)
                    
                }
//                return false;

             $.ajax({
                url:'<?=site_url('attendance/record')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    console.log(response)
                    //if (response.data !== undefined) {
                        var table = $('table#table-attendees tbody');
                        $(table).html('')
                        $.each(response.data,function (i,d) {
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
                    //};
                    notify(response)
                },
                error:function(i,e){
                    console.log(i.responseText)
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

current_time();


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



    $('#btn-cancel-event').on('click',function() {
        if (confirm('This will cancel the current event. No collection will be computed.')) {
            //notify('Canceled','warning');
            let event_id = $(this).data('event_id')
            console.log(event_id);
            $.ajax({
                url:'<?=site_url('events/canceled/')?>'+event_id,
                method:'POST',
                dataType:'JSON',
                beforeSend:function(){
                    alert('Loading kunwari......')
                },
                success:function (response) {
                    // body...
                    console.log(response)
                },
                error:function(i,e) {
                    console.log(i.responseText)
                }
            })
        }
    })
})