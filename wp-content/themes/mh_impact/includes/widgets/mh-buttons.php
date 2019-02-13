<?php

/***** MH Buttons *****/

class mh_impact_buttons_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_buttons_widget', esc_html_x('MH Buttons (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_buttons_widget',
				'description' => esc_html__('Display clickable buttons on your front page.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
		$button1_text = empty($instance['button1_text']) ? '' : $instance['button1_text'];
		$button1_icon = empty($instance['button1_icon']) ? '' : $instance['button1_icon'];
		$button1_url = empty($instance['button1_url']) ? '' : $instance['button1_url'];
		$button1_target = isset($instance['button1_target']) && $instance['button1_target'] ? ' target="_blank"' : '';

		$button2_text = empty($instance['button2_text']) ? '' : $instance['button2_text'];
		$button2_icon = empty($instance['button2_icon']) ? '' : $instance['button2_icon'];
		$button2_url = empty($instance['button2_url']) ? '' : $instance['button2_url'];
		$button2_target = isset($instance['button2_target']) && $instance['button2_target'] ? ' target="_blank"' : '';

		$button1 = array('text' => $button1_text, 'icon' => $button1_icon, 'url' => $button1_url, 'target' => $button1_target);
		$button2 = array('text' => $button2_text, 'icon' => $button2_icon, 'url' => $button2_url, 'target' => $button2_target);
		$buttons = array($button1, $button2);

		if ($button1_text || $button1_icon) {
			$columns = '1';
		}
		if ($button2_text || $button2_icon) {
			$columns = '2';
		}

        echo $before_widget; ?>
		<div class="buttons-widget widget-wrap mh-row clearfix">
			<?php foreach($buttons as $button) { ?>
				<?php if ($button['text'] || $button['icon']) { ?>
            		<div class="mh-col-1-<?php echo absint($columns); ?> buttons-widget-item">
                		<a class="buttons-widget-clickable" href="<?php echo esc_url($button['url']); ?>" title="<?php echo esc_attr($button['text']); ?>"<?php echo $button['target']; ?>>
							<div class="buttons-widget-text">
								<?php echo esc_attr($button['text']); ?>
							</div>
							<div class="buttons-widget-icon">
								<i class="fa fa-<?php echo esc_attr($button['icon']) ?>"></i>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['button1_text'] = sanitize_text_field($new_instance['button1_text']);
		$instance['button1_icon'] = sanitize_text_field($new_instance['button1_icon']);
		$instance['button1_url'] = esc_url_raw($new_instance['button1_url']);
		$instance['button1_target'] = (!empty($new_instance['button1_target'])) ? 1 : 0;
		$instance['button2_text'] = sanitize_text_field($new_instance['button2_text']);
		$instance['button2_icon'] = sanitize_text_field($new_instance['button2_icon']);
		$instance['button2_url'] = esc_url_raw($new_instance['button2_url']);
		$instance['button2_target'] = (!empty($new_instance['button2_target'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('button1_text' => '', 'button1_icon' => '', 'button1_url' => '', 'button1_target' => '', 'button2_text' => '', 'button2_icon' => '', 'button2_url' => '', 'button2_target' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p class="widget-separator"><?php _e('First Button', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button1_text'); ?>"><?php _e('Button Text:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['button1_text']); ?>" name="<?php echo $this->get_field_name('button1_text'); ?>" id="<?php echo $this->get_field_id('button1_text'); ?>" />
			<small><?php _e('Enter your custom text for this button.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button1_icon'); ?>"><?php _e('Button Icon:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['button1_icon']); ?>" name="<?php echo $this->get_field_name('button1_icon'); ?>" id="<?php echo $this->get_field_id('button1_icon'); ?>" />
			<small><?php _e('Enter the name of your chosen Font Awesome icon.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button1_url'); ?>"><?php _e('Button Link:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['button1_url']); ?>" name="<?php echo $this->get_field_name('button1_url'); ?>" id="<?php echo $this->get_field_id('button1_url'); ?>" />
			<small><?php _e('Enter the destination link for this button.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('button1_target'); ?>" name="<?php echo $this->get_field_name('button1_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['button1_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('button1_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>
		<p class="widget-separator"><?php _e('Second Button', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button2_text'); ?>"><?php _e('Button Text:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['button2_text']); ?>" name="<?php echo $this->get_field_name('button2_text'); ?>" id="<?php echo $this->get_field_id('button2_text'); ?>" />
			<small><?php _e('Enter your custom text for this button.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button2_icon'); ?>"><?php _e('Button Icon:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['button2_icon']); ?>" name="<?php echo $this->get_field_name('button2_icon'); ?>" id="<?php echo $this->get_field_id('button2_icon'); ?>" />
			<small><?php _e('Enter the name of your chosen Font Awesome icon.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('button2_url'); ?>"><?php _e('Button Link:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['button2_url']); ?>" name="<?php echo $this->get_field_name('button2_url'); ?>" id="<?php echo $this->get_field_id('button2_url'); ?>" />
			<small><?php _e('Enter the destination link for this button.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('button2_target'); ?>" name="<?php echo $this->get_field_name('button2_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['button2_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('button2_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p><?php
    }
}
?>