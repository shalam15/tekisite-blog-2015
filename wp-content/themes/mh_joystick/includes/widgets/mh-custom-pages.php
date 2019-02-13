<?php

/***** MH Custom Pages *****/

class mh_joystick_custom_pages extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_joystick_custom_pages', esc_html_x('MH Custom Pages', 'widget name', 'mh-joystick'),
			array(
				'classname' => 'mh_joystick_custom_pages',
				'description' => esc_html__('Display any of your pages with this widget.', 'mh-joystick'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'enable');
        $instance = wp_parse_args($instance, $defaults);
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) { echo '<a href="' . esc_url($instance['link']) . '" class="widget-title-link">'; }
						echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link'])) { echo '</a>'; }
				echo $args['after_title'];
			}
			$page_ids = explode(',', $instance['pages']);
			$page_ids = array_map('absint', $page_ids);
			$widget_loop = new WP_Query(array('post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in'));
			while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
			<div class="mh-row clearfix cp-widget">
				<article <?php post_class('cp-wrapper'); ?>>
                    <div class="cp-thumb">
                    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
	                    	if (has_post_thumbnail()) {
		                    	the_post_thumbnail('mh-joystick-large');
		                    } else {
			                    echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-large.png' . '" alt="No Image" />';
			            	} ?>
                    	</a>
                    </div>
                    <h2 class="cp-title">
                    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                    		<?php the_title(); ?>
                    	</a>
                    </h2>
                    <?php if (($instance['excerpt']) == 'enable') : ?>
                    	<div class="cp-excerpt">
                    		<?php the_excerpt(); ?>
                    	</div>
                    <?php endif; ?>
				</article>
			</div><?php
			endwhile;
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if (!empty($new_instance['link'])) {
			$instance['link'] = esc_url_raw($new_instance['link']);
		}
		if (!empty($new_instance['pages'])) {
			$instance['pages'] = mh_joystick_sanitize_id_list($new_instance['pages']);
		}
  		if ('enable' !== $new_instance['excerpt']) {
			if (in_array($new_instance['excerpt'], array('disable'))) {
				$instance['excerpt'] = $new_instance['excerpt'];
			}
		}
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'enable');
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-joystick'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link Title to custom URL (optional):', 'mh-joystick'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['link']); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('pages')); ?>"><?php esc_html_e('Filter Pages by ID (comma separated):', 'mh-joystick'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['pages']); ?>" name="<?php echo esc_attr($this->get_field_name('pages')); ?>" id="<?php echo esc_attr($this->get_field_id('pages')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Display Excerpt:', 'mh-joystick'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>">
				<option value="enable" <?php selected('enable', $instance['excerpt']); ?>><?php esc_html_e('Enable', 'mh-joystick') ?></option>
				<option value="disable" <?php selected('disable', $instance['excerpt']); ?>><?php esc_html_e('Disable', 'mh-joystick') ?></option>
			</select>
        </p><?php
    }
}

?>