<?php
/**
 * Julius Theme Functions
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme constants
define( 'JULIUS_THEME_VERSION', '1.0.0' );
define( 'JULIUS_THEME_DIR', get_template_directory() );
define( 'JULIUS_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function julius_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'julius-theme' ),
        'footer-quick-links' => __( 'Footer Quick Links', 'julius-theme' ),
        'footer-services' => __( 'Footer Our Services', 'julius-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'julius_theme_setup' );

/**
 * Enqueue Scripts and Styles
 */
function julius_enqueue_scripts() {
    // Fonts
    wp_enqueue_style( 'julius-fonts', JULIUS_THEME_URI . '/assets/css/font.css', array(), JULIUS_THEME_VERSION );
    
    // Styles - Use file modification time for cache busting
    wp_enqueue_style( 'julius-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
    
    // Scripts - Use file modification time for cache busting
    wp_enqueue_script( 'julius-main', JULIUS_THEME_URI . '/js/main.js', array( 'jquery' ), filemtime( JULIUS_THEME_DIR . '/js/main.js' ), true );
    
    // Localize script for AJAX
    wp_localize_script( 'julius-main', 'juliusAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'julius-nonce' )
    ) );
    
    // Blog Search Autocomplete (only on blog archive and search pages)
    if ( is_post_type_archive( 'blog_post' ) || ( is_search() && get_query_var( 'post_type' ) === 'blog_post' ) ) {
        wp_enqueue_script( 'julius-blog-search', JULIUS_THEME_URI . '/js/blog-search.js', array( 'jquery' ), filemtime( JULIUS_THEME_DIR . '/js/blog-search.js' ), true );
        
        wp_localize_script( 'julius-blog-search', 'juliusSearch', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'julius-search-nonce' )
        ) );
    }
    
    // Newsletter AJAX (enqueue on all pages that show newsletter form)
    wp_enqueue_script( 'julius-newsletter', JULIUS_THEME_URI . '/js/newsletter.js', array( 'jquery' ), filemtime( JULIUS_THEME_DIR . '/js/newsletter.js' ), true );
    
    wp_localize_script( 'julius-newsletter', 'juliusNewsletter', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'julius-newsletter-ajax' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'julius_enqueue_scripts' );

/**
 * Include Custom Post Types
 */
if ( file_exists( JULIUS_THEME_DIR . '/cpt/cpt-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/cpt/cpt-init.php';
}

/**
 * Include Meta Boxes
 */
if ( file_exists( JULIUS_THEME_DIR . '/meta/meta-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/meta/meta-init.php';
}

/**
 * Include AJAX Handlers
 */
if ( file_exists( JULIUS_THEME_DIR . '/ajax/ajax-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/ajax/ajax-init.php';
}

/**
 * Include Customizer
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-init.php';
}

/**
 * Include Admin Functions
 */
if ( file_exists( JULIUS_THEME_DIR . '/admin/admin-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/admin/admin-init.php';
}

/**
 * Include Newsletter Module
 */
if ( file_exists( JULIUS_THEME_DIR . '/newsletter/newsletter-init.php' ) ) {
    require_once JULIUS_THEME_DIR . '/newsletter/newsletter-init.php';
}

/**
 * Force blog archive template for tag/category filtering
 */
function julius_force_blog_archive_template( $template ) {
    // Check if we're on blog archive with tag or category parameters
    if ( isset( $_GET['tag'] ) || isset( $_GET['category'] ) ) {
        $current_url = $_SERVER['REQUEST_URI'];
        
        // Check if URL contains /blog/ (the blog archive slug)
        if ( strpos( $current_url, '/blog/' ) !== false || strpos( $current_url, '/blog?' ) !== false ) {
            $archive_template = locate_template( 'archive-blog_post.php' );
            
            if ( $archive_template ) {
                return $archive_template;
            }
        }
    }
    
    return $template;
}
add_filter( 'template_include', 'julius_force_blog_archive_template', 99 );
