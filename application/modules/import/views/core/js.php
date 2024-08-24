var app = {};



function cleanSheetData(sheetdata) {
  // body...
          var emptyrow_no = 0;
          var newdata = [];
          var newsheetdata = [];

       
             $.each(sheetdata,function(index,value){
          

          emptyrow_no = 0;
          $.each(value,function(key,cellvalue){

            if (cellvalue == "") {
              emptyrow_no++;
            }
          })
          if(Object.values(value).length <= emptyrow_no){
            
           // console.log('Looks good')
            return false;
          }else{
            newsheetdata.push(value)
          }
        })


        return newsheetdata;
}


	$('form#form-import').on('submit',function(e){
		e.preventDefault();

		var formdata = app.worksheetdata;
		///import_upload(data[0])
		//console.log(data);

      $.ajax({
      type:'post',
      dataType: "json",
      url: '<?=site_url('import/students')?>',
      data: formdata[0],
      success: function(response){
      	console.log(response)
                $('.alert').html('')

        if (response.status == true) {
            $.notify('Import completed.','success')
            $('.alert').removeClass('alert-danger');
            $('.alert').addClass('alert-success');
        }else{
            $.notify('Import failed.','error')

            $('.alert').addClass('alert-danger');
            $('.alert').removeClass('alert-success');
            if (response.errors) {
                $.each(response.errors,function(i,d){
                $('.alert').append($('<span/>').text(d).attr('style','padding-right:5px;'))

                })
            }
        }

      },

                error: function (request, status, error) {
                            console.log(request.responseText);
                },
    });



	})
    $('input#import_excel').on('change',function(e){

            var reader = new FileReader();

                  var worksheetdata = [];
            reader.readAsArrayBuffer(e.target.files[0]);
            reader.onload = function(e){
                  var data = new Uint8Array(reader.result);
                  var workbook = XLSX.read(data,{type:'array'});
                  // var htmlstr = XLSX.write(wb,{sheet:"Research", type:'binary',bookType:'html'});
                  var worksheet = workbook.SheetNames;
                     for (var i = 0; i < worksheet.length;  i++) {


                  
                    
                    var sheetname = worksheet[i];
                    console.log(sheetname)

                    if(sheetname == 'Students'){

                        
                        var sheetdata= XLSX.utils.sheet_to_json(workbook.Sheets[worksheet[i]],{defval:""});
                    
                        sheetdata = cleanSheetData(sheetdata);

                        worksheetdata.push({sheet:sheetname,data:sheetdata});
                        //console.log(sheetdata)
                        if(sheetdata[0]){
                        	//console.log(sheetdata)
                        	let row_1 = sheetdata[0];
                        	if (row_1.student_id && row_1.semester) {
                        		//console.log(row_1)

                        		$('#btn-import-now').prop('disabled',false);
                        	}else{

	                    	alert('Invalid excel file');
	                    	return false;		
                        	}
                        	//console.log(row_1.length)
                        }
                        //import_preview(sheetdata,default_keys)

                        break;
                    }else{
                    	alert('Invalid excel file');
                    	return false;
                    }

                  }
                  $('#btn-import-now').prop('disabled',false)
                

            }
              app.worksheetdata = worksheetdata;

    });




$('#tab-column').on('click','#btn-new-column',function(){
	var frmdata = {};
		frmdata.form = 'newcolumn';
		frmdata.column_title = $('input.add-column[name="column_title"]').val();
		frmdata.type = 'research';

	$.ajax({
	    		data:frmdata,
	    		url: site_url+'/research/index',
	    		type:'POST',
	    		dataType:'json',
	    		beforeSend: function(){

	    		},
	    		success: function(response){
	    			console.log(response)

	    			if (response.status ==  true) {
	    				alertify.success(response.msg)
	    			}else{
	    				alertify.warning(response.msg)

	    			}
	    		},
	    		error: function(i,r,e){
	    			console.log(i.responseText)
	    		}
	    	})


})

$('.btn-approveall').on('click',function(){

      $.ajax({
      type:'post',
      dataType: "json",
      url: current_url,
      data: 'form=approvedall',
      success: function(response){
      	console.log(response)

      	if (response.status == true) {

      	alertify.success(response.msg)

      	}else{

      	alertify.warning(response.msg)
      	}
      },

                error: function (request, status, error) {
                            console.log(request.responseText);
                },
    });
})
