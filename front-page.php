<?php
/**
 * The front page template
 *
 * @package Julius_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section with Image Slider -->
    <section class="relative h-screen min-h-[600px] overflow-hidden hero-slider">
        <!-- Slide 1 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-100">
            <?php
            $hero_image_1_id = get_theme_mod( 'julius_hero_image_1', 21 );
            $hero_image_1_url = wp_get_attachment_image_url( $hero_image_1_id, 'full' );
            if ( $hero_image_1_url ) {
                $hero_image_1_alt = get_post_meta( $hero_image_1_id, '_wp_attachment_image_alt', true );
                if ( empty( $hero_image_1_alt ) ) {
                    $hero_image_1_alt = 'Julius Spa exterior during day';
                }
                ?>
                <img 
                    alt="<?php echo esc_attr( $hero_image_1_alt ); ?>" 
                    decoding="async" 
                    class="object-cover" 
                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                    src="<?php echo esc_url( $hero_image_1_url ); ?>"
                >
                <?php
            }
            ?>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <?php
            $hero_image_2_id = get_theme_mod( 'julius_hero_image_2', 22 );
            $hero_image_2_url = wp_get_attachment_image_url( $hero_image_2_id, 'full' );
            if ( $hero_image_2_url ) {
                $hero_image_2_alt = get_post_meta( $hero_image_2_id, '_wp_attachment_image_alt', true );
                if ( empty( $hero_image_2_alt ) ) {
                    $hero_image_2_alt = 'Julius Spa exterior at night with lanterns';
                }
                ?>
                <img 
                    alt="<?php echo esc_attr( $hero_image_2_alt ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    class="object-cover" 
                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                    src="<?php echo esc_url( $hero_image_2_url ); ?>"
                >
                <?php
            }
            ?>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <?php
            $hero_image_3_id = get_theme_mod( 'julius_hero_image_3', 23 );
            $hero_image_3_url = wp_get_attachment_image_url( $hero_image_3_id, 'full' );
            if ( $hero_image_3_url ) {
                $hero_image_3_alt = get_post_meta( $hero_image_3_id, '_wp_attachment_image_alt', true );
                if ( empty( $hero_image_3_alt ) ) {
                    $hero_image_3_alt = 'Julius Spa entrance';
                }
                ?>
                <img 
                    alt="<?php echo esc_attr( $hero_image_3_alt ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    class="object-cover" 
                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                    src="<?php echo esc_url( $hero_image_3_url ); ?>"
                >
                <?php
            }
            ?>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Slide 4 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <?php
            $hero_image_4_id = get_theme_mod( 'julius_hero_image_4', 24 );
            $hero_image_4_url = wp_get_attachment_image_url( $hero_image_4_id, 'full' );
            if ( $hero_image_4_url ) {
                $hero_image_4_alt = get_post_meta( $hero_image_4_id, '_wp_attachment_image_alt', true );
                if ( empty( $hero_image_4_alt ) ) {
                    $hero_image_4_alt = 'Julius Spa night view with colorful lanterns';
                }
                ?>
                <img 
                    alt="<?php echo esc_attr( $hero_image_4_alt ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    class="object-cover" 
                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                    src="<?php echo esc_url( $hero_image_4_url ); ?>"
                >
                <?php
            }
            ?>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 h-full flex items-center justify-center">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-4xl mx-auto">
                    <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-4 font-medium drop-shadow-md">
                        <?php echo esc_html( get_theme_mod( 'julius_hero_subtitle', 'Welcome to' ) ); ?>
                    </p>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 text-balance leading-tight [text-shadow:_2px_2px_8px_rgb(0_0_0_/_60%)]">
                        <?php echo esc_html( get_theme_mod( 'julius_hero_title', 'Julius Spa' ) ); ?>
                    </h1>
                    <p class="text-white text-base md:text-lg max-w-2xl mx-auto mb-8 leading-relaxed font-light [text-shadow:_1px_1px_4px_rgb(0_0_0_/_60%)]">
                        <?php echo esc_html( get_theme_mod( 'julius_hero_description', 'Experience authentic Vietnamese relaxation in a beautiful traditional setting. Body massage, foot massage, shampoo, and ear cleaning services.' ) ); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo esc_url( get_theme_mod( 'julius_hero_button_1_link', '#' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-10 rounded-md bg-primary hover:bg-primary/90 text-primary-foreground px-8 py-6 text-lg">
                            <?php echo esc_html( get_theme_mod( 'julius_hero_button_1_text', 'Book Your Session' ) ); ?>
                        </a>
                        <a href="<?php echo esc_url( get_theme_mod( 'julius_hero_button_2_link', '#services' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-10 rounded-md border-2 border-white text-white hover:bg-white hover:text-foreground px-8 py-6 text-lg bg-transparent">
                            <?php echo esc_html( get_theme_mod( 'julius_hero_button_2_text', 'View Services' ) ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Previous Button -->
        <button class="hero-prev absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 backdrop-blur-sm rounded-full p-3 transition-all" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-6 h-6 text-white">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </button>

        <!-- Next Button -->
        <button class="hero-next absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 backdrop-blur-sm rounded-full p-3 transition-all" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-6 h-6 text-white">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </button>

        <!-- Slide Indicators -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            <button class="hero-indicator w-3 h-3 rounded-full transition-all bg-primary w-8 active" data-slide="0" aria-label="Go to slide 1"></button>
            <button class="hero-indicator w-3 h-3 rounded-full transition-all bg-white/50 hover:bg-white/80" data-slide="1" aria-label="Go to slide 2"></button>
            <button class="hero-indicator w-3 h-3 rounded-full transition-all bg-white/50 hover:bg-white/80" data-slide="2" aria-label="Go to slide 3"></button>
            <button class="hero-indicator w-3 h-3 rounded-full transition-all bg-white/50 hover:bg-white/80" data-slide="3" aria-label="Go to slide 4"></button>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="py-20 md:py-28 bg-secondary/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-3"><?php echo esc_html( get_theme_mod( 'julius_services_subtitle', 'Our Services' ) ); ?></p>
                <h2 class="text-3xl md:text-5xl font-semibold text-foreground mb-4 text-balance"><?php echo esc_html( get_theme_mod( 'julius_services_title', 'Signature Spa Treatments' ) ); ?></h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_services_description', 'Discover our range of authentic Vietnamese spa treatments designed to restore your body and mind to perfect harmony.' ) ); ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                // Query services
                $services_args = array(
                    'post_type'      => 'service',
                    'posts_per_page' => get_theme_mod( 'julius_services_count', 4 ),
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                );
                
                $services_query = new WP_Query( $services_args );
                
                if ( $services_query->have_posts() ) :
                    while ( $services_query->have_posts() ) : $services_query->the_post();
                        // Get featured image
                        $service_image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                        if ( ! $service_image_url ) {
                            $service_image_url = 'https://picsum.photos/800/600?random=' . get_the_ID();
                        }
                        
                        // Get service category
                        $service_terms = get_the_terms( get_the_ID(), 'service_category' );
                        $service_badge = '';
                        if ( $service_terms && ! is_wp_error( $service_terms ) ) {
                            $service_badge = $service_terms[0]->name;
                        }
                        
                        // Get pricing options
                        $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
                        $lowest_price_value = null;
                        $lowest_price_numeric = null;
                        $min_time = null;
                        $max_time = null;
                        
                        if ( is_array( $pricing_options ) && ! empty( $pricing_options ) ) {
                            foreach ( $pricing_options as $option ) {
                                // Extract numeric price value for comparison
                                $price_value = isset( $option['price'] ) ? $option['price'] : '';
                                $price_numeric = floatval( preg_replace( '/[^0-9.]/', '', $price_value ) );
                                
                                if ( $price_numeric > 0 ) {
                                    if ( $lowest_price_numeric === null || $price_numeric < $lowest_price_numeric ) {
                                        $lowest_price_numeric = $price_numeric;
                                        $lowest_price_value = $price_value; // Store the actual price string
                                    }
                                }
                                
                                // Get time values
                                $time_value = isset( $option['time'] ) ? intval( $option['time'] ) : 0;
                                if ( $time_value > 0 ) {
                                    if ( $min_time === null || $time_value < $min_time ) {
                                        $min_time = $time_value;
                                    }
                                    if ( $max_time === null || $time_value > $max_time ) {
                                        $max_time = $time_value;
                                    }
                                }
                            }
                        }
                        
                        // Format duration string
                        $duration_string = '';
                        if ( $min_time && $max_time ) {
                            if ( $min_time === $max_time ) {
                                $duration_string = $min_time . ' min';
                            } else {
                                $duration_string = $min_time . '-' . $max_time . ' min';
                            }
                        }
                        
                        // Check if featured
                        $is_featured = get_post_meta( get_the_ID(), '_julius_service_featured', true );
                        ?>
                        <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl group overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-300 bg-card">
                            <div class="relative h-64 overflow-hidden">
                                <img 
                                    alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                    loading="lazy" 
                                    decoding="async" 
                                    data-nimg="fill" 
                                    class="object-cover group-hover:scale-110 transition-transform duration-500" 
                                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                    src="<?php echo esc_url( $service_image_url ); ?>"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                
                                <?php if ( $service_badge ) : ?>
                                    <div class="absolute top-4 right-4 bg-primary text-primary-foreground px-3 py-1 rounded-full text-sm flex items-center gap-1">
                                        <?php if ( $is_featured ) : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-3 h-3">
                                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                                <path d="M20 3v4"></path>
                                                <path d="M22 5h-4"></path>
                                                <path d="M4 17v2"></path>
                                                <path d="M5 18H3"></path>
                                            </svg>
                                        <?php endif; ?>
                                        <?php echo esc_html( $service_badge ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div data-slot="card-content" class="p-6">
                                <h3 class="text-xl font-semibold text-foreground mb-2"><?php the_title(); ?></h3>
                                <p class="text-muted-foreground text-sm mb-4 line-clamp-2"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <?php if ( $duration_string ) : ?>
                                        <div class="flex items-center gap-1 text-sm text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <?php echo esc_html( $duration_string ); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ( $lowest_price_value ) : ?>
                                        <span class="text-primary font-semibold">From <?php echo esc_html( $lowest_price_value ); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border shadow-xs dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-9 px-4 py-2 has-[>svg]:px-3 w-full border-primary text-primary hover:bg-primary hover:text-primary-foreground bg-transparent">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 bg-primary hover:bg-primary/90 text-primary-foreground px-8">
                    <?php echo esc_html( get_theme_mod( 'julius_services_button_text', 'View All Services' ) ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Special Offers Section -->
    <section class="py-16 md:py-24 bg-[#2D2418]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html(get_theme_mod('julius_offers_subtitle', 'Special Offers')); ?></p>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 text-balance"><?php echo esc_html(get_theme_mod('julius_offers_title', 'Julius Promotion')); ?></h2>
                <p class="text-white/70 max-w-xl mx-auto"><?php echo esc_html(get_theme_mod('julius_offers_description', 'Julius 1 & Julius Signature (Julius 2)')); ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 max-w-5xl mx-auto mb-8">
                <!-- Happy Hour Card -->
                <div class="relative rounded-xl p-6 border transition-all bg-primary/15 border-primary shadow-lg shadow-primary/10">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-primary-foreground text-xs font-bold px-4 py-1 rounded-full uppercase tracking-wider">Best Deal</div>
                    <div class="flex items-center justify-center gap-2 mb-4 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 text-primary">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span class="font-bold text-lg text-primary"><?php echo esc_html(get_theme_mod('julius_offers_happy_time', '9:00 - 18:00')); ?></span>
                    </div>
                    <p class="text-center text-xs uppercase tracking-wider mb-5 text-primary/80">Happy Hour</p>
                    <div class="h-px mb-5 bg-primary/30"></div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-primary"></div>
                            <p class="text-sm leading-relaxed text-white font-medium"><?php echo esc_html(get_theme_mod('julius_offers_happy_feature1', '40% OFF all services')); ?></p>
                        </div>
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-primary"></div>
                            <p class="text-sm leading-relaxed text-white/60"><?php echo esc_html(get_theme_mod('julius_offers_happy_feature2', 'No pick-drop service')); ?></p>
                        </div>
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-primary"></div>
                            <p class="text-sm leading-relaxed text-white/60"><?php echo esc_html(get_theme_mod('julius_offers_happy_feature3', 'Aroma 90min only 294,000 VND (Tip separate)')); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Evening Card -->
                <div class="relative rounded-xl p-6 border transition-all bg-white/5 border-white/10">
                    <div class="flex items-center justify-center gap-2 mb-4 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 text-white/60">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span class="font-bold text-lg text-white"><?php echo esc_html(get_theme_mod('julius_offers_evening_time', '18:01 - 22:00')); ?></span>
                    </div>
                    <p class="text-center text-xs uppercase tracking-wider mb-5 text-white/50">Evening</p>
                    <div class="h-px mb-5 bg-white/10"></div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-white/40"></div>
                            <p class="text-sm leading-relaxed text-white font-medium"><?php echo esc_html(get_theme_mod('julius_offers_evening_option1', 'Option 1: 20% OFF all courses on menu (No pick-drop)')); ?></p>
                        </div>
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-white/40"></div>
                            <p class="text-sm leading-relaxed text-white font-medium"><?php echo esc_html(get_theme_mod('julius_offers_evening_option2', 'Option 2: FREE pick-drop for 2+ people within Da Nang (No discount)')); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Late Night Card -->
                <div class="relative rounded-xl p-6 border transition-all bg-white/5 border-white/10">
                    <div class="flex items-center justify-center gap-2 mb-4 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 text-white/60">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span class="font-bold text-lg text-white"><?php echo esc_html(get_theme_mod('julius_offers_late_time', 'After 22:00')); ?></span>
                    </div>
                    <p class="text-center text-xs uppercase tracking-wider mb-5 text-white/50">Late Night</p>
                    <div class="h-px mb-5 bg-white/10"></div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full mt-1.5 flex-shrink-0 bg-white/40"></div>
                            <p class="text-sm leading-relaxed text-white/60"><?php echo esc_html(get_theme_mod('julius_offers_late_info', 'No discount & No pick-drop service')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group Special Box -->
            <div class="max-w-5xl mx-auto mb-8">
                <div class="rounded-xl bg-primary/10 border border-primary/30 p-5 md:p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 text-primary">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Julius Signature Spa (Julius 2)</p>
                                <p class="text-white/60 text-xs mt-0.5">Group Special</p>
                            </div>
                        </div>
                        <div class="md:ml-auto text-white/80 text-sm">
                            <?php echo esc_html(get_theme_mod('julius_offers_group_info', 'FREE pickup within Da Nang for group of 4 | FREE 1 person for group of 5+')); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Benefits -->
            <div class="max-w-5xl mx-auto mb-10">
                <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3.5 h-3.5 text-primary flex-shrink-0">
                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                        </svg>
                        <span class="text-white/60 text-xs md:text-sm"><?php echo esc_html(get_theme_mod('julius_offers_benefit1', '5% more discount for re-visit (not for happy hour)')); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3.5 h-3.5 text-primary flex-shrink-0">
                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                        </svg>
                        <span class="text-white/60 text-xs md:text-sm"><?php echo esc_html(get_theme_mod('julius_offers_benefit2', '5% more discount if you leave a review (not for re-visit)')); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3.5 h-3.5 text-primary flex-shrink-0">
                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                        </svg>
                        <span class="text-white/60 text-xs md:text-sm"><?php echo esc_html(get_theme_mod('julius_offers_benefit3', 'Car surcharge for pick-drop outside Da Nang city')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Location & Contact Info -->
            <div class="max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 bg-white/5 rounded-xl border border-white/10 p-5 md:p-6">
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 text-sm">
                        <!-- Julius 1 -->
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4 text-primary mt-0.5 flex-shrink-0">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <div>
                                <p class="text-white font-medium"><?php echo esc_html(get_theme_mod('julius_offers_location1_name', 'Julius 1')); ?></p>
                                <p class="text-white/60 text-xs"><?php echo esc_html(get_theme_mod('julius_offers_location1_address', '05 An Thuong 38, Da Nang')); ?></p>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-3 h-3 text-primary">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('julius_offers_location1_phone', '0775 509 057'))); ?>" class="text-primary text-xs hover:underline"><?php echo esc_html(get_theme_mod('julius_offers_location1_phone', '0775 509 057')); ?></a>
                                </div>
                            </div>
                        </div>

                        <!-- Julius 2 -->
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4 text-primary mt-0.5 flex-shrink-0">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <div>
                                <p class="text-white font-medium"><?php echo esc_html(get_theme_mod('julius_offers_location2_name', 'Julius 2')); ?></p>
                                <p class="text-white/60 text-xs"><?php echo esc_html(get_theme_mod('julius_offers_location2_address', '61 Ta My Duat, Da Nang')); ?></p>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-3 h-3 text-primary">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('julius_offers_location2_phone', '0787 509 157'))); ?>" class="text-primary text-xs hover:underline"><?php echo esc_html(get_theme_mod('julius_offers_location2_phone', '0787 509 157')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground hover:bg-primary/90 h-10 rounded-md px-6 has-[>svg]:px-4 flex-shrink-0" href="<?php echo esc_url(get_theme_mod('julius_offers_button_link', '/contact')); ?>">
                        <?php echo esc_html(get_theme_mod('julius_offers_button_text', 'Book Now')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-20 md:py-28 bg-background">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Image Grid -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="relative h-48 md:h-64 rounded-lg overflow-hidden">
                                <?php
                                $about_image_1_id = get_theme_mod( 'julius_about_image_1', 41 );
                                $about_image_1_url = wp_get_attachment_image_url( $about_image_1_id, 'medium_large' );
                                if ( $about_image_1_url ) {
                                    $about_image_1_alt = get_post_meta( $about_image_1_id, '_wp_attachment_image_alt', true );
                                    if ( empty( $about_image_1_alt ) ) {
                                        $about_image_1_alt = 'Julius Spa entrance';
                                    }
                                    ?>
                                    <img 
                                        alt="<?php echo esc_attr( $about_image_1_alt ); ?>" 
                                        loading="lazy" 
                                        decoding="async" 
                                        data-nimg="fill" 
                                        class="object-cover" 
                                        style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                        src="<?php echo esc_url( $about_image_1_url ); ?>"
                                    >
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="relative h-32 md:h-48 rounded-lg overflow-hidden">
                                <?php
                                $about_image_2_id = get_theme_mod( 'julius_about_image_2', 42 );
                                $about_image_2_url = wp_get_attachment_image_url( $about_image_2_id, 'medium_large' );
                                if ( $about_image_2_url ) {
                                    $about_image_2_alt = get_post_meta( $about_image_2_id, '_wp_attachment_image_alt', true );
                                    if ( empty( $about_image_2_alt ) ) {
                                        $about_image_2_alt = 'Traditional staircase';
                                    }
                                    ?>
                                    <img 
                                        alt="<?php echo esc_attr( $about_image_2_alt ); ?>" 
                                        loading="lazy" 
                                        decoding="async" 
                                        data-nimg="fill" 
                                        class="object-cover" 
                                        style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                        src="<?php echo esc_url( $about_image_2_url ); ?>"
                                    >
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="space-y-4 pt-8">
                            <div class="relative h-32 md:h-48 rounded-lg overflow-hidden">
                                <?php
                                $about_image_3_id = get_theme_mod( 'julius_about_image_3', 43 );
                                $about_image_3_url = wp_get_attachment_image_url( $about_image_3_id, 'medium_large' );
                                if ( $about_image_3_url ) {
                                    $about_image_3_alt = get_post_meta( $about_image_3_id, '_wp_attachment_image_alt', true );
                                    if ( empty( $about_image_3_alt ) ) {
                                        $about_image_3_alt = 'Elegant staircase with lanterns';
                                    }
                                    ?>
                                    <img 
                                        alt="<?php echo esc_attr( $about_image_3_alt ); ?>" 
                                        loading="lazy" 
                                        decoding="async" 
                                        data-nimg="fill" 
                                        class="object-cover" 
                                        style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                        src="<?php echo esc_url( $about_image_3_url ); ?>"
                                    >
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="relative h-48 md:h-64 rounded-lg overflow-hidden">
                                <?php
                                $about_image_4_id = get_theme_mod( 'julius_about_image_4', 44 );
                                $about_image_4_url = wp_get_attachment_image_url( $about_image_4_id, 'medium_large' );
                                if ( $about_image_4_url ) {
                                    $about_image_4_alt = get_post_meta( $about_image_4_id, '_wp_attachment_image_alt', true );
                                    if ( empty( $about_image_4_alt ) ) {
                                        $about_image_4_alt = 'Massage room';
                                    }
                                    ?>
                                    <img 
                                        alt="<?php echo esc_attr( $about_image_4_alt ); ?>" 
                                        loading="lazy" 
                                        decoding="async" 
                                        data-nimg="fill" 
                                        class="object-cover" 
                                        style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                        src="<?php echo esc_url( $about_image_4_url ); ?>"
                                    >
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary/20 rounded-full -z-10"></div>
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-accent/30 rounded-full -z-10"></div>
                </div>

                <!-- Content -->
                <div>
                    <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-3"><?php echo esc_html( get_theme_mod( 'julius_about_subtitle', 'About Us' ) ); ?></p>
                    <h2 class="text-3xl md:text-5xl font-semibold text-foreground mb-6 text-balance leading-tight">
                        <?php echo esc_html( get_theme_mod( 'julius_about_title', 'A Sanctuary of Peace & Wellness' ) ); ?>
                    </h2>
                    <p class="text-muted-foreground text-lg mb-6 leading-relaxed">
                        <?php echo esc_html( get_theme_mod( 'julius_about_description_1', 'Nestled in the heart of Da Nang, Julius Spa offers an authentic Vietnamese wellness experience. Our beautifully designed space, adorned with traditional lanterns and warm yellow walls, creates the perfect atmosphere for relaxation.' ) ); ?>
                    </p>
                    <p class="text-muted-foreground text-lg mb-8 leading-relaxed">
                        <?php echo esc_html( get_theme_mod( 'julius_about_description_2', 'Our skilled therapists combine ancient Vietnamese techniques with modern wellness practices to deliver treatments that rejuvenate both body and soul. From body massage to foot reflexology, each service is tailored to your needs.' ) ); ?>
                    </p>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-8">
                        <div class="text-center p-5 md:p-6 rounded-xl bg-secondary/50 border border-border/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award w-7 h-7 md:w-8 md:h-8 text-primary mx-auto mb-3">
                                <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path>
                                <circle cx="12" cy="8" r="6"></circle>
                            </svg>
                            <div class="text-xl font-bold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_stat_1_value', '5+' ) ); ?></div>
                            <div class="text-xs md:text-sm text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat_1_label', 'Years Experience' ) ); ?></div>
                        </div>
                        <div class="text-center p-5 md:p-6 rounded-xl bg-secondary/50 border border-border/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-7 h-7 md:w-8 md:h-8 text-primary mx-auto mb-3">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <div class="text-xl font-bold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_stat_2_value', '10,000+' ) ); ?></div>
                            <div class="text-xs md:text-sm text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat_2_label', 'Happy Clients' ) ); ?></div>
                        </div>
                        <div class="text-center p-5 md:p-6 rounded-xl bg-secondary/50 border border-border/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-7 h-7 md:w-8 md:h-8 text-primary mx-auto mb-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <div class="text-xl font-bold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_stat_3_value', '9AM-10PM' ) ); ?></div>
                            <div class="text-xs md:text-sm text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat_3_label', 'Open Daily' ) ); ?></div>
                        </div>
                        <div class="text-center p-5 md:p-6 rounded-xl bg-secondary/50 border border-border/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-7 h-7 md:w-8 md:h-8 text-primary mx-auto mb-3">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                            </svg>
                            <div class="text-xl font-bold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_stat_4_value', '100%' ) ); ?></div>
                            <div class="text-xs md:text-sm text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat_4_label', 'Satisfaction' ) ); ?></div>
                        </div>
                    </div>

                    <a href="<?php echo esc_url( get_theme_mod( 'julius_about_button_link', '/about' ) ); ?>" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 bg-primary hover:bg-primary/90 text-primary-foreground px-8">
                        <?php echo esc_html( get_theme_mod( 'julius_about_button_text', 'Learn More About Us' ) ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20 md:py-28 bg-secondary/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-3"><?php echo esc_html( get_theme_mod( 'julius_gallery_subtitle', 'Gallery' ) ); ?></p>
                <h2 class="text-3xl md:text-5xl font-semibold text-foreground mb-4 text-balance"><?php echo esc_html( get_theme_mod( 'julius_gallery_title', 'Our Beautiful Space' ) ); ?></h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_gallery_description', 'Step into our traditional Vietnamese-inspired sanctuary and experience the warmth and beauty of Julius Signature Spa.' ) ); ?></p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 auto-rows-[180px] md:auto-rows-[220px]">
                <!-- Gallery Item 1 - Large (2x2) -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group md:col-span-2 md:row-span-2">
                    <?php
                    $gallery_image_1_id = get_theme_mod( 'julius_gallery_image_1', 45 );
                    $gallery_image_1_url = wp_get_attachment_image_url( $gallery_image_1_id, 'large' );
                    if ( $gallery_image_1_url ) {
                        $gallery_image_1_alt = get_post_meta( $gallery_image_1_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_1_alt ) ) {
                            $gallery_image_1_alt = 'Julius Spa exterior at night with neon sign';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_1_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_1_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_2_id = get_theme_mod( 'julius_gallery_image_2', 46 );
                    $gallery_image_2_url = wp_get_attachment_image_url( $gallery_image_2_id, 'medium_large' );
                    if ( $gallery_image_2_url ) {
                        $gallery_image_2_alt = get_post_meta( $gallery_image_2_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_2_alt ) ) {
                            $gallery_image_2_alt = 'Massage room with arched doorways';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_2_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_2_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_3_id = get_theme_mod( 'julius_gallery_image_3', 47 );
                    $gallery_image_3_url = wp_get_attachment_image_url( $gallery_image_3_id, 'medium_large' );
                    if ( $gallery_image_3_url ) {
                        $gallery_image_3_alt = get_post_meta( $gallery_image_3_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_3_alt ) ) {
                            $gallery_image_3_alt = 'Cozy massage room with wall art';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_3_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_3_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_4_id = get_theme_mod( 'julius_gallery_image_4', 48 );
                    $gallery_image_4_url = wp_get_attachment_image_url( $gallery_image_4_id, 'medium_large' );
                    if ( $gallery_image_4_url ) {
                        $gallery_image_4_alt = get_post_meta( $gallery_image_4_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_4_alt ) ) {
                            $gallery_image_4_alt = 'Spacious massage room with mirror';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_4_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_4_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 5 - Wide (2x1) -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group md:col-span-2">
                    <?php
                    $gallery_image_5_id = get_theme_mod( 'julius_gallery_image_5', 49 );
                    $gallery_image_5_url = wp_get_attachment_image_url( $gallery_image_5_id, 'large' );
                    if ( $gallery_image_5_url ) {
                        $gallery_image_5_alt = get_post_meta( $gallery_image_5_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_5_alt ) ) {
                            $gallery_image_5_alt = 'Street view of Julius Spa at night';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_5_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_5_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 6 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_6_id = get_theme_mod( 'julius_gallery_image_6', 50 );
                    $gallery_image_6_url = wp_get_attachment_image_url( $gallery_image_6_id, 'medium_large' );
                    if ( $gallery_image_6_url ) {
                        $gallery_image_6_alt = get_post_meta( $gallery_image_6_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_6_alt ) ) {
                            $gallery_image_6_alt = 'Large group massage room';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_6_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_6_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 7 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_7_id = get_theme_mod( 'julius_gallery_image_7', 51 );
                    $gallery_image_7_url = wp_get_attachment_image_url( $gallery_image_7_id, 'medium_large' );
                    if ( $gallery_image_7_url ) {
                        $gallery_image_7_alt = get_post_meta( $gallery_image_7_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_7_alt ) ) {
                            $gallery_image_7_alt = 'Julius branded towel with frangipani flower';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_7_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_7_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 8 - Wide (2x1) -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group md:col-span-2">
                    <?php
                    $gallery_image_8_id = get_theme_mod( 'julius_gallery_image_8', 52 );
                    $gallery_image_8_url = wp_get_attachment_image_url( $gallery_image_8_id, 'large' );
                    if ( $gallery_image_8_url ) {
                        $gallery_image_8_alt = get_post_meta( $gallery_image_8_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_8_alt ) ) {
                            $gallery_image_8_alt = 'Group massage room with curtains';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_8_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_8_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 9 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_9_id = get_theme_mod( 'julius_gallery_image_9', 53 );
                    $gallery_image_9_url = wp_get_attachment_image_url( $gallery_image_9_id, 'medium_large' );
                    if ( $gallery_image_9_url ) {
                        $gallery_image_9_alt = get_post_meta( $gallery_image_9_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_9_alt ) ) {
                            $gallery_image_9_alt = 'Massage room with warm lighting';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_9_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_9_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>

                <!-- Gallery Item 10 -->
                <div class="relative overflow-hidden rounded-lg cursor-pointer group">
                    <?php
                    $gallery_image_10_id = get_theme_mod( 'julius_gallery_image_10', 54 );
                    $gallery_image_10_url = wp_get_attachment_image_url( $gallery_image_10_id, 'medium_large' );
                    if ( $gallery_image_10_url ) {
                        $gallery_image_10_alt = get_post_meta( $gallery_image_10_id, '_wp_attachment_image_alt', true );
                        if ( empty( $gallery_image_10_alt ) ) {
                            $gallery_image_10_alt = 'Julius branded towel close-up';
                        }
                        ?>
                        <img 
                            alt="<?php echo esc_attr( $gallery_image_10_alt ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover group-hover:scale-110 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $gallery_image_10_url ); ?>"
                        >
                        <?php
                    }
                    ?>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white text-lg font-medium">View</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
