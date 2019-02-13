<?php

/***** MH Custom Posts *****/

class mh_custom_posts_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_custom_posts', esc_html_x('MH Custom Posts', 'widget name', 'mhc'),
			array(
				'classname' => 'mh_custom_posts',
				'description' => esc_html__('MH Custom Posts Widget to display posts based on categories or tags.', 'mhc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
		$defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'excerpt' => 'none', 'excerpt_length' => 175, 'thumbnails' => 'show_thumbs', 'date' => 0, 'comments' => 0, 'sticky' => 1);
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
		$counter = 1;
		$widget_loop = new WP_Query($query_args);
        echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) {
						echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">';
					} elseif ($instance['category'] != 0) {
						echo '<a href="' . esc_url(get_category_link($instance['category'])) . '" class="mh-widget-title-link">';
					}
					echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link']) || $instance['category'] != 0) {
						echo '</a>';
					}
				echo $args['after_title'];
			}
			$instance['thumbnails'] == 'show_thumbs' || $instance['thumbnails'] == 'hide_large' ? $cp_no_image = '' : $cp_no_image = ' mh-custom-posts-no-image'; ?>
			<ul class="cp-widget clearfix mh-custom-posts-widget<?php echo esc_attr($cp_no_image); ?>"><?php
				while ($widget_loop->have_posts()) : $widget_loop->the_post();
					if ($counter == 1 && $instance['excerpt'] == 'first' || $instance['excerpt'] == 'all') { ?>
						<li class="cp-wrap clearfix">
							<?php if ($instance['thumbnails'] == 'show_thumbs' || $instance['thumbnails'] == 'hide_small') { ?>
								<div class="cp-thumb-xl">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('cp_large');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage_cp_large.png' . '" alt="No Picture" />';
										} ?>
									</a>
								</div>
							<?php } ?>
							<div class="cp-data">
								<h3 class="cp-xl-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
								<?php if ($instance['date'] == 0 || $instance['comments'] == 0) { ?>
									<p class="meta"><?php
										if ($instance['date'] == 0) {
											echo get_the_date();
										}
										if ($instance['date'] == 0 && $instance['comments'] == 0) {
											echo ' | ';
										}
										if ($instance['comments'] == 0) {
											mh_comment_count();
										} ?>
									</p>
								<?php } ?>
							</div>
							<?php mh_excerpt($instance['excerpt_length']); ?>
						</li><?php
					} else { ?>
						<li class="cp-wrap cp-small clearfix">
							<?php if ($cp_no_image == '') { ?>
								<div class="cp-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('cp_small');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/noimage_70x53.png' . '" alt="No Picture" />';
										} ?>
									</a>
								</div>
							<?php } ?>
							<div class="cp-data">
								<p class="cp-widget-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</p>
								<?php if ($instance['comments'] == 0) { ?>
									<p class="meta">
										<?php comments_number(esc_html__('0 Comments', 'mhc'), esc_html__('1 Comment', 'mhc'), esc_html__('% Comments', 'mhc')); ?>
									</p>
								<?php } ?>
							</div>
						</li><?php
					}
					$counter++;
				endwhile;
				wp_reset_postdata(); ?>
        	</ul><?php
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
		if ('none' !== $new_instance['excerpt']) {
			if (in_array($new_instance['excerpt'], array('first', 'all'))) {
				$instance['excerpt'] = $new_instance['excerpt'];
			}
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
		if ('show_thumbs' !== $new_instance['thumbnails']) {
			if (in_array($new_instance['thumbnails'], array('hide_thumbs', 'hide_large', 'hide_small'))) {
				$instance['thumbnails'] = $new_instance['thumbnails'];
			}
		}
		$instance['date'] = (!empty($new_instance['date'])) ? 1 : 0;
		$instance['comments'] = (!empty($new_instance['comments'])) ? 1 : 0;
		$instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
	function form($instance) {
        $defaults = array('title' => '', 'link' => '', 'category' => 0, 'cats' => '', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'order' => 'date', 'excerpt' => 'none', 'excerpt_length' => 175, 'thumbnails' => 'show_thumbs', 'date' => 0, 'comments' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link Title to custom URL (optional):', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['link']); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" />
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
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
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
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Display Excerpts:', 'mhc'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>">
				<option value="first" <?php selected('first', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for first Post', 'mhc'); ?></option>
				<option value="all" <?php selected('all', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for all Posts', 'mhc'); ?></option>
				<option value="none" <?php selected('none', $instance['excerpt']); ?>><?php esc_html_e('No Excerpts', 'mhc'); ?></option>
			</select>
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Excerpt Character Limit:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('thumbnails')); ?>"><?php esc_html_e('Thumbnails:', 'mhc'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('thumbnails')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('thumbnails')); ?>">
				<option value="show_thumbs" <?php selected('show_thumbs', $instance['thumbnails']); ?>><?php esc_html_e('Show all Thumbnails', 'mhc'); ?></option>
				<option value="hide_thumbs" <?php selected('hide_thumbs', $instance['thumbnails']); ?>><?php esc_html_e('Hide all Thumbnails', 'mhc'); ?></option>
				<option value="hide_large" <?php selected('hide_large', $instance['thumbnails']); ?>><?php esc_html_e('Hide only large Thumbnails', 'mhc'); ?></option>
				<option value="hide_small" <?php selected('hide_small', $instance['thumbnails']); ?>><?php esc_html_e('Hide only small Thumbnails', 'mhc'); ?></option>
			</select>
        </p>
        <p>
			<input id="<?php echo esc_attr($this->get_field_id('date')); ?>" name="<?php echo esc_attr($this->get_field_name('date')); ?>" type="checkbox" value="1" <?php checked(1, $instance['date']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('date')); ?>"><?php esc_html_e('Hide Date', 'mhc'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('comments')); ?>" name="<?php echo esc_attr($this->get_field_name('comments')); ?>" type="checkbox" value="1" <?php checked(1, $instance['comments']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('comments')); ?>"><?php esc_html_e('Hide Comment Count', 'mhc'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('sticky')); ?>" name="<?php echo esc_attr($this->get_field_name('sticky')); ?>" type="checkbox" value="1" <?php checked(1, $instance['sticky']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('sticky')); ?>"><?php esc_html_e('Ignore Sticky Posts', 'mhc'); ?></label>
		</p><?php
    }
}

?>