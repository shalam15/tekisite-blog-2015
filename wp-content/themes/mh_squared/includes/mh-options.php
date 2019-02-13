<?php

function mh_squared_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
		public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
		}
	}

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_squared_theme_options', array('title' => esc_html__('Theme Options', 'mh-squared'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_squared_general', array('title' => esc_html__('General', 'mh-squared'), 'priority' => 1, 'panel' => 'mh_squared_theme_options'));
	$wp_customize->add_section('mh_squared_layout', array('title' => esc_html__('Layout', 'mh-squared'), 'priority' => 2, 'panel' => 'mh_squared_theme_options'));
	$wp_customize->add_section('mh_squared_ticker', array('title' => esc_html__('News Ticker', 'mh-squared'), 'priority' => 3, 'panel' => 'mh_squared_theme_options'));

	/***** Add Settings *****/

	$wp_customize->add_setting('mh_squared_options[excerpt_length]', array('default' => 25, 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_integer'));
	$wp_customize->add_setting('mh_squared_options[read_more]', array('default' => esc_html__('Read More', 'mh-squared'), 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_text'));
	$wp_customize->add_setting('mh_squared_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_text'));
	$wp_customize->add_setting('mh_squared_options[credits]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));

	$wp_customize->add_setting('mh_squared_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[breadcrumbs]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_meta_cat]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_meta_date]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_meta_author]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_meta_comments]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_meta_tags]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[related_content]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));
	$wp_customize->add_setting('mh_squared_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_select'));

	$wp_customize->add_setting('mh_squared_options[show_ticker]', array('default' => 1, 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_checkbox'));
	$wp_customize->add_setting('mh_squared_options[ticker_title]', array('default' => esc_html__('Latest', 'mh-squared'), 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_text'));
	$wp_customize->add_setting('mh_squared_options[ticker_posts]', array('default' => 5, 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_integer'));
	$wp_customize->add_setting('mh_squared_options[ticker_cats]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_text'));
	$wp_customize->add_setting('mh_squared_options[ticker_tags]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_text'));
	$wp_customize->add_setting('mh_squared_options[ticker_offset]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_integer'));
	$wp_customize->add_setting('mh_squared_options[ticker_sticky]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_squared_sanitize_checkbox'));

	$wp_customize->add_setting('mh_squared_options[color_1]', array('default' => '#1f1e1e', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_squared_options[color_2]', array('default' => '#faab1a', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

	/***** Add Controls *****/

	$wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-squared'), 'section' => 'mh_squared_general', 'settings' => 'mh_squared_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
	$wp_customize->add_control('read_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-squared'), 'section' => 'mh_squared_general', 'settings' => 'mh_squared_options[read_more]', 'priority' => 3, 'type' => 'text'));
	$wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-squared'), 'section' => 'mh_squared_general', 'settings' => 'mh_squared_options[copyright]', 'priority' => 4, 'type' => 'text'));
	$wp_customize->add_control('credits', array('label' => esc_html__('Theme Credits', 'mh-squared'), 'section' => 'mh_squared_general', 'settings' => 'mh_squared_options[credits]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));

	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar Alignment', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-squared'), 'left' => esc_html__('Left Sidebar', 'mh-squared'))));
	$wp_customize->add_control('breadcrumbs', array('label' => esc_html__('Breadcrumb Navigation', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[breadcrumbs]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[featured_image]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Categories on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_meta_cat]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_meta_date', array('label' => esc_html__('Date on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_meta_date]', 'priority' => 5, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_meta_author', array('label' => esc_html__('Author Name on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_meta_author]', 'priority' => 6, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Comment Count on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_meta_comments]', 'priority' => 7, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_meta_tags', array('label' => esc_html__('Tags on Posts', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_meta_tags]', 'priority' => 8, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[social_sharing]', 'priority' => 9, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[author_box]', 'priority' => 10, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('related_content', array('label' => esc_html__('Related Articles', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[related_content]', 'priority' => 11, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));
	$wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-squared'), 'section' => 'mh_squared_layout', 'settings' => 'mh_squared_options[post_nav]', 'priority' => 12, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-squared'), 'disable' => esc_html__('Disable', 'mh-squared'))));

	$wp_customize->add_control('show_ticker', array('label' => esc_html__('Enable Ticker', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[show_ticker]', 'priority' => 1, 'type' => 'checkbox'));
	$wp_customize->add_control('ticker_title', array('label' => esc_html__('Ticker Title', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_title]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('ticker_posts', array('label' => esc_html__('Limit Post Number', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_posts]', 'priority' => 3, 'type' => 'text'));
	$wp_customize->add_control('ticker_cats', array('label'=> esc_html__('Custom Categories (use ID - e.g. 3,5,9):', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_cats]', 'priority' => 4, 'type' => 'text'));
	$wp_customize->add_control('ticker_tags', array('label' => esc_html__('Custom Tags (use slug - e.g. lifestyle):', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_tags]', 'priority' => 5, 'type' => 'text'));
	$wp_customize->add_control('ticker_offset', array('label' => esc_html__('Skip Posts (Offset):', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_offset]', 'priority' => 6, 'type' => 'text'));
	$wp_customize->add_control('ticker_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'mh-squared'), 'section' => 'mh_squared_ticker', 'settings' => 'mh_squared_options[ticker_sticky]', 'priority' => 7, 'type' => 'checkbox'));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-squared'), 1), 'section' => 'colors', 'settings' => 'mh_squared_options[color_1]', 'priority' => 50)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-squared'), 2), 'section' => 'colors', 'settings' => 'mh_squared_options[color_2]', 'priority' => 51)));
}
add_action('customize_register', 'mh_squared_customize_register');

/***** Data Sanitization *****/

function mh_squared_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_squared_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_squared_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_squared_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-squared'),
        'disable' => esc_html__('Disable', 'mh-squared'),
		'right' => esc_html__('Right Sidebar', 'mh-squared'),
        'left' => esc_html__('Left Sidebar', 'mh-squared'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_squared_theme_options')) {
	function mh_squared_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_squared_options', array()),
			mh_squared_default_options()
		);
		return $theme_options;
	}
}
if (!function_exists('mh_squared_default_options')) {
	function mh_squared_default_options() {
		$default_options = array(
			'excerpt_length' => 25,
			'read_more' => esc_html__('Read More', 'mh-squared'),
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
			'ticker_title' => esc_html__('Latest', 'mh-squared'),
			'ticker_posts' => 5,
			'ticker_cats' => '',
			'ticker_tags' => '',
			'ticker_offset' => '',
			'ticker_sticky' => 0,
			'color_1' => '#1f1e1e',
			'color_2' => '#faab1a'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_squared_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_squared_customizer_css');

/***** Custom CSS Output *****/

function mh_squared_custom_css() {
	$mh_squared_options = mh_squared_theme_options();
	$color1hex = $mh_squared_options['color_1'];
	list($color1hexr, $color1hexg, $color1hexb) = sscanf($color1hex, "#%02x%02x%02x");
	if ($mh_squared_options['color_1'] != '#1f1e1e' || $mh_squared_options['color_2'] != '#faab1a') : ?>
		<style type="text/css"><?php
			if ($mh_squared_options['color_1'] != '#1f1e1e') { ?>
				.logo, .header-ad-widget, .ticker-item-date, .header-nav li:hover a, .header-nav ul ul, .main-nav li:hover a, .main-nav ul ul, .breadcrumb, .entry-meta-author:hover, .entry-meta-date:hover, .entry-category a:hover, .entry-tags a:hover, .author-box-button:hover, .post-nav-wrap li:hover, .content-list-more:hover, .mh-share-button:hover, .wp-caption, .wp-caption-text, .comment-footer-meta a:hover, #respond, .footer-widget, #calendar_wrap table th, .mh_squared_youtube_video, .home-main-widget.mh_squared_slider, .content-slide-title span, .widget_tag_cloud, table th { background: <?php echo $mh_squared_options['color_1']; ?>; }
				blockquote { border-color: <?php echo $mh_squared_options['color_1']; ?>; }
				.mh-preheader, .mh-header, .mh-footer { background: rgba(<?php echo "$color1hexr, $color1hexg, $color1hexb,"; ?> 0.75); }
				.footer-widget.widget_nav_menu li a, .footer-widget.widget_meta li a, .footer-widget.widget_recent_entries li, .footer-widget .mh-recent-comments li, .footer-widget .custom-posts-date, .footer-widget .cp-large-date, .footer-widget .user-widget li { background: rgba(0, 0, 0, 0.5); }
				@media only screen and (max-width: 680px) {
					.content-slide-title { background: <?php echo $mh_squared_options['color_1']; ?>; }
				} <?php
			}
			if ($mh_squared_options['color_2'] != '#faab1a') { ?>
				.ticker-title, .main-nav, .slicknav, .slicknav_btn:hover, .entry-category-title, .entry-tags span, .mh-share-button, .author-box-title, .author-box-button, .related-content-title, .post-nav-wrap, .comment-section-title, .comment-footer-meta a, .pinglist .fa-link, .content-list-category, .content-list-more, .widget-title, .content-slide-category, .widget_recent_entries .post-date, input[type="submit"], .pagination .page-numbers:hover, .pagination .pagelink:hover, .pagination .current, .pagination .current:hover, .entry-content .pagelink, .entry-content .pagelink:hover, .uw-text span, .recentcomments .comment-author-link, .rc-author, #calendar_wrap table td:hover { background: <?php echo $mh_squared_options['color_2']; ?>; }
				.ticker-item-date, .entry-meta .fa, .entry-content a, .social-nav .fa-stack:hover, #calendar_wrap a, .footer-info a { color: <?php echo $mh_squared_options['color_2']; ?>; }
				.mh-preheader, .mh-header, .header-nav ul ul ul, .main-nav ul ul ul, .slicknav_nav .sub-menu, .commentlist .bypostauthor .avatar, .mh-prefooter, .mh-footer { border-color: <?php echo $mh_squared_options['color_2']; ?>; }<?php
			} ?>
        </style><?php
	endif;
}
add_action('wp_head', 'mh_squared_custom_css');

?>