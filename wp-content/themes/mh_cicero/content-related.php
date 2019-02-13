<?php /* Template for related posts based on tags. */
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach ($tags as $tag) $tag_ids[] = $tag->term_id;
	$args = array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page' => 5, 'ignore_sticky_posts' => 1, 'orderby' => 'rand');
	$related = new wp_query($args);
	if ($related->have_posts()) { ?>
		<section class="related-posts content-background">
			<h4 class="related-section-title">
				<?php esc_html_e('Related Articles', 'mh-cicero'); ?>
			</h4>
			<ul class="related-wrap content-margin">
				<?php while ($related->have_posts()) : $related->the_post(); ?>
					<li class="related-item clearfix">
						<div class="related-thumbnail image-frame">
							<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo the_title_attribute('echo=0'); ?>"><?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('small-thumb');
								} else {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage-small.png' . '" alt="No Picture" />';
								} ?>
							</a>
						</div>
						<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
							<h5 class="related-title">
								<?php the_title(); ?>
							</h5>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</section><?php
	}
	wp_reset_postdata();
} ?>