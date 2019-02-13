<?php

/***** Register Widgets *****/

function mh_squared_register_widgets() {
	register_widget('mh_squared_custom_posts');
	register_widget('mh_squared_posts_grid');
	register_widget('mh_squared_posts_large');
	register_widget('mh_squared_custom_pages');
	register_widget('mh_squared_facebook_page');
	register_widget('mh_squared_comments');
	register_widget('mh_squared_youtube_video');
	register_widget('mh_squared_authors');
	register_widget('mh_squared_slider');
}
add_action('widgets_init', 'mh_squared_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-posts-grid.php');
require_once('widgets/mh-posts-large.php');
require_once('widgets/mh-custom-pages.php');
require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-comments.php');
require_once('widgets/mh-youtube-video.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-slider.php');

?>