<?php

/***** MH Social *****/

class mh_social_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_social_widget', esc_html_x('MH Social', 'widget name', 'mhc'),
			array(
				'classname' => 'mh_social_widget',
				'description' => esc_html__('Widget to display linked social media icons in sidebar or footer.', 'mhc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $title = empty($instance['title']) ? '' : $instance['title'];
        $facebook_url = empty($instance['facebook_url']) ? '' : $instance['facebook_url'];
        $twitter_url = empty($instance['twitter_url']) ? '' : $instance['twitter_url'];
        $google_url = empty($instance['google_url']) ? '' : $instance['google_url'];
        $youtube_url = empty($instance['youtube_url']) ? '' : $instance['youtube_url'];
        $flickr_url = empty($instance['flickr_url']) ? '' : $instance['flickr_url'];
        $vimeo_url = empty($instance['vimeo_url']) ? '' : $instance['vimeo_url'];
        $soundcloud_url = empty($instance['soundcloud_url']) ? '' : $instance['soundcloud_url'];
        $pinterest_url = empty($instance['pinterest_url']) ? '' : $instance['pinterest_url'];
        $instagram_url = empty($instance['instagram_url']) ? '' : $instance['instagram_url'];
        $linkedin_url = empty($instance['linkedin_url']) ? '' : $instance['linkedin_url'];
        $myspace_url = empty($instance['myspace_url']) ? '' : $instance['myspace_url'];
        $rss_url = empty($instance['rss_url']) ? '' : $instance['rss_url'];
        $target = isset($instance['target']) && $instance['target'] ? ' target="_blank"' : false;
        $nofollow = isset($instance['nofollow']) && $instance['nofollow'] ? ' rel="nofollow"' : false;
        echo $before_widget;
        	if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="mh-social-widget clearfix"><?php
        		if ($facebook_url) {
        			echo '<li><a href="' . esc_url($facebook_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/facebook.png" width="34" height="34" alt="' . esc_html__('Follow on Facebook', 'mhc') . '"></a></li>' . "\n";
				}
				if ($twitter_url) {
					echo '<li><a href="' . esc_url($twitter_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/twitter.png" width="34" height="34" alt="' . esc_html__('Follow on Twitter', 'mhc') . '"></a></li>' . "\n";
				}
				if ($google_url) {
					echo '<li><a href="' . esc_url($google_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/google-plus.png" width="34" height="34" alt="' . esc_html__('Follow on Google+', 'mhc') . '"></a></li>' . "\n";
				}
				if ($youtube_url) {
					echo '<li><a href="' . esc_url($youtube_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/youtube.png" width="34" height="34" alt="' . esc_html__('Follow on YouTube', 'mhc') . '"></a></li>' . "\n";
				}
				if ($flickr_url) {
					echo '<li><a href="' . esc_url($flickr_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/flickr.png" width="34" height="34" alt="' . esc_html__('Follow on Flickr', 'mhc') . '"></a></li>' . "\n";
				}
				if ($vimeo_url) {
					echo '<li><a href="' . esc_url($vimeo_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/vimeo.png" width="34" height="34" alt="' . esc_html__('Follow on Vimeo', 'mhc') . '"></a></li>' . "\n";
				}
				if ($soundcloud_url) {
					echo '<li><a href="' . esc_url($soundcloud_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/soundcloud.png" width="34" height="34" alt="' . esc_html__('Follow on SoundCloud', 'mhc') . '"></a></li>' . "\n";
				}
				if ($pinterest_url) {
					echo '<li><a href="' . esc_url($pinterest_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/pinterest.png" width="34" height="34" alt="' . esc_html__('Follow on Pinterest', 'mhc') . '"></a></li>' . "\n";
				}
				if ($instagram_url) {
					echo '<li><a href="' . esc_url($instagram_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/instagram.png" width="34" height="34" alt="' . esc_html__('Follow on Instagram', 'mhc') . '"></a></li>' . "\n";
				}
				if ($linkedin_url) {
					echo '<li><a href="' . esc_url($linkedin_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/linkedin.png" width="34" height="34" alt="' . esc_html__('Follow on LinkedIn', 'mhc') . '"></a></li>' . "\n";
				}
				if ($myspace_url) {
					echo '<li><a href="' . esc_url($myspace_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/myspace.png" width="34" height="34" alt="' . esc_html__('Follow on Myspace', 'mhc') . '"></a></li>' . "\n";
				}
				if ($rss_url) {
					echo '<li><a href="' . esc_url($rss_url) . '"' . $target . $nofollow . '><img src="' . get_template_directory_uri() . '/images/social/rss.png" width="34" height="34" alt="' . esc_html__('Subscribe to our RSS feed', 'mhc') . '"></a></li>' . "\n";
				} ?>
			</ul><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['facebook_url'] = esc_url_raw($new_instance['facebook_url']);
        $instance['twitter_url'] = esc_url_raw($new_instance['twitter_url']);
        $instance['google_url'] = esc_url_raw($new_instance['google_url']);
        $instance['youtube_url'] = esc_url_raw($new_instance['youtube_url']);
        $instance['flickr_url'] = esc_url_raw($new_instance['flickr_url']);
        $instance['vimeo_url'] = esc_url_raw($new_instance['vimeo_url']);
        $instance['soundcloud_url'] = esc_url_raw($new_instance['soundcloud_url']);
        $instance['pinterest_url'] = esc_url_raw($new_instance['pinterest_url']);
        $instance['instagram_url'] = esc_url_raw($new_instance['instagram_url']);
        $instance['linkedin_url'] = esc_url_raw($new_instance['linkedin_url']);
        $instance['myspace_url'] = esc_url_raw($new_instance['myspace_url']);
        $instance['rss_url'] = esc_url_raw($new_instance['rss_url']);
        $instance['target'] = (!empty($new_instance['target'])) ? 1 : 0;
        $instance['nofollow'] = (!empty($new_instance['nofollow'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => esc_html__('Stay connected', 'mhc'), 'facebook_url' => '', 'twitter_url' => '', 'google_url' => '', 'youtube_url' => '', 'flickr_url' => '', 'vimeo_url' => '', 'soundcloud_url' => '', 'pinterest_url' => '', 'instagram_url' => '', 'linkedin_url' => '', 'myspace_url' => '', 'rss_url' => '', 'target' => 0, 'nofollow' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
	    </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php _e('Facebook URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['facebook_url']); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" id="<?php echo $this->get_field_id('facebook_url'); ?>" />
	    </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php _e('Twitter URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['twitter_url']); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" id="<?php echo $this->get_field_id('twitter_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('google_url'); ?>"><?php _e('Google+ URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['google_url']); ?>" name="<?php echo $this->get_field_name('google_url'); ?>" id="<?php echo $this->get_field_id('google_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('youtube_url'); ?>"><?php _e('YouTube URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['youtube_url']); ?>" name="<?php echo $this->get_field_name('youtube_url'); ?>" id="<?php echo $this->get_field_id('youtube_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('flickr_url'); ?>"><?php _e('Flickr URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['flickr_url']); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" id="<?php echo $this->get_field_id('flickr_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('vimeo_url'); ?>"><?php _e('Vimeo URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['vimeo_url']); ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" id="<?php echo $this->get_field_id('vimeo_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('soundcloud_url'); ?>"><?php _e('SoundCloud URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['soundcloud_url']); ?>" name="<?php echo $this->get_field_name('soundcloud_url'); ?>" id="<?php echo $this->get_field_id('soundcloud_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('pinterest_url'); ?>"><?php _e('Pinterest URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['pinterest_url']); ?>" name="<?php echo $this->get_field_name('pinterest_url'); ?>" id="<?php echo $this->get_field_id('pinterest_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('instagram_url'); ?>"><?php _e('Instagram URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['instagram_url']); ?>" name="<?php echo $this->get_field_name('instagram_url'); ?>" id="<?php echo $this->get_field_id('instagram_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('linkedin_url'); ?>"><?php _e('LinkedIn URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['linkedin_url']); ?>" name="<?php echo $this->get_field_name('linkedin_url'); ?>" id="<?php echo $this->get_field_id('linkedin_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('myspace_url'); ?>"><?php _e('Myspace URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['myspace_url']); ?>" name="<?php echo $this->get_field_name('myspace_url'); ?>" id="<?php echo $this->get_field_id('myspace_url'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('rss_url'); ?>"><?php _e('RSS Feed URL:', 'mhc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['rss_url']); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" id="<?php echo $this->get_field_id('rss_url'); ?>" />
	    </p>
	    <p>
      		<input id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" type="checkbox" value="1" <?php checked('1', $instance['target']); ?>/>
	  		<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Open Links in new Window / Tab', 'mhc'); ?></label>
    	</p>
    	<p>
      		<input id="<?php echo $this->get_field_id('nofollow'); ?>" name="<?php echo $this->get_field_name('nofollow'); ?>" type="checkbox" value="1" <?php checked('1', $instance['nofollow']); ?>/>
	  		<label for="<?php echo $this->get_field_id('nofollow'); ?>"><?php _e('Set Links to nofollow', 'mhc'); ?></label>
    	</p><?php
    }
}

?>