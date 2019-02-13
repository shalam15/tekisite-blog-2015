<?php /* Template Name: Full Width */ ?>
<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap">
		<div class="mh-content clearfix"><?php
			while (have_posts()) : the_post();
				mh_impact_before_page_content();
				get_template_part('content', 'page');
				comments_template();
			endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>