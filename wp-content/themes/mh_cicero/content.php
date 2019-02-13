<?php /* Loop Template used for index/archive/search */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('loop-container clearfix'); ?>>
	<header class="entry-header">
		<div class="clearfix">
			<div class="entry-avatar">
				<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
					<?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
				</a>
			</div>
			<h3 class="entry-title">
				<a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
		</div>
		<?php mh_cicero_post_meta(); ?>
	</header>
	<?php if (has_post_thumbnail()) { ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('large-thumb'); ?>
			</a>
			<div class="entry-icon">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-picture-o fa-stack-1x fa-inverse"></i>
                </span>
            </div>
		</div>
	<?php } ?>
	<div class="entry-content content-margin clearfix">
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
	<?php get_template_part('template', 'social'); ?>
</article>