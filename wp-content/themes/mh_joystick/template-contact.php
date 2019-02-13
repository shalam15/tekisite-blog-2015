<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="mh-row clearfix">
	<div id="main-content" class="mh-col-2-3 contact-page"><?php
		mh_joystick_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
		endwhile; ?>
	</div>
	<aside class="mh-sidebar">
		<?php dynamic_sidebar('contact-sidebar'); ?>
	</aside>
</div>
<?php get_footer(); ?>