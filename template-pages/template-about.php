<?php
/**
 * Template Name: About Us
 * 
 * @package Julius_Theme
 */

get_header();
?>

<!-- Hero Section -->
<section class="relative h-[50vh] md:h-[60vh] flex items-center justify-center mt-[136px]">
    <?php
    $hero_image_id = get_theme_mod( 'julius_about_hero_image', 43 );
    $hero_image_url = wp_get_attachment_image_url( $hero_image_id, 'full' );
    ?>
    <img alt="Julius Spa Interior" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( $hero_image_url ); ?>">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 text-center text-white px-4">
        <p class="text-primary text-sm md:text-base tracking-[0.3em] uppercase mb-4 font-medium"><?php echo esc_html( get_theme_mod( 'julius_about_hero_subtitle', 'Our Story' ) ); ?></p>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4"><?php echo esc_html( get_theme_mod( 'julius_about_hero_title', 'About Julius Spa' ) ); ?></h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_about_hero_description', 'Discover the heart and soul behind Da Nang\'s premier wellness destination' ) ); ?></p>
    </div>
</section>

<!-- Journey & Tradition Section -->
<section class="py-16 md:py-24 bg-background">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="relative h-[400px] md:h-[500px] rounded-2xl overflow-hidden">
                    <?php
                    $journey_image_id = get_theme_mod( 'julius_about_journey_image', 44 );
                    $journey_image_url = wp_get_attachment_image_url( $journey_image_id, 'full' );
                    ?>
                    <img alt="Julius Spa Exterior" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( $journey_image_url ); ?>">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg hidden md:block">
                    <div class="text-4xl font-bold"><?php echo esc_html( get_theme_mod( 'julius_about_journey_years', '5+' ) ); ?></div>
                    <div class="text-sm">Years of Excellence</div>
                </div>
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-6"><?php echo esc_html( get_theme_mod( 'julius_about_journey_title', 'A Journey of Wellness & Tradition' ) ); ?></h2>
                <div class="space-y-4 text-muted-foreground leading-relaxed">
                    <p><?php echo esc_html( get_theme_mod( 'julius_about_journey_para1', 'Founded in 2019, Julius Spa was born from a passion to share the ancient art of Vietnamese massage and wellness traditions with visitors and locals alike. Nestled in the heart of Da Nang, our spa has become a sanctuary for those seeking authentic relaxation experiences.' ) ); ?></p>
                    <p><?php echo esc_html( get_theme_mod( 'julius_about_journey_para2', 'Our founder, with over 15 years of experience in traditional Vietnamese healing practices, envisioned a space where guests could escape the hustle of daily life and immerse themselves in tranquility. Every detail of Julius Spa - from the warm golden walls to the handcrafted massage beds - reflects our commitment to creating an atmosphere of peace and rejuvenation.' ) ); ?></p>
                    <p><?php echo esc_html( get_theme_mod( 'julius_about_journey_para3', 'Today, we continue to honor these traditions while embracing modern wellness techniques, ensuring every guest receives a truly memorable spa experience.' ) ); ?></p>
                </div>
                <div class="mt-8">
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>">
                        <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-9 has-[>svg]:px-3 bg-primary hover:bg-primary/90 text-primary-foreground px-8 py-3">Explore Our Services</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-primary/10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-primary mb-2"><?php echo esc_html( get_theme_mod( 'julius_about_stat1_number', '5+' ) ); ?></div>
                <div class="text-sm md:text-base text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat1_label', 'Years Experience' ) ); ?></div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-primary mb-2"><?php echo esc_html( get_theme_mod( 'julius_about_stat2_number', '10,000+' ) ); ?></div>
                <div class="text-sm md:text-base text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat2_label', 'Happy Customers' ) ); ?></div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-primary mb-2"><?php echo esc_html( get_theme_mod( 'julius_about_stat3_number', '15+' ) ); ?></div>
                <div class="text-sm md:text-base text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat3_label', 'Expert Therapists' ) ); ?></div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-primary mb-2"><?php echo esc_html( get_theme_mod( 'julius_about_stat4_number', '100%' ) ); ?></div>
                <div class="text-sm md:text-base text-muted-foreground"><?php echo esc_html( get_theme_mod( 'julius_about_stat4_label', 'Satisfaction Rate' ) ); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-16 md:py-24 bg-background">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html( get_theme_mod( 'julius_about_values_subtitle', 'What We Believe' ) ); ?></p>
            <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4"><?php echo esc_html( get_theme_mod( 'julius_about_values_title', 'Our Core Values' ) ); ?></h2>
            <p class="text-muted-foreground max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_about_values_description', 'These principles guide everything we do at Julius Spa' ) ); ?></p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-card border border-border rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-7 h-7 text-primary">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-foreground mb-3"><?php echo esc_html( get_theme_mod( 'julius_about_value1_title', 'Passion for Wellness' ) ); ?></h3>
                <p class="text-muted-foreground text-sm leading-relaxed"><?php echo esc_html( get_theme_mod( 'julius_about_value1_desc', 'We are dedicated to helping you achieve complete relaxation and rejuvenation through authentic Vietnamese spa traditions.' ) ); ?></p>
            </div>
            <div class="bg-card border border-border rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf w-7 h-7 text-primary">
                        <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                        <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-foreground mb-3"><?php echo esc_html( get_theme_mod( 'julius_about_value2_title', 'Natural Products' ) ); ?></h3>
                <p class="text-muted-foreground text-sm leading-relaxed"><?php echo esc_html( get_theme_mod( 'julius_about_value2_desc', 'We use only premium natural oils, herbs, and organic ingredients sourced from local Vietnamese suppliers.' ) ); ?></p>
            </div>
            <div class="bg-card border border-border rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-7 h-7 text-primary">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-foreground mb-3"><?php echo esc_html( get_theme_mod( 'julius_about_value3_title', 'Expert Therapists' ) ); ?></h3>
                <p class="text-muted-foreground text-sm leading-relaxed"><?php echo esc_html( get_theme_mod( 'julius_about_value3_desc', 'Our skilled team has years of experience in traditional massage techniques, ensuring the highest quality service.' ) ); ?></p>
            </div>
            <div class="bg-card border border-border rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-7 h-7 text-primary">
                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-foreground mb-3"><?php echo esc_html( get_theme_mod( 'julius_about_value4_title', 'Safe & Hygienic' ) ); ?></h3>
                <p class="text-muted-foreground text-sm leading-relaxed"><?php echo esc_html( get_theme_mod( 'julius_about_value4_desc', 'Your health is our priority. We maintain the highest standards of cleanliness and hygiene in all our facilities.' ) ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Julius Spa Difference Section -->
<section class="py-16 md:py-24 bg-background">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html( get_theme_mod( 'julius_about_diff_subtitle', 'Why Julius Spa' ) ); ?></p>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-6"><?php echo esc_html( get_theme_mod( 'julius_about_diff_title', 'The Julius Spa Difference' ) ); ?></h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-6 h-6 text-primary">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_diff1_title', '5-Star Service' ) ); ?></h3>
                            <p class="text-muted-foreground text-sm"><?php echo esc_html( get_theme_mod( 'julius_about_diff1_desc', 'Every guest receives personalized attention and premium care from arrival to departure.' ) ); ?></p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award w-6 h-6 text-primary">
                                <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path>
                                <circle cx="12" cy="8" r="6"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_diff2_title', 'Award-Winning Quality' ) ); ?></h3>
                            <p class="text-muted-foreground text-sm"><?php echo esc_html( get_theme_mod( 'julius_about_diff2_desc', 'Recognized by Da Nang Tourism for excellence in spa services and customer satisfaction.' ) ); ?></p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-primary">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_diff3_title', 'Flexible Hours' ) ); ?></h3>
                            <p class="text-muted-foreground text-sm"><?php echo esc_html( get_theme_mod( 'julius_about_diff3_desc', 'Open from 9:00 AM to 10:00 PM daily to accommodate your busy schedule.' ) ); ?></p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-6 h-6 text-primary">
                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                <path d="M20 3v4"></path>
                                <path d="M22 5h-4"></path>
                                <path d="M4 17v2"></path>
                                <path d="M5 18H3"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground mb-1"><?php echo esc_html( get_theme_mod( 'julius_about_diff4_title', 'Authentic Experience' ) ); ?></h3>
                            <p class="text-muted-foreground text-sm"><?php echo esc_html( get_theme_mod( 'julius_about_diff4_desc', 'Traditional Vietnamese techniques combined with modern wellness practices.' ) ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="relative h-48 rounded-xl overflow-hidden">
                        <img alt="Massage Room" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( wp_get_attachment_image_url( 45, 'full' ) ); ?>">
                    </div>
                    <div class="relative h-64 rounded-xl overflow-hidden">
                        <img alt="Julius Branded Towel" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( wp_get_attachment_image_url( 46, 'full' ) ); ?>">
                    </div>
                </div>
                <div class="space-y-4 pt-8">
                    <div class="relative h-64 rounded-xl overflow-hidden">
                        <img alt="Group Room" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( wp_get_attachment_image_url( 47, 'full' ) ); ?>">
                    </div>
                    <div class="relative h-48 rounded-xl overflow-hidden">
                        <img alt="Treatment Room" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="<?php echo esc_url( wp_get_attachment_image_url( 48, 'full' ) ); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Gallery Section -->
<section class="py-16 md:py-24 bg-secondary/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html( get_theme_mod( 'julius_about_space_subtitle', 'Our Space' ) ); ?></p>
            <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4"><?php echo esc_html( get_theme_mod( 'julius_about_space_title', 'Experience Julius Spa' ) ); ?></h2>
            <p class="text-muted-foreground max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_about_space_description', 'Step into our tranquil sanctuary designed for your complete relaxation' ) ); ?></p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
            <?php
            $our_space_images = get_option( 'julius_our_space_images', array( 49, 50, 51, 52, 53, 54 ) );
            
            if ( ! empty( $our_space_images ) ) :
                foreach ( $our_space_images as $index => $image_id ) :
                    $image_url = wp_get_attachment_image_url( $image_id, 'large' );
                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    
                    if ( ! $image_url ) continue;
                    
                    // Determine column span class based on position
                    $col_span_class = '';
                    if ( $index === 0 || ( $index > 0 && ( $index + 1 ) % 5 === 0 ) ) {
                        $col_span_class = 'col-span-2';
                    }
                    ?>
                    <div class="relative h-48 md:h-64 rounded-xl overflow-hidden <?php echo esc_attr( $col_span_class ); ?>">
                        <img 
                            alt="<?php echo esc_attr( $image_alt ? $image_alt : 'Julius Spa Image' ); ?>" 
                            loading="lazy" 
                            decoding="async" 
                            data-nimg="fill" 
                            class="object-cover hover:scale-105 transition-transform duration-500" 
                            style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" 
                            src="<?php echo esc_url( $image_url ); ?>"
                        >
                    </div>
                <?php 
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-primary text-primary-foreground">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html( get_theme_mod( 'julius_about_cta_title', 'Ready to Experience True Relaxation?' ) ); ?></h2>
        <p class="text-primary-foreground/80 max-w-2xl mx-auto mb-8 text-lg"><?php echo esc_html( get_theme_mod( 'julius_about_cta_description', 'Book your appointment today and let our expert therapists transport you to a world of tranquility and wellness.' ) ); ?></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 bg-white text-primary hover:bg-white/90 px-8"><?php echo esc_html( get_theme_mod( 'julius_about_cta_button1_text', 'Book Now' ) ); ?></button>
            </a>
            <a href="<?php echo esc_url( home_url( '/services' ) ); ?>">
                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border shadow-xs hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-10 rounded-md has-[>svg]:px-4 border-white text-white hover:bg-white/10 px-8 bg-transparent"><?php echo esc_html( get_theme_mod( 'julius_about_cta_button2_text', 'View Services' ) ); ?></button>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
