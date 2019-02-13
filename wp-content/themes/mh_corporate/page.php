<?php get_header(); ?>
<div class="mh-wrapper clearfix">
    <div class="mh-content <?php mh_content_class(); ?>"><?php
	    while (have_posts()) : the_post();
			mh_before_page_content();
			dynamic_sidebar('pages-1');
			get_template_part('content', 'page');
			dynamic_sidebar('pages-2');
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>