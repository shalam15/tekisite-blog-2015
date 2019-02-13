<?php /* Template Name: Contact */ ?>
<?php $options = mh_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-wrapper clearfix">
    <div class="mh-content <?php mh_content_class(); ?>"><?php
	    mh_before_page_content();
    	while (have_posts()) : the_post(); ?>
        	<div <?php post_class('entry clearfix'); ?>>
	        	<?php the_content(); ?>
			</div><?php
		endwhile; ?>
	</div>
	<?php if ($options['sidebar'] == 'enable') { ?>
    	<aside class="mh-sidebar <?php mh_sb_class(); ?>">
    		<?php dynamic_sidebar('contact'); ?>
		</aside>
	<?php } ?>
</div>
<?php get_footer(); ?>