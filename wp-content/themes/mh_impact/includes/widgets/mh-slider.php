<?php

/***** MH Slider *****/

class mh_impact_slider_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_slider_widget', esc_html_x('MH Slider (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_slider_widget',
				'description' => esc_html__('Slider widget for use on homepage template.', 'mh-impact')
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $category = isset($instance['category']) ? $instance['category'] : '';
        $cats = empty($instance['cats']) ? '' : $instance['cats'];
        $tags = empty($instance['tags']) ? '' : $instance['tags'];
        $postcount = empty($instance['postcount']) ? '5' : $instance['postcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $order = isset($instance['order']) ? $instance['order'] : 'date';
        $sticky = isset($instance['sticky']) ? $instance['sticky'] : 0;

        if ($cats) {
	    	$category = $category . ', ' . $cats;
        }

        echo $before_widget; ?>
        <section id="slider-<?php echo rand(1, 9999); ?>" class="flexslider">
			<ul class="slides"><?php
			$args = array('posts_per_page' => $postcount, 'cat' => $category, 'tag' => $tags, 'offset' => $offset, 'orderby' => $order, 'ignore_sticky_posts' => $sticky);
			$slider = new WP_query($args);
			while ($slider->have_posts()) : $slider->the_post(); ?>
				<li>
                    <article class="slide-wrap">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
	                        if (has_post_thumbnail()) {
		                        the_post_thumbnail('slider');
		                	} else {
			                	echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-slider.jpg' . '" alt="No Picture" />';
			                } ?>
                        </a>
                        <header class="slide-caption">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	                            <h2 class="slide-title">
		                            <?php the_title(); ?>
		                    	</h2>
		                    </a>
                        </header>
                    </article>
				</li><?php
			endwhile; wp_reset_postdata(); ?>
			</ul>
		</section><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['category'] = absint($new_instance['category']);
        $instance['cats'] = strip_tags($new_instance['cats']);
        $instance['tags'] = strip_tags($new_instance['tags']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('category' => '', 'cats' => '', 'tags' => '', 'postcount' => '5', 'offset' => '0', 'order' => 'date', 'sticky' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

	    <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'mh-impact'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if (!$instance['category']) echo 'selected="selected"'; ?>><?php _e('All', 'mh-impact'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				foreach($categories as $cat) {
					echo '<option value="' . $cat->cat_ID . '"';
					if ($cat->cat_ID == $instance['category']) { echo ' selected="selected"'; }
					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
					echo '</option>';
				}
				?>
			</select>
		</p>
		<p>
        	<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Multiple Categories Filter by ID:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo $this->get_field_name('cats'); ?>" id="<?php echo $this->get_field_id('cats'); ?>" />
	    </p>
		<p>
        	<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Filter Posts by Tags (e.g. lifestyle):', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo $this->get_field_name('tags'); ?>" id="<?php echo $this->get_field_id('tags'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Limit Post Number:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" id="<?php echo $this->get_field_id('postcount'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip Posts (Offset):', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Post Order:', 'mh-impact'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" class="widefat" name="<?php echo $this->get_field_name('order'); ?>">
				<option value="date" <?php if ($instance['order'] == "date") { echo "selected='selected'"; } ?>><?php _e('Latest Posts', 'mh-impact') ?></option>
				<option value="rand" <?php if ($instance['order'] == "rand") { echo "selected='selected'"; } ?>><?php _e('Random Posts', 'mh-impact') ?></option>
				<option value="comment_count" <?php if ($instance['order'] == "comment_count") { echo "selected='selected'"; } ?>><?php _e('Popular Posts', 'mh-impact') ?></option>
			</select>
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('sticky'); ?>" name="<?php echo $this->get_field_name('sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['sticky']); ?>/>
	  		<label for="<?php echo $this->get_field_id('sticky'); ?>"><?php _e('Ignore Sticky Posts', 'mh-impact'); ?></label>
    	</p><?php
    }
}

?>