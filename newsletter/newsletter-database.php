<?php
/**
 * Newsletter Database Functions
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Create newsletter subscribers table
 */
function julius_create_newsletter_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        status varchar(20) NOT NULL DEFAULT 'active',
        subscribe_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        unsubscribe_date datetime DEFAULT NULL,
        unsubscribe_token varchar(64) NOT NULL,
        ip_address varchar(45) DEFAULT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email),
        KEY status (status)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

/**
 * Check if subscriber exists
 */
function julius_newsletter_subscriber_exists( $email ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    $count = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE email = %s",
        sanitize_email( $email )
    ) );
    
    return $count > 0;
}

/**
 * Get subscriber by email
 */
function julius_newsletter_get_subscriber( $email ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    return $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM $table_name WHERE email = %s",
        sanitize_email( $email )
    ) );
}

/**
 * Get subscriber by token
 */
function julius_newsletter_get_subscriber_by_token( $token ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    return $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM $table_name WHERE unsubscribe_token = %s",
        sanitize_text_field( $token )
    ) );
}

/**
 * Add new subscriber
 */
function julius_newsletter_add_subscriber( $email, $ip_address = '' ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    // Generate unique token
    $token = bin2hex( random_bytes( 32 ) );
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => sanitize_email( $email ),
            'status' => 'active',
            'unsubscribe_token' => $token,
            'ip_address' => sanitize_text_field( $ip_address ),
        ),
        array( '%s', '%s', '%s', '%s' )
    );
    
    return $result ? $token : false;
}

/**
 * Update subscriber status
 */
function julius_newsletter_update_subscriber_status( $email, $status ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    $data = array( 'status' => $status );
    $format = array( '%s' );
    
    if ( $status === 'unsubscribed' ) {
        $data['unsubscribe_date'] = current_time( 'mysql' );
        $format[] = '%s';
    }
    
    return $wpdb->update(
        $table_name,
        $data,
        array( 'email' => sanitize_email( $email ) ),
        $format,
        array( '%s' )
    );
}

/**
 * Unsubscribe by token
 */
function julius_newsletter_unsubscribe_by_token( $token ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    return $wpdb->update(
        $table_name,
        array(
            'status' => 'unsubscribed',
            'unsubscribe_date' => current_time( 'mysql' )
        ),
        array( 'unsubscribe_token' => sanitize_text_field( $token ) ),
        array( '%s', '%s' ),
        array( '%s' )
    );
}

/**
 * Get all subscribers
 */
function julius_newsletter_get_all_subscribers( $status = 'all' ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    if ( $status === 'all' ) {
        return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY subscribe_date DESC" );
    } else {
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT * FROM $table_name WHERE status = %s ORDER BY subscribe_date DESC",
            $status
        ) );
    }
}

/**
 * Delete subscriber
 */
function julius_newsletter_delete_subscriber( $id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    return $wpdb->delete(
        $table_name,
        array( 'id' => absint( $id ) ),
        array( '%d' )
    );
}

/**
 * Get subscriber count
 */
function julius_newsletter_get_subscriber_count( $status = 'active' ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'julius_newsletter_subscribers';
    
    if ( $status === 'all' ) {
        return $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );
    } else {
        return $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE status = %s",
            $status
        ) );
    }
}
