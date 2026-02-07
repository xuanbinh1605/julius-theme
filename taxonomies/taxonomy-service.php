<?php
/**
 * Service Taxonomy
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Service Taxonomy
 */
function julius_register_service_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Service Categories', 'Taxonomy General Name', 'julius-theme' ),
        'singular_name'              => _x( 'Service Category', 'Taxonomy Singular Name', 'julius-theme' ),
        'menu_name'                  => __( 'Categories', 'julius-theme' ),
        'all_items'                  => __( 'All Categories', 'julius-theme' ),
        'parent_item'                => __( 'Parent Category', 'julius-theme' ),
        'parent_item_colon'          => __( 'Parent Category:', 'julius-theme' ),
        'new_item_name'              => __( 'New Category Name', 'julius-theme' ),
        'add_new_item'               => __( 'Add New Category', 'julius-theme' ),
        'edit_item'                  => __( 'Edit Category', 'julius-theme' ),
        'update_item'                => __( 'Update Category', 'julius-theme' ),
        'view_item'                  => __( 'View Category', 'julius-theme' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'julius-theme' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'julius-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'julius-theme' ),
        'popular_items'              => __( 'Popular Categories', 'julius-theme' ),
        'search_items'               => __( 'Search Categories', 'julius-theme' ),
        'not_found'                  => __( 'Not Found', 'julius-theme' ),
        'no_terms'                   => __( 'No categories', 'julius-theme' ),
        'items_list'                 => __( 'Categories list', 'julius-theme' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'julius-theme' ),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'service-category' ),
    );
    
    register_taxonomy( 'service_category', array( 'service' ), $args );
}
add_action( 'init', 'julius_register_service_taxonomy' );
