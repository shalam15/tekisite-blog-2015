<?php get_header(); ?>
<div class="wrapper clearfix">
	<div class="content <?php mh_content_class(); ?>"><?php
		mh_before_page_content();
		if (category_description()) { ?>
			<div class="cat-desc">
				<?php echo category_description(); ?>
			</div><?php
		}
		if (is_author()) {
			mh_purity_author_box();
		}
		if (have_posts()) {
			while (have_posts()) : the_post();
				get_template_part('content', 'loop');
			endwhile;
			mh_purity_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>