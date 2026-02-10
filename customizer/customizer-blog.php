<?php
/**
 * Blog Archive Page Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Blog Archive Page Customizer Settings
 */
function julius_blog_archive_customizer_register( $wp_customize ) {
    
    // Add Blog Archive Panel
    $wp_customize->add_panel( 'julius_blog_archive_panel', array(
        'title'       => __( 'Blog Archive Settings', 'julius-theme' ),
        'description' => __( 'Customize your blog archive page sections', 'julius-theme' ),
        'priority'    => 35,
    ) );

    // ===================================
    // Hero Section
    // ===================================
    $wp_customize->add_section( 'julius_blog_hero_section', array(
        'title'    => __( 'Hero Section', 'julius-theme' ),
        'panel'    => 'julius_blog_archive_panel',
        'priority' => 10,
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'julius_blog_hero_image', array(
        'default'           => 'https://picsum.photos/seed/blog-hero/1920/800',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'julius_blog_hero_image', array(
        'label'       => __( 'Hero Background Image', 'julius-theme' ),
        'description' => __( 'Upload or select the hero background image for blog archive', 'julius-theme' ),
        'section'     => 'julius_blog_hero_section',
        'priority'    => 10,
    ) ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'julius_blog_hero_subtitle', array(
        'default'           => 'Our Blog',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_hero_subtitle', array(
        'label'       => __( 'Hero Subtitle', 'julius-theme' ),
        'description' => __( 'Small uppercase text above the title', 'julius-theme' ),
        'section'     => 'julius_blog_hero_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // Hero Title
    $wp_customize->add_setting( 'julius_blog_hero_title', array(
        'default'           => 'Wellness Insights',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_hero_title', array(
        'label'       => __( 'Hero Title', 'julius-theme' ),
        'description' => __( 'Main title text', 'julius-theme' ),
        'section'     => 'julius_blog_hero_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // Hero Description
    $wp_customize->add_setting( 'julius_blog_hero_description', array(
        'default'           => 'Tips, guides, and inspiration for your wellness journey',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_hero_description', array(
        'label'       => __( 'Hero Description', 'julius-theme' ),
        'description' => __( 'Description text below the title', 'julius-theme' ),
        'section'     => 'julius_blog_hero_section',
        'type'        => 'textarea',
        'priority'    => 40,
    ) );

    // ===================================
    // CTA Section
    // ===================================
    $wp_customize->add_section( 'julius_blog_cta_section', array(
        'title'    => __( 'CTA Section', 'julius-theme' ),
        'panel'    => 'julius_blog_archive_panel',
        'priority' => 20,
    ) );

    // CTA Title
    $wp_customize->add_setting( 'julius_blog_cta_title', array(
        'default'           => 'Ready to Experience True Relaxation?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_cta_title', array(
        'label'       => __( 'CTA Title', 'julius-theme' ),
        'description' => __( 'Call to action title', 'julius-theme' ),
        'section'     => 'julius_blog_cta_section',
        'type'        => 'text',
        'priority'    => 10,
    ) );

    // CTA Description
    $wp_customize->add_setting( 'julius_blog_cta_description', array(
        'default'           => 'Book your appointment today and let our expert therapists help you unwind.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_cta_description', array(
        'label'       => __( 'CTA Description', 'julius-theme' ),
        'description' => __( 'Call to action description', 'julius-theme' ),
        'section'     => 'julius_blog_cta_section',
        'type'        => 'textarea',
        'priority'    => 20,
    ) );

    // CTA Button 1 Text
    $wp_customize->add_setting( 'julius_blog_cta_button1_text', array(
        'default'           => 'Book Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_cta_button1_text', array(
        'label'       => __( 'Button 1 Text', 'julius-theme' ),
        'description' => __( 'Primary button text (links to contact page)', 'julius-theme' ),
        'section'     => 'julius_blog_cta_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );

    // CTA Button 2 Text
    $wp_customize->add_setting( 'julius_blog_cta_button2_text', array(
        'default'           => 'View Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_blog_cta_button2_text', array(
        'label'       => __( 'Button 2 Text', 'julius-theme' ),
        'description' => __( 'Secondary button text (links to services page)', 'julius-theme' ),
        'section'     => 'julius_blog_cta_section',
        'type'        => 'text',
        'priority'    => 40,
    ) );
}
add_action( 'customize_register', 'julius_blog_archive_customizer_register' );
