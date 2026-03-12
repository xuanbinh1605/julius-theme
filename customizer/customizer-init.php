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
    
    // ===================================
    // Location 1
    // ===================================
    $wp_customize->add_setting( 'julius_loc1_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'julius_loc1_heading', array(
        'label'       => __( '── Location 1 ──', 'julius-theme' ),
        'description' => __( 'First branch details', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'hidden',
    ) ) );

    $wp_customize->add_setting( 'julius_loc1_name', array(
        'default'           => 'Julius 1',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc1_name', array(
        'label'   => __( 'Location 1 Name', 'julius-theme' ),
        'section' => 'julius_general_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc1_address', array(
        'default'           => '05 An Thuong 38, Da Nang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc1_address', array(
        'label'   => __( 'Location 1 Address', 'julius-theme' ),
        'section' => 'julius_general_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc1_phone', array(
        'default'           => '0775509057',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc1_phone', array(
        'label'       => __( 'Location 1 Phone (for tel: link)', 'julius-theme' ),
        'description' => __( 'No spaces or special characters', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc1_phone_display', array(
        'default'           => '0775 509 057',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc1_phone_display', array(
        'label'       => __( 'Location 1 Phone Display', 'julius-theme' ),
        'description' => __( 'How the phone number appears on the site', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc1_map_embed', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc1_map_embed', array(
        'label'       => __( 'Location 1 Google Maps Embed URL', 'julius-theme' ),
        'description' => __( 'Paste the Google Maps embed URL for this branch', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'url',
    ) );

    // ===================================
    // Location 2
    // ===================================
    $wp_customize->add_setting( 'julius_loc2_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'julius_loc2_heading', array(
        'label'       => __( '── Location 2 ──', 'julius-theme' ),
        'description' => __( 'Second branch details', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'hidden',
    ) ) );

    $wp_customize->add_setting( 'julius_loc2_name', array(
        'default'           => 'Julius 2',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc2_name', array(
        'label'   => __( 'Location 2 Name', 'julius-theme' ),
        'section' => 'julius_general_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc2_address', array(
        'default'           => '61 Ta My Duat, Da Nang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc2_address', array(
        'label'   => __( 'Location 2 Address', 'julius-theme' ),
        'section' => 'julius_general_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc2_phone', array(
        'default'           => '0787509157',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc2_phone', array(
        'label'       => __( 'Location 2 Phone (for tel: link)', 'julius-theme' ),
        'description' => __( 'No spaces or special characters', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc2_phone_display', array(
        'default'           => '0787 509 157',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc2_phone_display', array(
        'label'       => __( 'Location 2 Phone Display', 'julius-theme' ),
        'description' => __( 'How the phone number appears on the site', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'julius_loc2_map_embed', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'julius_loc2_map_embed', array(
        'label'       => __( 'Location 2 Google Maps Embed URL', 'julius-theme' ),
        'description' => __( 'Paste the Google Maps embed URL for this branch', 'julius-theme' ),
        'section'     => 'julius_general_settings',
        'type'        => 'url',
    ) );
    
    // Opening Hours
    $wp_customize->add_setting( 'julius_opening_hours', array(
        'default'           => '9:00 AM - 10:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_opening_hours', array(
        'label'    => __( 'Opening Hours', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'text',
    ) );
    
    // Email Address
    $wp_customize->add_setting( 'julius_email', array(
        'default'           => 'info@juliusspa.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_email', array(
        'label'    => __( 'Email Address', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'email',
    ) );
    
    // Facebook URL
    $wp_customize->add_setting( 'julius_facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_facebook_url', array(
        'label'    => __( 'Facebook URL', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'url',
    ) );
    
    // Instagram URL
    $wp_customize->add_setting( 'julius_instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'julius_instagram_url', array(
        'label'    => __( 'Instagram URL', 'julius-theme' ),
        'section'  => 'julius_general_settings',
        'type'     => 'url',
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

/**
 * Include Front Page Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-frontpage.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-frontpage.php';
}

/**
 * Include Promotions Section Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-promotions.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-promotions.php';
}

/**
 * Include About Us Page Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-about-us.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-about-us.php';
}

/**
 * Include Contact Page Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-contact.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-contact.php';
}

/**
 * Include Floating Social Icons Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-float-icons.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-float-icons.php';
}

/**
 * Include Blog Archive Page Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-blog.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-blog.php';
}

/**
 * Include Service Archive Page Customizer Settings
 */
if ( file_exists( JULIUS_THEME_DIR . '/customizer/customizer-service.php' ) ) {
    require_once JULIUS_THEME_DIR . '/customizer/customizer-service.php';
}
