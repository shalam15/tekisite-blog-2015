<?php

function mh_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'mhc'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));


	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General Options', 'mhc'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_content', array('title' => esc_html__('Posts/Pages Options', 'mhc'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_ads', array('title' => esc_html__('Advertising', 'mhc'), 'priority' => 4, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_css', array('title' => esc_html__('Custom CSS', 'mhc'), 'priority' => 5, 'panel' => 'mh_theme_options'));
    $wp_customize->add_section('mh_tracking', array('title' => esc_html__('Tracking Code', 'mhc'), 'priority' => 6, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mhc_options[excerpt_length]', array('default' => 175, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_integer'));
    $wp_customize->add_setting('mhc_options[excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_text'));
    $wp_customize->add_setting('mhc_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_text'));

    $wp_customize->add_setting('mhc_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[related_posts]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[social_buttons]', array('default' => 'both_social', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[sidebar]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
    $wp_customize->add_setting('mhc_options[sb_position]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_select'));
	$wp_customize->add_setting('mhc_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('mhc_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_checkbox'));
    $wp_customize->add_setting('mhc_options[post_meta_author]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_checkbox'));
    $wp_customize->add_setting('mhc_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_checkbox'));
    $wp_customize->add_setting('mhc_options[post_meta_comments]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_checkbox'));

    $wp_customize->add_setting('mhc_options[content_ad]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_textarea'));
    $wp_customize->add_setting('mhc_options[loop_ad]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_textarea'));
    $wp_customize->add_setting('mhc_options[loop_ad_no]', array('default' => 3, 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_integer'));

    $wp_customize->add_setting('mhc_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_textarea'));
    $wp_customize->add_setting('mhc_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_textarea'));

    $wp_customize->add_setting('mhc_options[color_bg_header]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_bg_inner]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_1]', array('default' => '#d8d8d8', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_2]', array('default' => '#30719d', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_text_general]', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_text_1]', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_text_2]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_text_meta]', array('default' => '#828282', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mhc_options[color_links', array('default' => '#000000', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mhc_options[color_links_hover', array('default' => '#30719d', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    $wp_customize->add_setting('mhc_options[full_bg]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_corporate_sanitize_checkbox'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Characters', 'mhc'), 'section' => 'mh_general', 'settings' => 'mhc_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mhc'), 'section' => 'mh_general', 'settings' => 'mhc_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mhc'), 'section' => 'mh_general', 'settings' => 'mhc_options[copyright]', 'priority' => 3, 'type' => 'text'));

	$wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[breadcrumbs]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[featured_image]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_nav]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[author_box]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('related_posts', array('label' => esc_html__('Related Articles', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[related_posts]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('social_buttons', array('label' => esc_html__('Social Buttons on Posts', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[social_buttons]', 'priority' => 6, 'type' => 'select', 'choices' => array('both_social' => __('Top and bottom', 'mhc'), 'top_social' => __('Top of posts', 'mhc'), 'bottom_social' => __('Bottom of posts', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[sidebar]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mhc'), 'disable' => __('Disable', 'mhc'))));
    $wp_customize->add_control('sb_position', array('label' => esc_html__('Position of Sidebar', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[sb_position]', 'priority' => 8, 'type' => 'select', 'choices' => array('left' => __('Left', 'mhc'), 'right' => __('Right', 'mhc'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => __('Disable Post Meta Data', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_meta_header]', 'priority' => 9)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Disable Date', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_meta_date]', 'priority' => 10, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Disable Author', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_meta_author]', 'priority' => 11, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Disable Categories', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_meta_cat]', 'priority' => 12, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Disable Comments', 'mhc'), 'section' => 'mh_content', 'settings' => 'mhc_options[post_meta_comments]', 'priority' => 13, 'type' => 'checkbox'));

	$wp_customize->add_control('content_ad', array('label' => esc_html__('Ad Code for Content Ad on Posts', 'mhc'), 'section' => 'mh_ads', 'settings' => 'mhc_options[content_ad]', 'priority' => 1, 'type' => 'textarea'));
	$wp_customize->add_control('loop_ad', array('label' => esc_html__('Ad Code for Ads on Archives', 'mhc'), 'section' => 'mh_ads', 'settings' => 'mhc_options[loop_ad]', 'priority' => 2, 'type' => 'textarea'));
    $wp_customize->add_control('loop_ad_no', array('label'=> esc_html__('Display ad every x posts on archives:', 'mhc'), 'section' => 'mh_ads', 'settings' => 'mhc_options[loop_ad_no]', 'priority' => 3, 'type' => 'text'));

	$wp_customize->add_control('custom_css', array('label' => esc_html__('Custom CSS', 'mhc'), 'section' => 'mh_css', 'settings' => 'mhc_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mhc'), 'section' => 'mh_tracking', 'settings' => 'mhc_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_bg_header', array('label' => esc_html__('Background Header', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_bg_header]', 'priority' => 10)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_bg_inner', array('label' => esc_html__('Background Inner', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_bg_inner]', 'priority' => 11)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mhc'), 1), 'section' => 'colors', 'settings' => 'mhc_options[color_1]', 'priority' => 12)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mhc'), 2), 'section' => 'colors', 'settings' => 'mhc_options[color_2]', 'priority' => 13)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_general', array('label' => esc_html__('Text: General', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_text_general]', 'priority' => 14)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_1', array('label' => sprintf(esc_html_x('Text: Colored Sections (Color %d)', 'options panel', 'mhc'), 1), 'section' => 'colors', 'settings' => 'mhc_options[color_text_1]', 'priority' => 15)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_2', array('label' => sprintf(esc_html_x('Text: Colored Sections (Color %d)', 'options panel', 'mhc'), 2), 'section' => 'colors', 'settings' => 'mhc_options[color_text_2]', 'priority' => 16)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_meta', array('label' => esc_html__('Text: Post Meta', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_text_meta]', 'priority' => 17)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links', array('label' => esc_html__('Links: General Color', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_links]', 'priority' => 18)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_links_hover', array('label' => esc_html__('Links: Hover Color', 'mhc'), 'section' => 'colors', 'settings' => 'mhc_options[color_links_hover]', 'priority' => 19)));

	$wp_customize->add_control('full_bg', array('label' => esc_html__('Scale Background Image to Full Size', 'mhc'), 'section' => 'background_image', 'settings' => 'mhc_options[full_bg]', 'priority' => 99, 'type' => 'checkbox'));
}
add_action('customize_register', 'mh_customize_register');

/***** Data Sanitization *****/

function mh_corporate_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_corporate_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_corporate_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_corporate_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_corporate_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mhc'),
        'disable' => esc_html__('Disable', 'mhc'),
        'left' => esc_html__('Left', 'mhc'),
        'right' => esc_html__('Right', 'mhc'),
        'both_social' => esc_html__('Top and Bottom', 'mhc'),
        'top_social' => esc_html__('Top of Posts', 'mhc'),
        'bottom_social' => esc_html__('Bottom of Posts', 'mhc')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_theme_options')) {
	function mh_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mhc_options', array()),
			mh_corporate_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_corporate_default_options')) {
	function mh_corporate_default_options() {
		$default_options = array(
			'excerpt_length' => 175,
			'excerpt_more' => '[...]',
			'breadcrumbs' => 'enable',
			'featured_image' => 'enable',
			'post_nav' => 'enable',
			'author_box' => 'enable',
			'related_posts' => 'enable',
			'sidebar' => 'enable',
			'social_buttons' => 'both_social',
			'sb_position' => 'right',
			'post_meta_date' => 0,
			'post_meta_author' => 0,
			'post_meta_cat' => 0,
			'post_meta_comments' => 0,
			'content_ad' => '',
			'loop_ad' => '',
			'loop_ad_no' => 3,
			'custom_css' => '',
			'tracking_code' => '',
			'color_bg_inner' => '#ffffff',
			'color_bg_header' => '#ffffff',
			'color_1' => '#d8d8d8',
			'color_2' => '#30719d',
			'color_text_general' => '#000000',
			'color_text_1' => '#000000',
			'color_text_2' => '#ffffff',
			'color_text_meta' => '#828282',
			'color_links' => '#000000',
			'color_links_hover' => '#30719d',
			'full_bg' => ''
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_customizer_css');

/***** CSS Output *****/

function mh_custom_css() {
	$options = mh_theme_options();
	if ($options['color_bg_header'] != '#ffffff' || $options['color_bg_inner'] != '#ffffff' || $options['color_1'] != '#d8d8d8' || $options['color_2'] != '#30719d' || $options['color_text_general'] != '#000000' || $options['color_text_1'] != '#000000' || $options['color_text_2'] != '#ffffff' || $options['color_text_meta'] != '#828282' || $options['color_links'] != '#000000' || $options['color_links_hover'] != '#30719d' || $options['custom_css']) : ?>
    <style type="text/css">
    	<?php if ($options['color_bg_header'] != '#ffffff') { ?>
    		.header-wrap { background: <?php echo $options['color_bg_header']; ?> }
    	<?php } ?>
    	<?php if ($options['color_bg_inner'] != '#ffffff') { ?>
    		.wrapper-corporate, .mh-wrapper, .copyright-wrap { background: <?php echo $options['color_bg_inner']; ?> }
    		.copyright, .copyright a { color: #fff; }
    	<?php } ?>
    	<?php if ($options['color_1'] != '#d8d8d8') { ?>
    		.main-nav, .main-nav .menu .menu-item:hover > .sub-menu, .page-title, .slide-caption, .spotlight, .sitemap-widget .widget-title,
    		.sb-widget .widget-title, .author-box, .post-navigation, .section-title, #respond, .no-comments, footer, .slicknav_menu .slicknav_icon-bar { background: <?php echo $options['color_1']; ?> }
    		.slicknav_menu .slicknav_menutxt { color: <?php echo $options['color_1']; ?> }
    		.slicknav_menu, .slicknav_nav ul, .slide-caption .slide-data { border-color: <?php echo $options['color_1']; ?> }
    	<?php } ?>
    	<?php if ($options['color_2'] != '#30719d') { ?>
    		.main-nav li:hover, .sl-caption, .caption, .page-numbers:hover, .current, .pagelink, a:hover .pagelink, .post-tags li:hover,
    		.tagcloud a:hover, input[type=submit], #cancel-comment-reply-link, #cancel-comment-reply-link:hover, th { background: <?php echo $options['color_2']; ?>; }
    		.slide-caption, .footer-widget-title, .commentlist .bypostauthor .vcard, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover, blockquote { border-color: <?php echo $options['color_2']; ?>; }
    		.dropcap { color: <?php echo $options['color_2']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_text_general'] != '#000000') { ?>
    		body, .mh-content .page-itle, h1, h2, h3, h4, h5, h6, .wp-caption .wp-caption-text, .post-thumbnail .wp-caption-text { color: <?php echo $options['color_text_general']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_text_1'] != '#000000') { ?>
    		.main-nav li a, .main-nav .current-menu-item a, .sb-widget .widget-title, .sb-widget .widget-title a, .footer-widget-title, .footer-widget-title a,
    		.sitemap-widget .widget-title, .slide-data, .slide-title, .slide-caption .mh-excerpt a, footer .uw-wrap, .page-title, .spotlight, .sl-title, .spotlight .mh-excerpt a, .post-navigation a, .section-title, footer .wp-caption .wp-caption-text, #respond, .comment-reply-title { color: <?php echo $options['color_text_1']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_text_2'] != '#ffffff') { ?>
    		.main-nav a:hover, .main-nav li:hover > a, .sl-caption, .caption, .post-tags a:hover, input[type=submit], .tagcloud a:hover, .page-numbers:hover, .current, a:hover .pagelink { color: <?php echo $options['color_text_2']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_text_meta'] != '#828282') { ?>
    		.meta, .meta a, .breadcrumb, .breadcrumb a, .uw-data, .related-subheading { color: <?php echo $options['color_text_meta']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_links'] != '#000000') { ?>
    		a, .entry a, .related-title, a .pagelink, .page-numbers, .slicknav_nav a { color: <?php echo $options['color_links']; ?>; }
    	<?php } ?>
    	<?php if ($options['color_links_hover'] != '#30719d') { ?>
    		a:hover, .meta a:hover, .breadcrumb a:hover, .related-title:hover, .slide-title:hover, .sl-title:hover, .slicknav_nav a:hover, .slicknav_nav .slicknav_item:hover { color: <?php echo $options['color_links_hover']; ?>; }
    	<?php } ?>
    	<?php if ($options['custom_css']) {	echo $options['custom_css']; } ?>
	</style>
    <?php
	endif;
}
add_action('wp_head', 'mh_custom_css');

?>