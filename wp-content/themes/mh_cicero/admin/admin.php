<?php

/***** Custom Dashboard Widget *****/

function mh_cicero_info_widget() {
	$theme_data = wp_get_theme();
	echo '<div class="admin-theme-thumb"><img src="' . get_template_directory_uri() . '/images/MH_Cicero_Thumb.png" /></div><p>Thank you very much for purchasing <strong>' . $theme_data->Name . ' WordPress Theme</strong>. If you are looking for the theme documentation, need help with the theme setup or have any questions, please visit our <a href="' . esc_url('https://www.mhthemes.com/support/') . '" target="_blank"><strong>support center</strong></a>. In case you need personal theme support, you can access our <a href="' . esc_url('https://www.mhthemes.com/members/helpdesk/') . '" target="_blank"><strong>helpdesk</strong></a> and open a support ticket. We usually answer within 24 hours.</p>';
}

function mh_cicero_dashboard_widgets() {
	if (current_user_can('edit_dashboard')) {
		global $wp_meta_boxes;
		add_meta_box('mh_info_widget', 'Theme Support', 'mh_cicero_info_widget', 'dashboard', 'normal', 'high');
	}
}
add_action('wp_dashboard_setup', 'mh_cicero_dashboard_widgets');

?>