<article <?php post_class('post-wrapper'); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><?php
		mh_squared_socialise();
		mh_squared_post_meta();
		mh_squared_featured_image();
		mh_squared_post_category(); ?>
	</header>
	<?php dynamic_sidebar('post-ad-1'); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php dynamic_sidebar('post-ad-2'); ?>
	<?php mh_squared_post_tags(); ?>
</article>