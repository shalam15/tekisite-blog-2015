<?php /* Template for displaying content of MH Posts List widget */ ?>
<article <?php post_class('mh-posts-list-item clearfix'); ?>>
	<div class="mh-posts-list-thumb">
		<a href="<?php the_permalink(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-edition-medium');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="No Picture" />';
			} ?>
		</a>
	</div>
	<div class="mh-posts-list-content clearfix">
		<header class="mh-posts-list-header">
			<h3 class="mh-posts-list-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="mh-meta mh-posts-list-meta">
				<?php mh_edition_loop_meta(); ?>
			</div>
		</header>
		<div class="mh-posts-list-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>