<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div id="main-content" class="mh-content">
		<?php mh_before_page_content(); ?>
		<?php mh_edition_page_title(); ?>
		<div class="entry-content mh-widget">
			<div class="box">
				<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mh-edition'); ?></p>
			</div>
			<h4 class="mh-widget-title">
				<?php _e('Search', 'mh-edition'); ?>
			</h4>
			<?php get_search_form(); ?>
		</div>
		<div class="clearfix">
			<div class="mh-sidebar mh-home-sidebar mh-home-area-3"><?php
				$instance = array('title' => __('Popular Articles', 'mh-edition'), 'postcount' => 5, 'order' => 'comment_count', 'sticky' => 1);
				$args = array('before_widget' => '<div class="mh-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>');
				the_widget('mh_edition_custom_posts', $instance , $args); ?>
			</div>
			<div class="mh-sidebar mh-home-sidebar mh-margin-left mh-home-area-4"><?php
				$instance = array('title' => __('Random Articles', 'mh-edition'), 'postcount' => 5, 'order' => 'rand', 'sticky' => 1);
				$args = array('before_widget' => '<div class="mh-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title">', 'after_title' => '</h4>');
				the_widget('mh_edition_custom_posts', $instance , $args); ?>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>