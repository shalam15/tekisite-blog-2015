<?php

function mh_purity_customize_register($wp_customize) {

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General Options', 'mhp'), 'priority' => 1));
	$wp_customize->add_section('mh_typo', array('title' => esc_html__('Typography Options', 'mhp'), 'priority' => 2));
	$wp_customize->add_section('mh_content', array('title' => esc_html__('Posts/Pages Options', 'mhp'), 'priority' => 3));
	$wp_customize->add_section('mh_css', array('title' => esc_html__('Custom CSS', 'mhp'), 'priority' => 4));
    $wp_customize->add_section('mh_tracking', array('title' => esc_html__('Tracking Code', 'mhp'), 'priority' => 5));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_options[excerpt_length]', array('default' => 110, 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_integer'));
    $wp_customize->add_setting('mh_options[excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_text'));
    $wp_customize->add_setting('mh_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_text'));

	$wp_customize->add_setting('mh_options[breadcrumbs]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[featured_image]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[post_meta]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[post_nav]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_checkbox'));
    $wp_customize->add_setting('mh_options[sb_position]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_select'));

	$wp_customize->add_setting('mh_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_textarea'));
    $wp_customize->add_setting('mh_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_textarea'));

    $wp_customize->add_setting('mh_options[color_bg_inner]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_options[color_1]', array('default' => '#ff0000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_options[color_text_body]', array('default' => '#666666', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_options[color_text_headings]', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_options[color_links', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_options[color_links_hover', array('default' => '#ff0000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    $wp_customize->add_setting('mh_options[full_bg]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_purity_sanitize_checkbox'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Excerpt Length in Characters', 'mhp'), 'section' => 'mh_general', 'settings' => 'mh_options[excerpt_length]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More Text', 'mhp'), 'section' => 'mh_general', 'settings' => 'mh_options[excerpt_more]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mhp'), 'section' => 'mh_general', 'settings' => 'mh_options[copyright]', 'priority' => 4, 'type' => 'text'));

	$wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Enable Breadcrumbs', 'mhp'), 'section' => 'mh_content', 'settings' => 'mh_options[breadcrumbs]', 'priority' => 1, 'type' => 'checkbox'));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Disable Featured Image on Posts', 'mhp'), 'section' => 'mh_content', 'settings' => 'mh_options[featured_image]', 'priority' => 2, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta', array('label' => esc_html__('Hide Post Meta Data', 'mhp'), 'section' => 'mh_content', 'settings' => 'mh_options[post_meta]', 'priority' => 3, 'type' => 'checkbox'));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Enable Post Navigation', 'mhp'), 'section' => 'mh_content', 'settings' => 'mh_options[post_nav]', 'priority' => 5, 'type' => 'checkbox'));
    $wp_customize->add_control('sb_position', array('label' => esc_html__('Position of default Sidebar', 'mhp'), 'section' => 'mh_content', 'settings' => 'mh_options[sb_position]', 'priority' => 6, 'type' => 'select', 'choices' => array('left' => __('Left', 'mhp'), 'right' => __('Right', 'mhp'))));

	$wp_customize->add_control('custom_css', array('label' => esc_html__('Custom CSS', 'mhp'), 'section' => 'mh_css', 'settings' => 'mh_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mhp'), 'section' => 'mh_tracking', 'settings' => 'mh_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_bg_inner', array('label' => esc_html__('Background Color (Content Area)', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_bg_inner]', 'priority' => 51)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => esc_html__('Theme: Main Color', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_1]', 'priority' => 52)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_body', array('label' => esc_html__('Text: Body', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_text_body]', 'priority' => 53)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_headings', array('label' => esc_html__('Text: Headings', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_text_headings]', 'priority' => 54)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links', array('label' => esc_html__('Links: General (Posts/Pages)', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_links]', 'priority' => 55)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links_hover', array('label' => esc_html__('Links: Hover Color', 'mhp'), 'section' => 'colors', 'settings' => 'mh_options[color_links_hover]', 'priority' => 56)));

    $wp_customize->add_control('full_bg', array('label' => esc_html__('Scale Background Image to Full Size', 'mhp'), 'section' => 'background_image', 'settings' => 'mh_options[full_bg]', 'priority' => 99, 'type' => 'checkbox'));

}
add_action('customize_register', 'mh_purity_customize_register');

/***** Data Sanitization *****/

function mh_purity_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_purity_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_purity_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_purity_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_purity_sanitize_select($input) {
    $valid = array(
        'left' => __('Left', 'mhp'),
        'right' => __('Right', 'mhp'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_purity_theme_options')) {
	function mh_purity_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_options', array()),
			mh_purity_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_purity_default_options')) {
	function mh_purity_default_options() {
		$default_options = array(
			'excerpt_length' => 110,
			'excerpt_more' => '[...]',
			'copyright' => '',
			'breadcrumbs' => '',
			'featured_image' => '',
			'post_meta' => '',
			'post_nav' => '',
			'sb_position' => 'right',
			'custom_css' => '',
			'tracking_code' => '',
			'color_bg_inner' => '#ffffff',
			'color_1' => '#ff0000',
			'color_text_body' => '#666666',
			'color_text_headings' => '#000000',
			'color_links' => '#000000',
			'color_links_hover' => '#ff0000',
			'full_bg' => '',
		);
		return $default_options;
	}
}

/***** CSS Output *****/

function mh_purity_custom_css() {
	$mh_purity_options = mh_purity_theme_options();
	if ($mh_purity_options['color_bg_inner'] != '#ffffff' || $mh_purity_options['color_1'] != '#ff0000' || $mh_purity_options['color_text_body'] != '#666666' || $mh_purity_options['color_text_headings'] != '#000000' || $mh_purity_options['color_links'] != '#000000' || $mh_purity_options['color_links_hover'] != '#ff0000' || $mh_purity_options['custom_css']) : ?>
    <style type="text/css">
    	<?php if ($mh_purity_options['color_bg_inner'] != '#ffffff') { ?>
    		.container { background: <?php echo $mh_purity_options['color_bg_inner']; ?>; }
    		.main-nav ul li a, .main-nav ul .current-menu-item:hover > a { border-color: <?php echo $mh_purity_options['color_bg_inner']; ?>; }
    	<?php } ?>
    	<?php if ($mh_purity_options['color_1'] != '#ff0000') { ?>
    		.header-wrap, .main-nav ul .current-menu-item > a, footer, .author-box, blockquote, .commentlist .bypostauthor, input[type=text]:hover, input[type=email]:hover, textarea:hover { border-color: <?php echo $mh_purity_options['color_1']; ?>; }
			.widget-title, .widget-title a, .mh-slider-widget .flex-direction-nav a:before, .fa-comment-o, .fa-circle, .breadcrumb .separator { color: <?php echo $mh_purity_options['color_1']; ?> }
    	<?php } ?>
    	<?php if ($mh_purity_options['color_text_body'] != '#666666') { ?>
    		body, footer, .wp-caption-text, .copyright, .copyright a { color: <?php echo $mh_purity_options['color_text_body']; ?>; }
    	<?php } ?>
    	<?php if ($mh_purity_options['color_text_headings'] != '#000000') { ?>
    		h1, h2, h3, h4, h5, h6, .footer-widget-title, .featured-item-title a, .cp-large-title a, .cp-small-title a { color: <?php echo $mh_purity_options['color_text_headings']; ?>; }
    	<?php } ?>
		<?php if ($mh_purity_options['color_links'] != '#000000') { ?>
    		.entry a { color: <?php echo $mh_purity_options['color_links']; ?>; }
    	<?php } ?>
    	<?php if ($mh_purity_options['color_links_hover'] != '#ff0000') { ?>
    		a:hover, .post-nav a:hover, .breadcrumb a:hover, .post-meta a:hover, .post-tags a:hover { color: <?php echo $mh_purity_options['color_links_hover']; ?>; }
    	<?php } ?>
		<?php if ($mh_purity_options['custom_css']) {	echo $mh_purity_options['custom_css']; } ?>
	</style>
    <?php
	endif;
}
add_action('wp_head', 'mh_purity_custom_css');

?>