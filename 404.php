<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Julius_Theme
 */

get_header();
?>

<main class="min-h-[80vh] flex items-center justify-center bg-background">
    <div class="container mx-auto px-4 py-24 text-center">

        <!-- 404 Number -->
        <h1 class="text-[8rem] md:text-[12rem] font-bold leading-none text-primary/20 select-none">
            404
        </h1>

        <!-- Heading -->
        <h2 class="text-3xl md:text-4xl font-bold text-foreground -mt-6 mb-4">
            <?php esc_html_e( 'Page Not Found', 'julius-theme' ); ?>
        </h2>

        <!-- Description -->
        <p class="text-muted-foreground text-lg max-w-md mx-auto mb-10 leading-relaxed">
            <?php esc_html_e( 'Sorry, the page you are looking for doesn\'t exist or has been moved. Let us help you find your way back.', 'julius-theme' ); ?>
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                    <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                </svg>
                <?php esc_html_e( 'Back to Home', 'julius-theme' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="inline-flex items-center gap-2 border border-border text-foreground px-8 py-3 rounded-lg font-semibold hover:bg-muted transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                    <path d="M20 3v4"></path>
                    <path d="M22 5h-4"></path>
                    <path d="M4 17v2"></path>
                    <path d="M5 18H3"></path>
                </svg>
                <?php esc_html_e( 'View Our Services', 'julius-theme' ); ?>
            </a>
        </div>

        <!-- Contact Nudge -->
        <p class="text-muted-foreground text-sm mt-12">
            <?php
            printf(
                /* translators: %s: contact page link */
                esc_html__( 'Need help? %s and we\'ll be happy to assist.', 'julius-theme' ),
                '<a href="' . esc_url( home_url( '/contact' ) ) . '" class="text-primary hover:underline font-medium">' . esc_html__( 'Contact us', 'julius-theme' ) . '</a>'
            );
            ?>
        </p>

    </div>
</main>

<?php
get_footer();
