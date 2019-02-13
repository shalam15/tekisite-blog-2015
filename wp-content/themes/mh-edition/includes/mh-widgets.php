<?php

/***** Register Widgets *****/

function mh_edition_register_widgets() {
	register_widget('mh_edition_facebook_page');
	register_widget('mh_edition_custom_posts');
	register_widget('mh_edition_custom_pages');
	register_widget('mh_edition_posts_grid');
	register_widget('mh_edition_posts_large');
	register_widget('mh_edition_posts_list');
	register_widget('mh_edition_nip');
	register_widget('mh_edition_recent_comments');
	register_widget('mh_edition_slider');
	register_widget('mh_edition_custom_slider');
	register_widget('mh_edition_spotlight');
	register_widget('mh_edition_carousel');
	register_widget('mh_edition_authors');
	register_widget('mh_edition_social');
	register_widget('mh_edition_author_bio');
	register_widget('mh_edition_youtube');
	register_widget('mh_edition_tabbed');
}
add_action('widgets_init', 'mh_edition_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-custom-pages.php');
require_once('widgets/mh-posts-grid.php');
require_once('widgets/mh-posts-large.php');
require_once('widgets/mh-posts-list.php');
require_once('widgets/mh-nip.php');
require_once('widgets/mh-recent-comments.php');
require_once('widgets/mh-slider.php');
require_once('widgets/mh-custom-slider.php');
require_once('widgets/mh-spotlight.php');
require_once('widgets/mh-carousel.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-social.php');
require_once('widgets/mh-author-bio.php');
require_once('widgets/mh-youtube.php');
require_once('widgets/mh-tabbed.php');

?>