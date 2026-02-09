<?php
/**
 * The header template
 *
 * @package Julius_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="fixed top-0 left-0 right-0 z-50 bg-background/95 backdrop-blur-sm border-b border-border">
        <!-- Top Bar -->
        <div class="hidden md:block bg-primary text-primary-foreground py-2">
            <div class="container mx-auto px-4 flex justify-between items-center text-sm">
                <div class="flex items-center gap-6">
                    <!-- Phone -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span><?php echo esc_html( get_theme_mod( 'julius_phone_number', '+84 123 456 789' ) ); ?></span>
                    </div>
                    <!-- Address -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span><?php echo esc_html( get_theme_mod( 'julius_address', 'Phan Boi Street, Da Nang, Vietnam' ) ); ?></span>
                    </div>
                </div>
                <!-- Opening Hours -->
                <div class="flex items-center gap-4">
                    <span><?php echo esc_html( get_theme_mod( 'julius_opening_hours', 'Open: 9:00 AM - 10:00 PM' ) ); ?></span>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a class="flex items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                    $logo_id = get_theme_mod( 'julius_logo_image', 6 );
                    $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
                    
                    if ( $logo_url ) {
                        $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
                        if ( empty( $logo_alt ) ) {
                            $logo_alt = get_bloginfo( 'name' );
                        }
                        ?>
                        <img alt="<?php echo esc_attr( $logo_alt ); ?>" loading="lazy" width="120" height="80" decoding="async" class="h-16 w-auto" src="<?php echo esc_url( $logo_url ); ?>" style="color: transparent;">
                        <?php
                    } else {
                        // Fallback to site name
                        ?>
                        <span class="text-xl font-bold"><?php bloginfo( 'name' ); ?></span>
                        <?php
                    }
                    ?>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-8',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb'    => '__return_false',
                        'link_before'    => '<span class="text-foreground hover:text-primary transition-colors text-lg font-medium">',
                        'link_after'     => '</span>',
                    ) );
                    ?>
                </div>

                <!-- Book Now Button (Desktop) -->
                <div class="hidden md:block">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-2 text-lg">
                        Book Now
                    </button>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden p-2 mobile-menu-toggle" aria-label="Toggle menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu w-6 h-6 text-foreground">
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden bg-background border-t border-border">
            <div class="container mx-auto px-4 py-4">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-4',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'fallback_cb'    => '__return_false',
                    'link_before'    => '<span class="text-foreground hover:text-primary transition-colors text-lg font-medium block py-2">',
                    'link_after'     => '</span>',
                ) );
                ?>
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all disabled:pointer-events-none disabled:opacity-50 h-9 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-2 text-lg w-full mt-4">
                    Book Now
                </button>
            </div>
        </div>
    </header>
