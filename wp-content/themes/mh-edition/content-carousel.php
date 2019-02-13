<?php /* Template for displaying content of MH Carousel widget */ ?>
<li class="mh-carousel-item">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
		if (has_post_thumbnail()) {
			the_post_thumbnail('mh-edition-medium');
		} else {
			echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="No Picture" />';
		} ?>
	</a>
	<div class="mh-carousel-caption">
		<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
	</div>
</li>