<?php get_header(); ?>
<div class="mh-content-section clearfix"><?php
	if (is_home()) {
		get_template_part('template', 'featured');
	} ?>
	<div id="main-content" class="mh-content"><?php
		mh_cicero_before_page_content();
		if (category_description()) {
			echo '<div class="category-description content-margin content-background">' . "\n";
				echo category_description();
			echo '</div>' . "\n";
		}
		if (have_posts()) {
			while (have_posts()) : the_post();
				get_template_part('content');
			endwhile;
			mh_cicero_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>