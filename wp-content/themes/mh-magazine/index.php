<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div class="mh-main clearfix">
		<div id="main-content" class="mh-loop mh-content" role="main"><?php
			mh_before_page_content();
			if (have_posts()) {
				if (is_home() && !is_front_page()) { ?>
					<header class="page-header">
						<h1 class="page-title">
							<?php single_post_title(); ?>
						</h1>
					</header><?php
				}
				mh_magazine_loop_layout();
				mh_magazine_pagination();
			} else {
				get_template_part('content', 'none');
			} ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php mh_magazine_second_sidebar(); ?>
</div>
<?php get_footer(); ?>