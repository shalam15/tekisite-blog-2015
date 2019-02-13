<?php

function mh_cicero_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'mh-cicero'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General', 'mh-cicero'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => esc_html__('Layout', 'mh-cicero'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_css', array('title' => esc_html__('Custom CSS', 'mh-cicero'), 'priority' => 4, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_tracking', array('title' => esc_html__('Tracking Code', 'mh-cicero'), 'priority' => 5, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_cicero_options[excerpt_length]', array('default' => 50, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_integer'));
    $wp_customize->add_setting('mh_cicero_options[excerpt_more]', array('default' => esc_html__('Read More', 'mh-cicero'), 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_text'));
	$wp_customize->add_setting('mh_cicero_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_text'));

    $wp_customize->add_setting('mh_cicero_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
    $wp_customize->add_setting('mh_cicero_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
    $wp_customize->add_setting('mh_cicero_options[social_icons]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
    $wp_customize->add_setting('mh_cicero_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
    $wp_customize->add_setting('mh_cicero_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
    $wp_customize->add_setting('mh_cicero_options[related_posts]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_select'));
	$wp_customize->add_setting('mh_cicero_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('mh_cicero_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_checkbox'));
    $wp_customize->add_setting('mh_cicero_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_checkbox'));
    $wp_customize->add_setting('mh_cicero_options[post_meta_comments]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_checkbox'));

	$wp_customize->add_setting('mh_cicero_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_textarea'));
	$wp_customize->add_setting('mh_cicero_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_textarea'));

	$wp_customize->add_setting('mh_cicero_options[color_1]', array('default' => '#343434', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_cicero_options[color_2]', array('default' => '#2ecc71', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    $wp_customize->add_setting('mh_cicero_options[featured_content]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_sanitize_checkbox'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-cicero'), 'section' => 'mh_general', 'settings' => 'mh_cicero_options[excerpt_length]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-cicero'), 'section' => 'mh_general', 'settings' => 'mh_cicero_options[excerpt_more]', 'priority' => 4, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-cicero'), 'section' => 'mh_general', 'settings' => 'mh_cicero_options[copyright]', 'priority' => 5, 'type' => 'text'));

    $wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-cicero'), 'left' => esc_html__('Left Sidebar', 'mh-cicero'))));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[featured_image]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-cicero'), 'disable' => esc_html__('Disable', 'mh-cicero'))));
    $wp_customize->add_control('social_icons', array('label' => esc_html__('Sharing Icons', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[social_icons]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-cicero'), 'disable' => esc_html__('Disable', 'mh-cicero'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[post_nav]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-cicero'), 'disable' => esc_html__('Disable', 'mh-cicero'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[author_box]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-cicero'), 'disable' => esc_html__('Disable', 'mh-cicero'))));
    $wp_customize->add_control('related_posts', array('label' => esc_html__('Related Articles', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[related_posts]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-cicero'), 'disable' => esc_html__('Disable', 'mh-cicero'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => esc_html__('Disable Post Meta Data', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[post_meta_header]', 'priority' => 7)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Disable Date', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[post_meta_date]', 'priority' => 8, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Disable Categories', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[post_meta_cat]', 'priority' => 9, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Disable Comments', 'mh-cicero'), 'section' => 'mh_layout', 'settings' => 'mh_cicero_options[post_meta_comments]', 'priority' => 10, 'type' => 'checkbox'));

	$wp_customize->add_control('custom_css', array('label' => '', 'description' => esc_html__('Add your custom CSS code here:', 'mh-cicero'), 'section' => 'mh_css', 'settings' => 'mh_cicero_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mh-cicero'), 'section' => 'mh_tracking', 'settings' => 'mh_cicero_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-cicero'), 1), 'section' => 'colors', 'settings' => 'mh_cicero_options[color_1]', 'priority' => 50)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-cicero'), 2), 'section' => 'colors', 'settings' => 'mh_cicero_options[color_2]', 'priority' => 51)));

    $wp_customize->add_control('featured_content', array('label' => esc_html__('Hide Featured Content', 'mh-cicero'), 'section' => 'featured_content', 'settings' => 'mh_cicero_options[featured_content]', 'priority' => 99, 'type' => 'checkbox'));

}
add_action('customize_register', 'mh_cicero_customize_register');

/***** Data Sanitization *****/

function mh_cicero_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_cicero_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_cicero_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_cicero_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_cicero_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-cicero'),
        'disable' => esc_html__('Disable', 'mh-cicero'),
        'right' => esc_html__('Right Sidebar', 'mh-cicero'),
        'left' => esc_html__('Left Sidebar', 'mh-cicero')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_cicero_theme_options')) {
	function mh_cicero_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_cicero_options', array()),
			mh_cicero_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_cicero_default_options')) {
	function mh_cicero_default_options() {
		$default_options = array(
			'excerpt_length' => 50,
			'excerpt_more' => esc_html__('Read More', 'mh-cicero'),
			'copyright' => '',
			'sidebar' => 'right',
			'featured_image' => 'enable',
			'social_icons' => 'enable',
			'post_nav' => 'enable',
			'author_box' => 'enable',
			'related_posts' => 'enable',
			'post_meta_date' => 0,
			'post_meta_cat' => 0,
			'post_meta_comments' => 0,
			'custom_css' => '',
			'tracking_code' => '',
			'color_1' => '#343434',
			'color_2' => '#2ecc71',
			'featured_content' => 0,
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_cicero_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_cicero_customizer_css');

/***** CSS Output *****/

function mh_cicero_custom_css() {
	$mh_cicero_options = mh_cicero_theme_options();
	$background_color = get_background_color();
	if ($mh_cicero_options['color_1'] != '#343434' || $mh_cicero_options['color_2'] != '#2ecc71' || $mh_cicero_options['custom_css']) : ?>
	<style type="text/css">
    	<?php if ($mh_cicero_options['color_1'] != '#343434') { ?>
    		.header-wrap, .entry-social a, .entry-social .more-link:hover, #searchform div, #searchform #s, .page-numbers, a .pagelink, #infinite-handle span, #infinite-footer .container, footer { background: <?php echo $mh_cicero_options['color_1']; ?>; }
    	<?php } ?>
    	<?php if ($mh_cicero_options['color_2'] != '#2ecc71') { ?>
			.main-nav ul li:hover, .main-nav ul .current-menu-item, .main-nav ul li:hover > ul, .slicknav_menu, .entry-social a:hover, .entry-social .more-link, .page-numbers:hover, .current, .pagelink, a:hover .pagelink, input[type="submit"], table th, #infinite-handle span:hover, .flexslider .flex-prev:hover, .flexslider .flex-next:hover { background: <?php echo $mh_cicero_options['color_2']; ?>; }
			a:hover, .entry-content a, .entry-icon .fa-inverse, .commentlist a:hover, .comment-author, .comment-author a, .social-nav .fa-mh-social:hover { color: <?php echo $mh_cicero_options['color_2']; ?>; }
			.featured-caption, blockquote, .commentlist .bypostauthor .avatar { border-color: <?php echo $mh_cicero_options['color_2']; ?>; }
    	<?php } ?>
    	<?php if ($mh_cicero_options['custom_css']) {	echo $mh_cicero_options['custom_css']; } ?>
	</style>
	<?php
	endif;
}
add_action('wp_head', 'mh_cicero_custom_css');

?>