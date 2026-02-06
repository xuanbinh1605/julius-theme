<?php
/**
 * Custom Post Types Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types
 */
function julius_register_custom_post_types() {
    // Example: Register a Portfolio CPT
    // Uncomment and modify as needed
    /*
    register_post_type( 'portfolio', array(
        'labels' => array(
            'name' => 'Portfolio',
            'singular_name' => 'Portfolio Item',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    ) );
    */
}
add_action( 'init', 'julius_register_custom_post_types' );
