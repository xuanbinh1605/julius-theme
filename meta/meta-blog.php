<?php
/**
 * Blog Post Meta Box - Featured Article
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add featured article meta box
 */
function julius_add_blog_featured_meta_box() {
    add_meta_box(
        'julius_blog_featured',
        __( 'Featured Article', 'julius-theme' ),
        'julius_blog_featured_meta_box_callback',
        'blog_post',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'julius_add_blog_featured_meta_box' );

/**
 * Meta box callback
 */
function julius_blog_featured_meta_box_callback( $post ) {
    wp_nonce_field( 'julius_blog_featured_nonce', 'julius_blog_featured_nonce' );
    
    $is_featured = get_post_meta( $post->ID, '_julius_featured_article', true );
    ?>
    <div style="padding: 10px 0;">
        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
            <input 
                type="checkbox" 
                name="julius_featured_article" 
                value="1" 
                <?php checked( $is_featured, '1' ); ?>
                style="margin: 0;">
            <span><?php _e( 'Mark as Featured Article', 'julius-theme' ); ?></span>
        </label>
        <p class="description" style="margin-top: 8px;">
            <?php _e( 'Featured article will appear at the top of the blog archive page.', 'julius-theme' ); ?>
        </p>
    </div>
    <?php
}

/**
 * Save meta box data
 */
function julius_save_blog_featured_meta( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['julius_blog_featured_nonce'] ) || ! wp_verify_nonce( $_POST['julius_blog_featured_nonce'], 'julius_blog_featured_nonce' ) ) {
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
    
    // Save or delete meta
    if ( isset( $_POST['julius_featured_article'] ) && $_POST['julius_featured_article'] === '1' ) {
        update_post_meta( $post_id, '_julius_featured_article', '1' );
    } else {
        delete_post_meta( $post_id, '_julius_featured_article' );
    }
}
add_action( 'save_post_blog_post', 'julius_save_blog_featured_meta' );

/**
 * Add featured column to blog posts list
 */
function julius_blog_featured_column( $columns ) {
    $new_columns = array();
    
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        
        if ( $key === 'title' ) {
            $new_columns['featured'] = __( 'Featured', 'julius-theme' );
        }
    }
    
    return $new_columns;
}
add_filter( 'manage_blog_post_posts_columns', 'julius_blog_featured_column' );

/**
 * Display featured column content
 */
function julius_blog_featured_column_content( $column, $post_id ) {
    if ( $column === 'featured' ) {
        $is_featured = get_post_meta( $post_id, '_julius_featured_article', true );
        if ( $is_featured === '1' ) {
            echo '<span style="color: #d63638; font-weight: 600;">★ Featured</span>';
        } else {
            echo '<span style="color: #ddd;">—</span>';
        }
    }
}
add_action( 'manage_blog_post_posts_custom_column', 'julius_blog_featured_column_content', 10, 2 );
