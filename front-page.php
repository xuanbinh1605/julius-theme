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
    <section class="relative h-screen min-h-[600px] overflow-hidden hero-slider hero-section">
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
                        $service_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
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
                                $about_image_1_url = wp_get_attachment_image_url( $about_image_1_id, 'full' );
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
                                $about_image_2_url = wp_get_attachment_image_url( $about_image_2_id, 'full' );
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
                                $about_image_3_url = wp_get_attachment_image_url( $about_image_3_id, 'full' );
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
                                $about_image_4_url = wp_get_attachment_image_url( $about_image_4_id, 'full' );
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
                <?php
                // Get gallery images from admin
                $gallery_images = get_option( 'julius_gallery_images', array() );
                $gallery_count = get_theme_mod( 'julius_gallery_count', 10 );
                
                // Limit images to display count
                $gallery_images = array_slice( $gallery_images, 0, $gallery_count );
                
                // Define special layout positions (1-based index)
                $large_positions = array( 1 ); // First image is large (2x2)
                $wide_positions = array( 5, 8 ); // Wide images (2x1)
                
                if ( ! empty( $gallery_images ) ) {
                    $index = 1;
                    foreach ( $gallery_images as $image_id ) {
                        $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                        if ( ! $image_url ) {
                            continue;
                        }
                        
                        // Determine grid span classes
                        $grid_class = '';
                        if ( in_array( $index, $large_positions ) ) {
                            $grid_class = 'md:col-span-2 md:row-span-2';
                            $image_size = 'full';
                        } elseif ( in_array( $index, $wide_positions ) ) {
                            $grid_class = 'md:col-span-2';
                            $image_size = 'full';
                        } else {
                            $image_size = 'full';
                        }
                        
                        // Get proper size image
                        $image_url = wp_get_attachment_image_url( $image_id, $image_size );
                        
                        // Get alt text
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        if ( empty( $image_alt ) ) {
                            $image_alt = 'Julius Spa gallery image';
                        }
                        ?>
                        <div class="relative overflow-hidden rounded-lg cursor-pointer group <?php echo esc_attr( $grid_class ); ?>" data-gallery-image="<?php echo esc_url( $image_url ); ?>" data-gallery-alt="<?php echo esc_attr( $image_alt ); ?>">
                            <img 
                                alt="<?php echo esc_attr( $image_alt ); ?>" 
                                loading="lazy" 
                                decoding="async" 
                                data-nimg="fill" 
                                class="object-cover group-hover:scale-110 transition-transform duration-500" 
                                style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                                src="<?php echo esc_url( $image_url ); ?>"
                            >
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-white">
                                    <path d="M21 21l-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"></path>
                                    <path d="M10 8v6m-3-3h6"></path>
                                </svg>
                            </div>
                        </div>
                        <?php
                        $index++;
                    }
                } else {
                    ?>
                    <div class="col-span-2 md:col-span-4 text-center py-12">
                        <p class="text-muted-foreground">
                            <?php _e( 'No gallery images yet. Add images from the Gallery admin menu.', 'julius-theme' ); ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 md:py-28 overflow-hidden">
        <div class="absolute inset-0">
            <?php
            $cta_image_id = get_theme_mod( 'julius_cta_image', 24 );
            $cta_image_url = wp_get_attachment_image_url( $cta_image_id, 'full' );
            if ( $cta_image_url ) {
                $cta_image_alt = get_post_meta( $cta_image_id, '_wp_attachment_image_alt', true );
                if ( empty( $cta_image_alt ) ) {
                    $cta_image_alt = 'Julius Spa at night';
                }
                ?>
                <img 
                    alt="<?php echo esc_attr( $cta_image_alt ); ?>" 
                    loading="lazy" 
                    decoding="async" 
                    data-nimg="fill" 
                    class="object-cover" 
                    style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                    src="<?php echo esc_url( $cta_image_url ); ?>"
                >
                <?php
            }
            ?>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/70 to-black/80"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 bg-primary/20 backdrop-blur-sm border border-primary/50 rounded-full px-4 py-2 mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-5 h-5 text-primary">
                        <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                        <path d="M12 8v13"></path>
                        <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                        <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                    </svg>
                    <span class="text-primary font-medium"><?php echo esc_html( get_theme_mod( 'julius_cta_badge', 'Special Offer: 15% OFF First Visit' ) ); ?></span>
                </div>
                
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-semibold text-white mb-6 text-balance">
                    <?php echo esc_html( get_theme_mod( 'julius_cta_heading_1', 'Ready to Experience' ) ); ?>
                    <span class="block text-accent"><?php echo esc_html( get_theme_mod( 'julius_cta_heading_2', 'True Relaxation?' ) ); ?></span>
                </h2>
                
                <p class="text-white/80 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                    <?php echo esc_html( get_theme_mod( 'julius_cta_description', 'Book your appointment today and let our expert therapists transport you to a world of tranquility and wellness.' ) ); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-lg mx-auto mb-10">
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-lg p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-6 h-6 text-primary">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="text-white/60 text-sm">Call Us</p>
                            <p class="text-white font-medium"><?php echo esc_html( get_theme_mod( 'julius_cta_phone', '+84 123 456 789' ) ); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-lg p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-primary">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <div class="text-left">
                            <p class="text-white/60 text-sm">Open Hours</p>
                            <p class="text-white font-medium"><?php echo esc_html( get_theme_mod( 'julius_cta_hours', '9:00 AM - 10:00 PM' ) ); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url( get_theme_mod( 'julius_cta_button_1_link', '/contact' ) ); ?>" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 bg-primary hover:bg-primary/90 text-primary-foreground px-10 py-6 text-lg">
                        <?php echo esc_html( get_theme_mod( 'julius_cta_button_1_text', 'Book Now' ) ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive shadow-xs dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-10 rounded-md has-[>svg]:px-4 border-2 border-white text-white hover:bg-white hover:text-foreground px-10 py-6 text-lg bg-transparent">
                        <?php echo esc_html( get_theme_mod( 'julius_cta_button_2_text', 'View Menu' ) ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
