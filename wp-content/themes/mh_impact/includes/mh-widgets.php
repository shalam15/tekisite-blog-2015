<?php

/***** Register Widgets *****/

function mh_impact_register_widgets() {
	register_widget('mh_impact_action_widget');
	register_widget('mh_impact_pages_widget');
	register_widget('mh_impact_blog_widget');
	register_widget('mh_impact_pricing_widget');
	register_widget('mh_impact_buttons_widget');
	register_widget('mh_impact_map_widget');
	register_widget('mh_impact_recent_posts');
	register_widget('mh_impact_slider_widget');
	register_widget('mh_impact_custom_slider_widget');
	register_widget('mh_impact_facebook_page');
	register_widget('mh_impact_youtube');
}
add_action('widgets_init', 'mh_impact_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-action.php');
require_once('widgets/mh-pages.php');
require_once('widgets/mh-blog.php');
require_once('widgets/mh-pricing.php');
require_once('widgets/mh-buttons.php');
require_once('widgets/mh-map.php');
require_once('widgets/mh-recent-posts.php');
require_once('widgets/mh-slider.php');
require_once('widgets/mh-custom-slider.php');
require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-youtube.php');

?>