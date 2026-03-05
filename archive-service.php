<?php
/**
 * Archive Service Template
 *
 * @package Julius_Theme
 */

get_header();

// Get all service categories
$categories = get_terms( array(
    'taxonomy'   => 'service_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

// Get hero image from first service or use placeholder
$hero_image = 'https://picsum.photos/seed/services/1920/600';
$first_service = get_posts( array( 'post_type' => 'service', 'numberposts' => 1 ) );
if ( ! empty( $first_service ) ) {
    $featured_img = get_the_post_thumbnail_url( $first_service[0]->ID, 'full' );
    if ( $featured_img ) {
        $hero_image = $featured_img;
    }
}
?>

<!-- Hero Section -->
<section class="relative h-[40vh] min-h-[320px] flex items-end justify-center pb-10 mt-[120px] julius-hero-section">
    <?php 
    // Get custom hero image from customizer, fallback to first service image
    $custom_hero_image = get_theme_mod( 'julius_service_hero_image', '' );
    $hero_image_url = ! empty( $custom_hero_image ) ? esc_url( $custom_hero_image ) : esc_url( $hero_image );
    ?>
    <img 
        alt="Julius Spa Services" 
        decoding="async" 
        class="object-cover" 
        src="<?php echo $hero_image_url; ?>" 
        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
    >
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 text-center px-4">
        <p class="text-primary text-sm tracking-[0.2em] uppercase mb-2 font-medium"><?php echo esc_html( get_theme_mod( 'julius_service_hero_subtitle', 'Julius Spa' ) ); ?></p>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3"><?php echo esc_html( get_theme_mod( 'julius_service_hero_title', 'Our Services' ) ); ?></h1>
        <p class="text-white/80 text-sm md:text-base max-w-md mx-auto"><?php echo esc_html( get_theme_mod( 'julius_service_hero_description', 'Choose from our wide range of relaxation treatments' ) ); ?></p>
    </div>
</section>

<!-- Filter Category Bar with Search -->
<div class="sticky top-[72px] md:top-[120px] z-40 bg-background border-b border-border shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="max-w-5xl mx-auto">
            <div class="mb-4">
                <div class="relative max-w-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <input 
                        type="text" 
                        id="julius-service-search"
                        placeholder="Search services..." 
                        class="w-full h-10 pl-10 pr-10 rounded-lg border border-border bg-card text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm"
                    >
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <button 
                    class="julius-category-filter px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors bg-primary text-primary-foreground" 
                    data-category="all"
                >
                    All
                </button>
                <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                    <?php foreach ( $categories as $category ) : ?>
                        <button 
                            class="julius-category-filter px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors bg-secondary/50 text-muted-foreground hover:bg-secondary hover:text-foreground" 
                            data-category="<?php echo esc_attr( $category->term_id ); ?>"
                        >
                            <?php echo esc_html( $category->name ); ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Services Listing -->
<section class="py-10 md:py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div id="julius-services-container">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">
                    <?php
                    // Query all services initially
                    $all_services_query = new WP_Query( array(
                        'post_type'      => 'service',
                        'posts_per_page' => -1,
                        'orderby'        => 'menu_order title',
                        'order'          => 'ASC',
                    ) );
                    
                    if ( $all_services_query->have_posts() ) :
                        while ( $all_services_query->have_posts() ) : $all_services_query->the_post();
                            $pricing_options = get_post_meta( get_the_ID(), '_julius_pricing_options', true );
                            
                            // Get featured image or placeholder
                            $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            if ( ! $featured_img ) {
                                // Use picsum with calculated ID (modulo 1000 for valid range)
                                $picsum_id = ( get_the_ID() % 1000 );
                                $featured_img = 'https://picsum.photos/id/' . $picsum_id . '/800/600';
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
                        wp_reset_postdata();
                    else : ?>
                        <div class="col-span-full text-center py-12">
                            <p class="text-muted-foreground">No services found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Julius Special Combo Section -->
            <div class="mt-12 bg-secondary/30 rounded-2xl overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="relative h-64 md:h-auto">
                        <img 
                            alt="Julius Special Combo" 
                            loading="lazy" 
                            decoding="async" 
                            class="object-cover" 
                            src="https://picsum.photos/id/42/800/600" 
                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
                        >
                        <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent md:bg-gradient-to-t"></div>
                    </div>
                    <div class="p-6 md:p-8">
                        <h2 class="text-xl md:text-2xl font-bold text-foreground mb-6 tracking-wide">JULIUS SPECIAL COMBO</h2>
                        <div class="space-y-3">
                            <a class="flex justify-between items-center py-3 px-4 bg-card hover:bg-primary/10 rounded-lg transition-colors group border border-border" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                                <span class="text-foreground text-sm group-hover:text-primary transition-colors">COMBO 1: Massage 90 min + Facial 30 min</span>
                                <span class="text-primary font-bold text-sm flex items-center gap-2">
                                    800,000
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </span>
                            </a>
                            <a class="flex justify-between items-center py-3 px-4 bg-card hover:bg-primary/10 rounded-lg transition-colors group border border-border" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                                <span class="text-foreground text-sm group-hover:text-primary transition-colors">COMBO 2: Massage 90 min + Shampoo 30 min</span>
                                <span class="text-primary font-bold text-sm flex items-center gap-2">
                                    800,000
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </span>
                            </a>
                            <a class="flex justify-between items-center py-3 px-4 bg-card hover:bg-primary/10 rounded-lg transition-colors group border border-border" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                                <span class="text-foreground text-sm group-hover:text-primary transition-colors">COMBO 3: Facial Care + Healing Shampoo</span>
                                <span class="text-primary font-bold text-sm flex items-center gap-2">
                                    750,000
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 w-full mt-6">
                            Book a Combo Package
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Notes Section -->
            <div class="mt-10 p-4 bg-secondary/20 rounded-xl border border-border">
                <div class="space-y-2 text-sm text-muted-foreground">
                    <p class="flex items-start gap-2">
                        <span class="text-primary">*</span>
                        <span>Applied from <strong class="text-foreground">February 15th ~ February 22th</strong></span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="text-primary">*</span>
                        <span>After 10PM, service charge <strong class="text-foreground">100,000 VND/hour/person</strong></span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span class="text-primary">*</span>
                        <span>The massage price <strong class="text-foreground">included TIP</strong>. If massage therapist request tips, please tell to manager</span>
                    </p>
                </div>
            </div>
            
            <!-- Location Cards -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-card border border-border rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-5 h-5 text-primary">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-foreground">Julius 1</h4>
                            <p class="text-muted-foreground text-sm">5 An Thuong 38, Da Nang</p>
                            <a href="tel:0775509057" class="text-primary text-sm font-medium hover:underline">Tel: 0775 509 057</a>
                        </div>
                    </div>
                </div>
                <div class="bg-card border border-border rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-5 h-5 text-primary">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-foreground">Julius 2</h4>
                            <p class="text-muted-foreground text-sm">61 Ta My Duat, Da Nang</p>
                            <a href="tel:0787509157" class="text-primary text-sm font-medium hover:underline">Tel: 0787 509 157</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Final CTA -->
            <div class="mt-8 text-center">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4 mr-2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Book Your Appointment
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
