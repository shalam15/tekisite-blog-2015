<?php

/***** Theme Info Page *****/

if (!function_exists('mh_purity_add_theme_info_page')) {
	function mh_purity_add_theme_info_page() {
		add_theme_page(esc_html__('Welcome to MH Purity', 'mhp'), esc_html__('Theme Info', 'mhp'), 'edit_theme_options', 'purity', 'mh_purity_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_purity_add_theme_info_page');

if (!function_exists('mh_purity_display_theme_info_page')) {
	function mh_purity_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(esc_html__('Welcome to %1s %2s', 'mhp'), $theme_data->Name, $theme_data->Version); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div class="theme-links clearfix">
				<p><strong><?php esc_html_e('Important Links:', 'mhp'); ?></strong>
					<a href="<?php echo esc_url('https://www.mhthemes.com/themes/mh/purity/'); ?>" target="_blank"><?php esc_html_e('Theme Info Page', 'mhp'); ?></a>
					<a href="<?php echo esc_url('https://www.mhthemes.com/support/'); ?>" target="_blank"><?php esc_html_e('Support Center', 'mhp'); ?></a>
					<a href="<?php echo esc_url('https://www.facebook.com/MHthemes'); ?>" target="_blank"><?php esc_html_e('Facebook', 'mhp'); ?></a>
					<a href="<?php echo esc_url('https://twitter.com/MHthemes'); ?>" target="_blank"><?php esc_html_e('Twitter', 'mhp'); ?></a>
					<a href="<?php echo esc_url('https://www.youtube.com/user/MHthemesEN'); ?>" target="_blank"><?php esc_html_e('YouTube', 'mhp'); ?></a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(esc_html__('Getting Started with %s', 'mhp'), $theme_data->Name); ?></h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4><?php esc_html_e('Theme Documentation', 'mhp'); ?></h4>
							<p class="about"><?php printf(esc_html__('Need support to setup and configure %s? Please have a look at the instructions in the theme documentation or register at our support forums when you click on "Support" in your MH Themes account.', 'mhp'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/documentation-mh-purity/'); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Visit Documentation', 'mhp'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php esc_html_e('Theme Options', 'mhp'); ?></h4>
							<p class="about"><?php printf(esc_html__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'mhp'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php esc_html_e('Customize Theme', 'mhp'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php esc_html_e('Upgrade to MH Themes Bundle', 'mhp'); ?></h4>
							<p class="about"><?php esc_html_e('Do you want to have access to all Premium WordPress Themes by MH Themes including support and lifetime updates? You can upgrade to the MH Themes Bundle right away when you click on "Shop" in your MH Themes account.', 'mhp'); ?></p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/members/login/'); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Login to MH Themes account', 'mhp'); ?></a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_html_e('Theme Screenshot', 'mhp'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(esc_html__('%1s WordPress theme is proudly brought to you by %2s.', 'mhp'), $theme_data->Name, '<a target="_blank" href="https://www.mhthemes.com/" title="MH Themes">MH Themes</a>'); ?></p>
			</div>
		</div> <?php
	}
}

/***** Add Admin Notice *****/

if (!function_exists('mh_purity_admin_notice')) {
	function mh_purity_admin_notice() {
		global $pagenow;
		if (current_user_can('edit_theme_options') && $pagenow == 'index.php') {
    		$theme_data = wp_get_theme(); ?>
			<div class="updated">
        		<p><?php printf(esc_html__('Thanks for using %1s by MH Themes. To learn more about this theme, please %1s.', 'mhp'), '<strong>' . $theme_data->Name . ' WordPress Theme</strong>', '<a href="' . admin_url('themes.php?page=purity') . '"><strong>' . esc_html__('click here', 'mhp') . '</strong></a>'); ?></p>
			</div><?php
		}
	}
}
add_action('admin_notices', 'mh_purity_admin_notice');

/***** Custom Meta Boxes *****/

if (!function_exists('mh_purity_add_meta_boxes')) {
	function mh_purity_add_meta_boxes() {
		add_meta_box('mh_post_details', esc_html__('Post Options', 'mhp'), 'mh_purity_post_options', 'post', 'normal', 'high');
	}
}
add_action('add_meta_boxes', 'mh_purity_add_meta_boxes');

if (!function_exists('mh_purity_post_options')) {
	function mh_purity_post_options() {
		global $post;
		wp_nonce_field('mh_meta_box_nonce', 'meta_box_nonce');
		echo '<p>';
		echo '<label for="mh-subheading">' . esc_html__("Subheading (will be displayed below post title)", 'mhp') . '</label>';
		echo '<br />';
		echo '<input class="widefat" type="text" name="mh-subheading" id="mh-subheading" placeholder="Enter subheading" value="' . esc_attr(get_post_meta($post->ID, 'mh-subheading', true)) . '" size="30" />';
		echo '</p>';
		echo '<p>';
		echo '<input type="checkbox" id="mh-no-image" name="mh-no-image"'; echo checked(get_post_meta($post->ID, 'mh-no-image', true), 'on'); echo '/>';
		echo '<label for="mh-no-image">' . esc_html__(' Disable featured image for this post', 'mhp') . '</label>';
		echo '</p>';
	}
}

if (!function_exists('mh_purity_save_meta_boxes')) {
	function mh_purity_save_meta_boxes($post_id, $post) {
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
		if ('post' == $_POST['post_type']) {
			$meta_data['mh-subheading'] = esc_attr($_POST['mh-subheading']);
			$meta_data['mh-no-image'] = isset($_POST['mh-no-image']) ? esc_attr($_POST['mh-no-image']) : '';
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
add_action('save_post', 'mh_purity_save_meta_boxes', 10, 2 );

?>