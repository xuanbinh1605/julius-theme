<?php
/**
 * Blog Post Type
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Blog Post Type
 */
function julius_register_blog_post_type() {
    $labels = array(
        'name'                  => _x( 'Blog Posts', 'Post Type General Name', 'julius-theme' ),
        'singular_name'         => _x( 'Blog Post', 'Post Type Singular Name', 'julius-theme' ),
        'menu_name'             => __( 'Blog', 'julius-theme' ),
        'name_admin_bar'        => __( 'Blog Post', 'julius-theme' ),
        'archives'              => __( 'Blog Archives', 'julius-theme' ),
        'attributes'            => __( 'Blog Attributes', 'julius-theme' ),
        'parent_item_colon'     => __( 'Parent Blog Post:', 'julius-theme' ),
        'all_items'             => __( 'All Posts', 'julius-theme' ),
        'add_new_item'          => __( 'Add New Post', 'julius-theme' ),
        'add_new'               => __( 'Add New', 'julius-theme' ),
        'new_item'              => __( 'New Post', 'julius-theme' ),
        'edit_item'             => __( 'Edit Post', 'julius-theme' ),
        'update_item'           => __( 'Update Post', 'julius-theme' ),
        'view_item'             => __( 'View Post', 'julius-theme' ),
        'view_items'            => __( 'View Posts', 'julius-theme' ),
        'search_items'          => __( 'Search Post', 'julius-theme' ),
        'not_found'             => __( 'Not found', 'julius-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'julius-theme' ),
        'featured_image'        => __( 'Featured Image', 'julius-theme' ),
        'set_featured_image'    => __( 'Set featured image', 'julius-theme' ),
        'remove_featured_image' => __( 'Remove featured image', 'julius-theme' ),
        'use_featured_image'    => __( 'Use as featured image', 'julius-theme' ),
        'insert_into_item'      => __( 'Insert into post', 'julius-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this post', 'julius-theme' ),
        'items_list'            => __( 'Posts list', 'julius-theme' ),
        'items_list_navigation' => __( 'Posts list navigation', 'julius-theme' ),
        'filter_items_list'     => __( 'Filter posts list', 'julius-theme' ),
    );
    
    $args = array(
        'label'                 => __( 'Blog Post', 'julius-theme' ),
        'description'           => __( 'Blog posts and articles', 'julius-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'post-tag' ),
        'taxonomies'            => array( 'blog_author', 'blog_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-edit-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'blog',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'blog' ),
    );
    
    register_post_type( 'blog_post', $args );
}
add_action( 'init', 'julius_register_blog_post_type' );

/**
 * Register Blog Author Taxonomy (Hierarchical)
 */
function julius_register_blog_author_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Authors', 'Taxonomy General Name', 'julius-theme' ),
        'singular_name'              => _x( 'Author', 'Taxonomy Singular Name', 'julius-theme' ),
        'menu_name'                  => __( 'Authors', 'julius-theme' ),
        'all_items'                  => __( 'All Authors', 'julius-theme' ),
        'parent_item'                => __( 'Parent Author', 'julius-theme' ),
        'parent_item_colon'          => __( 'Parent Author:', 'julius-theme' ),
        'new_item_name'              => __( 'New Author Name', 'julius-theme' ),
        'add_new_item'               => __( 'Add New Author', 'julius-theme' ),
        'edit_item'                  => __( 'Edit Author', 'julius-theme' ),
        'update_item'                => __( 'Update Author', 'julius-theme' ),
        'view_item'                  => __( 'View Author', 'julius-theme' ),
        'separate_items_with_commas' => __( 'Separate authors with commas', 'julius-theme' ),
        'add_or_remove_items'        => __( 'Add or remove authors', 'julius-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'julius-theme' ),
        'popular_items'              => __( 'Popular Authors', 'julius-theme' ),
        'search_items'               => __( 'Search Authors', 'julius-theme' ),
        'not_found'                  => __( 'Not Found', 'julius-theme' ),
        'no_terms'                   => __( 'No authors', 'julius-theme' ),
        'items_list'                 => __( 'Authors list', 'julius-theme' ),
        'items_list_navigation'      => __( 'Authors list navigation', 'julius-theme' ),
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
        'rewrite'                    => array( 'slug' => 'blog-author' ),
    );
    
    register_taxonomy( 'blog_author', array( 'blog_post' ), $args );
}
add_action( 'init', 'julius_register_blog_author_taxonomy' );

/**
 * Register Blog Category Taxonomy (Hierarchical)
 */
function julius_register_blog_category_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Blog Categories', 'Taxonomy General Name', 'julius-theme' ),
        'singular_name'              => _x( 'Blog Category', 'Taxonomy Singular Name', 'julius-theme' ),
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
        'rewrite'                    => array( 'slug' => 'blog-category' ),
    );
    
    register_taxonomy( 'blog_category', array( 'blog_post' ), $args );
}
add_action( 'init', 'julius_register_blog_category_taxonomy' );
