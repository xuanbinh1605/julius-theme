<?php
/**
 * Cloudflare Turnstile frontend helpers and assets.
 *
 * @package Julius_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Turnstile action names for each public form.
 */
if ( ! defined( 'JULIUS_TURNSTILE_ACTION_BOOKING' ) ) {
    define( 'JULIUS_TURNSTILE_ACTION_BOOKING', 'booking_submit' );
    define( 'JULIUS_TURNSTILE_ACTION_CONTACT', 'contact_form' );
    define( 'JULIUS_TURNSTILE_ACTION_NEWSLETTER', 'newsletter_subscribe' );
    define( 'JULIUS_TURNSTILE_ACTION_BOOKING_CONTACT', 'booking_contact_submit' );
    define( 'JULIUS_TURNSTILE_ACTION_SERVICE_BOOKING_LEGACY', 'service_booking_legacy' );
}

/**
 * Whether the current page uses the Contact Us template.
 *
 * WordPress may store the slug as template-pages/template-contact.php or template-contact.php.
 *
 * @return bool
 */
function julius_turnstile_is_contact_template_page() {
    if ( ! is_page() ) {
        return false;
    }

    return is_page_template(
        array(
            'template-contact.php',
            'template-pages/template-contact.php',
        )
    );
}

/**
 * Whether the current front-end request should load Turnstile assets.
 *
 * @return bool
 */
function julius_turnstile_should_enqueue() {
    if ( ! julius_turnstile_is_enabled() ) {
        return false;
    }

    return is_singular( 'service' )
        || julius_turnstile_is_contact_template_page()
        || is_post_type_archive( 'blog_post' );
}

/**
 * Output a Turnstile widget for a form.
 *
 * @param string $action Turnstile action name.
 */
function julius_turnstile_render_widget( $action ) {
    if ( ! julius_turnstile_is_enabled() ) {
        return;
    }

    printf(
        '<div class="julius-turnstile-wrap"><div class="cf-turnstile" data-sitekey="%s" data-action="%s"></div></div>',
        esc_attr( CLOUDFLARE_TURNSTILE_SITE_KEY ),
        esc_attr( $action )
    );
}

/**
 * Enqueue Turnstile scripts on pages with protected forms.
 */
function julius_turnstile_enqueue_scripts() {
    if ( ! julius_turnstile_should_enqueue() ) {
        return;
    }

    wp_enqueue_script(
        'cloudflare-turnstile',
        'https://challenges.cloudflare.com/turnstile/v0/api.js',
        array(),
        null,
        true
    );

    wp_enqueue_script(
        'julius-turnstile',
        JULIUS_THEME_URI . '/js/turnstile.js',
        array(),
        filemtime( JULIUS_THEME_DIR . '/js/turnstile.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'julius_turnstile_enqueue_scripts', 20 );

/**
 * Add async/defer to the Cloudflare Turnstile script tag.
 *
 * @param string $tag    Script tag.
 * @param string $handle Handle.
 * @param string $src    Source URL.
 * @return string
 */
function julius_turnstile_script_loader_tag( $tag, $handle, $src ) {
    if ( 'cloudflare-turnstile' === $handle ) {
        return str_replace( ' src', ' async defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'julius_turnstile_script_loader_tag', 10, 3 );

/**
 * Ensure newsletter script loads after Turnstile helper when applicable.
 */
function julius_turnstile_adjust_newsletter_dependencies() {
    if ( ! julius_turnstile_should_enqueue() ) {
        return;
    }

    global $wp_scripts;
    if ( isset( $wp_scripts->registered['julius-newsletter'] ) ) {
        $deps = $wp_scripts->registered['julius-newsletter']->deps;
        if ( ! in_array( 'julius-turnstile', $deps, true ) ) {
            $wp_scripts->registered['julius-newsletter']->deps[] = 'julius-turnstile';
        }
    }
}
add_action( 'wp_enqueue_scripts', 'julius_turnstile_adjust_newsletter_dependencies', 100 );