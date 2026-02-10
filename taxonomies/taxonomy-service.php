<?php
/**
 * Service Taxonomy
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Service Taxonomy
 */
function julius_register_service_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Service Categories', 'Taxonomy General Name', 'julius-theme' ),
        'singular_name'              => _x( 'Service Category', 'Taxonomy Singular Name', 'julius-theme' ),
        'menu_name'                  => __( 'Categories', 'julius-theme' ),
        'all_items'                  => __( 'All Categories', 'julius-theme' ),
        'parent_item'                => __( 'Parent Category', 'julius-theme' ),
        'parent_item_colon'          => __( 'Parent Category:', 'julius-theme' ),
        'new_item_name'              => __( 'New Category Name', 'julius-theme' ),
        'add_new_item'               => __( 'Add New Category', 'julius-theme' ),
        'edit_item'                  => __( 'Edit Category', 'julius-theme' ),
        'update_item'                => __( 'Update Category', 'julius-theme' ),
        'view_item'                  => __( 'View Category', 'julius-theme' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'julius-theme' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'julius-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'julius-theme' ),
        'popular_items'              => __( 'Popular Categories', 'julius-theme' ),
        'search_items'               => __( 'Search Categories', 'julius-theme' ),
        'not_found'                  => __( 'Not Found', 'julius-theme' ),
        'no_terms'                   => __( 'No categories', 'julius-theme' ),
        'items_list'                 => __( 'Categories list', 'julius-theme' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'julius-theme' ),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'service-category' ),
    );
    
    register_taxonomy( 'service_category', array( 'service' ), $args );
}
add_action( 'init', 'julius_register_service_taxonomy' );

/**
 * Add custom fields to service category - Add form
 */
function julius_service_category_add_form_fields() {
    ?>
    <div class="form-field term-group">
        <label for="category_featured_image"><?php _e( 'Featured Image', 'julius-theme' ); ?></label>
        <div id="category_featured_image_preview" style="margin-bottom: 10px;"></div>
        <input type="hidden" id="category_featured_image" name="category_featured_image" value="">
        <button type="button" class="button julius-upload-image-button"><?php _e( 'Upload/Select Image', 'julius-theme' ); ?></button>
        <button type="button" class="button julius-remove-image-button" style="display:none;"><?php _e( 'Remove Image', 'julius-theme' ); ?></button>
        <p><?php _e( 'Upload or select a featured image for this category.', 'julius-theme' ); ?></p>
    </div>

    <div class="form-field term-group">
        <label for="category_full_name"><?php _e( 'Full Service Name', 'julius-theme' ); ?></label>
        <input type="text" id="category_full_name" name="category_full_name" value="">
        <p><?php _e( 'Enter the full descriptive name for this service category.', 'julius-theme' ); ?></p>
    </div>

    <div class="form-field term-group">
        <label for="category_tags"><?php _e( 'Tags', 'julius-theme' ); ?></label>
        <input type="text" id="category_tags" name="category_tags" value="">
        <p><?php _e( 'Enter tags separated by commas (e.g., relaxation, wellness, beauty).', 'julius-theme' ); ?></p>
    </div>
    <?php
}
add_action( 'service_category_add_form_fields', 'julius_service_category_add_form_fields' );

/**
 * Add custom fields to service category - Edit form
 */
function julius_service_category_edit_form_fields( $term ) {
    $term_id = $term->term_id;
    $featured_image = get_term_meta( $term_id, 'category_featured_image', true );
    $full_name = get_term_meta( $term_id, 'category_full_name', true );
    $tags = get_term_meta( $term_id, 'category_tags', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category_featured_image"><?php _e( 'Featured Image', 'julius-theme' ); ?></label>
        </th>
        <td>
            <div id="category_featured_image_preview" style="margin-bottom: 10px;">
                <?php if ( $featured_image ) : ?>
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $featured_image, 'medium' ) ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;">
                <?php endif; ?>
            </div>
            <input type="hidden" id="category_featured_image" name="category_featured_image" value="<?php echo esc_attr( $featured_image ); ?>">
            <button type="button" class="button julius-upload-image-button"><?php _e( 'Upload/Select Image', 'julius-theme' ); ?></button>
            <button type="button" class="button julius-remove-image-button" <?php echo empty( $featured_image ) ? 'style="display:none;"' : ''; ?>><?php _e( 'Remove Image', 'julius-theme' ); ?></button>
            <p class="description"><?php _e( 'Upload or select a featured image for this category.', 'julius-theme' ); ?></p>
        </td>
    </tr>

    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category_full_name"><?php _e( 'Full Service Name', 'julius-theme' ); ?></label>
        </th>
        <td>
            <input type="text" id="category_full_name" name="category_full_name" value="<?php echo esc_attr( $full_name ); ?>" class="regular-text">
            <p class="description"><?php _e( 'Enter the full descriptive name for this service category.', 'julius-theme' ); ?></p>
        </td>
    </tr>

    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category_tags"><?php _e( 'Tags', 'julius-theme' ); ?></label>
        </th>
        <td>
            <input type="text" id="category_tags" name="category_tags" value="<?php echo esc_attr( $tags ); ?>" class="regular-text">
            <p class="description"><?php _e( 'Enter tags separated by commas (e.g., relaxation, wellness, beauty).', 'julius-theme' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'service_category_edit_form_fields', 'julius_service_category_edit_form_fields' );

/**
 * Save custom term fields
 */
function julius_save_service_category_meta( $term_id ) {
    if ( isset( $_POST['category_featured_image'] ) ) {
        update_term_meta( $term_id, 'category_featured_image', absint( $_POST['category_featured_image'] ) );
    }
    
    if ( isset( $_POST['category_full_name'] ) ) {
        update_term_meta( $term_id, 'category_full_name', sanitize_text_field( $_POST['category_full_name'] ) );
    }
    
    if ( isset( $_POST['category_tags'] ) ) {
        update_term_meta( $term_id, 'category_tags', sanitize_text_field( $_POST['category_tags'] ) );
    }
}
add_action( 'created_service_category', 'julius_save_service_category_meta' );
add_action( 'edited_service_category', 'julius_save_service_category_meta' );

/**
 * Add custom columns to service category list table
 */
function julius_service_category_columns( $columns ) {
    $new_columns = array();
    
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        
        if ( $key === 'name' ) {
            $new_columns['featured_image'] = __( 'Featured Image', 'julius-theme' );
            $new_columns['full_name'] = __( 'Full Name', 'julius-theme' );
        }
    }
    
    return $new_columns;
}
add_filter( 'manage_edit-service_category_columns', 'julius_service_category_columns' );

/**
 * Display custom column content
 */
function julius_service_category_column_content( $content, $column_name, $term_id ) {
    if ( $column_name === 'featured_image' ) {
        $image_id = get_term_meta( $term_id, 'category_featured_image', true );
        if ( $image_id ) {
            $image = wp_get_attachment_image_url( $image_id, 'thumbnail' );
            $content = '<img src="' . esc_url( $image ) . '" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">';
        } else {
            $content = '<span style="color: #999;">—</span>';
        }
    }
    
    if ( $column_name === 'full_name' ) {
        $full_name = get_term_meta( $term_id, 'category_full_name', true );
        $content = $full_name ? esc_html( $full_name ) : '<span style="color: #999;">—</span>';
    }
    
    return $content;
}
add_filter( 'manage_service_category_custom_column', 'julius_service_category_column_content', 10, 3 );

/**
 * Enqueue media uploader script for term meta fields
 */
function julius_enqueue_term_meta_scripts( $hook ) {
    if ( $hook === 'edit-tags.php' || $hook === 'term.php' ) {
        if ( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] === 'service_category' ) {
            wp_enqueue_media();
            wp_enqueue_script( 'julius-term-meta', get_template_directory_uri() . '/assets/js/admin/term-meta.js', array( 'jquery' ), '1.0.0', true );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'julius_enqueue_term_meta_scripts' );
