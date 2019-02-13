<?php /* Default template for displaying portfolio content. */ ?>
<article <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<div class="entry-title-wrap">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		<div class="entry-meta-wrap">
			<p class="entry-meta">
				<?php echo sprintf(_x('Date: %s', 'post date', 'mh-elegance'), '<span class="updated">' . get_the_date() . '</span><br>') . "\n"; ?>
				<?php the_terms($post->ID, 'mh-portfolio-type', __('Project Type: ', 'mh-elegance') . '<span class="portfolio-type">', ', ', '</span><br>'); ?>
			</p>
		</div>
	</header>
	<?php mh_elegance_featured_image(); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
    <?php the_terms($post->ID, 'mh-portfolio-tag', '<div class="entry-tags clearfix">' . __('Tagged as:', 'mh-elegance') . ' <span class="portfolio-tag">', ', ', '</span></div>'); ?>
</article>