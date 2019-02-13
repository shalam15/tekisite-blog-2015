<?php

/***** MH Google Maps *****/

class mh_impact_map_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_map_widget', esc_html_x('MH Google Maps (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_map_widget',
				'description' => esc_html__('Embed any Google map within a widget.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
		$gmaps_title = empty($instance['gmaps_title']) ? '' : $instance['gmaps_title'];
		$gmaps_embed = empty($instance['gmaps_embed']) ? '' : $instance['gmaps_embed'];
		$gmaps_text = empty($instance['gmaps_text']) ? '' : $instance['gmaps_text'];

        echo $before_widget; ?>
		<div class="map-widget widget-wrap clearfix">
        	<?php if ($gmaps_title) { ?>
        		<h3 class="widget-title-home map-widget-title">
	        		<?php echo esc_attr($gmaps_title); ?>
	        	</h3>
        	<?php } ?>
        	<?php if ($gmaps_embed) { ?>
				<div class="map-widget-col map-widget-embed">
					<?php echo '<iframe src="' .  esc_url($gmaps_embed) . '" width="800" height="300" class="gmap-embed"></iframe>'; ?>
				</div>
			<?php } ?>
			<?php if ($gmaps_text) { ?>
            	<div class="map-widget-col map-widget-text">
	            	<?php echo esc_attr($gmaps_text); ?>
	            </div>
			<?php } ?>
		</div><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['gmaps_title'] = sanitize_text_field($new_instance['gmaps_title']);
		$instance['gmaps_embed'] = esc_url_raw($new_instance['gmaps_embed']);
		$instance['gmaps_text'] = mh_impact_sanitize_textarea($new_instance['gmaps_text']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('gmaps_title' => '', 'gmaps_embed' => '', 'gmaps_text' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

	    <p>
        	<label for="<?php echo $this->get_field_id('gmaps_title'); ?>"><?php _e('Widget Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['gmaps_title']); ?>" name="<?php echo $this->get_field_name('gmaps_title'); ?>" id="<?php echo $this->get_field_id('gmaps_title'); ?>" />
			<small><?php _e('Enter a custom title for this widget.', 'mh-impact'); ?></small>
        </p>
		<p>
	    	<label for="<?php echo $this->get_field_id('gmaps_embed'); ?>"><?php _e('Map Embed URL:', 'mh-impact'); ?></label>
	    	<textarea cols="60" rows="5" style="width: 100%;" placeholder="" name="<?php echo $this->get_field_name('gmaps_embed'); ?>" id="<?php echo $this->get_field_id('gmaps_embed'); ?>"><?php echo esc_attr($instance['gmaps_embed']); ?></textarea>
			<small><?php _e('Enter the full URL (taken from the embed code) of your chosen Google map.', 'mh-impact'); ?></small>
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id('gmaps_text'); ?>"><?php _e('Text:', 'mh-impact'); ?></label>
	    	<textarea cols="60" rows="3" style="width: 100%;" placeholder="" name="<?php echo $this->get_field_name('gmaps_text'); ?>" id="<?php echo $this->get_field_id('gmaps_text'); ?>"><?php echo esc_attr($instance['gmaps_text']); ?></textarea>
			<small><?php _e('Enter some custom text that accompanies your map.', 'mh-impact'); ?></small>
		</p><?php
    }
}
?>