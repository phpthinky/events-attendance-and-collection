$(function(){

	var table = $('#table-list-data');

	    table.DataTable({
        ajax:site_url('/barangay/listall')
      })
		list_barangay(2);
	    list_town(3);
	    list_provinces();

	function refreshTable(table,url){
	    table.DataTable({
	    	destroy: true,
        ajax:url
      	})
	}

	function list_barangay(id){

		$.ajax({
			url:site_url('/barangay/list_barangay/')+id,
			dataType:'json',
			success:function (response) {
				// body...
				if (response.data.length > 0) {
				//console.log(response)
					var html = $('.barangay');
						$(html).html('')
					for (var i = response.data.length - 1; i >= 0; i--) {
						console.log(response.data[i].name)
						$(html).append($('<div/>').addClass('col-lg-3 col-6').append(
								$('<div/>').addClass('small-box bg-light').append(
								$('<div/>').addClass('inner').append($('<label/>').addClass('text-title text-primary').text(response.data[i].name)).append($('<p/>').append($('<img/>').addClass('barangay-logo').attr('src','http://www.mswdeccd.local/assets/img/user.png')))
								)
							.append($('<a/>').addClass('small-box-footer').attr('href','<?=site_url('barangay/calamity')?>'+'/'+response.data[i].name).text('More info ').append($('<i/>').addClass('fas fa-arrow-circle-right')))
							)
						)
						
					}
				}
			}
		});
	}

    	var disaster_id = '<?=$disaster_id?>';
    	var barangay_id = '<?=$barangay_id?>';

	$('.view-affected').on('click',function () {
		// body...
		var title = $(this).text();
		var frmdata = {}
		frmdata.disaster_id = $(this).data('disaster_id');
		frmdata.barangay_id = barangay_id;
		$('.disaster-title').text(title)
		$('#table-affected').draw_affected_table(frmdata)
		disaster_id = frmdata.disaster_id;

		
	})
	$('.btn-view-all').on('click',function (e) {
		// body...
		e.preventDefault();
		console.log(disaster_id)

		window.location = site_url('barangay/affected/')+disaster_id+'/'+barangay_id;
	})

		//		url:site_url('affected/list/')+frmdata.disaster_id+'/'+frmdata.barangay_id,
		$.fn.draw_affected_table = function(formdata){
    		$(this).DataTable({
        	ajax:{
	        	url:site_url('affected/list/')+formdata.disaster_id+'/'+formdata.barangay_id,
	        	type:'POST',
	        	data:formdata
	        },
	        columns:[
	        {data:'person_name'},
	        {data:null,
	        	render:function(data,type){
	        		return '<a href="#">View</a>';
	        	}
	    		},
	        ],
	        destroy:true
				});

    	};

    	if( disaster_id> 0){

		var frmdata = {}
		frmdata.disaster_id = disaster_id;;
		frmdata.barangay_id = barangay_id;
		$('#table-affected').draw_affected_table(frmdata)
		$.ajax({url:site_url('disaster/get_name/')+disaster_id,success:function (response) {
			// body...
		$('.disaster-title').text(response)
		}});

    	}
    	

    	$('#table-affected-family').DataTable();


})
