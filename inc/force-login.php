<?php

function v_forcelogin() {

	// Exceptions for AJAX, Cron, or WP-CLI requests
	if ((defined('DOING_AJAX') && DOING_AJAX) || (defined('DOING_CRON') && DOING_CRON) || (defined('WP_CLI') && WP_CLI)) {
		return;
	}

	// Bail if the current visitor is a logged in user, unless Multisite is enabled
	if (is_user_logged_in() && !is_multisite()) {
		return;
	}

	// Get visited URL
	$schema = isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? 'https://' : 'http://';
	$url = $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	// Bail if visiting the login URL. Fix for custom login URLs
	if (preg_replace('/\?.*/', '', wp_login_url()) === preg_replace('/\?.*/', '', $url)) {
		return;
	}

	/**
	 * Whitelist filter.
	 *
	 * @since 3.0.0
	 * @deprecated 5.5.0 Use {@see 'v_forcelogin_bypass'} instead.
	 *
	 * @param array An array of absolute URLs.
	 */
	$allowed = apply_filters_deprecated('v_forcelogin_whitelist', array(array()), '5.5.0', 'v_forcelogin_bypass');

	$allowed[] = home_url('/lostpassword/');
	if (get_option('users_can_register') == 1) {
		$allowed[] = home_url('/register/');
	}

	/**
	 * Bypass filter.
	 *
	 * @since 5.0.0
	 * @since 5.2.0 Added the `$url` parameter.
	 *
	 * @param bool Whether to disable Force Login. Default false.
	 * @param string $url The visited URL.
	 */
	$bypass = apply_filters('v_forcelogin_bypass', in_array($url, $allowed), $url);

	// Bail if bypass is enabled
	if ($bypass) {
		return;
	}

	// Only allow Multisite users access to their assigned sites
	if (is_multisite() && is_user_logged_in()) {
		if (!is_user_member_of_blog() && !current_user_can('setup_network')) {
			$message = apply_filters('v_forcelogin_multisite_message', __("You're not authorized to access this site.", 'wp-force-login'), $url);
			wp_die($message, get_option('blogname') . ' &rsaquo; ' . __('Error', 'wp-force-login'));
		}
		return;
	}

	// Determine redirect URL
	$redirect_url = apply_filters('v_forcelogin_redirect', $url);

	// Set the headers to prevent caching
	nocache_headers();

	// Redirect unauthorized visitors
	wp_safe_redirect(wp_login_url($redirect_url), 302);
	exit;
}
add_action('template_redirect', 'v_forcelogin');
