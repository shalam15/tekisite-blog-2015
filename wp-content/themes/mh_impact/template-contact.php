<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap clearfix">
		<div id="main-content" class="mh-content contact-page"><?php
			mh_impact_before_page_content();
            while (have_posts()) : the_post();
            	get_template_part('content', 'page');
			endwhile; ?>
		</div>
		<aside class="mh-sidebar">
			<?php dynamic_sidebar('contact'); ?>
		</aside>
	</div>
</div>
<?php get_footer(); ?>