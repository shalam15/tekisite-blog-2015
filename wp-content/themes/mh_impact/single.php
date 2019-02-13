<?php $mh_impact_options = mh_impact_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap clearfix">
		<div id="main-content" class="mh-content"><?php
			while (have_posts()) : the_post();
				mh_impact_before_page_content();
				get_template_part('content', 'single');
				mh_impact_socialise();
				mh_impact_postnav();
				if ($mh_impact_options['author_box'] == 'enable') {
					get_template_part('template', 'authorbox');
				}
				comments_template();
			endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>