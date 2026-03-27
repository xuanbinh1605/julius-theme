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
    $appointment_date = isset( $_POST['appointment_date'] ) ? sanitize_text_field( $_POST['appointment_date'] ) : '';
    $appointment_time = isset( $_POST['appointment_time'] ) ? sanitize_text_field( $_POST['appointment_time'] ) : '';
    
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
        'appointment_date' => $appointment_date,
        'appointment_time' => $appointment_time,
        'ip_address' => $ip_address
    );
    
    // Check for slot conflict before inserting
    if ( ! empty( $appointment_date ) && ! empty( $appointment_time ) && $service_id ) {
        $taken = julius_booking_get_taken_slots( $service_id, $branch, $appointment_date );
        if ( in_array( $appointment_time, (array) $taken, true ) ) {
            wp_send_json_error( array(
                'message' => __( 'Sorry, that time slot has just been booked. Please choose a different time.', 'julius-theme' )
            ) );
        }
    }

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
        global $wpdb;
        error_log( '=== JULIUS SERVICE BOOKING HANDLER: INSERT FAILED ===' );
        error_log( 'DB Error: ' . $wpdb->last_error );
        wp_send_json_error( array(
            'message' => __( 'Something went wrong. Please try again later.', 'julius-theme' ),
            'debug'   => $wpdb->last_error
        ) );
    }
}

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
    $appointment_date = isset( $_POST['appointment_date'] ) ? sanitize_text_field( $_POST['appointment_date'] ) : '';
    $appointment_time = isset( $_POST['appointment_time'] ) ? sanitize_text_field( $_POST['appointment_time'] ) : '';
    
    // Prepare booking data
    $booking_data = array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'service_id' => null,
        'service_name' => $service,
        'branch' => $branch,
        'message' => $message,
        'appointment_date' => $appointment_date,
        'appointment_time' => $appointment_time,
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

/**
 * AJAX: Return taken time slots for a specific service + branch + date combination
 */
function julius_booking_check_slots_ajax() {
    check_ajax_referer( 'julius_check_slots', 'nonce' );

    $service_id = isset( $_POST['service_id'] ) ? absint( $_POST['service_id'] ) : 0;
    $branch     = isset( $_POST['branch'] )     ? sanitize_text_field( $_POST['branch'] ) : '';
    $date       = isset( $_POST['date'] )       ? sanitize_text_field( $_POST['date'] )   : '';

    if ( ! $service_id || ! $branch || ! $date ) {
        wp_send_json_success( array( 'taken' => array() ) );
        return;
    }

    $taken = julius_booking_get_taken_slots( $service_id, $branch, $date );
    wp_send_json_success( array( 'taken' => array_values( $taken ) ) );
}

/**
 * Handle contact page form submission (admin-post action)
 */
function julius_contact_form_handler() {
    error_log( '=== JULIUS CONTACT FORM HANDLER CALLED ===' );
    error_log( 'POST Data: ' . print_r( $_POST, true ) );
    
    // Set header for JSON response
    header( 'Content-Type: application/json' );
    
    // Start output buffering to catch any unexpected output
    if ( ob_get_level() == 0 ) {
        ob_start();
    }
    
    // Verify nonce
    if ( ! isset( $_POST['julius_contact_nonce'] ) || ! wp_verify_nonce( $_POST['julius_contact_nonce'], 'julius_contact_form' ) ) {
        error_log( 'JULIUS CONTACT: Nonce verification failed' );
        ob_end_clean();
        echo json_encode( array(
            'success' => false,
            'message' => 'Security verification failed. Please refresh the page and try again.',
            'debug' => 'Nonce verification failed'
        ) );
        exit;
    }
    
    error_log( 'JULIUS CONTACT: Nonce verified successfully' );
    
    // Validate required fields
    $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $service_id = isset( $_POST['service'] ) ? absint( $_POST['service'] ) : 0;
    $branch = isset( $_POST['branch'] ) ? sanitize_text_field( $_POST['branch'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';
    
    error_log( 'JULIUS CONTACT: Parsed fields - Name: ' . $name . ', Email: ' . $email . ', Phone: ' . $phone . ', Branch: ' . $branch . ', Service ID: ' . $service_id );
    
    if ( empty( $name ) || empty( $phone ) || empty( $email ) || empty( $service_id ) || empty( $branch ) ) {
        error_log( 'JULIUS CONTACT: Validation failed - missing required fields' );
        $missing = array();
        if ( empty( $name ) ) $missing[] = 'name';
        if ( empty( $phone ) ) $missing[] = 'phone';
        if ( empty( $email ) ) $missing[] = 'email';
        if ( empty( $service_id ) ) $missing[] = 'service';
        if ( empty( $branch ) ) $missing[] = 'branch';
        
        ob_end_clean();
        echo json_encode( array(
            'success' => false,
            'message' => 'Please fill in all required fields.',
            'debug' => 'Missing fields: ' . implode( ', ', $missing )
        ) );
        exit;
    }
    
    // Get service name
    $service_name = '';
    if ( $service_id ) {
        $service_post = get_post( $service_id );
        if ( $service_post ) {
            $service_name = $service_post->post_title;
            error_log( 'JULIUS CONTACT: Service found - ' . $service_name );
        } else {
            error_log( 'JULIUS CONTACT: Service ID ' . $service_id . ' not found' );
        }
    }
    
    // Get IP address
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    $appointment_date = isset( $_POST['appointment_date'] ) ? sanitize_text_field( $_POST['appointment_date'] ) : '';
    $appointment_time = isset( $_POST['appointment_time'] ) ? sanitize_text_field( $_POST['appointment_time'] ) : '';
    
    // Prepare booking data
    $booking_data = array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'service_id' => $service_id,
        'service_name' => $service_name,
        'branch' => $branch,
        'message' => $message,
        'appointment_date' => $appointment_date,
        'appointment_time' => $appointment_time,
        'ip_address' => $ip_address
    );
    
    error_log( 'JULIUS CONTACT: Prepared booking data: ' . print_r( $booking_data, true ) );

    // Check for slot conflict before inserting
    if ( ! empty( $appointment_date ) && ! empty( $appointment_time ) && $service_id ) {
        $taken = julius_booking_get_taken_slots( $service_id, $branch, $appointment_date );
        if ( in_array( $appointment_time, (array) $taken, true ) ) {
            ob_end_clean();
            echo json_encode( array(
                'success' => false,
                'message' => 'Sorry, that time slot has just been booked. Please choose a different time.',
            ) );
            exit;
        }
    }

    // Add booking to database
    $booking_id = julius_booking_add( $booking_data );
    
    error_log( 'JULIUS CONTACT: Database insert result - Booking ID: ' . ( $booking_id ? $booking_id : 'FAILED' ) );
    
    if ( $booking_id ) {
        error_log( 'JULIUS CONTACT: Booking saved successfully with ID: ' . $booking_id );
        
        // Send emails
        $email_results = array();
        
        try {
            // Send confirmation email to user
            if ( ! empty( $email ) && is_email( $email ) ) {
                error_log( 'JULIUS CONTACT: Attempting to send confirmation email to: ' . $email );
                $confirmation_sent = julius_booking_send_confirmation( $booking_id );
                $email_results['confirmation'] = $confirmation_sent ? 'sent' : 'failed';
                error_log( 'JULIUS CONTACT: Confirmation email ' . ( $confirmation_sent ? 'sent successfully' : 'FAILED' ) );
            } else {
                $email_results['confirmation'] = 'skipped - invalid email';
                error_log( 'JULIUS CONTACT: Skipping confirmation email - invalid or empty email' );
            }
            
            // Send notification to admin
            error_log( 'JULIUS CONTACT: Attempting to send admin notification' );
            $admin_sent = julius_booking_send_admin_notification( $booking_id );
            $email_results['admin'] = $admin_sent ? 'sent' : 'failed';
            error_log( 'JULIUS CONTACT: Admin notification ' . ( $admin_sent ? 'sent successfully' : 'FAILED' ) );
        } catch ( Exception $e ) {
            error_log( 'JULIUS CONTACT: Email Error: ' . $e->getMessage() );
            $email_results['error'] = $e->getMessage();
        }
        
        // Clean any output
        ob_end_clean();
        
        error_log( 'JULIUS CONTACT: Sending success response' );
        
        echo json_encode( array(
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully. We will contact you soon.',
            'debug' => array(
                'booking_id' => $booking_id,
                'emails' => $email_results
            )
        ) );
    } else {
        global $wpdb;
        error_log( 'JULIUS CONTACT: Database insert failed - sending error response' );
        error_log( 'JULIUS CONTACT DB Error: ' . $wpdb->last_error );
        
        ob_end_clean();
        
        echo json_encode( array(
            'success' => false,
            'message' => 'Something went wrong. Please try again later.',
            'debug' => $wpdb->last_error
        ) );
    }
    
    exit;
}
