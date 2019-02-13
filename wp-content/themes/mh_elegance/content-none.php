<?php /* Template for displaying a "No posts found" message. */ ?>
<div class="entry-content">
	<?php if (is_search()) { ?>
		<p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mh-elegance'); ?></p>
	<?php } else { ?>
		<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mh-elegance'); ?></p>
	<?php } ?>
	<?php get_search_form(); ?>
</div>