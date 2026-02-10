<?php
/**
 * Float Social Icons Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Float Social Icons Customizer Settings
 */
function julius_float_icons_customizer_register( $wp_customize ) {
    
    // Add Float Social Icons Section
    $wp_customize->add_section( 'julius_float_icons_section', array(
        'title'       => __( 'Floating Social Icons', 'julius-theme' ),
        'description' => __( 'Configure the floating social media icons that appear on your site', 'julius-theme' ),
        'priority'    => 90,
    ) );

    // Enable/Disable Float Icons
    $wp_customize->add_setting( 'julius_float_icons_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_icons_enable', array(
        'label'    => __( 'Enable Floating Icons', 'julius-theme' ),
        'section'  => 'julius_float_icons_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ) );

    // Messenger Link
    $wp_customize->add_setting( 'julius_float_messenger_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_messenger_link', array(
        'label'       => __( 'Messenger Link', 'julius-theme' ),
        'description' => __( 'Enter your Facebook Messenger link (e.g., https://m.me/your-page-id)', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'url',
        'priority'    => 20,
    ) );

    // Phone Number
    $wp_customize->add_setting( 'julius_float_phone_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_phone_number', array(
        'label'       => __( 'Phone Number', 'julius-theme' ),
        'description' => __( 'Enter phone number with country code (e.g., +84123456789)', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // Zalo Link
    $wp_customize->add_setting( 'julius_float_zalo_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_float_zalo_link', array(
        'label'       => __( 'Zalo Link', 'julius-theme' ),
        'description' => __( 'Enter your Zalo chat link', 'julius-theme' ),
        'section'     => 'julius_float_icons_section',
        'type'        => 'url',
        'priority'    => 40,
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
        'priority' => 50,
    ) );

}
add_action( 'customize_register', 'julius_float_icons_customizer_register' );
