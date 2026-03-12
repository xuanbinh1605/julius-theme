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
    add_management_page(
        __( 'Import/Export Services', 'julius-theme' ),
        __( 'Import/Export Services', 'julius-theme' ),
        'manage_options',
        'service-import-export',
        'julius_service_import_export_page'
    );
}
add_action( 'admin_menu', 'julius_service_import_export_menu' );

/**
 * Handle Export Before Headers
 */
function julius_handle_export_before_headers() {
    // Check if we're on the export page and export button was clicked
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'service-import-export' ) {
        return;
    }
    
    if ( ! isset( $_POST['export_services'] ) ) {
        return;
    }
    
    if ( ! check_admin_referer( 'julius_export_services_nonce' ) ) {
        return;
    }
    
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // Handle export immediately before any output
    julius_export_services();
    exit;
}
add_action( 'admin_init', 'julius_handle_export_before_headers' );

/**
 * Handle Import Before Headers (process early, store results, redirect)
 */
function julius_handle_import_before_headers() {
    // Check if we're on the right page
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'service-import-export' ) {
        return;
    }
    
    // Check if import button was clicked
    if ( ! isset( $_POST['import_services'] ) ) {
        return;
    }
    
    // Verify nonce
    if ( ! check_admin_referer( 'julius_import_services_nonce' ) ) {
        return;
    }
    
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    error_log( 'Julius Import: admin_init handler triggered' );
    
    // Run import and get results
    $result = julius_import_services();
    
    // Store results in transient (expires in 60 seconds)
    set_transient( 'julius_import_result_' . get_current_user_id(), $result, 60 );
    
    // Redirect back to prevent form resubmission
    wp_safe_redirect( admin_url( 'tools.php?page=service-import-export&imported=1' ) );
    exit;
}
add_action( 'admin_init', 'julius_handle_import_before_headers' );

/**
 * Render Import/Export Page
 */
function julius_service_import_export_page() {
    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'julius-theme' ) );
    }
    
    // Check for import results from transient
    $import_result = get_transient( 'julius_import_result_' . get_current_user_id() );
    if ( $import_result ) {
        delete_transient( 'julius_import_result_' . get_current_user_id() );
    }
    
    // Get service count
    $service_count = wp_count_posts( 'service' )->publish;
    ?>
    <div class="wrap">
        <h1><?php _e( 'Import/Export Services', 'julius-theme' ); ?></h1>
        
        <?php
        // Display import results
        if ( $import_result ) {
            $type = $import_result['success'] ? 'success' : 'error';
            echo '<div class="notice notice-' . $type . ' inline" style="margin: 15px 0; padding: 15px;">';
            echo '<p><strong>' . esc_html( $import_result['message'] ) . '</strong></p>';
            
            if ( ! empty( $import_result['log'] ) ) {
                echo '<ul style="margin: 10px 0; padding-left: 20px;">';
                foreach ( $import_result['log'] as $log_entry ) {
                    echo '<li>' . wp_kses_post( $log_entry ) . '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
        }
        ?>
        
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
            <p><?php _e( 'Import services from a JSON or CSV file. This will create new services or update existing ones based on the service title.', 'julius-theme' ); ?></p>
            
            <?php
            // Show server upload limits
            $upload_max = ini_get( 'upload_max_filesize' );
            $post_max = ini_get( 'post_max_size' );
            ?>
            <div class="notice notice-info inline" style="margin: 10px 0; padding: 10px;">
                <p><strong>Server Upload Limits:</strong> Max file size: <?php echo $upload_max; ?> | Max post size: <?php echo $post_max; ?></p>
            </div>
            
            <form method="post" action="" enctype="multipart/form-data" id="import-form">
                <?php wp_nonce_field( 'julius_import_services_nonce' ); ?>
                <input type="hidden" name="import_services" value="1">
                
                <p>
                    <label for="import_file">
                        <strong><?php _e( 'Choose File:', 'julius-theme' ); ?></strong>
                    </label><br>
                    <input type="file" id="import_file" name="import_file" accept=".json,.csv" required>
                    <br><span class="description"><?php _e( 'Accepts JSON (full data) or CSV (spreadsheet) files', 'julius-theme' ); ?></span>
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
                
                <p id="import-status" style="display: none; color: #0073aa; font-weight: bold;">
                    <span class="spinner is-active" style="float: none; margin: 0 5px 0 0;"></span>
                    Importing services... Please wait.
                </p>
                
                <button type="submit" id="import-button" class="button button-primary">
                    <?php _e( 'Import Services', 'julius-theme' ); ?>
                </button>
            </form>
            
            <script>
            jQuery(document).ready(function($) {
                $('#import-form').on('submit', function(e) {
                    var fileInput = $('#import_file')[0];
                    if (!fileInput.files || !fileInput.files[0]) {
                        alert('Please select a file to import.');
                        e.preventDefault();
                        return false;
                    }
                    
                    console.log('Form submitting with file:', fileInput.files[0].name);
                    console.log('File size:', fileInput.files[0].size, 'bytes');
                    
                    $('#import-status').show();
                    $('#import-button').val('Importing...').css('opacity', '0.6');
                });
            });
            </script>
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
    // Clean output buffer
    if ( ob_get_level() ) {
        ob_end_clean();
    }
    
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
    // Clean output buffer
    if ( ob_get_level() ) {
        ob_end_clean();
    }
    
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
 * Import Services - Router function
 */
function julius_import_services() {
    error_log( 'Julius Import: Starting import process' );
    
    // Check if file was uploaded
    if ( ! isset( $_FILES['import_file'] ) ) {
        error_log( 'Julius Import: No file in $_FILES' );
        return array(
            'success' => false,
            'message' => 'No file was uploaded. Please select a file.',
            'log'     => array(),
        );
    }
    
    if ( $_FILES['import_file']['error'] !== UPLOAD_ERR_OK ) {
        $error_messages = array(
            UPLOAD_ERR_INI_SIZE   => 'File is too large (exceeds server limit)',
            UPLOAD_ERR_FORM_SIZE  => 'File is too large',
            UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION  => 'File upload stopped by extension',
        );
        
        $error_code = $_FILES['import_file']['error'];
        $error_message = isset( $error_messages[ $error_code ] ) ? $error_messages[ $error_code ] : 'Unknown upload error';
        
        error_log( 'Julius Import: Upload error - ' . $error_message );
        return array(
            'success' => false,
            'message' => 'Error uploading file: ' . $error_message,
            'log'     => array(),
        );
    }
    
    // Detect file type
    $filename = $_FILES['import_file']['name'];
    $extension = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    
    error_log( 'Julius Import: File = ' . $filename . ', Extension = ' . $extension );
    
    if ( $extension === 'csv' ) {
        error_log( 'Julius Import: Routing to CSV import' );
        return julius_import_services_csv();
    } elseif ( $extension === 'json' ) {
        error_log( 'Julius Import: Routing to JSON import' );
        return julius_import_services_json();
    } else {
        error_log( 'Julius Import: Unsupported format - ' . $extension );
        return array(
            'success' => false,
            'message' => 'Unsupported file format "' . $extension . '". Please upload a JSON or CSV file.',
            'log'     => array(),
        );
    }
}

/**
 * Import Services from JSON
 */
function julius_import_services_json() {
    error_log( 'Julius Import: Starting JSON import' );
    
    // Get import options
    $update_existing = isset( $_POST['import_update_existing'] );
    $download_images = isset( $_POST['import_download_images'] );
    
    error_log( 'Julius Import: Update existing = ' . ( $update_existing ? 'yes' : 'no' ) );
    
    // Read and decode JSON
    $json_content = file_get_contents( $_FILES['import_file']['tmp_name'] );
    $import_data = json_decode( $json_content, true );
    
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array(
            'success' => false,
            'message' => 'Invalid JSON file. Please check the file format.',
            'log'     => array(),
        );
    }
    
    if ( ! isset( $import_data['services'] ) || ! is_array( $import_data['services'] ) ) {
        return array(
            'success' => false,
            'message' => 'Invalid file format. Missing services data.',
            'log'     => array(),
        );
    }
    
    // Import services
    $imported = 0;
    $updated = 0;
    $skipped = 0;
    $import_log = array();
    
    foreach ( $import_data['services'] as $service_data ) {
        $service_title = $service_data['title'];
        
        // Check if service exists
        $existing_post = get_page_by_title( $service_title, OBJECT, 'service' );
        
        if ( $existing_post && ! $update_existing ) {
            $skipped++;
            $import_log[] = sprintf( '⊘ <strong>%s</strong> - Skipped (already exists)', esc_html( $service_title ) );
            continue;
        }
        
        // Prepare post data
        $post_data = array(
            'post_title'   => $service_title,
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
                $import_log[] = sprintf( '↻ <strong>%s</strong> - Updated', esc_html( $service_title ) );
            }
        } else {
            $post_id = wp_insert_post( $post_data );
            if ( $post_id ) {
                $imported++;
                $import_log[] = sprintf( '✓ <strong>%s</strong> - Imported', esc_html( $service_title ) );
            }
        }
        
        if ( ! $post_id || is_wp_error( $post_id ) ) {
            $skipped++;
            $error_message = is_wp_error( $post_id ) ? $post_id->get_error_message() : 'Unknown error';
            $import_log[] = sprintf( '✗ <strong>%s</strong> - Failed (%s)', esc_html( $service_title ), esc_html( $error_message ) );
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
    
    // Return success result
    $message = sprintf(
        'JSON Import completed! Imported: %d, Updated: %d, Skipped: %d',
        $imported,
        $updated,
        $skipped
    );
    
    error_log( 'Julius Import: ' . $message );
    
    return array(
        'success' => true,
        'message' => $message,
        'log'     => $import_log,
    );
}

/**
 * Import Services from CSV
 */
function julius_import_services_csv() {
    error_log( 'Julius Import: Starting CSV import' );
    
    // Get import options
    $update_existing = isset( $_POST['import_update_existing'] );
    $download_images = isset( $_POST['import_download_images'] );
    
    error_log( 'Julius Import: Update existing = ' . ( $update_existing ? 'yes' : 'no' ) );
    
    // Open and read CSV file
    $file_path = $_FILES['import_file']['tmp_name'];
    error_log( 'Julius Import: Opening file: ' . $file_path );
    
    $file_handle = fopen( $file_path, 'r' );
    
    if ( ! $file_handle ) {
        error_log( 'Julius Import: ERROR - Failed to open CSV file' );
        return array(
            'success' => false,
            'message' => 'Error reading CSV file. Please try again.',
            'log'     => array(),
        );
    }
    
    error_log( 'Julius Import: File opened successfully' );
    
    // Skip BOM if present
    $bom = fread( $file_handle, 3 );
    if ( $bom !== "\xEF\xBB\xBF" ) {
        rewind( $file_handle );
        error_log( 'Julius Import: No BOM found, rewound file' );
    } else {
        error_log( 'Julius Import: BOM detected and skipped' );
    }
    
    // Read header row
    $headers = fgetcsv( $file_handle );
    error_log( 'Julius Import: Raw headers: ' . ( $headers ? json_encode( $headers ) : 'NULL' ) );
    error_log( 'Julius Import: Header count: ' . ( $headers ? count( $headers ) : 0 ) );
    
    if ( ! $headers ) {
        fclose( $file_handle );
        return array(
            'success' => false,
            'message' => 'Invalid CSV file. No headers found.',
            'log'     => array(),
        );
    }
    
    // Normalize headers (lowercase, trim)
    $headers = array_map( function( $header ) {
        return strtolower( trim( $header ) );
    }, $headers );
    
    error_log( 'Julius Import: Normalized headers: ' . implode( ', ', $headers ) );
    
    // Import services
    $imported = 0;
    $updated = 0;
    $skipped = 0;
    $import_log = array();
    $row_number = 1;
    
    error_log( 'Julius Import: Starting to process rows' );
    
    while ( ( $row = fgetcsv( $file_handle ) ) !== false ) {
        $row_number++;
        
        error_log( sprintf( 'Julius Import: Processing row %d', $row_number ) );
        
        // Skip empty rows
        if ( empty( array_filter( $row ) ) ) {
            continue;
        }
        
        // Create associative array from row data
        $data = array();
        foreach ( $headers as $index => $header ) {
            $data[ $header ] = isset( $row[ $index ] ) ? $row[ $index ] : '';
        }
        
        // Log first row data for debugging
        if ( $row_number === 2 ) {
            error_log( 'Julius Import: First data row raw: ' . json_encode( $row ) );
            error_log( 'Julius Import: First data row parsed: ' . json_encode( $data ) );
            error_log( 'Julius Import: Title value = "' . ( isset( $data['title'] ) ? $data['title'] : 'KEY NOT FOUND' ) . '"' );
            error_log( 'Julius Import: All keys: ' . implode( ', ', array_keys( $data ) ) );
        }
        
        // Validate required fields
        if ( empty( $data['title'] ) ) {
            $skipped++;
            $import_log[] = sprintf( '⊘ Row %d - Skipped (no title)', $row_number );
            continue;
        }
        
        $service_title = $data['title'];
        
        // Check if service exists
        $existing_post = get_page_by_title( $service_title, OBJECT, 'service' );
        
        if ( $existing_post && ! $update_existing ) {
            $skipped++;
            $import_log[] = sprintf( '⊘ <strong>%s</strong> - Skipped (already exists)', esc_html( $service_title ) );
            continue;
        }
        
        // Prepare post data
        $post_data = array(
            'post_title'   => $service_title,
            'post_content' => isset( $data['content'] ) ? $data['content'] : '',
            'post_excerpt' => isset( $data['excerpt'] ) ? $data['excerpt'] : '',
            'post_status'  => isset( $data['status'] ) && ! empty( $data['status'] ) ? $data['status'] : 'publish',
            'post_type'    => 'service',
        );
        
        if ( ! empty( $data['slug'] ) ) {
            $post_data['post_name'] = $data['slug'];
        }
        
        // Insert or update post
        if ( $existing_post ) {
            $post_data['ID'] = $existing_post->ID;
            $post_id = wp_update_post( $post_data );
            if ( $post_id ) {
                $updated++;
                $import_log[] = sprintf( '↻ <strong>%s</strong> - Updated (Row %d)', esc_html( $service_title ), $row_number );
            }
        } else {
            $post_id = wp_insert_post( $post_data );
            if ( $post_id ) {
                $imported++;
                $import_log[] = sprintf( '✓ <strong>%s</strong> - Imported (Row %d)', esc_html( $service_title ), $row_number );
            }
        }
        
        if ( ! $post_id || is_wp_error( $post_id ) ) {
            $skipped++;
            $error_message = is_wp_error( $post_id ) ? $post_id->get_error_message() : 'Unknown error';
            $import_log[] = sprintf( '✗ <strong>%s</strong> - Failed (Row %d: %s)', esc_html( $service_title ), $row_number, esc_html( $error_message ) );
            continue;
        }
        
        // Import categories
        if ( ! empty( $data['categories'] ) ) {
            $categories = array_map( 'trim', explode( ',', $data['categories'] ) );
            $term_ids = array();
            
            foreach ( $categories as $category_name ) {
                if ( empty( $category_name ) ) {
                    continue;
                }
                
                // Try to find existing category
                $term = get_term_by( 'name', $category_name, 'service_category' );
                
                if ( ! $term ) {
                    // Create new category
                    $term = wp_insert_term( $category_name, 'service_category' );
                }
                
                if ( ! is_wp_error( $term ) ) {
                    $term_ids[] = is_array( $term ) ? $term['term_id'] : $term->term_id;
                }
            }
            
            if ( ! empty( $term_ids ) ) {
                wp_set_post_terms( $post_id, $term_ids, 'service_category' );
            }
        }
        
        // Import featured image
        if ( $download_images && ! empty( $data['featured image url'] ) ) {
            $image_url = $data['featured image url'];
            $attachment_id = julius_import_featured_image( $image_url, $post_id );
            if ( $attachment_id ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
        
        // Import meta fields
        if ( ! empty( $data['featured'] ) ) {
            $is_featured = ( strtolower( $data['featured'] ) === 'yes' || $data['featured'] === '1' ) ? '1' : '';
            if ( $is_featured ) {
                update_post_meta( $post_id, '_julius_service_featured', '1' );
            }
        }
        
        if ( ! empty( $data['duration'] ) ) {
            update_post_meta( $post_id, '_julius_service_duration', $data['duration'] );
        }
        
        if ( ! empty( $data['phone'] ) ) {
            update_post_meta( $post_id, '_julius_service_phone', $data['phone'] );
        }
        
        if ( ! empty( $data['service included'] ) ) {
            update_post_meta( $post_id, '_julius_service_included', $data['service included'] );
        }
        
        if ( ! empty( $data['note'] ) ) {
            update_post_meta( $post_id, '_julius_service_note', $data['note'] );
        }
        
        // Parse pricing options from pipe-separated string
        if ( ! empty( $data['pricing options'] ) ) {
            $pricing_options = array();
            $options = explode( '|', $data['pricing options'] );
            
            foreach ( $options as $option ) {
                // Format: "Option Name (60 min): $25"
                if ( preg_match( '/^(.+?)\s*\((\d+)\s*min\):\s*(.+)$/', trim( $option ), $matches ) ) {
                    $pricing_options[] = array(
                        'name'  => trim( $matches[1] ),
                        'time'  => intval( $matches[2] ),
                        'price' => trim( $matches[3] ),
                    );
                }
            }
            
            if ( ! empty( $pricing_options ) ) {
                update_post_meta( $post_id, '_julius_pricing_options', $pricing_options );
            }
        }
        
        // Parse benefits from pipe-separated string
        if ( ! empty( $data['benefits'] ) ) {
            $benefits = array_map( 'trim', explode( '|', $data['benefits'] ) );
            $benefits = array_filter( $benefits );
            if ( ! empty( $benefits ) ) {
                update_post_meta( $post_id, '_julius_service_benefits', $benefits );
            }
        }
        
        // Parse what's included from pipe-separated string
        if ( ! empty( $data['what\'s included'] ) || ! empty( $data['whats included'] ) ) {
            $included_str = ! empty( $data['what\'s included'] ) ? $data['what\'s included'] : $data['whats included'];
            $included = array_map( 'trim', explode( '|', $included_str ) );
            $included = array_filter( $included );
            if ( ! empty( $included ) ) {
                update_post_meta( $post_id, '_julius_service_whats_included', $included );
            }
        }
    }
    
    fclose( $file_handle );
    
    // Return success result
    $message = sprintf(
        'CSV Import completed! Imported: %d, Updated: %d, Skipped: %d',
        $imported,
        $updated,
        $skipped
    );
    
    error_log( 'Julius Import: ' . $message );
    
    return array(
        'success' => true,
        'message' => $message,
        'log'     => $import_log,
    );
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
