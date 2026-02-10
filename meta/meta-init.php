<?php
/**
 * Meta Boxes Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Custom Meta Boxes
 */
function julius_add_meta_boxes() {
    // Example meta box
    // Uncomment and modify as needed
    /*
    add_meta_box(
        'julius_custom_meta',
        'Custom Settings',
        'julius_render_meta_box',
        'post',
        'normal',
        'high'
    );
    */
}
add_action( 'add_meta_boxes', 'julius_add_meta_boxes' );

/**
 * Render Meta Box Content
 */
function julius_render_meta_box( $post ) {
    // Add nonce for security
    wp_nonce_field( 'julius_meta_box_nonce', 'julius_meta_box_nonce' );
    
    // Get existing value
    $value = get_post_meta( $post->ID, '_julius_custom_field', true );
    
    // Output field
    echo '<label for="julius_custom_field">Custom Field:</label>';
    echo '<input type="text" id="julius_custom_field" name="julius_custom_field" value="' . esc_attr( $value ) . '" />';
}

/**
 * Save Meta Box Data
 */
function julius_save_meta_box( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['julius_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['julius_meta_box_nonce'], 'julius_meta_box_nonce' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save data
    if ( isset( $_POST['julius_custom_field'] ) ) {
        update_post_meta( $post_id, '_julius_custom_field', sanitize_text_field( $_POST['julius_custom_field'] ) );
    }
}
add_action( 'save_post', 'julius_save_meta_box' );

/**
 * Include Service Meta Boxes
 */
if ( file_exists( JULIUS_THEME_DIR . '/meta/meta-service.php' ) ) {
    require_once JULIUS_THEME_DIR . '/meta/meta-service.php';
}

/**
 * Include Blog Meta Boxes
 */
if ( file_exists( JULIUS_THEME_DIR . '/meta/meta-blog.php' ) ) {
    require_once JULIUS_THEME_DIR . '/meta/meta-blog.php';
}
