<?php

/***** Add Custom Color Options to Customizer *****/

function mh_elegance_color_options($wp_customize) {

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_elegance_options[color_1]', array('default' => '#252336', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_elegance_options[color_2]', array('default' => '#be2844', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
	$wp_customize->add_setting('mh_elegance_options[color_3]', array('default' => '#8a8f97', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    /***** Add Controls *****/

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-elegance'), 1), 'section' => 'colors', 'settings' => 'mh_elegance_options[color_1]', 'priority' => 50)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-elegance'), 2), 'section' => 'colors', 'settings' => 'mh_elegance_options[color_2]', 'priority' => 51)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_3', array('label' => sprintf(esc_html_x('Theme Color %d', 'options panel', 'mh-elegance'), 3), 'section' => 'colors', 'settings' => 'mh_elegance_options[color_3]', 'priority' => 52)));

}
add_action('customize_register', 'mh_elegance_color_options');

/***** Default Custom Colors *****/

if (!function_exists('mh_elegance_custom_colors')) {
	function mh_elegance_custom_colors() {
		$custom_colors = wp_parse_args(
			get_option('mh_elegance_options', array()),
			mh_elegance_default_colors()
		);
		return $custom_colors;
	}
}

if (!function_exists('mh_elegance_default_colors')) {
	function mh_elegance_default_colors() {
		$default_colors = array(
			'color_1' => '#252336',
			'color_2' => '#be2844',
			'color_3' => '#8a8f97'
		);
		return $default_colors;
	}
}

/***** Custom Colors CSS Output *****/

function mh_elegance_custom_colors_css() {
	$mh_elegance_colors = mh_elegance_custom_colors();
	if ($mh_elegance_colors['color_1'] != '#252336' || $mh_elegance_colors['color_2'] != '#be2844' || $mh_elegance_colors['color_3'] != '#8a8f97') {
	echo '<style type="text/css">' . "\n";
		if ($mh_elegance_colors['color_1'] != '#252336') {
    		echo '.mh-footer, .footer-widget, .footer-widget .widget-title { background: ' . $mh_elegance_colors['color_1'] . '; }' . "\n";
    	}
    	if ($mh_elegance_colors['color_2'] != '#be2844') {
    		echo '.main-nav ul li:hover > ul, .footer-nav ul li:hover > ul, .slicknav_menu, .page-numbers:hover, .current, a:hover .pagelink, .pagelink, table th, .button, #cancel-comment-reply-link:hover, input[type=submit], #searchsubmit:hover { background: ' . $mh_elegance_colors['color_2'] . '; }' . "\n";
			echo 'a:hover, .main-nav ul li a:hover, .main-nav ul .current-menu-item > a, .loop-title a:hover, .entry-meta .fn:hover, .comment-info, .required, .news-item-title a:hover, .entry-content a { color: ' . $mh_elegance_colors['color_2'] . '; }' . "\n";
    		echo 'blockquote, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover { border-color: ' . $mh_elegance_colors['color_2'] . '; }' . "\n";
    	}
    	if ($mh_elegance_colors['color_3'] != '#8a8f97') {
    		echo '.footer-widgets { background: ' . $mh_elegance_colors['color_3'] . '; }' . "\n";
    	}
	echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_elegance_custom_colors_css');

?>