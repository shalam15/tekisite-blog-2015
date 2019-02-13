<?php

/***** Fetch Options *****/

$mh_cicero_options = get_option('mh_cicero_options');

/***** Custom Hooks *****/

function mh_cicero_after_header() {
    do_action('mh_cicero_after_header');
}
function mh_cicero_before_page_content() {
    do_action('mh_cicero_before_page_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_cicero_themes_setup')) {
	function mh_cicero_themes_setup() {
		load_theme_textdomain('mh-cicero', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
		add_post_type_support('page', 'excerpt');
		add_theme_support('title-tag');
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => 'fff', 'width' => 200, 'height' => 30, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-background', array('default-color' => 'f6f5f2'));
		add_theme_support('post-thumbnails');
		add_theme_support('featured-content', array('featured_content_filter' => 'mh_cicero_get_featured_content', 'max_posts' => 20));
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_cicero_themes_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_cicero_custom_menus')) {
	function mh_cicero_custom_menus() {
		register_nav_menus(array(
			'main_nav' => esc_html__('Main Navigation', 'mh-cicero'),
			'social_nav' => esc_html__('Social Icons in Footer', 'mh-cicero'),
		));
	}
}
add_action('after_setup_theme', 'mh_cicero_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_cicero_image_sizes')) {
	function mh_cicero_image_sizes() {
		add_image_size('large-thumb', 610, 343, true);
		add_image_size('small-thumb', 70, 70, true);
	}
}
add_action('after_setup_theme', 'mh_cicero_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_cicero_content_width')) {
	function mh_cicero_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('page-full.php')) {
				$content_width = 790;
			} else {
				$content_width = 610;
			}
		}
	}
}
add_action('template_redirect', 'mh_cicero_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_cicero_scripts')) {
	function mh_cicero_scripts() {
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '1.2.1');
		wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_cicero_scripts');

if (!function_exists('mh_cicero_admin_scripts')) {
	function mh_cicero_admin_scripts($hook) {
		if ('index.php' == $hook || 'widgets.php' == $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_cicero_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_cicero_widgets_init')) {
	function mh_cicero_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar', 'mh-cicero'), 'id' => 'sidebar', 'description' => esc_html__('Sidebar on Posts/Pages.', 'mh-cicero'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s"><div class="widget-content">', 'after_widget' => '</div></div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Contact', 'mh-cicero'), 'id' => 'contact', 'description' => esc_html__('Sidebar on Contact Page Template.', 'mh-cicero'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s"><div class="widget-content">', 'after_widget' => '</div></div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_cicero_widgets_init');

/***** Featured Content Filter *****/

if (!function_exists('mh_cicero_get_featured_content')) {
	function mh_cicero_get_featured_content() {
		return apply_filters('mh_cicero_get_featured_content', false);
	}
}

/***** Include Several Functions *****/

require_once('includes/mh-options.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-helper-functions.php');

if (!class_exists('Featured_Content') && 'plugins.php' !== $GLOBALS['pagenow']) {
	require_once('includes/mh-featured-content.php');
}

if (class_exists('Jetpack')) {
	require_once('includes/mh-jetpack.php');
}

if (is_admin()) {
	require_once('admin/admin.php');
}

?>