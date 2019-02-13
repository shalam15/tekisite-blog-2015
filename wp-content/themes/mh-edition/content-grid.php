<?php /* Template for displaying content of MH Posts Grid widget */ ?>
<article <?php post_class('mh-col-1-3 mh-posts-grid-item clearfix'); ?>>
	<div class="mh-posts-grid-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-edition-medium');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="No Image" />';
			} ?>
		</a>
	</div>
	<h3 class="mh-posts-grid-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h3>
</article>