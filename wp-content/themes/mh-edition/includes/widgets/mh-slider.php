<?php

/***** MH Slider *****/

class mh_edition_slider extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_edition_slider', esc_html_x('MH Slider', 'widget name', 'mh-edition'),
			array(
				'classname' => 'mh_edition_slider',
				'description' => esc_html__('MH Slider widget for use on homepage template.', 'mh-edition')
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'width' => 'large_slider', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
		$instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		if (!empty($instance['cats'])) {
			$category_ids = explode(',', $instance['cats']);
			$category_ids = array_map('trim', $category_ids);
			$sorted_ids = mh_edition_sort_id_list($category_ids);
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
		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if ('date' !== $instance['order']) {
			$query_args['orderby'] = $instance['order'];
		}
		if (1 === $instance['sticky']) {
			$query_args['ignore_sticky_posts'] = true;
		}
		$slider_loop = new WP_Query($query_args);
		echo $args['before_widget']; ?>
        	<div id="<?php echo esc_attr($args['widget_id']); ?>" class="flexslider mh-slider-widget <?php echo 'mh-slider-' . esc_attr($instance['width']); ?>">
				<ul class="slides"><?php
					while ($slider_loop->have_posts()) : $slider_loop->the_post(); ?>
						<li class="mh-slider-item">
							<article>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
									if (has_post_thumbnail()) {
										if ($instance['width'] == 'large_slider') {
											the_post_thumbnail('mh-edition-slider');
										} else {
											the_post_thumbnail('mh-edition-content');
										}
									} else {
										if ($instance['width'] == 'large_slider') {
											echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-slider.png') . '" alt="No Picture" />';
										} else {
											echo '<img class="mh-image-placeholder" src="' . esc_url(get_template_directory_uri() . '/images/placeholder-content.png') . '" alt="No Picture" />';
										}
									} ?>
								</a>
								<div class="mh-slider-caption">
									<div class="mh-slider-content">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<h2 class="mh-slider-title">
												<?php the_title(); ?>
											</h2>
										</a>
										<?php if ($instance['excerpt'] == 0) { ?>
											<?php mh_edition_custom_excerpt($instance['excerpt_length']); ?>
										<?php } ?>
									</div>
								</div>
							</article>
						</li><?php
					endwhile;
					wp_reset_postdata(); ?>
				</ul>
			</div><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
        if (!empty($new_instance['cats'])) {
			$instance['cats'] = mh_edition_sanitize_id_list($new_instance['cats']);
		}
		if (!empty($new_instance['tags'])) {
			$tag_slugs = explode(',', $new_instance['tags']);
			$tag_slugs = array_map('sanitize_title', $tag_slugs);
			$instance['tags'] = implode(', ', $tag_slugs);
		}
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
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
		if ('large_slider' !== $new_instance['width']) {
			if (in_array($new_instance['width'], array('normal_slider'))) {
				$instance['width'] = $new_instance['width'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		$instance['excerpt'] = (!empty($new_instance['excerpt'])) ? 1 : 0;
		$instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
    	$defaults = array('category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'width' => 'large_slider', 'excerpt_length' => 35, 'excerpt' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'mh-edition'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
            	<option value="0" <?php selected(0, $instance['category']); ?>><?php esc_html_e('All', 'mh-edition'); ?></option><?php
            		$categories = get_categories();
            		foreach ($categories as $cat) { ?>
            			<option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $instance['category']); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option><?php
            		} ?>
            </select>
            <small><?php _e('Select a category to display posts from.', 'mh-edition'); ?></small>
		</p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('cats')); ?>"><?php esc_html_e('Multiple Categories Filter by ID:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo esc_attr($this->get_field_name('cats')); ?>" id="<?php echo esc_attr($this->get_field_id('cats')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_html_e('Filter Posts by Tags (e.g. lifestyle):', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Posts (max. 50):', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Post Order:', 'mh-edition'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('order')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
				<option value="date" <?php selected('date', $instance['order']); ?>><?php esc_html_e('Latest Posts', 'mh-edition'); ?></option>
				<option value="rand" <?php selected('rand', $instance['order']); ?>><?php esc_html_e('Random Posts', 'mh-edition'); ?></option>
				<option value="comment_count" <?php selected('comment_count', $instance['order']); ?>><?php esc_html_e('Popular Posts', 'mh-edition'); ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Image size:', 'mh-edition'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('width')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('width')); ?>">
				<option value="normal_slider" <?php selected('normal_slider', $instance['width']); ?>><?php esc_html_e('Normal', 'mh-edition'); ?></option>
				<option value="large_slider" <?php selected('large_slider', $instance['width']); ?>><?php esc_html_e('Large', 'mh-edition'); ?></option>
			</select>
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Custom Excerpt Length in Words:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>" type="checkbox" value="1" <?php checked(1, $instance['excerpt']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Disable Excerpt', 'mh-edition'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('sticky')); ?>" name="<?php echo esc_attr($this->get_field_name('sticky')); ?>" type="checkbox" value="1" <?php checked(1, $instance['sticky']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('sticky')); ?>"><?php esc_html_e('Ignore Sticky Posts', 'mh-edition'); ?></label>
		</p><?php
    }
}

?>