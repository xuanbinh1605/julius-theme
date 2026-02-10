<?php
/**
 * Floating Social Icons Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Floating Social Icons Customizer Settings
 */
function julius_float_icons_customizer_register( $wp_customize ) {
    
    // Add Float Icons Section
    $wp_customize->add_section( 'julius_float_icons_section', array(
        'title'    => __( 'Floating Social Icons', 'julius-theme' ),
        'priority' => 80,
    ) );

    // Enable/Disable Float Icons
    $wp_customize->add_setting( 'julius_float_icons_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_icons_enable', array(
        'label'    => __( 'Enable Floating Social Icons', 'julius-theme' ),
        'section'  => 'julius_float_icons_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ) );

    // Messenger Icon
    $wp_customize->add_setting( 'julius_float_messenger_icon', array(
        'default'           => 60,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_float_messenger_icon', array(
        'label'       => __( 'Messenger Icon', 'julius-theme' ),
        'description' => __( 'Upload or select the Messenger icon image', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'mime_type'   => 'image',
        'priority'    => 20,
    ) ) );

    // Messenger Link
    $wp_customize->add_setting( 'julius_float_messenger_link', array(
        'default'           => 'https://m.me/yourusername',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_messenger_link', array(
        'label'       => __( 'Messenger Link', 'julius-theme' ),
        'description' => __( 'Enter your Messenger profile URL (e.g., https://m.me/yourusername)', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'url',
        'priority'    => 30,
    ) );

    // Phone Icon
    $wp_customize->add_setting( 'julius_float_phone_icon', array(
        'default'           => 61,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_float_phone_icon', array(
        'label'       => __( 'Phone Icon', 'julius-theme' ),
        'description' => __( 'Upload or select the Phone icon image', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'mime_type'   => 'image',
        'priority'    => 40,
    ) ) );

    // Phone Number
    $wp_customize->add_setting( 'julius_float_phone_number', array(
        'default'           => '+84123456789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_phone_number', array(
        'label'       => __( 'Phone Number', 'julius-theme' ),
        'description' => __( 'Enter phone number with country code (e.g., +84123456789)', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'text',
        'priority'    => 50,
    ) );

    // Zalo Icon
    $wp_customize->add_setting( 'julius_float_zalo_icon', array(
        'default'           => 62,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_float_zalo_icon', array(
        'label'       => __( 'Zalo Icon', 'julius-theme' ),
        'description' => __( 'Upload or select the Zalo icon image', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'mime_type'   => 'image',
        'priority'    => 60,
    ) ) );

    // Zalo Link/Phone
    $wp_customize->add_setting( 'julius_float_zalo_phone', array(
        'default'           => '84123456789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_zalo_phone', array(
        'label'       => __( 'Zalo Phone Number', 'julius-theme' ),
        'description' => __( 'Enter phone number for Zalo (without + sign, e.g., 84123456789)', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'text',
        'priority'    => 70,
    ) );

    // Icon Position
    $wp_customize->add_setting( 'julius_float_icons_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_icons_position', array(
        'label'    => __( 'Icons Position', 'julius-theme' ),
        'section'  => 'julius_float_icons_section',
        'type'     => 'select',
        'choices'  => array(
            'left'  => __( 'Left', 'julius-theme' ),
            'right' => __( 'Right', 'julius-theme' ),
        ),
        'priority' => 80,
    ) );

}
add_action( 'customize_register', 'julius_float_icons_customizer_register' );
