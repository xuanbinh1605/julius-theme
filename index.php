<?php
/**
 * The main template file
 *
 * @package Julius_Theme
 */

get_header(); ?>

<main id="main-content" class="site-main main-content">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile;
        
        the_posts_navigation();
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
</main>

<?php
get_sidebar();
get_footer();
