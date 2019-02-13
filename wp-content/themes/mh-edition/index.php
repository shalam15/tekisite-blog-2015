<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div id="main-content" class="mh-loop mh-content"><?php
		mh_before_page_content();
		mh_edition_page_title();
		if (category_description()) { ?>
			<section class="mh-category-desc">
				<?php echo category_description(); ?>
			</section><?php
		}
		if (is_author()) {
			mh_edition_author_box();
		}
		if (have_posts()) {
			while (have_posts()) : the_post();
				get_template_part('content', 'loop');
			endwhile;
			mh_edition_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>