<?php
/**
 * Booking Form Handlers
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle booking form submission via AJAX
 */
function julius_booking_ajax_submit() {
    // Verify nonce
    check_ajax_referer( 'julius_booking_nonce', 'booking_nonce' );
    
    // Validate required fields
    $name = isset( $_POST['booking_name'] ) ? sanitize_text_field( $_POST['booking_name'] ) : '';
    $phone = isset( $_POST['booking_phone'] ) ? sanitize_text_field( $_POST['booking_phone'] ) : '';
    $branch = isset( $_POST['booking_branch'] ) ? sanitize_text_field( $_POST['booking_branch'] ) : '';
    $service_name = isset( $_POST['service_name'] ) ? sanitize_text_field( $_POST['service_name'] ) : '';
    
    if ( empty( $name ) || empty( $phone ) || empty( $branch ) || empty( $service_name ) ) {
        wp_send_json_error( array(
            'message' => __( 'Please fill in all required fields.', 'julius-theme' )
        ) );
    }
    
    // Optional fields
    $email = isset( $_POST['booking_email'] ) ? sanitize_email( $_POST['booking_email'] ) : '';
    $message = isset( $_POST['booking_message'] ) ? sanitize_textarea_field( $_POST['booking_message'] ) : '';
    $service_id = isset( $_POST['service_id'] ) ? absint( $_POST['service_id'] ) : null;
    
    // Get IP address
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    
    // Prepare booking data
    $booking_data = array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'service_id' => $service_id,
        'service_name' => $service_name,
        'branch' => $branch,
        'message' => $message,
        'ip_address' => $ip_address
    );
    
    // Add booking to database
    $booking_id = julius_booking_add( $booking_data );
    
    if ( $booking_id ) {
        // Send confirmation email to user (if email provided)
        if ( ! empty( $email ) && is_email( $email ) ) {
            julius_booking_send_confirmation( $booking_id );
        }
        
        // Send notification to admin
        julius_booking_send_admin_notification( $booking_id );
        
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your booking has been received. We will contact you shortly.', 'julius-theme' )
        ) );
    } else {
        wp_send_json_error( array(
            'message' => __( 'Something went wrong. Please try again later.', 'julius-theme' )
        ) );
    }
}
add_action( 'wp_ajax_nopriv_julius_service_booking', 'julius_booking_ajax_submit' );
add_action( 'wp_ajax_julius_service_booking', 'julius_booking_ajax_submit' );

/**
 * Handle contact form booking submission via AJAX
 */
function julius_booking_contact_ajax_submit() {
    // Verify nonce
    check_ajax_referer( 'julius_contact_nonce', 'contact_nonce' );
    
    // Validate required fields
    $name = isset( $_POST['contact_name'] ) ? sanitize_text_field( $_POST['contact_name'] ) : '';
    $phone = isset( $_POST['contact_phone'] ) ? sanitize_text_field( $_POST['contact_phone'] ) : '';
    $email = isset( $_POST['contact_email'] ) ? sanitize_email( $_POST['contact_email'] ) : '';
    $service = isset( $_POST['contact_service'] ) ? sanitize_text_field( $_POST['contact_service'] ) : '';
    $branch = isset( $_POST['contact_branch'] ) ? sanitize_text_field( $_POST['contact_branch'] ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( $_POST['contact_message'] ) : '';
    
    if ( empty( $name ) || empty( $phone ) || empty( $service ) || empty( $branch ) ) {
        wp_send_json_error( array(
            'message' => __( 'Please fill in all required fields.', 'julius-theme' )
        ) );
    }
    
    // Get IP address
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    
    // Prepare booking data
    $booking_data = array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'service_id' => null,
        'service_name' => $service,
        'branch' => $branch,
        'message' => $message,
        'ip_address' => $ip_address
    );
    
    // Add booking to database
    $booking_id = julius_booking_add( $booking_data );
    
    if ( $booking_id ) {
        // Send confirmation email to user
        if ( ! empty( $email ) && is_email( $email ) ) {
            julius_booking_send_confirmation( $booking_id );
        }
        
        // Send notification to admin
        julius_booking_send_admin_notification( $booking_id );
        
        wp_send_json_success( array(
            'message' => __( 'Thank you for contacting us! We will get back to you shortly.', 'julius-theme' )
        ) );
    } else {
        wp_send_json_error( array(
            'message' => __( 'Something went wrong. Please try again later.', 'julius-theme' )
        ) );
    }
}
add_action( 'wp_ajax_nopriv_julius_contact_booking', 'julius_booking_contact_ajax_submit' );
add_action( 'wp_ajax_julius_contact_booking', 'julius_booking_contact_ajax_submit' );
