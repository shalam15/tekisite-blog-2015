<article <?php post_class('loop-content-item'); ?>>
	<?php if (has_post_thumbnail()) { ?>
		<div class="loop-content-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('blog'); ?>
			</a>
		</div>
    <?php } ?>
	<header class="entry-header">
		<h2 class="loop-content-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
	</header>
	<div class="loop-content-meta">
		<?php mh_impact_post_meta(); ?>
	</div>
	<div class="loop-content-excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>