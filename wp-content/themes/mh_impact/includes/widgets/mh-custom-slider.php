<?php

/***** MH Custom Slider (Homepage) *****/

class mh_impact_custom_slider_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_custom_slider_widget', esc_html_x('MH Custom Slider (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_custom_slider_widget',
				'description' => esc_html__('Custom Slider Widget to display custom content for use on homepage template.', 'mh-impact')
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        global $options;
        $default_Image = get_template_directory_uri() . '/images/placeholder-slider.jpg';

		$title1 = empty($instance['title1']) ? '' : $instance['title1'];
		$url1 = empty($instance['url1']) ? '' : $instance['url1'];
		$image1 = empty($instance['image1']) ? $default_Image : $instance['image1'];
		$target1 = isset($instance['target1']) && $instance['target1'] ? ' target="_blank"' : '';

		$title2 = empty($instance['title2']) ? '' : $instance['title2'];
		$url2 = empty($instance['url2']) ? '' : $instance['url2'];
		$image2 = empty($instance['image2']) ? $default_Image : $instance['image2'];
		$target2 = isset($instance['target2']) && $instance['target2'] ? ' target="_blank"' : '';

		$title3 = empty($instance['title3']) ? '' : $instance['title3'];
		$url3 = empty($instance['url3']) ? '' : $instance['url3'];
		$image3 = empty($instance['image3']) ? $default_Image : $instance['image3'];
		$target3 = isset($instance['target3']) && $instance['target3'] ? ' target="_blank"' : '';

		$title4 = empty($instance['title4']) ? '' : $instance['title4'];
		$url4 = empty($instance['url4']) ? '' : $instance['url4'];
		$image4 = empty($instance['image4']) ? $default_Image : $instance['image4'];
		$target4 = isset($instance['target4']) && $instance['target4'] ? ' target="_blank"' : '';

		$title5 = empty($instance['title5']) ? '' : $instance['title5'];
		$url5 = empty($instance['url5']) ? '' : $instance['url5'];
		$image5 = empty($instance['image5']) ? $default_Image : $instance['image5'];
		$target5 = isset($instance['target5']) && $instance['target5'] ? ' target="_blank"' : '';

		$slide1 = array('title' => $title1, 'url' => $url1, 'image' => $image1, 'target' => $target1);
		$slide2 = array('title' => $title2, 'url' => $url2, 'image' => $image2, 'target' => $target2);
		$slide3 = array('title' => $title3, 'url' => $url3, 'image' => $image3, 'target' => $target3);
		$slide4 = array('title' => $title4, 'url' => $url4, 'image' => $image4, 'target' => $target4);
		$slide5 = array('title' => $title5, 'url' => $url5, 'image' => $image5, 'target' => $target5);
		$slides = array($slide1, $slide2, $slide3, $slide4, $slide5);

        echo $before_widget; ?>
        <section id="slider-<?php echo rand(1, 9999); ?>" class="flexslider">
			<ul class="slides">
				<?php foreach($slides as $slide) { ?>
					<?php if ($slide['title'] || $slide['image'] != $default_Image) { ?>
						<li>
							<article class="slide-wrap">
								<a href="<?php echo esc_url($slide['url']); ?>" title="<?php echo esc_attr($slide['title']); ?>"<?php echo $slide['target']; ?>>
									<img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>" />
								</a>
								<?php if ($slide['title']) { ?>
									<header class="slide-caption">
										<a href="<?php echo esc_url($slide['url']); ?>" title="<?php echo esc_attr($slide['title']); ?>"<?php echo $slide['target']; ?>>
											<h2 class="slide-title">
												<?php echo esc_attr($slide['title']); ?>
											</h2>
										</a>
									</header>
								<?php } ?>
							</article>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</section><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

		$instance['title1'] = sanitize_text_field($new_instance['title1']);
		$instance['url1'] = esc_url_raw($new_instance['url1']);
		$instance['image1'] = esc_url_raw($new_instance['image1']);
		$instance['target1'] = (!empty($new_instance['target1'])) ? 1 : 0;

		$instance['title2'] = sanitize_text_field($new_instance['title2']);
		$instance['url2'] = esc_url_raw($new_instance['url2']);
		$instance['image2'] = esc_url_raw($new_instance['image2']);
		$instance['target2'] = (!empty($new_instance['target2'])) ? 1 : 0;

		$instance['title3'] = sanitize_text_field($new_instance['title3']);
		$instance['url3'] = esc_url_raw($new_instance['url3']);
		$instance['image3'] = esc_url_raw($new_instance['image3']);
		$instance['target3'] = (!empty($new_instance['target3'])) ? 1 : 0;

		$instance['title4'] = sanitize_text_field($new_instance['title4']);
		$instance['url4'] = esc_url_raw($new_instance['url4']);
		$instance['image4'] = esc_url_raw($new_instance['image4']);
		$instance['target4'] = (!empty($new_instance['target4'])) ? 1 : 0;

		$instance['title5'] = sanitize_text_field($new_instance['title5']);
		$instance['url5'] = esc_url_raw($new_instance['url5']);
		$instance['image5'] = esc_url_raw($new_instance['image5']);
		$instance['target5'] = (!empty($new_instance['target5'])) ? 1 : 0;

        return $instance;
    }
    function form($instance) {
        $defaults = array('title1' => '', 'url1' => '', 'image1' => '', 'target1' => '', 'title2' => '', 'url2' => '', 'image2' => '', 'target2' => '', 'title3' => '', 'url3' => '', 'image3' => '', 'target3' => '', 'title4' => '', 'url4' => '', 'image4' => '', 'target4' => '', 'title5' => '', 'url5' => '', 'image5' => '', 'target5' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p class="widget-separator"><?php _e('Slide', 'mh-impact'); ?> 1</p>
        <p>
        	<label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title1']); ?>" name="<?php echo $this->get_field_name('title1'); ?>" id="<?php echo $this->get_field_id('title1'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('url1'); ?>"><?php _e('Custom URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url1']); ?>" name="<?php echo $this->get_field_name('url1'); ?>" id="<?php echo $this->get_field_id('url1'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('image1'); ?>"><?php _e('Custom Image URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image1']); ?>" name="<?php echo $this->get_field_name('image1'); ?>" id="<?php echo $this->get_field_id('image1'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target1'); ?>" name="<?php echo $this->get_field_name('target1'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target1']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target1'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

	    <p class="widget-separator"><?php _e('Slide', 'mh-impact'); ?> 2</p>
        <p>
        	<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title2']); ?>" name="<?php echo $this->get_field_name('title2'); ?>" id="<?php echo $this->get_field_id('title2'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('url2'); ?>"><?php _e('Custom URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url2']); ?>" name="<?php echo $this->get_field_name('url2'); ?>" id="<?php echo $this->get_field_id('url2'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e('Custom Image URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image2']); ?>" name="<?php echo $this->get_field_name('image2'); ?>" id="<?php echo $this->get_field_id('image2'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target2'); ?>" name="<?php echo $this->get_field_name('target2'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target2']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target2'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

	    <p class="widget-separator"><?php _e('Slide', 'mh-impact'); ?> 3</p>
        <p>
        	<label for="<?php echo $this->get_field_id('title3'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title3']); ?>" name="<?php echo $this->get_field_name('title3'); ?>" id="<?php echo $this->get_field_id('title3'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('url3'); ?>"><?php _e('Custom URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url3']); ?>" name="<?php echo $this->get_field_name('url3'); ?>" id="<?php echo $this->get_field_id('url3'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('image3'); ?>"><?php _e('Custom Image URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image3']); ?>" name="<?php echo $this->get_field_name('image3'); ?>" id="<?php echo $this->get_field_id('image3'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target3'); ?>" name="<?php echo $this->get_field_name('target3'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target3']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target3'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

	    <p class="widget-separator"><?php _e('Slide', 'mh-impact'); ?> 4</p>
        <p>
        	<label for="<?php echo $this->get_field_id('title4'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title4']); ?>" name="<?php echo $this->get_field_name('title4'); ?>" id="<?php echo $this->get_field_id('title4'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('url4'); ?>"><?php _e('Custom URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url4']); ?>" name="<?php echo $this->get_field_name('url4'); ?>" id="<?php echo $this->get_field_id('url4'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('image4'); ?>"><?php _e('Custom Image URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image4']); ?>" name="<?php echo $this->get_field_name('image4'); ?>" id="<?php echo $this->get_field_id('image4'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target4'); ?>" name="<?php echo $this->get_field_name('target4'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target4']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target4'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

	    <p class="widget-separator"><?php _e('Slide', 'mh-impact'); ?> 5</p>
        <p>
        	<label for="<?php echo $this->get_field_id('title5'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title5']); ?>" name="<?php echo $this->get_field_name('title5'); ?>" id="<?php echo $this->get_field_id('title5'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('url5'); ?>"><?php _e('Custom URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['url5']); ?>" name="<?php echo $this->get_field_name('url5'); ?>" id="<?php echo $this->get_field_id('url5'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('image5'); ?>"><?php _e('Custom Image URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['image5']); ?>" name="<?php echo $this->get_field_name('image5'); ?>" id="<?php echo $this->get_field_id('image5'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target5'); ?>" name="<?php echo $this->get_field_name('target5'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target5']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target5'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p><?php
    }
}

?>