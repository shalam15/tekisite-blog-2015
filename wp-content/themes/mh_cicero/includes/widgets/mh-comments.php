<?php

/***** MH Recent Comments *****/

class mh_cicero_comments_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_cicero_comments_widget', esc_html_x('MH Recent Comments', 'widget name', 'mh-cicero'),
			array(
				'classname' => 'mh_cicero_comments_widget',
				'description' => esc_html__('MH Recent Comments widget to display your recent comments including user avatars.', 'mh-cicero'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
	  	$defaults = array('title' => '', 'number' => 5, 'offset' => 0, 'avatar' => 'enable');
		$instance = wp_parse_args($instance, $defaults);
	    echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="user-widget clearfix"><?php
				$comments = get_comments(array('number' => absint($instance['number']), 'offset' => absint($instance['offset']), 'status' => 'approve', 'type' => 'comment'));
				if ($comments) {
					foreach ($comments as $comment) { ?>
						<li class="uw-wrap clearfix">
							<?php if ($instance['avatar'] == 'enable') { ?>
								<div class="uw-avatar image-frame">
									<a href="<?php echo esc_url(get_permalink($comment->comment_post_ID)) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo esc_attr($comment->comment_author); ?>">
										<?php echo get_avatar($comment->comment_author_email, 70); ?>
									</a>
								</div>
							<?php } ?>
							<div class="uw-text">
								<span class="mh-recent-comments-author">
									<?php printf(esc_html_x('%1$s on %2$s', 'comment widget', 'mh-cicero'), $comment->comment_author, ''); ?>
								</span>
								<a href="<?php echo esc_url(get_permalink($comment->comment_post_ID)) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo esc_attr($comment->comment_author) . ' | ' . esc_attr(get_the_title($comment->comment_post_ID)); ?>">
									<?php echo esc_attr(get_the_title($comment->comment_post_ID)); ?>
								</a>
							</div>
						</li><?php
					}
				} ?>
        	</ul><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['number'])) {
			$instance['number'] = absint($new_instance['number']);
		}
		if (0 !== absint($new_instance['offset'])) {
			$instance['offset'] = absint($new_instance['offset']);
		}
		if ('enable' !== $new_instance['avatar']) {
			if (in_array($new_instance['avatar'], array('disable'))) {
				$instance['avatar'] = $new_instance['avatar'];
			}
		}
        return $instance;
    }
    function form($instance) {
	    $defaults = array('title' => esc_html__('Recent Comments', 'mh-cicero'), 'number' => 5, 'offset' => 0, 'avatar' => 'enable');
		$instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Limit Comment Number:', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['number']); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" id="<?php echo esc_attr($this->get_field_id('number')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Comments (Offset):', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('avatar')); ?>"><?php esc_html_e('Author Avatar:', 'mh-cicero'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('avatar')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('avatar')); ?>">
				<option value="enable" <?php selected('enable', $instance['avatar']); ?>><?php esc_html_e('Enable', 'mh-cicero'); ?></option>
				<option value="disable" <?php selected('disable', $instance['avatar']); ?>><?php esc_html_e('Disable', 'mh-cicero'); ?></option>
			</select>
        </p><?php
    }
}

?>