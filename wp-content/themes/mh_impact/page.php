<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap clearfix">
		<div id="main-content" class="mh-content"><?php
			while (have_posts()) : the_post();
				mh_impact_before_page_content();
				get_template_part('content', 'page');
				comments_template();
			endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>