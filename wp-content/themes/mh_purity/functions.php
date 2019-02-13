<?php

/***** Fetch Options *****/

$mh_purity_options = get_option('mh_options');

/***** Custom Hooks *****/

function mh_html_class() {
    do_action('mh_html_class');
}
function mh_content_class() {
    do_action('mh_content_class');
}
function mh_sb_class() {
    do_action('mh_sb_class');
}
function mh_post_header() {
    do_action('mh_post_header');
}
function mh_before_page_content() {
    do_action('mh_before_page_content');
}
function mh_before_post_content() {
    do_action('mh_before_post_content');
}
function mh_after_post_content() {
    do_action('mh_after_post_content');
}

/***** Enable Shortcodes inside Widgets	*****/

add_filter('widget_text', 'do_shortcode');

/***** Theme Setup *****/

if (!function_exists('mh_purity_themes_setup')) {
	function mh_purity_themes_setup() {
		load_theme_textdomain('mhp', get_template_directory() . '/languages');
		add_theme_support('custom-header', array('default-image' => get_template_directory_uri() . '/images/logo.png', 'default-text-color' => 'b3b3b3', 'width' => 300, 'height' => 80, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-background', array('default-color' => 'ffffff'));
		add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
		register_nav_menus(array('main_nav' => esc_html__('Main Navigation', 'mhp')));
	}
}
add_action('after_setup_theme', 'mh_purity_themes_setup');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_purity_image_sizes')) {
	function mh_purity_image_sizes() {
		add_image_size('slider', 990, 422, true);
		add_image_size('content', 650, 276, true);
		add_image_size('featured', 310, 174, true);
		add_image_size('cp_small', 80, 60, true);
	}
}
add_action('after_setup_theme', 'mh_purity_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_purity_set_content_width')) {
	function mh_purity_set_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('page-full.php')) {
				$content_width = 990;
			} else {
				$content_width = 650;
			}
		}
	}
}
add_action('template_redirect', 'mh_purity_set_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_purity_scripts')) {
	function mh_purity_scripts() {
		wp_enqueue_style('mh-google-fonts', "//fonts.googleapis.com/css?family=Lato:300italic,300,400italic,400,900|Vollkorn:400,400italic", array(), null);
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), array(), 'v1.4.1');
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_purity_scripts');

if (!function_exists('mh_purity_admin_scripts')) {
	function mh_purity_admin_scripts($hook) {
		if ('appearance_page_purity' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_purity_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_purity_widgets_init')) {
	function mh_purity_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar', 'mhp'), 'id' => 'sidebar', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhp'), 1), 'id' => 'home-1', 'description' => esc_html__('Widget area on homepage', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget home-1 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhp'), 2), 'id' => 'home-2', 'description' => esc_html__('Widget area on homepage', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget home-2 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhp'), 3), 'id' => 'home-3', 'description' => esc_html__('Widget area on homepage', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget home-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mhp'), 4), 'id' => 'home-4', 'description' => esc_html__('Widget area on homepage', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget home-4 home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Posts 1', 'mhp'), 'id' => 'posts-1', 'description' => esc_html__('Widget area above single post content', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget posts-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Posts 2', 'mhp'), 'id' => 'posts-2', 'description' => esc_html__('Widget area below single post content', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget posts-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Pages 1', 'mhp'), 'id' => 'pages-1', 'description' => esc_html__('Widget area above single page content', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget pages-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Pages 2', 'mhp'), 'id' => 'pages-2', 'description' => esc_html__('Widget area below single page content', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget pages-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Footer 1', 'mhp'), 'id' => 'footer-1', 'description' => esc_html__('Widget area in footer', 'mhp'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => esc_html__('Footer 2', 'mhp'), 'id' => 'footer-2', 'description' => esc_html__('Widget area in footer', 'mhp'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => esc_html__('Footer 3', 'mhp'), 'id' => 'footer-3', 'description' => esc_html__('Widget area in footer', 'mhp'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => esc_html__('Contact', 'mhp'), 'id' => 'contact', 'description' => esc_html__('Widget area (sidebar) on contact page template', 'mhp'), 'before_widget' => '<div id="%1$s" class="sb-widget contact %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_purity_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-breadcrumb.php');
require_once('includes/mh-functions.php');
require_once('includes/mh-options.php');
require_once('includes/mh-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

?>