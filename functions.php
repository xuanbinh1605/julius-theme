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
    ) );
}
add_action( 'after_setup_theme', 'julius_theme_setup' );

/**
 * Enqueue Scripts and Styles
 */
function julius_enqueue_scripts() {
    // Styles
    wp_enqueue_style( 'julius-style', get_stylesheet_uri(), array(), JULIUS_THEME_VERSION );
    
    // Scripts
    wp_enqueue_script( 'julius-main', JULIUS_THEME_URI . '/js/main.js', array( 'jquery' ), JULIUS_THEME_VERSION, true );
    
    // Localize script for AJAX
    wp_localize_script( 'julius-main', 'juliusAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'julius-nonce' )
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
