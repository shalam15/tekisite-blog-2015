<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>
<div class="wrapper">
	<?php mh_before_page_content(); ?>
	<div class="row sitemap clearfix">
		<div class="col-1-3">
			<h5 class="widget-title"><?php _e('Recent Articles', 'mhp'); ?></h5>
			<ul class="sitemap-list"><?php
				$args = array('posts_per_page' => 10);
				$recent = new WP_query($args);
				while ($recent->have_posts()) : $recent->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
				endwhile; wp_reset_postdata(); ?>
			</ul>
			<h5 class="widget-title"><?php _e('Pages', 'mhp'); ?></h5>
			<ul class="sitemap-list"><?php
				$args = array('title_li' => '', 'post_status' => 'publish');
				wp_list_pages($args); ?>
			</ul>
		</div>
		<div class="col-1-3">
			<h5 class="widget-title"><?php _e('Archives', 'mhp'); ?></h5>
			<ul class="sitemap-list">
				<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
			</ul>
		</div>
		<div class="col-1-3">
			<h5 class="widget-title"><?php _e('Categories', 'mhp'); ?></h5>
			<ul class="sitemap-list"><?php
				$args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'mhp'));
				wp_list_categories($args); ?>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>