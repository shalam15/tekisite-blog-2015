<?php

/***** MH Custom Pages *****/

class mh_custom_pages_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_custom_pages', esc_html_x('MH Custom Pages', 'widget name', 'mhc'),
			array(
				'classname' => 'mh_custom_pages',
				'description' => esc_html__('MH Custom Pages Widget to display pages based on page IDs.', 'mhc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
	    $defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'none', 'excerpt_length' => 175, 'thumbnails' => 'show_thumbs');
        $instance = wp_parse_args($instance, $defaults);
		echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) { echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">'; }
						echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link'])) { echo '</a>'; }
				echo $args['after_title'];
			}
			$instance['thumbnails'] == 'show_thumbs' || $instance['thumbnails'] == 'hide_large' ? $cp_no_image = '' : $cp_no_image = ' mh-custom-posts-no-image'; ?>
			<ul class="cp-widget clearfix mh-custom-pages-widget<?php echo esc_attr($cp_no_image); ?>"><?php
				$counter = 1;
				$page_ids = explode(',', $instance['pages']);
				$page_ids = array_map('absint', $page_ids);
				$widget_loop = new WP_Query(array('post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in'));
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
							<?php }?>
							<div class="cp-data">
								<p class="cp-widget-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</p>
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
		if (!empty($new_instance['pages'])) {
			$instance['pages'] = mh_corporate_sanitize_id_list($new_instance['pages']);
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
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt' => 'none', 'excerpt_length' => 175, 'thumbnails' => 'show_thumbs');
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
        	<label for="<?php echo esc_attr($this->get_field_id('pages')); ?>"><?php esc_html_e('Filter Pages by ID (comma separated):', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['pages']); ?>" name="<?php echo esc_attr($this->get_field_name('pages')); ?>" id="<?php echo esc_attr($this->get_field_id('pages')); ?>" />
	    </p>
		<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('excerpt')); ?>"><?php esc_html_e('Display Excerpts:', 'mhc'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('excerpt')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('excerpt')); ?>">
				<option value="first" <?php selected('first', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for first Page', 'mhc'); ?></option>
				<option value="all" <?php selected('all', $instance['excerpt']); ?>><?php esc_html_e('Excerpt for all Pages', 'mhc'); ?></option>
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
        </p><?php
    }
}

?>