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
//table filter
var table =  $('table').DataTable();

    $('#select-year-id').on('change',function(){
        $('#select-course-id').trigger('change');
    });
    $('#select-course-id').on('change',function(){

        var formdata = {};
            formdata.course_id = $(this).val();
            formdata.year_id = $('#select-year-id').val();
            $('table').draw_table(formdata);

    })
    $('input[name="searchstring"').on('keyup',function(){

      table.search($(this).val()).draw() ;
    })



    $.fn.draw_table = function(formdata){
            $(this).DataTable({
            ajax:{
                url:'<?=current_url()?>',
                type:'POST',
                data:formdata
            },
            columns:[
                        {data:'student_id'},
                        {data:'student_name'},
                        {data:'course'},
                        {data:'amount_pay'},
                        {data:'date_of_payment'},
                        {data:'semester'}
            ],
            destroy:true
                });

    }


//scanner
var resultContainer = document.getElementById('qr-reader-results');
var lastResult, countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        //console.log(decodedText);
        //var qrcode_result = JSON.parse(decodedText);
       // var result = decodedText.split('/')
        var student_id =  GetURLParameter('qrcode',decodedText);
        if (student_id === undefined) {
            $.notify('Invalid QRCODE');
            return false;
        }
            //var info = JSON.parse(qrcode_result[1])
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
                    
                        if (response.status == true) {
                            $.notify(response.msg,'success');
                            $('#scan-result').text(response.msg).addClass('alert alert-success')

                        }else{
                            $.notify('No student found.','error');
                            $('#scan-result').text(response.msg).addClass('alert alert-danger')

                        }

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
                            var count =1;

                        $.each(response.data.utang,function (i,d) {
                            // body...
                            $(table).append(
                                $('<tr/>').addClass('tr-'+count).append(
                                    $('<td/>').text(count)
                                    ).append(
                                    $('<td/>').text(d.event_title)
                                    ).append(
                                    $('<td/>').text(d.bayarin)
                                    ).append(
                                    $('<td/>').append(
                                        $('<button/>')
                                            .addClass('btn btn-sm btn-outline-success btn-pay')
                                            .data('event_id',d.event_id)
                                            .data('student_id',d.student_id)
                                            .data('count',count)
                                            .data('type',d.type)
                                            .text('Pay')
                                        )
                                    )
                                );
                            count++;

                        })
                        $('.btn-pay').on('click',function(){
                            var student_id = $(this).data('student_id')
                            var event_id = $(this).data('event_id')
                            var counter = $(this).data('count')
                            var type = $(this).data('type')
                          //console.log(student_id+' - '+event_id);
                            $('#pay_event_id').val(event_id)
                            $('#pay_student_id').val(student_id)
                            $('#modal-pay').modal('show')
                            $('#form-pay').on('submit',function(e){
                                e.preventDefault();
                                let formdata = $(this).serializeObject();
                                formdata.type = type;
                                $.ajax({
                                    url:'<?=site_url('collections/pay')?>',
                                    method:'post',
                                    dataType:'json',
                                    data:formdata,
                                    beforeSend:function(){
                                        $('#btn-paid').addClass('disabled').prop('disabled',true);
                                    },
                                    success:function(response){
                                        console.log(response)

                                        if (response.status == true) {
                                            $.notify(response.msg,'success')
                                            $('#modal-pay').modal('hide')
                                            $('#btn-paid').removeClass('disabled').removeAttr('disabled');
                                            $('.tr-'+counter).remove();
                                            console.log(counter)
                                        }else{
                                            $.notify(response.msg,'error')

                                            $('#btn-paid').removeClass('disabled').removeAttr('disabled');

                                        }
                                    },
                                    error:function(i,e){
                                        console.log(i.responseText)
                                    }
                                })
                            })

                        })
                        /**/
                    //};
                    //notify(response)

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


});
 
<?php include_once('print.js.php'); ?>
<?php include_once('chart.js.php'); ?>