<?php
/**
 * Booking Module Initialization
 * 
 * This file initializes the booking system by including all necessary files,
 * registering hooks, and setting up the database table.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include booking module files
require_once get_template_directory() . '/booking/booking-database.php';
require_once get_template_directory() . '/booking/booking-email.php';
require_once get_template_directory() . '/booking/booking-handler.php';
require_once get_template_directory() . '/booking/booking-admin.php';

/**
 * Initialize booking table on theme activation
 */
function julius_booking_init() {
    julius_create_booking_table();
}
add_action('after_switch_theme', 'julius_booking_init');

/**
 * Check and create booking table if it doesn't exist
 */
function julius_booking_check_table() {
    $installed_version = get_option( 'julius_db_version', '0' );

    if ( version_compare( $installed_version, JULIUS_DB_VERSION, '<' ) ) {
        julius_create_booking_table();
        update_option( 'julius_db_version', JULIUS_DB_VERSION );
    }
}
add_action('admin_init', 'julius_booking_check_table');

/**
 * Register AJAX handlers
 */
add_action('wp_ajax_julius_booking_submit', 'julius_booking_ajax_submit');
add_action('wp_ajax_nopriv_julius_booking_submit', 'julius_booking_ajax_submit');

add_action('wp_ajax_julius_booking_contact_submit', 'julius_booking_contact_ajax_submit');
add_action('wp_ajax_nopriv_julius_booking_contact_submit', 'julius_booking_contact_ajax_submit');

add_action( 'wp_ajax_julius_check_slots', 'julius_booking_check_slots_ajax' );
add_action( 'wp_ajax_nopriv_julius_check_slots', 'julius_booking_check_slots_ajax' );

/**
 * Register contact form admin-post handlers
 */
add_action('admin_post_julius_contact_form', 'julius_contact_form_handler');
add_action('admin_post_nopriv_julius_contact_form', 'julius_contact_form_handler');

/**
 * Register admin menu
 */
add_action('admin_menu', 'julius_booking_admin_menu');

/**
 * Handle admin actions
 */
add_action('admin_init', 'julius_booking_handle_admin_actions');

/**
 * Enqueue booking JavaScript
 */
function julius_booking_enqueue_scripts() {
    // Only enqueue on service and contact pages
    if (is_singular('service') || is_page_template('template-contact.php')) {
        wp_enqueue_script(
            'julius-booking',
            get_template_directory_uri() . '/js/booking.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        wp_localize_script('julius-booking', 'juliusBooking', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('julius_booking_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'julius_booking_enqueue_scripts');
