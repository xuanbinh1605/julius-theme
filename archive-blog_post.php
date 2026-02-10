<?php
/**
 * Blog Archive Template
 *
 * @package Julius_Theme
 */

get_header();

// Pagination
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// Get featured post (only on page 1)
$featured_post = null;
if ( $paged === 1 ) {
    $featured_args = array(
        'post_type'      => 'blog_post',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_julius_featured_article',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    );
    $featured_query = new WP_Query( $featured_args );
    if ( $featured_query->have_posts() ) {
        while ( $featured_query->have_posts() ) {
            $featured_query->the_post();
            $featured_post = get_post();
        }
        wp_reset_postdata();
    }
}

// Calculate offset for regular posts
// Page 1: Show 5 regular posts (0 offset)
// Page 2: Show 6 regular posts (5 offset)
// Page 3: Show 6 regular posts (11 offset)
// Formula: offset = ($paged - 1) * 6 - ($paged > 1 && $featured_post ? 1 : 0)
$posts_per_page = 6;
$offset = 0;
if ( $paged === 1 ) {
    $offset = 0;
    $posts_to_show = $featured_post ? 5 : 6;
} else {
    $offset = $featured_post ? (($paged - 1) * 6 - 1) : (($paged - 1) * 6);
    $posts_to_show = 6;
}

// Get regular posts (excluding featured post)
$regular_args = array(
    'post_type'      => 'blog_post',
    'posts_per_page' => $posts_to_show,
    'offset'         => $offset,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => '_julius_featured_article',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key'     => '_julius_featured_article',
            'value'   => '1',
            'compare' => '!=',
        ),
    ),
);

$blog_query = new WP_Query( $regular_args );
$regular_posts = array();

if ( $blog_query->have_posts() ) {
    while ( $blog_query->have_posts() ) {
        $blog_query->the_post();
        $regular_posts[] = get_post();
    }
    wp_reset_postdata();
}

// Calculate total pages manually for pagination
// Get count of non-featured posts
$count_args = array(
    'post_type'      => 'blog_post',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => '_julius_featured_article',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key'     => '_julius_featured_article',
            'value'   => '1',
            'compare' => '!=',
        ),
    ),
);
$count_query = new WP_Query( $count_args );
$total_regular_posts = $count_query->found_posts;
wp_reset_postdata();

// Calculate max pages: first page shows 5 (if featured exists), rest show 6
if ( $featured_post ) {
    $max_num_pages = $total_regular_posts <= 5 ? 1 : 1 + ceil( ( $total_regular_posts - 5 ) / 6 );
} else {
    $max_num_pages = ceil( $total_regular_posts / 6 );
}

// Get categories with post count
$categories = get_terms( array(
    'taxonomy'   => 'blog_category',
    'hide_empty' => true,
) );

// Get total posts count
$total_posts = wp_count_posts( 'blog_post' )->publish;

// Get recent posts for sidebar
$recent_posts = new WP_Query( array(
    'post_type'      => 'blog_post',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

// Calculate reading time helper
function julius_calculate_reading_time( $content ) {
    $word_count = str_word_count( strip_tags( $content ) );
    return ceil( $word_count / 200 );
}
?>

<!-- Hero Section -->
<section class="relative h-[50vh] min-h-[400px] flex items-center justify-center pt-32">
    <img 
        alt="Julius Spa Blog" 
        decoding="async" 
        class="object-cover" 
        src="<?php echo esc_url( get_template_directory_uri() . '/images/julius-exterior-night.jpg' ); ?>" 
        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 text-center text-white px-4">
        <p class="text-primary text-sm tracking-[0.2em] uppercase mb-3 font-medium">Our Blog</p>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Wellness Insights</h1>
        <p class="text-white/80 text-lg max-w-2xl mx-auto">Tips, guides, and inspiration for your wellness journey</p>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Main Content -->
            <div class="flex-1">
                <?php if ( $featured_post && $paged === 1 ) : 
                    $featured_id = $featured_post->ID;
                    $featured_image = has_post_thumbnail( $featured_id ) ? get_the_post_thumbnail_url( $featured_id, 'large' ) : 'https://picsum.photos/seed/blog-' . $featured_id . '/1200/800';
                    $featured_categories = get_the_terms( $featured_id, 'blog_category' );
                    $featured_category = $featured_categories && ! is_wp_error( $featured_categories ) ? $featured_categories[0] : null;
                    $featured_content = get_post_field( 'post_content', $featured_id );
                    $featured_reading_time = julius_calculate_reading_time( $featured_content );
                    $featured_excerpt = get_the_excerpt( $featured_id );
                ?>
                    <!-- Featured Article -->
                    <div class="mb-12">
                        <p class="text-primary text-sm tracking-[0.2em] uppercase mb-4 font-medium">Featured Article</p>
                        <a class="group block" href="<?php echo esc_url( get_permalink( $featured_id ) ); ?>">
                            <div class="relative h-[400px] rounded-2xl overflow-hidden mb-6">
                                <img 
                                    alt="<?php echo esc_attr( $featured_post->post_title ); ?>" 
                                    loading="lazy" 
                                    decoding="async" 
                                    class="object-cover transition-transform duration-500 group-hover:scale-105" 
                                    src="<?php echo esc_url( $featured_image ); ?>" 
                                    style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                                    <?php if ( $featured_category ) : ?>
                                        <span class="inline-block bg-primary text-primary-foreground text-xs font-medium px-3 py-1 rounded-full mb-3">
                                            <?php echo esc_html( $featured_category->name ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 group-hover:text-primary transition-colors">
                                        <?php echo esc_html( $featured_post->post_title ); ?>
                                    </h2>
                                    <p class="text-white/80 mb-4 line-clamp-2">
                                        <?php echo esc_html( $featured_excerpt ); ?>
                                    </p>
                                    <div class="flex items-center gap-4 text-white/70 text-sm">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                                <path d="M8 2v4"></path>
                                                <path d="M16 2v4"></path>
                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                <path d="M3 10h18"></path>
                                            </svg>
                                            <?php echo get_the_date( 'F j, Y', $featured_id ); ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <?php echo esc_html( $featured_reading_time ); ?> min read
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Blog Posts Grid -->
                <?php if ( ! empty( $regular_posts ) ) : ?>
                    <div class="grid md:grid-cols-2 gap-8">
                        <?php foreach ( $regular_posts as $post ) : 
                            setup_postdata( $post );
                            $post_id = $post->ID;
                            $post_image = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : 'https://picsum.photos/seed/blog-' . $post_id . '/800/600';
                            $post_categories = get_the_terms( $post_id, 'blog_category' );
                            $post_category = $post_categories && ! is_wp_error( $post_categories ) ? $post_categories[0] : null;
                            $post_content = get_post_field( 'post_content', $post_id );
                            $reading_time = julius_calculate_reading_time( $post_content );
                            $post_excerpt = get_the_excerpt( $post_id );
                        ?>
                            <a class="group" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
                                <article class="bg-card border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                    <div class="relative h-48 overflow-hidden">
                                        <img 
                                            alt="<?php echo esc_attr( $post->post_title ); ?>" 
                                            loading="lazy" 
                                            decoding="async" 
                                            class="object-cover transition-transform duration-500 group-hover:scale-105" 
                                            src="<?php echo esc_url( $post_image ); ?>" 
                                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                        <?php if ( $post_category ) : ?>
                                            <span class="absolute top-4 left-4 bg-primary text-primary-foreground text-xs font-medium px-3 py-1 rounded-full">
                                                <?php echo esc_html( $post_category->name ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-foreground mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                            <?php echo esc_html( $post->post_title ); ?>
                                        </h3>
                                        <p class="text-muted-foreground text-sm mb-4 line-clamp-2">
                                            <?php echo esc_html( $post_excerpt ); ?>
                                        </p>
                                        <div class="flex items-center justify-between text-sm text-muted-foreground">
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                                    <path d="M8 2v4"></path>
                                                    <path d="M16 2v4"></path>
                                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                    <path d="M3 10h18"></path>
                                                </svg>
                                                <?php echo get_the_date( 'F j, Y', $post_id ); ?>
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <?php echo esc_html( $reading_time ); ?> min read
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            </a>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ( $max_num_pages > 1 ) : ?>
                        <div class="flex items-center justify-center gap-2 mt-12">
                            <?php
                            $prev_link = get_previous_posts_page_link();
                            $next_link = get_next_posts_page_link( $max_num_pages );
                            ?>
                            
                            <!-- Previous Button -->
                            <?php if ( $paged > 1 ) : ?>
                                <a href="<?php echo esc_url( $prev_link ); ?>" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground h-8 rounded-md gap-1.5 px-3">
                                    Previous
                                </a>
                            <?php else : ?>
                                <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none border bg-background shadow-xs h-8 rounded-md gap-1.5 px-3 opacity-50 cursor-not-allowed" disabled>
                                    Previous
                                </button>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <?php for ( $i = 1; $i <= $max_num_pages; $i++ ) : ?>
                                <?php if ( $i == $paged ) : ?>
                                    <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all h-8 rounded-md gap-1.5 px-3 bg-primary text-primary-foreground">
                                        <?php echo $i; ?>
                                    </button>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( get_pagenum_link( $i ) ); ?>" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground h-8 rounded-md gap-1.5 px-3">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <?php if ( $paged < $max_num_pages ) : ?>
                                <a href="<?php echo esc_url( $next_link ); ?>" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground h-8 rounded-md gap-1.5 px-3">
                                    Next
                                </a>
                            <?php else : ?>
                                <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none border bg-background shadow-xs h-8 rounded-md gap-1.5 px-3 opacity-50 cursor-not-allowed" disabled>
                                    Next
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-center text-muted-foreground">No blog posts found.</p>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="w-full lg:w-80 space-y-8">
                <!-- Search -->
                <div class="bg-card border border-border rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-foreground mb-4">Search</h3>
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
                        <input 
                            type="search" 
                            name="s" 
                            placeholder="Search articles..." 
                            class="w-full px-4 py-3 pr-10 border border-border rounded-lg bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <input type="hidden" name="post_type" value="blog_post">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground pointer-events-none">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-card border border-border rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-foreground mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-secondary/50 transition-colors group" href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>">
                                <span class="text-foreground group-hover:text-primary transition-colors">All</span>
                                <span class="text-sm text-muted-foreground bg-secondary px-2 py-0.5 rounded-full"><?php echo esc_html( $total_posts ); ?></span>
                            </a>
                        </li>
                        <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                            <?php foreach ( $categories as $category ) : ?>
                                <li>
                                    <a class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-secondary/50 transition-colors group" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                                        <span class="text-foreground group-hover:text-primary transition-colors"><?php echo esc_html( $category->name ); ?></span>
                                        <span class="text-sm text-muted-foreground bg-secondary px-2 py-0.5 rounded-full"><?php echo esc_html( $category->count ); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Recent Posts -->
                <?php if ( $recent_posts->have_posts() ) : ?>
                    <div class="bg-card border border-border rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-foreground mb-4">Recent Posts</h3>
                        <div class="space-y-4">
                            <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); 
                                $recent_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) : 'https://picsum.photos/seed/blog-' . get_the_ID() . '/200/200';
                            ?>
                                <a class="flex gap-3 group" href="<?php the_permalink(); ?>">
                                    <div class="relative w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                        <img 
                                            alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                            loading="lazy" 
                                            decoding="async" 
                                            class="object-cover" 
                                            src="<?php echo esc_url( $recent_image ); ?>" 
                                            style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-foreground group-hover:text-primary transition-colors line-clamp-2">
                                            <?php the_title(); ?>
                                        </h4>
                                        <p class="text-xs text-muted-foreground mt-1"><?php echo get_the_date( 'F j, Y' ); ?></p>
                                    </div>
                                </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Newsletter -->
                <div class="bg-primary/10 border border-primary/20 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-foreground mb-2">Newsletter</h3>
                    <p class="text-sm text-muted-foreground mb-4">Subscribe to get wellness tips and exclusive offers.</p>
                    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                        <input type="hidden" name="action" value="julius_newsletter_subscribe">
                        <?php wp_nonce_field( 'julius_newsletter', 'julius_newsletter_nonce' ); ?>
                        <input 
                            type="email" 
                            name="newsletter_email" 
                            placeholder="Your email address" 
                            required
                            class="w-full px-4 py-3 border border-border rounded-lg bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 mb-3">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 px-4 py-2 w-full bg-primary hover:bg-primary/90 text-primary-foreground">
                            Subscribe
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-secondary/30">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-foreground mb-4">Ready to Experience True Relaxation?</h2>
        <p class="text-muted-foreground text-lg max-w-2xl mx-auto mb-8">Book your appointment today and let our expert therapists help you unwind.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-10 rounded-md bg-primary hover:bg-primary/90 text-primary-foreground px-8">
                Book Now
            </a>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground h-10 rounded-md px-6">
                View Services
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4 ml-1">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
