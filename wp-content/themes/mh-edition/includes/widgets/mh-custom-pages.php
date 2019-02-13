<?php

/***** MH Custom Pages *****/

class mh_edition_custom_pages extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_edition_custom_pages', esc_html_x('MH Custom Pages', 'widget name', 'mh-edition'),
			array(
				'classname' => 'mh_edition_custom_pages',
				'description' => esc_html__('MH Custom Pages Widget to display pages based on page IDs.', 'mh-edition'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt_length' => 35);
        $instance = wp_parse_args($instance, $defaults);
        $counter = 1;
		$page_ids = explode(',', $instance['pages']);
		$page_ids = array_map('absint', $page_ids);
		$widget_loop = new WP_Query(array('post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in'));
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'];
					if (!empty($instance['link'])) { echo '<a href="' . esc_url($instance['link']) . '" class="mh-widget-title-link">'; }
						echo esc_html(apply_filters('widget_title', $instance['title']));
					if (!empty($instance['link'])) { echo '</a>'; }
				echo $args['after_title'];
			} ?>
			<ul class="mh-custom-posts-widget mh-custom-pages-widget clearfix"><?php
				while ($widget_loop->have_posts()) : $widget_loop->the_post();
					if ($counter == 1) : ?>
						<li class="mh-custom-posts-item mh-custom-posts-large clearfix">
							<div class="mh-custom-posts-large-inner clearfix">
								<div class="mh-custom-posts-thumb-xl">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('mh-edition-medium');
										} else {
											echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="No Picture" />';
										} ?>
									</a>
								</div>
								<div class="mh-custom-posts-content">
									<header class="mh-custom-posts-header">
										<h3 class="mh-custom-posts-xl-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</header>
									<?php mh_edition_custom_excerpt($instance['excerpt_length']); ?>
								</div>
							</div>
						</li><?php
					else : ?>
						<li class="mh-custom-posts-item mh-custom-posts-small clearfix">
							<div class="mh-custom-posts-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('mh-edition-small');
									} else {
										echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-small.png' . '" alt="No Picture" />';
									} ?>
								</a>
							</div>
							<header class="mh-custom-posts-header">
								<p class="mh-custom-posts-small-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</p>
							</header>
						</li><?php
					endif;
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
			$instance['pages'] = mh_edition_sanitize_id_list($new_instance['pages']);
		}
		if (0 !== absint($new_instance['excerpt_length'])) {
			$instance['excerpt_length'] = absint($new_instance['excerpt_length']);
		}
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => '', 'link' => '', 'pages' => '', 'excerpt_length' => 35);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link Title to custom URL (optional):', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['link']); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('pages')); ?>"><?php esc_html_e('Filter Pages by ID (comma separated):', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['pages']); ?>" name="<?php echo esc_attr($this->get_field_name('pages')); ?>" id="<?php echo esc_attr($this->get_field_id('pages')); ?>" />
	    </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php esc_html_e('Custom Excerpt Length in Words:', 'mh-edition'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['excerpt_length']); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" id="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>" />
	    </p><?php
    }
}

?>