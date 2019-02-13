<?php /* Default template for displaying post content. */ ?>
<article <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<div class="entry-title-wrap">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		<div class="entry-meta-wrap">
			<?php mh_elegance_post_meta(); ?>
		</div>
	</header>
	<?php mh_elegance_featured_image(); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div>
	<?php if (has_tag()) : ?>
		<div class="entry-tags clearfix">
        	<?php the_tags(__('Tagged as:', 'mh-elegance') . ' ',', ',''); ?>
        </div>
	<?php endif; ?>
</article>