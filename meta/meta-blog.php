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
 * Enqueue admin scripts for featured article meta box
 */
function julius_enqueue_blog_featured_scripts( $hook ) {
    global $post_type;
    
    if ( ( 'post.php' === $hook || 'post-new.php' === $hook ) && 'blog_post' === $post_type ) {
        wp_enqueue_script(
            'julius-blog-featured-meta',
            get_template_directory_uri() . '/assets/js/admin/blog-featured-meta.js',
            array( 'jquery' ),
            filemtime( get_template_directory() . '/assets/js/admin/blog-featured-meta.js' ),
            true
        );
        
        wp_localize_script(
            'julius-blog-featured-meta',
            'juliusBlogFeatured',
            array(
                'nonce' => wp_create_nonce( 'julius_check_featured_nonce' ),
            )
        );
    }
}
add_action( 'admin_enqueue_scripts', 'julius_enqueue_blog_featured_scripts' );

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
        // Unmark any existing featured articles first
        $existing_featured = new WP_Query( array(
            'post_type'      => 'blog_post',
            'posts_per_page' => -1,
            'post__not_in'   => array( $post_id ),
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'     => '_julius_featured_article',
                    'value'   => '1',
                    'compare' => '=',
                ),
            ),
        ) );
        
        if ( $existing_featured->have_posts() ) {
            foreach ( $existing_featured->posts as $featured_id ) {
                delete_post_meta( $featured_id, '_julius_featured_article' );
            }
        }
        wp_reset_postdata();
        
        // Mark this post as featured
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

/**
 * AJAX handler to check if there's already a featured article
 */
function julius_check_featured_article_ajax() {
    check_ajax_referer( 'julius_check_featured_nonce', 'nonce' );
    
    $current_post_id = isset( $_POST['current_post_id'] ) ? intval( $_POST['current_post_id'] ) : 0;
    
    // Check for existing featured articles (excluding current post)
    $args = array(
        'post_type'      => 'blog_post',
        'posts_per_page' => 1,
        'post__not_in'   => array( $current_post_id ),
        'meta_query'     => array(
            array(
                'key'     => '_julius_featured_article',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    );
    
    $featured_query = new WP_Query( $args );
    
    if ( $featured_query->have_posts() ) {
        $featured_post = $featured_query->posts[0];
        wp_send_json_success( array(
            'has_featured'  => true,
            'featured_post' => array(
                'id'    => $featured_post->ID,
                'title' => $featured_post->post_title,
            ),
        ) );
    } else {
        wp_send_json_success( array(
            'has_featured' => false,
        ) );
    }
    
    wp_reset_postdata();
}
add_action( 'wp_ajax_julius_check_featured_article', 'julius_check_featured_article_ajax' );
