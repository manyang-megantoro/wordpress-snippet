add_action('wp_enqueue_scripts', 'enqueue_scripts',10,1),
function enqueue_scripts($hook){
    wp_enqueue_script('script_ajax_console_error', '/ajax-with-console-error.js', '', '', true);
    wp_enqueue_script('script_ajax_csv', '/ajax-download-csv.js', '', '', true);

    wp_localize_script( 'script_ajax_csv', 'ajax_login_object', array(
        'form_id' => 5,
        'post_id' => 6,
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    wp_localize_script( 'script_ajax_console_error', 'ajax_login_object', array(
        'form_id' => 5,
        'post_id' => 6,
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
  }
add_action('wp_ajax_ajax_function', 'ajax_function',10,1),
add_action('wp_ajax_nopriv_ajax_function', 'ajax_function',10,1),
function ajax_function(){
  $post_id = $_POST['post_id'];
  $form_id = $_POST['form_id'];
  // First check the nonce, if it fails the function will break
  check_ajax_referer( 'nonce_secure_'.$post_id, 'nonce' );
  date_default_timezone_set('Asia/Jakarta');
  $data = [];
  $data[] = ['Post ID', 'Form ID', 'Date'];
  $data[] = [$post_id, $form_id, date('m/d/Y H:i:s', time())];
  $error = [];
  $error[] = 'no error';
  echo json_encode(array(
    'status'=> 'success',
    'data'=> $data,
    'error' => $error
  ));
  die();
}
