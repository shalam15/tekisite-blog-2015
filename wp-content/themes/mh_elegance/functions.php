<?php

/***** Fetch Options *****/

$mh_elegance_options = get_option('mh_elegance_options');

/***** Custom Hooks *****/

function mh_elegance_after_header() {
    do_action('mh_elegance_after_header');
}
function mh_elegance_before_page_content() {
    do_action('mh_elegance_before_page_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_elegance_theme_setup')) {
	function mh_elegance_theme_setup() {
		load_theme_textdomain('mh-elegance', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('widget_text', 'do_shortcode');
		add_post_type_support('page', 'excerpt');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-header', array('default-image' => get_template_directory_uri() . '/images/logo.png', 'default-text-color' => 'fff', 'width' => 120, 'height' => 120, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('custom-background', array('default-color' => '252336'));
		add_theme_support('customize-selective-refresh-widgets');
	}
}
add_action('after_setup_theme', 'mh_elegance_theme_setup');

/***** Add Custom Menus *****/

if (!function_exists('mh_elegance_custom_menus')) {
	function mh_elegance_custom_menus() {
		register_nav_menus(array(
			'main_nav' => esc_html__('Main Navigation', 'mh-elegance'),
			'footer_nav' => esc_html__('Footer Navigation', 'mh-elegance'),
			'social_nav' => esc_html__('Social Icons in Footer', 'mh-elegance'),
		));
	}
}
add_action('after_setup_theme', 'mh_elegance_custom_menus');

/***** Add Custom Image Sizes *****/

if (!function_exists('mh_elegance_image_sizes')) {
	function mh_elegance_image_sizes() {
		add_image_size('blog', 440, 280, true);
		add_image_size('blog-single', 690, 440, true);
	}
}
add_action('after_setup_theme', 'mh_elegance_image_sizes');

/***** Set Content Width *****/

if (!function_exists('mh_elegance_content_width')) {
	function mh_elegance_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('page-full.php')) {
				$content_width = 980;
			} else {
				$content_width = 690;
			}
		}
	}
}
add_action('template_redirect', 'mh_elegance_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_elegance_scripts')) {
	function mh_elegance_scripts() {
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, '1.3.1');
		wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'));
		if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_elegance_scripts');

if (!function_exists('mh_elegance_admin_scripts')) {
	function mh_elegance_admin_scripts($hook) {
		if ('appearance_page_elegance' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_elegance_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_elegance_widgets_init')) {
	function mh_elegance_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar', 'mh-elegance'), 'id' => 'sidebar', 'description' => esc_html__('Sidebar on Posts/Pages.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mh-elegance'), 1), 'id' => 'home-1', 'description' => esc_html__('Widget Area on Front Page above Content.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Home %d', 'widget area name', 'mh-elegance'), 2), 'id' => 'home-2', 'description' => esc_html__('Widget Area on Front Page below Content.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-elegance'), 1), 'id' => 'footer-1', 'description' => esc_html__('First column widget area in the footer.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s"><div class="footer-widget-inner">', 'after_widget' => '</div></div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-elegance'), 2), 'id' => 'footer-2', 'description' => esc_html__('Second column widget area in the footer.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s"><div class="footer-widget-inner">', 'after_widget' => '</div></div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => sprintf(esc_html_x('Footer %d', 'widget area name', 'mh-elegance'), 3), 'id' => 'footer-3', 'description' => esc_html__('Third column widget area in the footer.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="footer-widget %2$s"><div class="footer-widget-inner">', 'after_widget' => '</div></div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
		register_sidebar(array('name' => esc_html__('Contact', 'mh-elegance'), 'id' => 'contact', 'description' => esc_html__('Sidebar on Contact Page Template.', 'mh-elegance'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<div class="separator"><h4 class="widget-title section-title">', 'after_title' => '</h4></div>'));
	}
}
add_action('widgets_init', 'mh_elegance_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-options.php');
require_once('includes/mh-custom-colors.php');
require_once('includes/mh-google-webfonts.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-custom-header.php');
require_once('includes/mh-widgets.php');
require_once('includes/mh-helper-functions.php');

if (is_admin()) {
	require_once('admin/admin.php');
}

?>