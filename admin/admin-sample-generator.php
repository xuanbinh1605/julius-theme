<?php
/**
 * Services Sample Generator
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Render Sample Generator Page
 */
function julius_render_sample_generator_page() {
    // Check user permissions
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'julius-theme' ) );
    }
    
    // Handle form submission
    if ( isset( $_POST['julius_generate_samples'] ) && check_admin_referer( 'julius_generate_samples_action', 'julius_generate_samples_nonce' ) ) {
        $count = isset( $_POST['sample_count'] ) ? absint( $_POST['sample_count'] ) : 5;
        $count = min( max( $count, 1 ), 20 ); // Limit between 1-20
        
        $generated = julius_generate_sample_services( $count );
        
        if ( $generated ) {
            echo '<div class="notice notice-success is-dismissible"><p>' . 
                 sprintf( __( 'Successfully generated %d sample service(s)!', 'julius-theme' ), $generated ) . 
                 '</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>' . 
                 __( 'Failed to generate sample services.', 'julius-theme' ) . 
                 '</p></div>';
        }
    }
    
    // Handle delete all samples
    if ( isset( $_POST['julius_delete_samples'] ) && check_admin_referer( 'julius_delete_samples_action', 'julius_delete_samples_nonce' ) ) {
        $deleted = julius_delete_sample_services();
        
        if ( $deleted ) {
            echo '<div class="notice notice-success is-dismissible"><p>' . 
                 sprintf( __( 'Successfully deleted %d sample service(s)!', 'julius-theme' ), $deleted ) . 
                 '</p></div>';
        } else {
            echo '<div class="notice notice-warning is-dismissible"><p>' . 
                 __( 'No sample services found to delete.', 'julius-theme' ) . 
                 '</p></div>';
        }
    }
    
    ?>
    <div class="wrap">
        <h1><?php _e( 'Services Sample Generator', 'julius-theme' ); ?></h1>
        <p class="description"><?php _e( 'Generate sample services for testing and demonstration purposes.', 'julius-theme' ); ?></p>
        
        <div style="max-width: 800px; margin-top: 30px;">
            <div class="card" style="padding: 20px;">
                <h2><?php _e( 'Generate Sample Services', 'julius-theme' ); ?></h2>
                <p><?php _e( 'This tool will create realistic sample services with complete metadata including pricing, benefits, and categories.', 'julius-theme' ); ?></p>
                
                <form method="post" action="">
                    <?php wp_nonce_field( 'julius_generate_samples_action', 'julius_generate_samples_nonce' ); ?>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="sample_count"><?php _e( 'Number of Services', 'julius-theme' ); ?></label>
                            </th>
                            <td>
                                <input type="number" id="sample_count" name="sample_count" value="5" min="1" max="20" class="small-text">
                                <p class="description"><?php _e( 'Enter a number between 1 and 20.', 'julius-theme' ); ?></p>
                            </td>
                        </tr>
                    </table>
                    
                    <p>
                        <button type="submit" name="julius_generate_samples" class="button button-primary button-hero">
                            <?php _e( 'Generate Sample Services', 'julius-theme' ); ?>
                        </button>
                    </p>
                </form>
            </div>
            
            <div class="card" style="padding: 20px; margin-top: 20px; border-left: 4px solid #dc3232;">
                <h2><?php _e( 'Delete Sample Services', 'julius-theme' ); ?></h2>
                <p><?php _e( 'This will permanently delete all services that were created by the sample generator.', 'julius-theme' ); ?></p>
                
                <form method="post" action="" onsubmit="return confirm('<?php esc_attr_e( 'Are you sure you want to delete all sample services? This action cannot be undone.', 'julius-theme' ); ?>');">
                    <?php wp_nonce_field( 'julius_delete_samples_action', 'julius_delete_samples_nonce' ); ?>
                    
                    <p>
                        <button type="submit" name="julius_delete_samples" class="button button-secondary">
                            <?php _e( 'Delete All Sample Services', 'julius-theme' ); ?>
                        </button>
                    </p>
                </form>
            </div>
            
            <div class="card" style="padding: 20px; margin-top: 20px; background: #f0f6fc; border-left: 4px solid #0073aa;">
                <h3><?php _e( 'Sample Services Info', 'julius-theme' ); ?></h3>
                <p><?php _e( 'Generated services include:', 'julius-theme' ); ?></p>
                <ul style="list-style: disc; padding-left: 20px;">
                    <li><?php _e( 'Spa and wellness service titles and descriptions', 'julius-theme' ); ?></li>
                    <li><?php _e( 'Service duration and phone contact', 'julius-theme' ); ?></li>
                    <li><?php _e( 'Multiple pricing options', 'julius-theme' ); ?></li>
                    <li><?php _e( 'Benefits and included items', 'julius-theme' ); ?></li>
                    <li><?php _e( 'Service categories (automatically created)', 'julius-theme' ); ?></li>
                    <li><?php _e( 'Featured service flags', 'julius-theme' ); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Generate Sample Services
 */
function julius_generate_sample_services( $count = 5 ) {
    $generated_count = 0;
    
    // Sample data arrays
    $services = array(
        array(
            'title' => 'Swedish Massage Therapy',
            'content' => 'Experience the ultimate relaxation with our Swedish massage therapy. This classic massage technique uses gentle, flowing strokes to ease muscle tension, improve circulation, and promote overall wellbeing. Perfect for those seeking stress relief and complete relaxation.',
            'duration' => '60 minutes',
            'category' => 'Massage',
            'featured' => true,
            'pricing' => array(
                array( 'name' => 'Standard Session', 'price' => '500,000 VND' ),
                array( 'name' => 'Extended Session (90 min)', 'price' => '700,000 VND' ),
            ),
            'benefits' => array(
                'Reduces muscle tension and pain',
                'Improves blood circulation',
                'Promotes relaxation and stress relief',
                'Enhances flexibility and range of motion',
            ),
            'included' => array(
                'Aromatherapy oils',
                'Hot towel treatment',
                'Complimentary herbal tea',
                'Post-massage consultation',
            ),
        ),
        array(
            'title' => 'Hot Stone Therapy',
            'content' => 'Indulge in the therapeutic warmth of hot stone massage. Smooth, heated stones are placed on key points of your body and used in massage techniques to melt away tension, improve energy flow, and provide deep muscle relaxation.',
            'duration' => '75 minutes',
            'category' => 'Massage',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Full Body Treatment', 'price' => '850,000 VND' ),
                array( 'name' => 'Back & Shoulders Focus', 'price' => '600,000 VND' ),
            ),
            'benefits' => array(
                'Deep muscle relaxation',
                'Improves blood flow',
                'Reduces stress and anxiety',
                'Eases chronic pain',
            ),
            'included' => array(
                'Heated basalt stones',
                'Premium massage oils',
                'Warm neck pillow',
                'Cooling face mist',
            ),
        ),
        array(
            'title' => 'Deep Tissue Massage',
            'content' => 'Target chronic muscle tension with our deep tissue massage. Using firm pressure and slow strokes, this therapeutic treatment reaches deeper layers of muscle and connective tissue to release chronic patterns of tension and restore mobility.',
            'duration' => '60 minutes',
            'category' => 'Massage',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Single Session', 'price' => '650,000 VND' ),
                array( 'name' => '3-Session Package', 'price' => '1,800,000 VND' ),
            ),
            'benefits' => array(
                'Relieves chronic muscle pain',
                'Breaks up scar tissue',
                'Improves posture',
                'Increases range of motion',
            ),
            'included' => array(
                'Targeted muscle assessment',
                'Therapeutic-grade oils',
                'Heat therapy application',
                'Home care recommendations',
            ),
        ),
        array(
            'title' => 'Aromatherapy Facial',
            'content' => 'Rejuvenate your skin with our luxurious aromatherapy facial. This treatment combines the healing properties of essential oils with advanced skincare techniques to cleanse, exfoliate, and nourish your skin, leaving it glowing and refreshed.',
            'duration' => '90 minutes',
            'category' => 'Facial',
            'featured' => true,
            'pricing' => array(
                array( 'name' => 'Classic Facial', 'price' => '750,000 VND' ),
                array( 'name' => 'Deluxe with Mask', 'price' => '950,000 VND' ),
            ),
            'benefits' => array(
                'Deep cleanses and purifies skin',
                'Reduces fine lines and wrinkles',
                'Improves skin texture and tone',
                'Promotes cellular renewal',
            ),
            'included' => array(
                'Skin analysis',
                'Custom essential oil blend',
                'Face massage and mask',
                'Moisturizer application',
            ),
        ),
        array(
            'title' => 'Seaweed Body Wrap',
            'content' => 'Detoxify and nourish your body with our mineral-rich seaweed body wrap. This luxurious treatment uses marine algae to hydrate skin, reduce the appearance of cellulite, and promote detoxification while you relax in a warm cocoon.',
            'duration' => '75 minutes',
            'category' => 'Body Treatment',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Full Body Wrap', 'price' => '900,000 VND' ),
                array( 'name' => 'Wrap + Massage Combo', 'price' => '1,300,000 VND' ),
            ),
            'benefits' => array(
                'Detoxifies and purifies skin',
                'Improves skin elasticity',
                'Reduces water retention',
                'Nourishes with minerals',
            ),
            'included' => array(
                'Exfoliation treatment',
                'Seaweed application',
                'Thermal blanket wrap',
                'Moisturizing body lotion',
            ),
        ),
        array(
            'title' => 'Reflexology Treatment',
            'content' => 'Experience the ancient healing art of reflexology. By applying pressure to specific points on the feet, hands, and ears, this treatment promotes healing throughout the entire body, reduces stress, and restores balance.',
            'duration' => '45 minutes',
            'category' => 'Holistic Therapy',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Foot Reflexology', 'price' => '400,000 VND' ),
                array( 'name' => 'Full Body Points', 'price' => '600,000 VND' ),
            ),
            'benefits' => array(
                'Improves circulation',
                'Promotes natural healing',
                'Reduces stress and tension',
                'Enhances overall wellbeing',
            ),
            'included' => array(
                'Foot soak with essential oils',
                'Pressure point therapy',
                'Moisturizing foot treatment',
                'Herbal tea service',
            ),
        ),
        array(
            'title' => 'Couples Spa Package',
            'content' => 'Share the spa experience with someone special in our couples treatment room. Enjoy side-by-side massages in a private, romantic setting complete with champagne, chocolates, and soft music for a truly memorable experience.',
            'duration' => '120 minutes',
            'category' => 'Signature',
            'featured' => true,
            'pricing' => array(
                array( 'name' => 'Classic Couples Massage', 'price' => '1,800,000 VND' ),
                array( 'name' => 'Deluxe Romance Package', 'price' => '2,500,000 VND' ),
            ),
            'benefits' => array(
                'Shared relaxation experience',
                'Private luxury suite',
                'Strengthens connection',
                'Creates lasting memories',
            ),
            'included' => array(
                'Private couple\'s suite',
                'Champagne and chocolates',
                'Rose petal decoration',
                'Personalized music selection',
            ),
        ),
        array(
            'title' => 'Anti-Aging Treatment',
            'content' => 'Turn back the clock with our advanced anti-aging facial treatment. Combining cutting-edge techniques with potent serums and peptides, this treatment targets fine lines, wrinkles, and age spots to restore a youthful, radiant complexion.',
            'duration' => '90 minutes',
            'category' => 'Facial',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Single Treatment', 'price' => '1,200,000 VND' ),
                array( 'name' => '5-Treatment Package', 'price' => '5,500,000 VND' ),
            ),
            'benefits' => array(
                'Reduces fine lines and wrinkles',
                'Brightens skin tone',
                'Firms and lifts',
                'Stimulates collagen production',
            ),
            'included' => array(
                'Advanced skin analysis',
                'Peptide serum application',
                'LED light therapy',
                'Take-home skincare samples',
            ),
        ),
        array(
            'title' => 'Prenatal Massage',
            'content' => 'Specially designed for expecting mothers, our prenatal massage helps relieve the discomforts of pregnancy. Using gentle techniques and supportive positioning, this treatment safely eases back pain, reduces swelling, and promotes relaxation.',
            'duration' => '60 minutes',
            'category' => 'Massage',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Single Session', 'price' => '700,000 VND' ),
                array( 'name' => 'Monthly Package (4 sessions)', 'price' => '2,500,000 VND' ),
            ),
            'benefits' => array(
                'Relieves pregnancy-related discomfort',
                'Reduces swelling in legs and feet',
                'Improves sleep quality',
                'Promotes maternal wellness',
            ),
            'included' => array(
                'Pregnancy-safe oils',
                'Supportive body pillows',
                'Gentle stretching techniques',
                'Wellness consultation',
            ),
        ),
        array(
            'title' => 'Himalayan Salt Stone Massage',
            'content' => 'Experience the unique healing properties of Himalayan salt stones. Hand-carved stones are warmed and used to massage away tension while delivering over 80 trace minerals to detoxify, exfoliate, and balance your body\'s electromagnetic field.',
            'duration' => '75 minutes',
            'category' => 'Massage',
            'featured' => false,
            'pricing' => array(
                array( 'name' => 'Full Body Treatment', 'price' => '950,000 VND' ),
                array( 'name' => 'Back, Neck & Shoulders', 'price' => '650,000 VND' ),
            ),
            'benefits' => array(
                'Detoxifies the body',
                'Reduces inflammation',
                'Balances body\'s pH',
                'Promotes better sleep',
            ),
            'included' => array(
                'Himalayan salt stones',
                'Mineral-rich massage oil',
                'Warm herbal compress',
                'Detox water with lemon',
            ),
        ),
    );
    
    // Generate the requested number of services
    for ( $i = 0; $i < $count && $i < count( $services ); $i++ ) {
        $service = $services[ $i ];
        
        // Create the post
        $post_data = array(
            'post_title'   => $service['title'],
            'post_content' => $service['content'],
            'post_status'  => 'publish',
            'post_type'    => 'service',
            'post_excerpt' => wp_trim_words( $service['content'], 20 ),
        );
        
        $post_id = wp_insert_post( $post_data );
        
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            // Mark as sample for easy deletion later
            update_post_meta( $post_id, '_julius_is_sample', '1' );
            
            // Save meta fields
            update_post_meta( $post_id, '_julius_service_duration', $service['duration'] );
            update_post_meta( $post_id, '_julius_service_phone', '+84 123 456 789' );
            update_post_meta( $post_id, '_julius_service_included', 'Professional therapist, comfortable environment, personalized service' );
            update_post_meta( $post_id, '_julius_service_note', 'Please arrive 15 minutes early. Cancellations require 24 hours notice.' );
            
            if ( $service['featured'] ) {
                update_post_meta( $post_id, '_julius_service_featured', '1' );
            }
            
            // Save pricing options
            if ( ! empty( $service['pricing'] ) ) {
                update_post_meta( $post_id, '_julius_pricing_options', $service['pricing'] );
            }
            
            // Save benefits
            if ( ! empty( $service['benefits'] ) ) {
                update_post_meta( $post_id, '_julius_service_benefits', $service['benefits'] );
            }
            
            // Save what's included
            if ( ! empty( $service['included'] ) ) {
                update_post_meta( $post_id, '_julius_service_whats_included', $service['included'] );
            }
            
            // Assign category
            if ( ! empty( $service['category'] ) ) {
                $term = term_exists( $service['category'], 'service_category' );
                
                if ( ! $term ) {
                    $term = wp_insert_term( $service['category'], 'service_category' );
                }
                
                if ( ! is_wp_error( $term ) ) {
                    wp_set_object_terms( $post_id, $term['term_id'], 'service_category' );
                }
            }
            
            $generated_count++;
        }
    }
    
    return $generated_count;
}

/**
 * Delete Sample Services
 */
function julius_delete_sample_services() {
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'meta_key'       => '_julius_is_sample',
        'meta_value'     => '1',
        'fields'         => 'ids',
    );
    
    $sample_services = get_posts( $args );
    $deleted_count = 0;
    
    foreach ( $sample_services as $post_id ) {
        if ( wp_delete_post( $post_id, true ) ) {
            $deleted_count++;
        }
    }
    
    return $deleted_count;
}
