<?php
/**
 * Newsletter Module Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include database functions
require_once JULIUS_THEME_DIR . '/newsletter/newsletter-database.php';

// Include email functions
require_once JULIUS_THEME_DIR . '/newsletter/newsletter-email.php';

// Include form handlers
require_once JULIUS_THEME_DIR . '/newsletter/newsletter-handler.php';

// Include admin page
require_once JULIUS_THEME_DIR . '/newsletter/newsletter-admin.php';

/**
 * Activate newsletter on theme activation
 */
function julius_newsletter_activate() {
    julius_create_newsletter_table();
}
add_action( 'after_switch_theme', 'julius_newsletter_activate' );

/**
 * Create newsletter table if it doesn't exist (on admin init)
 */
function julius_newsletter_check_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    // Check if table exists
    if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
        julius_create_newsletter_table();
    }
}
add_action( 'admin_init', 'julius_newsletter_check_table' );
