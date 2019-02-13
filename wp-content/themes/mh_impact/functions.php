<?php

/***** Fetch Options *****/

$mh_impact_options = get_option('mh_impact_options');

/***** Custom Hooks *****/

function mh_impact_before_page_content() {
    do_action('mh_impact_before_page_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_impact_themes_setup')) {
	function mh_impact_themes_setup() {
		load_theme_textdomain('mh-impact', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
		add_post_type_support('page', 'excerpt');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array('search-form'));
		add_theme_support('custom-background', array('default-color' => '55b2a2'));
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '4d4d4d', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_impact_themes_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_impact_custom_menus')) {
	function mh_impact_custom_menus() {
		register_nav_menus(array(
			'social_nav' => esc_html__('Social Icons in Header', 'mh-impact'),
			'main_nav' => esc_html__('Main Navigation', 'mh-impact')
		));
	}
}
add_action('after_setup_theme', 'mh_impact_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_impact_image_sizes')) {
	function mh_impact_image_sizes() {
		add_image_size('slider', 1120, 476, true);
		add_image_size('blog', 684, 291, true);
		add_image_size('blog-widget', 465, 198, true);
		add_image_size('pages-widget', 220, 220, true);
	}
}
add_action('after_setup_theme', 'mh_impact_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_impact_content_width')) {
	function mh_impact_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('template-full.php')) {
				$content_width = 1040;
			} else {
				$content_width = 684;
			}
		}
	}
}
add_action('template_redirect', 'mh_impact_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_impact_scripts')) {
	function mh_impact_scripts() {
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '1.2.1');
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_impact_scripts');

if (!function_exists('mh_impact_admin_scripts')) {
	function mh_impact_admin_scripts($hook) {
		if ('appearance_page_impact' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_impact_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_impact_widgets_init')) {
	function mh_impact_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar', 'mh-impact'), 'id' => 'sidebar-widgets', 'description' => esc_html__('General Sidebar on posts, pages and archives.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mh-impact'), 1), 'id' => 'home-1', 'description' => esc_html__('Widgets on home page above content area.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="home-widget home-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title-home">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mh-impact'), 2), 'id' => 'home-2', 'description' => esc_html__('Widgets on home page below content area.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="home-widget home-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title-home">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-impact'), 1), 'id' => 'footer-1', 'description' => esc_html__('Widgets in the first footer column.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-1 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-impact'), 2), 'id' => 'footer-2', 'description' => esc_html__('Widgets in the second footer column.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-2 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-impact'), 3), 'id' => 'footer-3', 'description' => esc_html__('Widgets in the third footer column.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="footer-widget footer-3 %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => esc_html__('Contact', 'mh-impact'), 'id' => 'contact', 'description' => esc_html__('Sidebar on contact page template.', 'mh-impact'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_impact_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-options.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

?>