<?php /* Default template for displaying post content */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php mh_post_header(); ?>
	</header>
	<?php dynamic_sidebar('mh-posts-1'); ?>
	<div class="entry-content clearfix"><?php
		mh_post_content_top();
		the_content();
		mh_post_content_bottom(); ?>
	</div>
	<?php the_tags('<div class="entry-tags clearfix"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul></div>'); ?>
	<?php dynamic_sidebar('mh-posts-2'); ?>
</article>