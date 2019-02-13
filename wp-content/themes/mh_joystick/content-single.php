<article <?php post_class('post-wrapper'); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><?php
		mh_joystick_post_meta();
		mh_joystick_featured_image(); ?>
    </header><?php
	dynamic_sidebar('post-ad-1');
	mh_joystick_post_category(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><?php
	dynamic_sidebar('post-ad-2');
	mh_joystick_post_tags();
	mh_joystick_socialise(); ?>
</article>