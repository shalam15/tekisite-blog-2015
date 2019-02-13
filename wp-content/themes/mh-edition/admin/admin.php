<?php

/***** Theme Info Page *****/

if (!function_exists('mh_edition_add_theme_info_page')) {
	function mh_edition_add_theme_info_page() {
		add_theme_page(__('Welcome to MH Edition', 'mh-edition'), __('Theme Info', 'mh-edition'), 'edit_theme_options', 'edition', 'mh_edition_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_edition_add_theme_info_page');

if (!function_exists('mh_edition_display_theme_info_page')) {
	function mh_edition_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(__('Welcome to %1s %2s', 'mh-edition'), $theme_data->Name, $theme_data->Version); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div class="theme-links clearfix">
				<p>
					<strong><?php _e('Important Links:', 'mh-edition'); ?></strong>
					<a href="<?php echo esc_url('https://www.mhthemes.com/themes/mh/edition/'); ?>" target="_blank"><?php _e('Theme Info Page', 'mh-edition'); ?></a>
					<a href="<?php echo esc_url('https://www.mhthemes.com/support/'); ?>" target="_blank"><?php _e('Support Center', 'mh-edition'); ?></a>
					<a href="<?php echo esc_url('https://www.facebook.com/MHthemes'); ?>" target="_blank"><?php _e('Facebook', 'mh-edition'); ?></a>
					<a href="<?php echo esc_url('https://twitter.com/MHthemes'); ?>" target="_blank"><?php _e('Twitter', 'mh-edition'); ?></a>
					<a href="<?php echo esc_url('https://www.youtube.com/user/MHthemesEN'); ?>" target="_blank"><?php _e('YouTube', 'mh-edition'); ?></a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(__('Getting Started with %s', 'mh-edition'), $theme_data->Name); ?></h3>
				<div class="mh-row clearfix">
					<div class="mh-col-1-2">
						<div class="section">
							<h4><?php _e('Theme Documentation', 'mh-edition'); ?></h4>
							<p class="about"><?php printf(__('Need support to setup and configure %s? Please have a look at the instructions in the theme documentation or register at our support forums when you click on "Support" in your MH Themes account.', 'mh-edition'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/documentation-mh-edition/'); ?>" target="_blank" class="button button-secondary"><?php _e('Visit Documentation', 'mh-edition'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Theme Options', 'mh-edition'); ?></h4>
							<p class="about"><?php printf(__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'mh-edition'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Customize Theme', 'mh-edition'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Upgrade to MH Themes Bundle', 'mh-edition'); ?></h4>
							<p class="about"><?php _e('Do you want to have access to all Premium WordPress Themes by MH Themes including support and lifetime updates? You can upgrade to the MH Themes Bundle right away when you click on "Shop" in your MH Themes account.', 'mh-edition'); ?></p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/members/login/'); ?>" target="_blank" class="button button-secondary"><?php _e('Login to MH Themes account', 'mh-edition'); ?></a>
							</p>
						</div>
					</div>
					<div class="mh-col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php _e('Theme Screenshot', 'mh-edition'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(__('%1s WordPress theme is proudly brought to you by %2s.', 'mh-edition'), $theme_data->Name, '<a target="_blank" href="https://www.mhthemes.com/" title="MH Themes">MH Themes</a>'); ?></p>
			</div>
		</div> <?php
	}
}

/***** Add Admin Notice *****/

if (!function_exists('mh_edition_admin_notice')) {
	function mh_edition_admin_notice() {
		global $pagenow;
		if (current_user_can('edit_theme_options') && $pagenow == 'index.php') {
    		$theme_data = wp_get_theme(); ?>
			<div class="updated">
        		<p><?php printf(__('Thanks for using %1s by MH Themes. To learn more about this theme, please %1s.', 'mh-edition'), '<strong>' . $theme_data->Name . ' WordPress Theme</strong>', '<a href="' . admin_url('themes.php?page=edition') . '"><strong>' . __('click here', 'mh-edition') . '</strong></a>'); ?></p>
			</div><?php
		}
	}
}
add_action('admin_notices', 'mh_edition_admin_notice');

/***** Additional Fields User Profiles *****/

if (!function_exists('mh_user_profile')) {
    function mh_user_profile($mh_usercontact) {
        $array_mh_usercontact = array('facebook' => 'Facebook', 'twitter' => 'Twitter', 'googleplus' => 'Google+', 'youtube' => 'YouTube');
        $array_mh_usercontact = array_merge($mh_usercontact, $array_mh_usercontact);
        return $array_mh_usercontact;
    }
    add_filter('user_contactmethods', 'mh_user_profile');
}

?>