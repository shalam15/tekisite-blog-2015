<?php get_header(); ?>
<div class="mh-content-section clearfix">
	<div class="mh-container">
		<div id="main-content"><?php
			mh_elegance_before_page_content();
        	if (have_posts()) {
        		while (have_posts()) : the_post();
					get_template_part('content');
				endwhile;
				mh_elegance_pagination();
			} else {
				get_template_part('content', 'none');
			} ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>