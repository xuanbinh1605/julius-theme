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

    // Our Services Section
    $wp_customize->add_section( 'julius_services_section', array(
        'title'    => __( 'Our Services Settings', 'julius-theme' ),
        'panel'    => 'julius_homepage_panel',
        'priority' => 20,
    ) );

    // Services Subtitle
    $wp_customize->add_setting( 'julius_services_subtitle', array(
        'default'           => 'Our Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_services_subtitle', array(
        'label'    => __( 'Services Subtitle', 'julius-theme' ),
        'section'  => 'julius_services_section',
        'type'     => 'text',
        'priority' => 10,
    ) );

    // Services Title
    $wp_customize->add_setting( 'julius_services_title', array(
        'default'           => 'Signature Spa Treatments',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_services_title', array(
        'label'    => __( 'Services Title', 'julius-theme' ),
        'section'  => 'julius_services_section',
        'type'     => 'text',
        'priority' => 20,
    ) );

    // Services Description
    $wp_customize->add_setting( 'julius_services_description', array(
        'default'           => 'Discover our range of authentic Vietnamese spa treatments designed to restore your body and mind to perfect harmony.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_services_description', array(
        'label'    => __( 'Services Description', 'julius-theme' ),
        'section'  => 'julius_services_section',
        'type'     => 'textarea',
        'priority' => 30,
    ) );

    // Services Count
    $wp_customize->add_setting( 'julius_services_count', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_services_count', array(
        'label'       => __( 'Number of Services to Display', 'julius-theme' ),
        'description' => __( 'How many services should be shown on the homepage?', 'julius-theme' ),
        'section'     => 'julius_services_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 12,
            'step' => 1,
        ),
        'priority'    => 40,
    ) );

    // Services Button Text
    $wp_customize->add_setting( 'julius_services_button_text', array(
        'default'           => 'View All Services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_services_button_text', array(
        'label'    => __( 'Button Text', 'julius-theme' ),
        'section'  => 'julius_services_section',
        'type'     => 'text',
        'priority' => 50,
    ) );

    // ========================================
    // About Us Section
    // ========================================
    
    $wp_customize->add_section( 'julius_about_section', array(
        'title'    => __( 'About Us Section', 'julius-theme' ),
        'panel'    => 'julius_homepage_panel',
        'priority' => 40,
    ) );

    // About Image 1
    $wp_customize->add_setting( 'julius_about_image_1', array(
        'default'           => 41,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_image_1', array(
        'label'     => __( 'About Image 1 (Top Left)', 'julius-theme' ),
        'section'   => 'julius_about_section',
        'mime_type' => 'image',
        'priority'  => 10,
    ) ) );

    // About Image 2
    $wp_customize->add_setting( 'julius_about_image_2', array(
        'default'           => 42,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_image_2', array(
        'label'     => __( 'About Image 2 (Top Right)', 'julius-theme' ),
        'section'   => 'julius_about_section',
        'mime_type' => 'image',
        'priority'  => 20,
    ) ) );

    // About Image 3
    $wp_customize->add_setting( 'julius_about_image_3', array(
        'default'           => 43,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_image_3', array(
        'label'     => __( 'About Image 3 (Bottom Left)', 'julius-theme' ),
        'section'   => 'julius_about_section',
        'mime_type' => 'image',
        'priority'  => 30,
    ) ) );

    // About Image 4
    $wp_customize->add_setting( 'julius_about_image_4', array(
        'default'           => 44,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_image_4', array(
        'label'     => __( 'About Image 4 (Bottom Right)', 'julius-theme' ),
        'section'   => 'julius_about_section',
        'mime_type' => 'image',
        'priority'  => 40,
    ) ) );

    // About Subtitle
    $wp_customize->add_setting( 'julius_about_subtitle', array(
        'default'           => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_subtitle', array(
        'label'    => __( 'Subtitle', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 50,
    ) );

    // About Title
    $wp_customize->add_setting( 'julius_about_title', array(
        'default'           => 'A Sanctuary of Peace & Wellness',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_title', array(
        'label'    => __( 'Title', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 60,
    ) );

    // About Description 1
    $wp_customize->add_setting( 'julius_about_description_1', array(
        'default'           => 'Nestled in the heart of Da Nang, Julius Spa offers an authentic Vietnamese wellness experience. Our beautifully designed space, adorned with traditional lanterns and warm yellow walls, creates the perfect atmosphere for relaxation.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_description_1', array(
        'label'    => __( 'Description Paragraph 1', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'textarea',
        'priority' => 70,
    ) );

    // About Description 2
    $wp_customize->add_setting( 'julius_about_description_2', array(
        'default'           => 'Our skilled therapists combine ancient Vietnamese techniques with modern wellness practices to deliver treatments that rejuvenate both body and soul. From body massage to foot reflexology, each service is tailored to your needs.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_description_2', array(
        'label'    => __( 'Description Paragraph 2', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'textarea',
        'priority' => 80,
    ) );

    // Stat 1 Value
    $wp_customize->add_setting( 'julius_about_stat_1_value', array(
        'default'           => '5+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_1_value', array(
        'label'    => __( 'Stat 1 Value', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 90,
    ) );

    // Stat 1 Label
    $wp_customize->add_setting( 'julius_about_stat_1_label', array(
        'default'           => 'Years Experience',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_1_label', array(
        'label'    => __( 'Stat 1 Label', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 100,
    ) );

    // Stat 2 Value
    $wp_customize->add_setting( 'julius_about_stat_2_value', array(
        'default'           => '10,000+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_2_value', array(
        'label'    => __( 'Stat 2 Value', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 110,
    ) );

    // Stat 2 Label
    $wp_customize->add_setting( 'julius_about_stat_2_label', array(
        'default'           => 'Happy Clients',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_2_label', array(
        'label'    => __( 'Stat 2 Label', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 120,
    ) );

    // Stat 3 Value
    $wp_customize->add_setting( 'julius_about_stat_3_value', array(
        'default'           => '9AM-10PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_3_value', array(
        'label'    => __( 'Stat 3 Value', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 130,
    ) );

    // Stat 3 Label
    $wp_customize->add_setting( 'julius_about_stat_3_label', array(
        'default'           => 'Open Daily',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_3_label', array(
        'label'    => __( 'Stat 3 Label', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 140,
    ) );

    // Stat 4 Value
    $wp_customize->add_setting( 'julius_about_stat_4_value', array(
        'default'           => '100%',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_4_value', array(
        'label'    => __( 'Stat 4 Value', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 150,
    ) );

    // Stat 4 Label
    $wp_customize->add_setting( 'julius_about_stat_4_label', array(
        'default'           => 'Satisfaction',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_stat_4_label', array(
        'label'    => __( 'Stat 4 Label', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 160,
    ) );

    // About Button Text
    $wp_customize->add_setting( 'julius_about_button_text', array(
        'default'           => 'Learn More About Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_button_text', array(
        'label'    => __( 'Button Text', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'text',
        'priority' => 170,
    ) );

    // About Button Link
    $wp_customize->add_setting( 'julius_about_button_link', array(
        'default'           => '/about',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_button_link', array(
        'label'    => __( 'Button Link', 'julius-theme' ),
        'section'  => 'julius_about_section',
        'type'     => 'url',
        'priority' => 180,
    ) );

    // ========================================
    // Gallery Section
    // ========================================
    
    $wp_customize->add_section( 'julius_gallery_section', array(
        'title'    => __( 'Gallery Section', 'julius-theme' ),
        'panel'    => 'julius_homepage_panel',
        'priority' => 50,
    ) );

    // Gallery Subtitle
    $wp_customize->add_setting( 'julius_gallery_subtitle', array(
        'default'           => 'Gallery',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_gallery_subtitle', array(
        'label'    => __( 'Subtitle', 'julius-theme' ),
        'section'  => 'julius_gallery_section',
        'type'     => 'text',
        'priority' => 10,
    ) );

    // Gallery Title
    $wp_customize->add_setting( 'julius_gallery_title', array(
        'default'           => 'Our Beautiful Space',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_gallery_title', array(
        'label'    => __( 'Title', 'julius-theme' ),
        'section'  => 'julius_gallery_section',
        'type'     => 'text',
        'priority' => 20,
    ) );

    // Gallery Description
    $wp_customize->add_setting( 'julius_gallery_description', array(
        'default'           => 'Step into our traditional Vietnamese-inspired sanctuary and experience the warmth and beauty of Julius Signature Spa.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_gallery_description', array(
        'label'    => __( 'Description', 'julius-theme' ),
        'section'  => 'julius_gallery_section',
        'type'     => 'textarea',
        'priority' => 30,
    ) );

    // Gallery Images Count
    $wp_customize->add_setting( 'julius_gallery_count', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_gallery_count', array(
        'label'       => __( 'Number of Images to Display', 'julius-theme' ),
        'description' => __( 'Manage gallery images from Gallery admin menu. This setting controls how many images are displayed.', 'julius-theme' ),
        'section'     => 'julius_gallery_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 50,
            'step' => 1,
        ),
        'priority'    => 40,
    ) );

    // ===========================
    // CTA Section
    // ===========================
    $wp_customize->add_section( 'julius_cta_section', array(
        'title'    => __( 'CTA Section', 'julius-theme' ),
        'panel'    => 'julius_homepage_panel',
        'priority' => 60,
    ) );

    // CTA Background Image
    $wp_customize->add_setting( 'julius_cta_image', array(
        'default'           => 24,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_cta_image', array(
        'label'       => __( 'Background Image', 'julius-theme' ),
        'description' => __( 'Upload or select the CTA background image', 'julius-theme' ),
        'section'     => 'julius_cta_section',
        'mime_type'   => 'image',
        'priority'    => 10,
    ) ) );

    // CTA Badge Text
    $wp_customize->add_setting( 'julius_cta_badge', array(
        'default'           => 'Special Offer: 15% OFF First Visit',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_badge', array(
        'label'    => __( 'Badge Text', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 20,
    ) );

    // CTA Heading Part 1
    $wp_customize->add_setting( 'julius_cta_heading_1', array(
        'default'           => 'Ready to Experience',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_heading_1', array(
        'label'    => __( 'Heading Part 1', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 30,
    ) );

    // CTA Heading Part 2 (Accent)
    $wp_customize->add_setting( 'julius_cta_heading_2', array(
        'default'           => 'True Relaxation?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_heading_2', array(
        'label'       => __( 'Heading Part 2 (Accent)', 'julius-theme' ),
        'description' => __( 'This text will be displayed in the accent color', 'julius-theme' ),
        'section'     => 'julius_cta_section',
        'type'        => 'text',
        'priority'    => 40,
    ) );

    // CTA Description
    $wp_customize->add_setting( 'julius_cta_description', array(
        'default'           => 'Book your appointment today and let our expert therapists transport you to a world of tranquility and wellness.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_description', array(
        'label'    => __( 'Description', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'textarea',
        'priority' => 50,
    ) );

    // CTA Phone Number
    $wp_customize->add_setting( 'julius_cta_phone', array(
        'default'           => '+84 123 456 789',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_phone', array(
        'label'    => __( 'Phone Number', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 60,
    ) );

    // CTA Open Hours
    $wp_customize->add_setting( 'julius_cta_hours', array(
        'default'           => '9:00 AM - 10:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_hours', array(
        'label'    => __( 'Open Hours', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 70,
    ) );

    // CTA Book Now Button Text
    $wp_customize->add_setting( 'julius_cta_button_1_text', array(
        'default'           => 'Book Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_button_1_text', array(
        'label'    => __( 'Book Now Button Text', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 80,
    ) );

    // CTA Book Now Button Link
    $wp_customize->add_setting( 'julius_cta_button_1_link', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_button_1_link', array(
        'label'    => __( 'Book Now Button Link', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'url',
        'priority' => 90,
    ) );

    // CTA View Menu Button Text
    $wp_customize->add_setting( 'julius_cta_button_2_text', array(
        'default'           => 'View Menu',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_cta_button_2_text', array(
        'label'    => __( 'View Menu Button Text', 'julius-theme' ),
        'section'  => 'julius_cta_section',
        'type'     => 'text',
        'priority' => 100,
    ) );

}
add_action( 'customize_register', 'julius_frontpage_customizer_register' );
