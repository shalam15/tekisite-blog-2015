<?php /* Default template for displaying post content. */ ?>
<article <?php post_class(); ?>>
	<header class="post-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php mh_post_header(); ?>
	</header>
	<div class="entry clearfix"><?php
		mh_post_content_top();
		the_content();
		mh_post_content_bottom(); ?>
	</div>
	<?php the_tags('<div class="post-tags clearfix"><ul><li class="round-corners">','</li><li class="round-corners">','</li></ul></div>'); ?>
</article>