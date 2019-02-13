<?php /* Loop Template - used for index/archive/search */ ?>
<?php $options = mh_theme_options(); ?>
<article class="loop-wrap round-corners clearfix"><?php
	if (has_post_thumbnail()) {
		if ($options['sidebar'] == 'disable') {
			$thumbnail = get_the_post_thumbnail($post->ID, 'slider');
		} else {
			$thumbnail = get_the_post_thumbnail($post->ID, 'content');
		} ?>
		<div class="loop-thumb">
			<a href="<?php the_permalink()?>">
				<?php echo $thumbnail; ?>
			</a>
		</div><?php
	} ?>
	<header class="loop-data">
		<h3 class="loop-title">
			<a href="<?php the_permalink()?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php mh_loop_meta(); ?>
	</header>
	<?php mh_excerpt($options['excerpt_length']); ?>
</article>