<?php
/**
 * Gallery Admin Page
 *
 * @package Julius_Theme
 */

// Add Gallery admin menu
function julius_gallery_admin_menu() {
    add_menu_page(
        __( 'Gallery', 'julius-theme' ),
        __( 'Gallery', 'julius-theme' ),
        'manage_options',
        'julius-gallery',
        'julius_gallery_admin_page',
        'dashicons-format-gallery',
        30
    );
}
add_action( 'admin_menu', 'julius_gallery_admin_menu' );

// Enqueue scripts for gallery admin page
function julius_gallery_admin_scripts( $hook ) {
    if ( 'toplevel_page_julius-gallery' !== $hook ) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script( 'jquery-ui-sortable' );
}
add_action( 'admin_enqueue_scripts', 'julius_gallery_admin_scripts' );

// Save gallery images
function julius_save_gallery_images() {
    if ( ! isset( $_POST['julius_gallery_nonce'] ) || ! wp_verify_nonce( $_POST['julius_gallery_nonce'], 'julius_gallery_save' ) ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $gallery_images = isset( $_POST['julius_gallery_images'] ) ? array_map( 'absint', $_POST['julius_gallery_images'] ) : array();
    update_option( 'julius_gallery_images', $gallery_images );

    add_settings_error(
        'julius_gallery_messages',
        'julius_gallery_message',
        __( 'Gallery updated successfully!', 'julius-theme' ),
        'updated'
    );
}
add_action( 'admin_init', 'julius_save_gallery_images' );

// Gallery admin page HTML
function julius_gallery_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    settings_errors( 'julius_gallery_messages' );

    $gallery_images = get_option( 'julius_gallery_images', array() );
    
    // Set default images if gallery is empty (first time)
    if ( empty( $gallery_images ) ) {
        $gallery_images = array( 45, 46, 47, 48, 49, 50, 51, 52, 53, 54 );
        update_option( 'julius_gallery_images', $gallery_images );
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p><?php _e( 'Manage your spa gallery images. Add, remove, or reorder images that will be displayed on the homepage.', 'julius-theme' ); ?></p>

        <form method="post" action="">
            <?php wp_nonce_field( 'julius_gallery_save', 'julius_gallery_nonce' ); ?>
            
            <div class="julius-gallery-admin">
                <div class="julius-gallery-grid" id="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin: 20px 0;">
                    <?php
                    if ( ! empty( $gallery_images ) ) {
                        foreach ( $gallery_images as $image_id ) {
                            $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
                            if ( $image_url ) {
                                ?>
                                <div class="gallery-item" style="position: relative; border: 2px solid #ddd; padding: 5px; background: #fff;">
                                    <img src="<?php echo esc_url( $image_url ); ?>" style="width: 100%; height: 150px; object-fit: cover; display: block;">
                                    <input type="hidden" name="julius_gallery_images[]" value="<?php echo esc_attr( $image_id ); ?>">
                                    <button type="button" class="remove-gallery-image" style="position: absolute; top: 10px; right: 10px; background: #dc3232; color: #fff; border: none; border-radius: 3px; cursor: pointer; padding: 5px 10px; font-size: 12px;" data-image-id="<?php echo esc_attr( $image_id ); ?>">
                                        <?php _e( 'Remove', 'julius-theme' ); ?>
                                    </button>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

                <p>
                    <button type="button" class="button button-primary" id="add-gallery-image">
                        <?php _e( 'Add Image', 'julius-theme' ); ?>
                    </button>
                </p>

                <?php submit_button( __( 'Save Gallery', 'julius-theme' ) ); ?>
            </div>
        </form>
    </div>

    <style>
        .gallery-item {
            transition: all 0.3s ease;
        }
        .gallery-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .remove-gallery-image:hover {
            background: #a00;
        }
    </style>

    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;

        // Add image
        $('#add-gallery-image').on('click', function(e) {
            e.preventDefault();

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media({
                title: '<?php _e( 'Select Gallery Image', 'julius-theme' ); ?>',
                button: {
                    text: '<?php _e( 'Add to Gallery', 'julius-theme' ); ?>'
                },
                multiple: true
            });

            mediaUploader.on('select', function() {
                var attachments = mediaUploader.state().get('selection').toJSON();
                
                attachments.forEach(function(attachment) {
                    var imageHtml = '<div class="gallery-item" style="position: relative; border: 2px solid #ddd; padding: 5px; background: #fff;">' +
                        '<img src="' + attachment.sizes.thumbnail.url + '" style="width: 100%; height: 150px; object-fit: cover; display: block;">' +
                        '<input type="hidden" name="julius_gallery_images[]" value="' + attachment.id + '">' +
                        '<button type="button" class="remove-gallery-image" style="position: absolute; top: 10px; right: 10px; background: #dc3232; color: #fff; border: none; border-radius: 3px; cursor: pointer; padding: 5px 10px; font-size: 12px;" data-image-id="' + attachment.id + '">' +
                        '<?php _e( 'Remove', 'julius-theme' ); ?>' +
                        '</button>' +
                        '</div>';
                    
                    $('#gallery-grid').append(imageHtml);
                });
            });

            mediaUploader.open();
        });

        // Remove image
        $(document).on('click', '.remove-gallery-image', function(e) {
            e.preventDefault();
            if (confirm('<?php _e( 'Are you sure you want to remove this image?', 'julius-theme' ); ?>')) {
                $(this).closest('.gallery-item').remove();
            }
        });

        // Make gallery sortable
        $('#gallery-grid').sortable({
            placeholder: 'sortable-placeholder',
            tolerance: 'pointer'
        });
    });
    </script>
    <?php
}
