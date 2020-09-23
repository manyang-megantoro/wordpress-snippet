//disable for not logged in
add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }

    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});

//disable for all
add_filter( 'rest_authentication_errors', 'wp_snippet_disable_rest_api' );
function wp_snippet_disable_rest_api( $access ) {
     return new WP_Error( 'rest_disabled', __('The WordPress REST API has been disabled.'), array( 'status' => rest_authorization_required_code()));
}

//disable with specific capabilities
add_filter( 'rest_authentication_errors', 'wp_snippet_disable_rest_api' );
function wp_snippet_disable_rest_api( $access ) {
    if(!is_user_logged_in() || (is_user_logged_in() && current_user_can('external_user'))){
        return new WP_Error( 'rest_disabled', __('The WordPress REST API has been disabled.'), array( 'status' => rest_authorization_required_code()));
    }
}
