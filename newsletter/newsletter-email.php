<?php
/**
 * Newsletter Email Functions
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Send thank you email to subscriber
 */
function julius_newsletter_send_thank_you_email( $email, $token ) {
    $site_name = get_bloginfo( 'name' );
    $unsubscribe_url = add_query_arg( 
        array( 
            'newsletter_action' => 'unsubscribe',
            'token' => $token 
        ), 
        home_url() 
    );
    
    $subject = sprintf( __( 'Welcome to %s Newsletter!', 'julius-theme' ), $site_name );
    
    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center;">
                                <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">Welcome! 🎉</h1>
                            </td>
                        </tr>
                        
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    Thank you for subscribing to our newsletter!
                                </p>
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    You\'ll now receive exclusive wellness tips, spa updates, and special offers directly to your inbox.
                                </p>
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    We\'re excited to have you as part of our ' . esc_html( $site_name ) . ' family!
                                </p>
                                
                                <!-- CTA Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( home_url() ) . '" style="display: inline-block; padding: 14px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">Visit Our Website</a>
                                        </td>
                                    </tr>
                                </table>
                                
                                <p style="margin: 30px 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                    If you have any questions, feel free to reach out to us anytime.
                                </p>
                            </td>
                        </tr>
                        
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-top: 1px solid #e9ecef;">
                                <p style="margin: 0 0 10px; color: #999999; font-size: 12px;">
                                    &copy; ' . date( 'Y' ) . ' ' . esc_html( $site_name ) . '. All rights reserved.
                                </p>
                                <p style="margin: 0; color: #999999; font-size: 12px;">
                                    <a href="' . esc_url( $unsubscribe_url ) . '" style="color: #667eea; text-decoration: none;">Unsubscribe</a> from this list
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <' . get_option( 'admin_email' ) . '>'
    );
    
    return wp_mail( $email, $subject, $message, $headers );
}

/**
 * Send notification to admin about new subscriber
 */
function julius_newsletter_send_admin_notification( $email ) {
    $site_name = get_bloginfo( 'name' );
    $admin_email = get_option( 'admin_email' );
    
    $subject = sprintf( __( '[%s] New Newsletter Subscriber', 'julius-theme' ), $site_name );
    
    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background-color: #667eea; padding: 30px; text-align: center;">
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">New Newsletter Subscriber 📧</h1>
                            </td>
                        </tr>
                        
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    A new user has subscribed to your newsletter!
                                </p>
                                
                                <table width="100%" cellpadding="10" cellspacing="0" style="background-color: #f8f9fa; border-radius: 6px; margin: 20px 0;">
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Email Address:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #333333; font-size: 16px;">
                                            ' . esc_html( $email ) . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-top: 1px solid #e9ecef; border-bottom: 1px solid #e9ecef;">
                                            Date & Time:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #333333; font-size: 16px;">
                                            ' . current_time( 'F j, Y g:i a' ) . '
                                        </td>
                                    </tr>
                                </table>
                                
                                <!-- CTA Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( admin_url( 'admin.php?page=julius-newsletter' ) ) . '" style="display: inline-block; padding: 14px 40px; background-color: #667eea; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">View All Subscribers</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e9ecef;">
                                <p style="margin: 0; color: #999999; font-size: 12px;">
                                    This is an automated notification from ' . esc_html( $site_name ) . '
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );
    
    return wp_mail( $admin_email, $subject, $message, $headers );
}

/**
 * Send unsubscribe confirmation
 */
function julius_newsletter_send_unsubscribe_confirmation( $email ) {
    $site_name = get_bloginfo( 'name' );
    
    $subject = sprintf( __( 'You\'ve been unsubscribed from %s', 'julius-theme' ), $site_name );
    
    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background-color: #6c757d; padding: 30px; text-align: center;">
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">Unsubscribed</h1>
                            </td>
                        </tr>
                        
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px; text-align: center;">
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    You\'ve been successfully unsubscribed from our newsletter.
                                </p>
                                <p style="margin: 0 0 20px; color: #666666; font-size: 14px; line-height: 1.6;">
                                    We\'re sorry to see you go! If you change your mind, you can always subscribe again from our website.
                                </p>
                                
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( home_url() ) . '" style="display: inline-block; padding: 14px 40px; background-color: #6c757d; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">Visit Our Website</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e9ecef;">
                                <p style="margin: 0; color: #999999; font-size: 12px;">
                                    &copy; ' . date( 'Y' ) . ' ' . esc_html( $site_name ) . '. All rights reserved.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <' . get_option( 'admin_email' ) . '>'
    );
    
    return wp_mail( $email, $subject, $message, $headers );
}

/**
 * Send new blog post notification to subscriber
 */
function julius_newsletter_send_post_notification( $email, $token, $post_id ) {
    $site_name = get_bloginfo( 'name' );
    $post = get_post( $post_id );
    
    if ( ! $post ) {
        return false;
    }
    
    $post_title = get_the_title( $post_id );
    $post_excerpt = get_the_excerpt( $post_id );
    if ( empty( $post_excerpt ) ) {
        $post_excerpt = wp_trim_words( strip_tags( $post->post_content ), 30, '...' );
    }
    $post_url = get_permalink( $post_id );
    $post_date = get_the_date( 'F j, Y', $post_id );
    $featured_image = has_post_thumbnail( $post_id ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : '';
    
    // Get categories
    $categories = get_the_terms( $post_id, 'blog_category' );
    $category_name = '';
    if ( $categories && ! is_wp_error( $categories ) ) {
        $category_name = $categories[0]->name;
    }
    
    // Get author
    $author_terms = get_the_terms( $post_id, 'blog_author' );
    $author_name = '';
    if ( $author_terms && ! is_wp_error( $author_terms ) ) {
        $author_name = $author_terms[0]->name;
    }
    
    // Calculate reading time
    $word_count = str_word_count( strip_tags( $post->post_content ) );
    $reading_time = ceil( $word_count / 200 );
    
    $unsubscribe_url = add_query_arg( 
        array( 
            'newsletter_action' => 'unsubscribe',
            'token' => $token 
        ), 
        home_url() 
    );
    
    $subject = sprintf( __( 'New Post: %s', 'julius-theme' ), $post_title );
    
    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center;">
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">New Blog Post 📝</h1>
                            </td>
                        </tr>';
    
    // Featured Image
    if ( $featured_image ) {
        $message .= '
                        <tr>
                            <td style="padding: 0;">
                                <img src="' . esc_url( $featured_image ) . '" alt="' . esc_attr( $post_title ) . '" style="width: 100%; height: auto; display: block;">
                            </td>
                        </tr>';
    }
    
    $message .= '
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px;">';
    
    // Category badge
    if ( $category_name ) {
        $message .= '
                                <div style="margin-bottom: 20px;">
                                    <span style="display: inline-block; padding: 6px 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                                        ' . esc_html( $category_name ) . '
                                    </span>
                                </div>';
    }
    
    $message .= '
                                <h2 style="margin: 0 0 16px; color: #1f2937; font-size: 28px; font-weight: bold; line-height: 1.3;">
                                    ' . esc_html( $post_title ) . '
                                </h2>
                                
                                <div style="margin: 0 0 24px; padding: 0; display: flex; align-items: center; gap: 20px; font-size: 14px; color: #6b7280;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="padding-right: 20px; color: #6b7280; font-size: 14px;">
                                                📅 ' . esc_html( $post_date ) . '
                                            </td>
                                            <td style="padding-right: 20px; color: #6b7280; font-size: 14px;">
                                                ⏱️ ' . esc_html( $reading_time ) . ' min read
                                            </td>';
    
    if ( $author_name ) {
        $message .= '
                                            <td style="color: #6b7280; font-size: 14px;">
                                                ✍️ ' . esc_html( $author_name ) . '
                                            </td>';
    }
    
    $message .= '
                                        </tr>
                                    </table>
                                </div>
                                
                                <p style="margin: 0 0 24px; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                    ' . esc_html( $post_excerpt ) . '
                                </p>
                                
                                <!-- CTA Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( $post_url ) . '" style="display: inline-block; padding: 16px 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(102, 126, 234, 0.4);">Read Full Article</a>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div style="margin: 30px 0 0; padding: 20px; background-color: #f9fafb; border-left: 4px solid #667eea; border-radius: 4px;">
                                    <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                        💡 <strong>Stay Connected:</strong> Follow us for more wellness tips, spa guides, and exclusive offers.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-top: 1px solid #e9ecef;">
                                <p style="margin: 0 0 10px; color: #999999; font-size: 12px;">
                                    &copy; ' . date( 'Y' ) . ' ' . esc_html( $site_name ) . '. All rights reserved.
                                </p>
                                <p style="margin: 0; color: #999999; font-size: 12px;">
                                    You\'re receiving this email because you subscribed to our newsletter.<br>
                                    <a href="' . esc_url( $unsubscribe_url ) . '" style="color: #667eea; text-decoration: none;">Unsubscribe</a> from this list
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <' . get_option( 'admin_email' ) . '>'
    );
    
    return wp_mail( $email, $subject, $message, $headers );
}

/**
 * Send new post notification to all active subscribers
 */
function julius_newsletter_send_to_all_subscribers( $post_id ) {
    // Get all active subscribers
    $subscribers = julius_newsletter_get_all_subscribers( 'active' );
    
    if ( empty( $subscribers ) ) {
        return 0;
    }
    
    $sent_count = 0;
    
    // Send email to each subscriber
    foreach ( $subscribers as $subscriber ) {
        $result = julius_newsletter_send_post_notification( 
            $subscriber->email, 
            $subscriber->unsubscribe_token, 
            $post_id 
        );
        
        if ( $result ) {
            $sent_count++;
        }
        
        // Add a small delay to avoid overwhelming the mail server
        usleep( 100000 ); // 0.1 second delay
    }
    
    return $sent_count;
}
