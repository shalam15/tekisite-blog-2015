<?php /* Template Name: Page - Front Page */ ?>
<?php get_header(); ?>
<div class="mh-content-section home clearfix">
	<div class="mh-container">
		<?php dynamic_sidebar('home-1'); ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('content', 'page'); ?>
		<?php endwhile; ?>
		<?php dynamic_sidebar('home-2'); ?>
	</div>
</div>
<?php get_footer(); ?>