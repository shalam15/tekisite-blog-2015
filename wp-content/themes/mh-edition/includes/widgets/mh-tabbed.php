<?php

/***** MH Tabbed *****/

class mh_edition_tabbed extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_edition_tabbed', esc_html_x('MH Tabbed', 'widget name', 'mh-edition'),
			array(
				'classname' => 'mh_edition_tabbed',
				'description' => esc_html__('MH Tabbed widget showing your latest posts, tags and comments.', 'mh-edition')
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '');
        $instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<div class="mh-tabbed-widget">
				<div class="mh-tab-buttons clearfix">
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-1">
						<span><i class="fa fa-newspaper-o"></i></span>
					</a>
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-2">
						<span><i class="fa fa-tags"></i></span>
					</a>
					<a class="mh-tab-button" href="#tab-<?php echo esc_attr($args['widget_id']); ?>-3">
						<span><i class="fa fa-comments-o"></i></span>
					</a>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-1" class="mh-tab-content mh-tab-posts"><?php
					$latest_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'ignore_sticky_posts' => 1));
					if ($latest_posts->have_posts()) {
						echo '<ul class="mh-tab-content-posts">' . "\n";
							while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
								<li class="mh-tab-post-item">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</li><?php
							endwhile;
						echo '</ul>' . "\n";
					}
					wp_reset_postdata(); ?>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-2" class="mh-tab-content mh-tab-cloud">
                	<div class="tagcloud mh-tab-content-cloud">
	                	<?php wp_tag_cloud(array('number' => 25)); ?>
					</div>
				</div>
				<div id="tab-<?php echo esc_attr($args['widget_id']); ?>-3" class="mh-tab-content mh-tab-comments"><?php
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query(array('number' => '3', 'status' => 'approve'));
					if ($comments) {
						echo '<ul class="mh-tab-content-comments">';
							foreach ($comments as $comment) { ?>
								<li class="mh-tab-comment-item">
									<span class="mh-tab-comment-avatar">
										<?php echo get_avatar($comment->comment_author_email, 24); ?>
									</span>
									<span class="mh-tab-comment-author">
										<?php echo esc_attr($comment->comment_author) . ': '; ?>
									</span>
									<a href="<?php echo esc_url(get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID); ?>">
										<span class="mh-tab-comment-excerpt">
											<?php comment_excerpt($comment->comment_ID); ?>
										</span>
									</a>
								</li><?php
							}
						echo '</ul>';
					} else {
						_e('No comments found', 'mh-edition');
					} ?>
				</div>
			</div><?php
		echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
        return $instance;
    }
    function form($instance) {
		$defaults = array('title' => '');
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p><?php
    }
}

?>