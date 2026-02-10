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
