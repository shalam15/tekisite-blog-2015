<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
	<div class="hp mh-container clearfix">
		<?php dynamic_sidebar('home-1'); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if (!empty($post->post_content)) { ?>
				<div class="home-widget home-content">
					<div class="entry-content clearfix">
						<?php the_content(); ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; endif; ?>
		<?php dynamic_sidebar('home-2'); ?>
	</div>
<?php get_footer(); ?>