<?php
/**
 * Newsletter Form Handlers
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle newsletter subscription form submission (Standard POST)
 */
function julius_newsletter_handle_subscription() {
    // Verify nonce
    if ( ! isset( $_POST['julius_newsletter_nonce'] ) || ! wp_verify_nonce( $_POST['julius_newsletter_nonce'], 'julius_newsletter' ) ) {
        wp_die( __( 'Security check failed.', 'julius-theme' ) );
    }
    
    // Get and validate email
    $email = isset( $_POST['newsletter_email'] ) ? sanitize_email( $_POST['newsletter_email'] ) : '';
    
    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_redirect( add_query_arg( 'newsletter_error', 'invalid_email', wp_get_referer() ) );
        exit;
    }
    
    // Check if already subscribed
    if ( julius_newsletter_subscriber_exists( $email ) ) {
        $subscriber = julius_newsletter_get_subscriber( $email );
        
        if ( $subscriber->status === 'active' ) {
            wp_redirect( add_query_arg( 'newsletter_error', 'already_subscribed', wp_get_referer() ) );
            exit;
        } elseif ( $subscriber->status === 'unsubscribed' ) {
            // Reactivate subscription
            julius_newsletter_update_subscriber_status( $email, 'active' );
            wp_redirect( add_query_arg( 'newsletter_success', 'resubscribed', wp_get_referer() ) );
            exit;
        }
    }
    
    // Get IP address
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    
    // Add subscriber
    $token = julius_newsletter_add_subscriber( $email, $ip_address );
    
    if ( $token ) {
        // Send thank you email
        julius_newsletter_send_thank_you_email( $email, $token );
        
        // Send admin notification
        julius_newsletter_send_admin_notification( $email );
        
        wp_redirect( add_query_arg( 'newsletter_success', '1', wp_get_referer() ) );
    } else {
        wp_redirect( add_query_arg( 'newsletter_error', 'db_error', wp_get_referer() ) );
    }
    
    exit;
}
add_action( 'admin_post_nopriv_julius_newsletter_subscribe', 'julius_newsletter_handle_subscription' );
add_action( 'admin_post_julius_newsletter_subscribe', 'julius_newsletter_handle_subscription' );

/**
 * Handle newsletter subscription via AJAX
 */
function julius_newsletter_ajax_subscribe() {
    // Verify nonce
    check_ajax_referer( 'julius-newsletter-ajax', 'nonce' );
    
    // Get and validate email
    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    
    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array(
            'message' => __( 'Please enter a valid email address.', 'julius-theme' )
        ) );
    }
    
    // Check if already subscribed
    if ( julius_newsletter_subscriber_exists( $email ) ) {
        $subscriber = julius_newsletter_get_subscriber( $email );
        
        if ( $subscriber->status === 'active' ) {
            wp_send_json_error( array(
                'message' => __( 'This email is already subscribed to our newsletter.', 'julius-theme' )
            ) );
        } elseif ( $subscriber->status === 'unsubscribed' ) {
            // Reactivate subscription
            julius_newsletter_update_subscriber_status( $email, 'active' );
            
            wp_send_json_success( array(
                'message' => __( 'Welcome back! You\'ve been resubscribed to our newsletter.', 'julius-theme' )
            ) );
        }
    }
    
    // Get IP address
    $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';
    
    // Add subscriber
    $token = julius_newsletter_add_subscriber( $email, $ip_address );
    
    if ( $token ) {
        // Send thank you email
        julius_newsletter_send_thank_you_email( $email, $token );
        
        // Send admin notification
        julius_newsletter_send_admin_notification( $email );
        
        wp_send_json_success( array(
            'message' => __( 'Thank you for subscribing! Check your email for confirmation.', 'julius-theme' )
        ) );
    } else {
        wp_send_json_error( array(
            'message' => __( 'Something went wrong. Please try again later.', 'julius-theme' )
        ) );
    }
}
add_action( 'wp_ajax_nopriv_julius_newsletter_subscribe', 'julius_newsletter_ajax_subscribe' );
add_action( 'wp_ajax_julius_newsletter_subscribe', 'julius_newsletter_ajax_subscribe' );

/**
 * Handle unsubscribe requests
 */
function julius_newsletter_handle_unsubscribe() {
    if ( ! isset( $_GET['newsletter_action'] ) || $_GET['newsletter_action'] !== 'unsubscribe' ) {
        return;
    }
    
    if ( ! isset( $_GET['token'] ) ) {
        return;
    }
    
    $token = sanitize_text_field( $_GET['token'] );
    $subscriber = julius_newsletter_get_subscriber_by_token( $token );
    
    if ( ! $subscriber ) {
        wp_die( __( 'Invalid unsubscribe link.', 'julius-theme' ) );
    }
    
    if ( $subscriber->status === 'unsubscribed' ) {
        wp_die( __( 'You are already unsubscribed.', 'julius-theme' ) );
    }
    
    // Unsubscribe
    $result = julius_newsletter_unsubscribe_by_token( $token );
    
    if ( $result ) {
        // Send confirmation email
        julius_newsletter_send_unsubscribe_confirmation( $subscriber->email );
        
        // Redirect to homepage with success message
        wp_redirect( add_query_arg( 'newsletter_unsubscribed', '1', home_url() ) );
        exit;
    } else {
        wp_die( __( 'Something went wrong. Please try again later.', 'julius-theme' ) );
    }
}
add_action( 'template_redirect', 'julius_newsletter_handle_unsubscribe' );

/**
 * Display newsletter messages
 */
function julius_newsletter_display_messages() {
    if ( isset( $_GET['newsletter_success'] ) ) {
        if ( $_GET['newsletter_success'] === 'resubscribed' ) {
            echo '<div class="newsletter-message newsletter-success" style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 9999; animation: slideIn 0.3s ease-out;">
                <p style="margin: 0; font-size: 14px;">✓ Welcome back! You\'ve been resubscribed to our newsletter.</p>
            </div>';
        } else {
            echo '<div class="newsletter-message newsletter-success" style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 9999; animation: slideIn 0.3s ease-out;">
                <p style="margin: 0; font-size: 14px;">✓ Thank you for subscribing! Check your email for confirmation.</p>
            </div>';
        }
        
        echo '<script>
            setTimeout(function() {
                var message = document.querySelector(".newsletter-message");
                if (message) {
                    message.style.animation = "slideOut 0.3s ease-out";
                    setTimeout(function() { message.remove(); }, 300);
                }
            }, 5000);
        </script>';
        
        echo '<style>
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        </style>';
    }
    
    if ( isset( $_GET['newsletter_error'] ) ) {
        $error_message = '';
        
        switch ( $_GET['newsletter_error'] ) {
            case 'invalid_email':
                $error_message = 'Please enter a valid email address.';
                break;
            case 'already_subscribed':
                $error_message = 'This email is already subscribed to our newsletter.';
                break;
            case 'db_error':
                $error_message = 'Something went wrong. Please try again later.';
                break;
            default:
                $error_message = 'An error occurred. Please try again.';
        }
        
        echo '<div class="newsletter-message newsletter-error" style="position: fixed; top: 20px; right: 20px; background: #ef4444; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 9999; animation: slideIn 0.3s ease-out;">
            <p style="margin: 0; font-size: 14px;">✕ ' . esc_html( $error_message ) . '</p>
        </div>';
        
        echo '<script>
            setTimeout(function() {
                var message = document.querySelector(".newsletter-message");
                if (message) {
                    message.style.animation = "slideOut 0.3s ease-out";
                    setTimeout(function() { message.remove(); }, 300);
                }
            }, 5000);
        </script>';
        
        echo '<style>
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        </style>';
    }
    
    if ( isset( $_GET['newsletter_unsubscribed'] ) ) {
        echo '<div class="newsletter-message newsletter-info" style="position: fixed; top: 20px; right: 20px; background: #6366f1; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 9999; animation: slideIn 0.3s ease-out;">
            <p style="margin: 0; font-size: 14px;">✓ You\'ve been unsubscribed from our newsletter.</p>
        </div>';
        
        echo '<script>
            setTimeout(function() {
                var message = document.querySelector(".newsletter-message");
                if (message) {
                    message.style.animation = "slideOut 0.3s ease-out";
                    setTimeout(function() { message.remove(); }, 300);
                }
            }, 5000);
        </script>';
        
        echo '<style>
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        </style>';
    }
}
add_action( 'wp_footer', 'julius_newsletter_display_messages' );

/**
 * Automatically send newsletter when a blog post is published
 */
function julius_newsletter_send_on_publish( $new_status, $old_status, $post ) {
    // Only process blog_post custom post type
    if ( $post->post_type !== 'blog_post' ) {
        return;
    }
    
    // Only send when post is newly published or updated from draft/pending
    if ( $new_status !== 'publish' ) {
        return;
    }
    
    // Don't send if already published (updating existing post)
    if ( $old_status === 'publish' ) {
        return;
    }
    
    // Check if this post has already been sent (to avoid duplicates)
    $already_sent = get_post_meta( $post->ID, '_julius_newsletter_sent', true );
    if ( $already_sent ) {
        return;
    }
    
    // Send to all subscribers
    $sent_count = julius_newsletter_send_to_all_subscribers( $post->ID );
    
    // Mark as sent
    update_post_meta( $post->ID, '_julius_newsletter_sent', true );
    update_post_meta( $post->ID, '_julius_newsletter_sent_count', $sent_count );
    update_post_meta( $post->ID, '_julius_newsletter_sent_date', current_time( 'mysql' ) );
    
    // Add admin notice (for next page load)
    if ( $sent_count > 0 ) {
        set_transient( 'julius_newsletter_sent_notice', $sent_count, 30 );
    }
}
add_action( 'transition_post_status', 'julius_newsletter_send_on_publish', 10, 3 );

/**
 * Display admin notice after newsletter is sent
 */
function julius_newsletter_admin_notice() {
    $sent_count = get_transient( 'julius_newsletter_sent_notice' );
    
    if ( $sent_count ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <strong><?php _e( 'Newsletter sent!', 'julius-theme' ); ?></strong>
                <?php printf( __( 'Blog post notification sent to %d subscribers.', 'julius-theme' ), $sent_count ); ?>
            </p>
        </div>
        <?php
        delete_transient( 'julius_newsletter_sent_notice' );
    }
}
add_action( 'admin_notices', 'julius_newsletter_admin_notice' );
