<?php
/**
 * Our Space Gallery Admin Page
 *
 * @package Julius_Theme
 */

// Add Our Space admin menu
function julius_our_space_admin_menu() {
    add_menu_page(
        __( 'Our Space Gallery', 'julius-theme' ),
        __( 'Our Space', 'julius-theme' ),
        'manage_options',
        'julius-our-space',
        'julius_our_space_admin_page',
        'dashicons-images-alt2',
        31
    );
}
add_action( 'admin_menu', 'julius_our_space_admin_menu' );

// Enqueue scripts for our space admin page
function julius_our_space_admin_scripts( $hook ) {
    if ( 'toplevel_page_julius-our-space' !== $hook ) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script( 'jquery-ui-sortable' );
}
add_action( 'admin_enqueue_scripts', 'julius_our_space_admin_scripts' );

// Save our space images
function julius_save_our_space_images() {
    if ( ! isset( $_POST['julius_our_space_nonce'] ) || ! wp_verify_nonce( $_POST['julius_our_space_nonce'], 'julius_our_space_save' ) ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $our_space_images = isset( $_POST['julius_our_space_images'] ) ? array_map( 'absint', $_POST['julius_our_space_images'] ) : array();
    update_option( 'julius_our_space_images', $our_space_images );

    add_settings_error(
        'julius_our_space_messages',
        'julius_our_space_message',
        __( 'Our Space gallery updated successfully!', 'julius-theme' ),
        'updated'
    );
}
add_action( 'admin_init', 'julius_save_our_space_images' );

// Our Space admin page HTML
function julius_our_space_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    settings_errors( 'julius_our_space_messages' );

    $our_space_images = get_option( 'julius_our_space_images', array() );
    
    // Set default images if gallery is empty (first time)
    if ( empty( $our_space_images ) ) {
        $our_space_images = array( 49, 50, 51, 52, 53, 54 );
        update_option( 'julius_our_space_images', $our_space_images );
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p><?php _e( 'Manage "Our Space" section images displayed on the About Us page. Add, remove, or reorder images to showcase your spa facilities.', 'julius-theme' ); ?></p>

        <form method="post" action="">
            <?php wp_nonce_field( 'julius_our_space_save', 'julius_our_space_nonce' ); ?>
            
            <div class="julius-our-space-admin">
                <div class="julius-our-space-grid" id="our-space-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin: 20px 0;">
                    <?php
                    if ( ! empty( $our_space_images ) ) {
                        foreach ( $our_space_images as $image_id ) {
                            $image_url = wp_get_attachment_image_url( $image_id, 'medium' );
                            if ( $image_url ) {
                                ?>
                                <div class="our-space-item" style="position: relative; border: 2px solid #ddd; padding: 5px; background: #fff; cursor: move;">
                                    <img src="<?php echo esc_url( $image_url ); ?>" style="width: 100%; height: 150px; object-fit: cover; display: block;">
                                    <input type="hidden" name="julius_our_space_images[]" value="<?php echo esc_attr( $image_id ); ?>">
                                    <button type="button" class="remove-our-space-image" style="position: absolute; top: 10px; right: 10px; background: #dc3232; color: #fff; border: none; border-radius: 3px; cursor: pointer; padding: 5px 10px; font-size: 12px;" data-image-id="<?php echo esc_attr( $image_id ); ?>">
                                        <?php _e( 'Remove', 'julius-theme' ); ?>
                                    </button>
                                    <div style="position: absolute; bottom: 10px; left: 10px; background: rgba(0,0,0,0.7); color: #fff; padding: 3px 8px; border-radius: 3px; font-size: 11px;">
                                        ID: <?php echo esc_html( $image_id ); ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

                <p>
                    <button type="button" class="button button-primary button-large" id="add-our-space-image">
                        <span class="dashicons dashicons-plus-alt" style="margin-top: 3px;"></span>
                        <?php _e( 'Add Image', 'julius-theme' ); ?>
                    </button>
                </p>

                <p class="description">
                    <?php _e( 'Tip: Drag and drop images to reorder them. The order here will be reflected on the About Us page.', 'julius-theme' ); ?>
                </p>

                <?php submit_button( __( 'Save Gallery', 'julius-theme' ), 'primary large' ); ?>
            </div>
        </form>
    </div>

    <style>
        .our-space-item {
            transition: all 0.3s ease;
        }
        .our-space-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        .remove-our-space-image:hover {
            background: #a00;
        }
        .sortable-placeholder {
            border: 2px dashed #0073aa;
            background: #f0f0f1;
            visibility: visible !important;
            height: 150px;
        }
        .ui-sortable-helper {
            opacity: 0.8;
            transform: rotate(2deg);
        }
    </style>

    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;

        // Add image
        $('#add-our-space-image').on('click', function(e) {
            e.preventDefault();

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media({
                title: '<?php _e( 'Select Our Space Images', 'julius-theme' ); ?>',
                button: {
                    text: '<?php _e( 'Add to Gallery', 'julius-theme' ); ?>'
                },
                multiple: true
            });

            mediaUploader.on('select', function() {
                var attachments = mediaUploader.state().get('selection').toJSON();
                
                attachments.forEach(function(attachment) {
                    var thumbnailUrl = attachment.sizes && attachment.sizes.medium 
                        ? attachment.sizes.medium.url 
                        : attachment.url;
                        
                    var imageHtml = '<div class="our-space-item" style="position: relative; border: 2px solid #ddd; padding: 5px; background: #fff; cursor: move;">' +
                        '<img src="' + thumbnailUrl + '" style="width: 100%; height: 150px; object-fit: cover; display: block;">' +
                        '<input type="hidden" name="julius_our_space_images[]" value="' + attachment.id + '">' +
                        '<button type="button" class="remove-our-space-image" style="position: absolute; top: 10px; right: 10px; background: #dc3232; color: #fff; border: none; border-radius: 3px; cursor: pointer; padding: 5px 10px; font-size: 12px;" data-image-id="' + attachment.id + '">' +
                        '<?php _e( 'Remove', 'julius-theme' ); ?>' +
                        '</button>' +
                        '<div style="position: absolute; bottom: 10px; left: 10px; background: rgba(0,0,0,0.7); color: #fff; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' +
                        'ID: ' + attachment.id +
                        '</div>' +
                        '</div>';
                    
                    $('#our-space-grid').append(imageHtml);
                });
            });

            mediaUploader.open();
        });

        // Remove image
        $(document).on('click', '.remove-our-space-image', function(e) {
            e.preventDefault();
            if (confirm('<?php _e( 'Are you sure you want to remove this image?', 'julius-theme' ); ?>')) {
                $(this).closest('.our-space-item').fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });

        // Make gallery sortable
        $('#our-space-grid').sortable({
            placeholder: 'sortable-placeholder',
            tolerance: 'pointer',
            cursor: 'move',
            opacity: 0.8
        });
    });
    </script>
    <?php
}
