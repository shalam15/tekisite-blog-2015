<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-content <?php mh_content_class(); ?>"><?php
		mh_before_page_content();
		if (category_description()) { ?>
			<section class="cat-desc">
				<?php echo category_description(); ?>
			</section><?php
		}
		if (is_author()) {
			mh_author_box();
		}
		if (have_posts()) {
			while (have_posts()) : the_post();
				get_template_part('content', 'loop');
			endwhile;
			mh_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>