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
                <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-3">Our Services</p>
                <h2 class="text-3xl md:text-5xl font-semibold text-foreground mb-4 text-balance">Signature Spa Treatments</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Discover our range of authentic Vietnamese spa treatments designed to restore your body and mind to perfect harmony.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                // Query services
                $services_args = array(
                    'post_type'      => 'service',
                    'posts_per_page' => 4,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                );
                
                $services_query = new WP_Query( $services_args );
                
                if ( $services_query->have_posts() ) :
                    while ( $services_query->have_posts() ) : $services_query->the_post();
                        // Get featured image
                        $service_image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                        if ( ! $service_image_url ) {
                            $service_image_url = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600"%3E%3Crect width="800" height="600" fill="%23f3f4f6"/%3E%3Cg opacity="0.3"%3E%3Cpath d="M400 200c-55.2 0-100 44.8-100 100s44.8 100 100 100 100-44.8 100-100-44.8-100-100-100zm0 160c-33.1 0-60-26.9-60-60s26.9-60 60-60 60 26.9 60 60-26.9 60-60 60z" fill="%239ca3af"/%3E%3Cpath d="M400 280c-11 0-20 9-20 20s9 20 20 20 20-9 20-20-9-20-20-20z" fill="%239ca3af"/%3E%3C/g%3E%3Ctext x="400" y="450" font-family="Arial, sans-serif" font-size="20" fill="%239ca3af" text-anchor="middle"%3ENo Image%3C/text%3E%3C/svg%3E';
                        }
                        
                        // Get service category
                        $service_terms = get_the_terms( get_the_ID(), 'service_category' );
                        $service_badge = '';
                        if ( $service_terms && ! is_wp_error( $service_terms ) ) {
                            $service_badge = $service_terms[0]->name;
                        }
                        
                        // Get pricing options
                        $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
                        $lowest_price = null;
                        $min_time = null;
                        $max_time = null;
                        
                        if ( is_array( $pricing_options ) && ! empty( $pricing_options ) ) {
                            foreach ( $pricing_options as $option ) {
                                // Extract numeric price value
                                $price_value = isset( $option['price'] ) ? $option['price'] : '';
                                $price_numeric = floatval( preg_replace( '/[^0-9.]/', '', $price_value ) );
                                
                                if ( $price_numeric > 0 ) {
                                    if ( $lowest_price === null || $price_numeric < $lowest_price ) {
                                        $lowest_price = $price_numeric;
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
                        <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl py-6 group overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-300 bg-card">
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
                                    
                                    <?php if ( $lowest_price ) : ?>
                                        <span class="text-primary font-semibold">From $<?php echo esc_html( number_format( $lowest_price, 0 ) ); ?></span>
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
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <!-- Additional sections will go here -->

</main>

<?php
get_footer();
