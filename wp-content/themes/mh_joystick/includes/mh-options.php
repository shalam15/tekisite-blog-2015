<?php

function mh_joystick_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
		public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
		}
	}

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_joystick_theme_options', array('title' => esc_html__('Theme Options', 'mh-joystick'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_joystick_general', array('title' => esc_html__('General', 'mh-joystick'), 'priority' => 1, 'panel' => 'mh_joystick_theme_options'));
	$wp_customize->add_section('mh_joystick_layout', array('title' => esc_html__('Layout', 'mh-joystick'), 'priority' => 2, 'panel' => 'mh_joystick_theme_options'));
	$wp_customize->add_section('mh_joystick_ticker', array('title' => esc_html__('News Ticker', 'mh-joystick'), 'priority' => 3, 'panel' => 'mh_joystick_theme_options'));

	/***** Add Settings *****/

	$wp_customize->add_setting('mh_joystick_options[excerpt_length]', array('default' => 16, 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_integer'));
	$wp_customize->add_setting('mh_joystick_options[read_more]', array('default' => esc_html__('Read More', 'mh-joystick'), 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_options[credits]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));

	$wp_customize->add_setting('mh_joystick_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_meta_cat]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_meta_date]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_meta_author]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_meta_comments]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_meta_tags]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_select'));

	$wp_customize->add_setting('mh_joystick_options[show_ticker]', array('default' => 1, 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_checkbox'));
	$wp_customize->add_setting('mh_joystick_options[ticker_title]', array('default' => esc_html__('Latest', 'mh-joystick'), 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_integer'));
	$wp_customize->add_setting('mh_joystick_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_integer'));
	$wp_customize->add_setting('mh_joystick_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_sanitize_checkbox'));

	$wp_customize->add_setting('mh_joystick_options[color_1]', array('default' => '#0296c8', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_joystick_options[color_2]', array('default' => '#cd1c21', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

	/***** Add Controls *****/

	$wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-joystick'), 'section' => 'mh_joystick_general', 'settings' => 'mh_joystick_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
	$wp_customize->add_control('read_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-joystick'), 'section' => 'mh_joystick_general', 'settings' => 'mh_joystick_options[read_more]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-joystick'), 'section' => 'mh_joystick_general', 'settings' => 'mh_joystick_options[copyright]', 'priority' => 3, 'type' => 'text'));
	$wp_customize->add_control('credits', array('label' => esc_html__('Theme Credits', 'mh-joystick'), 'section' => 'mh_joystick_general', 'settings' => 'mh_joystick_options[credits]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));

	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar Alignment', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-joystick'), 'left' => esc_html__('Left Sidebar', 'mh-joystick'))));
	$wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[breadcrumbs]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[featured_image]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Categories on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_meta_cat]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_meta_date', array('label' => esc_html__('Date on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_meta_date]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_meta_author', array('label' => esc_html__('Author Name on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_meta_author]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Comment Count on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_meta_comments]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_meta_tags', array('label' => esc_html__('Tags on Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_meta_tags]', 'priority' => 8, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[social_sharing]', 'priority' => 9, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[author_box]', 'priority' => 10, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('related_content', array('label' => esc_html__('Related Posts', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[related_content]', 'priority' => 11, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));
	$wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-joystick'), 'section' => 'mh_joystick_layout', 'settings' => 'mh_joystick_options[post_nav]', 'priority' => 12, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-joystick'), 'disable' => esc_html__('Disable', 'mh-joystick'))));

	$wp_customize->add_control('show_ticker', array('label' => esc_html__('Enable Ticker', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[show_ticker]', 'priority' => 1, 'type' => 'checkbox'));
	$wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_title]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_posts]', 'priority' => 3, 'type' => 'text'));
	$wp_customize->add_control('ticker_cats', array('label'=> __('Custom Categories (use ID - e.g. 3,5,9):', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_cats]', 'priority' => 4, 'type' => 'text'));
	$wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_tags]', 'priority' => 5, 'type' => 'text'));
	$wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_offset]', 'priority' => 6, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'mh-joystick'), 'section' => 'mh_joystick_ticker', 'settings' => 'mh_joystick_options[ticker_sticky]', 'priority' => 7, 'type' => 'checkbox'));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-joystick'), 1), 'section' => 'colors', 'settings' => 'mh_joystick_options[color_1]', 'priority' => 50)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-joystick'), 2), 'section' => 'colors', 'settings' => 'mh_joystick_options[color_2]', 'priority' => 51)));
}
add_action('customize_register', 'mh_joystick_customize_register');

/***** Data Sanitization *****/

function mh_joystick_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_joystick_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_joystick_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_joystick_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-joystick'),
        'disable' => esc_html__('Disable', 'mh-joystick'),
		'right' => esc_html__('Right Sidebar', 'mh-joystick'),
        'left' => esc_html__('Left Sidebar', 'mh-joystick'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_joystick_theme_options')) {
	function mh_joystick_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_joystick_options', array()),
			mh_joystick_default_options()
		);
		return $theme_options;
	}
}
if (!function_exists('mh_joystick_default_options')) {
	function mh_joystick_default_options() {
		$default_options = array(
			'excerpt_length' => 16,
			'read_more' => esc_html__('Read More', 'mh-joystick'),
			'copyright' => '',
			'credits' => 'enable',
			'breadcrumbs' => 'enable',
			'post_meta_cat' => 'enable',
			'featured_image' => 'enable',
			'post_meta_date' => 'enable',
			'post_meta_author' => 'enable',
			'post_meta_comments' => 'enable',
			'post_meta_tags' => 'enable',
			'social_sharing' => 'enable',
			'author_box' => 'enable',
			'related_content' => 'enable',
			'post_nav' => 'enable',
			'sidebar' => 'right',
			'show_ticker' => 1,
			'ticker_title' => esc_html__('Latest', 'mh-joystick'),
			'ticker_posts' => 5,
			'ticker_cats' => '',
			'ticker_tags' => '',
			'ticker_offset' => '',
			'ticker_sticky' => 0,
			'color_1' => '#0296c8',
			'color_2' => '#cd1c21'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_joystick_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_joystick_customizer_css');

/***** Custom CSS Output *****/

function mh_joystick_custom_css() {
	$mh_joystick_options = mh_joystick_theme_options();
	if ($mh_joystick_options['color_1'] != '#0296c8' || $mh_joystick_options['color_2'] != '#cd1c21') : ?>
		<style type="text/css"><?php
			if ($mh_joystick_options['color_1'] != '#0296c8') { ?>
				.logo, .main-nav li:hover, .main-nav li:hover a, .main-nav ul ul, .slicknav_nav .sub-menu, .slicknav_nav ul ul ul .sub-menu, .comment-section-title, .commentlist, .pinglist, #cancel-comment-reply-link, .widget-title { background: <?php echo $mh_joystick_options['color_1']; ?>; }
				blockquote, .commentlist .bypostauthor .avatar, .sb-widget, .footer-widget { border-color: <?php echo $mh_joystick_options['color_1']; ?>; }<?php
			}
			if ($mh_joystick_options['color_2'] != '#cd1c21') { ?>
				.ticker-title, .entry-tags span, .entry-tags a:hover, .entry-category-title, .entry-category a:hover, .author-box-button, .post-nav-wrap, .pagination .page-numbers:hover, .pagination .pagelink:hover, .pagination .current, .pagination .current:hover, .entry-content .pagelink, .entry-content .pagelink:hover, .comment-footer-meta a, .content-list-more, .content-list-category, .content-slide-category, .mh_joystick_youtube_video .widget-title, .sb-widget.widget_search .widget-title, .footer-widget.widget_search .widget-title, .sb-widget.widget_search .search-form, .footer-widget.widget_search .search-form, input[type=submit], .widget_nav_menu li a:hover, .widget_meta li a:hover, .widget_recent_entries li:hover, .widget_recent_entries .post-date, .mh-recent-comments li:hover, .recentcomments .comment-author-link, .rc-author, .tagcloud a, .uw-data, #calendar_wrap table td:hover, #infinite-handle span:hover { background: <?php echo $mh_joystick_options['color_2']; ?>; }
				a:hover, .social-nav .fa-stack:hover, .entry-meta .fa, .post-nav-wrap a, #calendar_wrap a, .entry-content a, .footer-info a { color: <?php echo $mh_joystick_options['color_2']; ?>; }
				.sb-widget.widget_search, .footer-widget.widget_search, .mh_joystick_youtube_video { border-color: <?php echo $mh_joystick_options['color_2']; ?>; }<?php
			} ?>
        </style><?php
	endif;
}
add_action('wp_head', 'mh_joystick_custom_css'); ?>