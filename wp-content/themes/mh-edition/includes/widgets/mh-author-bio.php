<?php

/***** MH Author Bio *****/

class mh_edition_author_bio extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_edition_author_bio', esc_html_x('MH Author Bio', 'widget name', 'mh-edition'),
			array(
				'classname' => 'mh_edition_author_bio',
				'description' => esc_html__('MH Author Bio widget to display author avatar and biographical info.', 'mh-edition'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
		$defaults = array('title' => '', 'user' => 0);
		$instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<div class="mh-author-bio-widget">
        		<div class="mh-author-avatar mh-author-image-frame">
        			<a href="<?php echo esc_url(get_author_posts_url($instance['user'])); ?>">
        				<?php echo get_avatar($instance['user'], 120); ?>
					</a>
				</div>
				<?php if (get_the_author_meta('description', $instance['user'])) { ?>
					<div class="mh-author-bio">
						<?php echo wp_kses_post(get_the_author_meta('description', $instance['user'])); ?>
					</div>
				<?php } ?>
			</div><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['user'])) {
			$instance['user'] = absint($new_instance['user']);
		}
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('About me', 'mh-edition'), 'user' => 0);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php esc_html_e('Select User:', 'mh-edition'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('user')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('user')); ?>"><?php
            	$users = get_users();
            	foreach ($users as $user) { ?>
            		<option value="<?php echo absint($user->ID); ?>" <?php selected($user->ID, $instance['user']); ?>><?php echo esc_html($user->display_name); ?></option><?php
            	} ?>
            </select>
		</p><?php
    }
}

?>