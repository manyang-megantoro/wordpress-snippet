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
          'action': 'ajax_function',
          'form_id' : form_id,
          'post_id'  : post_id,
          'nonce'    : nonce,
      },
      success: function(data){
        var data = data.data;
        var error = data.error;
        console.log(error);
        var csv = '';
        data.forEach(function(row) {
                csv += row.join(',');
                csv += "\n";
        });
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
        var dateTime = date+' '+time;
        var hiddenElement = document.createElement('a');
        hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
        hiddenElement.target = '_blank';
        hiddenElement.download = 'data ajax '+form_name+' '+dateTime+'.csv';
        hiddenElement.click();
      }
  });
});
