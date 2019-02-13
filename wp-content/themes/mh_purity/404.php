<?php get_header(); ?>
<div class="wrapper clearfix">
	<div class="main">
		<section class="content <?php mh_content_class(); ?>">
			<?php mh_before_page_content(); ?>
			<div class="entry sb-widget">
				<p><?php echo __('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mhp'); ?></p>
			</div>
			<div class="clearfix">
				<div class="hp-sidebar"><?php
					$instance = array('title' => __('Popular Articles', 'mhp'), 'postcount' => '5', 'order' => 'comment_count', 'sticky' => 1);
					$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
					the_widget('mh_purity_custom_posts_widget', $instance , $args); ?>
				</div>
				<div class="hp-sidebar sb-right"><?php
					$instance = array('title' => __('Random Articles', 'mhp'), 'postcount' => '5', 'order' => 'rand', 'sticky' => 1);
					$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
					the_widget('mh_purity_custom_posts_widget', $instance , $args); ?>
				</div>
			</div>
		</section>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>