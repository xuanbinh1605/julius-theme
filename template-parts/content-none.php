<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package Julius_Theme
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'julius-theme' ); ?></h1>
    </header>

    <div class="page-content">
        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'julius-theme' ); ?></p>
    </div>
</section>
