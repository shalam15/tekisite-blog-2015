<?php get_header(); ?>
<div class="mh-content-section clearfix">
	<div id="main-content" class="mh-content"><?php
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>