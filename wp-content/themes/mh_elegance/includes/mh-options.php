<?php

function mh_elegance_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

	class MH_Customize_Image_Control extends WP_Customize_Image_Control {
    	public $extensions = array('jpg', 'jpeg', 'gif', 'png', 'ico');
	}

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'mh-elegance'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_general', array('title' => esc_html__('General', 'mh-elegance'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_layout', array('title' => esc_html__('Layout', 'mh-elegance'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_content', array('title' => esc_html__('Posts/Pages', 'mh-elegance'), 'priority' => 4, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_css', array('title' => esc_html__('Custom CSS', 'mh-elegance'), 'priority' => 5, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_tracking', array('title' => esc_html__('Tracking Code', 'mh-elegance'), 'priority' => 6, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

	$wp_customize->add_setting('mh_elegance_options[footer_logo]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_setting('mh_elegance_options[excerpt_length]', array('default' => 50, 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_integer'));
    $wp_customize->add_setting('mh_elegance_options[excerpt_more]', array('default' => esc_html__('Read More', 'mh-elegance'), 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_text'));
	$wp_customize->add_setting('mh_elegance_options[copyright]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_text'));

	$wp_customize->add_setting('mh_elegance_options[social_sharing]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_select'));
    $wp_customize->add_setting('mh_elegance_options[author_box]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_select'));
    $wp_customize->add_setting('mh_elegance_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_select'));

    $wp_customize->add_setting('mh_elegance_options[featured_image]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_select'));
    $wp_customize->add_setting('mh_elegance_options[post_nav]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_select'));
	$wp_customize->add_setting('mh_elegance_options[post_meta_header]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_setting('mh_elegance_options[post_meta_date]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_checkbox'));
    $wp_customize->add_setting('mh_elegance_options[post_meta_author]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_checkbox'));
    $wp_customize->add_setting('mh_elegance_options[post_meta_cat]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_checkbox'));
    $wp_customize->add_setting('mh_elegance_options[post_meta_comments]', array('default' => 0, 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_checkbox'));

	$wp_customize->add_setting('mh_elegance_options[custom_css]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_textarea'));
	$wp_customize->add_setting('mh_elegance_options[tracking_code]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'mh_elegance_sanitize_textarea'));

    /***** Add Controls *****/

	$wp_customize->add_control(new MH_Customize_Image_Control($wp_customize, 'footer_logo', array('label' => esc_html__('Footer Logo', 'mh-elegance'), 'section' => 'mh_general', 'settings' => 'mh_elegance_options[footer_logo]', 'priority' => 1)));
    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-elegance'), 'section' => 'mh_general', 'settings' => 'mh_elegance_options[excerpt_length]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-elegance'), 'section' => 'mh_general', 'settings' => 'mh_elegance_options[excerpt_more]', 'priority' => 3, 'type' => 'text'));
    $wp_customize->add_control('copyright', array('label' => esc_html__('Copyright Text', 'mh-elegance'), 'section' => 'mh_general', 'settings' => 'mh_elegance_options[copyright]', 'priority' => 4, 'type' => 'text'));

	$wp_customize->add_control('social_sharing', array('label' => esc_html__('Sharing Buttons', 'mh-elegance'), 'section' => 'mh_layout', 'settings' => 'mh_elegance_options[social_sharing]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mh-elegance'), 'disable' => __('Disable', 'mh-elegance'))));
    $wp_customize->add_control('author_box', array('label' => esc_html__('Author Box', 'mh-elegance'), 'section' => 'mh_layout', 'settings' => 'mh_elegance_options[author_box]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mh-elegance'), 'disable' => __('Disable', 'mh-elegance'))));
    $wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'mh-elegance'), 'section' => 'mh_layout', 'settings' => 'mh_elegance_options[sidebar]', 'priority' => 3, 'type' => 'select', 'choices' => array('right' => __('Right Sidebar', 'mh-elegance'), 'left' => __('Left Sidebar', 'mh-elegance'))));

    $wp_customize->add_control('featured_image', array('label' => esc_html__('Featured Image on Posts', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[featured_image]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mh-elegance'), 'disable' => __('Disable', 'mh-elegance'))));
    $wp_customize->add_control('post_nav', array('label' => esc_html__('Post/Attachment Navigation', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_nav]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => __('Enable', 'mh-elegance'), 'disable' => __('Disable', 'mh-elegance'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'post_meta_header', array('label' => __('Disable Post Meta Data', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_meta_header]', 'priority' => 4)));
    $wp_customize->add_control('post_meta_date', array('label' => esc_html__('Disable Date', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_meta_date]', 'priority' => 5, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_author', array('label' => esc_html__('Disable Author', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_meta_author]', 'priority' => 6, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_cat', array('label' => esc_html__('Disable Categories', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_meta_cat]', 'priority' => 7, 'type' => 'checkbox'));
    $wp_customize->add_control('post_meta_comments', array('label' => esc_html__('Disable Comments', 'mh-elegance'), 'section' => 'mh_content', 'settings' => 'mh_elegance_options[post_meta_comments]', 'priority' => 8, 'type' => 'checkbox'));

	$wp_customize->add_control('custom_css', array('label' => '', 'description' => esc_html__('Add your custom CSS code here:', 'mh-elegance'), 'section' => 'mh_css', 'settings' => 'mh_elegance_options[custom_css]', 'priority' => 1, 'type' => 'textarea'));
    $wp_customize->add_control('tracking_code', array('label' => esc_html__('Tracking Code (e.g. Google Analytics)', 'mh-elegance'), 'section' => 'mh_tracking', 'settings' => 'mh_elegance_options[tracking_code]', 'priority' => 1, 'type' => 'textarea'));

}
add_action('customize_register', 'mh_elegance_customize_register');

/***** Data Sanitization *****/

function mh_elegance_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_elegance_sanitize_textarea($input) {
    if (current_user_can('unfiltered_html')) {
		return $input;
    } else {
		return stripslashes(wp_filter_post_kses(addslashes($input)));
    }
}
function mh_elegance_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_elegance_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_elegance_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-elegance'),
        'disable' => esc_html__('Disable', 'mh-elegance'),
        'right' => esc_html__('Right Sidebar', 'mh-elegance'),
        'left' => esc_html__('Left Sidebar', 'mh-elegance')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_elegance_theme_options')) {
	function mh_elegance_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_elegance_options', array()),
			mh_elegance_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_elegance_default_options')) {
	function mh_elegance_default_options() {
		$default_options = array(
			'footer_logo' => '',
			'excerpt_length' => 50,
			'excerpt_more' => esc_html__('Read More', 'mh-elegance'),
			'copyright' => '',
			'social_sharing' => 'enable',
			'author_box' => 'enable',
			'sidebar' => 'right',
			'featured_image' => 'enable',
			'post_nav' => 'enable',
			'post_meta_date' => 0,
			'post_meta_author' => 0,
			'post_meta_cat' => 0,
			'post_meta_comments' => 0,
			'custom_css' => '',
			'tracking_code' => ''
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_elegance_customizer_css() {
	wp_enqueue_style('mh-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_elegance_customizer_css');

/***** Custom CSS Output *****/

function mh_elegance_custom_css() {
	$mh_elegance_options = mh_elegance_theme_options();
	if ($mh_elegance_options['custom_css']) {
    	echo '<style type="text/css">';
    		echo $mh_elegance_options['custom_css'];
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_elegance_custom_css');

?>