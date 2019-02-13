<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-content <?php mh_content_class(); ?>"><?php
		while (have_posts()) : the_post();
			mh_before_post_content();
			dynamic_sidebar('posts-1');
			if (is_attachment()) {
				get_template_part('content', 'attachment');
			} else {
				get_template_part('content', 'single');
			}
			dynamic_sidebar('posts-2');
			mh_after_post_content();
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>