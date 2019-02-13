<?php /* Template for displaying author box content */
$mh_edition_options = mh_edition_theme_options();
$mh_author_box_ID = get_the_author_meta('ID');
$name = get_the_author_meta('display_name', $mh_author_box_ID);
$website = get_the_author_meta('user_url', $mh_author_box_ID);
$facebook = get_the_author_meta('facebook', $mh_author_box_ID);
$twitter = get_the_author_meta('twitter', $mh_author_box_ID);
$googleplus = get_the_author_meta('googleplus', $mh_author_box_ID);
$youtube = get_the_author_meta('youtube', $mh_author_box_ID); ?>
<div class="mh-author-box">
	<div class="mh-author-box-content clearfix">
		<figure class="mh-author-box-avatar">
			<?php echo get_avatar($mh_author_box_ID, 90); ?>
		</figure>
		<div class="mh-author-box-header">
			<span class="mh-author-box-name">
				<?php printf(__('About %s', 'mh-edition'), esc_attr($name)); ?>
			</span>
			<?php if (!is_author()) { ?>
				<span class="mh-author-box-postcount">
					<a href="<?php echo esc_url(get_author_posts_url($mh_author_box_ID)); ?>" title="<?php printf(__('More articles written by %s', 'mh-edition'), esc_attr($name)); ?>'">
						<?php printf(__('%s Articles', 'mh-edition'), count_user_posts($mh_author_box_ID)); ?>
					</a>
				</span>
			<?php } ?>
		</div>
		<?php if (get_the_author_meta('description', $mh_author_box_ID)) { ?>
			<div class="mh-author-box-bio">
				<?php echo wp_kses_post(get_the_author_meta('description', $mh_author_box_ID)); ?>
			</div>
		<?php } else { ?>
			<div class="mh-author-box-bio">
				<?php _e('The author has not yet added any personal or biographical info to his author profile.', 'mh-edition'); ?>
			</div>
		<?php } ?>
	</div><?php
	if ($mh_edition_options['author_contact'] == 'enable') {
		if ($website || $facebook || $twitter || $googleplus || $youtube) { ?>
			<div class="mh-author-box-contact">
				<span class="mh-author-contact-title">
					<?php _e('Contact:', 'mh-edition'); ?>
				</span>
				<?php if ($website) { ?>
					<a class="mh-author-box-website" href="<?php echo esc_url($website); ?>" title="<?php printf(__('Visit the website of %s', 'mh-edition'), esc_attr($name)); ?>" target="_blank">
						<i class="fa fa-globe"></i>
						<span class="screen-reader-text"><?php _e('Website', 'mh-edition'); ?></span>
					</a>
				<?php } ?>
				<?php if ($facebook) { ?>
					<a class="mh-author-box-facebook" href="<?php echo esc_url($facebook); ?>" title="<?php printf(__('Follow %s on Facebook', 'mh-edition'), esc_attr($name)); ?>" target="_blank">
						<i class="fa fa-facebook"></i>
						<span class="screen-reader-text"><?php _e('Facebook', 'mh-edition'); ?></span>
					</a>
				<?php } ?>
				<?php if ($twitter) { ?>
					<a class="mh-author-box-twitter" href="<?php echo esc_url($twitter); ?>" title="<?php printf(__('Follow %s on Twitter', 'mh-edition'), esc_attr($name)); ?>" target="_blank">
						<i class="fa fa-twitter"></i>
						<span class="screen-reader-text"><?php _e('Twitter', 'mh-edition'); ?></span>
					</a>
				<?php } ?>
				<?php if ($googleplus) { ?>
					<a class="mh-author-box-google" href="<?php echo esc_url($googleplus); ?>" title="<?php printf(__('Follow %s on Google+', 'mh-edition'), esc_attr($name)); ?>" target="_blank">
						<i class="fa fa-google-plus"></i>
						<span class="screen-reader-text"><?php _e('Google+', 'mh-edition'); ?></span>
					</a>
				<?php } ?>
				<?php if ($youtube) { ?>
					<a class="mh-author-box-youtube" href="<?php echo esc_url($youtube); ?>" title="<?php printf(__('Follow %s on YouTube', 'mh-edition'), esc_attr($name)); ?>" target="_blank">
						<i class="fa fa-youtube-play"></i>
						<span class="screen-reader-text"><?php _e('YouTube', 'mh-edition'); ?></span>
					</a>
				<?php } ?>
			</div><?php
		}
	} ?>
</div>