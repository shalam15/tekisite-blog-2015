<?php

/***** MH Authors *****/

class mh_squared_authors extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_squared_authors', esc_html_x('MH Authors', 'widget name', 'mh-squared'),
			array(
				'classname' => 'mh_squared_authors',
				'description' => esc_html__('MH Authors widget to display a list of authors including the number of published posts.', 'mh-squared'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC');
        $instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		if (!empty($instance['authorcount'])) {
			$query_args['number'] = $instance['authorcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if (0 !== $instance['role']) {
			$query_args['role'] = $instance['role'];
		}
		if ('ASC' !== $instance['order']) {
			$query_args['order'] = $instance['order'];
		}
		$query_args['orderby'] = $instance['orderby'];
		$wp_user_query = new WP_User_Query($query_args);
		$authors = $wp_user_query->get_results();
        echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="mh-row clearfix user-widget"><?php
				if (!empty($authors)) {
					foreach ($authors as $author) {
						$author_ID = $author->ID; ?>
						<li class="uw-wrap clearfix">
							<div class="uw-avatar">
								<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(__('Articles by %s', 'mh-squared'), esc_attr($author->display_name)); ?>">
									<?php echo get_avatar($author_ID, 100); ?>
								</a>
							</div>
							<div class="uw-text">
								<a class="author-name" href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(__('Articles by %s', 'mh-squared'), esc_attr($author->display_name)); ?>">
									<?php echo esc_attr($author->display_name); ?>
								</a>
								<p class="uw-data">
									<span><?php printf(_x('%d Posts', 'author post count', 'mh-squared'), absint(count_user_posts($author_ID))); ?></span>
								</p>
							</div>
						</li><?php
					}
				} else {
					_e('No authors found', 'mh-squared');
				} ?>
			</ul><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (0 !== absint($new_instance['authorcount'])) {
			$instance['authorcount'] = absint($new_instance['authorcount']);
		}
		if (0 !== absint($new_instance['offset'])) {
			$instance['offset'] = absint($new_instance['offset']);
		}
		if (0 !== $new_instance['role']) {
			if (in_array($new_instance['role'], array('administrator', 'editor', 'author', 'contributor', 'subscriber'))) {
				$instance['role'] = $new_instance['role'];
			}
		}
		if ('post_count' !== $new_instance['orderby']) {
			if (in_array($new_instance['orderby'], array('display_name'))) {
				$instance['orderby'] = $new_instance['orderby'];
			}
		}
		if ('DESC' !== $new_instance['order']) {
			if (in_array($new_instance['order'], array('ASC'))) {
				$instance['order'] = $new_instance['order'];
			}
		}
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => esc_html__('Authors', 'mh-squared'), 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-squared'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('authorcount')); ?>"><?php esc_html_e('Limit Author Number:', 'mh-squared'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['authorcount']); ?>" name="<?php echo esc_attr($this->get_field_name('authorcount')); ?>" id="<?php echo esc_attr($this->get_field_id('authorcount')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Authors (Offset):', 'mh-squared'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('role')); ?>"><?php esc_html_e('User Role:', 'mh-squared'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('role')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('role')); ?>">
				<option value="0" <?php selected(0, $instance['role']); ?>><?php esc_html_e('All Users', 'mh-squared'); ?></option>
				<option value="administrator" <?php selected('administrator', $instance['role']); ?>><?php esc_html_e('Administrator', 'mh-squared') ?></option>
				<option value="editor" <?php selected('editor', $instance['role']); ?>><?php esc_html_e('Editor', 'mh-squared') ?></option>
				<option value="author" <?php selected('author', $instance['role']); ?>><?php esc_html_e('Author', 'mh-squared') ?></option>
				<option value="contributor" <?php selected('contributor', $instance['role']); ?>><?php esc_html_e('Contributor', 'mh-squared') ?></option>
				<option value="subscriber" <?php selected('subscriber', $instance['role']); ?>><?php esc_html_e('Subscriber', 'mh-squared') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order Authors by:', 'mh-squared'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
				<option value="post_count" <?php selected('post_count', $instance['orderby']); ?>><?php esc_html_e('Number of Posts', 'mh-squared') ?></option>
				<option value="display_name" <?php selected('display_name', $instance['orderby']); ?>><?php esc_html_e('User Name', 'mh-squared') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order:', 'mh-squared'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="ASC" <?php selected('ASC', $instance['order']); ?>><?php esc_html_e('Ascending', 'mh-squared') ?></option>
				<option value="DESC" <?php selected('DESC', $instance['order']); ?>><?php esc_html_e('Descending', 'mh-squared') ?></option>
			</select>
        </p><?php
    }
}

?>