function previewphoto(input) {
		// body...
		console.log(input.files);
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			// body...
			$('.preview-photo').attr('src','');
			$('.preview-photo').attr('src',e.target.result);
			$('.preview-photo').attr('style','width:150px;height:150px;max-with:150px;max-height:150px;');

		};
		reader.readAsDataURL(input.files[0])
		}

	}
$(function(){
	
  $.fn.replaceOptions = function(options) {
    var self, $option;

    this.empty();
    self = this;

    $.each(options, function(index, option) {
      $option = $("<option></option>")
        .attr("value", option.value)
        .text(option.text);
      self.append($option);
    });
    
  };
  

	$.fn.serializeObject = function () {
		// body...
		var object = {}
		$.each($(this).serializeArray(),function(i,d){
			if (object.hasOwnProperty(d.name)) {
				object[d.name] = $.makeArray(object[d.name]);
				object[d.name].push(d.value)
			}
			else{
				object[d.name] = d.value
			}
		})
		return object;		
	};
  $('.min-date').prop('min',function(){
    return new Date().toJSON().split('T')[0];
  })

	
});

  function notify(data,title) {
  	// body...

  		if (data !== undefined) {
  			tTitle = 'Success';
  			fTitle = 'Error';
  							if (data.msg !== undefined) {

				  			if (data.status == true) {
				  				if (title !== undefined) {
				  					tTitle = title;
				  				}
				        new PNotify({
				            title: tTitle,
				            text: data.msg,
				            addclass:'alert alert-success'
				        });	
				  			}else{

				        new PNotify({
				            title: fTitle,
				            text: data.msg,
				            addclass:'alert alert-warning'
				        });
				  			}
  							}else{

				  			if (data.status == true) {
				  				if (title !== undefined) {
				  					tTitle = title;
				  				}
				        new PNotify({
				            title: tTitle,
				            text: "Data successfully save.",
				            addclass:'alert alert-success'
				        });	
				  			}else{

				        new PNotify({
				            title: fTitle,
				            text: "Something went wrong!",
				            addclass:'alert alert-warning'
				        });
				  			}

  							}
  		}else{

        new PNotify({
            title: "Notification",
            text: "Unknown action was made.",
            addclass:'alert alert-warning',
            buttons:{
            	close:true,
            }
        });
  		}
  }