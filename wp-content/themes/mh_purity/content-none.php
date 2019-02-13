<div class="entry sb-widget">
<?php if (is_search()) { ?>
	<div class="box">
		<p><?php echo __('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mhp'); ?></p>
	</div>
<?php } else { ?>
	<div class="box">
		<p><?php echo __('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mhp'); ?></p>
	</div>
<?php } ?>
</div>
<div class="clearfix">
	<div class="hp-sidebar hp-sidebar-left"><?php
		$instance = array('title' => __('Popular Articles', 'mhp'), 'postcount' => '5', 'order' => 'comment_count', 'sticky' => 1);
		$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
		the_widget('mh_purity_custom_posts_widget', $instance , $args); ?>
	</div>
	<div class="hp-sidebar sb-right hp-sidebar-right"><?php
		$instance = array('title' => __('Random Articles', 'mhp'), 'postcount' => '5', 'order' => 'rand', 'sticky' => 1);
		$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>');
		the_widget('mh_purity_custom_posts_widget', $instance , $args); ?>
	</div>
</div>