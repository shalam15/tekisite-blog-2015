<?php
/* Template Name: Contact */
$mh_purity_options = mh_purity_theme_options(); ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="wrapper clearfix">
    <div class="content <?php mh_content_class(); ?>">
    	<?php mh_before_page_content(); ?>
		<div <?php post_class(); ?>>
	       	<div class="entry clearfix">
	        	<?php the_content(); ?>
	        </div>
		</div>
		<?php endwhile; ?>
		<?php endif; ?>
    </div>
    <?php if (isset($mh_purity_options['sidebars']) ? $mh_purity_options['sidebars'] != 'no' : true) : ?>
    	<aside class="sidebar <?php mh_sb_class(); ?>">
    		<?php dynamic_sidebar('contact'); ?>
		</aside>
	<?php endif; ?>
</div>
<?php get_footer(); ?>