<?php /* Template Name: Page - Full Width */ ?>
<?php get_header(); ?>
<div class="mh-wrapper mh-full-content"><?php
	while (have_posts()) : the_post();
		mh_before_page_content();
		get_template_part('content', 'page');
		comments_template();
	endwhile; ?>
</div>
<?php get_footer(); ?>