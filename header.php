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
                    <?php
                    $loc1_name    = get_theme_mod( 'julius_loc1_name', 'Julius 1' );
                    $loc1_phone   = get_theme_mod( 'julius_loc1_phone', '0775509057' );
                    $loc1_display = get_theme_mod( 'julius_loc1_phone_display', '0775 509 057' );
                    $loc1_address = get_theme_mod( 'julius_loc1_address', '05 An Thuong 38, Da Nang' );
                    $loc2_name    = get_theme_mod( 'julius_loc2_name', 'Julius 2' );
                    $loc2_phone   = get_theme_mod( 'julius_loc2_phone', '0787509157' );
                    $loc2_display = get_theme_mod( 'julius_loc2_phone_display', '0787 509 157' );
                    $loc2_address = get_theme_mod( 'julius_loc2_address', '61 Ta My Duat, Da Nang' );
                    ?>
                    <!-- Location 1 -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="font-semibold"><?php echo esc_html( $loc1_name ); ?>:</span>
                        <span><?php echo esc_html( $loc1_address ); ?></span>
                        <span class="mx-1">·</span>
                        <a href="tel:<?php echo esc_attr( $loc1_phone ); ?>" class="hover:underline"><?php echo esc_html( $loc1_display ); ?></a>
                    </div>
                    <span class="text-primary-foreground/50">|</span>
                    <!-- Location 2 -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="font-semibold"><?php echo esc_html( $loc2_name ); ?>:</span>
                        <span><?php echo esc_html( $loc2_address ); ?></span>
                        <span class="mx-1">·</span>
                        <a href="tel:<?php echo esc_attr( $loc2_phone ); ?>" class="hover:underline"><?php echo esc_html( $loc2_display ); ?></a>
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
                    add_filter( 'nav_menu_link_attributes', function( $atts ) {
                        $atts['class'] = 'text-foreground hover:text-primary transition-colors text-lg font-medium';
                        return $atts;
                    }, 10, 1 );
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-8',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb'    => '__return_false',
                    ) );
                    remove_all_filters( 'nav_menu_link_attributes' );
                    ?>
                </div>

                <!-- Book Now Button (Desktop) -->
                <div class="hidden md:block">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-2 text-lg">
                        Book Now
                    </a>
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
                add_filter( 'nav_menu_link_attributes', function( $atts ) {
                    $atts['class'] = 'text-foreground hover:text-primary transition-colors text-lg font-medium block py-2';
                    return $atts;
                }, 10, 1 );
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-4',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'fallback_cb'    => '__return_false',
                ) );
                remove_all_filters( 'nav_menu_link_attributes' );
                ?>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md font-medium transition-all disabled:pointer-events-none disabled:opacity-50 h-9 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-2 text-lg w-full mt-4">
                    Book Now
                </a>
            </div>
        </div>
    </header>
