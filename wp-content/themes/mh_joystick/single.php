<?php get_header(); ?>
<div class="mh-row clearfix">
	<div id="main-content" class="mh-content"><?php
		mh_joystick_before_post_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			mh_joystick_postnav();
			mh_joystick_authorbox();
			mh_joystick_related_posts();
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>