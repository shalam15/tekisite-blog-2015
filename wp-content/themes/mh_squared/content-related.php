<article <?php post_class('mh-col-1-4 related-content-item'); ?>>
	<div class="related-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-squared-grid');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-grid.png' . '" alt="No Image" />';
			} ?>
		</a>
	</div>
    <h3 class="related-title">
    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
    		<?php the_title(); ?>
    	</a>
    </h3>
</article>