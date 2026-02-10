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

</div><!-- #page -->

<?php 
// Float Social Icons
if ( get_theme_mod( 'julius_float_icons_enable', true ) ) :
    $messenger_link = get_theme_mod( 'julius_float_messenger_link', '' );
    $phone_number = get_theme_mod( 'julius_float_phone_number', '' );
    $zalo_link = get_theme_mod( 'julius_float_zalo_link', '' );
    $position = get_theme_mod( 'julius_float_icons_position', 'right' );
    
    $has_icons = $messenger_link || $phone_number || $zalo_link;
    
    if ( $has_icons ) :
?>
<div class="floating-icons floating-icons-<?php echo esc_attr( $position ); ?>">
    <?php if ( $messenger_link ) : ?>
    <a href="<?php echo esc_url( $messenger_link ); ?>" target="_blank" rel="noopener noreferrer" class="floating-icon floating-icon-messenger" aria-label="Chat on Messenger">
        <div class="ripple"></div>
        <div class="ripple"></div>
        <div class="ripple"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.15 2 11.33c0 2.92 1.46 5.52 3.75 7.23V22l3.26-1.79c.87.24 1.79.37 2.74.37 5.52 0 10-4.15 10-9.25C22 6.15 17.52 2 12 2zm1.03 12.41l-2.58-2.75-5.03 2.75 5.53-5.87 2.64 2.75 4.97-2.75-5.53 5.87z"/>
        </svg>
    </a>
    <?php endif; ?>
    
    <?php if ( $phone_number ) : ?>
    <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone_number ) ); ?>" class="floating-icon floating-icon-phone" aria-label="Call Us">
        <div class="ripple"></div>
        <div class="ripple"></div>
        <div class="ripple"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
    </a>
    <?php endif; ?>
    
    <?php if ( $zalo_link ) : ?>
    <a href="<?php echo esc_url( $zalo_link ); ?>" target="_blank" rel="noopener noreferrer" class="floating-icon floating-icon-zalo" aria-label="Chat on Zalo">
        <div class="ripple"></div>
        <div class="ripple"></div>
        <div class="ripple"></div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.477 2 2 6.145 2 11.243c0 2.855 1.506 5.416 3.856 7.138v3.619l3.39-1.86c.858.192 1.762.303 2.754.303 5.523 0 10-4.145 10-9.243S17.523 2 12 2zm5.598 7.686c.193.205.193.525 0 .73l-3.383 3.538a.494.494 0 0 1-.717 0l-1.803-1.886-3.383 3.538c-.193.205-.524.205-.717 0a.544.544 0 0 1 0-.73l3.383-3.538a.494.494 0 0 1 .717 0l1.803 1.886 3.383-3.538c.193-.205.524-.205.717 0z"/>
        </svg>
    </a>
    <?php endif; ?>
</div>

<style>
.floating-icons {
    position: fixed;
    bottom: 30px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.floating-icons-left {
    left: 20px;
}

.floating-icons-right {
    right: 20px;
}

.floating-icon {
    position: relative;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    overflow: hidden;
    cursor: pointer;
}

.floating-icon svg {
    position: relative;
    z-index: 2;
    width: 28px;
    height: 28px;
}

.floating-icon:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.floating-icon:active {
    transform: scale(1.05);
}

/* Messenger Icon */
.floating-icon-messenger {
    background: linear-gradient(135deg, #00B2FF 0%, #006AFF 100%);
}

/* Phone Icon */
.floating-icon-phone {
    background: linear-gradient(135deg, #34D399 0%, #10B981 100%);
}

/* Zalo Icon */
.floating-icon-zalo {
    background: linear-gradient(135deg, #0068FF 0%, #0052CC 100%);
}

/* Ripple Animation */
.floating-icon .ripple {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px solid currentColor;
    opacity: 0;
    animation: ripple 3s infinite;
}

.floating-icon .ripple:nth-child(2) {
    animation-delay: 1s;
}

.floating-icon .ripple:nth-child(3) {
    animation-delay: 2s;
}

@keyframes ripple {
    0% {
        transform: scale(1);
        opacity: 0.6;
    }
    50% {
        opacity: 0.3;
    }
    100% {
        transform: scale(1.8);
        opacity: 0;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .floating-icons {
        bottom: 20px;
    }
    
    .floating-icons-left {
        left: 15px;
    }
    
    .floating-icons-right {
        right: 15px;
    }
    
    .floating-icon {
        width: 50px;
        height: 50px;
    }
    
    .floating-icon svg {
        width: 24px;
        height: 24px;
    }
}

/* Smooth entrance animation */
@keyframes float-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.floating-icon {
    animation: float-in 0.6s ease-out backwards;
}

.floating-icon:nth-child(1) {
    animation-delay: 0.1s;
}

.floating-icon:nth-child(2) {
    animation-delay: 0.2s;
}

.floating-icon:nth-child(3) {
    animation-delay: 0.3s;
}
</style>
<?php 
    endif;
endif;
?>

<?php wp_footer(); ?>

</body>
</html>
