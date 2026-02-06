<?php
/**
 * Theme Customizer Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer Settings
 */
function julius_customize_register( $wp_customize ) {
    // Example: Add a custom section
    $wp_customize->add_section( 'julius_theme_options', array(
        'title'    => __( 'Julius Theme Options', 'julius-theme' ),
        'priority' => 30,
    ) );
    
    // Example: Add a setting
    $wp_customize->add_setting( 'julius_primary_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    // Example: Add a control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'julius_primary_color', array(
        'label'    => __( 'Primary Color', 'julius-theme' ),
        'section'  => 'julius_theme_options',
        'settings' => 'julius_primary_color',
    ) ) );
}
add_action( 'customize_register', 'julius_customize_register' );
