<?php

/***** Fetch Options *****/

$options = get_option('mhc_options');

/***** Custom Hooks *****/

function mh_html_class() {
    do_action('mh_html_class');
}
function mh_before_header() {
    do_action('mh_before_header');
}
function mh_after_header() {
    do_action('mh_after_header');
}
function mh_content_class() {
    do_action('mh_content_class');
}
function mh_before_page_content() {
    do_action('mh_before_page_content');
}
function mh_before_post_content() {
    do_action('mh_before_post_content');
}
function mh_post_header() {
    do_action('mh_post_header');
}
function mh_post_content_top() {
    do_action('mh_post_content_top');
}
function mh_post_content_bottom() {
    do_action('mh_post_content_bottom');
}
function mh_loop_content() {
    do_action('mh_loop_content');
}
function mh_after_post_content() {
    do_action('mh_after_post_content');
}
function mh_sb_class() {
    do_action('mh_sb_class');
}

/***** Theme Setup *****/

if (!function_exists('mh_corporate_theme_setup')) {
	function mh_corporate_theme_setup() {
		load_theme_textdomain('mhc', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-background', array('default-color' => 'f7f7f7'));
		add_theme_support('post-thumbnails');
		add_theme_support('custom-header', array('default-image' => get_template_directory_uri() . '/images/logo.png', 'default-text-color' => '000', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('customize-selective-refresh-widgets');
		register_nav_menu('main_nav', esc_html__('Main Navigation', 'mhc'));
	}
}
add_action('after_setup_theme', 'mh_corporate_theme_setup');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_corporate_image_sizes')) {
	function mh_corporate_image_sizes() {
		add_image_size('slider', 940, 400, true);
		add_image_size('content', 578, 246, true);
		add_image_size('spotlight', 578, 325, true);
		add_image_size('carousel', 174, 98, true);
		add_image_size('cp_large', 258, 194, true);
		add_image_size('cp_small', 70, 53, true);
	}
}
add_action('after_setup_theme', 'mh_corporate_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_corporate_content_width')) {
	function mh_corporate_content_width() {
		global $content_width;
		$options = mh_theme_options();
		if (!isset($content_width)) {
			if ($options['sidebar'] == 'disable' || is_page_template('page-full.php')) {
				$content_width = 898;
			} else {
				$content_width = 578;
			}
		}
	}
}
add_action('template_redirect', 'mh_corporate_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_corporate_scripts')) {
	function mh_corporate_scripts() {
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '2.2.1');
		wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_corporate_scripts');

if (!function_exists('mh_corporate_admin_scripts')) {
	function mh_corporate_admin_scripts($hook) {
		if ('appearance_page_corporate' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_corporate_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_corporate_widgets_init')) {
	function mh_corporate_widgets_init() {
		register_sidebar(array('name' => esc_html__('Header', 'mhc'), 'id' => 'header', 'description' => esc_html__('Widget area on top of the site', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Sidebar', 'mhc'), 'id' => 'sidebar', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 1), 'id' => 'home-1', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-1 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 2), 'id' => 'home-2', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-2 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 3), 'id' => 'home-3', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 4), 'id' => 'home-4', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-4 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 5), 'id' => 'home-5', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-5 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 6), 'id' => 'home-6', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-6 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 7), 'id' => 'home-7', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-7 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhc'), 8), 'id' => 'home-8', 'description' => esc_html__('Widget area on homepage', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget home-8 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d', 'widget area name', 'mhc'), 1), 'id' => 'posts-1', 'description' => esc_html__('Widget area above single post content', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget posts-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d', 'widget area name', 'mhc'), 2), 'id' => 'posts-2', 'description' => esc_html__('Widget area below single post content', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget posts-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d', 'widget area name', 'mhc'), 1), 'id' => 'pages-1', 'description' => esc_html__('Widget area above single page content', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget pages-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d', 'widget area name', 'mhc'), 2), 'id' => 'pages-2', 'description' => esc_html__('Widget area below single page content', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget pages-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mhc'), 1), 'id' => 'footer-1', 'description' => esc_html__('Widget area in footer', 'mhc'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mhc'), 2), 'id' => 'footer-2', 'description' => esc_html__('Widget area in footer', 'mhc'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mhc'), 3), 'id' => 'footer-3', 'description' => esc_html__('Widget area in footer', 'mhc'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mhc'), 4), 'id' => 'footer-4', 'description' => esc_html__('Widget area in footer', 'mhc'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-4 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => esc_html__('Contact', 'mhc'), 'id' => 'contact', 'description' => esc_html__('Widget area (sidebar) on contact page template', 'mhc'), 'before_widget' => '<div id="%1$s" class="sb-widget contact %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_corporate_widgets_init');

/***** Include Several Functions *****/

if (is_admin()) {
	require_once('admin/admin.php');
}
require_once('includes/mh-breadcrumb.php');
require_once('includes/mh-options.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-social.php');
require_once('includes/mh-advertising.php');
require_once('includes/mh-shortcodes.php');
require_once('includes/mh-helper-functions.php');

?>