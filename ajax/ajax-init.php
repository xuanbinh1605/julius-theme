<?php
/**
 * AJAX Handlers Initialization
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Example AJAX Handler
 */
function julius_ajax_example_handler() {
    // Check nonce
    check_ajax_referer( 'julius-nonce', 'nonce' );
    
    // Your AJAX logic here
    $response = array(
        'success' => true,
        'message' => 'AJAX request successful',
    );
    
    wp_send_json_success( $response );
}
add_action( 'wp_ajax_julius_example', 'julius_ajax_example_handler' );
add_action( 'wp_ajax_nopriv_julius_example', 'julius_ajax_example_handler' );

/**
 * Service Booking AJAX Handler
 */
function julius_service_booking_handler() {
    // Check nonce
    if ( ! isset( $_POST['booking_nonce'] ) || ! wp_verify_nonce( $_POST['booking_nonce'], 'julius_booking_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }
    
    // Get form data
    $service_id = isset( $_POST['service_id'] ) ? absint( $_POST['service_id'] ) : 0;
    $service_name = isset( $_POST['service_name'] ) ? sanitize_text_field( $_POST['service_name'] ) : '';
    $name = isset( $_POST['booking_name'] ) ? sanitize_text_field( $_POST['booking_name'] ) : '';
    $phone = isset( $_POST['booking_phone'] ) ? sanitize_text_field( $_POST['booking_phone'] ) : '';
    $branch = isset( $_POST['booking_branch'] ) ? sanitize_text_field( $_POST['booking_branch'] ) : '';
    
    // Validate required fields
    if ( empty( $name ) || empty( $phone ) || empty( $branch ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }
    
    // Get admin email
    $admin_email = get_option( 'admin_email' );
    $site_name = get_bloginfo( 'name' );
    
    // Prepare email
    $to = $admin_email;
    $subject = sprintf( '[%s] New Service Booking Request', $site_name );
    
    $branch_names = array(
        'julius-1' => 'Julius 1 - 5 An Thuong 38',
        'julius-2' => 'Julius 2 - 61 Ta My Duat',
    );
    $branch_name = isset( $branch_names[ $branch ] ) ? $branch_names[ $branch ] : $branch;
    
    $message = sprintf(
        "New service booking request:\n\n" .
        "Service: %s\n" .
        "Customer Name: %s\n" .
        "Phone Number: %s\n" .
        "Branch: %s\n\n" .
        "Submitted: %s\n" .
        "Service Link: %s",
        $service_name,
        $name,
        $phone,
        $branch_name,
        current_time( 'mysql' ),
        get_permalink( $service_id )
    );
    
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    
    // Send email
    $sent = wp_mail( $to, $subject, $message, $headers );
    
    if ( $sent ) {
        // Save booking as post meta or custom post type (optional)
        $booking_data = array(
            'service_id'   => $service_id,
            'service_name' => $service_name,
            'name'         => $name,
            'phone'        => $phone,
            'branch'       => $branch,
            'date'         => current_time( 'mysql' ),
        );
        
        // Store in options table (you can also create a custom table or post type)
        $bookings = get_option( 'julius_service_bookings', array() );
        $bookings[] = $booking_data;
        update_option( 'julius_service_bookings', $bookings );
        
        wp_send_json_success( array( 
            'message' => 'Thank you! Your booking request has been received. We will contact you soon.' 
        ) );
    } else {
        wp_send_json_error( array( 
            'message' => 'Sorry, there was an error sending your booking request. Please try calling us directly.' 
        ) );
    }
}
add_action( 'wp_ajax_julius_service_booking', 'julius_service_booking_handler' );
add_action( 'wp_ajax_nopriv_julius_service_booking', 'julius_service_booking_handler' );

/**
 * Filter Services by Category AJAX Handler
 */
function julius_filter_services_handler() {
    // Check nonce
    check_ajax_referer( 'julius-nonce', 'nonce' );
    
    $category_id = isset( $_POST['category_id'] ) ? sanitize_text_field( $_POST['category_id'] ) : 'all';
    
    // Build query args
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    );
    
    // Add category filter if not "all"
    if ( $category_id !== 'all' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'service_category',
                'field'    => 'term_id',
                'terms'    => absint( $category_id ),
            ),
        );
    }
    
    $services_query = new WP_Query( $args );
    
    if ( ! $services_query->have_posts() ) {
        wp_send_json_success( array( 
            'html' => '<div class="text-center py-12"><p class="text-muted-foreground">No services found.</p></div>' 
        ) );
    }
    
    ob_start();
    
    echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">';
    
    while ( $services_query->have_posts() ) : $services_query->the_post();
        $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
        
        // Get featured image or placeholder
        $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( ! $featured_img ) {
            $featured_img = 'https://picsum.photos/seed/' . get_the_ID() . '/800/600';
        }
        
        // Get up to 3 pricing options
        $prices_to_show = array();
        if ( ! empty( $pricing_options ) && is_array( $pricing_options ) ) {
            $prices_to_show = array_slice( $pricing_options, 0, 3 );
        }
        ?>
        
        <a class="bg-card border border-border rounded-xl overflow-hidden hover:shadow-lg hover:border-primary/50 transition-all group flex flex-col" href="<?php the_permalink(); ?>">
            <div class="relative aspect-[4/3] overflow-hidden flex-shrink-0">
                <img 
                    alt="<?php echo esc_attr( get_the_title() ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    class="object-cover group-hover:scale-105 transition-transform duration-300 brightness-90 contrast-105 saturate-110" 
                    src="<?php echo esc_url( $featured_img ); ?>" 
                    style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-black/10"></div>
                <h3 class="absolute bottom-2 left-3 right-3 text-white font-bold text-sm md:text-base leading-tight drop-shadow-lg">
                    <?php the_title(); ?>
                </h3>
            </div>
            <div class="p-3 flex-1 bg-card">
                <div class="space-y-1.5">
                    <?php if ( ! empty( $prices_to_show ) ) : ?>
                        <?php foreach ( $prices_to_show as $price_option ) : ?>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-muted-foreground">
                                    <?php 
                                    if ( ! empty( $price_option['time'] ) ) {
                                        echo esc_html( $price_option['time'] . ' minutes' );
                                    } elseif ( ! empty( $price_option['name'] ) ) {
                                        echo esc_html( $price_option['name'] );
                                    }
                                    ?>
                                </span>
                                <span class="text-primary font-semibold"><?php echo esc_html( $price_option['price'] ?? '' ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-2 bg-primary/10 border-t border-border text-center">
                <span class="text-xs text-primary font-medium group-hover:underline flex items-center justify-center gap-1">
                    View Details
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-3 h-3 group-hover:translate-x-1 transition-transform">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>
        
    <?php endwhile; 
    
    echo '</div>';
    
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_julius_filter_services', 'julius_filter_services_handler' );
add_action( 'wp_ajax_nopriv_julius_filter_services', 'julius_filter_services_handler' );

/**
 * Search Services AJAX Handler
 */
function julius_search_services_handler() {
    // Check nonce
    check_ajax_referer( 'julius-nonce', 'nonce' );
    
    $search_term = isset( $_POST['search_term'] ) ? sanitize_text_field( $_POST['search_term'] ) : '';
    
    if ( empty( $search_term ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a search term.' ) );
    }
    
    // Query services by title
    $services_query = new WP_Query( array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        's'              => $search_term,
        'orderby'        => 'relevance',
        'order'          => 'DESC',
    ) );
    
    if ( ! $services_query->have_posts() ) {
        wp_send_json_success( array( 
            'html' => '<div class="text-center py-12"><p class="text-muted-foreground">No services found matching "' . esc_html( $search_term ) . '"</p></div>' 
        ) );
    }
    
    ob_start();
    
    echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">';
    
    while ( $services_query->have_posts() ) : $services_query->the_post();
        $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
        
        // Get featured image or placeholder
        $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( ! $featured_img ) {
            $featured_img = 'https://picsum.photos/seed/' . get_the_ID() . '/800/600';
        }
        
        // Get up to 3 pricing options
        $prices_to_show = array();
        if ( ! empty( $pricing_options ) && is_array( $pricing_options ) ) {
            $prices_to_show = array_slice( $pricing_options, 0, 3 );
        }
        ?>
        
        <a class="bg-card border border-border rounded-xl overflow-hidden hover:shadow-lg hover:border-primary/50 transition-all group flex flex-col" href="<?php the_permalink(); ?>">
            <div class="relative aspect-[4/3] overflow-hidden flex-shrink-0">
                <img 
                    alt="<?php echo esc_attr( get_the_title() ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    class="object-cover group-hover:scale-105 transition-transform duration-300 brightness-90 contrast-105 saturate-110" 
                    src="<?php echo esc_url( $featured_img ); ?>" 
                    style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-black/10"></div>
                <h3 class="absolute bottom-2 left-3 right-3 text-white font-bold text-sm md:text-base leading-tight drop-shadow-lg">
                    <?php the_title(); ?>
                </h3>
            </div>
            <div class="p-3 flex-1 bg-card">
                <div class="space-y-1.5">
                    <?php if ( ! empty( $prices_to_show ) ) : ?>
                        <?php foreach ( $prices_to_show as $price_option ) : ?>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-muted-foreground">
                                    <?php 
                                    if ( ! empty( $price_option['time'] ) ) {
                                        echo esc_html( $price_option['time'] . ' minutes' );
                                    } elseif ( ! empty( $price_option['name'] ) ) {
                                        echo esc_html( $price_option['name'] );
                                    }
                                    ?>
                                </span>
                                <span class="text-primary font-semibold"><?php echo esc_html( $price_option['price'] ?? '' ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-2 bg-primary/10 border-t border-border text-center">
                <span class="text-xs text-primary font-medium group-hover:underline flex items-center justify-center gap-1">
                    View Details
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-3 h-3 group-hover:translate-x-1 transition-transform">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>
        
    <?php endwhile; 
    
    echo '</div>';
    
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_julius_search_services', 'julius_search_services_handler' );
add_action( 'wp_ajax_nopriv_julius_search_services', 'julius_search_services_handler' );

/**
 * Blog Search Autocomplete AJAX Handler
 */
function julius_blog_search_autocomplete_handler() {
    // Check nonce
    check_ajax_referer( 'julius-search-nonce', 'nonce' );
    
    // Get search query
    $search_query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : '';
    
    if ( empty( $search_query ) || strlen( $search_query ) < 2 ) {
        wp_send_json_success( array( 'results' => array() ) );
    }
    
    // Search blog posts
    $args = array(
        'post_type'      => 'blog_post',
        'posts_per_page' => 5,
        's'              => $search_query,
        'orderby'        => 'relevance',
        'post_status'    => 'publish',
    );
    
    $search_query_obj = new WP_Query( $args );
    $results = array();
    
    if ( $search_query_obj->have_posts() ) {
        while ( $search_query_obj->have_posts() ) {
            $search_query_obj->the_post();
            
            $post_id = get_the_ID();
            $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url( $post_id, 'thumbnail' ) : 'https://picsum.photos/seed/blog-' . $post_id . '/100/100';
            $categories = get_the_terms( $post_id, 'blog_category' );
            $category = $categories && ! is_wp_error( $categories ) ? $categories[0]->name : '';
            
            $results[] = array(
                'id'        => $post_id,
                'title'     => get_the_title(),
                'excerpt'   => wp_trim_words( get_the_excerpt(), 15, '...' ),
                'url'       => get_permalink(),
                'thumbnail' => $thumbnail,
                'category'  => $category,
                'date'      => get_the_date( 'F j, Y' ),
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success( array( 'results' => $results ) );
}
add_action( 'wp_ajax_julius_blog_search', 'julius_blog_search_autocomplete_handler' );
add_action( 'wp_ajax_nopriv_julius_blog_search', 'julius_blog_search_autocomplete_handler' );
