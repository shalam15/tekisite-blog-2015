<?php

/***** MH Custom Pages *****/

class mh_impact_pages_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_pages_widget', esc_html_x('MH Custom Pages (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_pages_widget',
				'description' => esc_html__('Display 3 columns of linked pages on your front page.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $pages = empty($instance['pages']) ? '' : $instance['pages'];
        $excerpt = isset($instance['excerpt']) ? $instance['excerpt'] : 'enable';
        $thumbnails = isset($instance['thumbnails']) ? $instance['thumbnails'] : 'enable';

        echo $before_widget; ?>
        <div class="mh-pages-widget widget-wrap mh-row clearfix"><?php
        	$include_ids = explode(',', $pages);
            $args = array('post_type' => 'page', 'post__in' => $include_ids, 'orderby' => 'post__in');
            $widget_loop = new WP_Query($args);
            while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
                <div class="pages-widget-item mh-col-1-3">
                	<?php if ($thumbnails == 'enable') { ?>
                		<div class="pages-widget-thumb">
                    		<a href="<?php the_permalink(); ?>"><?php
	                    		if (has_post_thumbnail()) {
		                    		the_post_thumbnail('pages-widget');
		                    	} else {
			                    	echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-pages-widget.jpg' . '" alt="No Picture" />';
			                    } ?>
			             	</a>
                		</div>
					<?php } ?>
                    <h3 class="pages-widget-title">
	                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		                    <?php the_title(); ?>
		            	</a>
		           	</h3>
                    <?php if ($excerpt == 'enable') { ?>
                    	<div class="pages-widget-excerpt">
	                    	<?php the_excerpt(); ?>
	                    </div>
                    <?php } ?>
				</div><?php
             endwhile;
             wp_reset_postdata(); ?>
		</div> <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['pages'] = strip_tags($new_instance['pages']);
        $instance['excerpt'] = strip_tags($new_instance['excerpt']);
        $instance['thumbnails'] = strip_tags($new_instance['thumbnails']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('pages' => '', 'excerpt' => 'enable', 'thumbnails' => 'enable');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
        	<label for="<?php echo $this->get_field_id('pages'); ?>"><?php _e('Filter Pages by ID (comma separated):', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['pages']); ?>" name="<?php echo $this->get_field_name('pages'); ?>" id="<?php echo $this->get_field_id('pages'); ?>" />
	    </p>
    	<p>
	    	<label for="<?php echo $this->get_field_id('thumbnails'); ?>"><?php _e('Thumbnails:', 'mh-impact'); ?></label>
			<select id="<?php echo $this->get_field_id('thumbnails'); ?>" class="widefat" name="<?php echo $this->get_field_name('thumbnails'); ?>">
				<option value="enable" <?php if ($instance['thumbnails'] == "enable") { echo "selected='selected'"; } ?>><?php _e('Display Thumbnails', 'mh-impact') ?></option>
				<option value="disable" <?php if ($instance['thumbnails'] == "disable") { echo "selected='selected'"; } ?>><?php _e('Hide Thumbnails', 'mh-impact') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('excerpt'); ?>"><?php _e('Excerpts:', 'mh-impact'); ?></label>
			<select id="<?php echo $this->get_field_id('excerpt'); ?>" class="widefat" name="<?php echo $this->get_field_name('excerpt'); ?>">
				<option value="enable" <?php if ($instance['excerpt'] == "enable") { echo "selected='selected'"; } ?>><?php _e('Display Excerpts', 'mh-impact') ?></option>
				<option value="disable" <?php if ($instance['excerpt'] == "disable") { echo "selected='selected'"; } ?>><?php _e('Hide Excerpts', 'mh-impact') ?></option>
			</select>
        </p><?php
    }
}
?>