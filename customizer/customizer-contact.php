<?php
/**
 * Contact Page Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Contact Page Customizer Settings
 */
function julius_contact_customizer_register( $wp_customize ) {
    
    // Add Contact Page Panel
    $wp_customize->add_panel( 'julius_contact_panel', array(
        'title'       => __( 'Contact Page Settings', 'julius-theme' ),
        'description' => __( 'Customize your contact page sections', 'julius-theme' ),
        'priority'    => 32,
    ) );

    // ===================================
    // Hero Section
    // ===================================
    $wp_customize->add_section( 'julius_contact_hero_section', array(
        'title'    => __( 'Hero Section', 'julius-theme' ),
        'panel'    => 'julius_contact_panel',
        'priority' => 10,
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'julius_contact_hero_image', array(
        'default'           => 46,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_contact_hero_image', array(
        'label'       => __( 'Hero Background Image', 'julius-theme' ),
        'description' => __( 'Upload or select the hero background image', 'julius-theme' ),
        'section'     => 'julius_contact_hero_section',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'julius_contact_hero_subtitle', array(
        'default'           => 'Contact Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_hero_subtitle', array(
        'label'       => __( 'Hero Subtitle', 'julius-theme' ),
        'description' => __( 'Small uppercase text above the title', 'julius-theme' ),
        'section'     => 'julius_contact_hero_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // Hero Title
    $wp_customize->add_setting( 'julius_contact_hero_title', array(
        'default'           => 'Get In Touch',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_hero_title', array(
        'label'       => __( 'Hero Title', 'julius-theme' ),
        'description' => __( 'Main title text', 'julius-theme' ),
        'section'     => 'julius_contact_hero_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // Hero Description
    $wp_customize->add_setting( 'julius_contact_hero_description', array(
        'default'           => 'Ready to experience ultimate relaxation? Book your appointment or ask us anything.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_hero_description', array(
        'label'       => __( 'Hero Description', 'julius-theme' ),
        'description' => __( 'Description text below the title', 'julius-theme' ),
        'section'     => 'julius_contact_hero_section',
        'type'        => 'textarea',
        'priority'    => 40,
    ) );

    // ===================================
    // Map Section
    // ===================================
    $wp_customize->add_section( 'julius_contact_map_section', array(
        'title'    => __( 'Map Section', 'julius-theme' ),
        'panel'    => 'julius_contact_panel',
        'priority' => 20,
    ) );

    // Map Subtitle
    $wp_customize->add_setting( 'julius_contact_map_subtitle', array(
        'default'           => 'Our Location',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_map_subtitle', array(
        'label'       => __( 'Section Subtitle', 'julius-theme' ),
        'description' => __( 'Small uppercase text above the title', 'julius-theme' ),
        'section'     => 'julius_contact_map_section',
        'type'        => 'text',
        'priority'    => 10,
    ) );

    // Map Title
    $wp_customize->add_setting( 'julius_contact_map_title', array(
        'default'           => 'Find Us Here',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_map_title', array(
        'label'       => __( 'Section Title', 'julius-theme' ),
        'description' => __( 'Main section title', 'julius-theme' ),
        'section'     => 'julius_contact_map_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // Map Description
    $wp_customize->add_setting( 'julius_contact_map_description', array(
        'default'           => 'Located in the heart of An Thuong area, just minutes from the beautiful beaches of Da Nang.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_map_description', array(
        'label'       => __( 'Section Description', 'julius-theme' ),
        'description' => __( 'Description text below the title', 'julius-theme' ),
        'section'     => 'julius_contact_map_section',
        'type'        => 'textarea',
        'priority'    => 30,
    ) );

    // Map Embed URL
    $wp_customize->add_setting( 'julius_contact_map_embed', array(
        'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0983994977997!2d108.24!3d16.05!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDAzJzAwLjAiTiAxMDjCsDE0JzI0LjAiRQ!5e0!3m2!1sen!2s!4v1234567890',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_map_embed', array(
        'label'       => __( 'Google Maps Embed URL', 'julius-theme' ),
        'description' => __( 'Paste the full Google Maps embed URL here', 'julius-theme' ),
        'section'     => 'julius_contact_map_section',
        'type'        => 'url',
        'priority'    => 40,
    ) );

    // ===================================
    // CTA Section
    // ===================================
    $wp_customize->add_section( 'julius_contact_cta_section', array(
        'title'    => __( 'CTA Section', 'julius-theme' ),
        'panel'    => 'julius_contact_panel',
        'priority' => 30,
    ) );

    // CTA Background Image
    $wp_customize->add_setting( 'julius_contact_cta_image', array(
        'default'           => 47,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_contact_cta_image', array(
        'label'       => __( 'CTA Background Image', 'julius-theme' ),
        'description' => __( 'Upload or select the CTA background image', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // CTA Title
    $wp_customize->add_setting( 'julius_contact_cta_title', array(
        'default'           => 'Ready to Experience True Relaxation?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_cta_title', array(
        'label'       => __( 'CTA Title', 'julius-theme' ),
        'description' => __( 'Main call-to-action title', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // CTA Description
    $wp_customize->add_setting( 'julius_contact_cta_description', array(
        'default'           => 'Book your appointment today and let our expert therapists transport you to a world of tranquility.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_cta_description', array(
        'label'       => __( 'CTA Description', 'julius-theme' ),
        'description' => __( 'Description text below the title', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'type'        => 'textarea',
        'priority'    => 30,
    ) );

    // CTA Primary Button Text
    $wp_customize->add_setting( 'julius_contact_cta_button1_text', array(
        'default'           => 'View Our Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_cta_button1_text', array(
        'label'       => __( 'Primary Button Text', 'julius-theme' ),
        'description' => __( 'Text for the first button', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'type'        => 'text',
        'priority'    => 40,
    ) );

    // CTA Primary Button Link
    $wp_customize->add_setting( 'julius_contact_cta_button1_link', array(
        'default'           => '/services',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_cta_button1_link', array(
        'label'       => __( 'Primary Button Link', 'julius-theme' ),
        'description' => __( 'URL for the first button (relative or absolute)', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'type'        => 'url',
        'priority'    => 50,
    ) );

    // CTA Secondary Button Text
    $wp_customize->add_setting( 'julius_contact_cta_button2_text', array(
        'default'           => 'Call Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_contact_cta_button2_text', array(
        'label'       => __( 'Secondary Button Text', 'julius-theme' ),
        'description' => __( 'Text for the second button (calls phone number)', 'julius-theme' ),
        'section'     => 'julius_contact_cta_section',
        'type'        => 'text',
        'priority'    => 60,
    ) );
}
add_action( 'customize_register', 'julius_contact_customizer_register' );
