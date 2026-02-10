<?php
/**
 * Booking Email Functions
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Send booking confirmation to user
 */
function julius_booking_send_confirmation( $booking_id ) {
    $booking = julius_booking_get_by_id( $booking_id );
    
    if ( ! $booking || empty( $booking->email ) ) {
        return false;
    }
    
    $site_name = get_bloginfo( 'name' );
    $service_url = $booking->service_id ? get_permalink( $booking->service_id ) : home_url( '/services' );
    
    // Get branch details
    $branch_name = $booking->branch === 'julius-1' ? 'Julius 1 - 5 An Thuong 38' : 'Julius 2 - 61 Ta My Duat';
    
    $subject = sprintf( __( 'Booking Confirmation - %s', 'julius-theme' ), $site_name );
    
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
                                <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">Booking Confirmed! ✓</h1>
                            </td>
                        </tr>
                        
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    Dear ' . esc_html( $booking->name ) . ',
                                </p>
                                <p style="margin: 0 0 24px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    Thank you for choosing ' . esc_html( $site_name ) . '! We have received your booking request and will contact you shortly to confirm your appointment.
                                </p>
                                
                                <!-- Booking Details -->
                                <div style="background-color: #f9fafb; border-left: 4px solid #667eea; border-radius: 4px; padding: 20px; margin: 0 0 30px;">
                                    <h2 style="margin: 0 0 16px; color: #1f2937; font-size: 18px; font-weight: bold;">Booking Details</h2>
                                    
                                    <table width="100%" cellpadding="8" cellspacing="0">
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600; width: 140px;">Service:</td>
                                            <td style="color: #1f2937; font-size: 14px; font-weight: 600;">' . esc_html( $booking->service_name ) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600;">Branch:</td>
                                            <td style="color: #1f2937; font-size: 14px;">' . esc_html( $branch_name ) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600;">Name:</td>
                                            <td style="color: #1f2937; font-size: 14px;">' . esc_html( $booking->name ) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600;">Phone:</td>
                                            <td style="color: #1f2937; font-size: 14px;">' . esc_html( $booking->phone ) . '</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600;">Booking Date:</td>
                                            <td style="color: #1f2937; font-size: 14px;">' . date( 'F j, Y g:i A', strtotime( $booking->booking_date ) ) . '</td>
                                        </tr>';
    
    if ( ! empty( $booking->message ) ) {
        $message .= '
                                        <tr>
                                            <td style="color: #6b7280; font-size: 14px; font-weight: 600; vertical-align: top;">Message:</td>
                                            <td style="color: #1f2937; font-size: 14px;">' . nl2br( esc_html( $booking->message ) ) . '</td>
                                        </tr>';
    }
    
    $message .= '
                                    </table>
                                </div>
                                
                                <div style="background-color: #fef3c7; border: 1px solid #f59e0b; border-radius: 6px; padding: 16px; margin: 0 0 30px;">
                                    <p style="margin: 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                        <strong>⏰ What\'s Next?</strong><br>
                                        Our team will contact you within 24 hours to confirm your appointment time and answer any questions you may have.
                                    </p>
                                </div>
                                
                                <!-- CTA Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( $service_url ) . '" style="display: inline-block; padding: 14px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">View Service Details</a>
                                        </td>
                                    </tr>
                                </table>
                                
                                <p style="margin: 30px 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                    If you have any questions, please don\'t hesitate to contact us.
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
                                    <a href="' . esc_url( home_url() ) . '" style="color: #667eea; text-decoration: none;">Visit our website</a>
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
    
    return wp_mail( $booking->email, $subject, $message, $headers );
}

/**
 * Send booking notification to admin
 */
function julius_booking_send_admin_notification( $booking_id ) {
    $booking = julius_booking_get_by_id( $booking_id );
    
    if ( ! $booking ) {
        return false;
    }
    
    $site_name = get_bloginfo( 'name' );
    $admin_email = get_option( 'admin_email' );
    
    // Get branch details
    $branch_name = $booking->branch === 'julius-1' ? 'Julius 1 - 5 An Thuong 38' : 'Julius 2 - 61 Ta My Duat';
    
    $subject = sprintf( __( '[%s] New Booking Received - %s', 'julius-theme' ), $site_name, $booking->service_name );
    
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
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">New Booking Received 📅</h1>
                            </td>
                        </tr>
                        
                        <!-- Body -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                    You have received a new booking request!
                                </p>
                                
                                <!-- Booking Details -->
                                <table width="100%" cellpadding="10" cellspacing="0" style="background-color: #f8f9fa; border-radius: 6px; margin: 20px 0;">
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef; width: 140px;">
                                            Service:
                                        </td>
                                        <td style="color: #333333; font-size: 16px; font-weight: 600; border-bottom: 1px solid #e9ecef;">
                                            ' . esc_html( $booking->service_name ) . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Branch:
                                        </td>
                                        <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #e9ecef;">
                                            ' . esc_html( $branch_name ) . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Customer Name:
                                        </td>
                                        <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #e9ecef;">
                                            ' . esc_html( $booking->name ) . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Phone:
                                        </td>
                                        <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #e9ecef;">
                                            <a href="tel:' . esc_attr( $booking->phone ) . '" style="color: #667eea; text-decoration: none;">' . esc_html( $booking->phone ) . '</a>
                                        </td>
                                    </tr>';
    
    if ( ! empty( $booking->email ) ) {
        $message .= '
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Email:
                                        </td>
                                        <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #e9ecef;">
                                            <a href="mailto:' . esc_attr( $booking->email ) . '" style="color: #667eea; text-decoration: none;">' . esc_html( $booking->email ) . '</a>
                                        </td>
                                    </tr>';
    }
    
    $message .= '
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; border-bottom: 1px solid #e9ecef;">
                                            Booking Date:
                                        </td>
                                        <td style="color: #333333; font-size: 14px; border-bottom: 1px solid #e9ecef;">
                                            ' . date( 'F j, Y g:i A', strtotime( $booking->booking_date ) ) . '
                                        </td>
                                    </tr>';
    
    if ( ! empty( $booking->message ) ) {
        $message .= '
                                    <tr>
                                        <td style="color: #666666; font-size: 14px; font-weight: bold; vertical-align: top;">
                                            Message:
                                        </td>
                                        <td style="color: #333333; font-size: 14px;">
                                            ' . nl2br( esc_html( $booking->message ) ) . '
                                        </td>
                                    </tr>';
    }
    
    $message .= '
                                </table>
                                
                                <!-- CTA Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="' . esc_url( admin_url( 'admin.php?page=julius-bookings' ) ) . '" style="display: inline-block; padding: 14px 40px; background-color: #667eea; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">View All Bookings</a>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div style="background-color: #fef3c7; border: 1px solid #f59e0b; border-radius: 6px; padding: 16px; margin: 20px 0 0;">
                                    <p style="margin: 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                        <strong>⚡ Action Required:</strong> Please contact the customer within 24 hours to confirm their appointment.
                                    </p>
                                </div>
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
