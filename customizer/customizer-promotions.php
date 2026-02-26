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

    // Happy Hour Settings
    $wp_customize->add_setting( 'julius_promo_happy_badge', array(
        'default'           => 'Best Deal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_badge', array(
        'label'    => __( 'Happy Hour Badge Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_time', array(
        'default'           => '9:00 - 16:00',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_time', array(
        'label'    => __( 'Happy Hour Time', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 50,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_label', array(
        'default'           => 'Happy Hour',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_label', array(
        'label'    => __( 'Happy Hour Label', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 60,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_discount', array(
        'default'           => '30% OFF',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_discount', array(
        'label'    => __( 'Happy Hour Discount Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 70,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_text1', array(
        'default'           => 'all services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_text1', array(
        'label'    => __( 'Happy Hour Detail 1', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 80,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_text2', array(
        'default'           => 'No pick-drop service',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_text2', array(
        'label'    => __( 'Happy Hour Detail 2', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 90,
    ) );

    $wp_customize->add_setting( 'julius_promo_happy_text3', array(
        'default'           => 'Aroma 90min only 343,000 VND (Tip separate)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_happy_text3', array(
        'label'    => __( 'Happy Hour Detail 3', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 100,
    ) );

    // Evening Settings
    $wp_customize->add_setting( 'julius_promo_evening_time', array(
        'default'           => '16:01 - 22:00',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_time', array(
        'label'    => __( 'Evening Time', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 110,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_label', array(
        'default'           => 'Evening',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_label', array(
        'label'    => __( 'Evening Label', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 120,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option1_label', array(
        'default'           => 'Option 1:',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option1_label', array(
        'label'    => __( 'Evening Option 1 Label', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 130,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option1_discount', array(
        'default'           => '20% OFF',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option1_discount', array(
        'label'    => __( 'Evening Option 1 Discount', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 140,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option1_text', array(
        'default'           => 'all courses on menu (No pick-drop)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option1_text', array(
        'label'    => __( 'Evening Option 1 Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 150,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option2_label', array(
        'default'           => 'Option 2:',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option2_label', array(
        'label'    => __( 'Evening Option 2 Label', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 160,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option2_highlight', array(
        'default'           => 'FREE pick-drop service',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option2_highlight', array(
        'label'    => __( 'Evening Option 2 Highlight', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 170,
    ) );

    $wp_customize->add_setting( 'julius_promo_evening_option2_text', array(
        'default'           => 'for 2+ people within Da Nang city (No discount)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_evening_option2_text', array(
        'label'    => __( 'Evening Option 2 Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 180,
    ) );

    // Late Night Settings
    $wp_customize->add_setting( 'julius_promo_night_time', array(
        'default'           => 'After 22:00',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_night_time', array(
        'label'    => __( 'Late Night Time', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 190,
    ) );

    $wp_customize->add_setting( 'julius_promo_night_label', array(
        'default'           => 'Late Night',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_night_label', array(
        'label'    => __( 'Late Night Label', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 200,
    ) );

    $wp_customize->add_setting( 'julius_promo_night_text', array(
        'default'           => 'NO discount & NO pick-drop service',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_night_text', array(
        'label'    => __( 'Late Night Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 210,
    ) );

    // Group Special Settings
    $wp_customize->add_setting( 'julius_promo_group_title', array(
        'default'           => 'Julius Signature Spa (Julius 2)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_title', array(
        'label'    => __( 'Group Special Title', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 220,
    ) );

    $wp_customize->add_setting( 'julius_promo_group_subtitle', array(
        'default'           => 'Group Special',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_subtitle', array(
        'label'    => __( 'Group Special Subtitle', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 230,
    ) );

    $wp_customize->add_setting( 'julius_promo_group_offer1', array(
        'default'           => 'FREE pickup',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_offer1', array(
        'label'    => __( 'Group Offer 1 Highlight', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 240,
    ) );

    $wp_customize->add_setting( 'julius_promo_group_offer1_text', array(
        'default'           => 'within Da Nang for group of 4',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_offer1_text', array(
        'label'    => __( 'Group Offer 1 Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 250,
    ) );

    $wp_customize->add_setting( 'julius_promo_group_offer2', array(
        'default'           => 'FREE 1 person',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_offer2', array(
        'label'    => __( 'Group Offer 2 Highlight', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 260,
    ) );

    $wp_customize->add_setting( 'julius_promo_group_offer2_text', array(
        'default'           => 'for group of 5+ (no pickup)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_group_offer2_text', array(
        'label'    => __( 'Group Offer 2 Text', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 270,
    ) );

    // Additional Notes
    $wp_customize->add_setting( 'julius_promo_note1', array(
        'default'           => '5% more discount for re-visit (not for happy hour event)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_note1', array(
        'label'    => __( 'Additional Note 1', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 280,
    ) );

    $wp_customize->add_setting( 'julius_promo_note2', array(
        'default'           => '5% more discount if review (not for re-visit) - 1 review DC for 2-3 people',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_note2', array(
        'label'    => __( 'Additional Note 2', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 290,
    ) );

    $wp_customize->add_setting( 'julius_promo_note3', array(
        'default'           => 'Car surcharge in case pick-drop address outside Da Nang city',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'julius_promo_note3', array(
        'label'    => __( 'Additional Note 3', 'julius-theme' ),
        'section'  => 'julius_promotions_section',
        'type'     => 'text',
        'priority' => 300,
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
