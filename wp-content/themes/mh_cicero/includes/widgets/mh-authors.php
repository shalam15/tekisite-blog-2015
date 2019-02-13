<?php

/***** MH Authors *****/

class mh_cicero_authors_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_cicero_authors_widget', esc_html_x('MH Authors', 'widget name', 'mh-cicero'),
			array(
				'classname' => 'mh_cicero_authors_widget',
				'description' => esc_html__('MH Authors widget to display a list of authors including the number of published posts.', 'mh-cicero'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
       $defaults = array('title' => '', 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC', 'avatar' => 'enable');
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
			<ul class="user-widget clearfix"><?php
				if (!empty($authors)) {
					foreach ($authors as $author) {
						$author_ID = $author->ID; ?>
						<li class="uw-wrap clearfix">
							<?php if ($instance['avatar'] == 'enable') { ?>
								<div class="uw-avatar image-frame">
									<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(esc_html__('Articles by %s', 'mh-cicero'), $author->display_name); ?>">
										<?php echo get_avatar($author_ID, 70); ?>
									</a>
								</div>
							<?php } ?>
							<div class="uw-text">
								<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>" title="<?php printf(esc_html__('Articles by %s', 'mh-cicero'), $author->display_name); ?>" class="author-name">
									<?php echo esc_attr($author->display_name); ?>
								</a>
								<p class="uw-data">
									<?php printf(esc_html_x('published %d articles', 'author post count', 'mh-cicero'), count_user_posts($author_ID)); ?>
								</p>
							</div>
						</li><?php
					}
				} else {
					esc_html_e('No authors found', 'mh-cicero');
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
		if ('enable' !== $new_instance['avatar']) {
			if (in_array($new_instance['avatar'], array('disable'))) {
				$instance['avatar'] = $new_instance['avatar'];
			}
		}
        return $instance;
    }
    function form($instance) {
	    $defaults = array('title' => esc_html__('Authors', 'mh-cicero'), 'authorcount' => 5, 'offset' => 0, 'role' => 0, 'orderby' => 'post_count', 'order' => 'DESC', 'avatar' => 'enable');
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('authorcount')); ?>"><?php esc_html_e('Limit Author Number:', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['authorcount']); ?>" name="<?php echo esc_attr($this->get_field_name('authorcount')); ?>" id="<?php echo esc_attr($this->get_field_id('authorcount')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Authors (Offset):', 'mh-cicero'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('role')); ?>"><?php esc_html_e('User Role:', 'mh-cicero'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('role')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('role')); ?>">
				<option value="0" <?php selected(0, $instance['role']); ?>><?php esc_html_e('All Users', 'mh-cicero'); ?></option>
				<option value="administrator" <?php selected('administrator', $instance['role']); ?>><?php esc_html_e('Administrator', 'mh-cicero'); ?></option>
				<option value="editor" <?php selected('editor', $instance['role']); ?>><?php esc_html_e('Editor', 'mh-cicero'); ?></option>
				<option value="author" <?php selected('author', $instance['role']); ?>><?php esc_html_e('Author', 'mh-cicero'); ?></option>
				<option value="contributor" <?php selected('contributor', $instance['role']); ?>><?php esc_html_e('Contributor', 'mh-cicero'); ?></option>
				<option value="subscriber" <?php selected('subscriber', $instance['role']); ?>><?php esc_html_e('Subscriber', 'mh-cicero'); ?></option>
			</select>
        </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order Authors by:', 'mh-cicero'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
				<option value="post_count" <?php selected('post_count', $instance['orderby']); ?>><?php esc_html_e('Number of Posts', 'mh-cicero'); ?></option>
				<option value="display_name" <?php selected('display_name', $instance['orderby']); ?>><?php esc_html_e('User Name', 'mh-cicero'); ?></option>
			</select>
        </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order:', 'mh-cicero'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="ASC" <?php selected('ASC', $instance['order']); ?>><?php esc_html_e('Ascending', 'mh-cicero'); ?></option>
				<option value="DESC" <?php selected('DESC', $instance['order']); ?>><?php esc_html_e('Descending', 'mh-cicero'); ?></option>
			</select>
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