<article <?php post_class('single-wrap'); ?>>
    <div class="entry-content clearfix">
        <?php if (is_search()) { ?>
			<p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mh-impact'); ?></p>
		<?php } else { ?>
			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mh-impact'); ?></p>
		<?php } ?>
		<?php get_search_form(); ?>
    </div>
</article>