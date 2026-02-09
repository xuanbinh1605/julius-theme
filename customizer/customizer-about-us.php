<?php
/**
 * About Us Page Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add About Us Page Customizer Settings
 */
function julius_about_customizer_register( $wp_customize ) {
    
    // Add About Us Panel
    $wp_customize->add_panel( 'julius_about_panel', array(
        'title'       => __( 'About Us Page Settings', 'julius-theme' ),
        'description' => __( 'Customize your About Us page sections', 'julius-theme' ),
        'priority'    => 31,
    ) );

    // ==========================================
    // HERO SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_hero_section', array(
        'title'    => __( 'Hero Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 10,
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'julius_about_hero_image', array(
        'default'           => 43,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_hero_image', array(
        'label'       => __( 'Hero Background Image', 'julius-theme' ),
        'section'     => 'julius_about_hero_section',
        'mime_type'   => 'image',
    ) ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'julius_about_hero_subtitle', array(
        'default'           => 'Our Story',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_hero_subtitle', array(
        'label'    => __( 'Hero Subtitle', 'julius-theme' ),
        'section'  => 'julius_about_hero_section',
        'type'     => 'text',
    ) );

    // Hero Title
    $wp_customize->add_setting( 'julius_about_hero_title', array(
        'default'           => 'About Julius Spa',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_hero_title', array(
        'label'    => __( 'Hero Title', 'julius-theme' ),
        'section'  => 'julius_about_hero_section',
        'type'     => 'text',
    ) );

    // Hero Description
    $wp_customize->add_setting( 'julius_about_hero_description', array(
        'default'           => 'Discover the heart and soul behind Da Nang\'s premier wellness destination',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_hero_description', array(
        'label'    => __( 'Hero Description', 'julius-theme' ),
        'section'  => 'julius_about_hero_section',
        'type'     => 'textarea',
    ) );

    // ==========================================
    // JOURNEY & TRADITION SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_journey_section', array(
        'title'    => __( 'Journey & Tradition Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 20,
    ) );

    // Journey Image
    $wp_customize->add_setting( 'julius_about_journey_image', array(
        'default'           => 44,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_about_journey_image', array(
        'label'       => __( 'Section Image', 'julius-theme' ),
        'section'     => 'julius_about_journey_section',
        'mime_type'   => 'image',
    ) ) );

    // Journey Years Badge
    $wp_customize->add_setting( 'julius_about_journey_years', array(
        'default'           => '5+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_journey_years', array(
        'label'    => __( 'Years Badge', 'julius-theme' ),
        'section'  => 'julius_about_journey_section',
        'type'     => 'text',
    ) );

    // Journey Title
    $wp_customize->add_setting( 'julius_about_journey_title', array(
        'default'           => 'A Journey of Wellness & Tradition',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_journey_title', array(
        'label'    => __( 'Section Title', 'julius-theme' ),
        'section'  => 'julius_about_journey_section',
        'type'     => 'text',
    ) );

    // Journey Paragraph 1
    $wp_customize->add_setting( 'julius_about_journey_para1', array(
        'default'           => 'Founded in 2019, Julius Spa was born from a passion to share the ancient art of Vietnamese massage and wellness traditions with visitors and locals alike. Nestled in the heart of Da Nang, our spa has become a sanctuary for those seeking authentic relaxation experiences.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_journey_para1', array(
        'label'    => __( 'Paragraph 1', 'julius-theme' ),
        'section'  => 'julius_about_journey_section',
        'type'     => 'textarea',
    ) );

    // Journey Paragraph 2
    $wp_customize->add_setting( 'julius_about_journey_para2', array(
        'default'           => 'Our founder, with over 15 years of experience in traditional Vietnamese healing practices, envisioned a space where guests could escape the hustle of daily life and immerse themselves in tranquility. Every detail of Julius Spa - from the warm golden walls to the handcrafted massage beds - reflects our commitment to creating an atmosphere of peace and rejuvenation.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_journey_para2', array(
        'label'    => __( 'Paragraph 2', 'julius-theme' ),
        'section'  => 'julius_about_journey_section',
        'type'     => 'textarea',
    ) );

    // Journey Paragraph 3
    $wp_customize->add_setting( 'julius_about_journey_para3', array(
        'default'           => 'Today, we continue to honor these traditions while embracing modern wellness techniques, ensuring every guest receives a truly memorable spa experience.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_about_journey_para3', array(
        'label'    => __( 'Paragraph 3', 'julius-theme' ),
        'section'  => 'julius_about_journey_section',
        'type'     => 'textarea',
    ) );

    // ==========================================
    // STATS SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_stats_section', array(
        'title'    => __( 'Stats Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 30,
    ) );

    // Stat 1
    $wp_customize->add_setting( 'julius_about_stat1_number', array(
        'default'           => '5+',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat1_number', array(
        'label'    => __( 'Stat 1 Number', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_stat1_label', array(
        'default'           => 'Years Experience',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat1_label', array(
        'label'    => __( 'Stat 1 Label', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    // Stat 2
    $wp_customize->add_setting( 'julius_about_stat2_number', array(
        'default'           => '10,000+',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat2_number', array(
        'label'    => __( 'Stat 2 Number', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_stat2_label', array(
        'default'           => 'Happy Customers',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat2_label', array(
        'label'    => __( 'Stat 2 Label', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    // Stat 3
    $wp_customize->add_setting( 'julius_about_stat3_number', array(
        'default'           => '15+',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat3_number', array(
        'label'    => __( 'Stat 3 Number', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_stat3_label', array(
        'default'           => 'Expert Therapists',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat3_label', array(
        'label'    => __( 'Stat 3 Label', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    // Stat 4
    $wp_customize->add_setting( 'julius_about_stat4_number', array(
        'default'           => '100%',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat4_number', array(
        'label'    => __( 'Stat 4 Number', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_stat4_label', array(
        'default'           => 'Satisfaction Rate',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_stat4_label', array(
        'label'    => __( 'Stat 4 Label', 'julius-theme' ),
        'section'  => 'julius_about_stats_section',
        'type'     => 'text',
    ) );

    // ==========================================
    // CORE VALUES SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_values_section', array(
        'title'    => __( 'Core Values Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 40,
    ) );

    // Section Header
    $wp_customize->add_setting( 'julius_about_values_subtitle', array(
        'default'           => 'What We Believe',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_values_subtitle', array(
        'label'    => __( 'Section Subtitle', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_values_title', array(
        'default'           => 'Our Core Values',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_values_title', array(
        'label'    => __( 'Section Title', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_values_description', array(
        'default'           => 'These principles guide everything we do at Julius Spa',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_values_description', array(
        'label'    => __( 'Section Description', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'textarea',
    ) );

    // Value 1
    $wp_customize->add_setting( 'julius_about_value1_title', array(
        'default'           => 'Passion for Wellness',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_value1_title', array(
        'label'    => __( 'Value 1 Title', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_value1_desc', array(
        'default'           => 'We are dedicated to helping you achieve complete relaxation and rejuvenation through authentic Vietnamese spa traditions.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_value1_desc', array(
        'label'    => __( 'Value 1 Description', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'textarea',
    ) );

    // Value 2
    $wp_customize->add_setting( 'julius_about_value2_title', array(
        'default'           => 'Natural Products',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_value2_title', array(
        'label'    => __( 'Value 2 Title', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_value2_desc', array(
        'default'           => 'We use only premium natural oils, herbs, and organic ingredients sourced from local Vietnamese suppliers.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_value2_desc', array(
        'label'    => __( 'Value 2 Description', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'textarea',
    ) );

    // Value 3
    $wp_customize->add_setting( 'julius_about_value3_title', array(
        'default'           => 'Expert Therapists',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_value3_title', array(
        'label'    => __( 'Value 3 Title', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_value3_desc', array(
        'default'           => 'Our skilled team has years of experience in traditional massage techniques, ensuring the highest quality service.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_value3_desc', array(
        'label'    => __( 'Value 3 Description', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'textarea',
    ) );

    // Value 4
    $wp_customize->add_setting( 'julius_about_value4_title', array(
        'default'           => 'Safe & Hygienic',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_value4_title', array(
        'label'    => __( 'Value 4 Title', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_value4_desc', array(
        'default'           => 'Your health is our priority. We maintain the highest standards of cleanliness and hygiene in all our facilities.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_value4_desc', array(
        'label'    => __( 'Value 4 Description', 'julius-theme' ),
        'section'  => 'julius_about_values_section',
        'type'     => 'textarea',
    ) );

    // ==========================================
    // JULIUS SPA DIFFERENCE SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_difference_section', array(
        'title'    => __( 'Julius Spa Difference Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 50,
    ) );

    // Section Header
    $wp_customize->add_setting( 'julius_about_diff_subtitle', array(
        'default'           => 'Why Julius Spa',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff_subtitle', array(
        'label'    => __( 'Section Subtitle', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_diff_title', array(
        'default'           => 'The Julius Spa Difference',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff_title', array(
        'label'    => __( 'Section Title', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    // Feature 1
    $wp_customize->add_setting( 'julius_about_diff1_title', array(
        'default'           => '5-Star Service',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff1_title', array(
        'label'    => __( 'Feature 1 Title', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_diff1_desc', array(
        'default'           => 'Every guest receives personalized attention and premium care from arrival to departure.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff1_desc', array(
        'label'    => __( 'Feature 1 Description', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'textarea',
    ) );

    // Feature 2
    $wp_customize->add_setting( 'julius_about_diff2_title', array(
        'default'           => 'Award-Winning Quality',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff2_title', array(
        'label'    => __( 'Feature 2 Title', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_diff2_desc', array(
        'default'           => 'Recognized by Da Nang Tourism for excellence in spa services and customer satisfaction.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff2_desc', array(
        'label'    => __( 'Feature 2 Description', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'textarea',
    ) );

    // Feature 3
    $wp_customize->add_setting( 'julius_about_diff3_title', array(
        'default'           => 'Flexible Hours',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff3_title', array(
        'label'    => __( 'Feature 3 Title', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_diff3_desc', array(
        'default'           => 'Open from 9:00 AM to 10:00 PM daily to accommodate your busy schedule.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff3_desc', array(
        'label'    => __( 'Feature 3 Description', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'textarea',
    ) );

    // Feature 4
    $wp_customize->add_setting( 'julius_about_diff4_title', array(
        'default'           => 'Authentic Experience',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff4_title', array(
        'label'    => __( 'Feature 4 Title', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_diff4_desc', array(
        'default'           => 'Traditional Vietnamese techniques combined with modern wellness practices.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_diff4_desc', array(
        'label'    => __( 'Feature 4 Description', 'julius-theme' ),
        'section'  => 'julius_about_difference_section',
        'type'     => 'textarea',
    ) );

    // ==========================================
    // OUR SPACE SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_space_section', array(
        'title'    => __( 'Our Space Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 60,
    ) );

    $wp_customize->add_setting( 'julius_about_space_subtitle', array(
        'default'           => 'Our Space',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_space_subtitle', array(
        'label'    => __( 'Section Subtitle', 'julius-theme' ),
        'section'  => 'julius_about_space_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_space_title', array(
        'default'           => 'Experience Julius Spa',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_space_title', array(
        'label'    => __( 'Section Title', 'julius-theme' ),
        'section'  => 'julius_about_space_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_space_description', array(
        'default'           => 'Step into our tranquil sanctuary designed for your complete relaxation',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_space_description', array(
        'label'       => __( 'Section Description', 'julius-theme' ),
        'description' => __( 'Note: Images are managed in the "Our Space" admin menu', 'julius-theme' ),
        'section'     => 'julius_about_space_section',
        'type'        => 'textarea',
    ) );

    // ==========================================
    // CTA SECTION
    // ==========================================
    $wp_customize->add_section( 'julius_about_cta_section', array(
        'title'    => __( 'Call to Action Section', 'julius-theme' ),
        'panel'    => 'julius_about_panel',
        'priority' => 70,
    ) );

    $wp_customize->add_setting( 'julius_about_cta_title', array(
        'default'           => 'Ready to Experience True Relaxation?',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_cta_title', array(
        'label'    => __( 'CTA Title', 'julius-theme' ),
        'section'  => 'julius_about_cta_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_cta_description', array(
        'default'           => 'Book your appointment today and let our expert therapists transport you to a world of tranquility and wellness.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'julius_about_cta_description', array(
        'label'    => __( 'CTA Description', 'julius-theme' ),
        'section'  => 'julius_about_cta_section',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'julius_about_cta_button1_text', array(
        'default'           => 'Book Now',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_cta_button1_text', array(
        'label'    => __( 'Primary Button Text', 'julius-theme' ),
        'section'  => 'julius_about_cta_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'julius_about_cta_button2_text', array(
        'default'           => 'View Services',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'julius_about_cta_button2_text', array(
        'label'    => __( 'Secondary Button Text', 'julius-theme' ),
        'section'  => 'julius_about_cta_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'julius_about_customizer_register' );
