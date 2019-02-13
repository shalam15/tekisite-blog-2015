<?php /* Loop Template used for index/archive/search */ ?>
<?php $mh_elegance_options = mh_elegance_theme_options(); ?>
<?php if (has_post_thumbnail()) { ?>
	<?php $full_header = ''; ?>
<?php } else { ?>
	<?php $full_header = ' loop-header-full'; ?>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('loop-wrap'); ?>>
	<div class="loop-container clearfix">
		<header class="loop-header<?php echo $full_header; ?>">
			<h3 class="loop-title"><a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php mh_elegance_post_meta(); ?>
		</header>
		<?php if ($full_header == '') { ?>
			<div class="loop-thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog'); ?></a></div>
		<?php } ?>
	</div>
	<div class="loop-content">
		<div class="loop-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php if (!empty($mh_elegance_options['excerpt_more'])) { ?>
			<a class="button" href="<?php the_permalink(); ?>">
				<?php echo esc_attr($mh_elegance_options['excerpt_more']); ?>
			</a>
		<?php } ?>
	</div>
</article>