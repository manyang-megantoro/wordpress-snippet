$(document).on("click",".download-btn",function(e) {
  e.preventDefault();
  var the_card = $(this).parent().closest('.card');
  var form_id = ajax_login_object.form_id;
  var post_id = ajax_login_object.post_id;
  var form_name = the_card.attr('form-name');
  var nonce = $('#nonce_secure_'+post_id).val();
  $.ajax({
      type: 'POST',
      url: ajaxurl,
      dataType: 'json',
      data: {
          'action': 'get_data_progress',
          'form_id' : form_id,
          'post_id'  : post_id,
          'nonce'    : nonce,
      },
      success: function(data){
        var data = data.data;
        var error = data.error;
        console.log(error);
      }
  });
});
