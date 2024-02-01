$(function(){

$('form#frmupdateuser-email').on('submit',function(e){
  e.preventDefault();

  var url = $(this).attr('action')
  var frmdata = $(this).serializeObject();
      $.ajax({
        url:url,
        data:frmdata,
        method:'POST',
        dataType:'json',
        success:function(response){
          notify(response)
        },error:function(i,e){
          console.log(i.responseText)
        }
      })

})
$('.btn-trash-user').on('click',function(e){
  e.preventDefault();
  var parent = $(this).parent().parent();

  var url = $(this).attr('action')
  var frmdata = {};
    frmdata.id = $(this).data('id');
    frmdata.action ='delete-user';
      $.ajax({
        url:'<?=current_url()?>',
        data:frmdata,
        method:'POST',
        dataType:'json',
        success:function(response){
          console.log(response)
          $(parent).remove()
          notify(response)
        },error:function(i,e){
          console.log(i.responseText)
        }
      })

})

$('.btn-modify-user').on('click',function(e){
  e.preventDefault();
  var parent = $(this).parent().parent();
  $('#modal-edit-user .modal-title').text('Modify user');
  $('#modal-edit-user').modal('show');
  var id = $(this).data('id');
  //alert(id)
  console.log($(this).data('perms'));
  $('form#form-edit-userr input[name="user_id"]').val(id);
  $('form#form-edit-userr input[name="username"]').val($('.row-username-'+id).text());
  $('form#form-edit-userr input[name="email"]').val($('.row-email-'+id).text());
  $('form#form-edit-userr select[name="user_permission"]').val($(this).data('perms'));
  $('form#form-edit-userr input[name="action"]').val('edit-user');
})



//add user


$('form#form-add-userr').on('submit',function(e){
  e.preventDefault();

  var frmdata = $(this).serializeObject();
    //frmdata.action ='add-user';
      $.ajax({
        url:'<?=current_url()?>',
        data:frmdata,
        method:'POST',
        dataType:'json',
        success:function(response){
          console.log(response)
          notify(response)
        },error:function(i,e){
          console.log(i.responseText)
        }
      })

})
$('form#form-edit-userr').on('submit',function(e){
  e.preventDefault();

  var frmdata = $(this).serializeObject();
    //frmdata.action ='add-user';
      $.ajax({
        url:'<?=current_url()?>',
        data:frmdata,
        method:'POST',
        dataType:'json',
        success:function(response){
          console.log(response)
          notify(response)
        },error:function(i,e){
          console.log(i.responseText)
        }
      })

})

///end onload
})