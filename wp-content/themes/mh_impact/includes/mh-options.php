<?php

function mh_impact_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'mh-impact'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General', 'mh-impact'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => esc_html__('Layout', 'mh-impact'), 'priority' => 2, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('mh_impact_options[telephone]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_text'));
    $wp_customize->add_setting('mh_impact_options[excerpt_length]', array('default' => 45, 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_integer'));
    $wp_customize->add_setting('mh_impact_options[excerpt_more]', array('default' => esc_html__('[Read More]', 'mh-impact'), 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_text'));
	$wp_customize->add_setting('mh_impact_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_text'));

    $wp_customize->add_setting('mh_impact_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_select'));
	$wp_customize->add_setting('mh_impact_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_select'));
    $wp_customize->add_setting('mh_impact_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_select'));
    $wp_customize->add_setting('mh_impact_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_select'));
	$wp_customize->add_setting('mh_impact_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_select'));
	$wp_customize->add_setting('mh_impact_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('mh_impact_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_checkbox'));
    $wp_customize->add_setting('mh_impact_options[post_meta_author]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_checkbox'));
    $wp_customize->add_setting('mh_impact_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_impact_sanitize_checkbox'));

	$wp_customize->add_setting('mh_impact_options[color_1]', array('default' => '#6acab9', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_impact_options[color_2]', array('default' => '#55b2a2', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_impact_options[color_3]', array('default' => '#e64b3e', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_impact_options[color_4]', array('default' => '#c41d17', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_impact_options[color_5]', array('default' => '#343232', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_impact_options[color_6]', array('default' => '#1f1e1e', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    /***** Add Controls *****/

	$wp_customize->add_control('telephone', array('label' => esc_html__('Telephone Number', 'mh-impact'), 'section' => 'mh_general', 'settings' => 'mh_impact_options[telephone]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-impact'), 'section' => 'mh_general', 'settings' => 'mh_impact_options[excerpt_length]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-impact'), 'section' => 'mh_general', 'settings' => 'mh_impact_options[excerpt_more]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-impact'), 'section' => 'mh_general', 'settings' => 'mh_impact_options[copyright]', 'priority' => 4, 'type' => 'text'));

    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[featured_image]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-impact'), 'disable' => esc_html__('Disable', 'mh-impact'))));
	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[social_sharing]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-impact'), 'disable' => esc_html__('Disable', 'mh-impact'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[post_nav]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-impact'), 'disable' => esc_html__('Disable', 'mh-impact'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[author_box]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'mh-impact'), 'disable' => esc_html__('Disable', 'mh-impact'))));
	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[sidebar]', 'priority' => 5, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-impact'), 'left' => esc_html__('Left Sidebar', 'mh-impact'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => __('Disable Post Meta Data', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[post_meta_header]', 'priority' => 6)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Disable Date', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[post_meta_date]', 'priority' => 7, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Disable Author', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[post_meta_author]', 'priority' => 8, 'type' => 'checkbox'));
	$wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Disable Categories', 'mh-impact'), 'section' => 'mh_layout', 'settings' => 'mh_impact_options[post_meta_cat]', 'priority' => 9, 'type' => 'checkbox'));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 1), 'section' => 'colors', 'settings' => 'mh_impact_options[color_1]', 'priority' => 52)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 2), 'section' => 'colors', 'settings' => 'mh_impact_options[color_2]', 'priority' => 53)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_3', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 3), 'section' => 'colors', 'settings' => 'mh_impact_options[color_3]', 'priority' => 54)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_4', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 4), 'section' => 'colors', 'settings' => 'mh_impact_options[color_4]', 'priority' => 55)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_5', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 5), 'section' => 'colors', 'settings' => 'mh_impact_options[color_5]', 'priority' => 56)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_6', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-impact'), 6), 'section' => 'colors', 'settings' => 'mh_impact_options[color_6]', 'priority' => 57)));
}
add_action('customize_register', 'mh_impact_customize_register');

/***** Data Sanitization *****/

function mh_impact_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_impact_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_impact_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_impact_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_impact_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-impact'),
        'disable' => esc_html__('Disable', 'mh-impact'),
        'right' => esc_html__('Right Sidebar', 'mh-impact'),
        'left' => esc_html__('Left Sidebar', 'mh-impact')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_impact_theme_options')) {
	function mh_impact_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_impact_options', array()),
			mh_impact_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_impact_default_options')) {
	function mh_impact_default_options() {
		$default_options = array(
			'telephone' => '',
			'excerpt_length' => 45,
			'excerpt_more' => esc_html__('[Read More]', 'mh-impact'),
			'copyright' => '',
			'featured_image' => 'enable',
			'social_sharing' => 'enable',
			'post_nav' => 'enable',
			'author_box' => 'enable',
			'sidebar' => 'right',
			'post_meta_date' => 0,
			'post_meta_author' => 0,
			'post_meta_cat' => 0,
			'color_1' => '#6acab9',
			'color_2' => '#55b2a2',
			'color_3' => '#e64b3e',
			'color_4' => '#c41d17',
			'color_5' => '#343232',
			'color_6' => '#1f1e1e'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_impact_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_impact_customizer_css');

/***** CSS Output *****/

function mh_impact_custom_css() {
	$mh_impact_options = mh_impact_theme_options();
	if ($mh_impact_options['color_1'] != '#6acab9' || $mh_impact_options['color_2'] != '#55b2a2' || $mh_impact_options['color_3'] != '#e64b3e' || $mh_impact_options['color_4'] != '#c41d17' || $mh_impact_options['color_5'] != '#343232' || $mh_impact_options['color_6'] != '#1f1e1e') : ?>
		<style type="text/css">
    		<?php if ($mh_impact_options['color_1'] != '#6acab9') { ?>
    			.sb-widget .widget-title, .action-widget, .pricing-table-price, .map-widget:hover .gmap-embed, .comment-section-title, input[type=submit], table th, .pagination .current, .pagination a.page-numbers:hover, .dots:hover, .pagination .pagelink, .pagination a:hover .pagelink, .flexslider { background: <?php echo $mh_impact_options['color_1']; ?>; }
				.main-nav .current-menu-item a, .entry-tags .fa, .entry-meta .fa, .action-widget .button:hover, .pages-widget-item:hover a { color: <?php echo $mh_impact_options['color_1']; ?>; }
				.main-nav .current-menu-item, .main-nav ul .current-menu-item, .commentlist .depth-1, .commentlist .bypostauthor .avatar, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover, .pages-widget-item:hover img { border-color: <?php echo $mh_impact_options['color_1']; ?>; }
				@media only screen and (max-width: 1024px) {
					.page-title, .entry-title { background: <?php echo $mh_impact_options['color_1']; ?>; }
				}
			<?php } ?>
			<?php if ($mh_impact_options['color_2'] != '#55b2a2') { ?>
				.pricing-table-title { background: <?php echo $mh_impact_options['color_2']; ?>; }
				a:hover, .entry-content a, .entry-meta a:hover, .entry-tags a:hover, .post-nav-wrap li a:hover, blockquote { color: <?php echo $mh_impact_options['color_2']; ?>; }
				blockquote { border-color: <?php echo $mh_impact_options['color_2']; ?>; }
				.sb-widget .widget-title:before, .comment-section-title:before { border-color: <?php echo $mh_impact_options['color_2']; ?> #fff; }
				@media only screen and (max-width: 420px) {
					.slide-caption { background: <?php echo $mh_impact_options['color_2']; ?>; }
				}
			<?php } ?>
			<?php if ($mh_impact_options['color_3'] != '#e64b3e') { ?>
				.main-nav ul li:hover > ul, .main-nav ul ul li a:hover, .slicknav_menu, .mh-header-top, .buttons-widget-text, .blog-widget { background: <?php echo $mh_impact_options['color_3']; ?>; }
				.main-nav li:hover a, .social-menu-container li a, .social-nav li a, [id*='slider-'] .flex-direction-nav a  { color: <?php echo $mh_impact_options['color_3']; ?>; }
				.main-nav li:hover, .main-nav ul ul { border-color: <?php echo $mh_impact_options['color_3']; ?>; }
			<?php } ?>
			<?php if ($mh_impact_options['color_4'] != '#c41d17') { ?>
				.buttons-widget-item:hover, .blog-widget li:hover, .blog-widget-thumb, .slicknav_nav li:hover { background: <?php echo $mh_impact_options['color_4']; ?>; }
				.social-nav li:hover a  { color: <?php echo $mh_impact_options['color_4']; ?>; }
				.blog-widget-thumb { border-color: <?php echo $mh_impact_options['color_4']; ?>; }
			<?php } ?>
			<?php if ($mh_impact_options['color_5'] != '#343232') { ?>
				#prefooter, .footer-widget ul .cat-item:hover, .footer-widget ul .menu-item:hover, .footer-widget ul .page_item:hover { background: <?php echo $mh_impact_options['color_5']; ?>; }
			<?php } ?>
			<?php if ($mh_impact_options['color_6'] != '#1f1e1e') { ?>
				.buttons-widget-item, .copyright, .footer-widget { background: <?php echo $mh_impact_options['color_6']; ?>; }
			<?php } ?>
		</style>
		<?php
	endif;
}
add_action('wp_head', 'mh_impact_custom_css');

?>