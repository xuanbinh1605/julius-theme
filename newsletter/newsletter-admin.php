<?php
/**
 * Newsletter Admin Page
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add newsletter admin menu
 */
function julius_newsletter_admin_menu() {
    add_menu_page(
        __( 'Newsletter Subscribers', 'julius-theme' ),
        __( 'Newsletter', 'julius-theme' ),
        'manage_options',
        'julius-newsletter',
        'julius_newsletter_admin_page',
        'dashicons-email-alt',
        30
    );
}
add_action( 'admin_menu', 'julius_newsletter_admin_menu' );

/**
 * Handle admin actions
 */
function julius_newsletter_handle_admin_actions() {
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'julius-newsletter' ) {
        return;
    }
    
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Handle delete action
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['subscriber_id'] ) ) {
        check_admin_referer( 'delete_subscriber_' . $_GET['subscriber_id'] );
        
        julius_newsletter_delete_subscriber( $_GET['subscriber_id'] );
        
        wp_redirect( admin_url( 'admin.php?page=julius-newsletter&deleted=1' ) );
        exit;
    }
    
    // Handle bulk delete
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'bulk_delete' && isset( $_POST['subscribers'] ) ) {
        check_admin_referer( 'julius_newsletter_bulk' );
        
        foreach ( $_POST['subscribers'] as $subscriber_id ) {
            julius_newsletter_delete_subscriber( $subscriber_id );
        }
        
        wp_redirect( admin_url( 'admin.php?page=julius-newsletter&bulk_deleted=1' ) );
        exit;
    }
    
    // Handle export
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'export' ) {
        check_admin_referer( 'julius_newsletter_export' );
        
        $status = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : 'all';
        $subscribers = julius_newsletter_get_all_subscribers( $status );
        
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=newsletter-subscribers-' . date( 'Y-m-d' ) . '.csv' );
        
        $output = fopen( 'php://output', 'w' );
        
        // Add BOM for Excel UTF-8 support
        fprintf( $output, chr(0xEF).chr(0xBB).chr(0xBF) );
        
        // Add headers
        fputcsv( $output, array( 'Email', 'Status', 'Subscribe Date', 'Unsubscribe Date', 'IP Address' ) );
        
        // Add data
        foreach ( $subscribers as $subscriber ) {
            fputcsv( $output, array(
                $subscriber->email,
                $subscriber->status,
                $subscriber->subscribe_date,
                $subscriber->unsubscribe_date,
                $subscriber->ip_address
            ) );
        }
        
        fclose( $output );
        exit;
    }
}
add_action( 'admin_init', 'julius_newsletter_handle_admin_actions' );

/**
 * Render admin page
 */
function julius_newsletter_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'julius-theme' ) );
    }
    
    // Get filter status
    $status_filter = isset( $_GET['status_filter'] ) ? sanitize_text_field( $_GET['status_filter'] ) : 'all';
    
    // Get stats
    $total_subscribers = julius_newsletter_get_subscriber_count( 'all' );
    $active_subscribers = julius_newsletter_get_subscriber_count( 'active' );
    $unsubscribed = julius_newsletter_get_subscriber_count( 'unsubscribed' );
    
    // Get subscribers
    $subscribers = julius_newsletter_get_all_subscribers( $status_filter );
    
    ?>
    <div class="wrap">
        <h1>
            <?php _e( 'Newsletter Subscribers', 'julius-theme' ); ?>
            <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=julius-newsletter&action=export&status=' . $status_filter ), 'julius_newsletter_export' ); ?>" class="page-title-action">
                <?php _e( 'Export to CSV', 'julius-theme' ); ?>
            </a>
        </h1>
        
        <?php if ( isset( $_GET['deleted'] ) ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Subscriber deleted successfully.', 'julius-theme' ); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if ( isset( $_GET['bulk_deleted'] ) ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Subscribers deleted successfully.', 'julius-theme' ); ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin: 20px 0;">
            <div style="background: #fff; padding: 20px; border-left: 4px solid #667eea; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'Total Subscribers', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $total_subscribers ); ?></p>
            </div>
            <div style="background: #fff; padding: 20px; border-left: 4px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'Active', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $active_subscribers ); ?></p>
            </div>
            <div style="background: #fff; padding: 20px; border-left: 4px solid #ef4444; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'Unsubscribed', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $unsubscribed ); ?></p>
            </div>
        </div>
        
        <!-- Filter -->
        <div class="tablenav top">
            <div class="alignleft actions">
                <select name="status_filter" id="status_filter" onchange="window.location.href='<?php echo admin_url( 'admin.php?page=julius-newsletter&status_filter=' ); ?>' + this.value;">
                    <option value="all" <?php selected( $status_filter, 'all' ); ?>><?php _e( 'All Statuses', 'julius-theme' ); ?></option>
                    <option value="active" <?php selected( $status_filter, 'active' ); ?>><?php _e( 'Active', 'julius-theme' ); ?></option>
                    <option value="unsubscribed" <?php selected( $status_filter, 'unsubscribed' ); ?>><?php _e( 'Unsubscribed', 'julius-theme' ); ?></option>
                </select>
            </div>
        </div>
        
        <!-- Subscribers Table -->
        <form method="post" action="">
            <?php wp_nonce_field( 'julius_newsletter_bulk' ); ?>
            <input type="hidden" name="action" value="bulk_delete">
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <td class="manage-column column-cb check-column">
                            <input type="checkbox" id="cb-select-all">
                        </td>
                        <th scope="col" class="manage-column"><?php _e( 'Email', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column"><?php _e( 'Status', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column"><?php _e( 'Subscribe Date', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column"><?php _e( 'IP Address', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column"><?php _e( 'Actions', 'julius-theme' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( empty( $subscribers ) ) : ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px;">
                                <?php _e( 'No subscribers found.', 'julius-theme' ); ?>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $subscribers as $subscriber ) : ?>
                            <tr>
                                <th scope="row" class="check-column">
                                    <input type="checkbox" name="subscribers[]" value="<?php echo esc_attr( $subscriber->id ); ?>">
                                </th>
                                <td><strong><?php echo esc_html( $subscriber->email ); ?></strong></td>
                                <td>
                                    <?php if ( $subscriber->status === 'active' ) : ?>
                                        <span style="display: inline-block; padding: 4px 12px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                            <?php _e( 'Active', 'julius-theme' ); ?>
                                        </span>
                                    <?php else : ?>
                                        <span style="display: inline-block; padding: 4px 12px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                            <?php _e( 'Unsubscribed', 'julius-theme' ); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo esc_html( date( 'F j, Y g:i a', strtotime( $subscriber->subscribe_date ) ) ); ?></td>
                                <td><?php echo esc_html( $subscriber->ip_address ?: '-' ); ?></td>
                                <td>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=julius-newsletter&action=delete&subscriber_id=' . $subscriber->id ), 'delete_subscriber_' . $subscriber->id ); ?>" 
                                       class="button button-small" 
                                       onclick="return confirm('<?php _e( 'Are you sure you want to delete this subscriber?', 'julius-theme' ); ?>');">
                                        <?php _e( 'Delete', 'julius-theme' ); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <?php if ( ! empty( $subscribers ) ) : ?>
                <div class="tablenav bottom">
                    <div class="alignleft actions">
                        <button type="submit" class="button button-secondary" onclick="return confirm('<?php _e( 'Are you sure you want to delete selected subscribers?', 'julius-theme' ); ?>');">
                            <?php _e( 'Delete Selected', 'julius-theme' ); ?>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
    
    <script>
        // Select all checkbox functionality
        document.getElementById('cb-select-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="subscribers[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
    
    <style>
        .wrap h1 {
            margin-bottom: 0;
        }
        .tablenav {
            margin: 20px 0;
        }
    </style>
    <?php
}
