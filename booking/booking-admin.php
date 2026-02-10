<?php
/**
 * Booking Admin Page
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add booking admin menu
 */
function julius_booking_admin_menu() {
    add_menu_page(
        __( 'Service Bookings', 'julius-theme' ),
        __( 'Bookings', 'julius-theme' ),
        'manage_options',
        'julius-bookings',
        'julius_booking_admin_page',
        'dashicons-calendar-alt',
        25
    );
}
add_action( 'admin_menu', 'julius_booking_admin_menu' );

/**
 * Handle admin actions
 */
function julius_booking_handle_admin_actions() {
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'julius-bookings' ) {
        return;
    }
    
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Handle delete action
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['booking_id'] ) ) {
        check_admin_referer( 'delete_booking_' . $_GET['booking_id'] );
        
        julius_booking_delete( $_GET['booking_id'] );
        
        wp_redirect( admin_url( 'admin.php?page=julius-bookings&deleted=1' ) );
        exit;
    }
    
    // Handle bulk delete
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'bulk_delete' && isset( $_POST['bookings'] ) ) {
        check_admin_referer( 'julius_booking_bulk' );
        
        foreach ( $_POST['bookings'] as $booking_id ) {
            julius_booking_delete( $booking_id );
        }
        
        wp_redirect( admin_url( 'admin.php?page=julius-bookings&bulk_deleted=1' ) );
        exit;
    }
    
    // Handle export
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'export' ) {
        check_admin_referer( 'julius_booking_export' );
        
        $filters = array();
        
        if ( ! empty( $_GET['service_filter'] ) ) {
            $filters['service_id'] = absint( $_GET['service_filter'] );
        }
        
        if ( ! empty( $_GET['branch_filter'] ) ) {
            $filters['branch'] = sanitize_text_field( $_GET['branch_filter'] );
        }
        
        if ( ! empty( $_GET['date_from'] ) ) {
            $filters['date_from'] = sanitize_text_field( $_GET['date_from'] );
        }
        
        if ( ! empty( $_GET['date_to'] ) ) {
            $filters['date_to'] = sanitize_text_field( $_GET['date_to'] );
        }
        
        $bookings = julius_booking_get_all( $filters );
        
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=bookings-' . date( 'Y-m-d' ) . '.csv' );
        
        $output = fopen( 'php://output', 'w' );
        
        // Add BOM for Excel UTF-8 support
        fprintf( $output, chr(0xEF).chr(0xBB).chr(0xBF) );
        
        // Add headers
        fputcsv( $output, array( 'ID', 'Name', 'Phone', 'Email', 'Service', 'Branch', 'Message', 'Booking Date', 'IP Address' ) );
        
        // Add data
        foreach ( $bookings as $booking ) {
            fputcsv( $output, array(
                $booking->id,
                $booking->name,
                $booking->phone,
                $booking->email,
                $booking->service_name,
                $booking->branch,
                $booking->message,
                $booking->booking_date,
                $booking->ip_address
            ) );
        }
        
        fclose( $output );
        exit;
    }
}
add_action( 'admin_init', 'julius_booking_handle_admin_actions' );

/**
 * Render admin page
 */
function julius_booking_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'julius-theme' ) );
    }
    
    // Get filters
    $service_filter = isset( $_GET['service_filter'] ) ? absint( $_GET['service_filter'] ) : 0;
    $branch_filter = isset( $_GET['branch_filter'] ) ? sanitize_text_field( $_GET['branch_filter'] ) : '';
    $date_from = isset( $_GET['date_from'] ) ? sanitize_text_field( $_GET['date_from'] ) : '';
    $date_to = isset( $_GET['date_to'] ) ? sanitize_text_field( $_GET['date_to'] ) : '';
    $search = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';
    
    // Prepare filters array
    $filters = array();
    if ( $service_filter ) $filters['service_id'] = $service_filter;
    if ( $branch_filter ) $filters['branch'] = $branch_filter;
    if ( $date_from ) $filters['date_from'] = $date_from;
    if ( $date_to ) $filters['date_to'] = $date_to;
    if ( $search ) $filters['search'] = $search;
    
    // Get stats and bookings
    $stats = julius_booking_get_stats();
    $bookings = julius_booking_get_all( $filters );
    
    // Get all services for filter
    $services = get_posts( array(
        'post_type' => 'service',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ) );
    
    // Get unique branches
    $branches = julius_booking_get_branches();
    
    ?>
    <div class="wrap">
        <h1>
            <?php _e( 'Service Bookings', 'julius-theme' ); ?>
            <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=julius-bookings&action=export&service_filter=' . $service_filter . '&branch_filter=' . $branch_filter . '&date_from=' . $date_from . '&date_to=' . $date_to ), 'julius_booking_export' ); ?>" class="page-title-action">
                <?php _e( 'Export to CSV', 'julius-theme' ); ?>
            </a>
        </h1>
        
        <?php if ( isset( $_GET['deleted'] ) ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Booking deleted successfully.', 'julius-theme' ); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if ( isset( $_GET['bulk_deleted'] ) ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Bookings deleted successfully.', 'julius-theme' ); ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin: 20px 0;">
            <div style="background: #fff; padding: 20px; border-left: 4px solid #667eea; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'Total Bookings', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $stats['total'] ); ?></p>
            </div>
            <div style="background: #fff; padding: 20px; border-left: 4px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'Today', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $stats['today'] ); ?></p>
            </div>
            <div style="background: #fff; padding: 20px; border-left: 4px solid #f59e0b; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'This Week', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $stats['this_week'] ); ?></p>
            </div>
            <div style="background: #fff; padding: 20px; border-left: 4px solid #8b5cf6; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 4px;">
                <h3 style="margin: 0 0 10px; color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?php _e( 'This Month', 'julius-theme' ); ?></h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #333;"><?php echo number_format( $stats['this_month'] ); ?></p>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="tablenav top">
            <form method="get" action="" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                <input type="hidden" name="page" value="julius-bookings">
                
                <input type="text" name="search" value="<?php echo esc_attr( $search ); ?>" placeholder="<?php _e( 'Search by name, phone, email...', 'julius-theme' ); ?>" style="width: 250px;">
                
                <select name="service_filter" style="width: 180px;">
                    <option value=""><?php _e( 'All Services', 'julius-theme' ); ?></option>
                    <?php foreach ( $services as $service ) : ?>
                        <option value="<?php echo $service->ID; ?>" <?php selected( $service_filter, $service->ID ); ?>>
                            <?php echo esc_html( $service->post_title ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <select name="branch_filter" style="width: 150px;">
                    <option value=""><?php _e( 'All Branches', 'julius-theme' ); ?></option>
                    <?php foreach ( $branches as $branch ) : ?>
                        <option value="<?php echo esc_attr( $branch ); ?>" <?php selected( $branch_filter, $branch ); ?>>
                            <?php echo esc_html( $branch === 'julius-1' ? 'Julius 1' : 'Julius 2' ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <input type="date" name="date_from" value="<?php echo esc_attr( $date_from ); ?>" placeholder="<?php _e( 'From', 'julius-theme' ); ?>">
                <input type="date" name="date_to" value="<?php echo esc_attr( $date_to ); ?>" placeholder="<?php _e( 'To', 'julius-theme' ); ?>">
                
                <button type="submit" class="button"><?php _e( 'Filter', 'julius-theme' ); ?></button>
                <a href="<?php echo admin_url( 'admin.php?page=julius-bookings' ); ?>" class="button"><?php _e( 'Reset', 'julius-theme' ); ?></a>
            </form>
        </div>
        
        <!-- Bookings Table -->
        <form method="post" action="">
            <?php wp_nonce_field( 'julius_booking_bulk' ); ?>
            <input type="hidden" name="action" value="bulk_delete">
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <td class="manage-column column-cb check-column">
                            <input type="checkbox" id="cb-select-all">
                        </td>
                        <th scope="col" class="manage-column" style="width: 15%;"><?php _e( 'Customer', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 20%;"><?php _e( 'Service', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 10%;"><?php _e( 'Branch', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 12%;"><?php _e( 'Contact', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 25%;"><?php _e( 'Message', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 13%;"><?php _e( 'Date', 'julius-theme' ); ?></th>
                        <th scope="col" class="manage-column" style="width: 5%;"><?php _e( 'Actions', 'julius-theme' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( empty( $bookings ) ) : ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px;">
                                <?php _e( 'No bookings found.', 'julius-theme' ); ?>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $bookings as $booking ) : ?>
                            <tr>
                                <th scope="row" class="check-column">
                                    <input type="checkbox" name="bookings[]" value="<?php echo esc_attr( $booking->id ); ?>">
                                </th>
                                <td>
                                    <strong><?php echo esc_html( $booking->name ); ?></strong>
                                </td>
                                <td><?php echo esc_html( $booking->service_name ); ?></td>
                                <td><?php echo esc_html( $booking->branch === 'julius-1' ? 'Julius 1' : 'Julius 2' ); ?></td>
                                <td>
                                    <a href="tel:<?php echo esc_attr( $booking->phone ); ?>"><?php echo esc_html( $booking->phone ); ?></a>
                                    <?php if ( $booking->email ) : ?>
                                        <br><a href="mailto:<?php echo esc_attr( $booking->email ); ?>"><?php echo esc_html( $booking->email ); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ( $booking->message ) : ?>
                                        <div style="max-height: 60px; overflow-y: auto; font-size: 13px;">
                                            <?php echo esc_html( $booking->message ); ?>
                                        </div>
                                    <?php else : ?>
                                        <em style="color: #999;">-</em>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date( 'M j, Y g:i A', strtotime( $booking->booking_date ) ); ?></td>
                                <td>
                                    <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=julius-bookings&action=delete&booking_id=' . $booking->id ), 'delete_booking_' . $booking->id ); ?>" 
                                       class="button button-small" 
                                       onclick="return confirm('<?php _e( 'Are you sure you want to delete this booking?', 'julius-theme' ); ?>');">
                                        <?php _e( 'Delete', 'julius-theme' ); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <?php if ( ! empty( $bookings ) ) : ?>
                <div class="tablenav bottom">
                    <div class="alignleft actions">
                        <button type="submit" class="button button-secondary" onclick="return confirm('<?php _e( 'Are you sure you want to delete selected bookings?', 'julius-theme' ); ?>');">
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
            var checkboxes = document.querySelectorAll('input[name="bookings[]"]');
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
        .tablenav form {
            padding: 15px;
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
    </style>
    <?php
}
