<?php

/***** Add Custom Color Options to Customizer *****/

function mh_edition_color_options($wp_customize) {

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_edition_options[color_1]', array('default' => '#38b7ee', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_setting('mh_edition_options[color_2]', array('default' => '#ffffff', 'type' => 'option', 'sanitize_callback' => 'sanitize_hex_color'));

    /***** Add Controls *****/

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_1', array('label' => esc_html_x('Theme Color', 'options panel', 'mh-edition'), 'section' => 'colors', 'settings' => 'mh_edition_options[color_1]', 'priority' => 50)));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_2', array('label' => esc_html_x('Text on Colored Elements', 'options panel', 'mh-edition'), 'section' => 'colors', 'settings' => 'mh_edition_options[color_2]', 'priority' => 51)));

}
add_action('customize_register', 'mh_edition_color_options');

/***** Default Custom Colors *****/

if (!function_exists('mh_edition_custom_colors')) {
	function mh_edition_custom_colors() {
		$custom_colors = wp_parse_args(
			get_option('mh_edition_options', array()),
			mh_edition_default_colors()
		);
		return $custom_colors;
	}
}

if (!function_exists('mh_edition_default_colors')) {
	function mh_edition_default_colors() {
		$default_colors = array(
			'color_1' => '#38b7ee',
			'color_2' => '#ffffff'
		);
		return $default_colors;
	}
}

/***** Custom Colors CSS Output *****/

function mh_edition_custom_colors_css() {
	$mh_edition_colors = mh_edition_custom_colors();
	$mh_edition_hex = $mh_edition_colors['color_1'];
	list($mh_edition_hex_red, $mh_edition_hex_green, $mh_edition_hex_blue) = sscanf($mh_edition_hex, "#%02x%02x%02x");
	if ($mh_edition_colors['color_1'] != '#38b7ee'|| $mh_edition_colors['color_2'] != '#ffffff') {
    	echo '<style type="text/css">' . "\n";
			if ($mh_edition_colors['color_1'] != '#38b7ee') {
				echo '.mh-subheader, .mh-footer-nav, .mh-footer-nav ul ul li:hover, .slicknav_btn, .slicknav_menu, .slicknav_nav .slicknav_item:hover, .slicknav_nav a:hover, .mh-excerpt-more, .entry-tags .fa, .page-numbers:hover, .current, a:hover .pagelink, .pagelink, .mh-comment-meta-links .comment-reply-link, .mh-comment-meta-links .comment-edit-link, #cancel-comment-reply-link, .required, input[type=submit], .mh-back-to-top, #infinite-handle span, .mh-slider-widget .flex-control-paging li a.flex-active, .mh-slider-widget .flex-control-paging li a.flex-active:hover, .mh-footer-widget .mh-slider-content .mh-excerpt-more, .mh-carousel-widget .flex-direction-nav a, .mh-spotlight-widget, .mh_edition_author_bio, .mh-social-widget li:hover a, .mh-footer-widget .mh-social-widget li a, .mh-tab-button.active, .tagcloud a:hover, .mh-widget .tagcloud a:hover, .mh-footer-widget .tagcloud a:hover { background: ' . $mh_edition_colors['color_1'] . '; }' . "\n";
				echo 'a:hover, .mh-header-tagline, .mh-breadcrumb a:hover, .mh-meta a:hover, .mh-footer .mh-meta a:hover, .entry-content a, .mh-footer a:hover, .mh-copyright a, .mh-comment-info, .mh-slider-content .mh-excerpt-more, .mh-spotlight-widget .mh-excerpt-more, .mh-footer-widget .mh-spotlight-widget .mh-excerpt-more, .mh-footer-widget .mh-slider-title:hover, .mh-tabbed-widget li a:hover, .mh-posts-grid-title a:hover, .mh-custom-posts-xl-title a:hover, .mh-footer-widget .mh-posts-list-title a:hover, .mh-author-box a:hover { color: ' . $mh_edition_colors['color_1'] . '; }' . "\n";
				echo 'blockquote, .bypostauthor .mh-comment-meta, input[type=text]:hover, input[type=email]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover, .mh-footer-widget-title, .mh-tab-buttons { border-color: ' . $mh_edition_colors['color_1'] . '; }' . "\n";
				echo '.mh-slider-caption, .mh-carousel-caption, .mh-spotlight-caption, .mh-posts-large-caption, .mh-nip-item:hover .mh-nip-overlay { background: ' . $mh_edition_colors['color_1'] . '; background: rgba( ' . $mh_edition_hex_red . ',' . $mh_edition_hex_green . ',' . $mh_edition_hex_blue . ', 0.8); }' . "\n";
				echo '.mh-widget-col-1 .mh-slider-caption, .mh-home-2 .mh-slider-caption, .mh-home-5 .mh-slider-caption { background: rgba(' . $mh_edition_hex_red . ',' . $mh_edition_hex_green . ',' . $mh_edition_hex_blue . ', 1); }' . "\n";
				echo '@media screen and (max-width: 900px) { .mh-slider-caption { background: rgba(' . $mh_edition_hex_red . ',' . $mh_edition_hex_green . ',' . $mh_edition_hex_blue . ', 1); } }' . "\n";
			}
			if ($mh_edition_colors['color_2'] != '#ffffff') {
				echo '.slicknav_menu .slicknav_icon-bar { background-color: ' . $mh_edition_colors['color_2'] . '; }' . "\n";
				echo '.slicknav_menu .slicknav_menutxt, .slicknav_nav a, .slicknav_nav a:hover, .slicknav_nav .slicknav_arrow, .mh-ticker-title, #mh-ticker-loop a, .mh-slider-title, .mh-slider-content, .mh-carousel-caption, .mh-footer-widget .mh-slider-content .mh-excerpt-more, .mh-posts-large-caption, .mh-spotlight-caption, .mh-spotlight-title a, .mh-spotlight-title a:hover, .mh-spotlight-meta, .mh-spotlight-meta a, .mh-spotlight-meta a:hover, .mh-footer-widget .mh-spotlight-meta a, .mh-footer-widget .mh-spotlight-meta a:hover, .mh-spotlight-content, .mh-footer-widget .mh-spotlight-title a:hover, .mh-author-bio-widget .mh-author-bio, .mh_edition_author_bio .mh-widget-title, .mh_edition_author_bio .mh-footer-widget-title, .mh-social-widget .fa-mh-social, .mh-tab-button.active, .mh-footer-widget .mh-tab-button.active, .mh-carousel-widget .flex-direction-nav a::before, .tagcloud a:hover, .mh-footer-widget .tagcloud a:hover, .mh-back-to-top, .mh-back-to-top:hover, .mh-footer-nav li a, .mh-excerpt-more, .mh-footer-widget .mh-excerpt-more, .entry-tags, .mh-comment-meta-links .comment-reply-link, .mh-comment-meta-links .comment-edit-link, input[type="submit"], .page-numbers:hover, .current, a:hover .pagelink, .pagelink { color: ' . $mh_edition_colors['color_2'] . '; }' . "\n";
				echo '.slicknav_nav ul, .mh-ticker-title, .mh_edition_author_bio .mh-widget-title, .mh_edition_author_bio .mh-footer-widget-title { border-color: ' . $mh_edition_colors['color_2'] . '; }' . "\n";
			}
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'mh_edition_custom_colors_css');

?>