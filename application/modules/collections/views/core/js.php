$(function(){

	$('form#form-collection-settings').on('submit',function(e){
		e.preventDefault();

		var formdata = $(this).serializeObject();

             $.ajax({
                url:'<?=site_url('collections/settings')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    console.log(response)
                    notify(response)
                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })
	})
//})

//$(function(){
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
            var table_body = $('#table-attendees tbody');

            var formdata = {};//$('#form-time-in-out').serializeObject();
                formdata.student_id = student_id;
               /*
                formdata.timeinout = $('input[name="in_out"]:checked').val();
                formdata.event_id = '<?=isset($event_info->id) ? $event_info->id : 0?>';
                formdata.current_time = '<?=date('Y-m-d H:i:s')?>';
                */
               // console.log(formdata);
                if (formdata.in_out == 'in') {
                $('td.time-in-'+student_id).text(formdata.current_time)

                }
                if (formdata.in_out == 'out') {
                $('td.time-out-'+student_id).text(formdata.current_time)
                    
                }
//                return false;

             $.ajax({
                url:'<?=site_url('collections/scanned')?>',
                data:formdata,
                method:'POST',
                dataType:'json',
                success:function(response){
                    console.log(response)
                    if (response.data !== undefined) {
                       // alert('Hello')
                        var info = response.data.info;
                        $('#c-student-name').text(info.student_name);
                        var ul = $('ul#c-student-info');

                        $(ul).html('')
                        $(ul).append(
                            '<li>'+info.address1+'</li>'+
                            '<li>'+info.course_sub_title+'</li>'+
                            '<li>'+info.contact_no+'</li>'+
                            '<li>'+info.grade+' | '+info.section+'</li>'
                            );

                    }
                       /**/

                        var table = $('table#table-balance-sheet tbody');
                        $(table).html('')
                        $.each(response.data.utang,function (i,d) {
                            // body...
                            var count =1;
                            $(table).append(
                                $('<tr/>').append(
                                    $('<td/>').text(count++)
                                    ).append(
                                    $('<td/>').text(d.event_title)
                                    ).append(
                                    $('<td/>').text(d.late_fee)
                                    ).append(
                                    $('<td/>').text()
                                    )
                                );


                        })
                        /**/
                    //};
                    notify(response)
                },
                error:function(i,e){
                    console.log(i.responseText)
                }
            })
        


    }else{
        var data = {};
            data.status = false;
            data.msg = 'Failed! Your ID is already scanned.';
        notify(data)
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
 
