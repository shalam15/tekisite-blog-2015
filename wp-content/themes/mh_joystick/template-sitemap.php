<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>
<div class="sitemap mh-row clearfix">
	<div id="main-content" class="mh-col-2-3">
		<?php mh_joystick_before_page_content(); ?>
		<article <?php post_class('post-wrapper'); ?>>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<div class="entry-content">
				<h3 class="entry-sub-title">
					<?php _e('Recent Posts', 'mh-joystick'); ?>
				</h3>
				<ul class="sitemap-list"><?php
					$args = array('posts_per_page' => 10);
					$recent = new WP_query($args); ?>
					<?php while ($recent->have_posts()) : $recent->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<h3 class="entry-sub-title">
					<?php _e('Pages', 'mh-joystick'); ?>
				</h3>
				<ul class="sitemap-list"><?php
					$args = array('title_li' => '', 'post_status' => 'publish');
					wp_list_pages($args); ?>
				</ul>
				<h3 class="entry-sub-title">
					<?php _e('Archives', 'mh-joystick'); ?>
				</h3>
				<ul class="sitemap-list">
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
				<h3 class="entry-sub-title">
					<?php _e('Categories', 'mh-joystick'); ?>
				</h3>
                <ul class="sitemap-list"><?php
                	$args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'mh-joystick'));
					wp_list_categories($args); ?>
				</ul>
			</div>
		</article>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>