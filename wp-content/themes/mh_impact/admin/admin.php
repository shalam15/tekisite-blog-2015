<?php

/***** Theme Info Page *****/

if (!function_exists('mh_impact_add_theme_info_page')) {
	function mh_impact_add_theme_info_page() {
		add_theme_page(esc_html__('Welcome to MH Impact', 'mh-impact'), esc_html__('Theme Info', 'mh-impact'), 'edit_theme_options', 'impact', 'mh_impact_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_impact_add_theme_info_page');

if (!function_exists('mh_impact_display_theme_info_page')) {
	function mh_impact_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1>
				<?php printf(esc_html__('Welcome to %1s %2s', 'mh-impact'), $theme_data->Name, $theme_data->Version); ?>
			</h1>
			<div class="theme-description">
				<?php echo $theme_data->Description; ?>
			</div>
			<hr>
			<div class="theme-links clearfix">
				<p>
					<strong><?php esc_html_e('Important Links:', 'mh-impact'); ?></strong>
					<a href="<?php echo esc_url('https://www.mhthemes.com/themes/mh/impact/'); ?>" target="_blank">
						<?php esc_html_e('Theme Info Page', 'mh-impact'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.mhthemes.com/support/'); ?>" target="_blank">
						<?php esc_html_e('Support Center', 'mh-impact'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.facebook.com/MHthemes'); ?>" target="_blank">
						<?php esc_html_e('Facebook', 'mh-impact'); ?>
					</a>
					<a href="<?php echo esc_url('https://twitter.com/MHthemes'); ?>" target="_blank">
						<?php esc_html_e('Twitter', 'mh-impact'); ?>
					</a>
					<a href="<?php echo esc_url('https://www.youtube.com/user/MHthemesEN'); ?>" target="_blank">
						<?php esc_html_e('YouTube', 'mh-impact'); ?>
					</a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3>
					<?php printf(esc_html__('Getting Started with %s', 'mh-impact'), $theme_data->Name); ?>
				</h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4>
								<?php esc_html_e('Theme Documentation', 'mh-impact'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('Need support to setup and configure %s? Please have a look at the instructions in the theme documentation or register at our support forums when you click on "Support" in your MH Themes account.', 'mh-impact'), $theme_data->Name); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/support/documentation-mh-impact/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Visit Documentation', 'mh-impact'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<?php esc_html_e('Theme Options', 'mh-impact'); ?>
							</h4>
							<p class="about">
								<?php printf(esc_html__('%s WordPress theme supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'mh-impact'), $theme_data->Name); ?>
							</p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary">
									<?php esc_html_e('Customize Theme', 'mh-impact'); ?>
								</a>
							</p>
						</div>
						<div class="section">
							<h4>
								<?php esc_html_e('Upgrade to MH Themes Bundle', 'mh-impact'); ?>
							</h4>
							<p class="about">
								<?php esc_html_e('Do you want to have access to all Premium WordPress Themes by MH Themes including support and lifetime updates? You can upgrade to the MH Themes Bundle right away when you click on "Shop" in your MH Themes account.', 'mh-impact'); ?>
							</p>
							<p>
								<a href="<?php echo esc_url('https://www.mhthemes.com/members/login/'); ?>" target="_blank" class="button button-secondary">
									<?php esc_html_e('Login to MH Themes account', 'mh-impact'); ?>
								</a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_html_e('Theme Screenshot', 'mh-impact'); ?>" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(esc_html__('%1s WordPress theme is proudly brought to you by %2s.', 'mh-impact'), $theme_data->Name, '<a target="_blank" href="https://www.mhthemes.com/" title="MH Themes">MH Themes</a>'); ?></p>
			</div>
		</div> <?php
	}
}

/***** Add Admin Notice *****/

if (!function_exists('mh_impact_admin_notice')) {
	function mh_impact_admin_notice() {
		global $pagenow;
		if (current_user_can('edit_theme_options') && $pagenow == 'index.php') {
    		$theme_data = wp_get_theme(); ?>
			<div class="updated">
        		<p><?php printf(esc_html__('Thanks for using %1s by MH Themes. To learn more about this theme, please %1s.', 'mh-impact'), '<strong>' . $theme_data->Name . ' WordPress Theme</strong>', '<a href="' . admin_url('themes.php?page=impact') . '"><strong>' . esc_html__('click here', 'mh-impact') . '</strong></a>'); ?></p>
			</div><?php
		}
	}
}
add_action('admin_notices', 'mh_impact_admin_notice');

?>