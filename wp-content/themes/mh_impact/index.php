<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap clearfix">
		<div id="main-content" class="loop-content"><?php
			mh_impact_before_page_content();
			mh_impact_page_title();
			if (have_posts()) {
				while (have_posts()) : the_post();
					get_template_part('content');
				endwhile;
				mh_impact_pagination();
			} else {
				get_template_part('content', 'none');
			} ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>