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
        console.log(decodedText);
        var qrcode_result = JSON.parse(decodedText);
        var student_id = qrcode_result[0];
            var info = JSON.parse(qrcode_result[1])
           // console.log(info)
            var table_body = $('#table-attendees tbody');

            var formdata = {};//$('#form-time-in-out').serializeObject();
                formdata.student_id = student_id;


             $.ajax({
                url:'<?=current_url()?>',
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
 