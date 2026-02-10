<?php
/**
 * Single Blog Post Template
 *
 * @package Julius_Theme
 */

get_header();

// Set up post data
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

// Get current post data
$post_id = get_the_ID();
$post_title = get_the_title();
$post_excerpt = get_the_excerpt();
$post_date = get_the_date( 'F j, Y' );

// Calculate word count from content for reading time
$post_content_for_count = get_the_content();
$word_count = str_word_count( strip_tags( $post_content_for_count ) );
$reading_time = ceil( $word_count / 200 );

// Get featured image or Picsum fallback
$featured_image = '';
if ( has_post_thumbnail() ) {
    $featured_image = get_the_post_thumbnail_url( $post_id, 'full' );
} else {
    $featured_image = 'https://picsum.photos/seed/blog-' . $post_id . '/1920/1080';
}

// Get blog categories
$categories = get_the_terms( $post_id, 'blog_category' );
$primary_category = $categories && ! is_wp_error( $categories ) ? $categories[0] : null;

// Get blog author
$authors = get_the_terms( $post_id, 'blog_author' );
$author = $authors && ! is_wp_error( $authors ) ? $authors[0] : null;

// Get tags
$tags = get_the_terms( $post_id, 'blog_tag' );

// Get related posts (same category, excluding current post)
$related_args = array(
    'post_type'      => 'blog_post',
    'posts_per_page' => 2,
    'post__not_in'   => array( $post_id ),
    'orderby'        => 'rand',
);

if ( $primary_category ) {
    $related_args['tax_query'] = array(
        array(
            'taxonomy' => 'blog_category',
            'field'    => 'term_id',
            'terms'    => $primary_category->term_id,
        ),
    );
}

$related_posts = new WP_Query( $related_args );

// Get more articles for bottom section
$more_articles = new WP_Query( array(
    'post_type'      => 'blog_post',
    'posts_per_page' => 3,
    'post__not_in'   => array( $post_id ),
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

// Get all categories for sidebar
$all_categories = get_terms( array(
    'taxonomy'   => 'blog_category',
    'hide_empty' => true,
) );

// Get current URL for sharing
$current_url = get_permalink();
$share_title = urlencode( $post_title );
?>

<!-- Hero Section -->
<section class="relative h-[60vh] md:h-[70vh] min-h-[500px] flex items-center justify-center overflow-hidden pt-32">
    <img 
        alt="<?php echo esc_attr( $post_title ); ?>" 
        decoding="async" 
        class="object-cover" 
        src="<?php echo esc_url( $featured_image ); ?>" 
        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex items-center justify-center gap-2 text-sm mb-6">
            <a class="text-white/70 hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-4 h-4 text-white/50 rotate-180">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
            <a class="text-white/70 hover:text-white transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>">Blog</a>
            <?php if ( $primary_category ) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-4 h-4 text-white/50 rotate-180">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                <span class="text-primary"><?php echo esc_html( $primary_category->name ); ?></span>
            <?php endif; ?>
        </nav>

        <!-- Category Badge -->
        <?php if ( $primary_category ) : ?>
            <span class="inline-block bg-primary text-primary-foreground px-4 py-1 rounded-full text-sm font-medium mb-4">
                <?php echo esc_html( $primary_category->name ); ?>
            </span>
        <?php endif; ?>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-balance leading-tight">
            <?php echo esc_html( $post_title ); ?>
        </h1>

        <!-- Meta Information -->
        <div class="flex flex-wrap items-center justify-center gap-4 text-white/80 text-sm">
            <?php if ( $author ) : ?>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span><?php echo esc_html( $author->name ); ?></span>
                </div>
            <?php endif; ?>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
                <span><?php echo esc_html( $post_date ); ?></span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span><?php echo esc_html( $reading_time ); ?> min read</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-12 md:py-16">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <article class="lg:col-span-2">
                <div class="prose prose-lg max-w-none prose-headings:text-foreground prose-headings:font-bold prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4 prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3 prose-p:text-muted-foreground prose-p:leading-relaxed prose-p:mb-4 prose-ul:text-muted-foreground prose-ul:my-4 prose-li:mb-2 prose-strong:text-foreground">
                    <?php the_content(); ?>
                </div>

                <!-- Tags Section -->
                <?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
                    <div class="mt-8 pt-8 border-t border-border">
                        <div class="flex flex-wrap items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-5 h-5 text-primary">
                                <path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path>
                                <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>
                            </svg>
                            <?php foreach ( $tags as $tag ) : 
                                $tag_url = add_query_arg( 'tag', $tag->slug, get_post_type_archive_link( 'blog_post' ) );
                            ?>
                                <a class="px-3 py-1 bg-secondary text-secondary-foreground rounded-full text-sm hover:bg-primary hover:text-primary-foreground transition-colors" href="<?php echo esc_url( $tag_url ); ?>">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Share Section -->
                <div class="mt-8 pt-8 border-t border-border">
                    <h3 class="text-lg font-semibold text-foreground mb-4">Share this article</h3>
                    <div class="flex items-center gap-3">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $current_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-5 h-5">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $current_url ); ?>&text=<?php echo esc_attr( $share_title ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter w-5 h-5">
                                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                            </svg>
                        </a>
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $current_url ); ?>&title=<?php echo esc_attr( $share_title ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-[#0A66C2] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin w-5 h-5">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        <!-- Copy Link -->
                        <button onclick="navigator.clipboard.writeText('<?php echo esc_js( $current_url ); ?>'); alert('Link copied to clipboard!');" class="w-10 h-10 rounded-full bg-muted text-muted-foreground flex items-center justify-center hover:bg-primary hover:text-primary-foreground transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link2 w-5 h-5">
                                <path d="M9 17H7A5 5 0 0 1 7 7h2"></path>
                                <path d="M15 7h2a5 5 0 1 1 0 10h-2"></path>
                                <line x1="8" x2="16" y1="12" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Author Bio -->
                <?php if ( $author ) : 
                    // Get author avatar from term meta
                    $avatar_id = get_term_meta( $author->term_id, 'author_avatar', true );
                    $avatar_url = '';
                    if ( $avatar_id ) {
                        $avatar_url = wp_get_attachment_image_url( $avatar_id, 'thumbnail' );
                    }
                    // Fallback to Picsum if no avatar
                    if ( ! $avatar_url ) {
                        $avatar_url = 'https://picsum.photos/seed/author-' . $author->term_id . '/200/200';
                    }
                ?>
                    <div class="mt-8 p-6 bg-secondary/30 rounded-2xl">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative w-20 h-20 rounded-full overflow-hidden flex-shrink-0">
                                <img 
                                    alt="<?php echo esc_attr( $author->name ); ?>" 
                                    loading="lazy" 
                                    decoding="async" 
                                    class="object-cover" 
                                    src="<?php echo esc_url( $avatar_url ); ?>" 
                                    style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                            </div>
                            <div>
                                <p class="text-sm text-primary font-medium mb-1">Written by</p>
                                <h3 class="text-xl font-bold text-foreground mb-2"><?php echo esc_html( $author->name ); ?></h3>
                                <p class="text-muted-foreground text-sm"><?php echo esc_html( $author->description ); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <!-- CTA Box -->
                    <div class="bg-primary/10 border border-primary/20 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-foreground mb-3">Ready to Relax?</h3>
                        <p class="text-muted-foreground text-sm mb-4">Experience the treatments mentioned in this article at Julius Spa.</p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 px-4 py-2 w-full bg-primary hover:bg-primary/90 text-primary-foreground">
                            Book Now
                        </a>
                    </div>

                    <!-- Related Articles -->
                    <?php if ( $related_posts->have_posts() ) : ?>
                        <div class="bg-card border border-border rounded-2xl p-6">
                            <h3 class="text-lg font-bold text-foreground mb-4">Related Articles</h3>
                            <div class="space-y-4">
                                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); 
                                    $related_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : 'https://picsum.photos/seed/blog-' . get_the_ID() . '/400/300';
                                ?>
                                    <a class="flex gap-3 group" href="<?php the_permalink(); ?>">
                                        <div class="relative w-20 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                            <img 
                                                alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                                loading="lazy" 
                                                decoding="async" 
                                                class="object-cover group-hover:scale-105 transition-transform duration-300" 
                                                src="<?php echo esc_url( $related_image ); ?>" 
                                                style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-foreground line-clamp-2 group-hover:text-primary transition-colors">
                                                <?php the_title(); ?>
                                            </h4>
                                            <p class="text-xs text-muted-foreground mt-1"><?php echo get_the_date( 'F j, Y' ); ?></p>
                                        </div>
                                    </a>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Categories -->
                    <?php if ( $all_categories && ! is_wp_error( $all_categories ) ) : ?>
                        <div class="bg-card border border-border rounded-2xl p-6">
                            <h3 class="text-lg font-bold text-foreground mb-4">Categories</h3>
                            <div class="space-y-2">
                                <?php foreach ( $all_categories as $cat ) : 
                                    $cat_url = add_query_arg( 'category', $cat->slug, get_post_type_archive_link( 'blog_post' ) );
                                ?>
                                    <a class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-secondary transition-colors group" href="<?php echo esc_url( $cat_url ); ?>">
                                        <span class="text-muted-foreground group-hover:text-foreground transition-colors">
                                            <?php echo esc_html( $cat->name ); ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-4 h-4 text-muted-foreground rotate-180">
                                            <path d="m15 18-6-6 6-6"></path>
                                        </svg>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- More Articles Section -->
<?php if ( $more_articles->have_posts() ) : ?>
    <section class="py-12 md:py-16 bg-secondary/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-foreground">More Articles You Might Like</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <?php while ( $more_articles->have_posts() ) : $more_articles->the_post(); 
                    $article_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : 'https://picsum.photos/seed/blog-' . get_the_ID() . '/800/600';
                    $article_categories = get_the_terms( get_the_ID(), 'blog_category' );
                    $article_category = $article_categories && ! is_wp_error( $article_categories ) ? $article_categories[0] : null;
                ?>
                    <a class="group bg-card border border-border rounded-2xl overflow-hidden hover:shadow-lg transition-shadow" href="<?php the_permalink(); ?>">
                        <div class="relative h-48 overflow-hidden">
                            <img 
                                alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                loading="lazy" 
                                decoding="async" 
                                class="object-cover group-hover:scale-105 transition-transform duration-500" 
                                src="<?php echo esc_url( $article_image ); ?>" 
                                style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                            <?php if ( $article_category ) : ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-primary text-primary-foreground px-3 py-1 rounded-full text-xs font-medium">
                                        <?php echo esc_html( $article_category->name ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-foreground group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                <?php the_title(); ?>
                            </h3>
                            <p class="text-sm text-muted-foreground"><?php echo get_the_date( 'F j, Y' ); ?></p>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="text-center mt-8">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border shadow-xs h-9 px-4 py-2 border-primary text-primary hover:bg-primary hover:text-primary-foreground bg-transparent">
                    View All Articles
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 md:py-24 relative overflow-hidden">
    <img 
        alt="Julius Spa" 
        loading="lazy" 
        decoding="async" 
        class="object-cover" 
        src="<?php echo esc_url( get_template_directory_uri() . '/images/julius-street-view.jpg' ); ?>" 
        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative z-10 container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Ready to Experience <span class="text-primary">True Relaxation?</span>
        </h2>
        <p class="text-white/80 max-w-2xl mx-auto mb-8">
            Book your appointment today and let our expert therapists help you achieve the wellness benefits you deserve.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-10 rounded-md px-6 bg-primary hover:bg-primary/90 text-primary-foreground">
                Book Your Session
            </a>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border shadow-xs h-10 rounded-md px-6 border-white text-white hover:bg-white hover:text-foreground bg-transparent">
                View Services
            </a>
        </div>
    </div>
</section>

<?php 
    endwhile;
endif;
get_footer(); 
?>
