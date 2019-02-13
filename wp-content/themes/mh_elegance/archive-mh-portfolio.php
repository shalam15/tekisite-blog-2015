<?php get_header(); ?>
<div class="mh-content-section clearfix">
	<div class="mh-container">
		<?php mh_elegance_before_page_content(); ?>
		<div class="portfolio-content">
			<div class="row clearfix">
				<?php $counter = 1; ?>
				<?php $max_posts = $wp_query->post_count; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item mh-col-1-3'); ?>>
						<div class="portfolio-thumb">
							<a href="<?php the_permalink(); ?>"><?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('portfolio');
								} else {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/blank-image.png" alt="No Image" />';
								} ?>
							</a>
						</div>
					</article>
					<?php if ($counter % 3 == 0 && $counter != $max_posts) { ?>
						</div><div class="row clearfix">
					<?php } ?>
				<?php $counter++; ?>
				<?php endwhile; ?>
			</div>
			<?php mh_elegance_pagination(); ?>
			<?php else : ?>
				<?php get_template_part('content', 'none'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>