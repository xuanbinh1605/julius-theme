<?php
/**
 * Promotions Section Customizer Settings
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Promotions Customizer Settings
 */
function julius_promotions_customizer_register( $wp_customize ) {
    
    // Promotions Section
    $wp_customize->add_section( 'julius_promotions_section', array(
        'title'       => __( 'Promotions Section', 'julius-theme' ),
        'description' => __( 'Customize the promotions section on the homepage', 'julius-theme' ),
        'panel'       => 'julius_homepage_panel',
        'priority'    => 25,
    ) );

    // Section Header
    $wp_customize->add_setting( 'julius_promo_subtitle', array(
        'default'           => 'Special Offers',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_subtitle', array(
        'label'    => __( 'Section Subtitle', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'julius_promo_title', array(
        'default'           => 'Julius Promotion',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_title', array(
        'label'    => __( 'Section Title', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 20,
    ) );

    $wp_customize->add_setting( 'julius_promo_description', array(
        'default'           => 'Julius 1 & Julius Signature (Julius 2)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_description', array(
        'label'    => __( 'Section Description', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 30,
    ) );


    // Group Special Image Settings
    $wp_customize->add_setting( 'julius_promo_group_image', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'julius_promo_group_image', array(
        'label'       => __( 'Group Special Banner Image', 'julius-theme' ),
        'description' => __( 'Upload the banner image shown below the promotion cards.', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'mime_type'   => 'image',
        'priority'    => 220,
    ) ) );

    $wp_customize->add_setting( 'julius_promo_group_image_alt', array(
        'default'           => 'Julius promotion group special banner',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_image_alt', array(
        'label'       => __( 'Group Special Image Label', 'julius-theme' ),
        'description' => __( 'Used for accessibility on the banner image.', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'type'        => 'text',
        'priority'    => 230,
    ) );

    // Location 1
    $wp_customize->add_setting( 'julius_promo_loc1_name', array(
        'default'           => 'Julius 1',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc1_name', array(
        'label'    => __( 'Location 1 Name', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 310,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc1_address', array(
        'default'           => '05 An Thuong 38, Da Nang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc1_address', array(
        'label'    => __( 'Location 1 Address', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 320,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc1_phone', array(
        'default'           => '0775509057',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc1_phone', array(
        'label'       => __( 'Location 1 Phone (for tel: link)', 'julius-theme' ),
        'description' => __( 'No spaces or special characters', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'type'        => 'text',
        'priority'    => 330,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc1_phone_display', array(
        'default'           => '0775 509 057',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc1_phone_display', array(
        'label'       => __( 'Location 1 Phone Display', 'julius-theme' ),
        'description' => __( 'How the phone number appears', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'type'        => 'text',
        'priority'    => 340,
    ) );

    // Location 2
    $wp_customize->add_setting( 'julius_promo_loc2_name', array(
        'default'           => 'Julius 2',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc2_name', array(
        'label'    => __( 'Location 2 Name', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 350,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc2_address', array(
        'default'           => '61 Ta My Duat, Da Nang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc2_address', array(
        'label'    => __( 'Location 2 Address', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 360,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc2_phone', array(
        'default'           => '0787509157',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc2_phone', array(
        'label'       => __( 'Location 2 Phone (for tel: link)', 'julius-theme' ),
        'description' => __( 'No spaces or special characters', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'type'        => 'text',
        'priority'    => 370,
    ) );

    $wp_customize->add_setting( 'julius_promo_loc2_phone_display', array(
        'default'           => '0787 509 157',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_loc2_phone_display', array(
        'label'       => __( 'Location 2 Phone Display', 'julius-theme' ),
        'description' => __( 'How the phone number appears', 'julius-theme' ),
        'section'     => 'julius_promotions_section',
        'type'        => 'text',
        'priority'    => 380,
    ) );

    // Book Now Button
    $wp_customize->add_setting( 'julius_promo_button_text', array(
        'default'           => 'Book Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_button_text', array(
        'label'    => __( 'Button Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 390,
    ) );

    $wp_customize->add_setting( 'julius_promo_button_link', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_button_link', array(
        'label'    => __( 'Button Link', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'url',
        'priority' => 400,
    ) );
}
add_action( 'customize_register', 'julius_promotions_customizer_register' );
