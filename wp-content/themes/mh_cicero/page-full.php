<?php /* Template Name: Page - Full Width */ ?>
<?php get_header(); ?>
<div class="mh-content-section clearfix"><?php
	while (have_posts()) : the_post();
		get_template_part('content', 'page');
		comments_template();
	endwhile; ?>
</div>
<?php get_footer(); ?>