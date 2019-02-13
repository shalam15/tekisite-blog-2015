<?php

/***** MH Spotlight *****/

class mh_spotlight_hp_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_spotlight_hp', esc_html_x('MH Spotlight (Homepage)', 'widget name', 'mhc'),
			array(
				'classname' => 'mh_spotlight_hp',
				'description' => esc_html__('MH Spotlight / Featured widget for use on homepage template.', 'mhc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
		$defaults = array('title' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'offset' => 0, 'order' => 'date', 'width' => 'normal_sl', 'excerpt_length' => 175, 'excerpt' => 0, 'meta' => 0);
		$instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		if (!empty($instance['cats'])) {
			$category_ids = explode(',', $instance['cats']);
			$category_ids = array_map('trim', $category_ids);
			$sorted_ids = mh_corporate_sort_id_list($category_ids);
		}
		if (0 === $instance['category']) {
			if (!empty($sorted_ids['exclude'])) {
				$query_args['category__not_in'] = $sorted_ids['exclude'];
			}
		} else {
			$ids_to_include = array();
			if (!empty($sorted_ids['include'])) {
				$ids_to_include = $sorted_ids['include'];
			}
			$ids_to_include[] = $instance['category'];
			$query_args['category__in'] = $ids_to_include;
		}
		if (!empty($instance['tags'])) {
			$tag_slugs = explode(',', $instance['tags']);
			$tag_slugs = array_map('trim', $tag_slugs);
			$query_args['tag_slug__in'] = $tag_slugs;
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if ('date' !== $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		$query_args['posts_per_page'] = 1;
		$query_args['ignore_sticky_posts'] = 1;
		$spotlight_loop = new WP_Query($query_args);
        echo $args['before_widget']; ?>
			<div class="spotlight"><?php
				while ($spotlight_loop->have_posts()) : $spotlight_loop->the_post(); ?>
					<?php if (!empty($instance['title'])) { ?>
						<div class="sl-caption">
							<?php echo esc_html(apply_filters('widget_title', $instance['title'])); ?>
						</div>
					<?php } ?>
					<div class="sl-thumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
							if (has_post_thumbnail()) {
								if ($instance['width'] == 'normal_sl') {
									the_post_thumbnail('spotlight');
								} else {
									the_post_thumbnail('slider');
								}
							} else {
								if ($instance['width'] == 'normal_sl') {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage_580x326.png' . '" alt="No Picture" />';
								} else {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage_940x400.png' . '" alt="No Picture" />';
								}
							} ?>
						</a>
					</div>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<h2 class="sl-title">
							<?php the_title(); ?>
						</h2>
					</a><?php
					if ($instance['meta'] == 0) { ?>
						<p class="meta"><?php
							esc_html_e('by ', 'mhc') . the_author() . esc_html_e(' in ', 'mhc');
							$category = get_the_category(); echo $category[0]->cat_name; ?>
						</p><?php
					}
					if ($instance['excerpt'] == 0) {
						mh_excerpt($instance['excerpt_length']);
					}
					if ($instance['meta'] == 0) { ?>
						<p class="meta">
							<?php mh_comment_count(); ?>
						</p><?php
					}
				endwhile;
				wp_reset_postdata(); ?>
			</div><?php
        echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
    	$instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
        if (!empty($new_instance['cats'])) {
			$instance['cats'] = mh_corporate_sanitize_id_list($new_instance['cats']);
		}
		if (!empty($new_instance['tags'])) {
			$tag_slugs = explode(',', $new_instance['tags']);
			$tag_slugs = array_map('sanitize_title', $tag_slugs);
			$instance['tags'] = implode(', ', $tag_slugs);
		}
		if (0 !== absint($new_instance['offset'])) {
			if (absint($new_instance['offset']) > 50) {
				$instance['offset'] = 50;
			} else {
				$instance['offset'] = absint($new_instance['offset']);
			}
		}
		if ('date' !== $new_instance['order']) {
			if (in_array($new_instance['order'], array('rand', 'comment_count'))) {
				$instance['order'] = $new_instance['order'];
			}
		}
		if ('normal_sl' !== $new_instance['width']) {
			if (in_array($new_instance['width'], array('large_sl'))) {
				$instance['width'] = $new_instance['width'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['excerpt'] = (!empty($new_instance['excerpt'])) ? 1 : 0;
		$instance['meta'] = (!empty($new_instance['meta'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('In the Spotlight', 'mhc'), 'category' => 0, 'cats' => '', 'tags' => '', 'offset' => 0, 'order' => 'date', 'width' => 'normal_sl', 'excerpt_length' => 175, 'excerpt' => 0, 'meta' => 0);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'mhc'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
            	<option value="0" <?php selected(0, $instance['category']); ?>><?php esc_html_e('All', 'mhc'); ?></option><?php
            		$categories = get_categories();
            		foreach ($categories as $cat) { ?>
            			<option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $instance['category']); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option><?php
            		} ?>
            </select>
            <small><?php _e('Select a category to display posts from.', 'mhc'); ?></small>
		</p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_html_e('Multiple Categories Filter by ID:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo esc_attr($this->get_field_name('cats')); ?>" id="<?php echo esc_attr($this->get_field_id('cats')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_html_e('Filter Posts by Tags (e.g. lifestyle):', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Posts (max. 50):', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Post Order:', 'mhc'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="date" <?php selected('date', $instance['order']); ?>><?php esc_html_e('Latest Posts', 'mhc'); ?></option>
				<option value="rand" <?php selected('rand', $instance['order']); ?>><?php esc_html_e('Random Posts', 'mhc'); ?></option>
				<option value="comment_count" <?php selected('comment_count', $instance['order']); ?>><?php esc_html_e('Popular Posts', 'mhc'); ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Image size:', 'mhc'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('width')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('width')); ?>">
				<option value="normal_sl" <?php selected('normal_sl', $instance['width']); ?>><?php esc_html_e('Normal', 'mhc'); ?></option>
				<option value="large_sl" <?php selected('large_sl', $instance['width']); ?>><?php esc_html_e('Large', 'mhc'); ?></option>
			</select>
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Excerpt Character Limit:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>" type="checkbox" value="1" <?php checked(1, $instance['excerpt']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Disable Excerpt', 'mhc'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('meta')); ?>" name="<?php echo esc_attr($this->get_field_name('meta')); ?>" type="checkbox" value="1" <?php checked(1, $instance['meta']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('meta')); ?>"><?php esc_html_e('Disable Post Meta', 'mhc'); ?></label>
		</p><?php
    }
}

?>