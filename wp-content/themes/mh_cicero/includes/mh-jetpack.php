<?php

/***** Add Support for Infinite Scroll *****/

function mh_cicero_infinite_scroll_init() {
	add_theme_support('infinite-scroll', array(
    	'container' 		=> 'main-content',
    	'footer'			=> 'mh-footer',
		'render'   			=> 'mh_infinite_scroll_render',
	));
}
add_action('after_setup_theme', 'mh_cicero_infinite_scroll_init');

if (!function_exists('mh_cicero_infinite_scroll_render')) {
	function mh_cicero_infinite_scroll_render() {
		while (have_posts()) {
			the_post();
			get_template_part('content');
		}
	}
}

?>