<?php
/**
 * Booking Database Functions
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Create bookings table
 */
function julius_create_booking_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'julius_bookings';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        phone varchar(20) NOT NULL,
        email varchar(100) DEFAULT NULL,
        service_id bigint(20) DEFAULT NULL,
        service_name varchar(255) NOT NULL,
        branch varchar(50) NOT NULL,
        message text DEFAULT NULL,
        booking_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45) DEFAULT NULL,
        PRIMARY KEY  (id),
        KEY service_id (service_id),
        KEY branch (branch),
        KEY booking_date (booking_date)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

/**
 * Add new booking
 */
function julius_booking_add( $data ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'name' => sanitize_text_field( $data['name'] ),
            'phone' => sanitize_text_field( $data['phone'] ),
            'email' => isset( $data['email'] ) ? sanitize_email( $data['email'] ) : null,
            'service_id' => isset( $data['service_id'] ) ? absint( $data['service_id'] ) : null,
            'service_name' => sanitize_text_field( $data['service_name'] ),
            'branch' => sanitize_text_field( $data['branch'] ),
            'message' => isset( $data['message'] ) ? sanitize_textarea_field( $data['message'] ) : null,
            'ip_address' => isset( $data['ip_address'] ) ? sanitize_text_field( $data['ip_address'] ) : null,
        ),
        array( '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s' )
    );
    
    return $result ? $wpdb->insert_id : false;
}

/**
 * Get all bookings
 */
function julius_booking_get_all( $filters = array() ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    $where = array( '1=1' );
    
    // Filter by service
    if ( ! empty( $filters['service_id'] ) ) {
        $where[] = $wpdb->prepare( 'service_id = %d', absint( $filters['service_id'] ) );
    }
    
    // Filter by branch
    if ( ! empty( $filters['branch'] ) ) {
        $where[] = $wpdb->prepare( 'branch = %s', sanitize_text_field( $filters['branch'] ) );
    }
    
    // Filter by date range
    if ( ! empty( $filters['date_from'] ) ) {
        $where[] = $wpdb->prepare( 'booking_date >= %s', sanitize_text_field( $filters['date_from'] ) . ' 00:00:00' );
    }
    
    if ( ! empty( $filters['date_to'] ) ) {
        $where[] = $wpdb->prepare( 'booking_date <= %s', sanitize_text_field( $filters['date_to'] ) . ' 23:59:59' );
    }
    
    // Search by name, phone, or email
    if ( ! empty( $filters['search'] ) ) {
        $search = '%' . $wpdb->esc_like( $filters['search'] ) . '%';
        $where[] = $wpdb->prepare( '(name LIKE %s OR phone LIKE %s OR email LIKE %s)', $search, $search, $search );
    }
    
    $where_clause = implode( ' AND ', $where );
    
    $sql = "SELECT * FROM $table_name WHERE $where_clause ORDER BY booking_date DESC";
    
    return $wpdb->get_results( $sql );
}

/**
 * Get booking by ID
 */
function julius_booking_get_by_id( $id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    return $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM $table_name WHERE id = %d",
        absint( $id )
    ) );
}

/**
 * Delete booking
 */
function julius_booking_delete( $id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    return $wpdb->delete(
        $table_name,
        array( 'id' => absint( $id ) ),
        array( '%d' )
    );
}

/**
 * Get booking count
 */
function julius_booking_get_count( $filters = array() ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    $where = array( '1=1' );
    
    if ( ! empty( $filters['service_id'] ) ) {
        $where[] = $wpdb->prepare( 'service_id = %d', absint( $filters['service_id'] ) );
    }
    
    if ( ! empty( $filters['branch'] ) ) {
        $where[] = $wpdb->prepare( 'branch = %s', sanitize_text_field( $filters['branch'] ) );
    }
    
    if ( ! empty( $filters['date_from'] ) ) {
        $where[] = $wpdb->prepare( 'booking_date >= %s', sanitize_text_field( $filters['date_from'] ) . ' 00:00:00' );
    }
    
    if ( ! empty( $filters['date_to'] ) ) {
        $where[] = $wpdb->prepare( 'booking_date <= %s', sanitize_text_field( $filters['date_to'] ) . ' 23:59:59' );
    }
    
    $where_clause = implode( ' AND ', $where );
    
    return $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE $where_clause" );
}

/**
 * Get bookings by date range
 */
function julius_booking_get_by_date_range( $date_from, $date_to ) {
    return julius_booking_get_all( array(
        'date_from' => $date_from,
        'date_to' => $date_to
    ) );
}

/**
 * Get unique branches
 */
function julius_booking_get_branches() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    return $wpdb->get_col( "SELECT DISTINCT branch FROM $table_name ORDER BY branch" );
}

/**
 * Get booking statistics
 */
function julius_booking_get_stats() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_bookings';
    
    $total = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );
    
    $today = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE DATE(booking_date) = CURDATE()" );
    
    $this_week = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE YEARWEEK(booking_date) = YEARWEEK(NOW())" );
    
    $this_month = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE YEAR(booking_date) = YEAR(NOW()) AND MONTH(booking_date) = MONTH(NOW())" );
    
    return array(
        'total' => $total,
        'today' => $today,
        'this_week' => $this_week,
        'this_month' => $this_month
    );
}
