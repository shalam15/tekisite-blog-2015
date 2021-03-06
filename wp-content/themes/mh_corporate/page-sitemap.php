<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>
<div class="mh-wrapper">
	<?php mh_before_page_content(); ?>
	<div class="row sitemap clearfix">
		<div class="col-1-3">
			<div class="sitemap-widget">
				<h5 class="widget-title"><?php _e('Recent Articles', 'mhc'); ?></h5>
				<ul class="sitemap-list"><?php
					$args = array('posts_per_page' => 10);
					$recent = new WP_query($args);
					while ($recent->have_posts()) : $recent->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
					endwhile; wp_reset_postdata(); ?>
				</ul>
			</div>
			<div class="sitemap-widget">
				<h5 class="widget-title"><?php _e('Pages', 'mhc'); ?></h5>
				<ul class="sitemap-list"><?php
					$args = array('title_li' => '', 'post_status' => 'publish');
					wp_list_pages($args); ?>
				</ul>
			</div>
		</div>
		<div class="col-1-3">
			<div class="sitemap-widget">
				<h5 class="widget-title"><?php _e('Archives', 'mhc'); ?></h5>
				<ul class="sitemap-list">
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>
		</div>
		<div class="col-1-3">
			<div class="sitemap-widget">
				<h5 class="widget-title"><?php _e('Categories', 'mhc'); ?></h5>
				<ul class="sitemap-list"><?php
					$args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'mhc'));
					wp_list_categories($args); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>