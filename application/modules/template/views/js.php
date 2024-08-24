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
$('.btn-print').on('click',function(){
	window.print();
})

$("form").bind("keypress", function (e) {  
	if (e.keyCode == 13) {  
		//alert('enter was clock');
	return false;  
	}  
});
	
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

	
$.fn.nSuccess = function(msg){
	
	$(this).removeClass('alert alert-danger')
	$(this).addClass('alert alert-success')
	$(this).text(msg)
	
		$.notify(msg,'msg')


}
$.fn.nError = function(msg){
	
	$(this).removeClass('alert alert-success')
	$(this).addClass('alert alert-danger')
	$(this).text(msg)
	
		$.notify(msg)
}

//end onload
});

  function notify(data,style) {
  	// body...

   		$.notify(data.msg,style)
  	
  }

  function tomdy(ndate) {
  	// body...
  	var date = new Date(ndate);
    return ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear();
  }
function addDays(ndate, days) {
  var result = new Date(ndate);
 // alert(result.getDate() + parseint(days);
  result.setDate(result.getDate() + parseInt(days));
  return result;
}

function GetURLParameter(sParam,url)
{
   // var sPageURL = window.location.search.substring(1);
	
		var q_url = url.split('?');
	
	//console.log(sPageURL)

    var sURLVariables = q_url[1].split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return decodeURIComponent(sParameterName[1]);
        }
    }
}
/*
var id = GetURLParameter('id');
var name= GetURLParameter('name');
*/