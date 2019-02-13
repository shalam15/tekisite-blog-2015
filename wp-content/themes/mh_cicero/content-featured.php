<?php /* Template for displaying featured content. */ ?>
<li class="featured-post clearfix">
	<div class="featured-thumbnail">
		<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark">
			 <?php the_post_thumbnail('large-thumb'); ?>
		</a>
	</div>
	<article <?php post_class('featured-caption'); ?>>
		<header class="featured-header">
			<h4 class="featured-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
			<p class="featured-meta"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></p>
		</header>
		<div class="featured-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</article>
</li>