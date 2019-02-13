<?php $mh_elegance_options = mh_elegance_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-content-section">
	<div class="mh-container clearfix">
		<div id="main-content"><?php
			if (have_posts()) :
				while (have_posts()) : the_post();
					get_template_part('content', 'single');
					mh_elegance_socialise();
					mh_elegance_postnav();
					if ($mh_elegance_options['author_box'] == 'enable') {
						get_template_part('template', 'authorbox');
					}
					comments_template();
				endwhile;
			endif; ?>
		</div>
        <?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>