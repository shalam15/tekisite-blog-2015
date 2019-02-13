<?php /* Template Name: Page - Contact */ ?>
<?php get_header(); ?>
<div class="mh-content-section clearfix">
	<div id="main-content"><?php
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
		endwhile; ?>
	</div>
	<aside id="main-sidebar" class="mh-sidebar">
		<?php dynamic_sidebar('contact'); ?>
	</aside>
</div>
<?php get_footer(); ?>