<?php

/***** MH Blog *****/

class mh_impact_blog_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_impact_blog_widget', esc_html_x('MH Blog (Homepage)', 'widget name', 'mh-impact'),
			array(
				'classname' => 'mh_impact_blog_widget',
				'description' => esc_html__('Display latest blog posts on your front page.', 'mh-impact'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Blog', 'mh-impact') : $instance['title'], $instance, $this->id_base);
		$category = isset($instance['category']) ? $instance['category'] : '';
        $cats = empty($instance['cats']) ? '' : $instance['cats'];
		$tags = empty($instance['tags']) ? '' : $instance['tags'];
		$postcount = empty($instance['postcount']) ? '10' : $instance['postcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $order = isset($instance['order']) ? $instance['order'] : 'date';

		$args = array('posts_per_page' => $postcount, 'offset' => $offset, 'cat' => $category, 'tag' => $tags, 'orderby' => $order, 'ignore_sticky_posts' => 1);
		$widget_loop = new WP_Query($args);
		$counter = 1;
		$max_posts = $widget_loop->post_count;

		if ($counter == 1 && $counter == $max_posts) { $column = '1-1'; } else { $column = '1-2'; }

		echo $before_widget; ?>
        <div class="blog-widget widget-wrap">
        	<?php if (!empty($title)) { echo $before_title . esc_attr($title) . $after_title; } ?>
        	<div class="mh-row clearfix">
        		<?php while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
        			<?php if ($counter == 1) { ?>
			    		<div class="mh-col-<?php echo esc_attr($column); ?> blog-widget-xl">
                			<div class="blog-widget-thumb">
                    			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('blog-widget'); } else { echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-blog-widget.jpg' . '" alt="No Picture" />'; } ?></a>
							</div>
							<h3 class="blog-widget-xl-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
					<?php if ($counter == 2) { ?>
        				<div class="mh-col-1-2">
							<ul class="widget-list blog-widget-list">
					<?php } ?>
					<?php if ($counter >= 2) { ?>
								<li class="blog-widget-list-item"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
					<?php } ?>
					<?php if ($counter >= 2 && $counter == $max_posts) { ?>
                  			</ul>
				  		</div>
				  	<?php } ?>
				<?php $counter++; ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
        </div><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['category'] = absint($new_instance['category']);
        $instance['cats'] = strip_tags($new_instance['cats']);
        $instance['tags'] = strip_tags($new_instance['tags']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['order'] = strip_tags($new_instance['order']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => esc_html__('Blog', 'mh-impact'), 'category' => '', 'cats' => '', 'tags' => '', 'postcount' => '10', 'offset' => '0', 'order' => 'date');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mh-impact'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'mh-impact'); ?></label>
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
            <small><?php _e('Select a category to display posts from.', 'mh-impact'); ?></small>
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
        </p><?php
    }
}
?>