<?php
/**
 * Admin Functions Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Custom Admin Menu Page
 */
function julius_add_admin_menu() {
    add_theme_page(
        __( 'Julius Theme Settings', 'julius-theme' ),
        __( 'Theme Settings', 'julius-theme' ),
        'manage_options',
        'julius-theme-settings',
        'julius_render_admin_page'
    );
    
    // Add Sample Generator submenu under Tools
    add_management_page(
        __( 'Services Sample Generator', 'julius-theme' ),
        __( 'Services Generator', 'julius-theme' ),
        'manage_options',
        'julius-sample-generator',
        'julius_render_sample_generator_page'
    );
}
add_action( 'admin_menu', 'julius_add_admin_menu' );

/**
 * Render Admin Page
 */
function julius_render_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <p><?php esc_html_e( 'Custom theme settings go here.', 'julius-theme' ); ?></p>
    </div>
    <?php
}

/**
 * Enqueue Admin Scripts and Styles
 */
function julius_enqueue_admin_scripts( $hook ) {
    // Only load on specific admin pages
    if ( 'appearance_page_julius-theme-settings' !== $hook ) {
        return;
    }
    
    // Enqueue admin styles
    // wp_enqueue_style( 'julius-admin', JULIUS_THEME_URI . '/admin/css/admin.css', array(), JULIUS_THEME_VERSION );
    
    // Enqueue admin scripts
    // wp_enqueue_script( 'julius-admin', JULIUS_THEME_URI . '/admin/js/admin.js', array( 'jquery' ), JULIUS_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'julius_enqueue_admin_scripts' );

/**
 * Include Sample Generator
 */
if ( file_exists( get_template_directory() . '/admin/admin-sample-generator.php' ) ) {
    require_once get_template_directory() . '/admin/admin-sample-generator.php';
}
