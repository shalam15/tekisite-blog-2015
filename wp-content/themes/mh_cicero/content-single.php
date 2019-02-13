<?php /* Default template for displaying post content. */ ?>
<article <?php post_class('entry-wrap clearfix'); ?>>
	<header class="entry-header">
		<div class="clearfix">
			<div class="entry-avatar">
				<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
					<?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
				</a>
			</div>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</div>
		<?php mh_cicero_post_meta(); ?>
	</header>
	<?php mh_cicero_featured_image(); ?>
	<div class="entry-content content-margin clearfix">
		<?php the_content(); ?>
	</div>
	<?php the_tags('<div class="entry-tags clearfix"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-tags fa-stack-1x fa-inverse"></i></span>',', ','</div>'); ?>
	<?php get_template_part('template', 'social'); ?>
</article>