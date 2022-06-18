<?php

function wpadminkit_setup() {

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'sidebar' => 'Sidebar Menu',
			'navbar' => 'Navbar Menu',
			'footer' => 'Footer Menu',
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action('after_setup_theme', 'wpadminkit_setup');

function wpadminkit_scripts() {
	wp_enqueue_style('app-css', get_template_directory_uri() . '/assets/css/app.css');
	wp_enqueue_style('font-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

	wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.js');
}
add_action('wp_enqueue_scripts', 'wpadminkit_scripts');

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom menu for this theme
 */
require get_template_directory() . '/inc/wp-navmenu-walker.php';
require get_template_directory() . '/inc/wp-navmenu-custom.php';

/**
 * Implement TML Custom.
 */
if (class_exists('Theme_My_Login_Form')) {
	require get_template_directory() . '/inc/tml-custom.php';
}

/**
 * Implement Force Login Exception List.
 */
require get_template_directory() . '/inc/force-login.php';

/**
 * Hide Admin Bar when user not admin
 */
add_filter('show_admin_bar', function ($show) {
	if (!current_user_can('administrator')) {
		return false;
	}
	return $show;
});

/**
 * Disable access to wp-admin
 */
add_action('admin_init', function () {
	if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
		wp_safe_redirect(home_url());
		exit;
	}
});
