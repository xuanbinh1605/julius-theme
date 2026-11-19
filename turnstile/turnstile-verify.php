<?php
/**
 * Cloudflare Turnstile server-side verification.
 *
 * @package Julius_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Whether Turnstile credentials are configured in wp-config.php.
 *
 * @return bool
 */
function julius_turnstile_is_enabled() {
    return defined( 'CLOUDFLARE_TURNSTILE_SITE_KEY' )
        && CLOUDFLARE_TURNSTILE_SITE_KEY
        && defined( 'CLOUDFLARE_TURNSTILE_SECRET_KEY' )
        && CLOUDFLARE_TURNSTILE_SECRET_KEY;
}

/**
 * Allowed hostnames for Turnstile siteverify (production + optional dev hosts).
 *
 * Configure additional hosts in wp-config.php:
 * define( 'CLOUDFLARE_TURNSTILE_ALLOWED_HOSTNAMES', 'localhost,juliusspacomvn.local,www.example.com' );
 *
 * @return string[]
 */
function julius_turnstile_get_allowed_hostnames() {
    $hosts = array();

    $site_host = parse_url( home_url(), PHP_URL_HOST );
    if ( $site_host ) {
        $hosts[] = strtolower( $site_host );
    }

    if ( defined( 'CLOUDFLARE_TURNSTILE_ALLOWED_HOSTNAMES' ) && CLOUDFLARE_TURNSTILE_ALLOWED_HOSTNAMES ) {
        $extra = explode( ',', CLOUDFLARE_TURNSTILE_ALLOWED_HOSTNAMES );
        foreach ( $extra as $host ) {
            $host = strtolower( trim( $host ) );
            if ( $host !== '' ) {
                $hosts[] = $host;
            }
        }
    }

    $hosts = array_unique( array_filter( $hosts ) );

    /**
     * Filter the list of hostnames accepted from Turnstile siteverify responses.
     *
     * @param string[] $hosts Allowed hostnames (lowercase).
     */
    return apply_filters( 'julius_turnstile_allowed_hostnames', $hosts );
}

/**
 * User-facing message when Turnstile verification fails.
 *
 * @return string
 */
function julius_turnstile_user_error_message() {
    return __( 'Security verification failed. Please complete the challenge and try again.', 'julius-theme' );
}

/**
 * Read the Turnstile token from the current request.
 *
 * @return string
 */
function julius_turnstile_get_post_token() {
    if ( ! isset( $_POST['cf-turnstile-response'] ) ) {
        return '';
    }

    return sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) );
}

/**
 * Verify a Turnstile token with Cloudflare Siteverify API.
 *
 * @param string $token            Token from cf-turnstile-response.
 * @param string $expected_action  Expected widget action name.
 * @return true|WP_Error
 */
function julius_turnstile_verify( $token, $expected_action ) {
    if ( ! julius_turnstile_is_enabled() ) {
        return new WP_Error( 'turnstile_not_configured', julius_turnstile_user_error_message() );
    }

    if ( $token === '' ) {
        return new WP_Error( 'turnstile_missing_token', julius_turnstile_user_error_message() );
    }

    $token_hash = hash( 'sha256', $token );
    $used_key   = 'julius_ts_used_' . $token_hash;
    if ( get_transient( $used_key ) ) {
        return new WP_Error( 'turnstile_token_reused', julius_turnstile_user_error_message() );
    }

    $remote_ip = '';
    if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $remote_ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
    }

    $response = wp_remote_post(
        'https://challenges.cloudflare.com/turnstile/v0/siteverify',
        array(
            'timeout' => 15,
            'body'    => array(
                'secret'   => CLOUDFLARE_TURNSTILE_SECRET_KEY,
                'response' => $token,
                'remoteip' => $remote_ip,
            ),
        )
    );

    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'turnstile_http_error', julius_turnstile_user_error_message() );
    }

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code !== 200 ) {
        return new WP_Error( 'turnstile_bad_status', julius_turnstile_user_error_message() );
    }

    $body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! is_array( $body ) || empty( $body['success'] ) ) {
        return new WP_Error( 'turnstile_invalid', julius_turnstile_user_error_message() );
    }

    if ( ! empty( $body['hostname'] ) ) {
        $hostname  = strtolower( (string) $body['hostname'] );
        $allowed   = julius_turnstile_get_allowed_hostnames();
        if ( ! in_array( $hostname, $allowed, true ) ) {
            return new WP_Error( 'turnstile_hostname', julius_turnstile_user_error_message() );
        }
    }

    if ( $expected_action !== '' && ! empty( $body['action'] ) && $body['action'] !== $expected_action ) {
        return new WP_Error( 'turnstile_action', julius_turnstile_user_error_message() );
    }

    set_transient( $used_key, 1, 10 * MINUTE_IN_SECONDS );

    return true;
}

/**
 * Verify Turnstile for the current POST request.
 *
 * @param string $expected_action Expected widget action.
 * @return true|WP_Error
 */
function julius_turnstile_verify_request( $expected_action ) {
    return julius_turnstile_verify( julius_turnstile_get_post_token(), $expected_action );
}