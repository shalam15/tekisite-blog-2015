<?php

/***** MH Call to Action *****/

class mh_impact_action_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_action_widget', esc_html_x('MH Call to Action (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_action_widget',
				'description' => esc_html__('Add a call to action button to your front page.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
		$title_lead = empty($instance['title_lead']) ? '' : $instance['title_lead'];
        $title_sub = empty($instance['title_sub']) ? '' : $instance['title_sub'];
		$action_button = empty($instance['action_button']) ? '' : $instance['action_button'];
		$action_url = empty($instance['action_url']) ? '' : $instance['action_url'];
		$action_target = isset($instance['action_target']) && $instance['action_target'] ? ' target="_blank"' : '';

        echo $before_widget; ?>
		<div class="action-widget widget-wrap mh-row clearfix">
			<div class="mh-col-3-4 action-widget-content">
				<?php if ($title_lead) { ?>
					<h2 class="action-widget-title">
						<?php echo esc_attr($title_lead); ?>
					</h2>
				<?php } ?>
				<?php if ($title_sub) { ?>
					<h6 class="action-widget-subtitle">
						<?php echo esc_attr($title_sub); ?>
					</h6>
				<?php } ?>
			</div>
			<?php if ($action_button) { ?>
				<div class="mh-col-1-4 action-widget-button">
					<a class="button" href="<?php echo esc_url($action_url); ?>" title="<?php echo esc_attr($action_button); ?>"<?php echo $action_target; ?>>
						<?php echo esc_attr($action_button); ?>
					</a>
				</div>
			<?php } ?>
		</div><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title_lead'] = sanitize_text_field($new_instance['title_lead']);
		$instance['title_sub'] = sanitize_text_field($new_instance['title_sub']);
		$instance['action_button'] = sanitize_text_field($new_instance['action_button']);
		$instance['action_url'] = esc_url_raw($new_instance['action_url']);
		$instance['action_target'] = (!empty($new_instance['action_target'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title_lead' => '', 'title_sub' => '', 'action_button' => '', 'action_url' => '', 'action_target' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
	    <p>
        	<label for="<?php echo $this->get_field_id('title_lead'); ?>"><?php _e('Lead Title Text:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title_lead']); ?>" name="<?php echo $this->get_field_name('title_lead'); ?>" id="<?php echo $this->get_field_id('title_lead'); ?>" />
			<small><?php _e('Enter your custom lead title text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('title_sub'); ?>"><?php _e('Sub-Title Text:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title_sub']); ?>" name="<?php echo $this->get_field_name('title_sub'); ?>" id="<?php echo $this->get_field_id('title_sub'); ?>" />
			<small><?php _e('Enter your custom sub-title text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('action_button'); ?>"><?php _e('Button Text:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['action_button']); ?>" name="<?php echo $this->get_field_name('action_button'); ?>" id="<?php echo $this->get_field_id('action_button'); ?>" />
			<small><?php _e('Enter your custom action button text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('action_url'); ?>"><?php _e('Button URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['action_url']); ?>" name="<?php echo $this->get_field_name('action_url'); ?>" id="<?php echo $this->get_field_id('action_url'); ?>" />
			<small><?php _e('Enter the destination URL of the action button.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('action_target'); ?>" name="<?php echo $this->get_field_name('action_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['action_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('action_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p><?php
    }
}
?>