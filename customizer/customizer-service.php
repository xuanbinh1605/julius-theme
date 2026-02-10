<?php
/**
 * Service Archive Page Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Service Archive Page Customizer Settings
 */
function julius_service_archive_customizer_register( $wp_customize ) {
    
    // Add Service Archive Panel
    $wp_customize->add_panel( 'julius_service_archive_panel', array(
        'title'       => __( 'Service Archive Settings', 'julius-theme' ),
        'description' => __( 'Customize your service archive page sections', 'julius-theme' ),
        'priority'    => 36,
    ) );

    // ===================================
    // Hero Section
    // ===================================
    $wp_customize->add_section( 'julius_service_hero_section', array(
        'title'    => __( 'Hero Section', 'julius-theme' ),
        'panel'    => 'julius_service_archive_panel',
        'priority' => 10,
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'julius_service_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_service_hero_image', array(
        'label'       => __( 'Hero Background Image', 'julius-theme' ),
        'description' => __( 'Upload or select the hero background image for service archive. Leave empty to use first service image.', 'julius-theme' ),
        'section'     => 'julius_service_hero_section',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'julius_service_hero_subtitle', array(
        'default'           => 'Julius Spa',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_service_hero_subtitle', array(
        'label'       => __( 'Hero Subtitle', 'julius-theme' ),
        'description' => __( 'Small uppercase text above the title', 'julius-theme' ),
        'section'     => 'julius_service_hero_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // Hero Title
    $wp_customize->add_setting( 'julius_service_hero_title', array(
        'default'           => 'Our Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_service_hero_title', array(
        'label'       => __( 'Hero Title', 'julius-theme' ),
        'description' => __( 'Main title text', 'julius-theme' ),
        'section'     => 'julius_service_hero_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // Hero Description
    $wp_customize->add_setting( 'julius_service_hero_description', array(
        'default'           => 'Choose from our wide range of relaxation treatments',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_service_hero_description', array(
        'label'       => __( 'Hero Description', 'julius-theme' ),
        'description' => __( 'Description text below the title', 'julius-theme' ),
        'section'     => 'julius_service_hero_section',
        'type'        => 'textarea',
        'priority'    => 40,
    ) );

    // ===================================
    // General Note Section
    // ===================================
    $wp_customize->add_section( 'julius_service_note_section', array(
        'title'    => __( 'General Note', 'julius-theme' ),
        'panel'    => 'julius_service_archive_panel',
        'priority' => 20,
    ) );

    // Note Text Line 1
    $wp_customize->add_setting( 'julius_service_note_line1', array(
        'default'           => '<strong class="text-foreground">Note:</strong> Prices exclude TIP. +50,000 VND/hour after 10PM.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_service_note_line1', array(
        'label'       => __( 'Note Text - Line 1', 'julius-theme' ),
        'description' => __( 'First line of the note. HTML allowed (strong, em, br, span).', 'julius-theme' ),
        'section'     => 'julius_service_note_section',
        'type'        => 'textarea',
        'priority'    => 10,
    ) );

    // Note Text Line 2
    $wp_customize->add_setting( 'julius_service_note_line2', array(
        'default'           => '<strong class="text-foreground">TIP:</strong> 60min: 50k | 90min: 70k | 120min: 100k VND',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_service_note_line2', array(
        'label'       => __( 'Note Text - Line 2', 'julius-theme' ),
        'description' => __( 'Second line of the note. HTML allowed (strong, em, br, span).', 'julius-theme' ),
        'section'     => 'julius_service_note_section',
        'type'        => 'textarea',
        'priority'    => 20,
    ) );
}
add_action( 'customize_register', 'julius_service_archive_customizer_register' );
