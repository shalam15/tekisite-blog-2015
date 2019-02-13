<?php get_header(); ?>
<?php $mh_cicero_options = mh_cicero_theme_options(); ?>
<div class="mh-content-section clearfix">
	<div id="main-content" class="mh-content"><?php
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			mh_cicero_postnav();
			if ($mh_cicero_options['author_box'] == 'enable') {
				get_template_part('template', 'authorbox');
       		}
	   		if ($mh_cicero_options['related_posts'] == 'enable') {
		   		get_template_part('content', 'related');
        	}
        	comments_template();
		endwhile; ?>
	</div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>