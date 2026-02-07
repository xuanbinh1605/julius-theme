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

    <!-- Additional sections will go here -->

</main>

<?php
get_footer();
