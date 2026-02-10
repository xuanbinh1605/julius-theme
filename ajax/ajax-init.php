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

/**
 * Service Booking AJAX Handler
 */
function julius_service_booking_handler() {
    // Check nonce
    if ( ! isset( $_POST['booking_nonce'] ) || ! wp_verify_nonce( $_POST['booking_nonce'], 'julius_booking_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }
    
    // Get form data
    $service_id = isset( $_POST['service_id'] ) ? absint( $_POST['service_id'] ) : 0;
    $service_name = isset( $_POST['service_name'] ) ? sanitize_text_field( $_POST['service_name'] ) : '';
    $name = isset( $_POST['booking_name'] ) ? sanitize_text_field( $_POST['booking_name'] ) : '';
    $phone = isset( $_POST['booking_phone'] ) ? sanitize_text_field( $_POST['booking_phone'] ) : '';
    $branch = isset( $_POST['booking_branch'] ) ? sanitize_text_field( $_POST['booking_branch'] ) : '';
    
    // Validate required fields
    if ( empty( $name ) || empty( $phone ) || empty( $branch ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }
    
    // Get admin email
    $admin_email = get_option( 'admin_email' );
    $site_name = get_bloginfo( 'name' );
    
    // Prepare email
    $to = $admin_email;
    $subject = sprintf( '[%s] New Service Booking Request', $site_name );
    
    $branch_names = array(
        'julius-1' => 'Julius 1 - 5 An Thuong 38',
        'julius-2' => 'Julius 2 - 61 Ta My Duat',
    );
    $branch_name = isset( $branch_names[ $branch ] ) ? $branch_names[ $branch ] : $branch;
    
    $message = sprintf(
        "New service booking request:\n\n" .
        "Service: %s\n" .
        "Customer Name: %s\n" .
        "Phone Number: %s\n" .
        "Branch: %s\n\n" .
        "Submitted: %s\n" .
        "Service Link: %s",
        $service_name,
        $name,
        $phone,
        $branch_name,
        current_time( 'mysql' ),
        get_permalink( $service_id )
    );
    
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    
    // Send email
    $sent = wp_mail( $to, $subject, $message, $headers );
    
    if ( $sent ) {
        // Save booking as post meta or custom post type (optional)
        $booking_data = array(
            'service_id'   => $service_id,
            'service_name' => $service_name,
            'name'         => $name,
            'phone'        => $phone,
            'branch'       => $branch,
            'date'         => current_time( 'mysql' ),
        );
        
        // Store in options table (you can also create a custom table or post type)
        $bookings = get_option( 'julius_service_bookings', array() );
        $bookings[] = $booking_data;
        update_option( 'julius_service_bookings', $bookings );
        
        wp_send_json_success( array( 
            'message' => 'Thank you! Your booking request has been received. We will contact you soon.' 
        ) );
    } else {
        wp_send_json_error( array( 
            'message' => 'Sorry, there was an error sending your booking request. Please try calling us directly.' 
        ) );
    }
}
add_action( 'wp_ajax_julius_service_booking', 'julius_service_booking_handler' );
add_action( 'wp_ajax_nopriv_julius_service_booking', 'julius_service_booking_handler' );
