<?php /* Template Name: Page - Sitemap */ ?>
<?php get_header(); ?>
<div class="mh-content-section">
	<div class="mh-container">
		<?php mh_elegance_before_page_content(); ?>
		<div class="row sitemap clearfix">
			<div class="mh-col-1-3">
				<h3 class="widget-title"><?php _e('Recent Articles', 'mh-elegance'); ?></h3>
				<ul class="sitemap-list">
					<?php $args = array('posts_per_page' => 10); ?>
					<?php $recent = new WP_query($args); ?>
					<?php while ($recent->have_posts()) : $recent->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<h3 class="widget-title"><?php _e('Pages', 'mh-elegance'); ?></h3>
				<ul class="sitemap-list">
					<?php $args = array('title_li' => '', 'post_status' => 'publish'); ?>
					<?php wp_list_pages($args); ?>
				</ul>
			</div>
			<div class="mh-col-1-3">
				<h3 class="widget-title"><?php _e('Archives', 'mh-elegance'); ?></h3>
				<ul class="sitemap-list">
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>
			<div class="mh-col-1-3">
				<h3 class="widget-title"><?php _e('Categories', 'mh-elegance'); ?></h3>
				<ul class="sitemap-list">
					<?php $args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'mh-elegance')); ?>
					<?php wp_list_categories($args); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>