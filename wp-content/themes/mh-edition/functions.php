<?php

/***** Fetch Options *****/

$mh_edition_options = get_option('mh_edition_options');

/***** Custom Hooks *****/

function mh_html_class() {
    do_action('mh_html_class');
}
function mh_before_page_content() {
    do_action('mh_before_page_content');
}
function mh_after_page_content() {
    do_action('mh_after_page_content');
}
function mh_before_post_content() {
    do_action('mh_before_post_content');
}
function mh_after_post_content() {
    do_action('mh_after_post_content');
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

/***** Enable Shortcodes inside Widgets	*****/

add_filter('widget_text', 'do_shortcode');

/***** Theme Setup *****/

if (!function_exists('mh_edition_theme_setup')) {
	function mh_edition_theme_setup() {
		load_theme_textdomain('mh-edition', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
		add_theme_support('post-thumbnails');
		add_theme_support('custom-background', array('default-color' => 'f7f7f7'));
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '2a2a2a', 'width' => 300, 'height' => 90, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_edition_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_edition_custom_menus')) {
	function mh_edition_custom_menus() {
		register_nav_menus(array(
			'mh_header_nav' => esc_html__('Header Navigation', 'mh-edition'),
			'mh_social_nav' => esc_html__('Social Icons in Header', 'mh-edition'),
			'mh_main_nav' => esc_html__('Main Navigation', 'mh-edition'),
			'mh_extra_nav' => esc_html__('Additional Navigation (below Main Navigation)', 'mh-edition'),
			'mh_footer_nav' => esc_html__('Footer Navigation', 'mh-edition'),
			'mh_social_widget' => esc_html__('MH Social Widget', 'mh-edition')
		));
	}
}
add_action('after_setup_theme', 'mh_edition_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_edition_image_sizes')) {
	function mh_edition_image_sizes() {
		add_image_size('mh-edition-slider', 1120, 476, true);
		add_image_size('mh-edition-content', 737, 415, true);
		add_image_size('mh-edition-medium', 355, 200, true);
		add_image_size('mh-edition-small', 97, 73, true);
	}
}
add_action('after_setup_theme', 'mh_edition_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_edition_content_width')) {
	function mh_edition_content_width() {
		global $content_width;
		$mh_edition_options = mh_edition_theme_options();
		if (!isset($content_width)) {
			if ($mh_edition_options['sidebar'] == 'disable' || is_page_template('template-full.php')) {
				$content_width = 1120;
			} else {
				$content_width = 737;
			}
		}
	}
}
add_action('template_redirect', 'mh_edition_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_edition_scripts')) {
	function mh_edition_scripts() {
		wp_enqueue_style('mh-edition', get_stylesheet_uri(), false, '1.1.1');
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_edition_scripts');

if (!function_exists('mh_edition_admin_scripts')) {
	function mh_edition_admin_scripts($hook) {
		if ('appearance_page_edition' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_edition_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_edition_widgets_init')) {
	function mh_edition_widgets_init() {
		register_sidebar(array('name' => esc_html_x('Sidebar', 'widget area name', 'mh-edition'), 'id' => 'mh-sidebar', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Header %d - Advertisement', 'widget area name', 'mh-edition'), 1), 'id' => 'mh-header-1', 'description' => esc_html__('Advertisement position located above the header, suitable for a single text widget.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-header-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Header %d - Advertisement', 'widget area name', 'mh-edition'), 2), 'id' => 'mh-header-2', 'description' => esc_html__('Widget area on top of the site.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-header-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-edition'), 1), 'id' => 'mh-home-1', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-1 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 2/3 Width', 'widget area name', 'mh-edition'), 2), 'id' => 'mh-home-2', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-2 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 3), 'id' => 'mh-home-3', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 4), 'id' => 'mh-home-4', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-4 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 2/3 Width', 'widget area name', 'mh-edition'), 5), 'id' => 'mh-home-5', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-5 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 6), 'id' => 'mh-home-6', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-6 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-edition'), 7), 'id' => 'mh-home-7', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-7 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 8), 'id' => 'mh-home-8', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-8 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 9), 'id' => 'mh-home-9', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-9 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - 1/3 Width', 'widget area name', 'mh-edition'), 10), 'id' => 'mh-home-10', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-10 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d - Full Width', 'widget area name', 'mh-edition'), 11), 'id' => 'mh-home-11', 'description' => esc_html__('Widget area on homepage.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-home-11 mh-home-wide %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d - Advertisement', 'widget area name', 'mh-edition'), 1), 'id' => 'mh-posts-1', 'description' => esc_html__('Widget area above single post content.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-posts-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Posts %d - Advertisement', 'widget area name', 'mh-edition'), 2), 'id' => 'mh-posts-2', 'description' => esc_html__('Widget area below single post content.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-posts-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d - Advertisement', 'widget area name', 'mh-edition'), 1), 'id' => 'mh-pages-1', 'description' => esc_html__('Widget area above single page content.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-pages-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Pages %d - Advertisement', 'widget area name', 'mh-edition'), 2), 'id' => 'mh-pages-2', 'description' => esc_html__('Widget area below single page content.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-pages-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/3 Width', 'widget area name', 'mh-edition'), 1), 'id' => 'mh-footer-1', 'description' => esc_html__('Widget area in footer.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/3 Width', 'widget area name', 'mh-edition'), 2), 'id' => 'mh-footer-2', 'description' => esc_html__('Widget area in footer.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d - 1/3 Width', 'widget area name', 'mh-edition'), 3), 'id' => 'mh-footer-3', 'description' => esc_html__('Widget area in footer.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-footer-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6 class="mh-footer-widget-title">', 'after_title' => '</h6>'));
		register_sidebar(array('name' => esc_html_x('Contact Sidebar', 'widget area name', 'mh-edition'), 'id' => 'mh-contact', 'description' => esc_html__('Widget area (sidebar) on contact page template.', 'mh-edition'), 'before_widget' => '<div id="%1$s" class="mh-widget mh-contact %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_edition_widgets_init');

/***** Include Several Functions *****/

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

require_once('includes/mh-breadcrumb.php');
require_once('includes/mh-options.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-custom-colors.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-social-functions.php');
require_once('includes/mh-helper-functions.php');

if (class_exists('Jetpack')) {
	require_once('includes/mh-jetpack.php');
}

?>