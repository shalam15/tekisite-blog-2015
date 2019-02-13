<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>
<div class="mh-container">
	<div class="mh-content-wrap">
		<?php mh_impact_before_page_content(); ?>
		<header class="entry-header">
			<?php mh_impact_page_title(); ?>
		</header>
		<div class="sitemap mh-row clearfix">
			<div class="mh-col-1-3">
				<h4 class="widget-title"><span><?php _e('Recent Articles', 'mh-impact'); ?></span></h4>
				<ul class="sitemap-list widget-list"><?php
					$args = array('posts_per_page' => 10);
					$recent = new WP_query($args);
					while ($recent->have_posts()) : $recent->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
					endwhile; wp_reset_postdata(); ?>
				</ul>
				<h4 class="widget-title"><span><?php _e('Pages', 'mh-impact'); ?></span></h4>
				<ul class="sitemap-list widget-list"><?php
					$args = array('title_li' => '', 'post_status' => 'publish');
					wp_list_pages($args); ?>
				</ul>
			</div>
			<div class="mh-col-1-3">
				<h4 class="widget-title"><span><?php _e('Archives', 'mh-impact'); ?></span></h4>
				<ul class="sitemap-list widget-list">
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>
			<div class="mh-col-1-3">
				<h4 class="widget-title"><span><?php _e('Categories', 'mh-impact'); ?></span></h4>
				<ul class="sitemap-list widget-list"><?php
					$args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'mh-impact'));
					wp_list_categories($args); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>