<?php /* Template for displaying content of MH Posts Large widget */ ?>
<article <?php post_class('mh-posts-large-item'); ?>>
	<div class="mh-posts-large-thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-edition-content');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content.png' . '" alt="No Image" />';
			} ?>
		</a>
		<div class="mh-posts-large-caption">
			<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
		</div>
	</div>
	<div class="mh-posts-large-content">
		<header class="mh-posts-large-header">
			<h3 class="mh-posts-large-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="mh-meta mh-posts-large-meta">
				<?php mh_edition_loop_meta(); ?>
			</div>
		</header>
		<div class="mh-posts-large-excerpt clearfix">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>