<?php
/**
 * Blog Author Taxonomy Meta Fields
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add custom fields to blog author - Add form
 */
function julius_blog_author_add_form_fields() {
    ?>
    <div class="form-field term-group">
        <label for="author_avatar"><?php _e( 'Author Avatar', 'julius-theme' ); ?></label>
        <div id="author_avatar_preview" style="margin-bottom: 10px;"></div>
        <input type="hidden" id="author_avatar" name="author_avatar" value="">
        <button type="button" class="button julius-upload-author-avatar-button"><?php _e( 'Upload/Select Avatar', 'julius-theme' ); ?></button>
        <button type="button" class="button julius-remove-author-avatar-button" style="display:none;"><?php _e( 'Remove Avatar', 'julius-theme' ); ?></button>
        <p><?php _e( 'Upload or select an avatar image for this author (recommended: 200x200px).', 'julius-theme' ); ?></p>
    </div>
    <?php
}
add_action( 'blog_author_add_form_fields', 'julius_blog_author_add_form_fields' );

/**
 * Add custom fields to blog author - Edit form
 */
function julius_blog_author_edit_form_fields( $term ) {
    $term_id = $term->term_id;
    $avatar = get_term_meta( $term_id, 'author_avatar', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="author_avatar"><?php _e( 'Author Avatar', 'julius-theme' ); ?></label>
        </th>
        <td>
            <div id="author_avatar_preview" style="margin-bottom: 10px;">
                <?php if ( $avatar ) : ?>
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $avatar, 'thumbnail' ) ); ?>" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 10px;">
                <?php endif; ?>
            </div>
            <input type="hidden" id="author_avatar" name="author_avatar" value="<?php echo esc_attr( $avatar ); ?>">
            <button type="button" class="button julius-upload-author-avatar-button"><?php _e( 'Upload/Select Avatar', 'julius-theme' ); ?></button>
            <button type="button" class="button julius-remove-author-avatar-button" <?php echo empty( $avatar ) ? 'style="display:none;"' : ''; ?>><?php _e( 'Remove Avatar', 'julius-theme' ); ?></button>
            <p class="description"><?php _e( 'Upload or select an avatar image for this author (recommended: 200x200px).', 'julius-theme' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'blog_author_edit_form_fields', 'julius_blog_author_edit_form_fields' );

/**
 * Save custom author meta
 */
function julius_save_blog_author_meta( $term_id ) {
    if ( isset( $_POST['author_avatar'] ) ) {
        update_term_meta( $term_id, 'author_avatar', absint( $_POST['author_avatar'] ) );
    }
}
add_action( 'created_blog_author', 'julius_save_blog_author_meta' );
add_action( 'edited_blog_author', 'julius_save_blog_author_meta' );

/**
 * Add custom columns to blog author list table
 */
function julius_blog_author_columns( $columns ) {
    $new_columns = array();
    
    foreach ( $columns as $key => $value ) {
        if ( $key === 'name' ) {
            $new_columns['avatar'] = __( 'Avatar', 'julius-theme' );
        }
        $new_columns[ $key ] = $value;
    }
    
    return $new_columns;
}
add_filter( 'manage_edit-blog_author_columns', 'julius_blog_author_columns' );

/**
 * Display custom column content
 */
function julius_blog_author_column_content( $content, $column_name, $term_id ) {
    if ( $column_name === 'avatar' ) {
        $avatar_id = get_term_meta( $term_id, 'author_avatar', true );
        if ( $avatar_id ) {
            $image = wp_get_attachment_image_url( $avatar_id, 'thumbnail' );
            $content = '<img src="' . esc_url( $image ) . '" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">';
        } else {
            $content = '<span style="color: #999;">—</span>';
        }
    }
    
    return $content;
}
add_filter( 'manage_blog_author_custom_column', 'julius_blog_author_column_content', 10, 3 );

/**
 * Enqueue media uploader script for blog author meta fields
 */
function julius_enqueue_blog_author_meta_scripts( $hook ) {
    if ( $hook === 'edit-tags.php' || $hook === 'term.php' ) {
        if ( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] === 'blog_author' ) {
            wp_enqueue_media();
            wp_enqueue_script( 'julius-blog-author-meta', get_template_directory_uri() . '/assets/js/admin/blog-author-meta.js', array( 'jquery' ), '1.0.0', true );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'julius_enqueue_blog_author_meta_scripts' );
