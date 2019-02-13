<?php /* Template for displaying a "No posts found" message. */ ?>
<div class="entry-content content-margin content-background">
	<?php if (is_search()) { ?>
		<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mh-cicero'); ?></p>
	<?php } else { ?>
		<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mh-cicero'); ?></p>
	<?php } ?>
	<?php get_search_form(); ?>
</div>