<?php
/**
 * Cloudflare Turnstile module bootstrap.
 *
 * @package Julius_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once JULIUS_THEME_DIR . '/turnstile/turnstile-verify.php';
require_once JULIUS_THEME_DIR . '/turnstile/turnstile-frontend.php';