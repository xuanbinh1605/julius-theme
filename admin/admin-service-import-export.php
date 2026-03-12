<?php
/**
 * Service Import/Export Tool
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Service Import/Export Menu
 */
function julius_service_import_export_menu() {
    add_submenu_page(
        'edit.php?post_type=service',
        __( 'Import/Export Services', 'julius-theme' ),
        __( 'Import/Export', 'julius-theme' ),
        'manage_options',
        'service-import-export',
        'julius_service_import_export_page'
    );
}
add_action( 'admin_menu', 'julius_service_import_export_menu' );

/**
 * Render Import/Export Page
 */
function julius_service_import_export_page() {
    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'julius-theme' ) );
    }
    
    // Handle export
    if ( isset( $_POST['export_services'] ) && check_admin_referer( 'julius_export_services_nonce' ) ) {
        julius_export_services();
        return;
    }
    
    // Handle import
    if ( isset( $_POST['import_services'] ) && check_admin_referer( 'julius_import_services_nonce' ) ) {
        julius_import_services();
    }
    
    // Get service count
    $service_count = wp_count_posts( 'service' )->publish;
    ?>
    <div class="wrap">
        <h1><?php _e( 'Import/Export Services', 'julius-theme' ); ?></h1>
        
        <!-- Export Section -->
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php _e( 'Export Services', 'julius-theme' ); ?></h2>
            <p><?php printf( __( 'Export all services (%d total). Choose between JSON (with all data) or CSV format (simplified for spreadsheets).', 'julius-theme' ), $service_count ); ?></p>
            
            <form method="post" action="">
                <?php wp_nonce_field( 'julius_export_services_nonce' ); ?>
                
                <p>
                    <label><strong><?php _e( 'Export Format:', 'julius-theme' ); ?></strong></label><br>
                    <label>
                        <input type="radio" name="export_format" value="json" checked>
                        <?php _e( 'JSON (Full data, includes arrays)', 'julius-theme' ); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="export_format" value="csv">
                        <?php _e( 'CSV (Spreadsheet compatible, flattened data)', 'julius-theme' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input type="checkbox" name="export_include_drafts" value="1">
                        <?php _e( 'Include draft services', 'julius-theme' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input type="checkbox" name="export_include_images" value="1" checked>
                        <?php _e( 'Include featured images (as URLs)', 'julius-theme' ); ?>
                    </label>
                </p>
                
                <button type="submit" name="export_services" class="button button-primary">
                    <?php _e( 'Export Services', 'julius-theme' ); ?>
                </button>
            </form>
        </div>
        
        <!-- Import Section -->
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php _e( 'Import Services', 'julius-theme' ); ?></h2>
            <p><?php _e( 'Import services from a JSON file. This will create new services or update existing ones based on the service title.', 'julius-theme' ); ?></p>
            
            <form method="post" action="" enctype="multipart/form-data">
                <?php wp_nonce_field( 'julius_import_services_nonce' ); ?>
                
                <p>
                    <label for="import_file">
                        <strong><?php _e( 'Choose JSON File:', 'julius-theme' ); ?></strong>
                    </label><br>
                    <input type="file" id="import_file" name="import_file" accept=".json" required>
                </p>
                
                <p>
                    <label>
                        <input type="checkbox" name="import_update_existing" value="1">
                        <?php _e( 'Update existing services (match by title)', 'julius-theme' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input type="checkbox" name="import_download_images" value="1" checked>
                        <?php _e( 'Download and attach featured images', 'julius-theme' ); ?>
                    </label>
                </p>
                
                <button type="submit" name="import_services" class="button button-primary">
                    <?php _e( 'Import Services', 'julius-theme' ); ?>
                </button>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Export Services - Router function
 */
function julius_export_services() {
    $format = isset( $_POST['export_format'] ) ? $_POST['export_format'] : 'json';
    
    if ( $format === 'csv' ) {
        julius_export_services_csv();
    } else {
        julius_export_services_json();
    }
}

/**
 * Export Services to JSON
 */
function julius_export_services_json() {
    // Get export options
    $include_drafts = isset( $_POST['export_include_drafts'] );
    $include_images = isset( $_POST['export_include_images'] );
    
    // Query arguments
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'post_status'    => $include_drafts ? array( 'publish', 'draft', 'pending' ) : 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    
    $services = get_posts( $args );
    $export_data = array(
        'version'      => '1.0',
        'export_date'  => current_time( 'mysql' ),
        'site_url'     => get_site_url(),
        'services'     => array(),
    );
    
    foreach ( $services as $service ) {
        $service_data = array(
            'title'           => $service->post_title,
            'content'         => $service->post_content,
            'excerpt'         => $service->post_excerpt,
            'status'          => $service->post_status,
            'slug'            => $service->post_name,
            'categories'      => array(),
            'featured_image'  => '',
            'meta'            => array(),
        );
        
        // Get categories
        $categories = wp_get_post_terms( $service->ID, 'service_category' );
        foreach ( $categories as $category ) {
            $service_data['categories'][] = array(
                'name'        => $category->name,
                'slug'        => $category->slug,
                'description' => $category->description,
            );
        }
        
        // Get featured image
        if ( $include_images && has_post_thumbnail( $service->ID ) ) {
            $service_data['featured_image'] = get_the_post_thumbnail_url( $service->ID, 'full' );
        }
        
        // Get all meta fields
        $service_data['meta'] = array(
            'featured'        => get_post_meta( $service->ID, '_julius_service_featured', true ),
            'duration'        => get_post_meta( $service->ID, '_julius_service_duration', true ),
            'phone'           => get_post_meta( $service->ID, '_julius_service_phone', true ),
            'included'        => get_post_meta( $service->ID, '_julius_service_included', true ),
            'pricing_options' => get_post_meta( $service->ID, '_julius_pricing_options', true ),
            'benefits'        => get_post_meta( $service->ID, '_julius_service_benefits', true ),
            'whats_included'  => get_post_meta( $service->ID, '_julius_service_whats_included', true ),
            'note'            => get_post_meta( $service->ID, '_julius_service_note', true ),
        );
        
        $export_data['services'][] = $service_data;
    }
    
    // Generate filename
    $filename = 'julius-services-export-' . date( 'Y-m-d-H-i-s' ) . '.json';
    
    // Set headers for download
    header( 'Content-Type: application/json' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    header( 'Cache-Control: no-cache, must-revalidate' );
    header( 'Expires: 0' );
    
    // Output JSON
    echo json_encode( $export_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    exit;
}

/**
 * Export Services to CSV
 */
function julius_export_services_csv() {
    // Get export options
    $include_drafts = isset( $_POST['export_include_drafts'] );
    $include_images = isset( $_POST['export_include_images'] );
    
    // Query arguments
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'post_status'    => $include_drafts ? array( 'publish', 'draft', 'pending' ) : 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    
    $services = get_posts( $args );
    
    // Generate filename
    $filename = 'julius-services-export-' . date( 'Y-m-d-H-i-s' ) . '.csv';
    
    // Set headers for download
    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    header( 'Cache-Control: no-cache, must-revalidate' );
    header( 'Expires: 0' );
    
    // Create file pointer to output stream
    $output = fopen( 'php://output', 'w' );
    
    // Add BOM for UTF-8 Excel compatibility
    fprintf( $output, chr(0xEF).chr(0xBB).chr(0xBF) );
    
    // CSV Headers
    $headers = array(
        'ID',
        'Title',
        'Slug',
        'Status',
        'Excerpt',
        'Content',
        'Categories',
        'Featured Image URL',
        'Featured',
        'Duration',
        'Phone',
        'Service Included',
        'Pricing Options',
        'Benefits',
        'What\'s Included',
        'Note',
    );
    
    fputcsv( $output, $headers );
    
    // Export each service
    foreach ( $services as $service ) {
        // Get categories
        $categories = wp_get_post_terms( $service->ID, 'service_category' );
        $category_names = array();
        foreach ( $categories as $category ) {
            $category_names[] = $category->name;
        }
        $categories_string = implode( ', ', $category_names );
        
        // Get featured image
        $featured_image = '';
        if ( $include_images && has_post_thumbnail( $service->ID ) ) {
            $featured_image = get_the_post_thumbnail_url( $service->ID, 'full' );
        }
        
        // Get meta fields
        $featured = get_post_meta( $service->ID, '_julius_service_featured', true );
        $duration = get_post_meta( $service->ID, '_julius_service_duration', true );
        $phone = get_post_meta( $service->ID, '_julius_service_phone', true );
        $included = get_post_meta( $service->ID, '_julius_service_included', true );
        $note = get_post_meta( $service->ID, '_julius_service_note', true );
        
        // Get pricing options (convert to readable string)
        $pricing_options = get_post_meta( $service->ID, '_julius_pricing_options', true );
        $pricing_string = '';
        if ( is_array( $pricing_options ) && ! empty( $pricing_options ) ) {
            $pricing_parts = array();
            foreach ( $pricing_options as $option ) {
                $pricing_parts[] = sprintf(
                    '%s (%s min): %s',
                    $option['name'],
                    $option['time'],
                    $option['price']
                );
            }
            $pricing_string = implode( ' | ', $pricing_parts );
        }
        
        // Get benefits (convert to readable string)
        $benefits = get_post_meta( $service->ID, '_julius_service_benefits', true );
        $benefits_string = '';
        if ( is_array( $benefits ) && ! empty( $benefits ) ) {
            $benefits_string = implode( ' | ', $benefits );
        }
        
        // Get what's included (convert to readable string)
        $whats_included = get_post_meta( $service->ID, '_julius_service_whats_included', true );
        $whats_included_string = '';
        if ( is_array( $whats_included ) && ! empty( $whats_included ) ) {
            $whats_included_string = implode( ' | ', $whats_included );
        }
        
        // Prepare row data
        $row = array(
            $service->ID,
            $service->post_title,
            $service->post_name,
            $service->post_status,
            $service->post_excerpt,
            strip_tags( $service->post_content ),
            $categories_string,
            $featured_image,
            $featured ? 'Yes' : 'No',
            $duration,
            $phone,
            $included,
            $pricing_string,
            $benefits_string,
            $whats_included_string,
            $note,
        );
        
        fputcsv( $output, $row );
    }
    
    fclose( $output );
    exit;
}

/**
 * Import Services from JSON
 */
function julius_import_services() {
    // Check if file was uploaded
    if ( ! isset( $_FILES['import_file'] ) || $_FILES['import_file']['error'] !== UPLOAD_ERR_OK ) {
        add_settings_error(
            'julius_import',
            'file_error',
            __( 'Error uploading file. Please try again.', 'julius-theme' ),
            'error'
        );
        return;
    }
    
    // Get import options
    $update_existing = isset( $_POST['import_update_existing'] );
    $download_images = isset( $_POST['import_download_images'] );
    
    // Read and decode JSON
    $json_content = file_get_contents( $_FILES['import_file']['tmp_name'] );
    $import_data = json_decode( $json_content, true );
    
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        add_settings_error(
            'julius_import',
            'json_error',
            __( 'Invalid JSON file. Please check the file format.', 'julius-theme' ),
            'error'
        );
        return;
    }
    
    if ( ! isset( $import_data['services'] ) || ! is_array( $import_data['services'] ) ) {
        add_settings_error(
            'julius_import',
            'format_error',
            __( 'Invalid file format. Missing services data.', 'julius-theme' ),
            'error'
        );
        return;
    }
    
    // Import services
    $imported = 0;
    $updated = 0;
    $skipped = 0;
    
    foreach ( $import_data['services'] as $service_data ) {
        // Check if service exists
        $existing_post = get_page_by_title( $service_data['title'], OBJECT, 'service' );
        
        if ( $existing_post && ! $update_existing ) {
            $skipped++;
            continue;
        }
        
        // Prepare post data
        $post_data = array(
            'post_title'   => $service_data['title'],
            'post_content' => $service_data['content'],
            'post_excerpt' => $service_data['excerpt'],
            'post_status'  => isset( $service_data['status'] ) ? $service_data['status'] : 'publish',
            'post_type'    => 'service',
        );
        
        if ( isset( $service_data['slug'] ) ) {
            $post_data['post_name'] = $service_data['slug'];
        }
        
        // Insert or update post
        if ( $existing_post ) {
            $post_data['ID'] = $existing_post->ID;
            $post_id = wp_update_post( $post_data );
            if ( $post_id ) {
                $updated++;
            }
        } else {
            $post_id = wp_insert_post( $post_data );
            if ( $post_id ) {
                $imported++;
            }
        }
        
        if ( ! $post_id || is_wp_error( $post_id ) ) {
            continue;
        }
        
        // Import categories
        if ( ! empty( $service_data['categories'] ) ) {
            $term_ids = array();
            foreach ( $service_data['categories'] as $category ) {
                $term = term_exists( $category['slug'], 'service_category' );
                if ( ! $term ) {
                    $term = wp_insert_term(
                        $category['name'],
                        'service_category',
                        array(
                            'slug'        => $category['slug'],
                            'description' => isset( $category['description'] ) ? $category['description'] : '',
                        )
                    );
                }
                if ( ! is_wp_error( $term ) ) {
                    $term_ids[] = $term['term_id'];
                }
            }
            if ( ! empty( $term_ids ) ) {
                wp_set_post_terms( $post_id, $term_ids, 'service_category' );
            }
        }
        
        // Import featured image
        if ( $download_images && ! empty( $service_data['featured_image'] ) ) {
            $image_url = $service_data['featured_image'];
            $attachment_id = julius_import_featured_image( $image_url, $post_id );
            if ( $attachment_id ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
        
        // Import meta fields
        if ( ! empty( $service_data['meta'] ) ) {
            $meta = $service_data['meta'];
            
            if ( isset( $meta['featured'] ) ) {
                update_post_meta( $post_id, '_julius_service_featured', $meta['featured'] );
            }
            
            if ( isset( $meta['duration'] ) ) {
                update_post_meta( $post_id, '_julius_service_duration', $meta['duration'] );
            }
            
            if ( isset( $meta['phone'] ) ) {
                update_post_meta( $post_id, '_julius_service_phone', $meta['phone'] );
            }
            
            if ( isset( $meta['included'] ) ) {
                update_post_meta( $post_id, '_julius_service_included', $meta['included'] );
            }
            
            if ( isset( $meta['pricing_options'] ) && is_array( $meta['pricing_options'] ) ) {
                update_post_meta( $post_id, '_julius_pricing_options', $meta['pricing_options'] );
            }
            
            if ( isset( $meta['benefits'] ) && is_array( $meta['benefits'] ) ) {
                update_post_meta( $post_id, '_julius_service_benefits', $meta['benefits'] );
            }
            
            if ( isset( $meta['whats_included'] ) && is_array( $meta['whats_included'] ) ) {
                update_post_meta( $post_id, '_julius_service_whats_included', $meta['whats_included'] );
            }
            
            if ( isset( $meta['note'] ) ) {
                update_post_meta( $post_id, '_julius_service_note', $meta['note'] );
            }
        }
    }
    
    // Show success message
    $message = sprintf(
        __( 'Import completed! Imported: %d, Updated: %d, Skipped: %d', 'julius-theme' ),
        $imported,
        $updated,
        $skipped
    );
    add_settings_error( 'julius_import', 'import_success', $message, 'success' );
}

/**
 * Import featured image from URL
 */
function julius_import_featured_image( $image_url, $post_id ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    
    // Download image
    $tmp = download_url( $image_url );
    
    if ( is_wp_error( $tmp ) ) {
        return false;
    }
    
    // Get file info
    $file_array = array(
        'name'     => basename( $image_url ),
        'tmp_name' => $tmp,
    );
    
    // Upload to media library
    $attachment_id = media_handle_sideload( $file_array, $post_id );
    
    // Clean up temp file
    @unlink( $tmp );
    
    if ( is_wp_error( $attachment_id ) ) {
        return false;
    }
    
    return $attachment_id;
}

/**
 * Display admin notices
 */
function julius_import_export_admin_notices() {
    settings_errors( 'julius_import' );
}
add_action( 'admin_notices', 'julius_import_export_admin_notices' );
