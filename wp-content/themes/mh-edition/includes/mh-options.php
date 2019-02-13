<?php

function mh_edition_customizer($wp_customize) {

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_edition_theme_options', array('title' => esc_html__('Theme Options', 'mh-edition'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_edition_general', array('title' => esc_html__('General', 'mh-edition'), 'priority' => 1, 'panel' => 'mh_edition_theme_options'));
	$wp_customize->add_section('mh_edition_layout', array('title' => esc_html__('Layout', 'mh-edition'), 'priority' => 2, 'panel' => 'mh_edition_theme_options'));
	$wp_customize->add_section('mh_edition_ticker', array('title' => esc_html__('News Ticker', 'mh-edition'), 'priority' => 4, 'panel' => 'mh_edition_theme_options'));
    $wp_customize->add_section('mh_edition_css', array('title' => esc_html__('Custom CSS', 'mh-edition'), 'priority' => 5, 'panel' => 'mh_edition_theme_options'));
    $wp_customize->add_section('mh_edition_tracking', array('title' => esc_html__('Tracking Code', 'mh-edition'), 'priority' => 6, 'panel' => 'mh_edition_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_edition_options[excerpt_length]', array('default' => 35, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_edition_options[excerpt_more]', array('default' => esc_html__('Read More', 'mh-edition'), 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_edition_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));

    $wp_customize->add_setting('mh_edition_options[header_search]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[social_buttons]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[author_contact]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
    $wp_customize->add_setting('mh_edition_options[back_to_top]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_edition_options[post_meta_date]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_edition_options[post_meta_author]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_edition_options[post_meta_cat]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_edition_options[post_meta_comments]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));

    $wp_customize->add_setting('mh_edition_options[ticker]', array('default' => 1, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));
    $wp_customize->add_setting('mh_edition_options[ticker_title]', array('default' => esc_html__('News Ticker', 'mh-edition'), 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_edition_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_edition_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_edition_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_edition_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_edition_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));

    $wp_customize->add_setting('mh_edition_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));
    $wp_customize->add_setting('mh_edition_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_textarea'));

    $wp_customize->add_setting('mh_edition_options[full_bg]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_checkbox'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-edition'), 'section' => 'mh_edition_general', 'settings' => 'mh_edition_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-edition'), 'section' => 'mh_edition_general', 'settings' => 'mh_edition_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-edition'), 'section' => 'mh_edition_general', 'settings' => 'mh_edition_options[copyright]', 'priority' => 3, 'type' => 'text'));

    $wp_customize->add_control('header_search', array('label' => esc_html__('Search Box in Header', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[header_search]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar Position', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[sidebar]', 'priority' => 2, 'type' => 'select', 'choices' => array('left' => esc_html__('Left', 'mh-edition'), 'right' => esc_html__('Right', 'mh-edition'), 'disable' => esc_html__('No sidebar', 'mh-edition'))));
	$wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[breadcrumbs]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[featured_image]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[post_nav]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('social_buttons', array('label' => esc_html__('Social Buttons on Posts', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[social_buttons]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Top and bottom', 'mh-edition'), 'top_social' => esc_html__('Top of posts', 'mh-edition'), 'bottom_social' => esc_html__('Bottom of posts', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[author_box]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('author_contact', array('label' => esc_html__('Author Box Contact', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[author_contact]', 'priority' => 8, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('related_content', array('label' => esc_html__('Related Content', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[related_content]', 'priority' => 9, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('back_to_top', array('label' => esc_html__('Back to Top Button', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[back_to_top]', 'priority' => 10, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
	$wp_customize->add_control('post_meta_date', array('label' => esc_html__('Post Meta: Date', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[post_meta_date]', 'priority' => 11, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Post Meta: Author', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[post_meta_author]', 'priority' => 12, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Post Meta: Categories', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[post_meta_cat]', 'priority' => 13, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));
    $wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Post Meta: Comment Count', 'mh-edition'), 'section' => 'mh_edition_layout', 'settings' => 'mh_edition_options[post_meta_comments]', 'priority' => 14, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-edition'), 'disable' => esc_html__('Disable', 'mh-edition'))));

	$wp_customize->add_control('ticker', array('label' => esc_html__('Enable Ticker', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker]', 'priority' => 1, 'type' => 'checkbox'));
    $wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_title]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_posts]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('ticker_cats', array('label'=> esc_html__('Custom Categories (use ID - e.g. 3,5,9):', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_cats]', 'priority' => 4, 'type' => 'text'));
    $wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_tags]', 'priority' => 5, 'type' => 'text'));
    $wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_offset]', 'priority' => 6, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'mh-edition'), 'section' => 'mh_edition_ticker', 'settings' => 'mh_edition_options[ticker_sticky]', 'priority' => 7, 'type' => 'checkbox'));

	$wp_customize->add_control('custom_css', array('label' => esc_html__('Custom CSS', 'mh-edition'), 'section' => 'mh_edition_css', 'settings' => 'mh_edition_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mh-edition'), 'section' => 'mh_edition_tracking', 'settings' => 'mh_edition_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));

	$wp_customize->add_control('full_bg', array('label' => esc_html__('Scale Background Image to Full Size', 'mh-edition'), 'section' => 'background_image', 'settings' => 'mh_edition_options[full_bg]', 'priority' => 99, 'type' => 'checkbox'));
}
add_action('customize_register', 'mh_edition_customizer');

/***** Data Sanitization *****/

function mh_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-edition'),
        'disable' => esc_html__('Disable', 'mh-edition'),
        'left' => esc_html__('Left', 'mh-edition'),
        'right' => esc_html__('Right', 'mh-edition'),
        'top_social' => esc_html__('Top of Posts', 'mh-edition'),
        'bottom_social' => esc_html__('Bottom of Posts', 'mh-edition')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_edition_theme_options')) {
	function mh_edition_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_edition_options', array()),
			mh_edition_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_edition_default_options')) {
	function mh_edition_default_options() {
		$default_options = array(
			'excerpt_length' => 35,
			'excerpt_more' => esc_html__('Read More', 'mh-edition'),
			'copyright' => '',
			'header_search' => 'enable',
			'sidebar' => 'right',
			'breadcrumbs' => 'enable',
			'featured_image' => 'enable',
			'post_nav' => 'enable',
			'social_buttons' => 'enable',
			'author_box' => 'enable',
			'author_contact' => 'enable',
			'related_content' => 'enable',
			'back_to_top' => 'enable',
			'post_meta_date' => 'enable',
			'post_meta_author' => 'enable',
			'post_meta_cat' => 'enable',
			'post_meta_comments' => 'enable',
			'ticker' => 1,
			'ticker_title' => esc_html__('News Ticker', 'mh-edition'),
			'ticker_posts' => 5,
			'ticker_cats' => '',
			'ticker_tags' => '',
			'ticker_offset' => '',
			'ticker_sticky' => 0,
			'custom_css' => '',
			'tracking_code' => '',
			'full_bg' => ''
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_edition_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_edition_customizer_css');

/***** Custom CSS Output *****/

function mh_edition_custom_css() {
	$mh_edition_options = mh_edition_theme_options();
	if ($mh_edition_options['custom_css']) {
    	echo '<style type="text/css">';
    		echo $mh_edition_options['custom_css'];
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_edition_custom_css');

?>