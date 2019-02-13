<?php

/***** Register Widgets *****/

function mh_elegance_register_widgets() {
	register_widget('mh_elegance_news_widget');
	register_widget('mh_elegance_authors_widget');
	register_widget('mh_elegance_comments_widget');
	register_widget('mh_elegance_facebook_page');
	register_widget('mh_elegance_youtube');
}
add_action('widgets_init', 'mh_elegance_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-news-widget.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-comments.php');
require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-youtube.php');

?>