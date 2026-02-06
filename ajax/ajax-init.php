<?php
/**
 * AJAX Handlers Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Example AJAX Handler
 */
function julius_ajax_example_handler() {
    // Check nonce
    check_ajax_referer( 'julius-nonce', 'nonce' );
    
    // Your AJAX logic here
    $response = array(
        'success' => true,
        'message' => 'AJAX request successful',
    );
    
    wp_send_json_success( $response );
}
add_action( 'wp_ajax_julius_example', 'julius_ajax_example_handler' );
add_action( 'wp_ajax_nopriv_julius_example', 'julius_ajax_example_handler' );
