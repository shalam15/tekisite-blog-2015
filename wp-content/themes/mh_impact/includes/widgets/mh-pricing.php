<?php

/***** MH Pricing Tables *****/

class mh_impact_pricing_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_pricing_widget', esc_html_x('MH Pricing Tables (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_pricing_widget',
				'description' => esc_html__('Display pricing tables on your front page.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $columns = '3';
		$title_general = apply_filters('widget_title', empty($instance['title_general']) ? '' : $instance['title_general'], $instance, $this->id_base);

		$table1_title = empty($instance['table1_title']) ? '' : $instance['table1_title'];
        $table1_price = empty($instance['table1_price']) ? '' : $instance['table1_price'];
		$table1_list1 = empty($instance['table1_list1']) ? '' : $instance['table1_list1'];
		$table1_list2 = empty($instance['table1_list2']) ? '' : $instance['table1_list2'];
		$table1_list3 = empty($instance['table1_list3']) ? '' : $instance['table1_list3'];
		$table1_url = empty($instance['table1_url']) ? '' : $instance['table1_url'];
		$table1_target = isset($instance['table1_target']) && $instance['table1_target'] ? ' target="_blank"' : '';

		$table2_title = empty($instance['table2_title']) ? '' : $instance['table2_title'];
        $table2_price = empty($instance['table2_price']) ? '' : $instance['table2_price'];
		$table2_list1 = empty($instance['table2_list1']) ? '' : $instance['table2_list1'];
		$table2_list2 = empty($instance['table2_list2']) ? '' : $instance['table2_list2'];
		$table2_list3 = empty($instance['table2_list3']) ? '' : $instance['table2_list3'];
		$table2_url = empty($instance['table2_url']) ? '' : $instance['table2_url'];
		$table2_target = isset($instance['table2_target']) && $instance['table2_target'] ? ' target="_blank"' : '';

		$table3_title = empty($instance['table3_title']) ? '' : $instance['table3_title'];
        $table3_price = empty($instance['table3_price']) ? '' : $instance['table3_price'];
		$table3_list1 = empty($instance['table3_list1']) ? '' : $instance['table3_list1'];
		$table3_list2 = empty($instance['table3_list2']) ? '' : $instance['table3_list2'];
		$table3_list3 = empty($instance['table3_list3']) ? '' : $instance['table3_list3'];
		$table3_url = empty($instance['table3_url']) ? '' : $instance['table3_url'];
		$table3_target = isset($instance['table3_target']) && $instance['table3_target'] ? ' target="_blank"' : '';

		$table1 = array('title' => $table1_title, 'price' => $table1_price, 'list1' => $table1_list1, 'list2' => $table1_list2, 'list3' => $table1_list3, 'url' => $table1_url, 'target' => $table1_target);
		$table2 = array('title' => $table2_title, 'price' => $table2_price, 'list1' => $table2_list1, 'list2' => $table2_list2, 'list3' => $table2_list3, 'url' => $table2_url, 'target' => $table2_target);
		$table3 = array('title' => $table3_title, 'price' => $table3_price, 'list1' => $table3_list1, 'list2' => $table3_list2, 'list3' => $table3_list3, 'url' => $table3_url, 'target' => $table3_target);
		$tables = array($table1, $table2, $table3);

		if ($table1_title || $table1_price || $table1_list1) {
			$columns = '1';
		}
		if ($table2_title || $table2_price || $table2_list1) {
			$columns = '2';
		}
		if ($table3_title || $table3_price || $table3_list1) {
			$columns = '3';
		}

        echo $before_widget;
        if (!empty($title_general)) { echo '<h3 class="widget-title-home pricing-widget-title">' . esc_attr($title_general) . '</h3>'; } ?>
		<div class="pricing-widget widget-wrap mh-row clearfix">
			<?php foreach($tables as $table) { ?>
				<?php if ($table['url']) { $anchor_begin = '<a href="' . esc_url($table['url']) . '" title="' . esc_attr($table['title']) . '"' . $table['target'] . '>'; $anchor_end = '</a>'; } else { $anchor_begin = ''; $anchor_end = ''; } ?>
				<?php if ($table['title'] || $table['price'] || $table['list1'] || $table['list2'] || $table['list3']) { ?>
            		<div class="mh-col-1-<?php echo absint($columns); ?> pricing-table">
            			<?php echo $anchor_begin; ?>
            				<?php if ($table['title']) { ?>
								<h4 class="pricing-table-title">
									<?php echo esc_attr($table['title']); ?>
								</h4>
							<?php } ?>
							<?php if ($table['price']) { ?>
								<div class="pricing-table-price">
									<?php echo esc_attr($table['price']); ?>
								</div>
							<?php } ?>
							<?php if ($table['list1'] || $table['list2'] || $table['list3']) { ?>
								<ul class="pricing-table-list">
									<?php if ($table['list1']) { ?>
										<li><?php echo esc_attr($table['list1']); ?></li>
									<?php } ?>
									<?php if ($table['list2']) { ?>
										<li><?php echo esc_attr($table['list2']); ?></li>
									<?php } ?>
									<?php if ($table['list3']) { ?>
										<li><?php echo esc_attr($table['list3']); ?></li>
									<?php } ?>
								</ul>
							<?php } ?>
						<?php echo $anchor_end; ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div> <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title_general'] = sanitize_text_field($new_instance['title_general']);

        $instance['table1_title'] = sanitize_text_field($new_instance['table1_title']);
		$instance['table1_price'] = sanitize_text_field($new_instance['table1_price']);
		$instance['table1_list1'] = sanitize_text_field($new_instance['table1_list1']);
		$instance['table1_list2'] = sanitize_text_field($new_instance['table1_list2']);
		$instance['table1_list3'] = sanitize_text_field($new_instance['table1_list3']);
		$instance['table1_url'] = esc_url_raw($new_instance['table1_url']);
		$instance['table1_target'] = (!empty($new_instance['table1_target'])) ? 1 : 0;

		$instance['table2_title'] = sanitize_text_field($new_instance['table2_title']);
		$instance['table2_price'] = sanitize_text_field($new_instance['table2_price']);
		$instance['table2_list1'] = sanitize_text_field($new_instance['table2_list1']);
		$instance['table2_list2'] = sanitize_text_field($new_instance['table2_list2']);
		$instance['table2_list3'] = sanitize_text_field($new_instance['table2_list3']);
		$instance['table2_url'] = esc_url_raw($new_instance['table2_url']);
		$instance['table2_target'] = (!empty($new_instance['table2_target'])) ? 1 : 0;

		$instance['table3_title'] = sanitize_text_field($new_instance['table3_title']);
		$instance['table3_price'] = sanitize_text_field($new_instance['table3_price']);
		$instance['table3_list1'] = sanitize_text_field($new_instance['table3_list1']);
		$instance['table3_list2'] = sanitize_text_field($new_instance['table3_list2']);
		$instance['table3_list3'] = sanitize_text_field($new_instance['table3_list3']);
		$instance['table3_url'] = esc_url_raw($new_instance['table3_url']);
		$instance['table3_target'] = (!empty($new_instance['table3_target'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title_general' => '', 'table1_title' => '', 'table1_price' => '', 'table1_list1' => '', 'table1_list2' => '', 'table1_list3' => '', 'table1_url' => '', 'table1_target' => '', 'table2_title' => '', 'table2_price' => '', 'table2_list1' => '', 'table2_list2' => '', 'table2_list3' => '', 'table2_url' => '', 'table2_target' => '', 'table3_title' => '', 'table3_price' => '', 'table3_list1' => '', 'table3_list2' => '', 'table3_list3' => '', 'table3_url' => '', 'table3_target' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

		<p class="widget-separator"><?php _e('General', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('title_general'); ?>"><?php _e('Widget Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title_general']); ?>" name="<?php echo $this->get_field_name('title_general'); ?>" id="<?php echo $this->get_field_id('title_general'); ?>" />
			<small><?php _e('Enter a custom title for this widget.', 'mh-impact'); ?></small>
        </p>

		<p class="widget-separator"><?php _e('First Table', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table1_title'); ?>"><?php _e('Table Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table1_title']); ?>" name="<?php echo $this->get_field_name('table1_title'); ?>" id="<?php echo $this->get_field_id('table1_title'); ?>" />
			<small><?php _e('Enter your custom title for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table1_price'); ?>"><?php _e('Table Price:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table1_price']); ?>" name="<?php echo $this->get_field_name('table1_price'); ?>" id="<?php echo $this->get_field_id('table1_price'); ?>" />
			<small><?php _e('Enter your custom price for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table1_list1'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 1); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table1_list1']); ?>" name="<?php echo $this->get_field_name('table1_list1'); ?>" id="<?php echo $this->get_field_id('table1_list1'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table1_list2'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 2); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table1_list2']); ?>" name="<?php echo $this->get_field_name('table1_list2'); ?>" id="<?php echo $this->get_field_id('table1_list2'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table1_list3'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 3); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table1_list3']); ?>" name="<?php echo $this->get_field_name('table1_list3'); ?>" id="<?php echo $this->get_field_id('table1_list3'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('table1_url'); ?>"><?php _e('Table URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['table1_url']); ?>" name="<?php echo $this->get_field_name('table1_url'); ?>" id="<?php echo $this->get_field_id('table1_url'); ?>" />
			<small><?php _e('Enter URL to link the pricing table.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('table1_target'); ?>" name="<?php echo $this->get_field_name('table1_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['table1_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('table1_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

		<p class="widget-separator"><?php _e('Second Table', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table2_title'); ?>"><?php _e('Table Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table2_title']); ?>" name="<?php echo $this->get_field_name('table2_title'); ?>" id="<?php echo $this->get_field_id('table2_title'); ?>" />
			<small><?php _e('Enter your custom title for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table2_price'); ?>"><?php _e('Table Price:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table2_price']); ?>" name="<?php echo $this->get_field_name('table2_price'); ?>" id="<?php echo $this->get_field_id('table2_price'); ?>" />
			<small><?php _e('Enter your custom price for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table2_list1'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 1); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table2_list1']); ?>" name="<?php echo $this->get_field_name('table2_list1'); ?>" id="<?php echo $this->get_field_id('table2_list1'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table2_list2'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 2); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table2_list2']); ?>" name="<?php echo $this->get_field_name('table2_list2'); ?>" id="<?php echo $this->get_field_id('table2_list2'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table2_list3'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 3); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table2_list3']); ?>" name="<?php echo $this->get_field_name('table2_list3'); ?>" id="<?php echo $this->get_field_id('table2_list3'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('table2_url'); ?>"><?php _e('Table URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['table2_url']); ?>" name="<?php echo $this->get_field_name('table2_url'); ?>" id="<?php echo $this->get_field_id('table2_url'); ?>" />
			<small><?php _e('Enter URL to link the pricing table.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('table2_target'); ?>" name="<?php echo $this->get_field_name('table2_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['table2_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('table2_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p>

		<p class="widget-separator"><?php _e('Third Table', 'mh-impact'); ?></p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table3_title'); ?>"><?php _e('Table Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table3_title']); ?>" name="<?php echo $this->get_field_name('table3_title'); ?>" id="<?php echo $this->get_field_id('table3_title'); ?>" />
			<small><?php _e('Enter your custom title for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table3_price'); ?>"><?php _e('Table Price:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table3_price']); ?>" name="<?php echo $this->get_field_name('table3_price'); ?>" id="<?php echo $this->get_field_id('table3_price'); ?>" />
			<small><?php _e('Enter your custom price for this table.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table3_list1'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 1); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table3_list1']); ?>" name="<?php echo $this->get_field_name('table3_list1'); ?>" id="<?php echo $this->get_field_id('table3_list1'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table3_list2'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 2); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table3_list2']); ?>" name="<?php echo $this->get_field_name('table3_list2'); ?>" id="<?php echo $this->get_field_id('table3_list2'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('table3_list3'); ?>"><?php printf(__('List Item #%d:', 'mh-impact'), 3); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['table3_list3']); ?>" name="<?php echo $this->get_field_name('table3_list3'); ?>" id="<?php echo $this->get_field_id('table3_list3'); ?>" />
			<small><?php _e('Enter your custom list text.', 'mh-impact'); ?></small>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('table3_url'); ?>"><?php _e('Table URL:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['table3_url']); ?>" name="<?php echo $this->get_field_name('table3_url'); ?>" id="<?php echo $this->get_field_id('table3_url'); ?>" />
			<small><?php _e('Enter URL to link the pricing table.', 'mh-impact'); ?></small>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('table3_target'); ?>" name="<?php echo $this->get_field_name('table3_target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['table3_target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('table3_target'); ?>"><?php _e('Open link in new window / tab', 'mh-impact'); ?></label>
    	</p><?php
    }
}
?>