<?php
/**
 * The footer template
 *
 * @package Julius_Theme
 */
?>

<footer class="bg-foreground text-background">
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            
            <!-- Brand & Social -->
            <div class="lg:col-span-1">
                <?php 
                $logo_id = get_theme_mod( 'julius_logo_image', 6 );
                if ( $logo_id ) :
                    $logo = wp_get_attachment_image_src( $logo_id, 'full' );
                    if ( $logo ) :
                ?>
                    <a class="inline-block mb-6" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img 
                            alt="<?php bloginfo( 'name' ); ?>" 
                            loading="lazy" 
                            width="140" 
                            height="90" 
                            decoding="async" 
                            class="h-20 w-auto brightness-0 invert" 
                            src="<?php echo esc_url( $logo[0] ); ?>"
                        >
                    </a>
                <?php 
                    endif;
                else : 
                ?>
                    <a class="inline-block mb-6 text-xl font-bold" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>
                
                <p class="text-background/70 mb-6 leading-relaxed">
                    <?php 
                    $description = get_bloginfo( 'description' );
                    echo $description ? esc_html( $description ) : 'Experience authentic Vietnamese relaxation at Julius Spa. Your sanctuary of peace and wellness.';
                    ?>
                </p>
                
                <div class="flex gap-4">
                    <?php 
                    $facebook_url = get_theme_mod( 'julius_facebook_url', '' );
                    $instagram_url = get_theme_mod( 'julius_instagram_url', '' );
                    
                    if ( $facebook_url ) : ?>
                        <a href="<?php echo esc_url( $facebook_url ); ?>" class="w-10 h-10 rounded-full bg-background/10 hover:bg-primary flex items-center justify-center transition-colors" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-5 h-5">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ( $instagram_url ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" class="w-10 h-10 rounded-full bg-background/10 hover:bg-primary flex items-center justify-center transition-colors" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram w-5 h-5">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Links Menu -->
            <div>
                <h3 class="text-lg font-semibold mb-6 text-accent">Quick Links</h3>
                <?php
                if ( has_nav_menu( 'footer-quick-links' ) ) :
                    add_filter( 'nav_menu_link_attributes', function( $atts ) {
                        $atts['class'] = 'text-background/70 hover:text-primary transition-colors';
                        return $atts;
                    }, 10, 1 );
                    wp_nav_menu( array(
                        'theme_location' => 'footer-quick-links',
                        'menu_class'     => 'space-y-3',
                        'container'      => 'nav',
                        'container_class' => '',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'link_before'    => '',
                        'link_after'     => '',
                        'fallback_cb'    => false,
                    ) );
                    remove_all_filters( 'nav_menu_link_attributes' );
                else :
                ?>
                    <ul class="space-y-3">
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/about' ) ); ?>">About Us</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Our Services Menu -->
            <div>
                <h3 class="text-lg font-semibold mb-6 text-accent">Our Services</h3>
                <?php
                if ( has_nav_menu( 'footer-services' ) ) :
                    add_filter( 'nav_menu_link_attributes', function( $atts ) {
                        $atts['class'] = 'text-background/70 hover:text-primary transition-colors';
                        return $atts;
                    }, 10, 1 );
                    wp_nav_menu( array(
                        'theme_location' => 'footer-services',
                        'menu_class'     => 'space-y-3',
                        'container'      => 'nav',
                        'container_class' => '',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'link_before'    => '',
                        'link_after'     => '',
                        'fallback_cb'    => false,
                    ) );
                    remove_all_filters( 'nav_menu_link_attributes' );
                else :
                ?>
                    <ul class="space-y-3">
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services/body-massage' ) ); ?>">Body Massage</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services/foot-massage' ) ); ?>">Foot Massage</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services/shampoo' ) ); ?>">Herbal Shampoo</a></li>
                        <li><a class="text-background/70 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/services/ear-cleaning' ) ); ?>">Ear Cleaning</a></li>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-6 text-accent">Contact Us</h3>
                <ul class="space-y-4">
                    <?php 
                    $address = get_theme_mod( 'julius_address', 'Phan Boi Street, Da Nang, Vietnam' );
                    $phone = get_theme_mod( 'julius_phone_number', '+84 123 456 789' );
                    $email = get_theme_mod( 'julius_email', 'info@juliusspa.com' );
                    $hours = get_theme_mod( 'julius_opening_hours', '9:00 AM - 10:00 PM' );
                    ?>
                    
                    <?php if ( $address ) : ?>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-5 h-5 text-primary mt-0.5 shrink-0">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span class="text-background/70"><?php echo esc_html( $address ); ?></span>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ( $phone ) : ?>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-5 h-5 text-primary shrink-0">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>" class="text-background/70 hover:text-primary transition-colors"><?php echo esc_html( $phone ); ?></a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ( $email ) : ?>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-5 h-5 text-primary shrink-0">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-background/70 hover:text-primary transition-colors"><?php echo esc_html( $email ); ?></a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ( $hours ) : ?>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-primary shrink-0">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span class="text-background/70"><?php echo esc_html( $hours ); ?></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="border-t border-background/10">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-background/50 text-sm">
                    &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
                </p>
                <div class="flex gap-6 text-sm">
                    <a class="text-background/50 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
                    <a class="text-background/50 hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
// Display Floating Social Icons
if ( get_theme_mod( 'julius_float_icons_enable', true ) ) :
    $messenger_icon_id = get_theme_mod( 'julius_float_messenger_icon', 60 );
    $phone_icon_id = get_theme_mod( 'julius_float_phone_icon', 61 );
    $zalo_icon_id = get_theme_mod( 'julius_float_zalo_icon', 62 );
    
    $messenger_icon_url = wp_get_attachment_image_url( $messenger_icon_id, 'thumbnail' );
    $phone_icon_url = wp_get_attachment_image_url( $phone_icon_id, 'thumbnail' );
    $zalo_icon_url = wp_get_attachment_image_url( $zalo_icon_id, 'thumbnail' );
    
    $messenger_link = get_theme_mod( 'julius_float_messenger_link', 'https://m.me/yourusername' );
    $phone_number = get_theme_mod( 'julius_float_phone_number', '+84123456789' );
    $zalo_phone = get_theme_mod( 'julius_float_zalo_phone', '84123456789' );
    $position = get_theme_mod( 'julius_float_icons_position', 'right' );
    
    $position_class = $position === 'left' ? 'left-6' : 'right-6';
?>
<div class="julius-float-icons fixed bottom-6 <?php echo esc_attr( $position_class ); ?> z-50 flex flex-col gap-4">
    <?php if ( $messenger_icon_url ) : ?>
    <a href="<?php echo esc_url( $messenger_link ); ?>" target="_blank" rel="noopener noreferrer" class="julius-float-icon group relative" aria-label="Contact via Messenger">
        <div class="julius-ripple"></div>
        <img src="<?php echo esc_url( $messenger_icon_url ); ?>" alt="Messenger" class="w-14 h-14 rounded-full object-cover shadow-lg transition-transform duration-300 group-hover:scale-110">
    </a>
    <?php endif; ?>
    
    <?php if ( $phone_icon_url ) : ?>
    <a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="julius-float-icon group relative" aria-label="Call us">
        <div class="julius-ripple"></div>
        <img src="<?php echo esc_url( $phone_icon_url ); ?>" alt="Phone" class="w-14 h-14 rounded-full object-cover shadow-lg transition-transform duration-300 group-hover:scale-110">
    </a>
    <?php endif; ?>
    
    <?php if ( $zalo_icon_url ) : ?>
    <a href="https://zalo.me/<?php echo esc_attr( $zalo_phone ); ?>" target="_blank" rel="noopener noreferrer" class="julius-float-icon group relative" aria-label="Contact via Zalo">
        <div class="julius-ripple"></div>
        <img src="<?php echo esc_url( $zalo_icon_url ); ?>" alt="Zalo" class="w-14 h-14 rounded-full object-cover shadow-lg transition-transform duration-300 group-hover:scale-110">
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- Gallery Lightbox Modal -->
<div id="julius-gallery-lightbox" class="fixed inset-0 z-[99999] hidden items-center justify-center bg-black" style="display: none;">
    <!-- Dark overlay for zoom state -->
    <div id="julius-lightbox-dark-overlay" class="absolute inset-0 bg-black/50 transition-opacity duration-300 opacity-0"></div>
    
    <!-- Top Toolbar -->
    <div class="absolute top-0 left-0 right-0 z-30 flex items-center justify-between px-6 py-4 bg-gradient-to-b from-black/80 to-transparent">
        <!-- Counter - Left -->
        <div class="text-white text-base font-medium">
            <span id="julius-lightbox-current">1</span> / <span id="julius-lightbox-total">1</span>
        </div>
        
        <!-- Toolbar Icons - Right -->
        <div class="flex items-center gap-2">
            <button id="julius-lightbox-zoom-out" class="p-2 hover:bg-white/10 rounded-lg transition-colors" aria-label="Zoom out" title="Zoom out">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    <line x1="8" x2="14" y1="11" y2="11"></line>
                </svg>
            </button>
            
            <button id="julius-lightbox-zoom-in" class="p-2 hover:bg-white/10 rounded-lg transition-colors" aria-label="Zoom in" title="Zoom in">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    <line x1="11" x2="11" y1="8" y2="14"></line>
                    <line x1="8" x2="14" y1="11" y2="11"></line>
                </svg>
            </button>
            
            <button id="julius-lightbox-fullscreen" class="p-2 hover:bg-white/10 rounded-lg transition-colors" aria-label="Fullscreen" title="Fullscreen">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <path d="M8 3H5a2 2 0 0 0-2 2v3"></path>
                    <path d="M21 8V5a2 2 0 0 0-2-2h-3"></path>
                    <path d="M3 16v3a2 2 0 0 0 2 2h3"></path>
                    <path d="M16 21h3a2 2 0 0 0 2-2v-3"></path>
                </svg>
            </button>
            
            <button id="julius-lightbox-download" class="p-2 hover:bg-white/10 rounded-lg transition-colors" aria-label="Download" title="Download image">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
            </button>
            
            <div class="w-px h-6 bg-white/20 mx-1"></div>
            
            <button id="julius-lightbox-close" class="p-2 hover:bg-white/10 rounded-lg transition-colors" aria-label="Close" title="Close (Esc)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Navigation Arrows -->
    <button id="julius-lightbox-prev" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 hover:bg-white/10 rounded-full transition-colors" aria-label="Previous image" title="Previous (←)">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
            <path d="m15 18-6-6 6-6"></path>
        </svg>
    </button>
    
    <button id="julius-lightbox-next" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 hover:bg-white/10 rounded-full transition-colors" aria-label="Next image" title="Next (→)">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
            <path d="m9 18 6-6-6-6"></path>
        </svg>
    </button>
    
    <!-- Image Container -->
    <div id="julius-lightbox-container" class="relative w-full h-full flex items-center justify-center overflow-hidden cursor-move">
        <img id="julius-lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain transition-transform duration-200" style="transform: scale(1) translate(0, 0);">
    </div>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
