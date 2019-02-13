<?php

/***** Custom Meta Boxes *****/

if (!function_exists('mh_elegance_add_meta_boxes')) {
	function mh_elegance_add_meta_boxes() {
		$screens = array('post', 'page');
		foreach ($screens as $screen) {
			add_meta_box('mh_elegance_header', __('Custom Header Options', 'mh-elegance'), 'mh_elegance_header_options', $screen, 'normal', 'high');
		}
	}
}
add_action('add_meta_boxes', 'mh_elegance_add_meta_boxes');

if (!function_exists('mh_elegance_header_options')) {
	function mh_elegance_header_options() {
		global $post;
		wp_nonce_field('mh_meta_box_nonce', 'meta_box_nonce');
		echo '<p>';
		echo '<label for="mh-header-title">' . __("Header Title", 'mh-elegance') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-header-title" id="mh-header-title" placeholder="Enter Custom Title" value="' . esc_attr(get_post_meta($post->ID, 'mh-header-title', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="mh-header-desc">' . __("Header Description", 'mh-elegance') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-header-desc" id="mh-header-desc" placeholder="Enter Custom Slogan" value="' . esc_attr(get_post_meta($post->ID, 'mh-header-desc', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="mh-header-button-text">' . __("Header Button Text", 'mh-elegance') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-header-button-text" id="mh-header-button-text" placeholder="Enter Custom Header Button Text" value="' . esc_attr(get_post_meta($post->ID, 'mh-header-button-text', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="mh-header-button-url">' . __("Header Button URL", 'mh-elegance') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-header-button-url" id="mh-header-button-url" placeholder="Enter Custom Button URL" value="' . esc_url(get_post_meta($post->ID, 'mh-header-button-url', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<label for="mh-header-text-color">' . __("Custom Color of Header Text", 'mh-elegance') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-header-text-color" id="mh-header-text-color" placeholder="Enter Custom HEX Value" value="' . esc_attr(get_post_meta($post->ID, 'mh-header-text-color', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<input type="checkbox" id="mh-header-bg" name="mh-header-bg"'; echo checked(get_post_meta($post->ID, 'mh-header-bg', true), 'on'); echo '/>';
		echo '<label for="mh-header-bg">' . __('Use Featured Image as Header Background', 'mh-elegance') . '</label>';
		echo '</p>';
	}
}

if (!function_exists('mh_elegance_save_meta_boxes')) {
	function mh_elegance_save_meta_boxes($post_id, $post) {
		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'mh_meta_box_nonce')) {
			return $post->ID;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        	return $post->ID;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post->ID;
			}
		}
		elseif (!current_user_can('edit_post', $post_id)) {
			return $post->ID;
		}
		if ('post' == $_POST['post_type'] || 'page' == $_POST['post_type']) {
			$meta_data['mh-header-title'] = esc_attr($_POST['mh-header-title']);
			$meta_data['mh-header-desc'] = esc_attr($_POST['mh-header-desc']);
			$meta_data['mh-header-button-text'] = esc_attr($_POST['mh-header-button-text']);
			$meta_data['mh-header-button-url'] = esc_url($_POST['mh-header-button-url']);
			$meta_data['mh-header-text-color'] = esc_attr($_POST['mh-header-text-color']);
			$meta_data['mh-header-bg'] = isset($_POST['mh-header-bg']) ? esc_attr($_POST['mh-header-bg']) : '';
		}
		foreach ($meta_data as $key => $value) {
			if ($post->post_type == 'revision') return;
			$value = implode(',', (array)$value);
			if (get_post_meta($post->ID, $key, FALSE)) {
				update_post_meta($post->ID, $key, $value);
			} else {
				add_post_meta($post->ID, $key, $value);
			}
			if (!$value) delete_post_meta($post->ID, $key);
		}
	}
}
add_action('save_post', 'mh_elegance_save_meta_boxes', 10, 2 );

/***** Custom Header Content Output *****/

if (!function_exists('mh_elegance_custom_header')) {
	function mh_elegance_custom_header() {
		if (is_singular()) {
			global $post;
			$header_title = get_post_meta($post->ID, "mh-header-title", true);
			$header_summary = get_post_meta($post->ID, "mh-header-desc", true);
			$header_button_text = get_post_meta($post->ID, "mh-header-button-text", true);
			$header_button_url = get_post_meta($post->ID, "mh-header-button-url", true);
			if ($header_title || $header_summary || $header_button_text) {
				echo '<section class="mh-custom-header"><div class="mh-container">' . "\n";
				if ($header_title) {
					echo '<h2 class="header-title">' . esc_attr($header_title) . '</h2>' . "\n";
				}
				if ($header_summary) {
					echo '<p class="header-summary">' . esc_attr($header_summary) . '</p>' . "\n";
				}
				if ($header_button_text) {
					echo '<a class="button button-header" href="' . esc_url($header_button_url) . '">' . esc_attr($header_button_text) . '</a>' . "\n";
				}
				echo '</div></section>' . "\n";
			}
	 	}
	}
}
add_action('mh_elegance_after_header', 'mh_elegance_custom_header');

/***** Custom Header Background *****/

if (!function_exists('mh_elegance_custom_header_css')) {
	function mh_elegance_custom_header_css() {
		if (is_singular()) {
			$object_id = get_queried_object_id();
			if (get_post_meta($object_id, 'mh-header-bg', true) || get_post_meta($object_id, 'mh-header-text-color', true)) {
				$before_css = '<style type="text/css">' . "\n";
				$after_css = '</style>' . "\n";
			} else {
				$before_css = '';
				$after_css = '';
			}
			echo $before_css;
			if (has_post_thumbnail($object_id) && get_post_meta($object_id, 'mh-header-bg', true)) {
				$bg_url = wp_get_attachment_url(get_post_thumbnail_id($object_id));
				echo 'body.custom-background { background-image: url("' . esc_url($bg_url) . '"); background-repeat: no-repeat; background-attachment: fixed; }';
			}
			if (get_post_meta($object_id, 'mh-header-text-color', true)) {
				$text_color = get_post_meta($object_id, 'mh-header-text-color', true);
				echo '.header-title, .header-summary { color: ' . esc_attr($text_color) . '; }';
			}
			echo $after_css;
		}
	}
}
add_action('wp_head', 'mh_elegance_custom_header_css', 11);

/***** Fallback for Custom Header *****/

if (!function_exists('mh_elegance_custom_header_fallback')) {
	function mh_elegance_custom_header_fallback($classes) {
		$background_color = get_background_color();
		if ($background_color == '252336') {
			$classes[] = 'custom-background';
			return $classes;
		} else {
			return $classes;
		}
	}
}
add_filter('body_class', 'mh_elegance_custom_header_fallback');

?>