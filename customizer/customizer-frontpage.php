<?php
/**
 * Front Page Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Front Page Customizer Settings
 */
function julius_frontpage_customizer_register( $wp_customize ) {
    
    // Add Homepage Panel
    $wp_customize->add_panel( 'julius_homepage_panel', array(
        'title'       => __( 'Homepage Settings', 'julius-theme' ),
        'description' => __( 'Customize your homepage sections', 'julius-theme' ),
        'priority'    => 30,
    ) );

    // Hero Section
    $wp_customize->add_section( 'julius_hero_section', array(
        'title'    => __( 'Hero Slider Settings', 'julius-theme' ),
        'panel'    => 'julius_homepage_panel',
        'priority' => 10,
    ) );

    // Hero Slide 1 Image
    $wp_customize->add_setting( 'julius_hero_image_1', array(
        'default'           => 21,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_hero_image_1', array(
        'label'       => __( 'Hero Image 1 (Day Exterior)', 'julius-theme' ),
        'description' => __( 'Upload or select the first hero slider image', 'julius-theme' ),
        'section'     => 'julius_hero_section',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // Hero Slide 2 Image
    $wp_customize->add_setting( 'julius_hero_image_2', array(
        'default'           => 22,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_hero_image_2', array(
        'label'       => __( 'Hero Image 2 (Night with Lanterns)', 'julius-theme' ),
        'description' => __( 'Upload or select the second hero slider image', 'julius-theme' ),
        'section'     => 'julius_hero_section',
        'mime_type'   => 'image',
        'priority'    => 20,
    ) ) );

    // Hero Slide 3 Image
    $wp_customize->add_setting( 'julius_hero_image_3', array(
        'default'           => 23,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_hero_image_3', array(
        'label'       => __( 'Hero Image 3 (Entrance)', 'julius-theme' ),
        'description' => __( 'Upload or select the third hero slider image', 'julius-theme' ),
        'section'     => 'julius_hero_section',
        'mime_type'   => 'image',
        'priority'    => 30,
    ) ) );

    // Hero Slide 4 Image
    $wp_customize->add_setting( 'julius_hero_image_4', array(
        'default'           => 24,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_hero_image_4', array(
        'label'       => __( 'Hero Image 4 (Night Colorful Lanterns)', 'julius-theme' ),
        'description' => __( 'Upload or select the fourth hero slider image', 'julius-theme' ),
        'section'     => 'julius_hero_section',
        'mime_type'   => 'image',
        'priority'    => 40,
    ) ) );

    // Hero Title
    $wp_customize->add_setting( 'julius_hero_title', array(
        'default'           => 'Julius Spa',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_title', array(
        'label'    => __( 'Hero Title', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'text',
        'priority' => 50,
    ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'julius_hero_subtitle', array(
        'default'           => 'Welcome to',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_subtitle', array(
        'label'    => __( 'Hero Subtitle', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'text',
        'priority' => 60,
    ) );

    // Hero Description
    $wp_customize->add_setting( 'julius_hero_description', array(
        'default'           => 'Experience authentic Vietnamese relaxation in a beautiful traditional setting. Body massage, foot massage, shampoo, and ear cleaning services.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_description', array(
        'label'    => __( 'Hero Description', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'textarea',
        'priority' => 70,
    ) );

    // Hero Button 1 Text
    $wp_customize->add_setting( 'julius_hero_button_1_text', array(
        'default'           => 'Book Your Session',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_button_1_text', array(
        'label'    => __( 'Primary Button Text', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'text',
        'priority' => 80,
    ) );

    // Hero Button 1 Link
    $wp_customize->add_setting( 'julius_hero_button_1_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_button_1_link', array(
        'label'    => __( 'Primary Button Link', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'url',
        'priority' => 90,
    ) );

    // Hero Button 2 Text
    $wp_customize->add_setting( 'julius_hero_button_2_text', array(
        'default'           => 'View Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_button_2_text', array(
        'label'    => __( 'Secondary Button Text', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'text',
        'priority' => 100,
    ) );

    // Hero Button 2 Link
    $wp_customize->add_setting( 'julius_hero_button_2_link', array(
        'default'           => '#services',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_hero_button_2_link', array(
        'label'    => __( 'Secondary Button Link', 'julius-theme' ),
        'section'  => 'julius_hero_section',
        'type'     => 'url',
        'priority' => 110,
    ) );

}
add_action( 'customize_register', 'julius_frontpage_customizer_register' );
