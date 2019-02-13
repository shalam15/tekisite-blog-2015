<?php /* Template used for featured content */
$mh_cicero_options = mh_cicero_theme_options();
if (!$mh_cicero_options['featured_content']) {
	$featured_content = mh_cicero_get_featured_content();
	if (empty($featured_content) && current_user_can('edit_theme_options')) { ?>
		<p class="featured-content-empty content-margin">
			<?php esc_html_e('There is no featured content, please tag posts with the tag that you have set in your WordPress dashboard under "Appearance => Customize => Featured Content".', 'mh-cicero'); ?>
		</p><?php
	} elseif (!empty($featured_content)) {
		add_filter('excerpt_length', 'mh_cicero_featured_excerpt_length'); ?>
		<div id="featured-content" class="flexslider clearfix">
			<ul class="slides"><?php
				foreach ((array) $featured_content as $order => $post) :
					setup_postdata($post);
					get_template_part('content', 'featured');
				endforeach;
				wp_reset_postdata(); ?>
			</ul>
		</div><?php
		remove_filter('excerpt_length', 'mh_cicero_featured_excerpt_length');
	}
} ?>