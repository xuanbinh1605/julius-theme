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
    
    if ( $category_id === 'all' ) {
        // Get all categories
        $categories = get_terms( array(
            'taxonomy'   => 'service_category',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ) );
    } else {
        // Get specific category
        $categories = array( get_term( absint( $category_id ), 'service_category' ) );
    }
    
    if ( empty( $categories ) || is_wp_error( $categories ) ) {
        wp_send_json_error( array( 'message' => 'No services found.' ) );
    }
    
    ob_start();
    
    foreach ( $categories as $category ) :
        if ( is_wp_error( $category ) ) {
            continue;
        }
        
        // Get services in this category
        $services_query = new WP_Query( array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'service_category',
                    'field'    => 'term_id',
                    'terms'    => $category->term_id,
                ),
            ),
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ) );

        if ( $services_query->have_posts() ) :
            // Get category featured image from term meta or first service or placeholder
            $cat_image_id = get_term_meta( $category->term_id, 'category_featured_image', true );
            if ( $cat_image_id ) {
                $cat_image = wp_get_attachment_image_url( $cat_image_id, 'medium_large' );
            } else {
                $cat_image = 'https://picsum.photos/seed/' . $category->term_id . '/800/400';
                $first_post = $services_query->posts[0];
                $cat_featured = get_the_post_thumbnail_url( $first_post->ID, 'medium_large' );
                if ( $cat_featured ) {
                    $cat_image = $cat_featured;
                }
            }
            
            // Get full service name or use default name
            $category_full_name = get_term_meta( $category->term_id, 'category_full_name', true );
            $category_display_name = $category_full_name ? $category_full_name : $category->name;
            
            // Get category tags
            $category_tags = get_term_meta( $category->term_id, 'category_tags', true );
            ?>
            
            <div class="julius-category-group mb-8" data-category="<?php echo esc_attr( $category->term_id ); ?>">
                <!-- Category Header -->
                <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-6">
                    <div class="relative w-full md:w-72 h-40 md:h-48 rounded-xl overflow-hidden flex-shrink-0">
                        <img 
                            alt="<?php echo esc_attr( $category->name ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            class="object-cover" 
                            src="<?php echo esc_url( $cat_image ); ?>" 
                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-primary/90 text-primary-foreground text-xs font-medium rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-3 h-3">
                                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                    <path d="M20 3v4"></path>
                                    <path d="M22 5h-4"></path>
                                    <path d="M4 17v2"></path>
                                    <path d="M5 18H3"></path>
                                </svg>
                                <?php echo $services_query->post_count; ?> services
                            </span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl md:text-2xl font-bold text-foreground mb-1"><?php echo esc_html( $category_display_name ); ?></h2>
                        <?php if ( $category->description ) : ?>
                            <p class="text-muted-foreground text-sm mb-2"><?php echo esc_html( $category->description ); ?></p>
                        <?php endif; ?>
                        <?php if ( $category_tags ) : 
                            $tags_array = array_map( 'trim', explode( ',', $category_tags ) );
                        ?>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <?php foreach ( $tags_array as $tag ) : ?>
                                    <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full"><?php echo esc_html( $tag ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Services List -->
                <div class="space-y-2">
                    <?php while ( $services_query->have_posts() ) : $services_query->the_post();
                        $duration = get_post_meta( get_the_ID(), '_julius_service_duration', true );
                        $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
                        $service_included = get_post_meta( get_the_ID(), '_julius_service_included', true );
                        
                        // Get first price
                        $price = '';
                        $price_time = '';
                        if ( ! empty( $pricing_options ) && is_array( $pricing_options ) ) {
                            $first_option = $pricing_options[0];
                            $price = $first_option['price'] ?? '';
                            $price_time = ! empty( $first_option['time'] ) ? $first_option['time'] . 'min' : '';
                        }
                        
                        // Get thumbnail
                        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                        if ( ! $thumb ) {
                            $thumb = 'https://picsum.photos/seed/' . get_the_ID() . '/200/200';
                        }
                        ?>
                        
                        <div class="bg-card border border-border rounded-lg p-3 md:p-4 hover:border-primary/50 hover:shadow-md transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="relative w-14 h-14 md:w-16 md:h-16 rounded-lg overflow-hidden flex-shrink-0">
                                    <img 
                                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                        loading="lazy" 
                                        decoding="async" 
                                        class="object-cover" 
                                        src="<?php echo esc_url( $thumb ); ?>" 
                                        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                                    >
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="font-semibold text-foreground text-sm md:text-base hover:text-primary transition-colors">
                                            <?php the_title(); ?>
                                        </h3>
                                    </a>
                                    <?php if ( $service_included ) : ?>
                                        <p class="text-muted-foreground text-xs md:text-sm mt-0.5 line-clamp-1">
                                            <?php echo esc_html( $service_included ); ?>
                                        </p>
                                    <?php endif; ?>
                                    <div class="flex items-center gap-3 mt-1">
                                        <?php if ( $duration || $price_time ) : ?>
                                            <span class="text-xs text-muted-foreground flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-3 h-3">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <?php echo esc_html( $price_time ? $price_time : $duration ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex items-center gap-2 md:gap-4">
                                    <?php if ( $price ) : ?>
                                        <div class="text-right min-w-[50px]">
                                            <div class="text-primary font-bold text-sm md:text-base"><?php echo esc_html( $price ); ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex items-center gap-1 md:gap-2">
                                        <a href="<?php the_permalink(); ?>#booking">
                                            <button class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 rounded-md h-8 px-3 md:px-4 text-xs">
                                                Book
                                            </button>
                                        </a>
                                        <a href="<?php the_permalink(); ?>">
                                            <button class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 border shadow-xs hover:bg-accent hover:text-accent-foreground rounded-md h-8 px-3 md:px-4 text-xs bg-transparent">
                                                Detail
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                </div>

                <!-- Category Note (if needed) -->
                <?php
                $category_note = get_term_meta( $category->term_id, 'category_note', true );
                if ( $category_note ) :
                ?>
                    <div class="mt-6 p-3 bg-secondary/30 rounded-lg border border-border">
                        <p class="text-xs text-muted-foreground text-center">
                            <?php echo wp_kses_post( $category_note ); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
        <?php
        endif;
        wp_reset_postdata();
    endforeach;
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_julius_filter_services', 'julius_filter_services_handler' );
add_action( 'wp_ajax_nopriv_julius_filter_services', 'julius_filter_services_handler' );
