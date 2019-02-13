<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<section class="mh-content <?php mh_content_class(); ?>">
		<?php mh_before_page_content(); ?>
		<div class="entry box">
			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mhc'); ?></p>
			<p><?php get_search_form(); ?></p>
		</div>
		<div class="clearfix">
			<div class="hp-sidebar hp-sidebar-left"><?php
				$instance = array('title' => __('Popular Articles', 'mhc'), 'postcount' => '5', 'order' => 'comment_count', 'excerpt' => 'first', 'sticky' => 1);
				$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
				the_widget('mh_custom_posts_widget', $instance , $args); ?>
			</div>
			<div class="hp-sidebar sb-right hp-sidebar-right"><?php
				$instance = array('title' => __('Random Articles', 'mhc'), 'postcount' => '5', 'order' => 'rand', 'excerpt' => 'first', 'sticky' => 1);
				$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
				the_widget('mh_custom_posts_widget', $instance , $args); ?>
			</div>
		</div>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>