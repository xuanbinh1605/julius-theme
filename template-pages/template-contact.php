<?php
/**
 * Template Name: Contact Us
 * 
 * @package Julius_Theme
 */

get_header();
?>

<!-- Contact Hero & Form Section -->
<section class="relative min-h-screen flex flex-col lg:flex-row lg:pt-[120px]">
    <!-- Left Side - Contact Info with Image -->
    <div class="relative w-full lg:w-1/2 min-h-[70vh] lg:h-auto lg:min-h-screen">
        <?php $hero_image_id = get_theme_mod( 'julius_contact_hero_image', 46 ); ?>
        <img alt="Julius Spa Contact" decoding="async" data-nimg="fill" class="object-cover" src="<?php echo esc_url( wp_get_attachment_image_url( $hero_image_id, 'full' ) ); ?>" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
        <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
        
        <div class="absolute inset-0 flex flex-col justify-end lg:justify-center p-8 lg:p-12 xl:p-16 lg:pt-40">
            <div class="max-w-md">
                <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html( get_theme_mod( 'julius_contact_hero_subtitle', 'Contact Us' ) ); ?></p>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4"><?php echo esc_html( get_theme_mod( 'julius_contact_hero_title', 'Get In Touch' ) ); ?></h1>
                <p class="text-white/80 text-lg mb-8"><?php echo esc_html( get_theme_mod( 'julius_contact_hero_description', 'Ready to experience ultimate relaxation? Book your appointment or ask us anything.' ) ); ?></p>
                
                <div class="space-y-4">
                    <?php 
                    $phone = get_theme_mod( 'julius_phone_number', '+84 123 456 789' );
                    $email = get_theme_mod( 'julius_email', 'info@juliusspa.com' );
                    $address = get_theme_mod( 'julius_address', 'Phan Boi Street, Da Nang, Vietnam' );
                    $hours = get_theme_mod( 'julius_opening_hours', '9:00 AM - 10:00 PM' );
                    ?>
                    
                    <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>" class="flex items-center gap-4 text-white hover:text-primary transition-colors group">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-primary/20 rounded-full flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-5 h-5">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Call Us</p>
                            <p class="font-medium"><?php echo esc_html( $phone ); ?></p>
                        </div>
                    </a>
                    
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="flex items-center gap-4 text-white hover:text-primary transition-colors group">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-primary/20 rounded-full flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-5 h-5">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Email</p>
                            <p class="font-medium"><?php echo esc_html( $email ); ?></p>
                        </div>
                    </a>
                    
                    <div class="flex items-center gap-4 text-white">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-5 h-5">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Address</p>
                            <p class="font-medium"><?php echo esc_html( $address ); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 text-white">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white/60">Open Hours</p>
                            <p class="font-medium"><?php echo esc_html( $hours ); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-8">
                    <?php 
                    $facebook_url = get_theme_mod( 'julius_facebook_url', '' );
                    $instagram_url = get_theme_mod( 'julius_instagram_url', '' );
                    
                    if ( $facebook_url ) : ?>
                        <a href="<?php echo esc_url( $facebook_url ); ?>" class="w-10 h-10 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center text-white transition-colors" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-5 h-5">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ( $instagram_url ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" class="w-10 h-10 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center text-white transition-colors" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram w-5 h-5">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center text-white transition-colors" aria-label="Zalo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-5 h-5">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Side - Contact Form -->
    <div class="w-full lg:w-1/2 flex items-start lg:items-center justify-center p-8 lg:p-12 xl:p-16 bg-background pt-8 lg:pt-[140px]">
        <div class="w-full max-w-lg">
            <h2 class="text-2xl md:text-3xl font-bold text-foreground mb-2">Book Your Session</h2>
            <p class="text-muted-foreground mb-8">Fill out the form below and we will contact you to confirm your booking.</p>
            
            <form id="contact-form" class="space-y-5" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
                <input type="hidden" name="action" value="julius_contact_form">
                <?php wp_nonce_field( 'julius_contact_form', 'julius_contact_nonce' ); ?>
                
                <!-- Notification Area -->
                <div id="form-notification" class="hidden p-4 rounded-md mb-4"></div>
                
                <div>
                    <label for="name" class="block text-sm font-medium text-foreground mb-2">Full Name *</label>
                    <input data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 w-full min-w-0 rounded-md border px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background border-border h-12" id="name" required placeholder="Enter your name" type="text" name="name">
                    <p class="error-message hidden"></p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground mb-2">Email *</label>
                        <input data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 w-full min-w-0 rounded-md border px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background border-border h-12" id="email" required placeholder="your@email.com" type="email" name="email">
                        <p class="error-message hidden"></p>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-foreground mb-2">Phone Number *</label>
                        <input data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 w-full min-w-0 rounded-md border px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background border-border h-12" id="phone" required placeholder="+84 xxx xxx xxx" type="tel" name="phone">
                        <p class="error-message hidden"></p>
                    </div>
                </div>
                
                <div>
                    <label for="branch" class="block text-sm font-medium text-foreground mb-2">Select Branch *</label>
                    <select id="branch" name="branch" required class="w-full h-12 px-4 rounded-md border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <option value="">Choose a branch...</option>
                        <option value="julius-1">Julius 1 - 5 An Thuong 38, Da Nang (0775 509 057)</option>
                        <option value="julius-2">Julius 2 - 61 Ta My Duat, Da Nang (0787 509 157)</option>
                    </select>
                    <p class="error-message hidden"></p>
                </div>
                
                <div>
                    <label for="service" class="block text-sm font-medium text-foreground mb-2">Select Service *</label>
                    <select id="service" name="service" required class="w-full h-12 px-4 rounded-md border border-border bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <option value="">Choose a service...</option>
                        <?php
                        // Get all service categories
                        $service_categories = get_terms( array(
                            'taxonomy' => 'service_category',
                            'hide_empty' => true,
                            'orderby' => 'name',
                            'order' => 'ASC'
                        ) );
                        
                        if ( ! empty( $service_categories ) && ! is_wp_error( $service_categories ) ) :
                            foreach ( $service_categories as $category ) :
                                // Get services for this category
                                $services = get_posts( array(
                                    'post_type' => 'service',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'service_category',
                                            'field' => 'term_id',
                                            'terms' => $category->term_id,
                                        ),
                                    ),
                                ) );
                                
                                if ( ! empty( $services ) ) :
                                    ?>
                                    <optgroup label="<?php echo esc_attr( $category->name ); ?>">
                                        <?php foreach ( $services as $service ) : ?>
                                            <option value="<?php echo esc_attr( $service->ID ); ?>">
                                                <?php echo esc_html( $service->post_title ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <p class="error-message hidden"></p>
                </div>
                
                <div>
                    <label for="message" class="block text-sm font-medium text-foreground mb-2">Message</label>
                    <textarea data-slot="textarea" class="placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content min-h-16 w-full rounded-md border px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-background border-border resize-none" id="message" name="message" rows="4" placeholder="Tell us your preferred date, time, or any special requests..."></textarea>
                </div>
                
                <button id="submit-btn" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive px-4 py-2 has-[>svg]:px-3 w-full bg-primary hover:bg-primary/90 text-primary-foreground h-14 text-lg font-medium" type="submit">
                    <svg id="send-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-5 h-5 mr-2">
                        <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
                        <path d="m21.854 2.147-10.94 10.939"></path>
                    </svg>
                    <svg id="loading-icon" class="hidden animate-spin w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="button-text">Send Message</span>
                </button>
                
                <p class="text-center text-sm text-muted-foreground">
                    Or call us directly at <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>" class="text-primary hover:underline font-medium"><?php echo esc_html( $phone ); ?></a>
                </p>
            </form>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 md:py-24 bg-secondary/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium"><?php echo esc_html( get_theme_mod( 'julius_contact_map_subtitle', 'Our Location' ) ); ?></p>
            <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4"><?php echo esc_html( get_theme_mod( 'julius_contact_map_title', 'Find Us Here' ) ); ?></h2>
            <p class="text-muted-foreground max-w-2xl mx-auto"><?php echo esc_html( get_theme_mod( 'julius_contact_map_description', 'Located in the heart of An Thuong area, just minutes from the beautiful beaches of Da Nang.' ) ); ?></p>
        </div>
        <div class="relative h-[400px] md:h-[500px] rounded-2xl overflow-hidden border border-border shadow-lg">
            <?php $map_embed = get_theme_mod( 'julius_contact_map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0983994977997!2d108.24!3d16.05!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDAzJzAwLjAiTiAxMDjCsDE0JzI0LjAiRQ!5e0!3m2!1sen!2s!4v1234567890' ); ?>
            <iframe src="<?php echo esc_url( $map_embed ); ?>" width="100%" height="100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Julius Spa Location" style="border: 0px;"></iframe>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-20 md:py-28">
    <?php $cta_image_id = get_theme_mod( 'julius_contact_cta_image', 47 ); ?>
    <img alt="Julius Spa Interior" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" src="<?php echo esc_url( wp_get_attachment_image_url( $cta_image_id, 'full' ) ); ?>" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative z-10 container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6"><?php echo esc_html( get_theme_mod( 'julius_contact_cta_title', 'Ready to Experience True Relaxation?' ) ); ?></h2>
        <p class="text-white/80 text-lg max-w-2xl mx-auto mb-8"><?php echo esc_html( get_theme_mod( 'julius_contact_cta_description', 'Book your appointment today and let our expert therapists transport you to a world of tranquility.' ) ); ?></p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <?php 
            $button1_text = get_theme_mod( 'julius_contact_cta_button1_text', 'View Our Services' );
            $button1_link = get_theme_mod( 'julius_contact_cta_button1_link', '/services' );
            // If link is relative, convert to absolute
            $button1_url = ( strpos( $button1_link, 'http' ) === 0 ) ? $button1_link : home_url( $button1_link );
            ?>
            <a href="<?php echo esc_url( $button1_url ); ?>">
                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 bg-primary hover:bg-primary/90 text-primary-foreground px-8">
                    <?php echo esc_html( $button1_text ); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 ml-1">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </a>
            <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>">
                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border shadow-xs hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-10 rounded-md has-[>svg]:px-4 border-white text-white hover:bg-white/10 px-8 bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4 mr-2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <?php echo esc_html( get_theme_mod( 'julius_contact_cta_button2_text', 'Call Now' ) ); ?>
                </button>
 <style>
    .error-border {
        border-color: #ef4444 !important;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const buttonText = document.getElementById('button-text');
    const sendIcon = document.getElementById('send-icon');
    const loadingIcon = document.getElementById('loading-icon');
    const notification = document.getElementById('form-notification');
    
    // Required fields
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const branchSelect = document.getElementById('branch');
    const serviceSelect = document.getElementById('service');
    
    // Validation functions
    function validateName(input) {
        const value = input.value.trim();
        const errorMsg = input.parentElement.querySelector('.error-message');
        
        if (value === '') {
            showError(input, errorMsg, 'Full name is required');
            return false;
        } else if (value.length < 2) {
            showError(input, errorMsg, 'Name must be at least 2 characters');
            return false;
        } else {
            clearError(input, errorMsg);
            return true;
        }
    }
    
    function validateEmail(input) {
        const value = input.value.trim();
        const errorMsg = input.parentElement.querySelector('.error-message');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (value === '') {
            showError(input, errorMsg, 'Email is required');
            return false;
        } else if (!emailRegex.test(value)) {
            showError(input, errorMsg, 'Please enter a valid email address');
            return false;
        } else {
            clearError(input, errorMsg);
            return true;
        }
    }
    
    function validatePhone(input) {
        const value = input.value.trim();
        const errorMsg = input.parentElement.querySelector('.error-message');
        
        if (value === '') {
            showError(input, errorMsg, 'Phone number is required');
            return false;
        } else if (value.length < 8) {
            showError(input, errorMsg, 'Please enter a valid phone number');
            return false;
        } else {
            clearError(input, errorMsg);
            return true;
        }
    }
    
    function validateBranch(select) {
        const value = select.value;
        const errorMsg = select.parentElement.querySelector('.error-message');
        
        if (value === '') {
            showError(select, errorMsg, 'Please select a branch');
            return false;
        } else {
            clearError(select, errorMsg);
            return true;
        }
    }
    
    function validateService(select) {
        const value = select.value;
        const errorMsg = select.parentElement.querySelector('.error-message');
        
        if (value === '') {
            showError(select, errorMsg, 'Please select a service');
            return false;
        } else {
            clearError(select, errorMsg);
            return true;
        }
    }
    
    function showError(element, errorMsg, message) {
        element.classList.add('error-border');
        errorMsg.textContent = message;
        errorMsg.classList.remove('hidden');
    }
    
    function clearError(element, errorMsg) {
        element.classList.remove('error-border');
        errorMsg.textContent = '';
        errorMsg.classList.add('hidden');
    }
    
    function showNotification(message, type) {
        notification.className = '';
        
        if (type === 'success') {
            notification.classList.add('notification-success');
        } else {
            notification.classList.add('notification-error');
        }
        
        notification.textContent = message;
        notification.classList.remove('hidden');
        
        // Scroll to notification
        notification.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Hide after 5 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    }
    
    // Live validation on blur
    nameInput.addEventListener('blur', () => validateName(nameInput));
    emailInput.addEventListener('blur', () => validateEmail(emailInput));
    phoneInput.addEventListener('blur', () => validatePhone(phoneInput));
    branchSelect.addEventListener('change', () => validateBranch(branchSelect));
    serviceSelect.addEventListener('change', () => validateService(serviceSelect));
    
    // Clear error on input
    nameInput.addEventListener('input', function() {
        if (this.classList.contains('error-border')) {
            validateName(this);
        }
    });
    
    emailInput.addEventListener('input', function() {
        if (this.classList.contains('error-border')) {
            validateEmail(this);
        }
    });
    
    phoneInput.addEventListener('input', function() {
        if (this.classList.contains('error-border')) {
            validatePhone(this);
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all required fields
        const isNameValid = validateName(nameInput);
        const isEmailValid = validateEmail(emailInput);
        const isPhoneValid = validatePhone(phoneInput);
        const isBranchValid = validateBranch(branchSelect);
        const isServiceValid = validateService(serviceSelect);
        
        if (!isNameValid || !isEmailValid || !isPhoneValid || !isBranchValid || !isServiceValid) {
            showNotification('Please fix the errors before submitting', 'error');
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        buttonText.textContent = 'Sending...';
        sendIcon.classList.add('hidden');
        loadingIcon.classList.remove('hidden');
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit form via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Thank you! Your message has been sent successfully. We will contact you soon.', 'success');
                form.reset();
            } else {
                showNotification(data.message || 'Something went wrong. Please try again.', 'error');
            }
        })
        .catch(error => {
            showNotification('Error sending message. Please try calling us directly.', 'error');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            buttonText.textContent = 'Send Message';
            sendIcon.classList.remove('hidden');
            loadingIcon.classList.add('hidden');
        });
    });
});
</script>

<           </a>
        </div>
    </div>
</section>

<?php
get_footer();
