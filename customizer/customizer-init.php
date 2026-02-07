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
    // General Settings Section
    $wp_customize->add_section( 'julius_general_settings', array(
        'title'    => __( 'General Settings', 'julius-theme' ),
        'priority' => 30,
    ) );
    
    // Logo Image
    $wp_customize->add_setting( 'julius_logo_image', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_logo_image', array(
        'label'     => __( 'Logo Image', 'julius-theme' ),
        'section'   => 'julius_general_settings',
        'mime_type' => 'image',
    ) ) );
    
    // Phone Number
    $wp_customize->add_setting( 'julius_phone_number', array(
        'default'           => '+84 123 456 789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_phone_number', array(
        'label'    => __( 'Phone Number', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'text',
    ) );
    
    // Address
    $wp_customize->add_setting( 'julius_address', array(
        'default'           => 'Phan Boi Street, Da Nang, Vietnam',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_address', array(
        'label'    => __( 'Address', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'text',
    ) );
    
    // Opening Hours
    $wp_customize->add_setting( 'julius_opening_hours', array(
        'default'           => 'Open: 9:00 AM - 10:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_opening_hours', array(
        'label'    => __( 'Opening Hours', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'text',
    ) );
    
    // Theme Options Section
    $wp_customize->add_section( 'julius_theme_options', array(
        'title'    => __( 'Julius Theme Options', 'julius-theme' ),
        'priority' => 31,
    ) );
    
    // Primary Color
    $wp_customize->add_setting( 'julius_primary_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'julius_primary_color', array(
        'label'    => __( 'Primary Color', 'julius-theme' ),
        'section'  => 'julius_theme_options',
        'settings' => 'julius_primary_color',
    ) ) );
}
add_action( 'customize_register', 'julius_customize_register' );
