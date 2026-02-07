<?php
/**
 * Service Meta Boxes
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue Admin Scripts for Service Meta Boxes
 */
function julius_enqueue_service_meta_scripts( $hook ) {
    global $post_type;
    
    if ( ( 'post.php' === $hook || 'post-new.php' === $hook ) && 'service' === $post_type ) {
        wp_enqueue_script(
            'julius-service-meta-repeater',
            get_template_directory_uri() . '/assets/js/admin/service-meta-repeater.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );
    }
}
add_action( 'admin_enqueue_scripts', 'julius_enqueue_service_meta_scripts' );

/**
 * Add Service Meta Boxes
 */
function julius_add_service_meta_boxes() {
    add_meta_box(
        'julius_service_details',
        __( 'Service Details', 'julius-theme' ),
        'julius_service_details_callback',
        'service',
        'normal',
        'high'
    );
    
    add_meta_box(
        'julius_service_pricing',
        __( 'Pricing Options', 'julius-theme' ),
        'julius_service_pricing_callback',
        'service',
        'normal',
        'high'
    );
    
    add_meta_box(
        'julius_service_benefits',
        __( 'Benefits', 'julius-theme' ),
        'julius_service_benefits_callback',
        'service',
        'normal',
        'default'
    );
    
    add_meta_box(
        'julius_service_included',
        __( 'What\'s Included', 'julius-theme' ),
        'julius_service_included_callback',
        'service',
        'normal',
        'default'
    );
    
    add_meta_box(
        'julius_service_additional',
        __( 'Additional Information', 'julius-theme' ),
        'julius_service_additional_callback',
        'service',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'julius_add_service_meta_boxes' );

/**
 * Service Details Meta Box Callback
 */
function julius_service_details_callback( $post ) {
    wp_nonce_field( 'julius_save_service_meta', 'julius_service_meta_nonce' );
    
    $duration = get_post_meta( $post->ID, '_julius_service_duration', true );
    $service_included = get_post_meta( $post->ID, '_julius_service_included', true );
    $phone = get_post_meta( $post->ID, '_julius_service_phone', true );
    ?>
    <div class="julius-meta-box">
        <p>
            <label for="julius_service_duration"><strong><?php _e( 'Duration', 'julius-theme' ); ?></strong></label><br>
            <input type="text" id="julius_service_duration" name="julius_service_duration" value="<?php echo esc_attr( $duration ); ?>" class="widefat" placeholder="e.g., 60 minutes, 90 minutes">
        </p>
        
        <p>
            <label for="julius_service_phone"><strong><?php _e( 'Phone Number', 'julius-theme' ); ?></strong></label><br>
            <input type="text" id="julius_service_phone" name="julius_service_phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" placeholder="e.g., +84 123 456 789">
        </p>
        
        <p>
            <label for="julius_service_included"><strong><?php _e( 'Service Included', 'julius-theme' ); ?></strong></label><br>
            <textarea id="julius_service_included" name="julius_service_included" rows="4" class="widefat"><?php echo esc_textarea( $service_included ); ?></textarea>
            <span class="description"><?php _e( 'Brief description of what\'s included in this service', 'julius-theme' ); ?></span>
        </p>
    </div>
    <?php
}

/**
 * Service Pricing Meta Box Callback
 */
function julius_service_pricing_callback( $post ) {
    $pricing_options = get_post_meta( $post->ID, '_julius_pricing_options', true );
    if ( ! is_array( $pricing_options ) ) {
        $pricing_options = array();
    }
    ?>
    <div class="julius-repeater-field">
        <div id="pricing-options-container">
            <?php
            if ( ! empty( $pricing_options ) ) {
                foreach ( $pricing_options as $index => $option ) {
                    ?>
                    <div class="repeater-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">
                        <div style="display: flex; gap: 10px; align-items: flex-start;">
                            <div style="flex: 1;">
                                <label><strong><?php _e( 'Option Name', 'julius-theme' ); ?></strong></label>
                                <input type="text" name="pricing_option_name[]" value="<?php echo esc_attr( $option['name'] ?? '' ); ?>" class="widefat" placeholder="e.g., Basic Package, Premium Package">
                            </div>
                            <div style="width: 200px;">
                                <label><strong><?php _e( 'Price', 'julius-theme' ); ?></strong></label>
                                <input type="text" name="pricing_option_price[]" value="<?php echo esc_attr( $option['price'] ?? '' ); ?>" class="widefat" placeholder="e.g., $50, 500,000 VND">
                            </div>
                            <button type="button" class="button remove-pricing-option" style="margin-top: 22px;"><?php _e( 'Remove', 'julius-theme' ); ?></button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <button type="button" id="add-pricing-option" class="button button-secondary"><?php _e( '+ Add Pricing Option', 'julius-theme' ); ?></button>
    </div>
    <?php
}

/**
 * Service Benefits Meta Box Callback
 */
function julius_service_benefits_callback( $post ) {
    $benefits = get_post_meta( $post->ID, '_julius_service_benefits', true );
    if ( ! is_array( $benefits ) ) {
        $benefits = array();
    }
    ?>
    <div class="julius-repeater-field">
        <div id="benefits-container">
            <?php
            if ( ! empty( $benefits ) ) {
                foreach ( $benefits as $index => $benefit ) {
                    ?>
                    <div class="repeater-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <input type="text" name="service_benefits[]" value="<?php echo esc_attr( $benefit ); ?>" class="widefat" placeholder="Enter a benefit">
                            <button type="button" class="button remove-benefit"><?php _e( 'Remove', 'julius-theme' ); ?></button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <button type="button" id="add-benefit" class="button button-secondary"><?php _e( '+ Add Benefit', 'julius-theme' ); ?></button>
    </div>
    <?php
}

/**
 * What's Included Meta Box Callback
 */
function julius_service_included_callback( $post ) {
    $included_items = get_post_meta( $post->ID, '_julius_service_whats_included', true );
    if ( ! is_array( $included_items ) ) {
        $included_items = array();
    }
    ?>
    <div class="julius-repeater-field">
        <div id="included-container">
            <?php
            if ( ! empty( $included_items ) ) {
                foreach ( $included_items as $index => $item ) {
                    ?>
                    <div class="repeater-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <input type="text" name="service_whats_included[]" value="<?php echo esc_attr( $item ); ?>" class="widefat" placeholder="Enter what's included">
                            <button type="button" class="button remove-included"><?php _e( 'Remove', 'julius-theme' ); ?></button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <button type="button" id="add-included" class="button button-secondary"><?php _e( '+ Add Item', 'julius-theme' ); ?></button>
    </div>
    <?php
}

/**
 * Additional Information Meta Box Callback
 */
function julius_service_additional_callback( $post ) {
    $note = get_post_meta( $post->ID, '_julius_service_note', true );
    ?>
    <div class="julius-meta-box">
        <p>
            <label for="julius_service_note"><strong><?php _e( 'Note', 'julius-theme' ); ?></strong></label><br>
            <textarea id="julius_service_note" name="julius_service_note" rows="6" class="widefat"><?php echo esc_textarea( $note ); ?></textarea>
            <span class="description"><?php _e( 'Additional notes or special instructions', 'julius-theme' ); ?></span>
        </p>
    </div>
    <?php
}

/**
 * Save Service Meta Data
 */
function julius_save_service_meta( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['julius_service_meta_nonce'] ) || ! wp_verify_nonce( $_POST['julius_service_meta_nonce'], 'julius_save_service_meta' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save Service Details
    if ( isset( $_POST['julius_service_duration'] ) ) {
        update_post_meta( $post_id, '_julius_service_duration', sanitize_text_field( $_POST['julius_service_duration'] ) );
    }
    
    if ( isset( $_POST['julius_service_phone'] ) ) {
        update_post_meta( $post_id, '_julius_service_phone', sanitize_text_field( $_POST['julius_service_phone'] ) );
    }
    
    if ( isset( $_POST['julius_service_included'] ) ) {
        update_post_meta( $post_id, '_julius_service_included', sanitize_textarea_field( $_POST['julius_service_included'] ) );
    }
    
    // Save Pricing Options
    if ( isset( $_POST['pricing_option_name'] ) && isset( $_POST['pricing_option_price'] ) ) {
        $pricing_options = array();
        $names = $_POST['pricing_option_name'];
        $prices = $_POST['pricing_option_price'];
        
        for ( $i = 0; $i < count( $names ); $i++ ) {
            if ( ! empty( $names[$i] ) || ! empty( $prices[$i] ) ) {
                $pricing_options[] = array(
                    'name'  => sanitize_text_field( $names[$i] ),
                    'price' => sanitize_text_field( $prices[$i] ),
                );
            }
        }
        
        update_post_meta( $post_id, '_julius_pricing_options', $pricing_options );
    } else {
        delete_post_meta( $post_id, '_julius_pricing_options' );
    }
    
    // Save Benefits
    if ( isset( $_POST['service_benefits'] ) ) {
        $benefits = array_filter( array_map( 'sanitize_text_field', $_POST['service_benefits'] ) );
        update_post_meta( $post_id, '_julius_service_benefits', $benefits );
    } else {
        delete_post_meta( $post_id, '_julius_service_benefits' );
    }
    
    // Save What's Included
    if ( isset( $_POST['service_whats_included'] ) ) {
        $included = array_filter( array_map( 'sanitize_text_field', $_POST['service_whats_included'] ) );
        update_post_meta( $post_id, '_julius_service_whats_included', $included );
    } else {
        delete_post_meta( $post_id, '_julius_service_whats_included' );
    }
    
    // Save Note
    if ( isset( $_POST['julius_service_note'] ) ) {
        update_post_meta( $post_id, '_julius_service_note', sanitize_textarea_field( $_POST['julius_service_note'] ) );
    }
}
add_action( 'save_post_service', 'julius_save_service_meta' );
