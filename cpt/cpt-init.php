<?php
/**
 * Custom Post Types Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types
 */
function julius_register_custom_post_types() {
    // Register Services CPT
    $labels = array(
        'name'                  => _x( 'Services', 'Post Type General Name', 'julius-theme' ),
        'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'julius-theme' ),
        'menu_name'             => __( 'Services', 'julius-theme' ),
        'name_admin_bar'        => __( 'Service', 'julius-theme' ),
        'archives'              => __( 'Service Archives', 'julius-theme' ),
        'attributes'            => __( 'Service Attributes', 'julius-theme' ),
        'parent_item_colon'     => __( 'Parent Service:', 'julius-theme' ),
        'all_items'             => __( 'All Services', 'julius-theme' ),
        'add_new_item'          => __( 'Add New Service', 'julius-theme' ),
        'add_new'               => __( 'Add New', 'julius-theme' ),
        'new_item'              => __( 'New Service', 'julius-theme' ),
        'edit_item'             => __( 'Edit Service', 'julius-theme' ),
        'update_item'           => __( 'Update Service', 'julius-theme' ),
        'view_item'             => __( 'View Service', 'julius-theme' ),
        'view_items'            => __( 'View Services', 'julius-theme' ),
        'search_items'          => __( 'Search Service', 'julius-theme' ),
        'not_found'             => __( 'Not found', 'julius-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'julius-theme' ),
        'featured_image'        => __( 'Service Image', 'julius-theme' ),
        'set_featured_image'    => __( 'Set service image', 'julius-theme' ),
        'remove_featured_image' => __( 'Remove service image', 'julius-theme' ),
        'use_featured_image'    => __( 'Use as service image', 'julius-theme' ),
        'insert_into_item'      => __( 'Insert into service', 'julius-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this service', 'julius-theme' ),
        'items_list'            => __( 'Services list', 'julius-theme' ),
        'items_list_navigation' => __( 'Services list navigation', 'julius-theme' ),
        'filter_items_list'     => __( 'Filter services list', 'julius-theme' ),
    );
    
    $args = array(
        'label'                 => __( 'Service', 'julius-theme' ),
        'description'           => __( 'Spa and wellness services', 'julius-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies'            => array( 'service_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-palmtree',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'services' ),
    );
    
    register_post_type( 'service', $args );
}
add_action( 'init', 'julius_register_custom_post_types' );

/**
 * Include Service Taxonomy
 */
if ( file_exists( JULIUS_THEME_DIR . '/taxonomies/taxonomy-service.php' ) ) {
    require_once JULIUS_THEME_DIR . '/taxonomies/taxonomy-service.php';
}

/**
 * Include Blog Post Type
 */
if ( file_exists( JULIUS_THEME_DIR . '/cpt/cpt-blog.php' ) ) {
    require_once JULIUS_THEME_DIR . '/cpt/cpt-blog.php';
}

/**
 * Include Blog Author Taxonomy
 */
if ( file_exists( JULIUS_THEME_DIR . '/taxonomies/taxonomy-blog-author.php' ) ) {
    require_once JULIUS_THEME_DIR . '/taxonomies/taxonomy-blog-author.php';
}
