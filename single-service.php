<?php
/**
 * Single Service Template
 *
 * @package Julius_Theme
 */

get_header();

while ( have_posts() ) : the_post();
    
    // Get custom fields
    $duration = get_post_meta( get_the_ID(), '_julius_service_duration', true );
    $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
    $benefits = get_post_meta( get_the_ID(), '_julius_service_benefits', true );
    $included_items = get_post_meta( get_the_ID(), '_julius_service_whats_included', true );
    $service_note = get_post_meta( get_the_ID(), '_julius_service_note', true );
    $service_included_text = get_post_meta( get_the_ID(), '_julius_service_included', true );
    
    // Get first pricing option for display
    $first_price = '';
    $first_duration = $duration;
    if ( ! empty( $pricing_options ) && is_array( $pricing_options ) ) {
        $first_option = $pricing_options[0];
        $first_price = $first_option['price'] ?? '';
        $first_duration = ! empty( $first_option['time'] ) ? $first_option['time'] . ' minutes' : $first_duration;
    }
    
    // Get service category for breadcrumb
    $terms = get_the_terms( get_the_ID(), 'service_category' );
    $category_name = ! empty( $terms ) ? $terms[0]->name : 'Services';
    
    // Get featured image
    $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    if ( ! $featured_image ) {
        // Use Picsum placeholder with service ID as seed for consistency
        $featured_image = 'https://picsum.photos/seed/' . get_the_ID() . '/1920/600';
    }
    ?>

    <!-- Hero Section -->
    <section class="relative h-[45vh] min-h-[380px] mt-[120px]">
        <img 
            alt="<?php echo esc_attr( get_the_title() ); ?>" 
            decoding="async" 
            class="object-cover" 
            src="<?php echo esc_url( $featured_image ); ?>" 
            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
        >
        <div class="absolute inset-0 bg-black/60"></div>
        
        <!-- Breadcrumb -->
        <div class="absolute left-0 right-0 z-10 julius-breadcrumb">
            <div class="container mx-auto px-4">
                <nav class="flex items-center gap-2 text-sm text-white/80">
                    <a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                    <a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a>
                    <?php if ( ! empty( $terms ) ) : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                        <span class="text-primary"><?php echo esc_html( $category_name ); ?></span>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="absolute inset-0 flex items-center justify-center pt-10">
            <div class="text-center text-white px-4">
                <p class="text-primary text-xs md:text-sm tracking-[0.2em] uppercase mb-2">
                    <?php echo esc_html( $category_name ); ?>
                </p>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3">
                    <?php the_title(); ?>
                </h1>
                <?php if ( $service_included_text ) : ?>
                    <p class="text-white/80 text-sm md:text-base mb-4 max-w-lg mx-auto">
                        <?php echo esc_html( $service_included_text ); ?>
                    </p>
                <?php endif; ?>
                <div class="flex items-center justify-center gap-4 text-white/90 text-sm">
                    <?php if ( $first_duration ) : ?>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 text-primary">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo esc_html( $first_duration ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( $first_price ) : ?>
                        <span class="text-primary font-semibold"><?php echo esc_html( $first_price ); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Back Button -->
    <div class="container mx-auto px-4 py-4">
        <a class="inline-flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors text-sm" href="<?php echo esc_url( home_url( '/services' ) ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                <path d="m12 19-7-7 7-7"></path>
                <path d="M19 12H5"></path>
            </svg>
            Back to Services
        </a>
    </div>

    <!-- Main Content -->
    <section class="pb-12">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Service Details -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- About This Service -->
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h2 class="text-xl font-bold text-foreground mb-4">About This Service</h2>
                        <div class="text-muted-foreground leading-relaxed">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Benefits -->
                    <?php if ( ! empty( $benefits ) && is_array( $benefits ) ) : ?>
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h2 class="text-xl font-bold text-foreground mb-4">Benefits</h2>
                        <div class="grid sm:grid-cols-2 gap-3">
                            <?php foreach ( $benefits as $benefit ) : 
                                if ( empty( $benefit ) ) continue;
                            ?>
                            <div class="flex items-start gap-2">
                                <div class="w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-3 h-3 text-primary">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                </div>
                                <span class="text-foreground text-sm"><?php echo esc_html( $benefit ); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- What's Included -->
                    <?php if ( ! empty( $included_items ) && is_array( $included_items ) ) : ?>
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h2 class="text-xl font-bold text-foreground mb-4">What's Included</h2>
                        <ul class="space-y-2">
                            <?php foreach ( $included_items as $item ) : 
                                if ( empty( $item ) ) continue;
                            ?>
                            <li class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4 text-primary">
                                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                    <path d="M20 3v4"></path>
                                    <path d="M22 5h-4"></path>
                                    <path d="M4 17v2"></path>
                                    <path d="M5 18H3"></path>
                                </svg>
                                <span class="text-foreground"><?php echo esc_html( $item ); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- Right Column - Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-36 space-y-4">
                        
                        <!-- Pricing Info -->
                        <div class="bg-card border border-border rounded-xl p-6">
                            <h3 class="font-bold text-foreground mb-4">Pricing Options</h3>
                            <div class="space-y-2 mb-4">
                                <?php if ( ! empty( $pricing_options ) && is_array( $pricing_options ) ) : ?>
                                    <?php foreach ( $pricing_options as $option ) : ?>
                                        <div class="flex justify-between items-center p-3 bg-secondary/30 rounded-lg">
                                            <span class="text-sm text-foreground">
                                                <?php if ( ! empty( $option['time'] ) ) : ?>
                                                    <?php echo esc_html( $option['time'] ); ?> minutes
                                                <?php endif; ?>
                                                <?php if ( ! empty( $option['name'] ) ) : ?>
                                                    (<?php echo esc_html( $option['name'] ); ?>)
                                                <?php endif; ?>
                                            </span>
                                            <?php if ( ! empty( $option['price'] ) ) : ?>
                                                <span class="font-semibold text-primary"><?php echo esc_html( $option['price'] ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php if ( $service_note ) : ?>
                            <div class="bg-secondary/30 rounded-lg p-3 mb-4">
                                <p class="text-xs text-muted-foreground">
                                    <strong class="text-foreground">Note:</strong> <?php echo esc_html( $service_note ); ?>
                                </p>
                            </div>
                            <?php endif; ?>
                            <?php 
                            $phone = get_theme_mod( 'julius_phone_number', '+84 123 456 789' );
                            $phone_clean = str_replace( ' ', '', $phone );
                            ?>
                            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 border shadow-xs hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 w-full gap-2 bg-transparent mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                Call: <?php echo esc_html( $phone ); ?>
                            </a>
                        </div>

                        <!-- Booking Form -->
                        <div class="bg-card border border-border rounded-xl p-6">
                            <h3 class="font-bold text-foreground mb-4">Book This Service</h3>
                            <form class="space-y-4 julius-booking-form" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                                <input type="hidden" name="action" value="julius_service_booking">
                                <input type="hidden" name="service_id" value="<?php echo get_the_ID(); ?>">
                                <input type="hidden" name="service_name" value="<?php echo esc_attr( get_the_title() ); ?>">
                                <?php wp_nonce_field( 'julius_booking_nonce', 'booking_nonce' ); ?>
                                
                                <div>
                                    <label for="booking_name" class="block text-sm font-medium text-foreground mb-1">Full Name *</label>
                                    <input 
                                        id="booking_name" 
                                        name="booking_name" 
                                        required 
                                        placeholder="Enter your name" 
                                        class="w-full h-10 px-3 rounded-md border border-border bg-background text-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/50" 
                                        type="text"
                                    >
                                </div>
                                
                                <div>
                                    <label for="booking_phone" class="block text-sm font-medium text-foreground mb-1">Phone Number *</label>
                                    <input 
                                        id="booking_phone" 
                                        name="booking_phone" 
                                        required 
                                        placeholder="+84 xxx xxx xxx" 
                                        class="w-full h-10 px-3 rounded-md border border-border bg-background text-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/50" 
                                        type="tel"
                                    >
                                </div>
                                
                                <div>
                                    <label for="booking_branch" class="block text-sm font-medium text-foreground mb-1">Select Branch *</label>
                                    <select 
                                        id="booking_branch" 
                                        name="booking_branch" 
                                        required 
                                        class="w-full h-10 px-3 rounded-md border border-border bg-background text-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/50"
                                    >
                                        <option value="">Choose branch...</option>
                                        <option value="julius-1">Julius 1 - 5 An Thuong 38</option>
                                        <option value="julius-2">Julius 2 - 61 Ta My Duat</option>
                                    </select>
                                </div>
                                
                                <div class="booking-response"></div>
                                
                                <button 
                                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 w-full gap-2" 
                                    type="submit"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-4 h-4">
                                        <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
                                        <path d="m21.854 2.147-10.94 10.939"></path>
                                    </svg>
                                    Book Now
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Services -->
    <?php
    // Get related services from the same category
    $related_args = array(
        'post_type'      => 'service',
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'orderby'        => 'rand',
    );
    
    if ( ! empty( $terms ) ) {
        $related_args['tax_query'] = array(
            array(
                'taxonomy' => 'service_category',
                'field'    => 'term_id',
                'terms'    => $terms[0]->term_id,
            ),
        );
    }
    
    $related_query = new WP_Query( $related_args );
    
    if ( $related_query->have_posts() ) :
    ?>
    <section class="py-12 bg-secondary/20">
        <div class="container mx-auto px-4">
            <h2 class="text-xl font-bold text-foreground mb-6">
                Other <?php echo esc_html( $category_name ); ?> Services
            </h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
                    $related_duration = get_post_meta( get_the_ID(), '_julius_service_duration', true );
                    $related_pricing = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
                    $related_price = '';
                    if ( ! empty( $related_pricing ) && is_array( $related_pricing ) ) {
                        $related_price = $related_pricing[0]['price'] ?? '';
                    }
                ?>
                <a class="bg-card border border-border rounded-xl p-4 hover:border-primary/50 transition-colors group" href="<?php the_permalink(); ?>">
                    <h3 class="font-semibold text-foreground group-hover:text-primary transition-colors">
                        <?php the_title(); ?>
                    </h3>
                    <?php if ( has_excerpt() ) : ?>
                        <p class="text-sm text-muted-foreground mt-1">
                            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 10 ) ); ?>
                        </p>
                    <?php endif; ?>
                    <div class="flex justify-between items-center mt-3">
                        <?php if ( $related_duration ) : ?>
                            <span class="text-xs text-muted-foreground"><?php echo esc_html( $related_duration ); ?></span>
                        <?php endif; ?>
                        <?php if ( $related_price ) : ?>
                            <span class="text-sm font-semibold text-primary"><?php echo esc_html( $related_price ); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
