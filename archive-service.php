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

<!-- Filter Category Bar -->
<div class="sticky top-[72px] md:top-[120px] z-40 bg-background border-b border-border shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex overflow-x-auto scrollbar-hide gap-1 py-2 -mx-4 px-4 md:mx-0 md:px-0 md:justify-center">
            <button 
                class="julius-category-filter px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-all bg-primary text-primary-foreground" 
                data-category="all"
            >
                All Services
            </button>
            <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                <?php foreach ( $categories as $category ) : ?>
                    <button 
                        class="julius-category-filter px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-all bg-secondary/50 text-foreground hover:bg-secondary" 
                        data-category="<?php echo esc_attr( $category->term_id ); ?>"
                    >
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Services Listing -->
<section class="py-6 md:py-10">
    <div class="container mx-auto px-4">
        <div id="julius-services-container" class="max-w-5xl mx-auto">
            <?php
            // Get all categories for initial display
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                foreach ( $categories as $category ) :
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
                            $cat_image = wp_get_attachment_image_url( $cat_image_id, 'full' );
                        } else {
                            $cat_image = 'https://picsum.photos/seed/' . $category->term_id . '/800/400';
                            $first_post = $services_query->posts[0];
                            $cat_featured = get_the_post_thumbnail_url( $first_post->ID, 'full' );
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
            endif;
            ?>
        </div>
        
        <!-- General Note -->
        <div class="max-w-5xl mx-auto mt-8">
            <div class="p-3 bg-secondary/30 rounded-lg border border-border">
                <p class="text-xs text-muted-foreground text-center">
                    <?php echo wp_kses_post( get_theme_mod( 'julius_service_note_line1', '<strong>Note:</strong> Prices exclude TIP. +50,000 VND/hour after 10PM.' ) ); ?>
                    <span class="hidden sm:inline"> | </span>
                    <br class="sm:hidden">
                    <?php echo wp_kses_post( get_theme_mod( 'julius_service_note_line2', '<strong>TIP:</strong> 60min: 50k | 90min: 70k | 120min: 100k VND' ) ); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
