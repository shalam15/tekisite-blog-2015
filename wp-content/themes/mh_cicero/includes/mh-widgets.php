<?php

/***** Register Widgets *****/

function mh_cicero_register_widgets() {
	register_widget('mh_cicero_custom_posts_widget');
	register_widget('mh_cicero_authors_widget');
	register_widget('mh_cicero_author_bio_widget');
	register_widget('mh_cicero_comments_widget');
	register_widget('mh_cicero_facebook_page');
	register_widget('mh_cicero_youtube');
}
add_action('widgets_init', 'mh_cicero_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-authors.php');
require_once('widgets/mh-author-bio.php');
require_once('widgets/mh-comments.php');
require_once('widgets/mh-facebook-page.php');
require_once('widgets/mh-youtube.php');

?>